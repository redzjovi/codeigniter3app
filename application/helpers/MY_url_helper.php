<?php

if ( ! function_exists('current_url_with_params'))
{
	function current_url_with_params($params = [])
    {
        $CI =& get_instance();

        $url_params = '';
        if ($_SERVER['QUERY_STRING'] || $params) {
            $_SERVER['QUERY_STRING'] ? parse_str($_SERVER['QUERY_STRING'], $url_params) : $url_params = [];
            $url_params = array_merge($url_params, $params);
            $url_params = http_build_query($url_params);
        }

        $url = $CI->config->site_url($CI->uri->uri_string());
        $url = $url.'?'.$url_params;
        return $url;
    }
}
