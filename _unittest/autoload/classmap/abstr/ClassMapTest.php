<?php

namespace gordian\reefknot\autoload\classmap\abstr;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-12-15 at 12:42:11.
 */
class ClassMapTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * Object under test
	 * 
	 * @var ClassMap
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp ()
	{
		$this -> object = $this -> getMockForAbstractClass ('gordian\reefknot\autoload\classmap\abstr\ClassMap');
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown ()
	{
		
	}

	/**
	 * Test normal use of getMapping
	 */
	public function testGetMapping ()
	{
		$this -> object -> addMapping ('TestClass', '/test/path/TestClass.php');
		$this -> assertEquals ($this -> object -> getMapping ('TestClass'), '/test/path/TestClass.php');
	}
	
	/**
	 * Test that trying to fetch the mapping for a class not in the map returns NULL
	 */
	public function testGetMappingNonExistantClass () {
		$this -> assertNull ($this -> object -> getMapping ('NonExistantClass'));
	}
	
	/**
	 * Test that adding a new value for an existing class overwrites the old value
	 */
	public function testAddMappingOverwrite ()
	{
		$this -> object -> reset ()
						-> addMapping ('TestClass', '/test/path/TestClass.php')
						-> addMapping ('TestClass', '/new/test/path/TestClass.php');
		$this -> assertEquals ($this -> object -> getMapping ('TestClass'), '/new/test/path/TestClass.php');
	}

	/**
	 * Test that we can remove items from the map
	 */
	public function testRemoveMapping ()
	{
		$this -> object -> reset ()
						-> addMapping ('TestClass', '/test/path/TestClass.php')
						-> removeMapping ('TestClass');
		$this -> assertNull ($this -> object -> getMapping ('TestClass'));
	}

	/**
	 * 
	 */
	public function testReset ()
	{
		$this -> object -> reset ()
						-> addMapping ('TestClass1', '/test/path/TestClass1.php')
						-> addMapping ('TestClass2', '/test/path/TestClass2.php')
						-> addMapping ('TestClass3', '/test/path/TestClass3.php')
						-> reset ();
		$this -> assertEmpty ($this -> object -> getAll ());
	}

	/**
	 * @todo   Implement testGetAll().
	 */
	public function testGetAll ()
	{
		$expected	= array (
			'TestClass1'	=> '/test/path/TestClass1.php',
			'TestClass2'	=> '/test/path/TestClass2.php',
			'TestClass3'	=> '/test/path/TestClass3.php'
		);
		$this -> object -> reset ()
						-> addMapping ('TestClass1', '/test/path/TestClass1.php')
						-> addMapping ('TestClass2', '/test/path/TestClass2.php')
						-> addMapping ('TestClass3', '/test/path/TestClass3.php');
		$this -> assertEmpty (array_diff_assoc ($expected, $this -> object -> getAll ()));
		$this -> assertEmpty (array_diff_assoc ($this -> object -> getAll (), $expected));
	}
}
