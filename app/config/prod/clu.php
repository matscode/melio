<?php
	defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

	/*
	|--------------------------------------------------------------------------
	| CLU ACCESS
	|--------------------------------------------------------------------------
	|
	| if you want to allow calls to command line utility via the url
	| you will have to set this to true
	|
	| WARNING: Always Set to false in Production
	|
	|
	*/
	$config['clu'] =
		[
			'clu_via_url' => false
		];
	