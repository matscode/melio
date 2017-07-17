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

	/*LOGIN*/
	$config['login'] =
		[
			[
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required|alpha'
			]
		];

	/*PROFILE UPDATE*/
	$config['profile.edit'] =
		[
			[
				'field' => 'first_name',
			    'label' => 'First name',
			    'rules' => 'required|alpha|ucwords|sanitize'
			],
			[
				'field' => 'last_name',
			    'label' => 'Last name',
			    'rules' => 'required|alpha|ucwords|sanitize'
			],
			[
				'field' => 'other_name',
			    'label' => 'Other name',
			    'rules' => 'alpha|ucwords|sanitize'
			],
			[
				'field' => 'profession',
			    'label' => 'Profession',
			    'rules' => 'required|regex_match[/^([a-zA-Z ,-.\|\(\)]+)$/i]|sanitize'
			],
			[
				'field' => 'email',
			    'label' => 'Email',
			    'rules' => 'required|valid_email|strtolower|sanitize'
			],
			[
				'field' => 'mobile_number',
			    'label' => 'Email',
				'rules' => 'numeric|min_length[10]|max_length[20]|sanitize'
			],
			[
				'field' => 'country',
			    'label' => 'Profession',
			    'rules' => 'regex_match[/^([a-zA-Z ]+)$/i]|ucwords|sanitize'
			],
		];


	/*CHANGE PASSWORD*/
	$config['profile.password'] =
		[
			[
				'field' => 'old_password',
			    'label' => 'Old password',
			    'rules' => 'required'
			],
			[
				'field' => 'new_password',
			    'label' => 'New password',
			    'rules' => 'required|min_length[6]'
			],
			[
				'field' => 'cnew_password',
			    'label' => 'Confirm New password',
			    'rules' => 'required|matches[new_password]'
			],

		];

