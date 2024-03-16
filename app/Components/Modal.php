<?php

namespace App\View\Components;

use App\Helpers\Classes;
use Illuminate\View\Component;

class Modal extends Component
{
    public $childs;
    public $attrs;
    public $title;
    public $body;
    public $footer;
    public $dialog;
    public $centered;
    public $scrollable;
    public $size;

    public function __construct(
        $all = [],
        $title = '',
        $body = '',
        $footer = '',
        $class = '',
        $scrollable = false,
        $centered = false,
        $size = '',
        $id = ''
    )
    {
        $this->childs = $all ?? [];
        $this->title = $title ?: $all['title'] ?? '';
        $this->body = $body ?: $all['body'] ?? '';
        $this->footer = $footer ?: $all['footer'] ?? '';
        $this->scrollable = $scrollable ?: $all['scrollable'] ?? false;
        $this->centered = $centered ?: $all['centered'] ?? false;
        $this->size = $size ?: $all['size'] ?? '';
        $this->attrs = [
            'id' => $id ?: $all['id'] ?? '',
        ];
        $this->attrs['class'] = Classes::get([
            'modal',
            'class' => $class ?: $all['class'] ?? 'fade',
        ]);
        $this->dialog['class'] = Classes::get([
            'modal-dialog',
            $this->scrollable === true ? 'modal-dialog-scrollable' : '',
            $this->centered === true ? 'modal-dialog-centered' : '',
            !empty($this->size) ? 'modal-' . $this->size : '',
        ]);
        $this->attrs = \array_filter($this->attrs);
    }

    public function render()
    {
        return view('components.modal');
    }
}
