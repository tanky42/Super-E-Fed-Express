<?php defined('BASEPATH') or die('No direct script access.');

/*
|--------------------------------------------------------------------------
| Developer's Toolbar
|--------------------------------------------------------------------------
|
| The Developer's Toolbar has similar functionality to CodeIgniter Profiler Class.
|
| $config['debug_mode'] = TRUE;	 -	Enable Developer's Toolbar
| $config['debug_mode'] = FALSE; -	Disable Developer's Toolbar
*/
$config['debug_mode'] = TRUE;

/*
|--------------------------------------------------------------------------
| Debug Sections
|--------------------------------------------------------------------------
|
| This option allows you to add specific sections into the Developer's Toolbar
| For more information please see the user guide:
|
| http://codeigniter.com/user_guide/general/profiling.html
*/
$config['debug_sections'] = array(
	'auto_load'			=> TRUE,
	'benchmarks' 		=> TRUE,
	'config' 			=> TRUE,
	'controller_info' 	=> TRUE,
	'database'			=> TRUE,
	'hooks'				=> TRUE,
	'loader'			=> TRUE,
	'memory_usage'		=> TRUE,
	'request_data'		=> TRUE,
	'request_headers'	=> TRUE,
	'uri_string'		=> TRUE
);

/*
|--------------------------------------------------------------------------
| Template Folder
|--------------------------------------------------------------------------
|
| This option allows you to specify the directory of the Developer's Toolbar
| template files.
*/
$config['developer_toolbar_template_folder'] = 'developer_toolbar/';

/*
|--------------------------------------------------------------------------
| Stylesheet Folder
|--------------------------------------------------------------------------
|
| This option allows you to specify the directory of the Developer's Toolbar
| Stylesheet files.
*/
$config['developer_toolbar_stylesheet_folder'] = 'css/developer_toolbar/';

/*
|--------------------------------------------------------------------------
| JavaScript Folder
|--------------------------------------------------------------------------
|
| This option allows you to specify the directory of the Developer's Toolbar
| javascript files.
*/
$config['developer_toolbar_javascript_folder'] = 'js/developer_toolbar/';

/*
|--------------------------------------------------------------------------
| jQuery noConflict();
|--------------------------------------------------------------------------
|
| Many JavaScript libraries use $ as a function or variable name, just as jQuery does. 
| In jQuery's case, $ is just an alias for jQuery, so all functionality is available 
| without using $. If we need to use another JavaScript library alongside jQuery, 
| we can return control of $ back to the other library with a call to $.noConflict()
|
| $config['developer_toolbar_jquery_no_conflict'] = TRUE;	-	Enable jQuery noConflict()
| $config['developer_toolbar_jquery_no_conflict'] = FALSE; 	-	Disable jQuery noConflict()
*/
$config['developer_toolbar_jquery_no_conflict'] = FALSE;