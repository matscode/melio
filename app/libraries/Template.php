<?php
	defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

	/**
	 * Templating View Loader class
	 *
	 * Reduces the loading of view files in controllers
	 * to a one line code, by means of templating
	 *
	 * @package        Melio
	 * @category       Libraries
	 * @author         Michael Akanji <matscode@gmail.com>
	 * @copyright
	 *
	 * @todo           Improving and Refactoring and Using Output Library...
	 *
	 */
	class Template
	{

		private
			$_Core, // codeigniter instance
			$_data, // view data
			$_templateDir,
			$_controlDir = 'control';

		public function __construct()
		{
			// Assigning the CodeIgniter super-object
			$this->_Core =& get_instance();

			// initially some empties data for the template view
			$this->_data['meta_element'] = '';
			$this->_data['page_title']   = '';
			$this->_data['content']      = '';

			// set the default template dir
			$this->setTemplateDir( 'Template' );
		}

		public function setTemplateDir( $dir_name )
		{
			/*
			$this->_templateDir = '';
			if ( $this->_ci->uri->segment( 1 ) == "control" ) { // make a check for user control
				$this->_templateDir .= $this->_controlDir;
			}
			*/
			$this->_templateDir = trim( $dir_name, '.' ) . '.';

			return $this;
		}

		public function setTitle( $value )
		{

			if ( $value ) {
				$this->_data['title'] = $value;
			}

			return $this;
		}

		public function setMeta( $name, $content, $type = null )
		{
			// TODO: Implement construction meta tag

			return $this;
		}

		public function render( $view, $data = [], $with_placeholder = false, $template = 'default' )
		{
			// make a check for user control
			$prefix = '';
			if ( $this->_Core->uri->segment( 1 ) == "control" ) {
				$prefix = 'control.';
			}

			// make sure $data is array if empty
			$data = ( count( $data ) ) ? $data : [];
			// make a big data
			$this->_data = array_merge( $this->_data, $data );

			// load view files...
			if ( is_array( $view ) && $with_placeholder ) {
				// multiple view files
				foreach ( $view as $k => $v ) {
					if ( array_key_exists( $k, $data ) ) {
						show_error( 'View file placeholder <strong>' . $k . '</strong> already exist as one of View Data key. Try to rename placeholder' );
					}

					$this->_data[ $k ] = $this->_Core->load->view( $this->_dotPath( $prefix . $v ), $this->_data, true );

				}
			} else if ( is_array( $view ) ) {
				foreach ( $view as $v ) {
					$this->_data['content'] = $this->_Core->load->view( $this->_dotPath( $prefix . $v ), $this->_data, true );
				}

			} else {
				// load a single view
				$this->_data['content'] = $this->_Core->load->view( $this->_dotPath( $prefix . $view ), $this->_data, true );
			}

			// load the default or given template
			$this->_Core->load->view( $this->_dotPath( $prefix . $this->_templateDir . $template ) . '.tpl.php', $this->_data );
		}

		private function _dotPath( $dottedPath )
		{
			return
				str_replace( '.', DIRECTORY_SEPARATOR, trim( $dottedPath, '.' ) );
		}

	}

	/* End of file Template.php */