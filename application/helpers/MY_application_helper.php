<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Script
 *
 * Generates a script inclusion of a JavaScript file
 * Based on the CodeIgniters original Link Tag.
 *
 * Author(s): Isern Palaus <ipalaus@ipalaus.es>
 *            David Mulder <david@greatslovakia.com>
 *
 * @access    public
 * @param    mixed    javascript sources or an array
 * @param    string    language
 * @param    string    type
 * @param    boolean    should index_page be added to the javascript path
 * @return    string
 */
if (!function_exists('script_tag')) {

    function script_tag($src = '', $language = 'javascript', $type = 'text/javascript', $index_page = FALSE) {
        $CI = & get_instance();

        $script = '<scr' . 'ipt';

        if (is_array($src)) {
            foreach ($src as $k => $v) {
                if ($k == 'src' AND strpos($v, '://') === FALSE) {
                    if ($index_page === TRUE) {
                        $script .= ' src="' . $CI->config->site_url($v) . '"';
                    } else {
                        $script .= ' src="' . $CI->config->slash_item('base_url') . $v . '"';
                    }
                } else {
                    $script .= "$k=\"$v\"";
                }
            }

            $script .= "></scr" . "ipt>\n";
        } else {
            if (strpos($src, '://') !== FALSE) {
                $script .= ' src="' . $src . '" ';
            } elseif ($index_page === TRUE) {
                $script .= ' src="' . $CI->config->site_url($src) . '" ';
            } else {
                $script .= ' src="' . $CI->config->slash_item('base_url') . $src . '" ';
            }

            $script .= 'language="' . $language . '" type="' . $type . '"';

            $script .= " />alert('test')</script>" . "\n";
        }
        return $script;
    }

}

if (!function_exists('create_button')) {
    function create_button($options=array()) {
        $button = "<div class='button-wrapper'><button ";
        if (isset($options['id'])) {
            $button .= 'id="'.$options['id'].'" ';
        }
        if (isset($options['class'])) {
            $button .= 'class="'.$options['class'].'" ';
        }
        if (isset($options['type'])) {
            $button .= 'type="'.$options['type'].'" ';
        } else {
            $button .= 'type="submit" ';
        }
        if (isset($options['data_attributes'])){
            foreach($options['data_attributes'] as $attr => $val) {
                $button .= $attr.'="'.$val.'"';
            }
        }

        $button .= ">";
        if (isset($options['text'])) {
            $button .= $options['text'];
        }
        $button .= "</button></div>";
        return $button;
    }
}

if (!function_exists('readable_time')) {
    function readable_time($options=array()) {
        if (isset($options['format'])) {
            $format = $options['format'];
        } else {
            $format = 'h:i:s A';
        }

        if (!isset($options['date'])) {
            return '...';
        }
        return date('h:i:s A', strtotime($options['date']));
    }
}
?>