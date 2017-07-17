<?php
	/**
	 *
	 * Description
	 *
	 * @package        Melio
	 * @category       Source
	 * @author         Michael Akanji <matscode@gmail.com>
	 * @date           2017-06-14
	 * @copyright (c)  2016 - 2017, TECRUM (http://www.tecrum.com)
	 *
	 */
	defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

	// asset root dir
	$assetsDir = 'assets/';

	$config['melio'] =
		[
			// assets dir
			'css_dir'                     => $assetsDir . 'css/',
			'js_dir'                      => $assetsDir . 'js/',
			'img_dir'                     => $assetsDir . 'img/',

			// notify prefixes
			'success_prefix'              => '<div class="alert alert-success">',
			'info_prefix'                 => '<div class="alert alert-info">',
			'error_prefix'                => '<div class="alert alert-danger">',

			// notify suffixes
			'success_suffix'              => '</div>',
			'info_suffix'                 => '</div>',
			'error_suffix'                => '</div>',

			// notify dismissability
			'notify_dismissability_addon' => '',

			// upload configuration
			'UploadValidation'            => [
				'displayPicture' => [
					'upload_path'      => './usercontent/images/', // with trailing slash
					'allowed_types'    => 'jpg|png|jpeg',
					'encrypt_name'     => true,
					'file_ext_tolower' => true,
					'max_size'         => 1999,
					//'max_width'        => 1280 // resize would be done
				]
			],

			// Image manipulation
			'ImageManipulation'           => [
				'displayPicture' => [
					'image_lib'      => 'gd2',
					'quality'        => '80%',
					'maintain_ratio' => true,
					'width'          => 250,
					'height'         => 250
				]
			]
		];
