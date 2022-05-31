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

$route['default_controller'] = "welcome";
$route['new-session'] = "welcome/new_session";
$route['add-class'] = "welcome/add_class";
$route['add-student'] = "welcome/add_student";
$route['add-subject'] = "welcome/add_subject";
$route['assign-subject'] = "welcome/assign_subject";
$route['update-first-test'] = "welcome/update_first_test";
$route['update-second-test'] = "welcome/update_second_test";
$route['update-third-test'] = "welcome/update_third_test";
$route['update-exam'] = "welcome/update_exam";
$route['uft/(:num)/(:num)'] = "welcome/uft/$1/$2";
$route['ust/(:num)/(:num)'] = "welcome/ust/$1/$2";
$route['utt/(:num)/(:num)'] = "welcome/utt/$1/$2";
$route['uex/(:num)/(:num)'] = "welcome/uex/$1/$2";
$route['student-profile'] = "welcome/student_profile";
$route['student-profile/(:num)'] = "welcome/student_profile/$1";
$route['profile/(:num)'] = "welcome/profile/$1";
$route['delete-profile/(:num)'] = "welcome/delete_profile/$1";
$route['position-students'] = "welcome/set_aggregate";
$route['result-preview'] = "welcome/result_preview";
$route['result-preview/(:num)/(:num)/(:num)/(:num)'] = "welcome/result_preview/$1/$2/$3/$4"; ///class-id/student-id/term-id/session-id
$route['result-preview-all/(:num)/(:num)/(:num)'] = "welcome/result_preview_all/$1/$2/$3";///class-id/term-id/session-id
$route['generate-pdf/(:num)/(:num)/(:num)'] = "welcome/generate_pdf/$1/$2/$3";
////////////////////////////////////////////////////////////
$route['install'] = "admin/install";
$route['settings'] = "admin/settings";
$route['staff-settings'] = "admin/staff_settings";


///////////////////////////////////////////////////////////
$route['ajax-student-list/(:num)'] = "ajax_ctrl/student_list/$1";
$route['ajax-student-list/(:num)/(:any)'] = "ajax_ctrl/student_list/$1/$2";
$route['logout'] = "welcome/logout";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */