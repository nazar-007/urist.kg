<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'users';

$route['themes/(:num)'] = 'themes/index/$1';

$route['one_theme/(:num)'] = 'themes/one_theme/$1';
$route['one_new/(:num)'] = 'news/one_new/$1';
$route['pdf_category'] = 'pdf_file/pdf_cats';
$route['pdf_category_files/(:num)'] = 'pdf_file/pdf_one_cats/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;