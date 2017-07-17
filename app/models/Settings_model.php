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
	defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

	class Settings_model
	{

		public
			$table = 'settings';


		public function getRaw( $key )
		{
			return
				$this
					->db
					->where( [ 'key' => $key ] )
					->get( $this->table, 1 )
					->row();
		}

		public function get( $key )
		{
			return
				$this->getRaw( $key )->value;
		}

		public function set( $key, $value )
		{
			return
				$this
					->db
					->insert( $this->table, [ $key => $value ] );
		}

		public function exists( $key )
		{
			if ( $this->get( $this ) ) {
				return true;
			}

			return false;
		}

	}