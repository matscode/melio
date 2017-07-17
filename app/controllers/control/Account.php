<?php

	/**
	 *
	 * Description
	 *
	 * @package        Melio
	 * @category       Source
	 * @author         Michael Akanji <matscode@gmail.com>
	 * @date           2017-06-18
	 * @copyright (c)  2016 - 2017, TECRUM (http://www.tecrum.com)
	 *
	 */
	defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

	class Account extends CI_Controller
	{

		public
			$uriPrefix = 'control';

		public function index()
		{
			$this
				->Auth
				->loggedIn( 'Account/dashboard', $this->uriPrefix );

			/*Login*/
			$input = $this->input;
			if ( $input->server( 'REQUEST_METHOD' ) == 'POST' ) {
				if ( $this->FormValidation->run( 'login' ) ) {

					if ( $this
						->Auth
						->setUsername( $input->post( 'username' ) )
						->setPassword( $input->post( 'password' ) )
						->login()
					) {

						// welcome msg
						$this->Notify->setMessage( 'success', 'Welcome back' );
						// do redirect
						redirect( 'control/Account/dashboard' );

					}
				}
				// set auth eror
				$this->Notify->setMessage( 'error', 'Your login details are not correct' );
			}

			$views =
				[
					'Account.login'
				];

			$this
				->Template
				->setTitle( "Login" )
				->render( $views );

		}

		public function login()
		{
			$this->index();
		}

		public function dashboard()
		{
			$this
				->Auth
				->deny( 'Account/index', $this->uriPrefix );

			$views =
				[
					'navigationMenu' => 'Elements.navigationMenu',
					'content'        => 'Account.dashboard'
				];

			$this
				->Template
				->setTitle( 'Dashboard' )
				->render( $views, null, true );

		}

		public function logout()
		{
			// check if user login
			$this
				->Auth
				->deny( 'Account/index', $this->uriPrefix );

			// set logged out message
			$this->Notify->setMessage( 'info', 'You are logged out successfully' );

			$this
				->Auth
				->logout( 'Account', $this->uriPrefix );
		}
	}