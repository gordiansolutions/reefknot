<?php
/**
 * Reefknot framework
 * 
 * @copyright Gordian Solutions and Gordon McVey
 * @license http://www.apache.org/licenses/LICENSE-2.0.txt Apache license V2.0
 */

namespace gordian\reefknot\storage\session\iface;

use
	gordian\reefknot\iface;

/**
 * Interface for ReefKnot session manager
 *
 * @author Gordon McVey
 * @category Reefknot
 * @package Storage
 * @subpackage Session
 * @subpackage Interfaces
 */
interface Session extends iface\Crud, \Countable, \Iterator
{
	/**
	 * Check whethere there is data stored in the session
	 * 
	 * @return gordian\reefknot\storage\session\iface\Session
	 */
	public function hasData ();
	
	/**
	 * Remove all data from the session
	 * 
	 * @return gordian\reefknot\storage\session\iface\Session
	 */
	public function reset ();
	
	/**
	 * Instantise a session
	 * 
	 * @param gordian\reefknot\storage\session\iface\Binding $binding
	 * @param string $namespace
	 */
	public function __construct (Binding $binding, $namespace);
}
