<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Profiler Sections
| -------------------------------------------------------------------------
| This file lets you determine whether or not various sections of Profiler
| data are displayed when the Profiler is enabled.
| Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/profiling.html
|
*/

$sections = array(
    'benchmarks' => TRUE,
    'config' => TRUE,
    'controllers' => TRUE,
    'get' => TRUE,
    'http_headers' => TRUE,
    'memory_usage' => TRUE,
    'post' => TRUE,
    'queries' => TRUE,
    'uri_string' => TRUE,
    'query_toggle_count' => TRUE,
);

/* End of file profiler.php */
/* Location: ./application/config/profiler.php */