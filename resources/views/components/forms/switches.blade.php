@php
  $attr = $attributes->merge($attrs);
  if (isset($errors)) {
    $attr['class'] .= $errors->has($attr['name']) ? ' is-invalid' : '';
  }
@endphp

<div{!! $group['attrs'] !!}>
  @isset($grid[0])
    <div class="{{ $grid[0] }}">
      @endisset

      <div class="custom-control custom-switch">
        <input value="{{ request()->input($attr['name'], old($attr['name'])) }}" {!! $attr->merge($attrs) !!} type="checkbox" id="checkbox-{{ $attr['name'] }}">

        @if(!empty($label['text']))
          <label{!! $label['attrs'] !!} for="checkbox-{{ $attr['name'] }}">{!! $label['text'] ?? '' !!}</label>
        @endif

        @if(isset($errors) && $errors->has($attr['name']))
          <div class="{{ $errors->has($attr['name']) ? 'invalid' : '' }}-feedback d-block">
            {!! $errors->first($attr['name']) !!}
          </div>
        @endif
      </div>

      @isset($grid[0])
    </div>
  @endisset
</div>
