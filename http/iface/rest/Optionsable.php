<?php
/**
 * Reefknot framework
 * 
 * @copyright Gordian Solutions and Gordon McVey
 * @license http://www.apache.org/licenses/LICENSE-2.0.txt Apache license V2.0
 */

namespace gordian\reefknot\http\iface\rest;

use
	gordian\reefknot\http\iface\Request,
	gordian\reefknot\http\iface\Response;

/**
 * Optionable REST interface
 * 
 * Classes that implement this interace are expected to be able to respond to
 * a HTTP OPTIONS request. 
 * 
 * @author Gordon McVey
 */
interface Optionsable extends Restable
{
	public function httpOptions (Request $request);
}