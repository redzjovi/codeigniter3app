<?php

if (! function_exists('singular_plural'))
{
    /**
     * $str = parse_html_by_class(2, 'dog');
     * @param integer $count
     * @param string $str
     * @return string $str
     */
    function singular_plural($count, $str)
    {
        $str = $count > 1 ? plural($str) : singular($str);
        return $str;
    }
}
