<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	/**
	 * Clu(CLI Utility Library) class
	 *
	 * Interact with the command line output text
	 *
	 * @package		CodeIgniter
	 * @category	Libraries
	 * @author		Phil Sturgeon
	 * @author		Michael Akanji
	 */
	class Clu {
		
		public $readline_support = false;
		
		public $wait_msg = 'Press any key to continue...';
		
		private $_response = "";
		
		protected $ci;
		
		protected $is_cli_req;
		
		protected $_args = array();
		
		protected $html_colors = array(
			'yellow'	=> '#eeee00',
			'dark_gray'	=> '#666666',
			'red'		=> '#bb3333',
			'blue'		=> '#3366aa',
			'green'		=> '#33bb33'
		);
		
		protected $foreground_colors = array(
			'black'			=> '0;30',
			'dark_gray'		=> '1;30',
			'blue'			=> '0;34',
			'light_blue'	=> '1;34',
			'green'			=> '0;32',
			'light_green'	=> '1;32',
			'cyan'			=> '0;36',
			'light_cyan'	=> '1;36',
			'red'			=> '0;31',
			'light_red'		=> '1;31',
			'purple'		=> '0;35',
			'light_purple'	=> '1;35',
			'brown'			=> '0;33',
			'yellow'		=> '1;33',
			'light_gray'	=> '0;37',
			'white'			=> '1;37',
		);
		
		protected $background_colors = array(
			'black'			=> '40',
			'red'			=> '41',
			'green'			=> '42',
			'yellow'		=> '43',
			'blue'			=> '44',
			'magenta'		=> '45',
			'cyan'			=> '46',
			'light_gray'	=> '47',
		);
		
		public function __construct() {
			$this->ci =& get_instance();
			$this->is_cli_req = $this->ci->input->is_cli_request();
		}
		
		/**
		 * Outputs a string to the cli.	 If you send an array it will implode them
		 * with a line break.
		 *
		 * @param	string|array	$text	the text to output, or array of lines
		 */
		public function success($text = '', $foreground = 'light_green')
		{
			$this->write($text, $foreground);
		}
		
		/**
		 * Outputs a string to the cli.	 If you send an array it will implode them
		 * with a line break.
		 *
		 * @param	string	$text	the text to output, or array of lines
		 */
		public function write()
		{
			
			if ($this->is_cli_req)
			{
				fwrite(STDOUT, $this->_response);
				$this->_response = '';
			}
			else
			{
				$this->http_out();
			}
		}
		
		/**
		 * Outputs an error to the CLI using STDERR instead of STDOUT
		 *
		 * @param	string|array	$text	the text to output, or array of errors
		 */
		public function error($foreground = 'red')
		{
			if ($this->is_cli_req)
			{
				if ($foreground OR $background)
				{
					$this->_response = $this->color($this->_response, $foreground);
				}
				
				fwrite(STDERR, $this->_response.PHP_EOL);
				$this->_response = '';
			}
			else
			{
				$this->http_out();
			}
		}
		
		/**
		 * Returns the given text with the correct color codes for a foreground and
		 * optionally a background color.
		 *
		 * @param	string	$text		the text to color
		 * @param	string	$foreground the foreground color
		 * @param	string	$background the background
		 *
		 * @return	string	the color coded string
		 */
		public function color($text, $foreground, $background = null) {
			if ($this->is_windows() && !$this->is_cli_req)
			{
				return $text;
			}
			
			if($this->is_cli_req)
			{
				if ( ! array_key_exists($foreground, $this->foreground_colors))
				{
					throw new Exception('Invalid CLI foreground color: '.$foreground);
				}
				
				if ( $background !== null and ! array_key_exists($background, $this->background_colors))
				{
					throw new Exception('Invalid CLI background color: '.$background);
				}
				
				$string = "\033[".$this->foreground_colors[$foreground]."m";
				
				if ($background !== null)
				{
					$string .= "\033[".$this->background_colors[$background]."m";
				}
				
				$string .= $text."\033[0m";
				
				return $string;
			}
			else
			{
				$color = $foreground;
				// check if $color is set..
				if (!empty($color) && array_key_exists($color, $this->html_colors))
				{
					$html_string = 'color: ' . $this->html_colors[$color] . ';';
				}
				else
				{
					throw new Exception('Invalid color: '.$color);
				}
				
				return $html_string;
			}
			
			return '';
		}
		
		
		/**
		 * if oprerating system === windows
		 */
		public function is_windows()
		{
			return 'win' === strtolower(substr(php_uname("s"), 0, 3));
		}
		
		/**
		 * Enter a number of empty lines
		 *
		 * @param	integer	Number of lines to output
		 * @return	void
		 */
		function new_line($num = 1)
		{
			// Do it once or more, write with empty string gives us a new line
			for($i = 0; $i < $num; $i++)
			{
				$this->write();
			}
		}
		
		/**
		 * Output compatibly for http(s) request
		 *
		 * @param	string	string to output to browser
		 * @param	string	color for string output
		 * @param	bool	true or false to make string bold, works only on http req
		 * @param	bool	true or false to add new line
		 * @return	string
		 */
		function response($string, $color = 'dark_gray', $make_bold = FALSE, $new_line = FALSE)
		{
			
			if($this->is_cli_req)
			{
				$this->_response .= $this->color($string, $color);
				// check if new_line is needed
				if ($new_line === TRUE)
				{
					$this->_response .= PHP_EOL;
				}
			}
			else
			{
				$html_string = '<span style="';
				
				$html_string .= $this->color(null, $color);
				
				// check if $make_bold is needed
				if ($make_bold === TRUE)
				{
					$html_string .=  ' font-weight: bold;';
				}
				// mark up span tag and append $string
				$html_string .= '">';
				$html_string .= $string;
				$html_string .= '</span>';
				
				// check if new_line is needed
				if ($new_line === TRUE)
				{
					$html_string .= "<br/>\n";
				}
				
				$this->_response .= $html_string;
			}
			return $this;
		}
		
		/**
		 * Output compatibly for http(s) request
		 *
		 * @param	string	custom html doctype for http out HTML5 default
		 * @return	void
		 */
		function http_out($doctype = '<!doctype html>')
		{
			$_output =  ""
				. $doctype . "\n"
				. "<html lang='en'>\n"
				. "<head>\n"
				. "<meta charset='utf-8'/>\n"
				. "</head>\n"
				. "<body>\n"
				. $this->_response
				. "</body>\n"
				. "</html>\n"
				. "";
			// reutrn html page
			echo $_output;
			$this->_response = "";
			
		}
		
	}
	
	/* End of file clu.php */