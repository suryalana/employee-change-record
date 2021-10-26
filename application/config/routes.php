<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['ecr'] = 'c_index';

// Authentication Routes
$route['login'] = 'c_authentication/login';

$route['logout'] = 'c_authentication/logout';

$route['approve'] = 'c_index/Approve';

$route['hrd'] = 'c_index/Hrd';


// $route['default_controller'] = 'c_index';
$route['default_controller'] = 'c_index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
