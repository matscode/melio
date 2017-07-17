<?php

	/**
	 *
	 * Description
	 *
	 * @package        Melio
	 * @category       Source
	 * @author         Michael Akanji <matscode@gmail.com>
	 * @date           2017-07-10
	 * @copyright (c)  2016 - 2017, TECRUM (http://www.tecrum.com)
	 *
	 */
	defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

	class Settings
	{

		private
			$_Core,
			$_settingsModel;

		public function __construct( array $settingsConfig = [] )
		{
			//initialize CI object
			$this->_Core =& get_instance();
			// load debug component
			$this->_Core->load->library( 'debug', 'Debug' );
			// load libraries
			$this->_Core->load->library( 'notify', '' ); // Notify

			$settingsModel = 'settings'; // set default model for authentication

			if ( count( $settingsConfig ) ) {
				// ignore if no configuration found
				if ( array_key_exists( 'model', $settingsConfig ) ) {
					// set model for authentication
					$settingsModel = $settingsConfig['model'];
				}
			}
			$settingsModel = rtrim( $settingsModel, '_model' ) . '_model';
			// try to load settingsModel
			try {
				$settingsModelWords = explode( '_', $settingsModel );
				// use models as camel cased
				$camelSettingsModel = implode( '', array_map( 'ucwords', $settingsModelWords ) );

				$this->_Core->load->model( $settingsModel, $camelSettingsModel );
				//set default model for settings
				$this->setSettingsModel( $camelSettingsModel );
			} catch ( Exception $e ) {
				// just an error exception
				throw new Exception( 'Settings Model Set "' . $settingsModel . '" is not an existing Model' );
			}
		}

		public function setSettingsModel( $settingsModel )
		{
			$this->_settingsModel = $settingsModel;

			return $this;
		}

		public function set( $key, $value )
		{
			$key = strtolower( $key );
			// allow only snake cased keys
			if ( ! preg_match( '/^([a-zA-Z_]+)$/', $key ) ) {
				throw new Exception( 'Settings Key is in an invalid format, only snake case allowed' );
			}
			// prevent settings key duplication
			if ( $this->_Core->{$this->_settingsModel}->exists( $key ) ) {
				throw new Exception( 'Settings key must be a unique key' );
			}

			if ( $this->_Core->{$this->_settingsModel}->save( $key, $value ) ) {
				$this->_Core->Notify->setMessage( 'success', 'Settings saved successfully...' );
			} else {
				$this->_Core->Notify->setMessage( 'error', 'Error saving settings...' );
			}

			return $this;
		}

	}