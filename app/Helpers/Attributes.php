<?php

namespace App\Helpers;

class Attributes
{
    public static function get($items, $excludes = [])
    {
        $attrs = '';
        foreach ($items as $key => $value) {
            if (!in_array($key, $excludes) && !empty($value) && !\is_array($value)) {
                $attrs .= ' ' . $key . '="' . $value . '"';
            }
        }

        return $attrs;
    }
}
