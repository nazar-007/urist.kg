<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'users';

$route['themes/(:num)'] = 'themes/index/$1';

$route['one_theme/(:num)'] = 'themes/one_theme/$1';
$route['one_new/(:num)'] = 'news/one_new/$1';
$route['one_report/(:num)'] = 'reports/one_report/$1';
$route['one_lawyer/(:num)'] = 'lawyers/one_lawyer/$1';

$route['update_lawyer/(:num)'] = 'lawyers/update_lawyer/$1';
$route['update_lawyer_process'] = 'lawyers/update_lawyer_process';

$route['pdf_category'] = 'pdf_file/pdf_cats';
$route['pdf_category_files'] = 'pdf_file/pdf_one_cats';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;