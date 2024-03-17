<?php

namespace App\View\Components;

use App\Helpers\Classes;
use Illuminate\View\Component;

class Alert extends Component
{
    public $type;
    public $dismissible;
    public $message;
    public $attrs;

    public function __construct(
        $all = [],
        $type = '',
        $message = '',
        $class = '',
        $dismissible = false
    )
    {
        $this->type = $type ?: $all['type'] ?? '';
        $this->dismissible = $dismissible ?: $all['dismissible'] ?? false;
        $this->message = $message ?: $all['message'] ?? '';
        $this->attrs = [
            'class' => $class ?: $all['class'] ?? '',
        ];
        $this->attrs['class'] = Classes::get([
            $this->type ? 'alert alert-' . $this->type : '',
            $this->dismissible ? 'alert-dismissible fade show' : '',
            $this->attrs['class']
        ]);
        $this->attrs = \array_filter($this->attrs);
    }

    public function render()
    {
        return view('components.alert');
    }
}
