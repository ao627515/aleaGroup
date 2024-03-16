@php
    $attr = $attributes->merge($attrs);
    if (isset($errors)) {
        $attr['class'] .= $errors->has($attr['name']) ? ' is-invalid' : '';
    }
@endphp

<div{!! $group['attrs'] !!}>
    @if (!empty($label['text']))
        <label{!! $label['attrs'] !!} for="input-{{ $attr['name'] }}">{!! $label['text'] ?? '' !!}</label>
    @endif

    @isset($grid[1])
        <div class="{{ $grid[1] }}">
        @endisset

        @php
            // $optionsParameters = [
            //     'selected_with_key' => key, permet de selectionne une option par raport a la cle passe
            //     'selected_with_value' => key,permet de selectionne une option par raport a la la veleur de l'option
            //     'value_by_key' => bool,
            // ];

            // // Option par défaut
            // $defaultOption = [
            //     'disabled' => bool (default true),
            //     'selected' => bool,
            //     'text' => string,
            // ];

            // optionParameter
            $optParam = $optionsParameters;
            $hasSelectedByKey = isset($optParam['selected_with_key']);
            $hasSelectedByValue = isset($optParam['selected_with_value']);
            // $hasValueByKey = isset($optParam['value_by_key']);
            $optParam['value_by_key'] = $optParam['value_by_key'] ?? true;
            $hasOptSelected = $hasSelectedByKey || $hasSelectedByValue;
            // default option
            $defaultOptIsDisabled = $defaultOption['disabled'] ?? true;
            $defaultOptIsSelected = $defaultOption['selected'] ?? true;

        @endphp

        <select {!! $attr->merge($attrs) !!} id="input-{{ $attr['name'] }}">

            @foreach ($options as $key => $option)
                @php
                    // si on ajoute selected en fonction de la valeur
                    $isSelectedByValue = request()->input($attr['name'], old($attr['name'], $optParam['selected_with_value'] ?? '')) == $option;
                    // si on ajoute selected en fonction de la clé
                    $isSelectedByKey = request()->input($attr['name'], old($attr['name'], $optParam['selected_with_key'] ?? '')) == $key;
                    // ajoute selected a au defaul option
                    // si les valeur ne corresponde pas
                    // si les la clé ne correspond pas
                    // si il n'y a pas d'option selectionné
                    $defOptIsSelected = !$isSelectedByValue && !$isSelectedByKey && !$hasOptSelected && $defaultOptIsSelected;
                @endphp
                @if ($loop->first && $defaultOption)
                    <option @if($defaultOptIsDisabled) disabled @endif @if ($defOptIsSelected) selected @endif>{{ $defaultOption['text'] }}</option>
                @endif
                <option @if ($optParam['value_by_key']) value="{{ $key }}" @endif
                    {{ $isSelectedByValue || $isSelectedByKey  ? 'selected' : '' }}>
                    {{ $option }}
                </option>
            @endforeach
        </select>

        @if (!empty($help))
            <small id="help-{{ $attr['name'] }}" class="form-text text-muted">We'll never share
                your email with anyone else.</small>
        @endif

        @if (isset($errors) && $errors->has($attr['name']))
            <div class="{{ $errors->has($attr['name']) ? 'invalid' : '' }}-feedback d-block">
                {!! $errors->first($attr['name']) !!}
            </div>
        @endif

        @isset($grid[1])
        </div>
    @endisset
    </div>
