<?php

	if (!defined('BASEPATH'))	exit('No direct script access allowed');
	
	class ResourceAPI
	{
		
		private $_ci;
		
		public function __construct() {
			$this->_ci = ci();
		}
		
		public function allowCors($origin) {
			// setting using the php native function - use the output library after the Tpl library is upgraded
			
			// access is granted to self origin
			header('Access-Control-Allow-Origin: ' . $origin);
			
		}
		
		public function output_json($data)
		{
			return $this->_ci->output
				->set_status_header(200)
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
			
		}
	}
