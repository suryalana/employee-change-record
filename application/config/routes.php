<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['ecr'] = 'c_index';

// Authentication Routes
$route['login'] = 'c_authentication/login';

$route['logout'] = 'c_authentication/logout';

$route['approve'] = 'c_index/Approve';

$route['hrd'] = 'c_index/Hrd';
$route['ubah/(:any)'] = 'c_index/ubah/$1';

$route['doaction'] = 'c_index/doAction';
$route['approval/(:any)/(:any)/(:any)'] = 'c_index/doAction/$1/$2/$3';


$route['test/email'] = 'c_index/sendEmail';


// $route['default_controller'] = 'c_index';
$route['default_controller'] = 'c_authentication/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
