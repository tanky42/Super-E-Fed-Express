<?php defined('BASEPATH') or die('No direct script access.');

/**
 * Developer's Toolbar
 *
 * The CI Developer's Toolbar is a replica of CI Profiler Library 
 * with additional functionality in order to help development teams 
 * with debugging and optimization.
 *
 * @package		CodeIgniter
 * @subpackage	Hooks
 * @category	Hooks-display_override
 * @author		Luis De Aveiro
 * @link		http://ci-developer.com/user-guide/
 */
class developer_toolbar_hook {	

/*
 * ------------------------------------------------------
 *  Define CodeIgniter Object
 * ------------------------------------------------------
 */
	var $CI;
	
/*
 * ------------------------------------------------------
 *  Define the Developer's Toolbar Version
 * ------------------------------------------------------
 */
	var $version = '1.0';

/*
 * ------------------------------------------------------
 *  Define Required CodeIgniter Helpers
 * ------------------------------------------------------
 */	
	var $helpers = array('date', 'url', 'html', 'string', 'number', 'text');

/*
 * ------------------------------------------------------
 *  Define CodeIgniter Helpers
 * ------------------------------------------------------
 */	
	var $CI_helpers = array('array', 'captcha', 'cookie', 'date', 'directory', 'download', 'email', 'file', 'form', 'html', 'inflector', 
							'language', 'number', 'path', 'security', 'smiley', 'string', 'text', 'typography', 'url', 'xml');

/*
 * ------------------------------------------------------
 *  Define CodeIgniter Configuration
 * ------------------------------------------------------
 */
	var $CI_config = array('base_url', 'index_page', 'uri_protocol', 'url_suffix', 'language', 'charset', 'enable_hooks', 'subclass_prefix',
							'permitted_uri_chars', 'allow_get_array', 'enable_query_strings', 'controller_trigger', 'function_trigger', 
							'directory_trigger', 'log_threshold', 'log_path', 'log_date_format', 'cache_path', 'encryption_key', 
							'sess_cookie_name', 'sess_expiration', 'sess_expire_on_close', 'sess_encrypt_cookie', 'sess_use_database',
							'sess_table_name', 'sess_match_ip', 'sess_match_useragent', 'sess_time_to_update', 'cookie_prefix', 'cookie_domain',
							'cookie_path', 'cookie_secure', 'global_xss_filtering', 'csrf_protection', 'csrf_token_name', 'csrf_cookie_name', 
							'csrf_expire', 'compress_output', 'time_reference', 'rewrite_short_tags', 'proxy_ips');

/*
 * ------------------------------------------------------
 *  Define CodeIgniter Email Configuration
 * ------------------------------------------------------
 */	
	var $CI_email_config = array('useragent', 'protocol', 'mailpath', 'smtp_host', 'smtp_user', 'smtp_pass', 'smtp_port', 'smtp_timeout',
								 'wordwrap', 'wrapchars', 'mailtype', 'charset', 'validate', 'priority', 'crlf', 'newline', 'bcc_batch_mode',
								 'bcc_batch_size');

/*
 * ------------------------------------------------------
 *  Define CodeIgniter Database Configuration
 * ------------------------------------------------------
 */	
	var $CI_database_config = array('hostname', 'username', 'password', 'database', 'dbdriver' , 'dbprefix', 'db_debug', 'cache_on', 
									'cache_dir', 'char_set', 'dbcollat', 'swap_pre', 'autoinit', 'stricton', 'port');							
/*
 * ------------------------------------------------------
 *  Define Developer's Toolbar Configuration (Config file)
 * ------------------------------------------------------
 */		
	var	$developer_toolbar_config = array('debug_mode', 'debug_sections', 'developer_toolbar_stylesheet_folder', 
										  'developer_toolbar_javasript_folder', 'developer_toolbar_jquery_no_conflict',
										  'developer_toolbar_template_folder');					

/*
 * ------------------------------------------------------
 *  Store Debug Sections (Default or Config settings) 
 * ------------------------------------------------------
 */
	var $sections = array();

/*
 * ------------------------------------------------------
 *  Store Selected Debug Sections
 * ------------------------------------------------------
 */	
	var $selected_sections = array();

/*
 * ------------------------------------------------------
 *  Store Debug data
 * ------------------------------------------------------
 */		
	var $data = array();

/*
 * ------------------------------------------------------
 *  Define Supported Debug Sections
 * ------------------------------------------------------
 */	
	var $default_sections = array(
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
 * ------------------------------------------------------
 *  Define Debug Sections Descriptions
 * ------------------------------------------------------
 */
	var $description = array(
		'auto_load'			=> 'Auto-load permits config, libraries, helpers, models, and languages 
								to be initialized automatically every time the system runs',				
		'benchmarks' 		=> 'Elapsed time of Benchmark points and total execution time',
		'config' 			=> 'List of CodeIgniter, Email, and Custom configuration variables',
		'controller_info'	=> 'The Controller class and method requested',
		'database'			=> 'List database configuration settings. Listing of all database queries executed, 
								including execution time',
		'hooks'				=> 'Hooks feature provides a means to tap into and modify the inner workings 
								of the framework without hacking the core files',						
		'loader'			=> 'All config, libraries, helpers, and models are loaded for the Controller class 
								and method requested, including "Auto-load"',
		'memory_usage'		=> 'Amount of memory consumed by the current request, in megabytes',
		'request_data'		=> 'Any COOKIE, FILES, GET, POST data passed in the request',
		'request_headers'	=> 'Fetch HTTP request headers for the current request',
		'uri_string'		=> 'The URI segments of the current request'	
	);

/*
 * ------------------------------------------------------
 *  Store Debug data views
 * ------------------------------------------------------
 */		
	var $views = array();	
	
/*
 * ------------------------------------------------------
 *  Define Stylesheet Folder
 * ------------------------------------------------------
 */
	var $stylesheet_folder = 'css/developer_toolbar/';

/*
 * ------------------------------------------------------
 *  Define Developer's Toolbar Stylesheets
 * ------------------------------------------------------
 */
	var $stylesheets = array('dev_tool_reset', 'dev_tool_slide', 'dev_tool_menu', 'dev_tool_style');

/*
 * ------------------------------------------------------
 *  Define JavaScript Folder
 * ------------------------------------------------------
 */
	var $javascript_folder = 'js/developer_toolbar/';

/*
 * ------------------------------------------------------
 *  Define Developer's Toolbar JavaScripts
 * ------------------------------------------------------
 */	
	var $javascripts = array('core', 'slide', 'menu');

/*
 * ------------------------------------------------------
 *  Define Developer's Toolbar JavaScripts
 * ------------------------------------------------------
 */	
	var $jquery_no_conflict = FALSE;

/*
 * ------------------------------------------------------
 *  Define Developer's Toolbar Template Folder
 * ------------------------------------------------------
 */		
	var $template_folder = 'developer_toolbar/';
		
	/**
	 * Construct
	 *
	 */
	function __construct()
    {
		$this->CI =& get_instance();
    	log_message('debug','Accessing Developer Toolbar hook!');
		
		$this->CI->config->load('developer_toolbar');
		
		$this->CI->load->helper($this->helpers);
			
		if($this->CI->config->item('debug_sections'))
		{
			$this->sections = $this->CI->config->item('debug_sections');
		} 
		else 
		{
			$this->sections = $this->default_sections;
		}
		
		if($this->CI->config->item('developer_toolbar_template_folder'))
		{
			$this->template_folder = $this->CI->config->item('developer_toolbar_template_folder');
		} 
		
		if($this->CI->config->item('developer_toolbar_stylesheet_folder'))
		{
			$this->stylesheet_folder = $this->CI->config->item('developer_toolbar_stylesheet_folder');
		} 
		
		if($this->CI->config->item('developer_toolbar_javascript_folder'))
		{
			$this->javascript_folder = $this->CI->config->item('developer_toolbar_javascript_folder');
		} 
		
		if($this->CI->config->item('developer_toolbar_jquery_no_conflict'))
		{
			$this->jquery_no_conflict = $this->CI->config->item('developer_toolbar_jquery_no_conflict');
		} 
    }
	
	/**
	 * Debug Mode
	 *
	 */
	function debug_mode()
	{
		// Don't load Debug Toolbar if it's an AJAX call.
		// Support older CI versions that don't have $this->input->is_ajax_request() function
		if(CI_VERSION >= '2.0')
		{
			if($this->CI->input->is_ajax_request())
			{
				$this->CI->output->_display();
				return;
			}	
		} 
		else 
		{
			if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'))
			{
				$this->CI->output->_display();
				return;
			}	
		}
		
		// Don't load Debug Toolbar if the STDIN constant is set.
		// Checks to see if the STDIN constant is set, 
		// which is a failsafe way to see if PHP is being run on the command line.
		if(CI_VERSION >= '2.0.2')
		{
			if($this->CI->input->is_cli_request())
			{
				$this->CI->output->_display();
				return;
			}
		}
	
		// Check to see if debug_mode is enabled, and compile each section
		if ($this->CI->config->item('debug_mode'))
		{	
			foreach($this->sections as $section => $option)
			{	
				if(isset($this->default_sections[$section]))
				{
					if($option)
					{
						$this->selected_sections[$section] = ucwords(str_replace(array('_', '-'), ' ', $section));
						$compile_func = "compile_{$section}";
						$this->data[$section] = $this->{$compile_func}();
						$this->views[$section] = $this->load_view($section);				
					}
				}
			}
			
			$developer_toolbar = $this->compile();
			$this->CI->output->append_output($developer_toolbar);
			$this->CI->output->_display();
		}
		else 
		{
			$this->CI->output->_display();
			return;
		}
	}
	
	/**
	 * Compile
	 *
	 * Compile The Developer's Toolbar view files.
	 * 
	 * @access	public
	 * @return	string
	 */
	function compile()
	{	
		$menu_content = array(
			'sections' 		=> $this->selected_sections,
			'data' 			=> $this->data
		);
		
		$menu_view = $this->CI->load->view($this->template_folder.'menu', $menu_content, true);
	
		$content = array(
			'version' 		=> $this->version,
			'stylesheets' 	=> $this->compile_stylesheet(),	
			'javascripts' 	=> $this->compile_javascript(),
			'views'			=> $this->views,
			'menu_view'		=> $menu_view
		);
		
		return $this->CI->load->view($this->template_folder.'slide', $content, true);
	}
	
	/**
	 * Compile JavaScript
	 *
	 * Compile The Developer's Toolbar JavaScript files.
	 * Part of Compile function
	 * 
	 * @access	public
	 * @param	array
	 * @return	array
	 */
	function compile_javascript($output = array())
	{	
		if(!empty($this->javascripts))
		{
			foreach ($this->javascripts as $javascript)
			{
				if($this->jquery_no_conflict)
				{
					$output[] = '<script type="text/javascript" src="'.base_url().$this->javascript_folder.$javascript.'_no_conflict.js" >
								</script>';
				}
				else
				{
					$output[] = '<script type="text/javascript" src="'.base_url().$this->javascript_folder.$javascript.'.js" ></script>';
				}
			}
		}
		return $output;
	}
	
	/**
	 * Compile Stylesheet
	 *
	 * Compile The Developer's Toolbar stylesheet files.
	 * Part of Compile function
	 * 
	 * @access	public
	 * @param	array
	 * @return	array
	 */
	function compile_stylesheet($output = array())
	{
		if(!empty($this->stylesheets))
		{
			foreach ($this->stylesheets as $stylesheet)
			{
				$link = array(
					'href' 	=> base_url().$this->stylesheet_folder.$stylesheet.'.css',
					'rel' 	=> 'stylesheet',
					'type' 	=> 'text/css',
					'media' => 'screen'
				);
				$output[] = link_tag($link);
			}
		}
		return $output;
	}
	
	function load_view($section)
	{
		$content = array(
			'sections' 		=> $this->selected_sections,
			'data' 			=> $this->data,
			'description' 	=> $this->description,
		);
		return $this->CI->load->view($this->template_folder.$section, $content, true);
	}
	
	/**
	 * Compile Auto Load
	 *
	 * Retrieve config, libraries, helpers, models, and languages 
	 * initialized automatically every time the system runs
	 *
	 * @access	public
	 * @param	array
	 * @return	array
	 */
	function compile_auto_load($output = array(), $libraries = array(), $configs = array(), $helpers = array(), 
							   $languages = array(), $models = array())
	{
		$CI_libraries = array('calendar', 'cart', 'database', 'email', 'encryption', 'upload', 'form_validation', 
							  'table', 'image_lib', 'javascript', 'jquery', 'pagination', 'session', 'trackback',
							  'parser', 'typography', 'unit_test','user_agent', 'xmlrpc', 'xmlrpcs', 'zip', 'ftp');					 
		
		if(file_exists(APPPATH.'config/autoload.php'))
		{
			include(APPPATH.'config/autoload.php');
			
			if(isset($autoload['libraries']) && !empty($autoload['libraries']))
			{	
				foreach($autoload['libraries'] as $library)
				{
					$directory = '';
					$sections = explode('/', $library);
					
					if(count($sections) > 1)
					{
						$section = $sections[count($sections) - 1];
						$i = 0;
						
						while($i <= (count($sections) - 2))
						{
							$directory .= $sections[$i].'/';
							$i++;	
						}
					} 
					else 
					{
						$section = $sections[0];
					}
					
					if(in_array($section, $CI_libraries))
					{
						$type = 'CodeIgniter Library';
					}
					else
					{
						$type = 'Custom Library';
					}
					
					if($section == 'database')
					{
						$configs[] = array(
							'config' => 'database',
							'dir' 	 => 'application/config/'
						);	
					}
					
					$libraries[] = array(
						'lib' 	=> $section,
						'type' 	=> $type,
						'dir' 	=> $directory
					);
				}
				
				$output['library'] = $libraries;
				$output['total_library'] = count($libraries);
			}
			
			if(isset($autoload['config']) && !empty($autoload['config']))
			{
				foreach($autoload['config'] as $config)
				{
					$configs[] = array(
						'config' => $config,
						'dir' 	 => 'application/config/'
					);
				}
				
				$output['config'] = $configs;
				$output['total_config'] = count($configs);
			}
			
			if(isset($autoload['helper']) && !empty($autoload['helper']))
			{
				foreach($autoload['helper'] as $helper)
				{
					if(in_array($helper, $this->CI_helpers))
					{
						$type = 'CodeIgniter Helper';
					}
					else
					{
						$type = 'Custom Helper';
					}
					
					$helpers[] = array(
						'helper' => $helper,
						'type' 	 => $type
					);
				}
				$output['helper'] = $helpers;
				$output['total_helper'] = count($helpers);
			}
			
			if(isset($autoload['language']) && !empty($autoload['language']))
			{
				foreach($autoload['language'] as $language)
				{
					$languages[] = array(
						'lang' => $language,
					);
				}
				
				$output['language'] = $languages;
				$output['total_lang'] = count($languages);
			}
			
			if(isset($autoload['model']) && !empty($autoload['model']))
			{
				foreach($autoload['model'] as $model)
				{
					$models[] = array(
						'model' => $model
					);
				}
				
				$output['model'] = $models;
				$output['total_model'] = count($models);
			}
		}
		
		return $output;
	}
	
	/**
	 * Compile Benchmarks
	 *
	 * Retrieve Elapsed time of Benchmark points and total execution time
	 *
	 * @access	public
	 * @param	array
	 * @return	array
	 */
	function compile_benchmarks($profile = array(), $output = array())
	{
		foreach ($this->CI->benchmark->marker as $key => $val)
		{
			// We match the "end" marker so that the list ends
			// up in the order that it was defined
			if (preg_match("/(.+?)_end/i", $key, $match))
			{
				if (isset($this->CI->benchmark->marker[$match[1].'_end']) AND isset($this->CI->benchmark->marker[$match[1].'_start']))
				{
					$profile[$match[1]] = $this->CI->benchmark->elapsed_time($match[1].'_start', $key);
				}
			}
		}
		
		foreach ($profile as $key => $val)
		{
			$key = ucwords(str_replace(array('_', '-'), ' ', $key));
			$output[] = array(
				'field' => $key,
				'data' 	=> $val.' ( seconds )'
			);
		}
		
		$output[] = array(
			'field' => 'Total Execution Time',
			'data' 	=> $this->CI->benchmark->elapsed_time().' ( seconds )'
		);
		
		return $output;
	}
	
	/**
	 * Compile Config
	 *
	 * Retrieve CodeIgniter, Email, Database, Developer's toolbar, Custom configuration
	 *
	 * @access	public
	 * @param	array
	 * @return	string
	 */
	function compile_config($request_data = array('codeigniter', 'email', 'custom'), $output = array())
	{
		foreach ($request_data as $data)
		{
			$compile_func = "compile_config_{$data}";
			$output[] = array(
				'type' 	=> $data,
				'label' => ucwords(str_replace(array('_', '-'), ' ', $data)),
				'data' 	=> $this->{$compile_func}()
			);
		}
		
		return $output;
	}
	
	/**
	 * Compile Config CodeIgniter
	 *
	 * Retrieve CodeIgniter configuration
	 * Part of Compile Config function
	 *
	 * @access	public
	 * @param	array
	 * @return	string
	 */
	function compile_config_codeigniter($output = array())
	{
		foreach($this->CI->config->config as $key => $val)
		{
			if(in_array($key, $this->CI_config))
			{
				if (is_array($val))
				{
					$val = print_r($val, TRUE);
				}
				
				$output[] = array(
					'field' => $key,
					'data' 	=> htmlspecialchars($val)
				);
			}
		}
		return $output;
	}
	
	/**
	 * Compile Config Email
	 *
	 * Retrieve Email configuration
	 * Part of Compile Config function
	 *
	 * @access	public
	 * @param	array
	 * @return	string
	 */
	function compile_config_email($output = array())
	{
		foreach($this->CI->config->config as $key => $val)
		{
			if(in_array($key, $this->CI_email_config))
			{
				if (is_array($val))
				{
					$val = print_r($val, TRUE);
				}
				
				$output[] = array(
					'field' => $key,
					'data' 	=> htmlspecialchars($val)
				);
			}
		}
		return $output;
	}
	
	/**
	 * Compile Config Database
	 *
	 * Retrieve Database configuration
	 * Part of Compile Config function
	 *
	 * @access	public
	 * @param	array
	 * @return	string
	 */
	function compile_config_database($output = array())
	{
		foreach($this->CI->config->config as $key => $val)
		{
			if(in_array($key, $this->CI_database_config))
			{
				if (is_array($val))
				{
					$val = print_r($val, TRUE);
				}
				
				$output[] = array(
					'field' => $key,
					'data' 	=> htmlspecialchars($val)
				);
			}
		}
		return $output;
	}
	
	/**
	 * Compile Config Developer's Toolbar
	 *
	 * Retrieve Developer's Toolbar configuration
	 * Part of Compile Config function
	 *
	 * @access	public
	 * @param	array
	 * @return	string
	 */
	function compile_config_developer_toolbar($output = array())
	{
		foreach($this->CI->config->config as $key => $val)
		{
			if(in_array($key, $this->developer_toolbar_config))
			{
				if (is_array($val))
				{
					$val = print_r($val, TRUE);
				}
				
				$output[] = array(
					'field' => $key,
					'data' 	=> htmlspecialchars($val)
				);
			}
		}
		return $output;
	}
	
	/**
	 * Compile Config Custom
	 *
	 * Retrieve Custom configuration
	 * Part of Compile Config function
	 *
	 * @access	public
	 * @param	array
	 * @return	string
	 */
	function compile_config_custom($output = array())
	{
		foreach($this->CI->config->config as $key => $val)
		{
			if(!in_array($key, $this->CI_config) && !in_array($key, $this->CI_database_config) && 
				!in_array($key, $this->CI_email_config) && !in_array($key, $this->developer_toolbar_config))
			{
				if (is_array($val))
				{
					$val = print_r($val, TRUE);
				}
				
				$output[] = array(
					'field' => $key,
					'data' 	=> htmlspecialchars($val)
				);
			}
		}
		return $output;
	}
	
	/**
	 * Compile Controller Info
	 *
	 * Retrieve the Controller class and method requested
	 *
	 * @access	public
	 * @param	array
	 * @return	array
	 */
	function compile_controller_info($output = array(), $methods = array())
	{
		$output = array(
			array(
				'field' => 'Class',
				'data' 	=> $this->CI->router->fetch_class()
			),
			array(
				'field' => 'Current Method',
				'data' 	=> $this->CI->router->fetch_method()
			)
		);
		
		$class_methods = get_class_methods($this->CI->router->fetch_class());
		foreach ($class_methods as $method_name) {
			
			// TO-DO: FIX condition statement.
			if($method_name == '__construct' || $method_name == 'get_instance') 
			{
			} 
			else 
			{
				if($method_name == 'index')
				{
					if(index_page() != '')
					{
						$link = base_url().$this->CI->router->fetch_class().'/'.index_page();
					}
					else
					{
						$link = base_url().$this->CI->router->fetch_class();
					}
				}
				else
				{
					if(index_page() != '')
					{
						$link = base_url().$this->CI->router->fetch_class().'/'.index_page().'/'.$method_name;
					}
					else
					{
						$link = base_url().$this->CI->router->fetch_class().'/'.$method_name;
					}
				}
				
				$methods[] = array(
					'field' => $method_name,
					'data' 	=> anchor($link, $link)
				);
			}
		}
		$output['methods'] = $methods;
		$output['total_methods'] = count($methods);
		
		return $output;
	}
	
	/**
	 * Compile Database
	 *
	 * Retrieve database configuration settings.
	 * Retrieve of all database queries executed, including execution time
	 *
	 * @access	public
	 * @param	array
	 * @return	data
	 */
	function compile_database($dbs = array(), $output = array(), $sql = array())
	{
		// Let's determine which databases are currently connected to
		foreach (get_object_vars($this->CI) as $CI_object)
		{
			if (is_object($CI_object) && is_subclass_of(get_class($CI_object), 'CI_DB') )
			{
				$dbs[] = $CI_object;
			}
		}
		
		if (count($dbs) == 0)
		{
			$output['database'] = 'Database driver is not currently loaded';
			$output['total'] = 0;
			return $output;
		}
		
		// Key words we want bolded
		$highlight = array('SELECT', 'DISTINCT', 'FROM', 'WHERE', 'AND', 'LEFT&nbsp;JOIN', 'ORDER&nbsp;BY', 'GROUP&nbsp;BY', 'LIMIT', 
							'INSERT','INTO', 'VALUES', 'UPDATE', 'OR&nbsp;', 'HAVING', 'OFFSET', 'NOT&nbsp;IN', 'IN', 'LIKE', 
							'NOT&nbsp;LIKE', 'COUNT', 'MAX', 'MIN', 'ON', 'AS', 'AVG', 'SUM', '(', ')');
		
		foreach ($dbs as $db)
		{
			$output['database'] = $db->database;
			$output['hostname'] = $db->hostname;
			$output['username'] = $db->username;
			$output['password'] = $db->password;
			$output['dbdriver'] = $db->dbdriver;
			//$output['version']  = $db->version();
			$output['dbprefix'] = $db->dbprefix;
			$output['total'] 	= count($db->queries);
			
			if (count($db->queries) != 0)
			{
				foreach ($db->queries as $key => $val)
				{
					$time = number_format($db->query_times[$key], 4);

					foreach ($highlight as $bold)
					{
						$val = str_replace($bold, '<strong>'.$bold.'</strong>', $val);
					}
					
					$sql[] = array(
						'time' 	=> $time.' ( seconds )',
						'sql' 	=> $val
					);
				}
				
				$output['sql'] = $sql;
			}
		}
		
		return $output;
	}
	
	/**
	 * Compile Hooks
	 *
	 * Retrieve all CodeIgniter Hooks
	 *
	 * @access	public
	 * @param	array
	 * @return	array
	 */
	function compile_hooks($output = array(), $hooks = array())
	{
		//Define CodeIgniter hook points
		$hook_points = array('pre_system', 'pre_controller', 'post_controller_constructor', 
							 'post_controller', 'display_override', 'cache_override', 'post_system');
		
		$hooks_ojbect = $GLOBALS['EXT'];
		
		if($hooks_ojbect->enabled == TRUE)
		{
			$loaded_hooks = $hooks_ojbect->hooks;
						
			foreach($hook_points as $point)
			{
				$hooks = array();
				
				if(isset($loaded_hooks[$point]) && !empty($loaded_hooks[$point]))
				{
					foreach($loaded_hooks[$point] as $hook)
					{
						$hooks[] = array(
							'class' 	=> $hook['class'],
							'function' 	=> $hook['function'],
							'filename' 	=> $hook['filename'],
							'filepath' 	=> $hook['filepath']
						);
					}
					
					$output[] = array(
						'point' 		=> $point,
						'label' 		=> ucwords(str_replace(array('_', '-'), ' ', $point)),	
						'total_hooks' 	=> count($hooks),
						'hooks' 		=> $hooks					
					);
				}
			}
		}
		
		return $output;
	}
	
	/**
	 * Compile Loader
	 *
	 * Retrieve config, libraries, helpers, and models 
	 * are loaded for the Controller class and method requested, 
	 * including "Auto-load"
	 *
	 * @access	public
	 * @param	array
	 * @return	array
	 */
	function compile_loader($output = array(), $configs = array(), $libraries = array(), $helpers = array(), $models = array())
	{
		$config_object = $GLOBALS['CFG'];
		$loaded = $config_object->is_loaded;
				
		foreach($loaded as $config)
		{
			$i = 0;
			$directory = '';	
			$sections = explode('/', $config);	
			while($i <= (count($sections) - 1))
			{
				if(strpos($sections[$i], '.php'))
				{
					$config_file = substr($sections[$i], 0, -4);
				} else {
					$directory .= $sections[$i].'/';
				}
				$i++;
			}
			
			$configs[] = array(
				'config' => $config_file,
				'dir' 	 => $directory
			);
		}
		
		$output['config'] = $configs;
		$output['total_config'] = count($configs);
		
		$CI = $GLOBALS['CI'];
		$load = $CI->load;
		$loaded_files = $load->_ci_loaded_files;
		
		foreach($loaded_files as $library)
		{
			$i = 0;	
			$sections = explode('/', $library);
			while($i <= (count($sections) - 1))
			{
				if(strpos($sections[$i], '.php'))
				{
					$library_file = substr($sections[$i], 0, -4);
				}
				$i++;
			}
			
			if(strpos($library, 'system'))
			{
				$type = 'CodeIgniter Library';
			} 
			else
			{
				$type = 'Custom Library';
			}
			
			$libraries[] = array(
				'lib' 	=> $library_file,
				'type' 	=> $type
			);
		}
		
		$output['library'] = $libraries;
		$output['total_library'] = count($libraries);
		
		$loaded_helpers =$load->_ci_helpers;
		foreach($loaded_helpers as $helper => $option)
		{
			$section = substr($helper, 0, -7);
			if(in_array($section, $this->CI_helpers))
			{
				$type = 'CodeIgniter Helper';
			}
			else
			{
				$type = 'Custom Helper';
			}
			if($section != '')
			{
				$helpers[] = array(
					'helper' => $section,
					'type' 	 => $type
				);
			}
		}
		$output['helper'] = $helpers;
		$output['total_helper'] = count($helpers);
		
		$loaded_models = $load->_ci_models;
		foreach($loaded_models as $model)
		{
			$models[] = array(
				'model' => $model
			);
		}
		
		$output['model'] = $models;
		$output['total_model'] = count($models);
		
		return $output;
	}
	
	/**
	 * Compile Memory Usage
	 *
	 * Retrieve Memory Usage consumed by the current request, in megabytes
	 *
	 * @access	public
	 * @return	string
	 */
	function compile_memory_usage()
	{
		$output = array(
			array(
				'field' => 'Memory Usage',
				'data' 	=> $this->CI->benchmark->memory_usage()
			)
		);
		
		return $output;
	}
	
	/**
	 * Compile Request Data
	 *
	 * Retrieve Any COOKIE, FILES, GET, POST data passed in the request
	 *
	 * @access	public
	 * @param	array
	 * @return	string
	 */
	function compile_request_data($request_data = array('get', 'post'), $output = array())
	{
		foreach ($request_data as $data)
		{
			$compile_func = "compile_{$data}";
			$output[] = array(
				'type' 	=> $data,
				'label' => '&#36;_'.strtoupper($data),
				'data' 	=> $this->{$compile_func}()
			);
		}
		
		return $output;
	}
	
	/**
	 * Compile GET
	 *
	 * Retrieve Any GET data passed in the request,
	 * Part of Compile Request Data function
	 *
	 * @access	public
	 * @param	array
	 * @return	string
	 */
	function compile_get($output = array(), $data = array())
	{
		if (count($_GET) == 0)
		{
			$output['total'] = 'No GET data exists';
		} 
		else 
		{
			$output['total'] = count($_GET);
			foreach ($_GET as $key => $val)
			{
				if ( ! is_numeric($key))
				{
					$key = " ' ".$key." ' ";
				}
				
				if (is_array($val))
				{
					$val = "<pre>" . htmlspecialchars(stripslashes(print_r($val, TRUE))) . "</pre>";
				}
				else 
				{
					$val = htmlspecialchars(stripslashes($val));
				}
				
				$data[] = array(
					'variable' 	=> '&#36;_GET['.$key.']',
					'value' 	=> $val
				);
			}
			
			$output['data'] = $data;
		}
		
		return $output;
	}
	
	/**
	 * Compile POST
	 *
	 * Retrieve Any POST data passed in the request,
	 * Part of Compile Request Data function
	 *
	 * @access	public
	 * @param	array
	 * @return	string
	 */
	function compile_post($output = array(), $data = array())
	{
		if (count($_POST) == 0)
		{
			$output['total'] = 'No POST data exists';
		} 
		else 
		{
			$output['total'] = count($_POST);
			foreach ($_POST as $key => $val)
			{
				if ( ! is_numeric($key))
				{
					$key = " ' ".$key." ' ";
				}
				
				if (is_array($val))
				{
					$val = "<pre>" . htmlspecialchars(stripslashes(print_r($val, TRUE))) . "</pre>";
				}
				else 
				{
					$val = htmlspecialchars(stripslashes($val));
				}
				
				$data[] = array(
					'variable' 	=> '&#36;_POST['.$key.']',
					'value' 	=> $val
				);
			}
			
			$output['data'] = $data;
		}
		
		return $output;
	}
	
	/**
	 * Compile Request Headers
	 *
	 * Retrieve HTTP request headers for the current request
	 *
	 * @access	public
	 * @param	array
	 * @return	array
	 */
	function compile_request_headers($excludes = array('Cookie'), $output = array())
	{
		foreach($this->CI->input->request_headers() as $key => $val) {
			if(!in_array($key, $excludes))
			{
				$output[] = array(
					'field' => $key,
					'data' 	=> $val
				);
			}
		}
		return $output;
	}
	
	/**
	 * Compile URI String
	 *
	 * Retrieve the URI segments of the current request
	 *
	 * @access	public
	 * @return	array
	 */
	function compile_uri_string()
	{
		$output = array(
			array(
				'field' => 'Current URL',
				'data' 	=> anchor(current_url(), current_url())
			),
			array(
				'field' => 'Base URL',
				'data' 	=> anchor(base_url(), base_url())
			),
			array(
				'field' => 'URI segments',
				'data' 	=> uri_string()
			),
			
		);
		
		if(index_page() != '')
		{
			$output[] = array(
				'field' => 'Index page',
				'data' 	=> index_page()
			);	
		}
		
		return $output;
	}
}