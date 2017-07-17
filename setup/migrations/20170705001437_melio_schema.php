<?php
	/**
	 * Melio Database Schema...
	 *
	 * @package        Melio
	 * @category       Source
	 * @author         Michael Akanji <matscode@gmail.com>
	 * @date           2017-06-18
	 * @copyright (c)  2016 - 2017, TECRUM (http://www.tecrum.com)
	 *
	 */
	defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

	class Migration_Melio_schema extends CI_Migration
	{

		public function up()
		{
			/*	-----------------------------------
				Drop table 'users' if it exists
				----------------------------------- */
			$this->dbforge->drop_table( 'users', true );

			// Table structure for table 'users'
			$this->dbforge->add_field(
				[
					'id'                      =>
						[
							'type'       => 'SMALLINT',
							'constraint' => '2',
							'unsigned'   => true,
							// 'auto_increment' => TRUE //its not gonna have more than one row of data
						],
					'last_ip_address'         =>
						[
							'type'       => 'VARCHAR',
							'constraint' => '16',
							'null'       => true
						],
					'username'                =>
						[
							'type'       => 'VARCHAR',
							'constraint' => '100',
							'null'       => false
						],
					'first_name'              =>
						[
							'type'       => 'VARCHAR',
							'constraint' => '100',
							'null'       => false
						],
					'last_name'               =>
						[
							'type'       => 'VARCHAR',
							'constraint' => '100',
							'null'       => false
						],
					'other_name'              =>
						[
							'type'       => 'VARCHAR',
							'constraint' => '100',
							'null'       => true
						],
					'display_picture'         =>
						[
							'type'       => 'VARCHAR',
							'constraint' => '150',
							'null'       => true
						],
					'profession'              =>
						[
							'type'       => 'VARCHAR',
							'constraint' => '255',
							'null'       => true
						],
					'about'                   =>
						[
							'type'       => 'VARCHAR',
							'constraint' => '100',
							'null'       => true
						],
					'email'                   =>
						[
							'type'       => 'VARCHAR',
							'constraint' => '150',
							'null'       => true
						],
					'mobile_number'           =>
						[
							'type'       => 'VARCHAR',
							'constraint' => '20',
							'null'       => true
						],
					'birth_date'              =>
						[
							'type' => 'DATETIME', // 2016-06-20 13:45:32
							'null' => true
						],
					'country'                 =>
						[
							'type'       => 'VARCHAR',
							'constraint' => '100',
							'null'       => true
						],
					'password'                =>
						[
							'type'       => 'VARCHAR',
							'constraint' => '100',
							'null'       => false
						],
					'salt'                    =>
						[
							'type'       => 'VARCHAR',
							'constraint' => '40'
						],
					'remember_code'           =>
						[
							'type'       => 'VARCHAR',
							'constraint' => '40',
							'null'       => true
						],
					'forgotten_password_code' =>
						[
							'type'       => 'VARCHAR',
							'constraint' => '40',
							'null'       => true
						],
					'forgotten_password_time' =>
						[
							'type' => 'DATETIME',
							'null' => true
						],
					'last_login'              =>
						[
							'type' => 'DATETIME',
							'null' => false
						],
					'created'                 =>
						[
							'type' => 'DATETIME',
							'null' => false
						],
					'modified'                =>
						[
							'type' => 'DATETIME',
							'null' => true
						]
				] );
			$this->dbforge->add_key( 'id', true );
			$this->dbforge->create_table( 'users' );

			// Dumping data for table 'users' -> only in dev mode
			$data = array(
				'id'                      => '1',
				'last_ip_address'         => '127.0.0.1',
				'username'                => 'melio',
				'first_name'              => 'Michael',
				'other_name'              => '',
				'last_name'               => 'Akanji',
				'profession'              => 'Fullstack Web Developer',
				'about'                   => 'Melio is simply a profile and portfolio website under development',
				'email'                   => 'matscode@gmail.com',
				'mobile_number'           => '08186074929',
				'birth_date'              => '1991-10-22 00:00:00',
				'country'                 => 'Nigeria',
				'password'                => '$2y$10$qDJEWCx2LTni5exZO2W.F.JMKETZ.MTMfqrRVvTOEiHrQb9fw.LDC', // admin
				'salt'                    => '',
				'forgotten_password_code' => null,
				'created'                 => date( 'Y-m-d', time() ),
				'modified'                => date( 'Y-m-d', time() ),
				'last_login'              => date( 'Y-m-d', time() ),
			);
			$this->db->insert( 'users', $data );


			/*	-----------------------------------------
				 Drop table 'settings' if it exists
				----------------------------------------- */
			$this->dbforge->drop_table( 'settings', true );

			// Table structure for table 'settings'
			$this->dbforge->add_field(
				[
					'id'      =>
						[
							'type'           => 'MEDIUMINT',
							'constraint'     => '8',
							'unsigned'       => true,
							'auto_increment' => true
						],
					'key'     =>
						[
							'type'       => 'VARCHAR',
							'constraint' => '50'
						],
					'value'   =>
						[
							'type'       => 'VARCHAR',
							'constraint' => '255',
							'null'       => true
						],
					'created' =>
						[
							'type' => 'DATETIME',
							'null' => false
						]
				] );
			$this->dbforge->add_key( 'id', true );
			$this->dbforge->create_table( 'settings' );

			/*	-----------------------------------------
				 Drop table 'views' if it exists
				----------------------------------------- */
			$this->dbforge->drop_table( 'views', true );

			// Table structure for table 'views'
			$this->dbforge->add_field(
				[
					'id'         =>
						[
							'type'           => 'MEDIUMINT',
							'constraint'     => '8',
							'unsigned'       => true,
							'auto_increment' => true
						],
					'ip_address' =>
						[
							'type'       => 'VARCHAR',
							'constraint' => '16'
						],
					'user_agent' =>
						[
							'type'       => 'VARCHAR',
							'constraint' => '100',
							'null'       => true
						],
					'time'       =>
						[
							'type'       => 'INT',
							'constraint' => '11',
							'unsigned'   => true,
							'null'       => true
						]
				] );
			$this->dbforge->add_key( 'id', true );
			$this->dbforge->create_table( 'views' );

			/*	-----------------------------------------
				 Drop table 'login_attempts' if it exists
				----------------------------------------- */
			$this->dbforge->drop_table( 'login_attempts', true );

			// Table structure for table 'login_attempts'
			$this->dbforge->add_field(
				[
					'id'         =>
						[
							'type'           => 'MEDIUMINT',
							'constraint'     => '8',
							'unsigned'       => true,
							'auto_increment' => true
						],
					'ip_address' =>
						[
							'type'       => 'VARCHAR',
							'constraint' => '16'
						],
					'login'      =>
						[
							'type'       => 'VARCHAR',
							'constraint' => '100',
							'null'       => true
						],
					'time'       =>
						[
							'type'       => 'INT',
							'constraint' => '11',
							'unsigned'   => true,
							'null'       => true
						]
				] );
			$this->dbforge->add_key( 'id', true );
			$this->dbforge->create_table( 'login_attempts' );

		}

		public function down()
		{
			$this->dbforge->drop_table( 'users', true );
			$this->dbforge->drop_table( 'settings', true );
			$this->dbforge->drop_table( 'views', true );
			$this->dbforge->drop_table( 'login_attempts', true );
		}
	}
