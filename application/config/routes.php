<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = "welcome";
$route['404_override'] = '';
$route['admin'] = "admin/Admin_dashboard";
$route['tutor'] = "tutor/Tutor_dashboard";
$route['operator'] = "operator/Operator_dashboard";
$route['home'] = "front/Dashboard";
$route['course'] = "front/Common_exam";
$route['model_test'] = "front/Cmodel_test";
$route['login'] = "front/Signup/signin";
$route['signup'] = "front/Signup";
$route['personal_exam_statistics'] = "front/User_exam_info/personal_exam_statistics";
$route['model_test_statistics'] = "front/user_exam_info/model_test_statistics";
$route['schedule_exam_statistics'] = "front/user_exam_info/schedule_exam_statistics";
$route['profile'] = "front/User_profile";
$route['exam_schedule'] = "front/User_exam_info/user_schedule_exam";
$route['attend_tutor_provided_exam/(:num)'] = "front/user_exam_info/attend_tutor_provided_exam/$1";
$route['course_exam/(:num)'] = 'front/Common_exam/chapter_list/$1';
$route['model_test_exam/(:num)'] = 'front/Cmodel_test/model_test_details/$1';
$route['exam_result/(:num)'] = "front/User_exam_info/view_personal_exam_result/$1";
$route['profile/edit_full_name'] = "front/User_profile/edit_full_name";
$route['profile/edit_phone_no'] = "front/User_profile/edit_user_cellno";
$route['profile/edit_password'] = "front/User_profile/change_user_password";
$route['translate_uri_dashes'] = FALSE;