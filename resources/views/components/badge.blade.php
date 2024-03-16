@if(!empty($link))
  <a {!! $attributes->merge($attrs) !!}>
    {{ $link['text'] ?? '' }}
    {{ $text }}
    {{ $slot ?? '' }}
  </a>
@else
  <span {!! $attributes->merge($attrs) !!}>
    {{ $text }}
    {{ $slot ?? '' }}
  </span>
@endif
