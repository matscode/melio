<?php

	/**
	 * Message Library
	 *
	 * For easy displaying of flash message(one time message, i.e error or success message)
	 *
	 * @package        CIS
	 * @category       Libraries
	 * @author         Michael Akanji
	 * @copyright (c)  2016, TECRUM <contractecrum@gmail.com>
	 *
	 */
	defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

	class Notify
	{

		protected
			$_CI,
			$_messageHistory = 5, // number of message history to keep for each type (Not using it)
			$_messageHistoryExpire = 7200; // 2 hours (Not using it)

		private
			$_notify,
			$_allowedTypes = [
			'success',
			'error',
			'info'
		];

		public function __construct()
		{
			// get codeigniter core
			$this->_CI = &get_instance();
			// load session library
			$this->_CI->load->library( 'session', 'Session' );

			// get current session data into the _message property
			$this->_notify = $this->_CI->Session->userdata( 'Notify' );
			if ( ! is_array( $this->_notify ) || ! $this->_notify ) {
				$this->_notify = [];
			}
			// load custom config file if available
			$this->_CI->config->load( 'melio' );

		}

		/**
		 * Gets the last message set
		 *
		 * @param string $type         error | success as available type of message
		 * @param bool   $keep_message Set second argument to true to keep message for next server request
		 * @param mixed  $fixes        Enable or disable wrapper for messages before return
		 *
		 * @return mixed
		 *
		 */
		public function getMessage( $type, $dismissable = true, $keep_message = false, $fixes = true )
		{

			if ( isset( $this->_notify[ $type ] ) ) {

				if ( $fixes ) {
					$message_prefix = $this->_CI->config->item( $type . '_prefix', 'melio' );
					$message_suffix = $this->_CI->config->item( $type . '_suffix', 'melio' );

					if ( ! $message_prefix && ! $message_suffix ) {
						// set default/load fixes (message prefix and suffix)
						$message_prefix = '<div class="alert ' . $type . '-message">'; // allow to create css classes using the allowed type names
						$message_suffix = '</div>';
					}
				} else {
					$message_suffix = $message_prefix = '';
				}

				if ( is_array( $this->_notify[ $type ] ) ) {
					$formated_message = '';

					if ( ! $fixes ) {
						$message_suffix = '<br>';
					}

					$total_message = count( $this->_notify[ $type ] );
					for ( $count = 0; $count < $total_message; $count ++ ) {
						$formated_message .= $message_prefix;
						$formated_message .= $this->_notify[ $type ][ $count ];

						if ( $count < ( count( $this->_notify[ $type ] ) - 1 ) && ! $fixes ) {
							$formated_message .= $message_suffix;
						} else {
							$formated_message .= $message_suffix;
						}
					}

				} else {
					$formated_message = $message_prefix;
					$formated_message .= $this->_notify[ $type ];
					$formated_message .= $message_suffix;
				}


				if ( ! $keep_message ) {
					unset( $this->_notify[ $type ] );

					$this->_CI->Session->set_userdata( 'Notify', $this->_notify );
				}

				return $formated_message;
			}

			return null;
		}

		/**
		 * Sets global messages for later session access
		 *
		 * @param string $type  error|success as available type of message
		 * @param mixed  $value The name given to the message when set
		 *
		 */
		public function setMessage( $type, $value )
		{

			if ( ! in_array( $type, $this->_allowedTypes ) ) {
				$type = 'temp_' . $type;
			}

			// generate time as key for messages prepended with type first character
			// $type .= '_' . time();

			$this->_notify[ $type ] = $value;

			$this->_CI->Session->set_userdata( 'Notify', $this->_notify );
		}

	}

	/* End of file Message.php */
