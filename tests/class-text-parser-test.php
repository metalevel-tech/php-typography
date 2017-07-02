<?php
/**
 *  This file is part of wp-Typography.
 *
 *  Copyright 2015-2017 Peter Putzer.
 *
 *  This program is free software; you can redistribute it and/or
 *  modify it under the terms of the GNU General Public License
 *  as published by the Free Software Foundation; either version 2
 *  of the License, or ( at your option ) any later version.
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
 *  @package wpTypography/Tests
 *  @license http://www.gnu.org/licenses/gpl-2.0.html
 */

namespace PHP_Typography\Tests;

use \PHP_Typography\Text_Parser\Token;
use \PHP_Typography\Text_Parser;

/**
 * Unit test for \PHP_Typography\Text_Parser class.
 *
 * @coversDefaultClass \PHP_Typography\Text_Parser
 * @usesDefaultClass \PHP_Typography\Text_Parser
 *
 * @uses PHP_Typography\Text_Parser
 * @uses PHP_Typography\Text_Parser\Token
 * @uses PHP_Typography\Strings::functions
 */
class Text_Parser_Test extends PHP_Typography_Testcase {
	/**
	 * The Text_Parser fixture.
	 *
	 * @var Text_Parser
	 */
	protected $parser;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->parser = new \PHP_Typography\Text_Parser;
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
	}

	/**
	 * Test constructor.
	 *
	 * @covers ::__construct
	 */
	public function test_constructor() {
		$parser = new Text_Parser( [ 'UTF-8' ] );

		$this->assertAttributeCount( 0, 'text', $parser );
		$this->assertAttributeEmpty( 'current_strtoupper', $parser );
	}

	/**
	 * Test load.
	 *
	 * @covers ::load
	 * @covers ::tokenize
	 *
	 * @uses ::get_all
	 */
	public function test_load() {
		$too_long = 'A really long string with a word that is wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwway too long.';
		$still_too_long = 'A really long string with a word that is aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaalmost too long.';
		$almost_too_long = 'A really long string with a word that is aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaalmost too long.';

		$parser = $this->parser;

		// Security check.
		$this->assertFalse( $parser->load( $too_long ) );
		$this->assertFalse( $parser->load( $still_too_long ) );
		$this->assertTrue( $parser->load( $almost_too_long ) );

		$interesting = 'Quoth the raven, "nevermore"! Äöüß?';
		$this->assertTrue( $parser->load( $interesting ) );

		$tokens = $parser->get_all();

		$this->assertCount( 13, $tokens );
		$this->assertArraySubset( [
			0 => new Token( 'Quoth', Token::WORD ),
		], $tokens );
		$this->assertArraySubset( [
			5 => new Token( ',', Token::PUNCTUATION ),
		], $tokens );
		$this->assertArraySubset( [
			11 => new Token( 'Äöüß', Token::WORD ),
		], $tokens );

		return $parser;
	}

	/**
	 * Test load with email address.
	 *
	 * @covers ::load
	 * @covers ::tokenize
	 *
	 * @uses ::get_all
	 */
	public function test_load_email() {
		$parser = $this->parser;

		$string = 'Quoth the raven, "nevermore"! Please mail to someone@example.org.';
		$this->assertTrue( $parser->load( $string ) );

		$tokens = $parser->get_all();
		$this->assertCount( 19, $tokens );

		$this->assertArraySubset( [
			0 => new Token( 'Quoth', Token::WORD ),
		], $tokens );
		$this->assertArraySubset( [
			5 => new Token( ',', Token::PUNCTUATION ),
		], $tokens );
		$this->assertArraySubset( [
			17 => new Token( 'someone@example.org', Token::OTHER ),
		], $tokens );

		return $parser;
	}

	/**
	 * Test load with URL.
	 *
	 * @covers ::load
	 * @covers ::tokenize
	 *
	 * @uses ::get_all
	 */
	public function test_load_url() {
		$parser = $this->parser;

		$string = 'Quoth the raven, "nevermore"! Please open http://example.org or wordpress:wordpress or wordpress:w@rdpress or @example or @:@:@:risk.';
		$this->assertTrue( $parser->load( $string ) );

		$tokens = $parser->get_all();
		$this->assertCount( 33, $tokens );

		$this->assertArraySubset( [
			0 => new Token( 'Quoth', Token::WORD ),
		], $tokens );
		$this->assertArraySubset( [
			5 => new Token( ',', Token::PUNCTUATION ),
		], $tokens );
		$this->assertArraySubset( [
			15 => new Token( 'http://example.org', Token::OTHER ),
		], $tokens );
		$this->assertArraySubset( [
			19 => new Token( 'wordpress:wordpress', Token::OTHER ),
		], $tokens );
		$this->assertArraySubset( [
			23 => new Token( 'wordpress:w@rdpress', Token::OTHER ),
		], $tokens );
		$this->assertArraySubset( [
			27 => new Token( '@example', Token::OTHER ),
		], $tokens );
		$this->assertArraySubset( [
			31 => new Token( '@:@:@:risk', Token::OTHER ),
		], $tokens );

		return $parser;
	}

	/**
	 * Test load with a compound word.
	 *
	 * @covers ::load
	 * @covers ::tokenize
	 *
	 * @uses ::get_all
	 */
	public function test_load_compound_word() {
		$parser = $this->parser;

		$string = 'Some don\'t trust the captain-owner.';
		$this->assertTrue( $parser->load( $string ) );

		$tokens = $parser->get_all();
		$this->assertCount( 10, $tokens );

		$this->assertArraySubset( [
			0 => new Token( 'Some', Token::WORD ),
		], $tokens );
		$this->assertArraySubset( [
			2 => new Token( "don't", Token::OTHER ),
		], $tokens );
		$this->assertArraySubset( [
			8 => new Token( 'captain-owner', Token::WORD ),
		], $tokens );

		return $parser;
	}

	/**
	 * Test load with an invalid encoding.
	 *
	 * @covers ::load
	 */
	public function test_load_invalid_encoding() {
		$string = mb_convert_encoding( 'Ein längerer String im falschen Zeichensatz', 'ISO-8859-2' );
		$parser = $this->parser;

		$this->assertFalse( $parser->load( $string ) );
	}

	/**
	 * Test load with something that is not a string.
	 *
	 * @covers ::load
	 */
	public function test_load_not_a_string() {
		$parser = $this->parser;

		$this->assertFalse( $parser->load( [] ) );
	}

	/**
	 * Test reload.
	 *
	 * @covers ::reload
	 *
	 * @depends test_load
	 * @uses ::get_all
	 *
	 * @param \PHP_Typography\Text_Parser $parser The parser to use.
	 */
	public function test_reload( Text_Parser $parser ) {
		$tokens = $parser->get_all();
		$tokens[12] = $tokens[12]->with_value( '' ); // ?.
		$tokens[11] = $tokens[11]->with_value( '' ); // Äöüß
		$tokens[10] = $tokens[10]->with_value( '' ); //
		$tokens[9]  = $tokens[9]->with_value( $tokens[9]->value . '!' );
		$parser->update( $tokens );

		$this->assertTrue( $parser->reload() );
		$this->assertSame( 'Quoth the raven, "nevermore"!!', $parser->unload() );

		return $parser;
	}

	/**
	 * Test unload.
	 *
	 * @covers ::unload
	 */
	public function test_unload() {
		$interesting = 'Quoth the raven, "nevermore"! Äöüß?';
		$parser = $this->parser;

		$this->assertTrue( $parser->load( $interesting ) );

		$result = $parser->unload();

		$this->assertSame( $interesting, $result );
		$this->assertNotSame( $result, $parser->unload() ); // the parser is empty now.
	}

	/**
	 * Test clear.
	 *
	 * @covers ::clear
	 *
	 * @uses ::load
	 */
	public function test_clear() {
		$parser = $this->parser;
		$interesting = 'Quoth the raven, "nevermore"!';

		$this->assertTrue( $parser->load( $interesting ) );
		$this->assertGreaterThan( 0, count( $parser->get_all() ) );

		$parser->clear();
		$this->assertCount( 0, $parser->get_all() );
	}

	/**
	 * Test update.
	 *
	 * @covers ::update
	 */
	public function test_update() {
		$parser = $this->parser;
		$interesting = 'Quoth the raven, "nevermore"! Äöüß?';
		$this->assertTrue( $parser->load( $interesting ) );

		$tokens = $parser->get_all();
		$tokens[12] = $tokens[12]->with_value( '' ); // ?.
		$tokens[11] = $tokens[11]->with_value( '' ); // Äöüß
		$tokens[10] = $tokens[10]->with_value( '' ); //
		$tokens[9]  = $tokens[9]->with_value( $tokens[9]->value . '!' );
		$parser->update( $tokens );

		$this->assertSame( 'Quoth the raven, "nevermore"!!', $parser->unload() );

		return $parser;
	}

	/**
	 * Test get_all.
	 *
	 * @covers ::get_all
	 *
	 * @uses \PHP_Typography\Text_Parser::load
	 */
	public function test_get_all() {
		$interesting = 'Quoth the raven, "nevermore"!';
		$parser = $this->parser;
		$this->assertTrue( $parser->load( $interesting ) );

		$tokens = $parser->get_all();
		$this->assertCount( 10, $tokens );

		return $parser;
	}

	/**
	 * Test get_spaces.
	 *
	 * @covers ::get_spaces
	 * @depends test_get_all
	 *
	 * @param \PHP_Typography\Text_Parser $parser The parser to use.
	 */
	public function test_get_spaces( Text_Parser $parser ) {
		$tokens = $parser->get_spaces();
		$this->assertCount( 3, $tokens );

		return $parser;
	}

	/**
	 * Test get_punctuation.
	 *
	 * @covers ::get_punctuation
	 * @depends test_get_all
	 *
	 * @param \PHP_Typography\Text_Parser $parser The parser to use.
	 */
	public function test_get_punctuation( Text_Parser $parser ) {
		$tokens = $parser->get_punctuation();
		$this->assertCount( 3, $tokens );

		return $parser;
	}

	/**
	 * Test get_words.
	 *
	 * @covers ::get_words
	 * @depends test_get_all
	 *
	 * @param \PHP_Typography\Text_Parser $parser The parser to use.
	 */
	public function test_get_words( Text_Parser $parser ) {
		$tokens = $parser->get_words();
		$this->assertCount( 4, $tokens );

		$parser->load( 'A few m1xed W0RDS.' );
		$tokens = $parser->get_words( Text_Parser::REQUIRE_ALL_LETTERS, Text_Parser::NO_ALL_CAPS );
		$this->assertCount( 1, $tokens );
		$this->assertContains( new Token( 'few', Token::WORD ), $tokens, '', false, false, true );

		$tokens = $parser->get_words( Text_Parser::ALLOW_ALL_LETTERS, Text_Parser::NO_ALL_CAPS );
		$this->assertCount( 2, $tokens );
		$this->assertContains( new Token( 'few', Token::WORD ), $tokens, '', false, false, true );
		$this->assertContains( new Token( 'm1xed', Token::WORD ), $tokens, '', false, false, true );

		$tokens = $parser->get_words( Text_Parser::NO_ALL_LETTERS, Text_Parser::NO_ALL_CAPS );
		$this->assertCount( 1, $tokens );
		$this->assertContains( new Token( 'm1xed', Token::WORD ), $tokens, '', false, false, true );

		$tokens = $parser->get_words( Text_Parser::REQUIRE_ALL_LETTERS, Text_Parser::ALLOW_ALL_CAPS );
		$this->assertCount( 2, $tokens );
		$this->assertContains( new Token( 'A', Token::WORD ), $tokens, '', false, false, true );
		$this->assertContains( new Token( 'few', Token::WORD ), $tokens, '', false, false, true );

		$tokens = $parser->get_words( Text_Parser::ALLOW_ALL_LETTERS, Text_Parser::ALLOW_ALL_CAPS );
		$this->assertCount( 4, $tokens );
		$this->assertContains( new Token( 'A', Token::WORD ), $tokens, '', false, false, true );
		$this->assertContains( new Token( 'few', Token::WORD ), $tokens, '', false, false, true );
		$this->assertContains( new Token( 'm1xed', Token::WORD ), $tokens, '', false, false, true );
		$this->assertContains( new Token( 'W0RDS', Token::WORD ), $tokens, '', false, false, true );

		$tokens = $parser->get_words( Text_Parser::NO_ALL_LETTERS, Text_Parser::ALLOW_ALL_CAPS );
		$this->assertCount( 2, $tokens );
		$this->assertContains( new Token( 'm1xed', Token::WORD ), $tokens, '', false, false, true );
		$this->assertContains( new Token( 'W0RDS', Token::WORD ), $tokens, '', false, false, true );

		$tokens = $parser->get_words( Text_Parser::REQUIRE_ALL_LETTERS, Text_Parser::REQUIRE_ALL_CAPS );
		$this->assertCount( 1, $tokens );
		$this->assertContains( new Token( 'A', Token::WORD ), $tokens, '', false, false, true );

		$tokens = $parser->get_words( Text_Parser::ALLOW_ALL_LETTERS, Text_Parser::REQUIRE_ALL_CAPS );
		$this->assertCount( 2, $tokens );
		$this->assertContains( new Token( 'A', Token::WORD ), $tokens, '', false, false, true );
		$this->assertContains( new Token( 'W0RDS', Token::WORD ), $tokens, '', false, false, true );

		$tokens = $parser->get_words( Text_Parser::NO_ALL_LETTERS, Text_Parser::REQUIRE_ALL_CAPS );
		$this->assertCount( 1, $tokens );
		$this->assertContains( new Token( 'W0RDS', Token::WORD ), $tokens, '', false, false, true );
	}

	/**
	 * Test get_words.
	 *
	 * @covers ::get_words
	 * @depends test_get_all
	 *
	 * @param \PHP_Typography\Text_Parser $parser The parser to use.
	 */
	public function test_get_words_unloaded( Text_Parser $parser ) {
		$parser->load( 'A few m1xed W0RDS.' );
		$parser->unload();

		$tokens = $parser->get_words( Text_Parser::REQUIRE_ALL_LETTERS, Text_Parser::NO_ALL_CAPS );
		$this->assertCount( 0, $tokens );
		$this->assertSame( [], $tokens );

		return $parser;
	}

	/**
	 * Test get_other.
	 *
	 * @covers ::get_other
	 * @depends test_get_all
	 *
	 * @param \PHP_Typography\Text_Parser $parser The parser to use.
	 */
	public function test_get_other( Text_Parser $parser ) {
		$tokens = $parser->get_other();
		$this->assertCount( 0, $tokens );

		return $parser;
	}

	/**
	 * Test get_type.
	 *
	 * @covers ::get_type
	 * @depends test_get_all
	 *
	 * @param \PHP_Typography\Text_Parser $parser The parser to use.
	 */
	public function test_get_type( Text_Parser $parser ) {
		$parser->load( 'A few m1xed W0RDS.' );

		$words = [];
		$tokens = $parser->get_all();
		foreach ( $tokens as $index => $token ) {
			if ( Token::WORD === $token->type ) {
				$words[ $index ] = $token;
			}
		}

		$this->assertArraySubset( $words, $parser->get_type( Token::WORD ) );
	}
}
