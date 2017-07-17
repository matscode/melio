<?php

	if (!defined('BASEPATH'))
		exit('No direct script access allowed');

	/**
	 * Description of CI
	 *
	 * @author Akanji Michael <promatmot@gmail.com>
	 * @package Melio
	 *
	 */
	if (!function_exists('ci')) {

		function ci() {
			$ci =& get_instance();

			return $ci;
		}

	}
