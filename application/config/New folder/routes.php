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

/** Routes for admin **/

$route['admin'] = "admin/home";
$route['admin/login'] = "admin/home/admin_login";
$route['admin/logout'] = "admin/home/logout";


$route['admin/admin/add'] = "admin/admin/addadmin";
$route['admin/admin/detail'] = "admin/admin/view_admindetail";
$route['admin/admin/(:num)'] = "admin/admin/edit";
$route['admin/admin/update/(:any)'] = "admin/admin/update/";
$route['admin/admin/delete/(:any)'] = "admin/admin/delete/";


$route['admin/members'] = "admin/members/index";
$route['admin/members/(:any)'] = "admin/members/index";
$route['admin/members/add'] = "admin/members/addmember";
$route['admin/members/(:num)'] = "admin/members/edit";
$route['admin/members/detail/(:any)'] = "admin/members/view_userdetail";
$route['admin/members/filter/(:any)'] = "admin/members/filter";
$route['admin/members/update/(:any)'] = "admin/members/update/";

/** Routes for settings **/
$route['admin/settings'] = "admin/settings/display";
$route['admin/settings/update'] = "admin/settings/update";
/** Ends Routes for settings **/
$route['admin/members/export'] = "admin/members/export";
$route['admin/members/import'] = "admin/members/import";
$route['admin/members/export_members'] = "admin/members/export_members";
$route['admin/members/download_export_data'] = "admin/members/download_export_data";
$route['admin/members/import_members'] = "admin/members/import_members";

/** Routes for admin ends **/


/* Routes for frontend */

$route['areyou']='kubex/areyou';
$route['show_weight']='kubex/show_weight';
$route['enter_weight']='kubex/enter_weight';
$route['save_current_weight']='kubex/save_current_weight';
$route['complete']='kubex/complete';
$route['checkpin']='kubex/checkpin';

$route['setsession']='kubex/set_sessionkubeid';
$route['logout']='kubex/logout';
$route['(:any)'] = 'kubex/index';

/* Routes for frontend ends */

$route['default_controller'] = "kubex";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */