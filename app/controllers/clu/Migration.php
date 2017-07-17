<?php
	/**
	 *
	 * Controller written for sequential migration.
	 * In compability mode with timestamp migration - No big issue.
	 *
	 * @package        Melio
	 * @category       Source
	 * @author         Michael Akanji <matscode@gmail.com>
	 * @date           2017-06-18
	 * @copyright (c)  2016 - 2017, TECRUM (http://www.tecrum.com)
	 *
	 */
	if ( ! defined( 'BASEPATH' ) ) {
		exit( 'No direct script access allowed' );
	}

	class Migration extends CI_Controller
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
			$this->load->library( 'migration' );
			// Load required Config File
			$this->load->config( 'migration' );
		}

		public function index()
		{
			// default method on call which will list the versions of migration available..
			// but for now.. its gonna be doing the work of migration installer

			// get migration version
			$mig_version = $this->config->item( 'migration_version' );
			//print the current verion of migration used
			$this->clu->response( 'Migration Version: ' . $mig_version, 'yellow', false, true )->write();
			// do migration
			$migration = $this->migration->current();

			if ( $migration == $mig_version ) {
				$this->clu->response( 'Migration Installed Successfully', 'green', false, true )->write();
			} elseif ( $migration === true ) {
				$this->clu->response( 'Migration not Found', 'red', false, true )->write();
			} else {
				$this->clu->response( $this->migration->error_string(), 'red' )->error();
			}

		}

		public function run( $version = null )
		{
			if ( ! $version || ! is_numeric( $version ) ) {
				$this->clu->response( 'Please specify the Version to Run', 'red' )->error();
				exit();
			}
			//print the current verion of migration used
			$this->clu->response( 'Migration Version: ' . $version, 'yellow', false, true )->write();
			// do migration
			$migration = $this->migration->version( $version );
			if ( $migration == $version ) {
				$this->clu->response( 'Migration Installed Successfully', 'green', false, true )->write();
			} elseif ( $migration == true ) {
				$this->clu->response( 'Migration not Found', 'red' )->write();
			} else {
				$this->clu->response( $this->migration->error_string(), 'red' )->error();
			}

		}

		public function latest()
		{
			// do migration
			$migration = $this->migration->latest();
			//print the current verion of migration used
			$this->clu->response( 'Migration Version: ' . $migration, 'yellow', false, true )->write();
			if ( $migration ) {
				$this->clu->response( 'Migration Installed Successfully', 'green', false, true )->write();
			} else {
				$this->clu->response( $this->migration->error_string(), 'red' )->error();
			}

		}

		public function undo( $step = 1 )
		{
			// get migration version and decreament by 1
			$mig_version = $this->config->item( 'migration_version' ) - $step;
			//print the current verion of migration used
			$this->clu->response( "RollBack Migration Version: " . $mig_version, 'yellow', false, true )->write();

			$migration = $this->migration->version( $mig_version );
			if ( $migration == $mig_version ) {
				$this->clu->response( 'Migration Rolled Back Successfully', 'green', false, true )->write();
			} elseif ( $migration === true ) {
				$this->clu->response( 'Migration not Found', 'red' )->write();
			} else {
				$this->clu->response( $this->migration->error_string(), 'red' )->error();
			}


		}

		public function exists( $version = null )
		{
			// check if any migration exists and show all
			$mig = $this->migration->find_migrations();
			if ( count( $mig ) > 0 ) {
				// check if user set a migration version and return migration name
				if ( $version ) {
					$version = sprintf( "%'03s", $version );
					if ( array_key_exists( $version, $mig ) ) {
						$this->clu->response( 'Version ' )
						          ->response( $version, 'yellow' )
						          ->response( ' exist as ' )
						          ->response( basename( $mig[ $version ] ) . "\n", 'green' );
					} else {
						$this->clu->response( 'Version ', 'red' )
						          ->response( $version, 'yellow' )
						          ->response( ' does not exist' . "\n", 'red' );
					}
				} else {
					foreach ( $mig as $key => $value ) {
						$mig_name_array = explode( "_", basename( $value ), 2 );
						$mig_name       = end( $mig_name_array );

						$this->clu->response( 'Version: ' )
						          ->response( $key, 'yellow', true )
						          ->response( ' => ' )
						          ->response( $mig_name, 'green', true, true );

					}
				}
				// show report
				$this->clu->write();
			} else {
				// error message
				$error_msg = 'No Migration Found';
				// set error message for http out
				$this->clu->response( $error_msg, 'red' )->error();
			}
		}

		public function reset()
		{
			// set migration version
			$mig_version = 0;

			//print the current verion of migration used
			$this->clu->response( "Migration Version: " . $mig_version, 'yellow', false, true )->write();

			$migration = $this->migration->version( $mig_version );
			if ( $migration == $mig_version ) {
				$msg = 'All Migration Uninstalled Successfully';
				$this->clu->response( $msg, 'green', true, true )->write();
			} elseif ( $migration == true ) {
				$msg = 'No Migration Found';
				$this->clu->response( $msg, 'red' )->error();
			} else {
				$msg = $this->migration->error_string();
				$this->clu->response( $msg, 'red' )->error();
			}


		}

		/**
		 * versionTimeStamp allows so you can generate timestamp
		 * in given format by codeigniter
		 *
		 * @return void
		 */
		public function versionTimeStamp()
		{

			//print migration file name timestamp format
			$this->clu->response( "Generated Timestamp: " . date( "YmdHis" ), 'red', false, true )->write();

		}

	}