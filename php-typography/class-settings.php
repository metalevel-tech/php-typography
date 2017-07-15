<?php
/**
 *  This file is part of wp-Typography.
 *
 *  Copyright 2014-2017 Peter Putzer.
 *  Copyright 2009-2011 KINGdesk, LLC.
 *
 *  This program is free software; you can redistribute it and/or
 *  modify it under the terms of the GNU General Public License
 *  as published by the Free Software Foundation; either version 2
 *  of the License, or (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program; if not, write to the Free Software
 *  Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 *  ***
 *
 *  @package wpTypography/PHPTypography
 *  @license http://www.gnu.org/licenses/gpl-2.0.html
 */

namespace PHP_Typography;

use \PHP_Typography\Settings\Dash_Style;
use \PHP_Typography\Settings\Quote_Style;

/**
 * Store settings for the PHP_Typography class.
 *
 *  @author Peter Putzer <github@mundschenk.at>
 */
class Settings implements \ArrayAccess {

	/**
	 * The current no-break narrow space character.
	 *
	 * @var string
	 */
	protected $no_break_narrow_space;

	/**
	 * Primary quote style.
	 *
	 * @var Quotes
	 */
	protected $primary_quote_style;

	/**
	 * Secondary quote style.
	 *
	 * @var Quotes
	 */
	protected $secondary_quote_style;

	/**
	 * A hashmap of settings for the various typographic options.
	 *
	 * @var array
	 */
	protected $data = [];

	/**
	 * An array containing all self-closing HTML5 tags.
	 *
	 * @var array
	 */
	protected $self_closing_tags = [];

	/**
	 * A array of tags we should never touch.
	 *
	 * @var array
	 */
	protected $inappropriate_tags = [];

	/**
	 * An array of various regex components (not complete patterns).
	 *
	 * @var array $components
	 */
	protected $components = [];

	/**
	 * An array of regex patterns.
	 *
	 * @var array $regex
	 */
	protected $regex = [];

	/**
	 * An array in the form of [ '$style' => [ 'open' => $chr, 'close' => $chr ] ]
	 *
	 * @var array
	 */
	protected $quote_styles = [];

	/**
	 * The current dash style.
	 *
	 * @var Dashes
	 */
	protected $dash_style;

	/**
	 * An array in the form of [ '$tag' => true ]
	 *
	 * @var array
	 */
	protected $block_tags = [];

	/**
	 * Sets up a new Settings object.
	 *
	 * @param bool $set_defaults If true, set default values for various properties. Defaults to true.
	 */
	public function __construct( $set_defaults = true ) {
		$this->init( $set_defaults );
	}

	/**
	 * Provides access to named settings (object syntax).
	 *
	 * @param string $key The settings key.
	 *
	 * @return mixed
	 */
	public function &__get( $key ) {
		return $this->data[ $key ];
	}

	/**
	 * Changes a named setting (object syntax).
	 *
	 * @param string $key   The settings key.
	 * @param mixed  $value The settings value.
	 */
	public function __set( $key, $value ) {
		$this->data[ $key ] = $value;
	}

	/**
	 * Checks if a named setting exists (object syntax).
	 *
	 * @param string $key The settings key.
	 */
	public function __isset( $key ) {
		return isset( $this->data[ $key ] );
	}

	/**
	 * Unsets a named setting.
	 *
	 * @param string $key The settings key.
	 */
	public function __unset( $key ) {
		unset( $this->data[ $key ] );
	}

	/**
	 * Changes a named setting (array syntax).
	 *
	 * @param string $offset The settings key.
	 * @param mixed  $value  The settings value.
	 */
	public function offsetSet( $offset, $value ) {
		if ( is_null( $offset ) ) {
			$this->data[] = $value;
		} else {
			$this->data[ $offset ] = $value;
		}
	}

	/**
	 * Checks if a named setting exists (array syntax).
	 *
	 * @param string $offset The settings key.
	 */
	public function offsetExists( $offset ) {
		return isset( $this->data[ $offset ] );
	}

	/**
	 * Unsets a named setting (array syntax).
	 *
	 * @param string $offset The settings key.
	 */
	public function offsetUnset( $offset ) {
		unset( $this->data[ $offset ] );
	}

	/**
	 * Provides access to named settings (array syntax).
	 *
	 * @param string $offset The settings key.
	 *
	 * @return mixed
	 */
	public function offsetGet( $offset ) {
		return isset( $this->data[ $offset ] ) ? $this->data[ $offset ] : null;
	}

	/**
	 * Retrieves the current non-breaking narrow space character (either the
	 * regular non-breaking space &nbsp; or the the true non-breaking narrow space &#8239;).
	 *
	 * @return string
	 */
	public function no_break_narrow_space() {
		return $this->no_break_narrow_space;
	}

	/**
	 * Retrieves the primary (double) quote style.
	 *
	 * @return Settings\Quotes
	 */
	public function primary_quote_style() {
		return $this->primary_quote_style;
	}

	/**
	 * Retrieves the secondary (single) quote style.
	 *
	 * @return Settings\Quotes
	 */
	public function secondary_quote_style() {
		return $this->secondary_quote_style;
	}

	/**
	 * Retrieves the dash style.
	 *
	 * @return Settings\Dashes;
	 */
	public function dash_style() {
		return $this->dash_style;
	}

	/**
	 * Retrieves the named components calculated from the current settings.
	 *
	 * @return array
	 */
	public function get_components() {
		return $this->components;
	}

	/**
	 * Retrieves the named component string.
	 *
	 * @param string $name The component name.
	 *
	 * @return string|bool Returns the component or false if it does not exist.
	 */
	public function component( $name ) {
		if ( isset( $this->components[ $name ] ) ) {
			return $this->components[ $name ];
		} else {
			return false;
		}
	}

	/**
	 * Retrieves the regular expressions calculated from the current settings.
	 *
	 * @return array
	 */
	public function get_regular_expressions() {
		return $this->regex;
	}

	/**
	 * Retrieves the named regular expression.
	 *
	 * @param string $name The regex name.
	 *
	 * @return string|bool Returns the regular expression or false if it does not exist.
	 */
	public function regex( $name ) {
		if ( isset( $this->regex[ $name ] ) ) {
			return $this->regex[ $name ];
		} else {
			return false;
		}
	}

	/**
	 * Initialize the PHP_Typography object.
	 *
	 * @param bool $set_defaults If true, set default values for various properties. Defaults to true.
	 */
	private function init( $set_defaults = true ) {
		$this->no_break_narrow_space = U::NO_BREAK_SPACE;  // used in unit spacing - can be changed to 8239 via set_true_no_break_narrow_space.

		$this->dash_style = new Settings\Simple_Dashes( U::EM_DASH, U::THIN_SPACE, U::EN_DASH, U::THIN_SPACE );

		$this->primary_quote_style   = new Settings\Simple_Quotes( U::DOUBLE_QUOTE_OPEN, U::DOUBLE_QUOTE_CLOSE );
		$this->secondary_quote_style = new Settings\Simple_Quotes( U::SINGLE_QUOTE_OPEN, U::SINGLE_QUOTE_CLOSE );

		// All other encodings get the empty array.
		// Set up regex patterns.
		$this->initialize_components();
		$this->initialize_patterns();

		// Set up some arrays for quick HTML5 introspection.
		$this->self_closing_tags = array_filter( array_keys( \Masterminds\HTML5\Elements::$html5 ), function( $tag ) {
			return \Masterminds\HTML5\Elements::isA( $tag, \Masterminds\HTML5\Elements::VOID_TAG );
		} );
		$this->inappropriate_tags = [ 'iframe', 'textarea', 'button', 'select', 'optgroup', 'option', 'map', 'style', 'head', 'title', 'script', 'applet', 'object', 'param' ];

		if ( $set_defaults ) {
			$this->set_defaults();
		}
	}

	/**
	 * (Re)set various options to their default values.
	 */
	public function set_defaults() {
		// General attributes.
		$this->set_tags_to_ignore();
		$this->set_classes_to_ignore();
		$this->set_ids_to_ignore();

		// Smart characters.
		$this->set_smart_quotes();
		$this->set_smart_quotes_primary();
		$this->set_smart_quotes_secondary();
		$this->set_smart_dashes();
		$this->set_smart_dashes_style();
		$this->set_smart_ellipses();
		$this->set_smart_diacritics();
		$this->set_diacritic_language();
		$this->set_diacritic_custom_replacements();
		$this->set_smart_marks();
		$this->set_smart_ordinal_suffix();
		$this->set_smart_math();
		$this->set_smart_fractions();
		$this->set_smart_exponents();

		// Smart spacing.
		$this->set_single_character_word_spacing();
		$this->set_fraction_spacing();
		$this->set_unit_spacing();
		$this->set_french_punctuation_spacing();
		$this->set_units();
		$this->set_dash_spacing();
		$this->set_dewidow();
		$this->set_max_dewidow_length();
		$this->set_max_dewidow_pull();
		$this->set_wrap_hard_hyphens();
		$this->set_url_wrap();
		$this->set_email_wrap();
		$this->set_min_after_url_wrap();
		$this->set_space_collapse();
		$this->set_true_no_break_narrow_space();

		// Character styling.
		$this->set_style_ampersands();
		$this->set_style_caps();
		$this->set_style_initial_quotes();
		$this->set_style_numbers();
		$this->set_style_hanging_punctuation();
		$this->set_initial_quote_tags();

		// Hyphenation.
		$this->set_hyphenation();
		$this->set_hyphenation_language();
		$this->set_min_length_hyphenation();
		$this->set_min_before_hyphenation();
		$this->set_min_after_hyphenation();
		$this->set_hyphenate_headings();
		$this->set_hyphenate_all_caps();
		$this->set_hyphenate_title_case();
		$this->set_hyphenate_compounds();
		$this->set_hyphenation_exceptions();

		// Parser error handling.
		$this->set_ignore_parser_errors();
	}

	/**
	 * Sets up our regex components (but not complete patterns) for later use.
	 *
	 * Call before initialize_patterns().
	 */
	private function initialize_components() {

		/**
		 * Find the HTML character representation for the following characters:
		 *      tab | line feed | carriage return | space | non-breaking space | ethiopic wordspace
		 *      ogham space mark | en quad space | em quad space | en-space | three-per-em space
		 *      four-per-em space | six-per-em space | figure space | punctuation space | em-space
		 *      thin space | hair space | narrow no-break space
		 *      medium mathematical space | ideographic space
		 * Some characters are used inside words, we will not count these as a space for the purpose
		 * of finding word boundaries:
		 *      zero-width-space ("&#8203;", "&#x200b;")
		 *      zero-width-joiner ("&#8204;", "&#x200c;", "&zwj;")
		 *      zero-width-non-joiner ("&#8205;", "&#x200d;", "&zwnj;")
		 */
		$this->components['htmlSpaces'] = '
			\x{00a0}		# no-break space
			|
			\x{1361}		# ethiopic wordspace
			|
			\x{2000}		# en quad-space
			|
			\x{2001}		# em quad-space
			|
			\x{2002}		# en space
			|
			\x{2003}		# em space
			|
			\x{2004}		# three-per-em space
			|
			\x{2005}		# four-per-em space
			|
			\x{2006}		# six-per-em space
			|
			\x{2007}		# figure space
			|
			\x{2008}		# punctuation space
			|
			\x{2009}		# thin space
			|
			\x{200a}		# hair space
			|
			\x{200b}		# zero-width space
			|
			\x{200c}		# zero-width joiner
			|
			\x{200d}		# zero-width non-joiner
			|
			\x{202f}		# narrow no-break space
			|
			\x{205f}		# medium mathematical space
			|
			\x{3000}		# ideographic space
			'; // required modifiers: x (multiline pattern) i (case insensitive) u (utf8).
		$this->components['normalSpaces'] = ' \f\n\r\t\v'; // equivalent to \s in non-Unicode mode.

		// Hanging punctuation.
		$this->components['doubleHangingPunctuation'] = '
			"' .
			U::DOUBLE_QUOTE_OPEN .
			U::DOUBLE_QUOTE_CLOSE .
			U::DOUBLE_LOW_9_QUOTE .
			U::DOUBLE_PRIME; // requires modifiers: x (multiline pattern) u (utf8).
		$this->components['singleHangingPunctuation'] = "
			'" .
			U::SINGLE_QUOTE_OPEN .
			U::SINGLE_QUOTE_CLOSE .
			U::SINGLE_LOW_9_QUOTE .
			U::SINGLE_PRIME .
			U::APOSTROPHE; // requires modifiers: x (multiline pattern) u (utf8).

		$this->components['unitSpacingStandardUnits'] = '
			### Temporal units
			(?:ms|s|secs?|mins?|hrs?)\.?|
			milliseconds?|seconds?|minutes?|hours?|days?|years?|decades?|century|centuries|millennium|millennia|

			### Imperial units
			(?:in|ft|yd|mi)\.?|
			(?:ac|ha|oz|pt|qt|gal|lb|st)\.?
			s\.f\.|sf|s\.i\.|si|square[ ]feet|square[ ]foot|
			inch|inches|foot|feet|yards?|miles?|acres?|hectares?|ounces?|pints?|quarts?|gallons?|pounds?|stones?|

			### Metric units (with prefixes)
			(?:p|µ|[mcdhkMGT])?
			(?:[mgstAKNJWCVFSTHBL]|mol|cd|rad|Hz|Pa|Wb|lm|lx|Bq|Gy|Sv|kat|Ω|Ohm|&Omega;|&\#0*937;|&\#[xX]0*3[Aa]9;)|
			(?:nano|micro|milli|centi|deci|deka|hecto|kilo|mega|giga|tera)?
			(?:liters?|meters?|grams?|newtons?|pascals?|watts?|joules?|amperes?)|

			### Computers units (KB, Kb, TB, Kbps)
			[kKMGT]?(?:[oBb]|[oBb]ps|flops)|

			### Money
			¢|M?(?:£|¥|€|$)|

			### Other units
			°[CF]? |
			%|pi|M?px|em|en|[NSEOW]|[NS][EOW]|mbar
		'; // required modifiers: x (multiline pattern).

		// Numbered abbreviations.
		$this->components['numberedAbbreviationsISO'] = 'ISO(?:\/(?:IEC|TR|TS))?';
		$this->components['numberedAbbreviations'] = "
			### Internationl standards
			{$this->components['numberedAbbreviationsISO']}|

			### German standards
			DIN|
			DIN[ ]EN(?:[ ]{$this->components['numberedAbbreviationsISO']})?|
			DIN[ ]EN[ ]ISP
			DIN[ ]{$this->components['numberedAbbreviationsISO']}|
			DIN[ ]IEC|
			DIN[ ]CEN\/TS|
			DIN[ ]CLC\/TS|
			DIN[ ]CWA|
			DIN[ ]VDE|

			LN|VG|VDE|VDI

			### Austrian standards
			ÖNORM|
			ÖNORM[ ](?:A|B|C|E|F|G|H|K|L|M|N|O|S|V|Z)|
			ÖNORM[ ]EN(?:[ ]{$this->components['numberedAbbreviationsISO']})?|
			ÖNORM[ ]ETS|

			ÖVE|ONR|

			### Food additives
			E
		"; // required modifiers: x (multiline pattern).

		$this->components['hyphensArray'] = array_unique( [ '-', U::HYPHEN ] );
		$this->components['hyphens']      = implode( '|', $this->components['hyphensArray'] );

		$this->components['numbersPrime'] = '\b(?:\d+\/)?\d{1,3}';

		/*
		 // \p{Lu} equals upper case letters and should match non english characters; since PHP 4.4.0 and 5.1.0
		 // for more info, see http://www.regextester.com/pregsyntax.html#regexp.reference.unicode
		 $this->components['styleCaps']  = '
		 (?<![\w\-_'.U::ZERO_WIDTH_SPACE.U::SOFT_HYPHEN.'])
		 # negative lookbehind assertion
		 (
		 (?:							# CASE 1: " 9A "
		 [0-9]+					# starts with at least one number
		 \p{Lu}					# must contain at least one capital letter
		 (?:\p{Lu}|[0-9]|\-|_|'.U::ZERO_WIDTH_SPACE.'|'.U::SOFT_HYPHEN.')*
		 # may be followed by any number of numbers capital letters, hyphens, underscores, zero width spaces, or soft hyphens
		 )
		 |
		 (?:							# CASE 2: " A9 "
		 \p{Lu}					# starts with capital letter
		 (?:\p{Lu}|[0-9])		# must be followed a number or capital letter
		 (?:\p{Lu}|[0-9]|\-|_|'.U::ZERO_WIDTH_SPACE.'|'.U::SOFT_HYPHEN.')*
		 # may be followed by any number of numbers capital letters, hyphens, underscores, zero width spaces, or soft hyphens

		 )
		 )
		 (?![\w\-_'.U::ZERO_WIDTH_SPACE.U::SOFT_HYPHEN.'])
		 # negative lookahead assertion
		 '; // required modifiers: x (multiline pattern) u (utf8)
		 */

		// Servers with PCRE compiled without "--enable-unicode-properties" fail at \p{Lu} by returning an empty string (this leaving the screen void of text
		// thus are testing this alternative.
		$this->components['styleCaps'] = '
				(?<![\w\-_' . U::ZERO_WIDTH_SPACE . U::SOFT_HYPHEN . ']) # negative lookbehind assertion
				(
					(?:							# CASE 1: " 9A "
						[0-9]+					# starts with at least one number
						(?:\-|_|' . U::ZERO_WIDTH_SPACE . '|' . U::SOFT_HYPHEN . ')*
								                # may contain hyphens, underscores, zero width spaces, or soft hyphens,
						[A-ZÀ-ÖØ-Ý]				# but must contain at least one capital letter
						(?:[A-ZÀ-ÖØ-Ý]|[0-9]|\-|_|' . U::ZERO_WIDTH_SPACE . '|' . U::SOFT_HYPHEN . ')*
												# may be followed by any number of numbers capital letters, hyphens, underscores, zero width spaces, or soft hyphens
					)
					|
					(?:							# CASE 2: " A9 "
						[A-ZÀ-ÖØ-Ý]				# starts with capital letter
						(?:[A-ZÀ-ÖØ-Ý]|[0-9])	# must be followed a number or capital letter
						(?:[A-ZÀ-ÖØ-Ý]|[0-9]|\-|_|' . U::ZERO_WIDTH_SPACE . '|' . U::SOFT_HYPHEN . ')*
												# may be followed by any number of numbers capital letters, hyphens, underscores, zero width spaces, or soft hyphens
					)
				)
				(?![\w\-_' . U::ZERO_WIDTH_SPACE . U::SOFT_HYPHEN . ']) # negative lookahead assertion
			'; // required modifiers: x (multiline pattern) u (utf8).

		// Initialize valid top level domains from IANA list.
		$this->components['validTopLevelDomains'] = $this->get_top_level_domains_from_file( dirname( __DIR__ ) . '/vendor/IANA/tlds-alpha-by-domain.txt' );
		// Valid URL schemes.
		$this->components['urlScheme'] = '(?:https?|ftps?|file|nfs|feed|itms|itpc)';
		// Combined URL pattern.
		$this->components['urlPattern'] = "(?:
			\A
			(?<schema>{$this->components['urlScheme']}:\/\/)?	# Subpattern 1: contains _http://_ if it exists
			(?<domain>											# Subpattern 2: contains subdomains.domain.tld
				(?:
					[a-z0-9]									# first chr of (sub)domain can not be a hyphen
					[a-z0-9\-]{0,61}							# middle chrs of (sub)domain may be a hyphen;
																# limit qty of middle chrs so total domain does not exceed 63 chrs
					[a-z0-9]									# last chr of (sub)domain can not be a hyphen
					\.											# dot separator
				)+
				(?:
					{$this->components['validTopLevelDomains']}	# validates top level domain
				)
				(?:												# optional port numbers
					:
					(?:
						[1-5]?[0-9]{1,4} | 6[0-4][0-9]{3} | 65[0-4][0-9]{2} | 655[0-2][0-9] | 6553[0-5]
					)
				)?
			)
			(?<path>											# Subpattern 3: contains path following domain
				(?:
					\/											# marks nested directory
					[a-z0-9\"\$\-_\.\+!\*\'\(\),;\?:@=&\#]+		# valid characters within directory structure
				)*
				[\/]?											# trailing slash if any
			)
			\Z
		)"; // required modifiers: x (multiline pattern) i (case insensitive).

		$this->components['wrapEmailsEmailPattern'] = "(?:
			\A
			[a-z0-9\!\#\$\%\&\'\*\+\/\=\?\^\_\`\{\|\}\~\-]+
			(?:
				\.
				[a-z0-9\!\#\$\%\&\'\*\+\/\=\?\^\_\`\{\|\}\~\-]+
			)*
			@
			(?:
				[a-z0-9]
				[a-z0-9\-]{0,61}
				[a-z0-9]
				\.
			)+
			(?:
				{$this->components['validTopLevelDomains']}
			)
			\Z
		)"; // required modifiers: x (multiline pattern) i (case insensitive).

		$this->components['smartQuotesApostropheExceptions'] = [
			"'tain" . U::APOSTROPHE . 't' => U::APOSTROPHE . 'tain' . U::APOSTROPHE . 't',
			"'twere"                             => U::APOSTROPHE . 'twere',
			"'twas"                              => U::APOSTROPHE . 'twas',
			"'tis"                               => U::APOSTROPHE . 'tis',
			"'til"                               => U::APOSTROPHE . 'til',
			"'bout"                              => U::APOSTROPHE . 'bout',
			"'nuff"                              => U::APOSTROPHE . 'nuff',
			"'round"                             => U::APOSTROPHE . 'round',
			"'cause"                             => U::APOSTROPHE . 'cause',
			"'splainin"                          => U::APOSTROPHE . 'splainin',
		];
		$this->components['smartQuotesApostropheExceptionMatches']      = array_keys( $this->components['smartQuotesApostropheExceptions'] );
		$this->components['smartQuotesApostropheExceptionReplacements'] = array_values( $this->components['smartQuotesApostropheExceptions'] );

		// These patterns need to be updated whenever the quote style changes.
		$this->update_smart_quotes_brackets();

		// Marker for strings that should not be replaced.
		$this->components['escapeMarker'] = '_E_S_C_A_P_E_D_';

		// Smart diacritics "word non-boundaries".
		$this->components['smartDiacriticsWordBoundaryInitial'] = '\b(?<!\w[' . U::NO_BREAK_SPACE . U::SOFT_HYPHEN . '])';
		$this->components['smartDiacriticsWordBoundaryFinal'] = '\b(?![' . U::NO_BREAK_SPACE . U::SOFT_HYPHEN . ']\w)';
	}

	/**
	 * Update smartQuotesBrackets component after quote style change.
	 */
	private function update_smart_quotes_brackets() {
		$this->components['smartQuotesBrackets'] = [
			// Single quotes.
			"['"  => '[' . $this->secondary_quote_style->open(),
			"{'"  => '{' . $this->secondary_quote_style->open(),
			"('"  => '(' . $this->secondary_quote_style->open(),
			"']"  => $this->secondary_quote_style->close() . ']',
			"'}"  => $this->secondary_quote_style->close() . '}',
			"')"  => $this->secondary_quote_style->close() . ')',

			// Double quotes.
			'["' => '[' . $this->primary_quote_style->open(),
			'{"' => '{' . $this->primary_quote_style->open(),
			'("' => '(' . $this->primary_quote_style->open(),
			'"]' => $this->primary_quote_style->close() . ']',
			'"}' => $this->primary_quote_style->close() . '}',
			'")' => $this->primary_quote_style->close() . ')',

			// Quotes & quotes.
			"\"'" => $this->primary_quote_style->open() . $this->secondary_quote_style->open(),
			"'\"" => $this->secondary_quote_style->close() . $this->primary_quote_style->close(),
		];
		$this->components['smartQuotesBracketMatches']      = array_keys( $this->components['smartQuotesBrackets'] );
		$this->components['smartQuotesBracketReplacements'] = array_values( $this->components['smartQuotesBrackets'] );
	}

	/**
	 * Load a list of top-level domains from a file.
	 *
	 * @param string $path The full path and filename.
	 * @return string A list of top-level domains concatenated with '|'.
	 */
	public function get_top_level_domains_from_file( $path ) {
		$domains = [];

		if ( file_exists( $path ) ) {
			$file = new \SplFileObject( $path );

			while ( ! $file->eof() ) {
				$line = $file->fgets();

				if ( preg_match( '#^[a-zA-Z0-9][a-zA-Z0-9-]*$#', $line, $matches ) ) {
					$domains[] = strtolower( $matches[0] );
				}
			}
		}

		if ( count( $domains ) > 0 ) {
			return implode( '|', $domains );
		} else {
			return 'ac|ad|aero|ae|af|ag|ai|al|am|an|ao|aq|arpa|ar|asia|as|at|au|aw|ax|az|ba|bb|bd|be|bf|bg|bh|biz|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|cat|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|com|coop|co|cr|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gg|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|im|info|int|in|io|iq|ir|is|it|je|jm|jobs|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mobi|mo|mp|mq|mr|ms|mt|museum|mu|mv|mw|mx|my|mz|name|na|nc|net|ne|nf|ng|ni|nl|no|np|nr|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pro|pr|ps|pt|pw|py|qa|re|ro|rs|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tel|tf|tg|th|tj|tk|tl|tm|tn|to|tp|travel|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw';
		}
	}

	/**
	 * Sets up our regex patterns for later use.
	 *
	 * Call after intialize_components().
	 */
	private function initialize_patterns() {
		// Actual regex patterns.
		$this->regex['customDiacriticsDoubleQuoteKey']   = '/(?:")([^"]+)(?:"\s*=>)/';
		$this->regex['customDiacriticsSingleQuoteKey']   = "/(?:')([^']+)(?:'\s*=>)/";
		$this->regex['customDiacriticsDoubleQuoteValue'] = '/(?:=>\s*")([^"]+)(?:")/';
		$this->regex['customDiacriticsSingleQuoteValue'] = "/(?:=>\s*')([^']+)(?:')/";

		$this->regex['controlCharacters'] = '/\p{C}/Su'; // obsolete.

		$this->regex['smartQuotesSingleQuotedNumbers']       = "/(?<=\W|\A)'([^\"]*\d+)'(?=\W|\Z)/u";
		$this->regex['smartQuotesDoubleQuotedNumbers']       = '/(?<=\W|\A)"([^"]*\d+)"(?=\W|\Z)/u';
		$this->regex['smartQuotesDoublePrime']               = "/({$this->components['numbersPrime']})''(?=\W|\Z)/u";
		$this->regex['smartQuotesDoublePrimeCompound']       = "/({$this->components['numbersPrime']})''(?=-\w)/u";
		$this->regex['smartQuotesDoublePrime1Glyph']         = "/({$this->components['numbersPrime']})\"(?=\W|\Z)/u";
		$this->regex['smartQuotesDoublePrime1GlyphCompound'] = "/({$this->components['numbersPrime']})\"(?=-\w)/u";
		$this->regex['smartQuotesSinglePrime']               = "/({$this->components['numbersPrime']})'(?=\W|\Z)/u";
		$this->regex['smartQuotesSinglePrimeCompound']       = "/({$this->components['numbersPrime']})'(?=-\w)/u";
		$this->regex['smartQuotesSingleDoublePrime']         = "/({$this->components['numbersPrime']})'(\s*)(\b(?:\d+\/)?\d+)''(?=\W|\Z)/u";
		$this->regex['smartQuotesSingleDoublePrime1Glyph']   = "/({$this->components['numbersPrime']})'(\s*)(\b(?:\d+\/)?\d+)\"(?=\W|\Z)/u";
		$this->regex['smartQuotesCommaQuote']                = '/(?<=\s|\A),(?=\S)/';
		$this->regex['smartQuotesApostropheWords']           = "/(?<=[\w])'(?=[\w])/u";
		$this->regex['smartQuotesApostropheDecades']         = "/'(\d\d\b)/";
		$this->regex['smartQuotesSingleQuoteOpen']           = "/'(?=[\w])/u";
		$this->regex['smartQuotesSingleQuoteClose']          = "/(?<=[\w])'/u";
		$this->regex['smartQuotesSingleQuoteOpenSpecial']    = "/(?<=\s|\A)'(?=\S)/"; // like _'¿hola?'_.
		$this->regex['smartQuotesSingleQuoteCloseSpecial']   = "/(?<=\S)'(?=\s|\Z)/";
		$this->regex['smartQuotesDoubleQuoteOpen']           = '/"(?=[\w])/u';
		$this->regex['smartQuotesDoubleQuoteClose']          = '/(?<=[\w])"/u';
		$this->regex['smartQuotesDoubleQuoteOpenSpecial']    = '/(?<=\s|\A)"(?=\S)/';
		$this->regex['smartQuotesDoubleQuoteCloseSpecial']   = '/(?<=\S)"(?=\s|\Z)/';

		$this->regex['smartDashesParentheticalDoubleDash']   = "/(\s|{$this->components['htmlSpaces']})--(\s|{$this->components['htmlSpaces']})/xui"; // ' -- '.
		$this->regex['smartDashesParentheticalSingleDash']   = "/(\s|{$this->components['htmlSpaces']})-(\s|{$this->components['htmlSpaces']})/xui";  // ' - '.
		$this->regex['smartDashesEnDashWords']               = '/([\w])\-(' . U::THIN_SPACE . '|' . U::HAIR_SPACE . "|{$this->no_break_narrow_space})/u";
		$this->regex['smartDashesEnDashNumbers']             = "/(\b\d+(\.?))\-(\d+\\2)/";
		$this->regex['smartDashesEnDashPhoneNumbers']        = "/(\b\d{3})" . U::EN_DASH . "(\d{4}\b)/";
		$this->regex['smartDashesYYYY-MM-DD']                = '/
                (
                    (?<=\s|\A|' . U::NO_BREAK_SPACE . ')
                    [12][0-9]{3}
                )
                [\-' . U::EN_DASH . ']
                (
                    (?:[0][1-9]|[1][0-2])
                )
                [\-' . U::EN_DASH . "]
				(
					(?:[0][1-9]|[12][0-9]|[3][0-1])
					(?=\s|\Z|\)|\]|\.|\,|\?|\;|\:|\'|\"|\!|" . U::NO_BREAK_SPACE . ')
                )
            /xu';

		$this->regex['smartDashesMM-DD-YYYY']                = '/
                (?:
                    (?:
                        (
                            (?<=\s|\A|' . U::NO_BREAK_SPACE . ')
                            (?:[0]?[1-9]|[1][0-2])
                        )
                        [\-' . U::EN_DASH . ']
                        (
                            (?:[0]?[1-9]|[12][0-9]|[3][0-1])
                        )
                    )
                    |
                    (?:
                        (
                            (?<=\s|\A|' . U::NO_BREAK_SPACE . ')
                            (?:[0]?[1-9]|[12][0-9]|[3][0-1])
                        )
                        [\-' . U::EN_DASH . ']
                        (
                            (?:[0]?[1-9]|[1][0-2])
                        )
                    )
                )
                [\-' . U::EN_DASH . "]
				(
					[12][0-9]{3}
					(?=\s|\Z|\)|\]|\.|\,|\?|\;|\:|\'|\"|\!|" . U::NO_BREAK_SPACE . ')
                )
            /xu';
		$this->regex['smartDashesYYYY-MM']                   = '/
                (
                    (?<=\s|\A|' . U::NO_BREAK_SPACE . ')
                    [12][0-9]{3}
                )
                [\-' . U::EN_DASH . "]
				(
					(?:
						(?:[0][1-9]|[1][0-2])
						|
						(?:[0][0-9][1-9]|[1-2][0-9]{2}|[3][0-5][0-9]|[3][6][0-6])
					)
					(?=\s|\Z|\)|\]|\.|\,|\?|\;|\:|\'|\"|\!|" . U::NO_BREAK_SPACE . ')
                )
            /xu';

		// Smart math.
		// First, let's find math equations.
		$this->regex['smartMathEquation'] = "/
				(?<=\A|\s)										# lookbehind assertion: proceeded by beginning of string or space
				[\.,\'\"\¿\¡" . U::ELLIPSIS . $this->secondary_quote_style->open() . $this->primary_quote_style->open() . U::GUILLEMET_OPEN . U::GUILLEMET_CLOSE . U::SINGLE_LOW_9_QUOTE . U::DOUBLE_LOW_9_QUOTE . ']*
                                                                # allowed proceeding punctuation
                [\-\(' . U::MINUS . ']*                  # optionally proceeded by dash, minus sign or open parenthesis
                [0-9]+                                          # must begin with a number
                (\.[0-9]+)?                                     # optionally allow decimal values after first integer
                (                                               # followed by a math symbol and a number
                    [\/\*x\-+=\^' . U::MINUS . U::MULTIPLICATION . U::DIVISION . ']
                                                                # allowed math symbols
                    [\-\(' . U::MINUS . ']*              # opptionally preceeded by dash, minus sign or open parenthesis
                    [0-9]+                                      # must begin with a number
                    (\.[0-9]+)?                                 # optionally allow decimal values after first integer
                    [\-\(\)' . U::MINUS . "]*			# opptionally preceeded by dash, minus sign or parenthesis
				)+
				[\.,;:\'\"\?\!" . U::ELLIPSIS . $this->secondary_quote_style->close() . $this->primary_quote_style->close() . U::GUILLEMET_OPEN . U::GUILLEMET_CLOSE . ']*
                                                                # allowed trailing punctuation
                (?=\Z|\s)                                       # lookahead assertion: followed by end of string or space
            /ux';
		// Revert 4-4 to plain minus-hyphen so as to not mess with ranges of numbers (i.e. pp. 46-50).
		$this->regex['smartMathRevertRange'] = '/
                (
                    (?<=\s|\A|' . U::NO_BREAK_SPACE . ')
                    \d+
                )
                [\-' . U::MINUS . "]
				(
					\d+
					(?=\s|\Z|\)|\]|\.|\,|\?|\;|\:|\'|\"|\!|" . U::NO_BREAK_SPACE . ')
                )
            /xu';
		// Revert fractions to basic slash.
		// We'll leave styling fractions to smart_fractions.
		$this->regex['smartMathRevertFraction'] = "/
				(
					(?<=\s|\A|\'|\"|" . U::NO_BREAK_SPACE . ')
                    \d+
                )
                ' . U::DIVISION . "
				(
					\d+
					(?:st|nd|rd|th)?
					(?=\s|\Z|\)|\]|\.|\,|\?|\;|\:|\'|\"|\!|" . U::NO_BREAK_SPACE . ')
                )
            /xu';
		// Revert date back to original formats:
		// YYYY-MM-DD.
		$this->regex['smartMathRevertDateYYYY-MM-DD'] = '/
                (
                    (?<=\s|\A|' . U::NO_BREAK_SPACE . ')
                    [12][0-9]{3}
                )
                [\-' . U::MINUS . ']
                (
                    (?:[0]?[1-9]|[1][0-2])
                )
                [\-' . U::MINUS . "]
				(
					(?:[0]?[1-9]|[12][0-9]|[3][0-1])
					(?=\s|\Z|\)|\]|\.|\,|\?|\;|\:|\'|\"|\!|" . U::NO_BREAK_SPACE . ')
                )
            /xu';
		// MM-DD-YYYY or DD-MM-YYYY.
		$this->regex['smartMathRevertDateMM-DD-YYYY'] = '/
                (?:
                    (?:
                        (
                            (?<=\s|\A|' . U::NO_BREAK_SPACE . ')
                            (?:[0]?[1-9]|[1][0-2])
                        )
                        [\-' . U::MINUS . ']
                        (
                            (?:[0]?[1-9]|[12][0-9]|[3][0-1])
                        )
                    )
                    |
                    (?:
                        (
                            (?<=\s|\A|' . U::NO_BREAK_SPACE . ')
                            (?:[0]?[1-9]|[12][0-9]|[3][0-1])
                        )
                        [\-' . U::MINUS . ']
                        (
                            (?:[0]?[1-9]|[1][0-2])
                        )
                    )
                )
                [\-' . U::MINUS . "]
				(
					[12][0-9]{3}
					(?=\s|\Z|\)|\]|\.|\,|\?|\;|\:|\'|\"|\!|" . U::NO_BREAK_SPACE . ')
                )
            /xu';
		// YYYY-MM or YYYY-DDD next.
		$this->regex['smartMathRevertDateYYYY-MM'] = '/
                (
                    (?<=\s|\A|' . U::NO_BREAK_SPACE . ')
                    [12][0-9]{3}
                )
                [\-' . U::MINUS . "]
				(
					(?:
						(?:[0][1-9]|[1][0-2])
						|
						(?:[0][0-9][1-9]|[1-2][0-9]{2}|[3][0-5][0-9]|[3][6][0-6])
					)
					(?=\s|\Z|\)|\]|\.|\,|\?|\;|\:|\'|\"|\!|" . U::NO_BREAK_SPACE . ')
                )
            /xu';

		// MM/DD/YYYY or DD/MM/YYYY.
		$this->regex['smartMathRevertDateMM/DD/YYYY'] = '/
                (?:
                    (?:
                        (
                            (?<=\s|\A|' . U::NO_BREAK_SPACE . ')
                            (?:[0][1-9]|[1][0-2])
                        )
                        [\/' . U::DIVISION . ']
                        (
                            (?:[0][1-9]|[12][0-9]|[3][0-1])
                        )
                    )
                    |
                    (?:
                        (
                            (?<=\s|\A|' . U::NO_BREAK_SPACE . ')
                            (?:[0][1-9]|[12][0-9]|[3][0-1])
                        )
                        [\/' . U::DIVISION . ']
                        (
                            (?:[0][1-9]|[1][0-2])
                        )
                    )
                )
                [\/' . U::DIVISION . "]
				(
					[12][0-9]{3}
					(?=\s|\Z|\)|\]|\.|\,|\?|\;|\:|\'|\"|\!|" . U::NO_BREAK_SPACE . ')
                )
            /xu';

		// Handle exponents (ie. 4^2).
		$this->regex['smartExponents'] = "/
			\b
			(\d+)
			\^
			(\w+)
			\b
		/xu";

		$this->regex['smartFractionsSpacing'] = '/\b(\d+)\s(\d+\s?\/\s?\d+)\b/';
		$this->regex['smartFractionsReplacement'] = '/
			(?<=\A|\s|' . U::NO_BREAK_SPACE . "|{$this->no_break_narrow_space})		# lookbehind assertion: makes sure we are not messing up a url
			(\d+)
			(?:\s?\/\s?" . U::ZERO_WIDTH_SPACE . '?)	# strip out any zero-width spaces inserted by wrap_hard_hyphens
			(\d+)
			(
				(?:' . U::SINGLE_PRIME . '|' . U::DOUBLE_PRIME . ')? # handle fractions followed by prime symbols
				(?:\<sup\>(?:st|nd|rd|th)<\/sup\>)?                          # handle ordinals after fractions
				(?:\Z|\s|' . U::NO_BREAK_SPACE . "|{$this->no_break_narrow_space}|\.|\!|\?|\)|\;|\:|\'|\")	# makes sure we are not messing up a url
			)
			/xu";
		$this->regex['smartFractionsEscapeMM/YYYY'] = '/
			(?<=\A|\s|' . U::NO_BREAK_SPACE . "|{$this->no_break_narrow_space})		# lookbehind assertion: makes sure we are not messing up a url
				(\d\d?)
			(\s?\/\s?" . U::ZERO_WIDTH_SPACE . '?)	# capture any zero-width spaces inserted by wrap_hard_hyphens
				(
					(?:19\d\d)|(?:20\d\d) # handle 4-decimal years in the 20th and 21st centuries
				)
				(
					(?:\Z|\s|' . U::NO_BREAK_SPACE . "|{$this->no_break_narrow_space}|\.|\!|\?|\)|\;|\:|\'|\")	# makes sure we are not messing up a url
				)
			/xu";

		$year_regex = [];
		for ( $year = 1900; $year < 2100; ++$year ) {
			$year_regex[] = "(?: ( $year ) (\s?\/\s?" . U::ZERO_WIDTH_SPACE . '?) ( ' . ( $year + 1 ) . ' ) )';
		}
		$this->regex['smartFractionsEscapeYYYY/YYYY'] = '/
			(?<=\A|\s|' . U::NO_BREAK_SPACE . "|{$this->no_break_narrow_space})		# lookbehind assertion: makes sure we are not messing up a url
			(?| " . implode( '|', $year_regex ) . ' )
			(
				(?:\Z|\s|' . U::NO_BREAK_SPACE . "|{$this->no_break_narrow_space}|\.|\!|\?|\)|\;|\:|\'|\")	# makes sure we are not messing up a url
			)
			/xu";

		$this->regex['smartOrdinalSuffix'] = "/\b(\d+)(st|nd|rd|th)\b/"; // End smart math.

		// Smart marks.
		$this->regex['smartMarksEscape501(c)'] = '/\b(501\()(c)(\)\((?:[1-9]|[1-2][0-9])\))/u';

		// Whitespace handling.
		$this->regex['singleCharacterWordSpacing'] = "/
				(?:
					(\s)
					(\w)
					[{$this->components['normalSpaces']}]
					(?=\w)
				)
			/xu";

		$this->regex['dashSpacingEmDash'] = '/
				(?:
					\s
					(' . U::EM_DASH . ')
					\s
				)
				|
				(?:
					(?<=\S)							# lookbehind assertion
					(' . U::EM_DASH . ')
					(?=\S)							# lookahead assertion
				)
			/xu';
		$this->regex['dashSpacingParentheticalDash'] = '/
				(?:
					\s
					(' . U::EN_DASH . ')
					\s
				)
			/xu';
		$this->regex['dashSpacingIntervalDash'] = '/
				(?:
					(?<=\S)							# lookbehind assertion
					(' . U::EN_DASH . ')
					(?=\S)							# lookahead assertion
				)
			/xu';

		$this->regex['spaceCollapseNormal']       = "/[{$this->components['normalSpaces']}]+/xu";
		$this->regex['spaceCollapseNonBreakable'] = "/(?:[{$this->components['normalSpaces']}]|{$this->components['htmlSpaces']})*" . U::NO_BREAK_SPACE . "(?:[{$this->components['normalSpaces']}]|{$this->components['htmlSpaces']})*/xu";
		$this->regex['spaceCollapseOther']        = "/(?:[{$this->components['normalSpaces']}])*({$this->components['htmlSpaces']})(?:[{$this->components['normalSpaces']}]|{$this->components['htmlSpaces']})*/xu";
		$this->regex['spaceCollapseBlockStart']   = "/\A(?:[{$this->components['normalSpaces']}]|{$this->components['htmlSpaces']})+/xu";

		// Unit spacing.
		$this->regex['unitSpacingEscapeSpecialChars'] = '#([\[\\\^\$\.\|\?\*\+\(\)\{\}])#';
		$this->update_unit_pattern( isset( $this->data['units'] ) ? $this->data['units'] : [] );

		// Numbered abbreviations spacing.
		$this->regex['numberedAbbreviationSpacing'] = "/\b({$this->components['numberedAbbreviations']})[{$this->components['normalSpaces']}]+([0-9]+)/xu";

		// French punctuation spacing.
		$this->regex['frenchPunctuationSpacingNarrow']       = '/(\w+(?:\s?»)?)(\s?)([?!])(\s|\Z)/u';
		$this->regex['frenchPunctuationSpacingFull']         = '/(\w+(?:\s?»)?)(\s?)(:)(\s|\Z)/u';
		$this->regex['frenchPunctuationSpacingSemicolon']    = '/(\w+(?:\s?»)?)(\s?)((?<!&amp|&gt|&lt);)(\s|\Z)/u';
		$this->regex['frenchPunctuationSpacingOpeningQuote'] = '/(\s|\A)(«)(\s?)(\w+)/u';
		$this->regex['frenchPunctuationSpacingClosingQuote'] = '/(\w+[.?!]?)(\s?)(»)(\s|[.?!:]|\Z)/u';

		// Wrap hard hyphens.
		$this->regex['wrapHardHyphensRemoveEndingSpace'] = "/({$this->components['hyphens']})" . U::ZERO_WIDTH_SPACE . '$/';

		// Wrap emails.
		$this->regex['wrapEmailsMatchEmails']   = "/{$this->components['wrapEmailsEmailPattern']}/xi";
		$this->regex['wrapEmailsReplaceEmails'] = '/([^a-zA-Z])/';

		// Wrap URLs.
		$this->regex['wrapUrlsPattern']     = "`{$this->components['urlPattern']}`xi";
		$this->regex['wrapUrlsDomainParts'] = '#(\-|\.)#';

		// Style caps.
		$this->regex['styleCaps'] = "/{$this->components['styleCaps']}/xu";

		// Style numbers.
		$this->regex['styleNumbers'] = '/([0-9]+)/u';

		// Style hanging punctuation.
		$this->regex['styleHangingPunctuationDouble'] = "/(\s)([{$this->components['doubleHangingPunctuation']}])(\w+)/u";
		$this->regex['styleHangingPunctuationSingle'] = "/(\s)([{$this->components['singleHangingPunctuation']}])(\w+)/u";
		$this->regex['styleHangingPunctuationInitialDouble'] = "/(?:\A)([{$this->components['doubleHangingPunctuation']}])(\w+)/u";
		$this->regex['styleHangingPunctuationInitialSingle'] = "/(?:\A)([{$this->components['singleHangingPunctuation']}])(\w+)/u";

		// Style ampersands.
		$this->regex['styleAmpersands'] = '/(\&amp\;)/u';

		// Dewidowing.
		$this->regex['dewidow'] = '/
				(?:
					\A
					|
					(?:
						(?<space_before>			# subpattern 1: space before (note: ZWSP is not a space)
							[\s' . U::ZERO_WIDTH_SPACE . U::SOFT_HYPHEN . ']+
						)
						(?<neighbor>				# subpattern 2: neighbors widow (short as possible)
							[^\s' . U::ZERO_WIDTH_SPACE . U::SOFT_HYPHEN . ']+?
						)
					)
				)
				(?<space_between>					# subpattern 3: space between
					[\s]+                           # \s includes all special spaces (but not ZWSP) with the u flag
				)
				(?<widow>							# subpattern 4: widow
					[\w\pM\-]+?                       # \w includes all alphanumeric Unicode characters but not composed characters
				)
				(?<trailing>					    # subpattern 5: any trailing punctuation or spaces
					[^\w\pM]*
				)
				\Z
			/xu';

		// Add the "study" flag to all our regular expressions.
		foreach ( $this->regex as &$regex ) {
			$regex .= 'S';
		}
	}

	/**
	 * Enable lenient parser error handling (HTML is "best guess" if enabled).
	 *
	 * @param bool $on Optional. Default false.
	 */
	public function set_ignore_parser_errors( $on = false ) {
		$this->data['parserErrorsIgnore'] = $on;
	}

	/**
	 * Sets an optional handler for parser errors. Invalid callbacks will be silently ignored.
	 *
	 * @param callable|null $handler Optional. A callable that takes an array of error strings as its parameter. Default null.
	 */
	public function set_parser_errors_handler( $handler = null ) {
		if ( ! empty( $handler ) && ! is_callable( $handler ) ) {
			return; // Invalid handler, abort.
		}

		$this->data['parserErrorsHandler'] = $handler;
	}

	/**
	 * Enable usage of true "no-break narrow space" (&#8239;) instead of the normal no-break space (&nbsp;).
	 *
	 * @param bool $on Optional. Default false.
	 */
	public function set_true_no_break_narrow_space( $on = false ) {

		if ( $on ) {
			$this->no_break_narrow_space = U::NO_BREAK_NARROW_SPACE;
		} else {
			$this->no_break_narrow_space = U::NO_BREAK_SPACE;
		}

		// Update French guillemets.
		$this->quote_styles['doubleGuillemetsFrench'] = [
			'open'  => U::GUILLEMET_OPEN . $this->no_break_narrow_space,
			'close' => $this->no_break_narrow_space . U::GUILLEMET_CLOSE,
		];
	}

	/**
	 * Sets tags for which the typography of their children will be left untouched.
	 *
	 * @param string|array $tags A comma separated list or an array of tag names.
	 */
	public function set_tags_to_ignore( $tags = [ 'code', 'head', 'kbd', 'object', 'option', 'pre', 'samp', 'script', 'noscript', 'noembed', 'select', 'style', 'textarea', 'title', 'var', 'math' ] ) {
		// Ensure that we pass only lower-case tag names to XPath.
		$tags = array_filter( array_map( 'strtolower', Strings::maybe_split_parameters( $tags ) ), 'ctype_alnum' );

		// Self closing tags shouldn't be in $tags.
		$this->data['ignoreTags'] = array_unique( array_merge( array_diff( $tags, $this->self_closing_tags ), $this->inappropriate_tags ) );
	}

	/**
	 * Sets classes for which the typography of their children will be left untouched.
	 *
	 * @param string|array $classes A comma separated list or an array of class names.
	 */
	 function set_classes_to_ignore( $classes = [ 'vcard', 'noTypo' ] ) {
		$this->data['ignoreClasses'] = Strings::maybe_split_parameters( $classes );
	}

	/**
	 * Sets IDs for which the typography of their children will be left untouched.
	 *
	 * @param string|array $ids A comma separated list or an array of tag names.
	 */
	public function set_ids_to_ignore( $ids = [] ) {
		$this->data['ignoreIDs'] = Strings::maybe_split_parameters( $ids );
	}

	/**
	 * Enables/disables typographic quotes.
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_smart_quotes( $on = true ) {
		$this->data['smartQuotes'] = $on;
	}

	/**
	 * Sets the style for primary ('double') quotemarks.
	 *
	 * Allowed values for $style:
	 * "doubleCurled" => "&ldquo;foo&rdquo;",
	 * "doubleCurledReversed" => "&rdquo;foo&rdquo;",
	 * "doubleLow9" => "&bdquo;foo&rdquo;",
	 * "doubleLow9Reversed" => "&bdquo;foo&ldquo;",
	 * "singleCurled" => "&lsquo;foo&rsquo;",
	 * "singleCurledReversed" => "&rsquo;foo&rsquo;",
	 * "singleLow9" => "&sbquo;foo&rsquo;",
	 * "singleLow9Reversed" => "&sbquo;foo&lsquo;",
	 * "doubleGuillemetsFrench" => "&laquo;&nbsp;foo&nbsp;&raquo;",
	 * "doubleGuillemets" => "&laquo;foo&raquo;",
	 * "doubleGuillemetsReversed" => "&raquo;foo&laquo;",
	 * "singleGuillemets" => "&lsaquo;foo&rsaquo;",
	 * "singleGuillemetsReversed" => "&rsaquo;foo&lsaquo;",
	 * "cornerBrackets" => "&#x300c;foo&#x300d;",
	 * "whiteCornerBracket" => "&#x300e;foo&#x300f;"
	 *
	 * @param string $style Defaults to 'doubleCurled.
	 */
	public function set_smart_quotes_primary( $style = Quote_Style::DOUBLE_CURLED ) {
		if ( $style instanceof Settings\Quotes ) {
			$quotes = $style;
		} else {
			$quotes = Quote_Style::get_styled_quotes( $style, $this );
		}

		if ( ! empty( $quotes ) ) {
			$this->primary_quote_style = $quotes;

			// Update brackets component.
			$this->update_smart_quotes_brackets();
		} else {
			trigger_error( "Invalid quote style $style.", E_USER_WARNING ); // @codingStandardsIgnoreLine.
		}
	}

	/**
	 * Sets the style for secondary ('single') quotemarks.
	 *
	 * Allowed values for $style:
	 * "doubleCurled" => "&ldquo;foo&rdquo;",
	 * "doubleCurledReversed" => "&rdquo;foo&rdquo;",
	 * "doubleLow9" => "&bdquo;foo&rdquo;",
	 * "doubleLow9Reversed" => "&bdquo;foo&ldquo;",
	 * "singleCurled" => "&lsquo;foo&rsquo;",
	 * "singleCurledReversed" => "&rsquo;foo&rsquo;",
	 * "singleLow9" => "&sbquo;foo&rsquo;",
	 * "singleLow9Reversed" => "&sbquo;foo&lsquo;",
	 * "doubleGuillemetsFrench" => "&laquo;&nbsp;foo&nbsp;&raquo;",
	 * "doubleGuillemets" => "&laquo;foo&raquo;",
	 * "doubleGuillemetsReversed" => "&raquo;foo&laquo;",
	 * "singleGuillemets" => "&lsaquo;foo&rsaquo;",
	 * "singleGuillemetsReversed" => "&rsaquo;foo&lsaquo;",
	 * "cornerBrackets" => "&#x300c;foo&#x300d;",
	 * "whiteCornerBracket" => "&#x300e;foo&#x300f;"
	 *
	 * @param string $style Defaults to 'singleCurled'.
	 */
	public function set_smart_quotes_secondary( $style = Quote_Style::SINGLE_CURLED ) {
		if ( $style instanceof Settings\Quotes ) {
			$quotes = $style;
		} else {
			$quotes = Quote_Style::get_styled_quotes( $style, $this );
		}

		if ( ! empty( $quotes ) ) {
			$this->secondary_quote_style = $quotes;

			// Update brackets component.
			$this->update_smart_quotes_brackets();
		} else {
			trigger_error( "Invalid quote style $style.", E_USER_WARNING ); // @codingStandardsIgnoreLine.
		}
	}

	/**
	 * Enables/disables replacement of "a--a" with En Dash " -- " and "---" with Em Dash.
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_smart_dashes( $on = true ) {
		$this->data['smartDashes'] = $on;
	}

	/**
	 * Sets the typographical conventions used by smart_dashes.
	 *
	 * Allowed values for $style:
	 * - "traditionalUS"
	 * - "international"
	 *
	 * @param string|Settings\Dashes $style Optional. Default Dash_Style::TRADITIONAL_US.
	 */
	public function set_smart_dashes_style( $style = Dash_Style::TRADITIONAL_US ) {
		if ( $style instanceof Settings\Dashes ) {
			$dashes = $style;
		} else {
			$dashes = Dash_Style::get_styled_dashes( $style, $this );
		}

		if ( ! empty( $dashes ) ) {
			$this->dash_style = $dashes;

			// Update dash spacing regex.
			$this->update_dash_spacing_regex();
		} else {
			trigger_error( "Invalid dash style $style.", E_USER_WARNING ); // @codingStandardsIgnoreLine.
		}
	}

	/**
	 * Update the dash spacing regular expression.
	 */
	private function update_dash_spacing_regex() {
		$this->regex['dashSpacingParentheticalDash'] = "/
			(?:
				\s
				({$this->dash_style->parenthetical_dash()})
				\s
			)
			/xu";
		$this->regex['dashSpacingIntervalDash'] = "/
			(?:
				(?<=\S)							# lookbehind assertion
				({$this->dash_style->interval_dash()})
				(?=\S)							# lookahead assertion
			)
			/xu";
	}

	/**
	 * Enables/disables replacement of "..." with "…".
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_smart_ellipses( $on = true ) {
		$this->data['smartEllipses'] = $on;
	}

	/**
	 * Enables/disables replacement "creme brulee" with "crème brûlée".
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_smart_diacritics( $on = true ) {
		$this->data['smartDiacritics'] = $on;
	}

	/**
	 * Sets the language used for diacritics replacements.
	 *
	 * @param string $lang Has to correspond to a filename in 'diacritics'. Optional. Default 'en-US'.
	 */
	public function set_diacritic_language( $lang = 'en-US' ) {
		if ( isset( $this->data['diacriticLanguage'] ) && $this->data['diacriticLanguage'] === $lang ) {
			return;
		}

		$this->data['diacriticLanguage'] = $lang;
		$language_file_name = dirname( __FILE__ ) . '/diacritics/' . $lang . '.json';

		if ( file_exists( $language_file_name ) ) {
			$diacritics_file = json_decode( file_get_contents( $language_file_name ), true );
			$this->data['diacriticWords'] = $diacritics_file['diacritic_words'];
		} else {
			unset( $this->data['diacriticWords'] );
		}

		$this->update_diacritics_replacement_arrays();
	}

	/**
	 * Sets up custom diacritics replacements.
	 *
	 * @param string|array $custom_replacements An array formatted [needle=>replacement, needle=>replacement...],
	 *                                          or a string formatted `"needle"=>"replacement","needle"=>"replacement",...
	 */
	public function set_diacritic_custom_replacements( $custom_replacements = [] ) {
		if ( ! is_array( $custom_replacements ) ) {
			$custom_replacements = $this->parse_diacritics_replacement_string( $custom_replacements );
		}

		$this->data['diacriticCustomReplacements'] = Arrays::array_map_assoc( function( $key, $replacement ) {
			$key         = strip_tags( trim( $key ) );
			$replacement = strip_tags( trim( $replacement ) );

			if ( ! empty( $key ) && ! empty( $replacement ) ) {
				return [ $key, $replacement ];
			} else {
				return [];
			}
		}, $custom_replacements );

		$this->update_diacritics_replacement_arrays();
	}

	/**
	 * Parses a custom diacritics replacement string into an array.
	 *
	 * @param string $custom_replacements A string formatted `"needle"=>"replacement","needle"=>"replacement",...
	 *
	 * @return array
	 */
	private function parse_diacritics_replacement_string( $custom_replacements ) {
		return Arrays::array_map_assoc( function( $key, $replacement ) {

			// Account for single and double quotes in keys ...
			if ( preg_match( $this->regex['customDiacriticsDoubleQuoteKey'], $replacement, $match ) ) {
				$key = $match[1];
			} elseif ( preg_match( $this->regex['customDiacriticsSingleQuoteKey'], $replacement, $match ) ) {
				$key = $match[1];
			}

			// ... and values.
			if ( preg_match( $this->regex['customDiacriticsDoubleQuoteValue'], $replacement, $match ) ) {
				$replacement = $match[1];
			} elseif ( preg_match( $this->regex['customDiacriticsSingleQuoteValue'], $replacement, $match ) ) {
				$replacement = $match[1];
			}

			return [ $key, $replacement ];
		}, preg_split( '/,/', $custom_replacements, -1, PREG_SPLIT_NO_EMPTY ) );
	}

	/**
	 * Update the pattern and replacement arrays in $settings['diacriticReplacement'].
	 *
	 * Should be called whenever a new diacritics replacement language is selected or
	 * when the custom replacements are updated.
	 */
	private function update_diacritics_replacement_arrays() {
		$patterns = [];
		$replacements = [];

		if ( ! empty( $this->data['diacriticCustomReplacements'] ) ) {
			$this->parse_diacritics_rules( $this->data['diacriticCustomReplacements'], $patterns, $replacements );
		}
		if ( ! empty( $this->data['diacriticWords'] ) ) {
			$this->parse_diacritics_rules( $this->data['diacriticWords'], $patterns, $replacements );
		}

		$this->data['diacriticReplacement'] = [
			'patterns'     => $patterns,
			'replacements' => $replacements,
		];
	}

	/**
	 * Parse an array of diacritics rules.
	 *
	 * @param array $diacritics_rules The rules ( $word => $replacement ).
	 * @param array $patterns         Resulting patterns. Passed by reference.
	 * @param array $replacements     Resulting replacements. Passed by reference.
	 */
	private function parse_diacritics_rules( array $diacritics_rules, array &$patterns, array &$replacements ) {
		foreach ( $diacritics_rules as $needle => $replacement ) {
			$patterns[] = "/{$this->components['smartDiacriticsWordBoundaryInitial']}{$needle}{$this->components['smartDiacriticsWordBoundaryFinal']}/u";
			$replacements[ $needle ] = $replacement;
		}
	}

	/**
	 * Enables/disables replacement of (r) (c) (tm) (sm) (p) (R) (C) (TM) (SM) (P) with ® © ™ ℠ ℗.
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_smart_marks( $on = true ) {
		$this->data['smartMarks'] = $on;
	}

	/**
	 * Enables/disables proper mathematical symbols.
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_smart_math( $on = true ) {
		$this->data['smartMath'] = $on;
	}

	/**
	 * Enables/disables replacement of 2^2 with 2<sup>2</sup>
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_smart_exponents( $on = true ) {
		$this->data['smartExponents'] = $on;
	}

	/**
	 * Enables/disables replacement of 1/4 with <sup>1</sup>&#8260;<sub>4</sub>.
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_smart_fractions( $on = true ) {
		$this->data['smartFractions'] = $on;
	}

	/**
	 * Enables/disables replacement of 1st with 1<sup>st</sup>.
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_smart_ordinal_suffix( $on = true ) {
		$this->data['smartOrdinalSuffix'] = $on;
	}

	/**
	 * Enables/disables forcing single character words to next line with the insertion of &nbsp;.
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_single_character_word_spacing( $on = true ) {
		$this->data['singleCharacterWordSpacing'] = $on;
	}

	/**
	 * Enables/disables fraction spacing.
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_fraction_spacing( $on = true ) {
		$this->data['fractionSpacing'] = $on;
	}

	/**
	 * Enables/disables keeping units and values together with the insertion of &nbsp;.
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_unit_spacing( $on = true ) {
		$this->data['unitSpacing'] = $on;
	}

	/**
	 * Enables/disables numbered abbreviations like "ISO 9000" together with the insertion of &nbsp;.
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_numbered_abbreviation_spacing( $on = true ) {
		$this->data['numberedAbbreviationSpacing'] = $on;
	}

	/**
	 * Enables/disables extra whitespace before certain punction marks, as is the French custom.
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_french_punctuation_spacing( $on = true ) {
		$this->data['frenchPunctuationSpacing'] = $on;
	}

	/**
	 * Sets the list of units to keep together with their values.
	 *
	 * @param string|array $units A comma separated list or an array of units.
	 */
	public function set_units( $units = [] ) {
		$this->data['units'] = Strings::maybe_split_parameters( $units );
		$this->update_unit_pattern( $this->data['units'] );
	}

	/**
	 * Update components and pattern for matching both standard and custom units.
	 *
	 * @param array $units An array of unit names.
	 */
	private function update_unit_pattern( array $units ) {
		// Update components & regex pattern.
		foreach ( $units as $index => $unit ) {
			// Escape special chars.
			$units[ $index ] = preg_replace( $this->regex['unitSpacingEscapeSpecialChars'], '\\\\$1', $unit );
		}
		$custom_units = implode( '|', $units );
		$custom_units .= ( $custom_units ) ? '|' : '';
		$this->components['unitSpacingUnits'] = $custom_units . $this->components['unitSpacingStandardUnits'];
		$this->regex['unitSpacingUnitPattern'] = "/(\d\.?)\s({$this->components['unitSpacingUnits']})\b/x";
	}

	/**
	 * Enables/disables wrapping of Em and En dashes are in thin spaces.
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_dash_spacing( $on = true ) {
		$this->data['dashSpacing'] = $on;
	}

	/**
	 * Enables/disables removal of extra whitespace characters.
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_space_collapse( $on = true ) {
		$this->data['spaceCollapse'] = $on;
	}

	/**
	 * Enables/disables widow handling.
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_dewidow( $on = true ) {
		$this->data['dewidow'] = $on;
	}

	/**
	 * Sets the maximum length of widows that will be protected.
	 *
	 * @param int $length Defaults to 5. Trying to set the value to less than 2 resets the length to the default.
	 */
	public function set_max_dewidow_length( $length = 5 ) {
		$length = ( $length > 1 ) ? $length : 5;

		$this->data['dewidowMaxLength'] = $length;
	}

	/**
	 * Sets the maximum length of pulled text to keep widows company.
	 *
	 * @param int $length Defaults to 5. Trying to set the value to less than 2 resets the length to the default.
	 */
	public function set_max_dewidow_pull( $length = 5 ) {
		$length = ( $length > 1 ) ? $length : 5;

		$this->data['dewidowMaxPull'] = $length;
	}

	/**
	 * Enables/disables wrapping at internal hard hyphens with the insertion of a zero-width-space.
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_wrap_hard_hyphens( $on = true ) {
		$this->data['hyphenHardWrap'] = $on;
	}

	/**
	 * Enables/disables wrapping of urls.
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_url_wrap( $on = true ) {
		$this->data['urlWrap'] = $on;
	}

	/**
	 * Enables/disables wrapping of email addresses.
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_email_wrap( $on = true ) {
		$this->data['emailWrap'] = $on;
	}

	/**
	 * Sets the minimum character requirement after an URL wrapping point.
	 *
	 * @param int $length Defaults to 5. Trying to set the value to less than 1 resets the length to the default.
	 */
	public function set_min_after_url_wrap( $length = 5 ) {
		$length = ( $length > 0 ) ? $length : 5;

		$this->data['urlMinAfterWrap'] = $length;
	}

	/**
	 * Enables/disables wrapping of ampersands in <span class="amp">.
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_style_ampersands( $on = true ) {
		$this->data['styleAmpersands'] = $on;
	}

	/**
	 * Enables/disables wrapping caps in <span class="caps">.
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_style_caps( $on = true ) {
		$this->data['styleCaps'] = $on;
	}

	/**
	 * Enables/disables wrapping of initial quotes in <span class="quo"> or <span class="dquo">.
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_style_initial_quotes( $on = true ) {
		$this->data['styleInitialQuotes'] = $on;
	}

	/**
	 * Enables/disables wrapping of numbers in <span class="numbers">.
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_style_numbers( $on = true ) {
		$this->data['styleNumbers'] = $on;
	}

	/**
	 * Enables/disables wrapping of punctiation and wide characters in <span class="pull-*">.
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_style_hanging_punctuation( $on = true ) {
		$this->data['styleHangingPunctuation'] = $on;
	}

	/**
	 * Sets the list of tags where initial quotes and guillemets should be styled.
	 *
	 * @param string|array $tags A comma separated list or an array of tag names.
	 */
	public function set_initial_quote_tags( $tags = [ 'p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'blockquote', 'li', 'dd', 'dt' ] ) {
		// Make array if handed a list of tags as a string.
		if ( ! is_array( $tags ) ) {
			$tags = preg_split( '/[^a-z0-9]+/', $tags, -1, PREG_SPLIT_NO_EMPTY );
		}

		// Store the tag array inverted (with the tagName as its index for faster lookup).
		$this->data['initialQuoteTags'] = array_change_key_case( array_flip( $tags ), CASE_LOWER );
	}

	/**
	 * Enables/disables hyphenation.
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_hyphenation( $on = true ) {
		$this->data['hyphenation'] = $on;
	}

	/**
	 * Sets the hyphenation pattern language.
	 *
	 * @param string $lang Has to correspond to a filename in 'lang'. Optional. Default 'en-US'.
	 */
	public function set_hyphenation_language( $lang = 'en-US' ) {
		if ( isset( $this->data['hyphenLanguage'] ) && $this->data['hyphenLanguage'] === $lang ) {
			return; // Bail out, no need to do anything.
		}

		$this->data['hyphenLanguage'] = $lang;
	}

	/**
	 * Sets the minimum length of a word that may be hyphenated.
	 *
	 * @param int $length Defaults to 5. Trying to set the value to less than 2 resets the length to the default.
	 */
	public function set_min_length_hyphenation( $length = 5 ) {
		$length = ( $length > 1 ) ? $length : 5;

		$this->data['hyphenMinLength'] = $length;
	}

	/**
	 * Sets the minimum character requirement before a hyphenation point.
	 *
	 * @param int $length Defaults to 3. Trying to set the value to less than 1 resets the length to the default.
	 */
	public function set_min_before_hyphenation( $length = 3 ) {
		$length = ( $length > 0 ) ? $length : 3;

		$this->data['hyphenMinBefore'] = $length;
	}

	/**
	 * Sets the minimum character requirement after a hyphenation point.
	 *
	 * @param int $length Defaults to 2. Trying to set the value to less than 1 resets the length to the default.
	 */
	public function set_min_after_hyphenation( $length = 2 ) {
		$length = ( $length > 0 ) ? $length : 2;

		$this->data['hyphenMinAfter'] = $length;
	}

	/**
	 * Enables/disables hyphenation of titles and headings.
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_hyphenate_headings( $on = true ) {
		$this->data['hyphenateTitle'] = $on;
	}

	/**
	 * Enables/disables hyphenation of words set completely in capital letters.
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_hyphenate_all_caps( $on = true ) {
		$this->data['hyphenateAllCaps'] = $on;
	}

	/**
	 * Enables/disables hyphenation of words starting with a capital letter.
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_hyphenate_title_case( $on = true ) {
		$this->data['hyphenateTitleCase'] = $on;
	}

	/**
	 * Enables/disables hyphenation of compound words (e.g. "editor-in-chief").
	 *
	 * @param bool $on Optional. Default true.
	 */
	public function set_hyphenate_compounds( $on = true ) {
		$this->data['hyphenateCompounds'] = $on;
	}

	/**
	 * Sets custom word hyphenations.
	 *
	 * @param string|array $exceptions An array of words with all hyphenation points marked with a hard hyphen (or a string list of such words).
	 *        In the latter case, only alphanumeric characters and hyphens are recognized. The default is empty.
	 */
	public function set_hyphenation_exceptions( $exceptions = [] ) {
		$this->data['hyphenationCustomExceptions'] = Strings::maybe_split_parameters( $exceptions );
	}

	/**
	 * Retrieves a unique hash value for the current settings.
	 *
	 * @param int $max_length The maximum number of bytes returned. Optional. Default 16.
	 *
	 * @return string A binary hash value for the current settings limited to $max_length.
	 */
	public function get_hash( $max_length = 16 ) {
		$hash = md5( json_encode( $this->data ), true );

		if ( $max_length < strlen( $hash ) ) {
			$hash = substr( $hash, 0, $max_length );
		}

		return $hash;
	}
}
