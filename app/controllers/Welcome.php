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

	class Welcome extends CI_Controller
	{

		public function index()
		{
			$data['user'] = $this->UsersModel->getActive();

			$views = [
				'Welcome.welcome'
			];

			$this
				->Template
				->setTitle( "About Me" )
				->render( $views, $data );

		}
	}
