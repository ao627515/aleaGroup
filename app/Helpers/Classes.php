<?php

namespace App\Helpers;

class Classes
{
    public static function get($classes)
    {
        $result = '';

        foreach($classes as $class) {
            $spacer = empty($result) ? '' : ' ';
            if (isset($class['class']) && !empty($class['class'])) {
                $result .= $spacer . $class['class'];
            } elseif(!empty($class) && !is_array($class)) {
                $result .= $spacer . $class;
            }
        }

        return $result;
    }
}
