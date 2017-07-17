<?php if ( ! defined( 'BASEPATH' ) ) {
	exit( 'No direct script access allowed' );
}

	class Msc extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();

			// toggle clu usability via http(s)
			if ( ! $this->input->is_cli_request() && $this->config->item( 'clu_via_url', 'clu' ) != true ) {
				show_404();
				exit();
			}

			// Load required Library
			$this->load->library( 'clu' );
		}

		public function index()
		{

			$this->clu->response( 'INFO: No Action defined for Index method', 'red', false, true )->write();

		}

		public function createKey( $byte = 16 )
		{
			$key = bin2hex( $this->Encryption->create_key( $byte ) );

			$this->clu->response( 'Key: ' . $key, 'blue', false, true )->write();

		}

		public function timeStamp( $format = 'unix', $when = 'now' )
		{

			if ( $format != 'unix' ) {
				switch ( $format ) {
					case 'migration':
						$format = 'YmdHis';
						break;
					case 'datetime':
						$format = 'Y-m-d H:i:s';
						break;
					default:
						// maybe isset a time format, thus use
						// $format = $format;
						break;
				}

				// if (!$format) $format = 'd/m/y'; // dd/mm/yyyy: setting default is useless

				$time = date( $format, strtotime( $when ) );
			} else {
				$time = time();
			}

			$this->clu->response( 'Format: ' . $format, 'blue', true, true )
			          ->response( 'Time: ' . $time, 'blue', true, true )
			          ->write();
		}

		public function passwordSample( $password = '' )
		{
			if ( ! $password ) {
				// generate a random password for hash
				$characters_string = '';
				// lower case alphabet
				$characters_string .= 'abcdefghijklmnopqrstuvwxyz';
				// upper case alphabet
				$characters_string .= strtoupper( $characters_string );
				// numbers
				$characters_string .= '0123456789';

				$password = substr( str_shuffle( $characters_string ), 0, 10 );
			}
			// hash password
			$hashed_password = password_hash( $password, PASSWORD_DEFAULT );

			$this->clu->response( $password, 'blue', true, true )
			          ->response( $hashed_password, 'yellow', false, true )
			          ->write();
		}

		public function passwordValid( $password, $hash )
		{

			if ( password_verify( $password, $hash ) ) {
				$this->clu->response( 'Password is Valid', 'green', true, true )
				          ->write();
			} else {
				$this->clu->response( 'Password is not Valid', 'red' )
				          ->error();
			}
		}

	}