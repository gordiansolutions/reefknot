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
 * Validatable functionality
 * 
 * Validation in Reefknot is accomplished by collections of Validatable objects.
 * A Validatable embodies a piece of data, and the rules necessary to test that
 * the data is valid.  The rules that perform the validation are themselves 
 * Validatables of various types.  
 *
 * @author Gordon McVey
 * @category Reefknot
 * @package gordian\reefknot\input\validate\abstr
 */
abstract class Validatable implements iface\Validatable
{
	/**
	 * Reference back to this item's parent. Can be NULL for root items
	 *
	 * @var iface\Node
	 */
	private	$parent		= NULL;

	/**
	 * The data to be validated
	 *
	 * @var mixed
	 */
	private	$data		= NULL;

	/**
	 * List of reasons why the item failed validation are stored here
	 *
	 * @var array
	 */
	private	$invalids	= array ();
	
	/**
	 * Set the data to be validated
	 * 
	 * @param mixed $data
	 * @return \gordian\reefknot\input\validate\abstr\Validatable
	 */
	public function setData ($data = NULL)
	{
		$this -> data	= $data;
		return $this;
	}
	
	/**
	 * Get the data that has been set for this item
	 * 
	 * @return mixed 
	 */
	public function getData ()
	{
		return $this -> data;
	}
	
	/**
	 * Set the parent node of this validatable.  
	 * 
	 * @param \gordian\reefknot\input\validate\iface\Node $set The node that is to become the validatable's parent
	 * @return \gordian\reefknot\input\validate\abstr\Validatable
	 * @throws \InvalidArgumentException
	 */
	public function setParent (iface\Node $set)
	{
		if (($this -> parent === NULL)
		|| ($this -> parent === $set))
		{
			$this -> parent	= $set;
		}
		else
		{
			throw new \InvalidArgumentException ('This field already has a parent');
		}
		return $this;
	}
	
	/**
	 * Get the parent node of this validatable
	 * 
	 * @return iface\Node 
	 */
	public function getParent ()
	{
		return $this -> parent;
	}
	
	/**
	 * Clear the validation error list
	 * 
	 * @return \gordian\reefknot\input\validate\abstr\Validatable
	 */
	public function resetInvalids ()
	{
		$this -> invalids	= array ();
		return $this;
	}
	
	/**
	 * Get list of validation failures
	 * 
	 * @return array 
	 */
	public function getInvalids ()
	{
		return $this -> invalids;
	}
	
	/**
	 * Return whether or not the validatable has invalid data
	 * 
	 * @return bool 
	 */
	public function hasInvalids ()
	{
		return !empty ($this -> invalids);
	}
	
	/**
	 * 
	 * @param type $key
	 * @param type $value
	 * @return \gordian\reefknot\input\validate\abstr\Validatable
	 */
	protected function addInvalid ($key = NULL, $value) {
		!is_null ($key)?
			$this -> invalids [$key]	= $value:
			$this -> invalids []		= $value;
		return $this;
	}
}
