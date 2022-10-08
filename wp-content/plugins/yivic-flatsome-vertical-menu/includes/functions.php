<?php
/**
 * Created by PhpStorm.
 * User: manhphuc
 * Date: 7/13/2017
 * Time: 9:12 PM
 */

function yivic_fl_vm_get_option($key, $default = '')
{
    $options = get_option('yivic_vm');
    $option = isset($options[$key]) ? $options[$key] : $default;
    return $option;
}