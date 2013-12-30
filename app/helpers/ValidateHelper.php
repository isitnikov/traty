<?php

class ValidateHelper
{
    public static function validateAmount($amount)
    {
        $result = false;

        if (is_numeric($amount)) {
            $result = true;
        }

        return $result;
    }
}