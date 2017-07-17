<?php
	defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

	/**
	 * Extending CodeIgniter HTML Helpers
	 *
	 * @package        CodeIgniter
	 * @category       Helpers
	 * @author         Michael Akanji <matscode@gmail.com>
	 */

	/**
	 * Image
	 *
	 * Generates an <img /> element
	 *
	 * @param    mixed
	 * @param    bool
	 * @param    mixed
	 *
	 * @return    string
	 */
	function imgAsset( $src, $index_page = false, $attributes = '' )
	{
		// prefix $src with the default image asset dir
		return
			img( config_item( 'melio' )['img_dir'] . $src, $index_page, $attributes ) . PHP_EOL;
	}

	function cssAsset( $href, $media = '', $index_page = false )
	{
		$cssAssets    = '';
		$cssAssetsDir = config_item( 'melio' )['css_dir'];

		if ( is_array( $href ) ) {
			// loop through stylesheet
			foreach ( $href as $x ) {
				$cssAssets .=
					link_tag(
						$cssAssetsDir . $x . '.css',
						'stylesheet',
						'text/css',
						'',
						$media,
						$index_page ) . PHP_EOL;
			}
		} else {
			// load a single stylesheet
			$cssAssets .=
				link_tag(
					$cssAssetsDir . $href . '.css',
					'stylesheet',
					'text/css',
					'',
					$media,
					$index_page ) . PHP_EOL;
		}

		return $cssAssets;
	}

	function jsAsset( $src, $includeHost = false )
	{
		// construct <script src="path-to-file.js"></script>

		$jsAssets    = '';
		$jsAssetsDir = config_item( 'melio' )['js_dir'];

		if ( is_array( $src ) ) {
			// loop through js files
			foreach ( $src as $x ) {

				$jsAssets .= '<script src="';
				if ( ! preg_match( '#^([a-z]+:)?//#i', $x ) ) {

					if ( $includeHost ) {
						// add base_url()
						$jsAssets .= base_url( $jsAssetsDir . $x . '.js' );
					} else {
						// ignore base url
						$jsAssets .= ( $jsAssetsDir . $x . '.js' );
					}
				} else {
					// script source if from CDN: use as is
					$jsAssets .= $x;
				}
				$jsAssets .= '" type="text/javascript"></script>' . PHP_EOL;
			}

			return $jsAssets;
		}

		// load a single js file
		$jsAssets .= '<script src="';
		if ( ! preg_match( '#^([a-z]+:)?//#i', $src ) ) {
			if ( $includeHost ) {
				// add base_url()
				$jsAssets .= base_url( $jsAssetsDir . $src . '.js' );
			} else {
				// ignore base url
				$jsAssets .= ( $jsAssetsDir . $src . '.js' );
			}
		} else {
			// script source if from CDN: use as is
			$jsAssets .= $src;
		}
		$jsAssets .= '" type="text/javascript"></script>' . PHP_EOL;

		return $jsAssets;
	}