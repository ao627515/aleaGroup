@php
  $attr = $attributes->merge($attrs);
  if (isset($errors)) {
    $attr['class'] .= $errors->has($attr['name']) ? ' is-invalid' : '';
  }
@endphp

@if($attr['type'] != 'hidden')
  <div{!! $group['attrs'] !!}>
    @endif
    @if(!empty($label['text']))
      <label{!! $label['attrs'] !!} for="input-{{ $attr['name'] }}">{!! $label['text'] ?? '' !!}</label>
    @endif

    @isset($grid[1])
      <div class="{{ $grid[1] }}">
        @endisset

        <input value="{{ request()->input($attr['name'], old($attr['name'], $value)) }}" {!! $attr !!} id="input-{{ $attr['name'] }}">

        @if(!empty($help))
          <small id="help-{{ $attr['name'] }}" class="form-text text-muted">{!! $help !!}</small>
        @endif

        @if(isset($errors) && $errors->has($attr['name']))
          <div class="{{ $errors->has($attr['name']) ? 'invalid' : '' }}-feedback d-block">
            {!! $errors->first($attr['name']) !!}
          </div>
        @endif

        @isset($grid[1])
      </div>
    @endisset
    @if($attr['type'] != 'hidden')
  </div>
@endif
