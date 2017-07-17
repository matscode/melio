<?php

	/**
	 *
	 * Description
	 *
	 * @package        Melio
	 * @category       Source
	 * @author         Michael Akanji <matscode@gmail.com>
	 * @date           2017-07-05
	 * @copyright (c)  2016 - 2017, TECRUM (http://www.tecrum.com)
	 *
	 */
	class User
	{
		private $hidden =
			[
				'password',
			    'salt',
			    'remember_code',
			    'forgotten_password_code',
			    'forgotten_password_time',
			];

		public function last_login( $format )
		{
			return $this->last_login;
		}

		public function __set( $name, $value )
		{
			if ( ! in_array( $name, $this->hidden ) ) { // comply to ignore listed columns
				$this->{$name} = $value;
				// TODO: Later usage - format last_login date
				if ( $name === 'last_login' ) {
					$this->last_login = date( 'Y', strtotime( $value));
				}
			}
		}

		public function __get( $name )
		{
			if ( isset( $this->$name ) ) {
				return $this->$name;
			}
		}
	}