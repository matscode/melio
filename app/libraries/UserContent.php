<?php

	/**
	 *
	 * Description
	 *
	 * @package        Melio
	 * @category       Source
	 * @author         Michael Akanji <matscode@gmail.com>
	 * @date           2017-07-16
	 * @copyright (c)  2016 - 2017, TECRUM (http://www.tecrum.com)
	 *
	 */
	defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

	class UserContent
	{

		public
			$contentRoot = 'usercontent/',
			$contentPath = '';

		public
			$defaults = [
			'images' => 'melio-logo-250.png'
		];

		public function getContent( $pluralType, $contentName, $default = '' )
		{
			$this->contentPath = $this->contentRoot . $pluralType . '/';
			$content           = $this->contentPath . $contentName;

			if ( file_exists( $content ) && is_file( $content ) ) { // check its a valid file
				return $content;
			} elseif ( $default ) {
				return $this->contentPath . $default;
			}

			return '';
		}

		function image( $imageName, $default = '' )
		{
			// if !set default
			if ( ! $default ) {
				$default = $this->defaults['images'];
			}

			return $this->getContent( 'images', $imageName, $default );
		}

	}