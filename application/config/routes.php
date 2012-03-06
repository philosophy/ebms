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
$route['users/login'] = 'auth/login';
$route['users/logout'] = 'auth/logout';
$route['auth/login'] = 'auth/login';
$route['users/(:num)'] = 'users/show/$1';
$route['users/edit/(:num)'] = 'users/edit/$1';
$route['users/edit_security_settings/(:num)'] = 'users/edit_security_settings/$1';
$route['users/update/(:num)'] = 'users/update/$1';
$route['users/delete/(:num)'] = 'users/delete/$1';
$route['users/forgot_password'] = 'users/forgot_password';

$route['dashboard/index'] = 'dashboard/index';
$route['documentation/index'] = 'documentation/index';

$route['user_management/control_manager'] = 'user_management/control_manager/index';
$route['user_management/control_manager/list'] = 'user_management/control_manager/index';
$route['user_management/control_manager/new_user'] = 'user_management/control_manager/new_user';
$route['user_management/control_manager/update_user/(:num)'] = 'user_management/control_manager/update_user/$1';
$route['user_management/control_manager/archive'] = 'user_management/control_manager/archive';
$route['user_management/control_manager/get_useredit_form/(:num)'] = 'user_management/control_manager/get_useredit_form/$1';
$route['user_management/audit_trail'] = 'user_management/audit_trail/index';

/* file_maintenance */
$route['file_maintenance/company_info'] = 'file_maintenance/company';
$route['file_maintenance/company_info/edit/(:num)'] = 'file_maintenance/company/edit/$1';
$route['file_maintenance/company_info/update/(:num)'] = 'file_maintenance/company/update/$1';

$route['file_maintenance/department'] = 'file_maintenance/department';
$route['file_maintenance/department/new_department'] = 'file_maintenance/department/new_department';
$route['file_maintenance/department/created_dept'] = 'file_maintenance/department/create_dept';
$route['file_maintenance/department/archive'] = 'file_maintenance/department/archive';
$route['file_maintenance/department/update/(:num)'] = 'file_maintenance/department/update/$1';
$route['file_maintenance/department/delete/(:num)'] = 'file_maintenance/department/delete/$1';
$route['file_maintenance/department/restore/(:num)'] = 'file_maintenance/department/restore/$1';
$route['file_maintenance/department/get_deptedit_form/(:num)'] = 'file_maintenance/department/get_deptedit_form/$1';

$route['file_maintenance/area'] = 'file_maintenance/area';
$routes['file_maintenance/area/new_area'] = 'file_maintenance/area/new_area';
$routes['file_maintenance/area/create_area'] = 'file_maintenance/area/create_area';
$route['file_maintenance/area/delete/(:num)'] = 'file_maintenance/area/delete/$1';
$route['file_maintenance/area/get_area_edit_form/(:num)'] = 'file_maintenance/area/get_area_edit_form/$1';

$route['file_maintenance/employee_status'] = 'file_maintenance/employee_status';
$routes['file_maintenance/employee_status/new_employee_status'] = 'file_maintenance/employee_status/new_employee_status';
$routes['file_maintenance/employee_status/create_employee_status'] = 'file_maintenance/employee_status/create_employee_status';
$route['file_maintenance/employee_status/delete/(:num)'] = 'file_maintenance/employee_status/delete/$1';
$route['file_maintenance/employee_status/get_employee_status_edit_form/(:num)'] = 'file_maintenance/employee_status/get_employee_status_edit_form/$1';

$route['file_maintenance/position'] = 'file_maintenance/position';
$routes['file_maintenance/position/new_position'] = 'file_maintenance/position/new_position';
$routes['file_maintenance/position/create_position'] = 'file_maintenance/position/create_position';
$route['file_maintenance/position/delete/(:num)'] = 'file_maintenance/position/delete/$1';
$route['file_maintenance/position/get_position_edit_form/(:num)'] = 'file_maintenance/position/get_position_edit_form/$1';

$route['file_maintenance/unit'] = 'file_maintenance/unit';
$routes['file_maintenance/unit/new_position'] = 'file_maintenance/unit/new_position';
$routes['file_maintenance/unit/create_unit'] = 'file_maintenance/unit/create_position';
$route['file_maintenance/unit/delete/(:num)'] = 'file_maintenance/unit/delete/$1';
$route['file_maintenance/unit/get_unit_edit_form/(:num)'] = 'file_maintenance/unit/get_unit_edit_form/$1';

$route['file_maintenance/city'] = 'file_maintenance/city';
$route['file_maintenance/city/new_city'] = 'file_maintenance/city/new_city';
$route['file_maintenance/city/create_city'] = 'file_maintenance/city/create_city';
$route['file_maintenance/city/delete/(:num)'] = 'file_maintenance/city/delete/$1';
$route['file_maintenance/city/get_city_edit_form/(:num)'] = 'file_maintenance/city/get_city_edit_form/$1';

$route['file_maintenance/industry'] = 'file_maintenance/industry';
$route['file_maintenance/industry/new_industry'] = 'file_maintenance/industry/new_industry';
$route['file_maintenance/industry/create_industry'] = 'file_maintenance/industry/create_industry';
$route['file_maintenance/industry/delete/(:num)'] = 'file_maintenance/industry/delete/$1';
$route['file_maintenance/industry/get_industry_edit_form/(:num)'] = 'file_maintenance/industry/get_industry_edit_form/$1';

$route['file_maintenance/location'] = 'file_maintenance/location';
$route['file_maintenance/location/new_location'] = 'file_maintenance/location/new_location';
$route['file_maintenance/location/create_location'] = 'file_maintenance/location/create_location';
$route['file_maintenance/location/delete/(:num)'] = 'file_maintenance/location/delete/$1';
$route['file_maintenance/location/get_location_edit_form/(:num)'] = 'file_maintenance/location/get_location_edit_form/$1';

$route['file_maintenance/customer'] = 'file_maintenance/customer';
$route['file_maintenance/customer/new_customer'] = 'file_maintenance/customer/new_customer';
$route['file_maintenance/customer/create_customer'] = 'file_maintenance/customer/create_customer';
$route['file_maintenance/customer/delete/(:num)'] = 'file_maintenance/customer/delete/$1';
$route['file_maintenance/customer/get_customer_edit_form/(:num)'] = 'file_maintenance/customer/get_customer_edit_form/$1';

$route['file_maintenance/category'] = 'file_maintenance/category';
$route['file_maintenance/category/new_category'] = 'file_maintenance/category/new_category';
$route['file_maintenance/category/create_category'] = 'file_maintenance/category/create_category';
$route['file_maintenance/category/delete/(:num)'] = 'file_maintenance/category/delete/$1';
$route['file_maintenance/category/get_category_edit_form/(:num)'] = 'file_maintenance/category/get_category_edit_form/$1';

$route['file_maintenance/sub_category'] = 'file_maintenance/sub_category';
$route['file_maintenance/sub_category/new_sub_category'] = 'file_maintenance/sub_category/new_sub_category';
$route['file_maintenance/sub_category/create_sub_category'] = 'file_maintenance/sub_category/create_sub_category';
$route['file_maintenance/sub_category/delete/(:num)'] = 'file_maintenance/sub_category/delete/$1';
$route['file_maintenance/sub_category/get_sub_category_edit_form/(:num)'] = 'file_maintenance/sub_category/get_sub_category_edit_form/$1';

$route['file_maintenance/brand'] = 'file_maintenance/brand';
$route['file_maintenance/brand/new_brand'] = 'file_maintenance/brand/new_brand';
$route['file_maintenance/brand/create_brand'] = 'file_maintenance/brand/create_brand';
$route['file_maintenance/brand/delete/(:num)'] = 'file_maintenance/brand/delete/$1';
$route['file_maintenance/brand/get_brand_edit_form/(:num)'] = 'file_maintenance/brand/get_brand_edit_form/$1';

$route['inventory/items'] = 'inventory/items';
$route['inventory/items/get_new_item_form'] = 'inventory/items/get_new_item_form';
$route['inventory/items/create_item'] = 'inventory/items/create_item';
$route['inventory/items/delete/(:num)'] = 'inventory/items/delete/$1';
$route['inventory/items/get_item_edit_form/(:num)'] = 'inventory/items/get_item_edit_form/$1';

$route['sample/file_upload'] = 'sample/file_upload';
$route['sample/file_upload/do_upload'] = 'sample/file_upload/do_upload';

$route['file_maintenance/company_info'] = 'file_maintenance/accounts';
$route['file_maintenance/company_info'] = 'file_maintenance/earning';
$route['file_maintenance/company_info'] = 'file_maintenance/deduction';
$route['file_maintenance/company_info'] = 'file_maintenance/customer_type';
$route['file_maintenance/company_info'] = 'file_maintenance/area';
$route['file_maintenance/company_info'] = 'file_maintenance/currency';

$route['file_maintenance/currency'] = 'file_maintenance/currency';
$route['file_maintenance/currency/new_currency'] = 'file_maintenance/currency/new_currency';
$route['file_maintenance/currency/create_currency'] = 'file_maintenance/currency/create_currency';
$route['file_maintenance/currency/delete/(:num)'] = 'file_maintenance/currency/delete/$1';
$route['file_maintenance/currency/get_currency_edit_form/(:num)'] = 'file_maintenance/currency/get_currency_edit_form/$1';

$route['file_maintenance/earning'] = 'file_maintenance/earning';
$route['file_maintenance/earning/new_earning'] = 'file_maintenance/earning/new_earning';
$route['file_maintenance/earning/create_earning'] = 'file_maintenance/earning/create_earning';
$route['file_maintenance/earning/delete/(:num)'] = 'file_maintenance/earning/delete/$1';
$route['file_maintenance/earning/get_earning_edit_form/(:num)'] = 'file_maintenance/earning/get_earning_edit_form/$1';

/* end of file maintenance */

/* inventory */
$route['inventory/products'] = 'inventory/products';
$route['product/new_product'] = 'product/new_product';
$route['product/create_product'] = 'product/create_product';
$route['product/delete/(:num)'] = 'product/delete/$1';
$route['product/get_product_edit_form/(:num)'] = 'product/get_product_edit_form/$1';
/* end of inventory */


/* End of file routes.php */
/* Location: ./application/config/routes.php */