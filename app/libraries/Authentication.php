<?php

	/**
	 *
	 * Description
	 *
	 * @package        Melio
	 * @category       Source
	 * @author         Michael Akanji <matscode@gmail.com>
	 * @date           2017-07-07
	 * @copyright (c)  2016 - 2017, TECRUM (http://www.tecrum.com)
	 *
	 */
	defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

	class Authentication
	{
		protected
			$username,
			$password;

		private
			$_Core,
			$_authModel;

		/**
		 * Authentication constructor.
		 *
		 * @param array $authConfig
		 *
		 * @throws \Exception
		 */
		public function __construct( array $authConfig = [] )
		{
			//initialize CI object
			$this->_Core =& get_instance();
			// load debug component
			$this->_Core->load->library( 'debug', 'Debug' );
			// load libraries
			$this->_Core->load->library( 'session', 'Session' ); // Session
			$this->_Core->load->library( 'notify', '' ); // Notify

			$authModel = 'users'; // set default model for authentication
			if ( count( $authConfig ) ) {
				// ignore if no configuration found
				if ( array_key_exists( 'model', $authConfig ) ) {
					// set model for authentication
					$authModel = $authConfig['model'];
				}
			}
			$authModel = rtrim( $authModel, '_model' ) . '_model';
			// try to load authModel
			try {
				$authModelWords = explode( '_', $authModel );
				// use models as camel cased
				$camelAuthModel = implode( '', array_map( 'ucwords', $authModelWords ) );

				$this->_Core->load->model( $authModel, $camelAuthModel );
				//set deault model for authentication
				$this->setAuthModel( $camelAuthModel );
			} catch ( Exception $e ) {
				// just an error exception
				throw new Exception( 'Athentication Model Set "' . $authModel . '" is not an existing Model' );
			}
		}

		/**
		 * @param array $credentials
		 *
		 * @todo Add to credential the ability to remember me - cookie eater/sower
		 * @return bool
		 */
		public function login( array $credentials = [] )
		{
			$credentialsPropertySet  = ( $this->username && $this->password );
			$credentialsParameterSet = ( array_key_exists( 'username', $credentials ) && array_key_exists( 'password', $credentials ) );

			if ( ! $credentialsParameterSet ) {
				if ( ! $credentialsPropertySet ) {
					// throw new Exception( 'Authentication ' . __FUNCTION__ . ' parameter expects atleast username and password keys be set or use mutator and accessor' );
					// silently return
					return false;
				}
			} else {
				// $credential overrides
				$this->setUsername( $credentials['username'] );
				$this->setPassword( $credentials['password'] );
			}

			// validate data
			$User = $this->_Core->{$this->_authModel}->login( $this->username );
			if ( ! is_null( $User ) && password_verify( $this->password, $User->password ) ) {

				$this->setUser( $this->_Core->{$this->_authModel}->byUsername( $this->username ) );

				return true;
			}

			return false;
		}

		public function logout( $redirectTo = '', $prefix = '' )
		{
			$this->_Core->Session->sess_destroy();
			// be sure to append trailing
			$prefix = ( $prefix ) ? trim( $prefix, '/' ) . '/' : '';
			$url    = $prefix . $redirectTo;
			If ( $this->user() ) { // TODO: check to make sure user session exist and not destroy app session
				$this->_Core->Session->sess_destroy();
				redirect( $url );
			}
		}

		public function loggedIn( $redirectTo, $prefix = '' )
		{
			// be sure to append trailing
			$prefix = ( $prefix ) ? trim( $prefix, '/' ) . '/' : '';
			$url    = $prefix . $redirectTo;

			If ( $this->user() ) {
				redirect( $url );
			}
		}

		public function deny( $redirectTo, $prefix = '' )
		{
			// be sure to append trailing
			$prefix = ( $prefix ) ? trim( $prefix, '/' ) . '/' : '';
			$url    = $prefix . $redirectTo;

			If ( ! $this->user() ) {
				// set request login message
				$this->_Core->Notify->setMessage( 'error', 'You must login to access page' );
				redirect( $url );
			}
		}

		/**
		 * @param mixed $username
		 *
		 * @return $this
		 */
		public function setUsername( $username )
		{
			$this->username = $username;

			return $this;
		}

		/**
		 * @param mixed $password
		 *
		 * @return $this
		 */
		public function setPassword( $password )
		{
			$this->password = $password;

			return $this;
		}

		/**
		 * @param mixed $authModel
		 *
		 * @return Authentication
		 */
		public function setAuthModel( $authModel )
		{
			$this->_authModel = $authModel;

			return $this;
		}

		/**
		 * @param User $User
		 *
		 * @todo confirm session library is loaded before use
		 * @return $this
		 */
		public function setUser( User $User )
		{
			$this->_Core->Session->set_userdata( 'Auth.User', serialize( $User ) );

			return $this;
		}

		public function user( $key = null )
		{
			$User =
				unserialize( $this->_Core->Session->userdata( 'Auth.User' ) );
			// return indidual User object record
			if ( $key && $User->{$key} ) {
				return $User->{$key};
			}

			//return all User object record
			return $User;
		}

		public function setUserData( $key, $value )
		{
			//get object
			$User = $this->user();
			// set property
			$User->{$key} = $value;
			// set object
			$this->setUser( $User );

			//return object
			return $this;
		}

	}