<?php
	defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

	$route['default_controller'] = 'welcome';

	/*	-------------------------
		Start of Custom Routes..
									*/


	// API auto route for if '_api' suffix is absent in $ctrl name
	$route['api/(.*)'] = function ( $url_path ) {
		$new_url_path = 'api/';

		$url_path = explode( '/', $url_path, 2 );
		$ctrl     = $url_path[0];

		if ( isset( $ctrl ) && ! empty( $ctrl ) ) {
			$ctrl .= ! preg_match( '/_api$/', $ctrl ) ? '_api' : '';  // check $ctrl already have _api suffix else append it

			$new_url_path .= $ctrl;
		} else {
			// maybe: set a default api ctrl

		}

		if ( isset( $url_path[1] ) ) {
			$new_url_path .= '/' . $url_path[1];
		}

		return $new_url_path;

	};

	//$route['api/meliocfg/get/(:any)'] = 'api/meliocfg/get/$1';

	$route['control'] = 'control/Account/dashboard';

/*
	End of Custom Routes..
	------------------------- 	*/


$route['404_override'] = '';

$route['translate_uri_dashes'] = false; // i bet to never activate this not to complicate matters
