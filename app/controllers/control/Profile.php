<?php

	/**
	 *
	 * Description
	 *
	 * @package        Melio
	 * @category       Source
	 * @author         Michael Akanji <matscode@gmail.com>
	 * @date           2017-07-09
	 * @copyright (c)  2016 - 2017, TECRUM (http://www.tecrum.com)
	 *
	 */
	defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

	class Profile extends CI_Controller
	{

		public
			$uriPrefix = 'control';

		public function index()
		{
			// make profile edit point as default
			$this->edit();
		}

		public function edit()
		{
			$this
				->Auth
				->deny( 'Account/login', $this->uriPrefix );

			$input = $this->input;
			if ( $input->server( 'REQUEST_METHOD' ) == 'POST' ) {
				if ( $this->FormValidation->run( 'profile.edit' ) ) {

					if ( $this->UsersModel->edit( $input->post() ) ) {

						// welcome msg
						$this->Notify->setMessage( 'success', 'Profile updated successfully...' );
						// do redirect
						redirect( 'control/Profile/edit' );

					}
				}
				// set update eror
				$this->Notify->setMessage( 'error', validation_errors() );
			}

			$data['user'] =
				$this
					->UsersModel
					->getActive();

			$views =
				[
					'navigationMenu' => 'Elements.navigationMenu',
					'content'        => 'Profile.edit'
				];

			$this
				->Template
				->setTitle( "Profile edit" )
				->render( $views, $data, true );
		}

		public function setDisplayPicture()
		{
			// check auth status
			$this
				->Auth
				->deny( 'Account/login', $this->uriPrefix );

			// use validation saved in melio config
			$uploadConfig = $this->config->item( 'UploadValidation', 'melio' )['displayPicture'];
			// display picture upload path
			$uploadPath = $uploadConfig['upload_path'];

			$input = $this->input;
			// check if form submitted
			if ( $input->server( 'REQUEST_METHOD' ) == 'POST' ) {

				$this->Upload->initialize( $uploadConfig );
				if ( $this->Upload->do_upload( 'display_picture' ) ) {
					// upload is successful
					$file_name = $this->Upload->data( 'file_name' );

					if ( $this->UsersModel->edit( [ 'display_picture' => $file_name ] ) ) {
						// delete old dp after setting the new one
						unlink( $uploadPath . $this->Auth->user( 'display_picture' ) );
						// set new dp to session
						$this->Auth->setUserData( 'display_picture', $file_name );

						$resizeConfig                 = $this->config->item( 'ImageManipulation', 'melio' )['displayPicture'];
						$resizeConfig['source_image'] = $uploadPath . $file_name;
						// parse config
						$this->ImageLib->initialize( $resizeConfig );
						// do resize
						if ( $this->ImageLib->resize() ) {
							// upload and resize passed
							$this->Notify->setMessage( 'success', 'Display Picture set successfully...' );

						} else {
							// upload passed but resize !passed
							$this->Notify->setMesssage( 'error', 'Display Picture set successfully but the following error prevent resizing the picture to make it load faster: ' . $this->image_lib->display_errors() );

						}
						// do reload
						redirect( 'control/Profile/setDisplayPicture' );
					}

					// Debug::print_r( $data );

				} else {
					// upload not passed
					$this->Notify->setMessage( 'error', $this->Upload->display_errors() );
				}

			}

			$data['user'] =
				$this
					->UsersModel
					->getActive();

			$views =
				[
					'navigationMenu' => 'Elements.navigationMenu',
					'content'        => 'Profile.setDisplayPicture'
				];

			$this
				->Template
				->setTitle( "Profile Display Picture" )
				->render( $views, $data, true );
		}

		public function password()
		{
			$this
				->Auth
				->deny( 'Account/login', $this->uriPrefix );

			$input = $this->input;
			if ( $input->server( 'REQUEST_METHOD' ) == 'POST' ) {
				if ( $this->FormValidation->run( 'profile.password' ) ) {
					// confirm old password
					$user =
						$this
							->UsersModel
							->login( $this->Auth->user( 'username' ) );

					$oldPasswordValid = password_verify( $input->post( 'old_password' ), $user->password );

					if ( $oldPasswordValid ) {
						if ( $this->UsersModel->changePassword( $input->post( 'new_password' ) ) ) {

							// welcome msg
							$this->Notify->setMessage( 'success', 'Password changed successfully...' );
							// do redirect
							redirect( 'control/Profile/password' );

						}
					} else {
						// todo: check and count passowrd change attempt to intiate security protocol
						$this->Notify->setMessage( 'error', 'Old password incorrect, few attempts remaining' );
					}
				} else {
					// set update eror
					$this->Notify->setMessage( 'error', validation_errors() );
				}
			}

			$views =
				[
					'navigationMenu' => 'Elements.navigationMenu',
					'content'        => 'Profile.changePassword'
				];

			$this
				->Template
				->setTitle( "Change Password" )
				->render( $views, null, true );
		}

	}