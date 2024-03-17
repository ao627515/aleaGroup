<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;
use App\Helpers\Attributes;
use App\Helpers\Classes;

class Upload extends Component
{
    public $type;
    public $variant;
    public $help;
    public $placeholder;
    public $group = [];
    public $grid;
    public $label = [];
    public $attrs;

    public function __construct(
        $all = [],
        $group = [],
        $label = [],
        $name = '',
        $type = '',
        $placeholder = '',
        $grid = [],
        $help = '',
        $variant = '',
        $class = ''
    )
    {
        $this->type = $type ?: $all['type'] ?? 'file';
        $this->group = $group ?: $all['group'] ?? [];
        $this->placeholder = $placeholder ?: $all['placeholder'] ?? 'Browse';
        $this->grid = $grid ?: $all['grid'] ?? [];
        $this->label = $label ?: $all['label'] ?? [];
        $this->help = $help ?: $all['help'] ?? '';
        $this->variant = $variant ?: $all['variant'] ?? '';

        $this->attrs = [
            'class' => $class ?: $all['class'] ?? '',
        ];
        if (\strpos($this->attrs['class'], 'form-control-plaintext') !== 0) {
            $this->attrs['class'] = Classes::get([
                'form-control',
                $this->attrs['class'],

            ]);
        }
        $this->label['class'] = Classes::get([
            $this->label,
            $this->grid[0] ?? ''
        ]);
        $this->group['class'] = Classes::get([
            'form-group',
            $this->group,
            isset($this->grid[0]) ? 'form-row' : ''
        ]);
        $this->label['attrs'] = Attributes::get($this->label, ['text']);
        $this->group['attrs'] = Attributes::get($this->group);
        $this->attrs = \array_filter($this->attrs);
        $this->attrs['name'] = $name ?: $all['name'] ?? '';
    }

    public function render()
    {
        return view('components.forms.upload');
    }
}
