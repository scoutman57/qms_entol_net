<?php
require_once (rtrim(FCPATH, '\\') . '/xcrud/xcrud.php');
if (!function_exists('xcrud_get_instance'))
{
    function xcrud_get_instance($name = true)
    {
        return Xcrud::get_instance($name);
    }
}
