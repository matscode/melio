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

	class Users_model extends CI_Model
	{

		public
			$table = 'users';

		/**
		 * @param int $limit
		 * @param int $offset
		 *
		 * @return mixed
		 */
		public function get( $limit = 0, $offset = 0 )
		{
			return $this->db->get( 'users', $limit, $offset );
		}

		/**
		 * @return User
		 */
		public function getActive()
		{
			return $this->get( 1 )->row( 0, 'User' );
		}

		public function login( $username )
		{
			$this->db
				->select( 'username, password, salt, remember_code' )
				->where( [ 'username' => $username ] );

			return $this
				->get( 1 )
				->row();
		}

		public function byUsername( $username )
		{
			$this->db
				->where( [ 'username' => $username ] );

			return $this
				->get( 1 )
				->row( 0, 'User' );
		}

		public function edit( $data )
		{
			$this->db
				->where( [ 'username' => $this->Auth->user( 'username' ) ] );

			return $this
				->db
				->update( $this->table, $data );
		}

		public function changePassword( $password )
		{
			$this->db
				->where( [ 'username' => $this->Auth->user( 'username' ) ] );

			return $this
				->db
				->update( $this->table, [ 'password' => password_hash( $password, PASSWORD_DEFAULT ) ] );
		}
	}
