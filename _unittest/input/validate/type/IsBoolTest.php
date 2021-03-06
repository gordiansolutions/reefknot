<?php

namespace gordian\reefknot\input\validate\type;

/**
 * Test class for IsBool.
 * Generated by PHPUnit on 2011-12-04 at 19:58:45.
 */
class IsBoolTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var IsBool
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp ()
	{
		$this -> object = new IsBool;
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown ()
	{
		
	}
	
	public function testIsValidBoolTruePass ()
	{
		$this -> object -> setData (true);
		$this -> assertTrue ($this -> object -> isValid ());
	}
	
	public function testIsValidBoolFalsePass ()
	{
		$this -> object -> setData (false);
		$this -> assertTrue ($this -> object -> isValid ());
	}
	
	public function testIsValidNullPass ()
	{
		$this -> object -> setData (NULL);
		$this -> assertTrue ($this -> object -> isValid ());
	}
	
	public function testIsValidArrayFail ()
	{
		$this -> object -> setData (array (1, 2, 3, 4, 5));
		$this -> assertFalse ($this -> object -> isValid ());
	}
	
	public function testIsValidAssocFail ()
	{
		$this -> object -> setData (array ('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5));
		$this -> assertFalse ($this -> object -> isValid ());
	}
	
	public function testIsValidFloatFail ()
	{
		$this -> object -> setData (pi ());
		$this -> assertFalse ($this -> object -> isValid ());
	}
	
	public function testIsValidIntFail ()
	{
		$this -> object -> setData (42);
		$this -> assertFalse ($this -> object -> isValid ());
	}
	
	public function testIsValidObjectFail ()
	{
		$this -> object -> setData (new \StdClass ());
		$this -> assertFalse ($this -> object -> isValid ());
	}
	
	public function testIsValidStringFail ()
	{
		$this -> object -> setData ('The quick brown fox jumps over the lazy dog.');
		$this -> assertFalse ($this -> object -> isValid ());
	}
}
