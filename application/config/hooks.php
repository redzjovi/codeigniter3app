<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/
$hook['display_override'] = array(
    'class' => 'Minifyhtml',
    'function' => 'output',
    'filename' => 'Minifyhtml.php',
    'filepath' => 'hooks',
    'params' => array()
);
$hook['post_controller'] = function () {
    $ci =& get_instance();
    $ci->input->is_ajax_request() || $ci->input->is_cli_request() ?: $ci->output->enable_profiler(filter_var(getenv('PROFILER'), FILTER_VALIDATE_BOOLEAN));
};
$hook['post_controller_constructor'] = array(
    'class' => 'Language_hooks',
    'function' => 'initialize',
    'filename' => 'Language_hooks.php',
    'filepath' => 'hooks'
);
