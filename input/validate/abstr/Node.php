<?php
/**
 * Reefknot framework
 * 
 * @copyright Gordian Solutions and Gordon McVey
 * @license http://www.apache.org/licenses/LICENSE-2.0.txt Apache license V2.0
 */

namespace gordian\reefknot\input\validate\abstr;

use gordian\reefknot\input\validate\iface;

/**
 * Validation node functionality
 * 
 * Validation is implemented around the concept of nodes.  A node is a piece of 
 * data that is to be validated and the collection of rules that the data is
 * expected to conform to.  The rules consist of a Type which determine the 
 * datatype that the data needs to be, and a collection of Properties that 
 * further constrain the values that can be considered valid.  
 *
 * @author Gordon McVey
 * @category Reefknot
 * @package gordian\reefknot\input\validate\abstr
 */
abstract class Node extends Validatable implements iface\Node
{
	/**
	 * The Type object that defines what data type this node is expected to be
	 *
	 * @var iface\Type
	 */
	private $type	= NULL;

	/**
	 * List of Property objects that the node is expected to conform to
	 *
	 * @var array
	 */
	private	$props	= array ();
	
	/**
	 * Add a new property to the node
	 * 
	 * You can only add a prop to a node once, attempts to add the same prop
	 * more than once will trigger an execpt.
	 * 
	 * @param \gordian\reefknot\input\validate\iface\Prop $newProp
	 * @return \gordian\reefknot\input\validate\abstr\Node
	 * @throws \InvalidArgumentException
	 */
	public function addProp (iface\Prop $newProp)
	{
		if (!in_array ($newProp, $this -> props, true))
		{
			$this -> props [get_class ($newProp)]	= $newProp;
			$newProp -> setParent ($this);
		}
		else
		{
			throw new \InvalidArgumentException ('This prop has already been added to this node');
		}
		return $this;
	}
	 
	/**
	 * Remove a property from the node
	 * 
	 * @param string $name
	 * @return \gordian\reefknot\input\validate\abstr\Node
	 */
	public function deleteProp ($name)
	{
		if (isset ($this -> props [$name]))
		{
			unset ($this -> props [$name]);
		}
		return $this;
	}
	
	/**
	 * Get list of properties set for this node
	 * 
	 * @return array 
	 */
	public function getProps ()
	{
		return $this -> props;
	}
	
	/**
	 * Set the expected type for this node
	 * 
	 * @param iface\Type $newType
	 * @return $this
	 */
	public function setType (iface\Type $newType)
	{
		$this		-> type	= $newType;
		$newType	-> setParent ($this);
		return $this;
	}
	
	/**
	 * Get tye type object of this node
	 * 
	 * @return iface\Type 
	 */
	public function getType ()
	{
		return $this -> type;
	}
	
	/**
	 * Get the complete set of validation rules for this node
	 * 
	 * A full set of rules consists of an array, the first element of which is 
	 * the Type that the value needs to conform to to be valid.  The subsequent
	 * elements, if any, describe the Properties that constrain the valid values
	 * of the data.  
	 *  
	 * @return array 
	 */
	public function getRules ()
	{
		$type	= $this -> getType ();
		return array_merge (array (get_class ($type) => $type), $this -> getProps ());
	}
	
	/**
	 * Instantiate the node
	 * 
	 * As all nodes are required to have a type, you have to supply one to the 
	 * class at construction time, otherwise an error will occur.  
	 * 
	 * @param iface\Type $type 
	 */
	public function __construct (iface\Type $type)
	{
		$this -> setType ($type);
	}
}
