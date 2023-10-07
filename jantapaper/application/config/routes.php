<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['default_controller'] = 'home';
$route['login'] = 'admin/login/index';

$route['dashboard'] = 'admin/dashboard';
$route['client'] = 'admin/client/index';
$route['createClient'] = 'admin/client/create';
$route['staff'] = 'admin/staff/index';
$route['user'] = 'admin/users/index';
$route['userLogin'] = 'admin/users/login';
$route['users/authenticate'] = 'admin/users/authenticate';
$route['createStaff'] = 'admin/staff/create';
$route['staff_login'] = 'admin/staff_login';
$route['cart'] = 'order/cart';
$route['removeFromCart/(:num)'] = 'order/removeItemFromCart/$1';

$route['placeOrder'] = 'order/placeOrder';
$route['placeOrder/(:num)'] = 'order/placeOrder/$1';
$route['order_details/(:num)'] = 'order/orderDetails/$1';
$route['deliveryChalan/(:num)'] = 'order/generateDeliveryChalan/$1';
$route['view_order'] = 'order/viewOrders';
$route['reusable'] = "admin/reusable/index";
$route['mark_as/(:num)/(:num)'] = 'admin/reusable/mark_as/$1/$2';
$route['fetchAddress/(:num)'] = 'order/fetchAddress/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
