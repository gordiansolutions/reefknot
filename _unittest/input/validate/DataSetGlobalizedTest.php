<?php

namespace gordian\reefknot\input\validate;

require_once dirname (__FILE__) . '/../../../input/validate/DataSetGlobalized.php';

/**
 * Test class for DataSetGlobalized.
 * Generated by PHPUnit on 2012-03-28 at 17:05:49.
 */
class DataSetGlobalizedTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var gordian\reefknot\input\validate\DataSetGlobalized
	 */
	protected $object;

	/**
	 * Helper for building mock props
	 * 
	 * @param mixed $value
	 * @param bool $isValid
	 * @return gordian\reefknot\input\validate\iface\Rule
	 */
	protected function makeStub ($type, $value = NULL, $isValid = true)
	{
		$stub	= $this -> getMockBuilder ('gordian\reefknot\input\validate\iface\\' . $type)
				-> disableOriginalConstructor ()
				-> getMock ();
		
		$stub	-> expects ($this -> any ())
				-> method ('setData')
				-> will ($this -> returnValue ($stub));
		
		$stub	-> expects ($this -> any ())
				-> method ('getData')
				-> will ($this -> returnValue ($value));
		
		$stub	-> expects ($this -> any ())
				-> method ('isValid')
				-> will ($this -> returnValue ($isValid));

		return ($stub);
	}
	
	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp ()
	{
		$this -> object = new DataSetGlobalized ($this -> makeStub ('Type'));
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown ()
	{
		
	}

	/**
	 */
	public function testGetGlobalInvalids ()
	{
		$this -> assertEquals ($this -> object -> getGlobalInvalids (), array ());
	}

	/**
	 */
	public function testResetInvalids ()
	{
		$this -> object -> resetInvalids ();
		$this -> assertEquals ($this -> object -> getInvalids (), array ());
		$this -> assertEquals ($this -> object -> getGlobalInvalids (), array ());
	}

	/**
	 */
	public function testHasInvalids ()
	{
		$this -> assertFalse ($this -> object -> hasInvalids ());
	}

	/**
	 */
	public function testAddGlobalProp ()
	{
		$prop	= $this -> getMock ('\gordian\reefknot\input\validate\iface\Prop');
		$this -> assertFalse (in_array ($prop, $this -> object -> getGlobalProps (), true));
		$this -> object -> addGlobalProp ($prop);
		$this -> assertTrue (in_array ($prop, $this -> object -> getGlobalProps (), true));
	}
	
	/**
	 * @expectedException \InvalidArgumentException
	 */
	public function testAddSameGlobalPropThrowsException ()
	{
		$prop	= $this -> getMock ('\gordian\reefknot\input\validate\iface\Prop');
		$this -> object -> addGlobalProp ($prop);
		$this -> object -> addGlobalProp ($prop);
	}
	
	/**
	 */
	public function testDeleteGlobalProp ()
	{
		$prop	= $this -> getMock ('\gordian\reefknot\input\validate\iface\Prop');
		$this -> object -> addGlobalProp ($prop);
		$this -> assertTrue (in_array ($prop, $this -> object -> getGlobalProps (), true));
		$this -> object -> deleteGlobalProp (get_class ($prop));
		$this -> assertFalse (in_array ($prop, $this -> object -> getGlobalProps (), true));
	}

	/**
	 */
	public function testGetGlobalProps ()
	{
		$prop1	= $this -> getMock ('\gordian\reefknot\input\validate\iface\Prop', array (), array (), 'TestProp1');
		$prop2	= $this -> getMock ('\gordian\reefknot\input\validate\iface\Prop', array (), array (), 'TestProp2');
		$prop3	= $this -> getMock ('\gordian\reefknot\input\validate\iface\Prop', array (), array (), 'TestProp3');
		
		$props	= array (
			get_class ($prop1)	=> $prop1,
			get_class ($prop2)	=> $prop2,
			get_class ($prop3)	=> $prop3
		);
		
		$this -> object -> addGlobalProp ($prop1) -> addGlobalProp ($prop2) -> addGlobalProp ($prop3);
		
		$this -> assertTrue ($this -> object -> getGlobalProps () === $props);
	}

	/**
	 */
	public function testSetGlobalType ()
	{
		$mock	= $this -> getMock ('\gordian\reefknot\input\validate\iface\Type');
		$this -> object -> setGlobalType ($mock);
		$this -> assertTrue ($mock === $this -> object -> getGlobalType ());
	}

	/**
	 */
	public function testGetGlobalType ()
	{
		$this -> assertNull ($this -> object -> getGlobalType ());
		$mock	= $this -> getMock ('\gordian\reefknot\input\validate\iface\Type');
		$this -> object -> setGlobalType ($mock);
		$this -> assertTrue ($mock === $this -> object -> getGlobalType ());
	}

	/**
	 */
	public function testGetGlobalRules ()
	{
		$type	= $this -> getMock ('\gordian\reefknot\input\validate\iface\Type');
		$prop1	= $this -> getMock ('\gordian\reefknot\input\validate\iface\Prop', array (), array (), 'TestProp4');
		$prop2	= $this -> getMock ('\gordian\reefknot\input\validate\iface\Prop', array (), array (), 'TestProp5');
		$prop3	= $this -> getMock ('\gordian\reefknot\input\validate\iface\Prop', array (), array (), 'TestProp6');
		
		$rules	= array (
			get_class ($type)	=> $type,
			get_class ($prop1)	=> $prop1,
			get_class ($prop2)	=> $prop2,
			get_class ($prop3)	=> $prop3
		);
		
		$this -> object -> setGlobalType ($type) 
						-> addGlobalProp ($prop1) 
						-> addGlobalProp ($prop2) 
						-> addGlobalProp ($prop3);
		
		$this -> assertTrue ($this -> object -> getGlobalRules () === $rules);
	}

	/**
	 */
	public function testIsValidArrayPasses ()
	{
		$this -> object -> setType (new type\IsArray ()) -> setData (array (1, 2, 3));
		$this -> assertTrue ($this -> object -> isValid ());
	}
	
	public function testIsValidNotArrayFails ()
	{
		$this -> object -> setType (new type\IsArray ()) -> setData (123);
		$this -> assertFalse ($this -> object -> isValid ());
	}
	
	public function testIsValidArrayPropsPasses ()
	{
		$this -> object -> addProp ($this -> makeStub ('Prop'))
						-> setData (array (1, 2, 3));
		
		$this -> assertTrue ($this -> object -> isValid ());
	}
	
	public function testIsValidArrayPropsFails ()
	{
		$this -> object -> addProp ($this -> makeStub ('Prop', NULL, false))
						-> setData (array (1, 2, 3));
		
		$this -> assertFalse ($this -> object -> isValid ());
	}
	
	public function testIsValidGlobalRulesPasses ()
	{
		$this -> object -> setGlobalType ($this -> makeStub ('Type'))
						-> addGlobalProp ($this -> makeStub ('Prop'))
						-> setData (array (1, 2, 3));
		
		$this -> assertTrue ($this -> object -> isValid ());
	}
	
	public function testIsValidGlobalRulesFailsOnType ()
	{
		$this -> object -> setGlobalType ($this -> makeStub ('Type', NULL, false))
						-> addGlobalProp ($this -> makeStub ('Prop'))
						-> setData (array (1, 2, 3));
		
		$this -> assertFalse ($this -> object -> isValid ());
	}
	
	public function testIsValidGlobalRulesFailsOnProp ()
	{
		$this -> object -> setGlobalType ($this -> makeStub ('Type'))
						-> addGlobalProp ($this -> makeStub ('Prop', NULL, false))
						-> setData (array (1, 2, 3));
		
		$this -> assertFalse ($this -> object -> isValid ());
	}
	
	public function testIsValidFieldRulesPasses ()
	{
		$field	= new Field ($this -> makeStub ('Type'));
		$field -> addProp ($this -> makeStub ('Prop'));
		
		$this -> object -> setGlobalType ($this -> makeStub ('Type'))
						-> addGlobalProp ($this -> makeStub ('Prop'))
						-> addField ('namedField', $field)
						-> setData (array (1, 2, 3, 'namedField' => 'abc'));
		
		$this -> assertTrue ($this -> object -> isValid ());
	}
	
	public function testIsValidFieldRulesFailsOnType ()
	{
		$field	= new Field ($this -> makeStub ('Type', NULL, false));
		$field -> addProp ($this -> makeStub ('Prop'));
		
		$this -> object -> setGlobalType ($this -> makeStub ('Type'))
						-> addGlobalProp ($this -> makeStub ('Prop'))
						-> addField ('namedField', $field)
						-> setData (array (1, 2, 3, 'namedField' => 'abc'));
		
		$this -> assertFalse ($this -> object -> isValid ());
	}
	
	public function testIsValidFieldRulesFailsOnProp ()
	{
		$field	= new Field ($this -> makeStub ('Type'));
		$field -> addProp ($this -> makeStub ('Prop', NULL, false));
		
		$this -> object -> setGlobalType ($this -> makeStub ('Type'))
						-> addGlobalProp ($this -> makeStub ('Prop'))
						-> addField ('namedField', $field)
						-> setData (array (1, 2, 3, 'namedField' => 'abc'));
		
		$this -> assertFalse ($this -> object -> isValid ());
		
	}
}
