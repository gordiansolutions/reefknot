<?php
/**
 * Reefknot framework
 * 
 * @copyright Gordian Solutions and Gordon McVey
 * @license http://www.apache.org/licenses/LICENSE-2.0.txt Apache license V2.0
 */

namespace gordian\reefknot\access\abstr;

use gordian\reefknot\access\iface;

/**
 * Description of Access
 *
 * @author gordonmcvey
 */
abstract class Access implements iface\Access
{
	protected
		
		/**
		 * The object that is requesting access to the resource
		 * 
		 * @var iface\Consumer
		 */
		$consumer	= NULL,
		
		/**
		 * The object that the consumer is requesting access to
		 * 
		 * @var iface\Resource
		 */
		$resource	= NULL;
}