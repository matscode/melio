<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * --------------------------------------
 * Validation rules for contact me form
 * --------------------------------------
 */
$config['contact_me'] = array(
	array(
		'field' => 'fullName',
		'label' => 'Full Name',
		'rules' => 'required|min_length[3]|regex_match[/^([a-zA-Z ]+)$/i]|sanitize'
	),
	array(
		'field' => 'emailAddress',
		'label' => 'Email Address',
		'rules' => 'required|valid_email|sanitize'
	),
	array(
		'field' => 'phoneNumber',
		'label' => 'Phone Number',
		'rules' => 'numeric|min_length[10]|max_length[20]|sanitize'
	),
	array(
		'field' => 'projectBudget',
		'label' => 'Project Budget',
		'rules' => 'numeric|sanitize'
	),
	array(
		'field' => 'description',
		'label' => 'Description',
		'rules' => 'required|min_length[10]|sanitize'
	)
);

