<?php

namespace gordian\reefknot\input\validate\abstr;

use gordian\reefknot\input\validate, 
	gordian\reefknot\input\validate\type;

/**
 * Test class for Validatable.
 * Generated by PHPUnit on 2011-12-17 at 18:10:35.
 */
class ValidatableTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var Validatable
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp ()
	{
		$this -> object = $this -> getMockForAbstractClass ('gordian\reefknot\input\validate\abstr\Validatable');
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown ()
	{
		
	}

	/**
	 * Test setting data to NULL
	 */
	public function testGetSetDataNull ()
	{
		$this -> object -> setData (NULL);
		$this -> assertNull ($this -> object -> getData ());
	}
	
	/**
	 * Test setting data to an integer
	 */
	public function testGetSetDataNullInt ()
	{
		$this -> object -> setData (123);
		$this -> assertSame ($this -> object -> getData (), 123);
	}

	/**
	 * Test setting data to a float
	 */
	public function testGetSetDataFloat ()
	{
		$this -> object -> setData (pi ());
		$this -> assertEquals ($this -> object -> getData (), pi ());
	}
	
	/**
	 * Test setting data to an empty array
	 */
	public function testGetSetDataEmptyArray ()
	{
		$this -> object -> setData (array ());
		$this -> assertSame ($this -> object -> getData (), array ());
	}
	
	/**
	 * Test setting data to an indexed array
	 */
	public function testGetSetDataIndexedArray ()
	{
		$this -> object -> setData (array (1, 2, 3));
		$this -> assertSame ($this -> object -> getData (), array (1, 2, 3));
	}
	
	/**
	 * Test setting data to an associative array
	 */
	public function testGetSetDataAssocArray ()
	{
		$this -> object -> setData (array ('foo' => 1, 'bar' => 2, 'baz' => 3));
		$this -> assertSame ($this -> object -> getData (), array ('foo' => 1, 'bar' => 2, 'baz' => 3));
	}
	
	/**
	 * Test that we can set the object's parent
	 */
	public function testSetParentPasses ()
	{
		$parent = $this -> getMockBuilder ('gordian\reefknot\input\validate\Field') -> disableOriginalConstructor () -> getMock ();
		$this -> object -> setParent ($parent);
		$this -> assertSame ($this -> object -> getParent (), $parent);
	}

	/**
	 * Check that we can set the parent to the same value without causing errors
	 */
	public function testSetParentSameParentPasses ()
	{
		$parent = $this -> getMockBuilder ('gordian\reefknot\input\validate\Field') -> disableOriginalConstructor () -> getMock ();
		$this -> object -> setParent ($parent);
		$this -> assertSame ($this -> object -> getParent (), $parent);
		$this -> object -> setParent ($parent);
		$this -> assertSame ($this -> object -> getParent (), $parent);
	}
	
	/**
	 * Check that we can't change the parent once it's been set
	 * 
	 * @expectedException \InvalidArgumentException
	 */
	public function testSetParentDifferentParentThrowsException ()
	{
		$parent		= $this -> getMockBuilder ('gordian\reefknot\input\validate\Field') -> disableOriginalConstructor () -> getMock ();
		$parent2	= $this -> getMockBuilder ('gordian\reefknot\input\validate\Field') -> disableOriginalConstructor () -> getMock ();
		$this -> object -> setParent ($parent);
		$this -> object -> setParent ($parent2);
	}
	
	/**
	 * Test that we can get the object's parent
	 */
	public function testGetParent ()
	{
		$this -> assertNull ($this -> object -> getParent ());
		$parent = $this -> getMockBuilder ('gordian\reefknot\input\validate\Field') -> disableOriginalConstructor () -> getMock ();
		$this -> object -> setParent ($parent);
		$this -> assertSame ($this -> object -> getParent (), $parent);
	}

	/**
	 * Test that we can reset the invalid object collection
	 */
	public function testResetInvalids ()
	{
		$this -> object -> resetInvalids ();
		$this -> assertEmpty ($this -> object -> getInvalids ());
	}

	/**
	 * Test that we can get the invalid object collection
	 */
	public function testGetInvalids ()
	{
		$this -> assertEmpty ($this -> object -> getInvalids ());
	}

	/**
	 * Test that we can test if the object has invalid items
	 */
	public function testHasInvalids ()
	{
		$this -> assertFalse ($this -> object -> hasInvalids ());
	}
}
