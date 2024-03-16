<?php

namespace App\View\Components;

use App\Helpers\Classes;
use Illuminate\View\Component;

class Badge extends Component
{
    public $link;
    public $type;
    public $text;
    public $variant;
    public $attrs;
    public $href;

    public function __construct(
        $all = [],
        $type = '',
        $link = [],
        $href = '',
        $variant = '',
        $text = '',
        $class = ''
    )
    {
        $this->link = $link ?: $all['link'] ?? '';
        $this->href = $href ?: $all['href'] ?? '';
        $this->type = $type ?: $all['type'] ?? '';
        $this->variant = $variant ?: $all['variant'] ?? '';
        $this->text = $text ?: $all['text'] ?? '';
        $this->attrs = [
            'class' => $class ?: $all['class'] ?? '',
            'href' => $href ?: $all['link']['href'] ?? '',
        ];
        $this->attrs['class'] = Classes::get([
            'badge',
            $this->type ? 'badge-' . $this->type : '',
            $this->variant ? 'badge-' . $this->variant : '',
            $this->attrs['class']
        ]);
        $this->attrs = \array_filter($this->attrs);
    }

    public function render()
    {
        return view('components.badge');
    }
}
