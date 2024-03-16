<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;
use App\Helpers\Attributes;
use App\Helpers\Classes;

class Checkbox extends Component
{
    public $type;
    public $variant;
    public $help;
    public $group = [];
    public $grid;
    public $label = [];
    public $validation = [];
    public $attrs;
    public $id;
    public $value;
    public $checked;

    public function __construct(
        $all = [],
        $group = [],
        $label = [],
        $grid = [],
        $validation = [],
        $help = '',
        $name = '',
        $variant = '',
        $class = '',
        $id = '',
        $value = '',
        $checked = false,
    )
    {
        $this->validation = $validation ?: $all['validation'] ?? [];
        $this->group = $group ?: $all['group'] ?? [];
        $this->grid = $grid ?: $all['grid'] ?? [];
        $this->label = $label ?: $all['label'] ?? [];
        $this->help = $help ?: $all['help'] ?? '';
        $this->variant = $variant ?: $all['variant'] ?? '';
        $this->id = $id ?: $all['id'] ?? '';
        $this->value = $value ?: $all['value'] ?? '';
        $this->checked = $checked ?: $all['checked'] ?? false;
        $this->attrs = [
            'class' => $class ?: $all['class'] ?? '',
        ];
        $this->attrs['class'] = Classes::get([
            'form-check-input',
            $this->attrs['class'],
            isset($this->validation['type']) ? 'is-' . $this->validation['type'] : ''
        ]);
        $this->label['class'] = Classes::get([
            'form-check-label',
            $this->label
        ]);
        $this->group['class'] = Classes::get([
            'form-group',
            $this->group,
            isset($this->grid[0]) ? 'form-row' : ''
        ]);
        $this->label['attrs'] = Attributes::get($this->label, ['text']);
        $this->group['attrs'] = Attributes::get($this->group);
        $this->attrs = array_filter($this->attrs);
        $this->attrs['name'] = $name ?: $all['name'] ?? '';
        $this->attrs['id'] = $id ?: $all['id'] ?? '';
        $this->attrs['id'] = 'checkbox-'.$this->attrs['id'];
    }

    public function render()
    {
        return view('components.forms.checkbox');
    }
}
