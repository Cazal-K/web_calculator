<?php

class Operation {

    public static function do_op($a, $operator, $b)
    {
        switch ($operator) {
            case "+":
                return $a . $operator . $b . "=" . self::add($a, $b);
                break;
            case "-":
                return $a . $operator . $b . "=" . self::sub($a, $b);
                break;
            case "*":
                return $a . $operator . $b . "=" . self::mul($a, $b);
                break;
            case '/':
                return $a . $operator . $b . "=" . self::div($a, $b);
                break;
            case '%':
                return $a . $operator . $b . "=" . self::mod($a, $b);
                break;
            default:
                return  "Unknown operator";
                break;        
        }
    }
    
    public static function add($a, $b)
    {
        if (is_numeric($a) && is_numeric($b)) {
            return $a + $b;
        } else {
            return "Error";
        }
    }

    public static function sub($a, $b)
    {
        if (is_numeric($a) && is_numeric($b)) {
            return $a - $b;
        } else {
            return "Error";
        }
    }

    public static function mul($a, $b)
    {
        if (is_numeric($a) && is_numeric($b)) {
            return $a * $b;
        } else {
            return "Error";
        }
    }

    public static function div($a, $b)
    {
        if (is_numeric($a) && is_numeric($b) && $b != 0) {
            return $a / $b;
        } else {
            return "Error";
        }
    }

    public static function mod($a, $b)
    {
        if (is_numeric($a) && is_numeric($b) && $b != 0) {
            return $a % $b;
        } else {
            return "Error";
        }
    }
}