<?php

require_once dirname(__FILE__) . '/../../../../../mind3rd/API/languages/pt-BR/IgnoreForms.php';

/**
 * Test class for IgnoreForms.
 * Generated by PHPUnit on 2010-12-19 at 11:23:40.
 */
class IgnoreFormsTest extends PHPUnit_Framework_TestCase {

	/**
	 * @var IgnoreForms
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->object = new IgnoreForms;
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {

	}

	public function testShouldBeIgnored() {
		$this->assertTrue(IgnoreForms::shouldBeIgnored('felizmente'));
	}
	public function testShouldBeIgnored1() {
		$this->assertTrue(IgnoreForms::shouldBeIgnored('provavelmente'));
	}


	public function testShouldBeUsed() {
		$this->assertTrue(IgnoreForms::shouldBeUsed('trabalhará'));
	}
	public function testShouldBeUsed1() {
		$this->assertTrue(IgnoreForms::shouldBeUsed('mente'));
	}

}

?>