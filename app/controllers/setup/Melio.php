<?php

	/**
	 *
	 * Description
	 *
	 * @package        Melio
	 * @category       Source
	 * @author         Michael Akanji <matscode@gmail.com>
	 * @date           2017-07-16
	 * @copyright (c)  2016 - 2017, TECRUM (http://www.tecrum.com)
	 *
	 */
	class Melio extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();

			// Load required Library
			$this->load->library( 'migration' );
			// Load required Config File
			$this->load->config( 'migration' );
		}

		public function index()
		{
			$mig_version = $this->config->item( 'migration_version' );
			// do migration
			$migration = $this->migration->current();

			if ( $migration == $mig_version ) {
				// do a redirect
				redirect('setup/Melio/initial');
			} elseif ( $migration === true ) {

				$this->Notify->setMessage( 'error', 'No migration is found' );
			} else {

				$this->Notify->setMessage( 'error', $this->migration->error_string() );
			}

		}

		public function initial()
		{

		}
	}