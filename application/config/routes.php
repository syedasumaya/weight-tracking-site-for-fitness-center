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

//$route['admin/adminAddPage'] = "admin/admin/adminAddPage";

$route['admin/members/search'] = "admin/members/search";
$route['admin/members/sortby'] = "admin/members/sortby";
$route['admin/members/sortby/(:any)'] = "admin/members/sortby";
/*route for admin*/
$route['admin/profile/(:any)'] = "admin/admin/profile";
$route['admin/change_pass/(:any)'] = "admin/admin/change_pass";
$route['admin/update_pass/(:any)'] = "admin/admin/update_pass";

$route['admin/admin/add'] = "admin/admin/addadmin";
$route['admin/admin/detail'] = "admin/admin/view_admindetail";
$route['admin/admin/(:num)'] = "admin/admin/edit";
$route['admin/admin/update/(:any)'] = "admin/admin/update/";
$route['admin/admin/delete/(:any)'] = "admin/admin/delete/";

/*route for admin location*/
$route['admin/location'] = "admin/location/add_location_page";
$route['admin/location_detail'] = "admin/location/location_detail";

$route['admin/add_location'] = "admin/location/add_location";
$route['admin/view_location/(:any)'] = "admin/location/view_location_sequence";
$route['admin/add_location_sequence/(:any)'] = "admin/location/add_location_sequence";

$route['admin/edit_location/(:any)'] = "admin/location/edit_location";
$route['admin/update_location/(:any)'] = "admin/location/update_location";
$route['admin/delete_location/(:any)'] = "admin/location/delete_location";

$route['admin/edit_sequence/(:any)'] = "admin/location/edit_sequence";
$route['admin/update_sequence/(:any)'] = "admin/location/update_sequence";
$route['admin/delete_sequence/(:any)/(:any)'] = "admin/location/delete_sequence";

/** Routes for settings **/
$route['admin/settings'] = "admin/settings/display";
$route['admin/add_settings'] = "admin/settings/add_settings_page";
$route['admin/new_settings_add'] = "admin/settings/new_settings_add";
$route['admin/edit_settings/(:any)'] = "admin/settings/edit_settings";
$route['admin/update_settings/(:any)'] = "admin/settings/update";
$route['admin/delete_settings/(:any)'] = "admin/settings/delete_settings";
/** Ends Routes for settings **/


$route['admin/dashboard']  = "admin/members/dashboard";
$route['admin/members'] = "admin/members/index";
$route['admin/members/(:any)'] = "admin/members/index";
$route['admin/members/add'] = "admin/members/addmember";
$route['admin/membersedit/(:any)'] = "admin/members/edit";
$route['admin/membersdelete/(:any)'] = "admin/members/delete";
$route['admin/membersview/detail/(:any)'] = "admin/members/view_userdetail";
$route['admin/membersfil/filter/(:any)'] = "admin/members/filter";
$route['admin/membersupdate/update/(:any)'] = "admin/members/update/";

$route['admin/members/export'] = "admin/members/export";
$route['admin/members/import'] = "admin/members/import";
$route['admin/members/export_members'] = "admin/members/export_members";
$route['admin/members/download_export_data'] = "admin/members/download_export_data";
$route['admin/members/import_members'] = "admin/members/import_members";

/** Routes for admin ends **/
//$route['location/SGU']='kubex/select_SGU_sequence';
//$route['select_OGD_sequence']='kubex/select_OGD_sequence';

/* Routes for frontend */

$route['areyou']='kubex/areyou';
//$route['location/OGD/areyou']='kubex/areyou';
$route['getLocation/(:any)']='kubex/get_location';
$route['show_weight']='kubex/show_weight';
$route['sameweight']='kubex/sameweight';
$route['prev_weight']='kubex/prev_weight';
$route['show_weight/(:any)']='kubex/show_weight';
$route['enter_weight']='kubex/enter_weight';
$route['save_current_weight']='kubex/save_current_weight';
$route['complete']='kubex/complete';
$route['checkpin']='kubex/checkpin';
$route['error']='kubex/error';
$route['enterpin']='kubex/enter_pin';
//$route['location/OGD/enterPIN/(:any)']='kubex/enter_pin';

$route['setsession']='kubex/set_sessionkubeid';
$route['logout']='kubex/logout';
//$route['sgu'] = 'kubex/select_SGU_sequence';
//$route['ogd'] = 'kubex/select_OGD_sequence';
$route['set_initial_data'] = 'kubex/set_initial_data';
//$route['set_initial_data'] = 'kubex/set_initial_data_ogd';

/* Routes for frontend ends */

$route['default_controller'] = "kubex";
$route['404_override'] = '';

$route['(:any)'] = 'kubex/location';


/* End of file routes.php */
/* Location: ./application/config/routes.php */