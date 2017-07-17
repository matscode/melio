<?php

	/**
	 * Description of Security Helper
	 *
	 * @author Akanji Michael <promatmot@gmail.com>
	 * @package Melio
	 *
	 */
	if (!function_exists('sanitize')) {

		function sanitize($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
			return $data;
		}

	}

	if (!function_exists('remove_whitespace')) {

		function remove_whitespace($string) {
			return $clean_string = preg_replace('/[ ]/', '', $string);
			// return $clean_string;
		}

	}
