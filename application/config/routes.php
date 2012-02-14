<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = '';

/* user */
$route['users/login'] = 'user/login';
$route['users/logout'] = 'user/logout';
$route['auth/login'] = 'auth/login';
$route['users/(:num)'] = 'users/show/$1';
$route['users/edit/(:num)'] = 'users/edit/$1';
$route['users/edit_security_settings/(:num)'] = 'users/edit_security_settings/$1';
$route['users/update/(:num)'] = 'users/update/$1';
$route['users/delete/(:num)'] = 'users/delete/$1';

$route['dashboard/index'] = 'dashboard/index';
$route['documentation/index'] = 'documentation/index';

$route['user_management/control_manager'] = 'user_management/control_manager/index';
$route['user_management/control_manager/list'] = 'user_management/control_manager/index';
$route['user_management/control_manager/new_user'] = 'user_management/control_manager/new_user';
$route['user_management/control_manager/archive'] = 'user_management/control_manager/archive';

$route['file_maintenance/company_info'] = 'file_maintenance/company';
$route['file_maintenance/company_info/edit/(:num)'] = 'file_maintenance/company/edit/$1';
$route['file_maintenance/company_info/update/(:num)'] = 'file_maintenance/company/update/$1';
$route['file_maintenance/company_info'] = 'file_maintenance/accounts_manager';
$route['file_maintenance/company_info'] = 'file_maintenance/employee_status_manager';
$route['file_maintenance/company_info'] = 'file_maintenance/city_manager';
$route['file_maintenance/company_info'] = 'file_maintenance/unit_manager';
$route['file_maintenance/company_info'] = 'file_maintenance/department';
$route['file_maintenance/company_info'] = 'file_maintenance/earning';
$route['file_maintenance/company_info'] = 'file_maintenance/deduction';
$route['file_maintenance/company_info'] = 'file_maintenance/customer_type';
$route['file_maintenance/company_info'] = 'file_maintenance/area';
$route['file_maintenance/company_info'] = 'file_maintenance/currency';

/* End of file routes.php */
/* Location: ./application/config/routes.php */