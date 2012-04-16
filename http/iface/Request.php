<?php
/**
 * Reefknot framework
 * 
 * @copyright Gordian Solutions and Gordon McVey
 * @license http://www.apache.org/licenses/LICENSE-2.0.txt Apache license V2.0
 */

namespace gordian\reefknot\http\iface;

/**
 * HTTP Request object interface
 * 
 * @author Gordon McVey
 */
interface Request
{
	const
		M_CONNECT	= 'CONNECT',
		M_DELETE	= 'DELETE',
		M_GET		= 'GET',
		M_HEAD		= 'HEAD',
		M_OPTIONS	= 'OPTIONS',
		M_POST		= 'POST',
		M_POT		= 'PUT',
		M_TRACE		= 'TRACE';
	
	public function getMethod ();
	public function getVersion ();
	public function getQuery ();
	public function getPost ();
	public function getCookie ();
	public function getHeader ($headerKey);
	public function getHeaders ();
	public function getBody ();
}