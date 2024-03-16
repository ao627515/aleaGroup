@php
  $attr = $attributes->merge($attrs);
  if (isset($errors)) {
    $attr['class'] .= $errors->has($attr['name']) ? ' is-invalid' : '';
  }
@endphp

<div{!! $group['attrs'] !!}>
  @if(!empty($label['text']))
    <label{!! $label['attrs'] !!} for="upload-{{ $attr['name'] }}">{!! $label['text'] ?? '' !!}</label>
  @endif

  @isset($grid[1])
    <div class="{{ $grid[1] }}">
      @endisset

      <div class="custom-file">
        <input value="{{ request()->input($attr['name'], old($attr['name'])) }}" {!! $attr !!} id="upload-{{ $attr['name'] }}" type="file" aria-describedby="help-{{ $attr['name'] }}">
        <label class="custom-file-label" for="upload-{{ $attr['name'] }}">{{ $placeholder }}</label>

        @if(!empty($help))
          <small id="help-{{ $attr['name'] }}" class="form-text text-muted">We'll never share your email with anyone else.</small>
        @endif

        @if(isset($errors) && $errors->has($attr['name']))
          <div class="{{ $errors->has($attr['name']) ? 'invalid' : '' }}-feedback d-block">
            {!! $errors->first($attr['name']) !!}
          </div>
        @endif
      </div>

      @isset($grid[1])
    </div>
  @endisset
</div>
