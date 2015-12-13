<?php

/**
 *  This file is part of wp-Typography.
 *
 *  Copyright 2014-2015 Peter Putzer.
 *
 *	This program is free software; you can redistribute it and/or
 *	modify it under the terms of the GNU General Public License,
 *	version 2 as published by the Free Software Foundation.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU General Public License for more details.
 *
 *	You should have received a copy of the GNU General Public License
 *	along with this program; if not, write to the Free Software
 *	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *  MA 02110-1301, USA.
 *
 *  ***
 *
 *  Copyright 2009, KINGdesk, LLC. Licensed under the GNU General Public
 *  License 2.0. If you use, modify and/or redistribute this software,
 *  you must leave the KINGdesk, LLC copyright information, the request
 *  for a link to http://kingdesk.com, and the web design services
 *  contact information unchanged. If you redistribute this software, or
 *  any derivative, it must be released under the GNU General Public
 *  License 2.0.
 *
 *  This program is distributed without warranty (implied or otherwise) of
 *  suitability for any particular purpose. See the GNU General Public
 *  License for full license terms <http://creativecommons.org/licenses/GPL/2.0/>.
 *
 *  WE DON'T WANT YOUR MONEY: NO TIPS NECESSARY! If you enjoy this plugin,
 *  a link to http://kingdesk.com from your website would be appreciated.
 *  For web design services, please contact jeff@kingdesk.com.
 *
 *  ***
 *
 *  @package wpTypography
 *  @author Jeffrey D. King <jeff@kingdesk.com>
 *  @author Peter Putzer <github@mundschenk.at>
 *  @license http://www.gnu.org/licenses/gpl-2.0.html
 */

namespace PHP_Typography;

/**
 * HTML5 element introspection
 */
require_once( __DIR__ . '/../vendor/Masterminds/HTML5/Elements.php' );

/**
 * Retrieves intersection of two object arrays using strict comparison.
 *
 * @param array $array1
 * @param array $array2
 * @return array An array that contains the common elements of the two input arrays.
 */
function array_intersection( array $array1, array $array2 ) {
	$max = count( $array1 );

	$out = array();
	for ( $i = 0; $i < $max; ++$i ) {
		if ( in_array( $array1[ $i ], $array2, true ) ) {
			$out[] = $array1[ $i ];
		}
	}

	return $out;
}

/**
 * Convert \DOMNodeList to array;
 *
 * @param \DOMNodeList $list
 * @return array An array of \DOMNodes.
 */
function nodelist_to_array( \DOMNodeList $list ) {
	$out = array();

	foreach ($list as $node) {
		$out[] = $node;
	}

	return $out;
}

/**
 * Retrieve an array containing all the ancestors of the node.
 *
 * @param \DOMNode $node
 * @return array An array of \DOMNode.
 */
function get_ancestors( \DOMNode $node ) {
	$result = array();

	while ($node = $node->parentNode) {
		$result[] = $node;
	}

	return $result;
}

/**
 * Checks whether the \DOMNode has one of the given classes.
 * If $tag is a \DOMText, the parent DOMElement is checked instead.
 *
 * @param \DOMNode $tag An element or textnode.
 * @param string|array $classnames A single classname or an array of classnames.
 *
 * @return boolean True if the element has the given class(es).
 */
function has_class( \DOMNode $tag, $classnames ) {
	if ( $tag instanceof \DOMText ) {
		$tag = $tag->parentNode;
	}

	if ( ! ( is_null( $tag ) && is_object( $tag ) ) ) {
		return false;
	}

	if ( ! is_array( $classnames ) ) {
		$classnames = array( $classnames );
	}

	if ( $tag->hasAttribute( 'class' ) ) {
		$tag_classes = array_flip( explode(' ', $tag->getAttribute('class') ) );

		foreach ( $classnames as &$classname ) {
			if ( isset($tag_classes[ $classname ] ) ) {
				return true;
			}
		}
	}

	return false;
}

/**
 * Returns the nearest block-level parent.
 *
 * @param \DOMNode $element The node to get the containing block-level tag.
 *
 * @return \DOMNode
 */
function get_block_parent( \DOMNode $element ) {
	static $block_tags = null;

	if ( empty( $block_tags ) ) {
		$block_tags = array_flip( array_filter( array_keys( \Masterminds\HTML5\Elements::$html5 ), function( $tag ) { return \Masterminds\HTML5\Elements::isA( $tag, \Masterminds\HTML5\Elements::BLOCK_TAG ); } )
								  + array( 'li', 'td', 'dt' ) ); // not included as "block tags" in current HTML5-PHP version
	}

	$parent = $element->parentNode;
	while ( isset( $parent->tagName ) && ! isset( $block_tags[ $parent->tagName ] ) && ! empty( $parent->parentNode ) ) {
		$parent = $parent->parentNode;
	}

	return $parent;
}

/**
 * Check whether a given string is UTF-8 or ASCII.
 *
 * @param string $string.
 *
 * @return string The detected encoding (defaults to 'ASCII').
 */
function detect_encoding( $string ) {
	// .'a' is a hack; see http://www.php.net/manual/en/function.mb-detect-encoding.php#81936
	// probbably not needed anymore with $strict set to true
	$encoding = mb_detect_encoding( $string . 'a', array( 'UTF-8', 'ISO-8859-1', 'ASCII' ), true );
	if ( empty($encoding) ) {
		$encoding = 'ASCII';
	}

	return $encoding;
}

/**
 * Convert decimal value to unicode character.
 *
 * @param string|array $codes Decimal value(s) coresponding to unicode character(s).
 * @return string Unicode character(s).
 */
function uchr( $codes ) {
	if ( is_scalar( $codes ) ) {
		$codes = func_get_args();
	}

	$str= '';
	foreach ( $codes as $code ) {
		$str .= html_entity_decode( '&#' . $code . ';', ENT_NOQUOTES, 'UTF-8' );
	}

	return $str;
}

/**
 * Is a number odd?
 *
 * @param integer $number
 * @return boolean true if $number is odd, false if it is even.
 */
function is_odd( $number ) {
	return (boolean) ( $number % 2 );
}

/**
 * Multibyte-safe str_split function.
 *
 * @param string $str
 * @param int    $length Optional. Default 1.
 * @param string $encoding Optional. Default 'UTF-8'.
 */
function mb_str_split( $str, $length = 1, $encoding = 'UTF-8' ) {
	if ( $length < 1 ) {
		return false;
	}

	$result = array();
	$multibyte_length = mb_strlen( $str, $encoding );
	for ( $i = 0; $i < $multibyte_length; $i += $length ) {
		$result[] = mb_substr( $str, $i, $length, $encoding );
	}

	return $result;
}


/**
 * Retrieve the supported hyphenation languages.
 *
 * @return array An associative array in the form array( language code => language name )
 */
function get_hyphenation_languages() {
	static $hyphenation_language_name_untranslated = '/\$patgenLanguage\s*=\s*((".+")|(\'.+\'))\s*;/';
	static $hyphenation_language_name_translated   = '/\$patgenLanguage\s*=\s*__\(\s*((".+")|(\'.+\'))\s*,\s*((".+")|(\'.+\'))\s*\)\s*;/';

	$languages = array();
	$langDir = dirname( __FILE__ ) . '/lang/';
	$handler = opendir( $langDir );

	// read all files in directory
	while ( $file = readdir( $handler ) ) {
		// we only want the php files
		if ('.php' == substr( $file, -4 ) ) {
			$file_content = file_get_contents( $langDir . $file );

			preg_match( $hyphenation_language_name_untranslated, $file_content, $matches );
			if ( ! isset($matches[1]) ) {
				// maybe the language name is being translated
				preg_match( $hyphenation_language_name_translated, $file_content, $matches );
			}
			$language_name = __( substr( $matches[1], 1, -1 ), 'wp-typography' ); // normally this doesn't work, but we may have added the
			// language name in the patgen file already.
			$language_code = substr( $file, 0, -4 );
			$languages[ $language_code ] = $language_name;
		}
	}
	closedir( $handler );

	asort( $languages );
	return $languages;
}

/**
 * Retrieve the supported diacritics replacement languages.
 *
 * @return array An associative array in the form array( language code => language name )
 */
function get_diacritic_languages() {
	static $diacritic_language_name_untranslated = '/\$diacriticLanguage\s*=\s*((".+")|(\'.+\'))\s*;/';
	static $diacritic_language_name_translated   = '/\$diacriticLanguage\s*=\s*__\(\s*((".+")|(\'.+\'))\s*,\s*((".+")|(\'.+\'))\s*\)\s*;/';

	$languages = array();
	$lang_dir = dirname( __FILE__ ) . '/diacritics/';
	$handler = opendir( $lang_dir );

	// read all files in directory
	while ( $file = readdir( $handler ) ) {
		// we only want the php files
		if ('.php' == substr( $file, -4 ) ) {
			$file_content = file_get_contents( $lang_dir.$file );
			preg_match( $diacritic_language_name_untranslated, $file_content, $matches );
			if ( ! isset($matches[1]) ) {
				// maybe the language name is being translated
				preg_match( $diacritic_language_name_translated, $file_content, $matches );
			}
			$language_name = __( substr( $matches[1], 1, -1 ), 'wp-typography' ); // normally this doesn't work, but we may have added the
			// language name in the patgen file already.
			$language_code = substr( $file, 0, -4 );
			$languages[ $language_code ] = $language_name;
		}
	}
	closedir( $handler );

	asort( $languages );
	return $languages;
}

/**
 * Some debugging helpers
 */
if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
	define( 'WP_TYPOGRAPHY_DEBUG', true );
}

if ( defined( 'WP_TYPOGRAPHY_DEBUG' ) && WP_TYPOGRAPHY_DEBUG ) {
	if ( ! function_exists( 'clean_html' ) ) {
		/**
		 * Return encoded HTML string (everything except <>"').
		 *
		 * @param string $html
		 */
		function clean_html( $html ) {
			static $convmap = array(0x80, 0x10ffff, 0, 0xffffff);

			return str_replace( array('&lt;', '&gt;'), array('<', '>'), mb_encode_numericentity( htmlentities( $html, ENT_NOQUOTES, 'UTF-8', false ), $convmap, 'UTF-8' ) );
		}
	}

	// don't break without translation function
	if ( ! function_exists( '__' ) ) {
		/**
		 * Noop "translation" function for debugging.
		 *
		 * @param string $string
		 * @param string $domain
		 */
		function &__( $string, $domain = null ) { return $string; }
	}
}
