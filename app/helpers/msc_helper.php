<?php
	/**
	 * Created by PhpStorm.
	 * User: mat
	 * Date: 5/15/16
	 * Time: 4:52 PM
	 */

	/**
	 * Return valid timestamp format for migration naming
	 *
	 * @return    string
	 */
	function migration_timestamp()
	{
		return
			date( "YmdHis" );
	}

	function output_json( $data )
	{

		$_ci =& get_instance();

		return $_ci->output
			->set_status_header( 200 )
			->set_content_type( 'application/json', 'utf-8' )
			->set_output( json_encode( $data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) );

	}


