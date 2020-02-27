<?php


class Functions
{
    public static function reduceColumns($columns)
    {
        $cols = '';
        foreach ($columns as $i => $iValue) {
            if ($i + 1 !== count($columns))
            {
                $cols .= "$iValue, ";
            }
            else
            {
                $cols .= $iValue;
            }
        }
        return $cols;
    }
}