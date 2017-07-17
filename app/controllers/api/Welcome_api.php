<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome_api extends CI_Controller
{

	public function index() {
		// making the default response be about info
		$this->about();

	}

	public function about() {
		// get user info from DB
		$data = $this->user->get_info();
		// export as a JSON data
		output_json($data);
	}

	public function projects() {
		// get projects
		$data = $this->user->get_projects();
		// export as a JSON data
		output_json($data);
	}

	public function contact() {
		// refresh page to export result successfully to bypass $HTTP_RAW_POST_DATA error
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post()) { // confirm $_POST data is not empty
			// process form submittion - first validate form data

			if ($this->formValidation->run('contact_me') == TRUE) {

				// save contact info for review
				if ($this->contactMe->save()) {
					$result = array(
						'is_success' => TRUE,
						'Notify'     => [ 'Contact made Successfully, Will get back to you ASAP']
					);
				}

			} else {
				// export errors
				$result = array(
					'is_success' => FALSE,
					'Notify'     => array_filter(explode('_', validation_errors(' ', '_')), 'trim')
				);
			}
			// return response
			output_json($result);

		} else {

			// process get request
			$data = $this->user->get_info();
			// export as a JSON data
			output_json($data);

		}

	}
}
