<div {!! $attributes->merge($attrs) !!}>
  {!! $message !!}

  {{ $slot }}

  @if($dismissible == true)
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  @endif
</div>
