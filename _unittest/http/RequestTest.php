<?php
namespace gordian\reefknot\http;

//require_once dirname (__FILE__) . '/../../http/Request.php';

/**
 * Test class for Request.
 * Generated by PHPUnit on 2012-08-03 at 08:11:51.
 */
class RequestTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var Request
	 */
	protected $object;
	
	/*
	 * Some example request data
	 */
	protected
		/**
		 * Reference data for setting up a Request
		 */
		$get		= array (
			'queryParam1'	=> '1', 
			'queryParam2'	=> 'The quick brown fox jumps over the lazy dog.'
		),
		$post		= array (
			'postParam1'	=> '2', 
			'postParam2'	=> "Only the fool would take trouble to verify that his sentence was composed of ten a's, three b's, four c's, four d's, forty-six e's, sixteen f's, four g's, thirteen h's, fifteen i's, two k's, nine l's, four m's, twenty-five n's, twenty-four o's, five p's, sixteen r's, forty-one s's, thirty-seven t's, ten u's, eight v's, eight w's, four x's, eleven y's, twenty-seven commas, twenty-three apostrophes, seven hyphens and, last but not least, a single !"
		),
		$cookie		= array (
			'cookieParam1'	=> '3', 
			'cookieParam2'	=> 'Big fjords vex quick waltz nymph.'
		),
		$files		= array (),
		$server		= array (
			'HTTP_HOST'				=> 'localhost',
			'HTTP_USER_AGENT'		=> 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:14.0) Gecko/20100101 Firefox/14.0.1',
			'HTTP_ACCEPT'			=> 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
			'HTTP_ACCEPT_LANGUAGE'	=> 'en-gb,en;q=0.5',
			'HTTP_ACCEPT_ENCODING'	=> 'gzip, deflate', 
			'HTTP_DNT'				=> '1',
			'HTTP_CONNECTION'		=> 'keep-alive', 
			'HTTP_COOKIE'			=> 'cookieParam1=3&cookieParam2=Big%20fjords%20vex%20quick%20waltz%20nymph.',
			'PATH'					=> '/usr/bin:/bin:/usr/sbin:/sbin', 
			'SERVER_SIGNATURE'		=> 'Server signiture goes here',
			'SERVER_SOFTWARE'		=> 'Apache/2.2.21 (Unix) mod_ssl/2.2.21 OpenSSL/0.9.8r DAV/2 PHP/5.3.13', 
			'SERVER_NAME'			=> 'localhost',
			'SERVER_ADDR'			=> '127.0.0.1',
			'SERVER_PORT'			=> '80', 
			'REMOTE_ADDR'			=> '127.0.0.1',
			'DOCUMENT_ROOT'			=> '/usr/docs/dummy-host.example.com', 
			'SERVER_ADMIN'			=> 'webmaster@dummy-host.example.com',
			'REMOTE_PORT'			=> '50847',
			'GATEWAY_INTERFACE'		=> 'SERVER_PROTOCOL',
			'REQUEST_METHOD'		=> 'GET',
			'QUERY_STRING'			=> 'queryParam1=1&queryParam2=The%20quick%20brown%20fox%20jumps%20over%20the%20lazy%20dog.',
			'REQUEST_URI'			=> '/foo/bar/baz.php?queryParam1=1&queryParam2=The%20quick%20brown%20fox%20jumps%20over%20the%20lazy%20dog.#asdf',
			'REQUEST_TIME'			=> '',
			'SCRIPT_FILENAME'		=> '',
			'SCRIPT_NAME'			=> '',
			'PHP_SELF'				=> '',
		),
		$env		= array ();
	
	protected function prepServer ()
	{
		$prepped	= $this -> server;
		$prepped ['REQUEST_TIME']		= time ();
		$prepped ['SCRIPT_FILENAME']	= $_SERVER ['SCRIPT_FILENAME'];
		$prepped ['SCRIPT_NAME']		= $_SERVER ['SCRIPT_NAME'];
		$prepped ['PHP_SELF']			= $_SERVER ['PHP_SELF'];
		return $prepped;
	}
	
	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp ()
	{
		$this -> object = new Request (	$this -> get, 
										$this -> post, 
										$this -> cookie, 
										$this -> files, 
										$this -> prepServer (), 
										$this -> env);
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown ()
	{
		
	}

	/**
	 * Test that the valid HTTP methods are passed as valid
	 */
	public function testMethodValidConnect ()
	{
		$this -> assertTrue ($this -> object -> methodValid ('CONNECT'));
	}
	
	/**
	 * Test that the valid HTTP methods are passed as valid
	 */
	public function testMethodValidDelete ()
	{
		$this -> assertTrue ($this -> object -> methodValid ('DELETE'));

	}
	
	/**
	 * Test that the valid HTTP methods are passed as valid
	 */
	public function testMethodValidGet ()
	{
		$this -> assertTrue ($this -> object -> methodValid ('GET'));

	}
	
	/**
	 * Test that the valid HTTP methods are passed as valid
	 */
	public function testMethodValidHead ()
	{
		$this -> assertTrue ($this -> object -> methodValid ('HEAD'));
	}
	
	/**
	 * Test that the valid HTTP methods are passed as valid
	 */
	public function testMethodValidOptions ()
	{
		$this -> assertTrue ($this -> object -> methodValid ('OPTIONS'));
	}
	
	/**
	 * Test that the valid HTTP methods are passed as valid
	 */
	public function testMethodValidPost ()
	{
		$this -> assertTrue ($this -> object -> methodValid ('POST'));
	}
	
	/**
	 * Test that the valid HTTP methods are passed as valid
	 */
	public function testMethodValidPut ()
	{
		$this -> assertTrue ($this -> object -> methodValid ('PUT'));
	}
	
	/**
	 * Test that the valid HTTP methods are passed as valid
	 */
	public function testMethodValidTrace ()
	{
		$this -> assertTrue ($this -> object -> methodValid ('TRACE'));
	}
	
	/**
	 * Test getMethod returns the expected value for a GET
	 */
	public function testGetMethod ()
	{
		$this -> assertEquals ('GET', $this -> object -> getMethod ());
	}

	/**
	 * Test isConnect method for CONNECT request
	 */
	public function testIsConnectTrue ()
	{
		$server						= $this -> prepServer ();
		$server ['REQUEST_METHOD']	= 'CONNECT';
		
		$this -> object	= new Request (	$this -> get, 
										$this -> post,
										$this -> cookie,
										$this -> files,
										$server, 
										$this -> env);
		
		$this -> assertTrue ($this -> object -> isConnect ());
	}
	
	/**
	 * Test isConnect method when not a CONNECT request
	 */
	public function testIsConnectFalse ()
	{
		$this -> assertFalse ($this -> object -> isConnect ());
	}

	/**
	 * Test isDelete method for DELETE request
	 */
	public function testIsDeleteTrue ()
	{
		$server						= $this -> prepServer ();
		$server ['REQUEST_METHOD']	= 'DELETE';
		
		$this -> object	= new Request (	$this -> get, 
										$this -> post,
										$this -> cookie,
										$this -> files,
										$server, 
										$this -> env);
		
		$this -> assertTrue ($this -> object -> isDelete ());
	}

	/**
	 * Test isDelete method when not a DELETE request
	 */
	public function testIsDeleteFalse ()
	{
		$this -> assertFalse ($this -> object -> isDelete ());
	}

	/**
	 * Test isGet for GET request
	 */
	public function testIsGetTrue ()
	{
		$this -> assertTrue ($this -> object -> isGet ());
	}

	/**
	 * Test isGet when not a GET request
	 */
	public function testIsGetFalse ()
	{
		$server						= $this -> prepServer ();
		$server ['REQUEST_METHOD']	= 'POST';
		
		$this -> object	= new Request (	$this -> get, 
										$this -> post,
										$this -> cookie,
										$this -> files,
										$server, 
										$this -> env);
		
		$this -> assertFalse ($this -> object -> isGet ());
	}

	/**
	 * Test isHead for HEAD request
	 */
	public function testIsHeadTrue ()
	{
		$server						= $this -> prepServer ();
		$server ['REQUEST_METHOD']	= 'HEAD';
		
		$this -> object	= new Request (	$this -> get, 
										$this -> post,
										$this -> cookie,
										$this -> files,
										$server, 
										$this -> env);
		
		$this -> assertTrue ($this -> object -> isHead ());
	}
	
	/**
	 * Test isHead method when not a HEAD request
	 */
	public function testIsHeadFalse ()
	{
		$this -> assertFalse ($this -> object -> isHead ());
	}

	/**
	 * Test isOptions for OPTIONS request
	 */
	public function testIsOptionsTrue ()
	{
		$server						= $this -> prepServer ();
		$server ['REQUEST_METHOD']	= 'OPTIONS';
		
		$this -> object	= new Request (	$this -> get, 
										$this -> post,
										$this -> cookie,
										$this -> files,
										$server, 
										$this -> env);
		
		$this -> assertTrue ($this -> object -> isOptions ());
	}

	/**
	 * Test isOptions method when not an OPTIONS request 
	 */
	public function testIsOptionsFalse ()
	{
		$this -> assertFalse ($this -> object -> isOptions ());
	}

	/**
	 * Test isPost for POST requests
	 */
	public function testIsPostTrue ()
	{
		$server						= $this -> prepServer ();
		$server ['REQUEST_METHOD']	= 'POST';
		
		$this -> object	= new Request (	$this -> get, 
										$this -> post,
										$this -> cookie,
										$this -> files,
										$server, 
										$this -> env);
		
		$this -> assertTrue ($this -> object -> isPost ());
	}

	/**
	 * Test isPost method when not a POST request
	 */
	public function testIsPostFalse ()
	{
		$this -> assertFalse ($this -> object -> isPost ());
	}

	/**
	 * Test isPut for PUT request
	 */
	public function testIsPutTrue ()
	{
		$server						= $this -> prepServer ();
		$server ['REQUEST_METHOD']	= 'PUT';
		
		$this -> object	= new Request (	$this -> get, 
										$this -> post,
										$this -> cookie,
										$this -> files,
										$server, 
										$this -> env);
		
		$this -> assertTrue ($this -> object -> isPut ());
	}

	/**
	 * Test isPut method when not a PUT request
	 */
	public function testIsPutFalse ()
	{
		$this -> assertFalse ($this -> object -> isPut ());
	}

	/**
	 * Test isTrace for TRACE request
	 */
	public function testIsTraceTrue ()
	{
		$server						= $this -> prepServer ();
		$server ['REQUEST_METHOD']	= 'TRACE';
		
		$this -> object	= new Request (	$this -> get, 
										$this -> post,
										$this -> cookie,
										$this -> files,
										$server, 
										$this -> env);
		
		$this -> assertTrue ($this -> object -> isTrace ());
	}

	/**
	 * Test isTrace method when not a TRACE request
	 */
	public function testIsTraceFalse ()
	{
		$this -> assertFalse ($this -> object -> isTrace ());
	}

	/**
	 * Test that isSecure returns false when there is not HTTPS token
	 */
	public function testIsSecureNoHttpsToken ()
	{
		$this -> assertFalse ($this -> object -> isSecure ());
	}

	/**
	 * Test that isSecure returns false when there is a HTTPS token nbut its value is 'off'
	 */
	public function testIsSecureHttpsTokenIsOff ()
	{
		$server				= $this -> prepServer ();
		$server ['HTTPS']	= 'off';
		
		$this -> object	= new Request (	$this -> get, 
										$this -> post,
										$this -> cookie,
										$this -> files,
										$server, 
										$this -> env);
		
		$this -> assertFalse ($this -> object -> isSecure ());
	}

	/**
	 * Test that isSecure returns true when there is a HTTPS token that doesn't have a value of 'off'
	 */
	public function testIsSecureHttpsTokenIsNotOff ()
	{
		$server				= $this -> prepServer ();
		$server ['HTTPS']	= 'on';
		
		$this -> object	= new Request (	$this -> get, 
										$this -> post,
										$this -> cookie,
										$this -> files,
										$server, 
										$this -> env);
		
		$this -> assertTrue ($this -> object -> isSecure ());
	}

	/**
	 * Test that getQuery returns valid results
	 */
	public function testGetQuery ()
	{
		$expected	= $this -> get;
		
		$this -> assertSame ($expected, $this -> object -> getQuery ());
	}

	/**
	 * Test that we can get a query parameter
	 */
	public function testGetQueryParamExists ()
	{
		$this -> assertEquals ('The quick brown fox jumps over the lazy dog.', $this -> object -> getQueryParam ('queryParam2'));
	}
	
	/**
	 * Test that a non-existant query parameter returns NULL
	 */
	public function testGetQueryParamDoesntExist ()
	{
		$this -> assertNull ($this -> object -> getQueryParam ('queryParam3'));
	}
	
	/**
	 * Test that an exception is thrown if an invalid key type is used
	 * 
	 * @expectedException invalidArgumentException
	 */
	public function testQueryParamThrowsException ()
	{
		$this -> object -> getQueryParam (array ());
	}
	
	/**
	 * Test that getPost returns valid results
	 */
	public function testGetPost ()
	{
		$expected	= $this -> post;
		
		$this -> assertSame ($expected, $this -> object -> getPost ());
	}

	/**
	 * Test we can get a post parameter
	 */
	public function testGetPostParamExists ()
	{
		$this -> assertEquals ("Only the fool would take trouble to verify that his sentence was composed of ten a's, three b's, four c's, four d's, forty-six e's, sixteen f's, four g's, thirteen h's, fifteen i's, two k's, nine l's, four m's, twenty-five n's, twenty-four o's, five p's, sixteen r's, forty-one s's, thirty-seven t's, ten u's, eight v's, eight w's, four x's, eleven y's, twenty-seven commas, twenty-three apostrophes, seven hyphens and, last but not least, a single !", $this -> object -> getPostParam ('postParam2'));
	}

	/**
	 * Test that a non-existant post parameter returns NULL
	 */
	public function testGetPostParamDoesntExist ()
	{
		$this -> assertNull ($this -> object -> getPostParam ('postParam3'));
	}
	
	/**
	 * Test that an exception is thrown if an invalid key type is used
	 * 
	 * @expectedException invalidArgumentException
	 */
	public function testGetPostParamThrowsException ()
	{
		$this -> object -> getPostParam (array ());
	}

	/**
	 * Test that getCookie returns valid results
	 */
	public function testGetCookie ()
	{
		$expected	= $this -> cookie;
		
		$this -> assertSame ($expected, $this -> object -> getCookie ());
	}

	/**
	 * Test that we can get a cookie parameter
	 */
	public function testGetCookieParamExists ()
	{
		$this -> assertEquals ('Big fjords vex quick waltz nymph.', $this -> object -> getCookieParam ('cookieParam2'));
	}

	/**
	 * Test that a non-existant cookie parameter returns NULL
	 */
	public function testGetCookieParamDoesntExist ()
	{
		$this -> assertNull ($this -> object -> getCookieParam ('postParam3'));
	}

	/**
	 * Test that an exception is thrown if an invalid key type is used
	 * 
	 * @expectedException invalidArgumentException
	 */
	public function testGetCookieParamThrowsException ()
	{
		$this -> object -> getCookieParam (array ());
	}

	/**
	 * Test that getHeaders returns valid results when pulling data from $_SERVER
	 */
	public function testGetHeadersFromServer ()
	{
		$expected	= array (
			"Host"				=> "localhost",
			"User-Agent"		=> "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:14.0) Gecko/20100101 Firefox/14.0.1",
			"Accept"			=> "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8", 
			"Accept-Language"	=> "en-gb,en;q=0.5", 
			"Accept-Encoding"	=> "gzip, deflate", 
			"Dnt"				=> "1",
			"Connection"		=> "keep-alive",
			"Cookie"			=> "cookieParam1=3&cookieParam2=Big%20fjords%20vex%20quick%20waltz%20nymph."			
		);
		
		$this -> assertSame ($expected, $this -> object -> getHeaders ());
	}
	
	/**
	 * Test that getHeaders returns valid results when pulling data from the headers using native header parsing
	 */
	public function testGetHeadersFromNative ()
	{
		$expected	= array (
			"Host"				=> "localhost",
			"User-Agent"		=> "Mozilla/5.0 (my browser)",
			"Accept"			=> "text/html,application/xhtml+xml,application/xml;q=0.8,*/*;q=0.6", 
			"Accept-Language"	=> "en-gb", 
			"Accept-Encoding"	=> "gzip, deflate", 
			"Dnt"				=> "1",
			"Connection"		=> "keep-alive",
			"Cookie"			=> "cookieParam1=3&cookieParam2=Big%20fjords%20vex%20quick%20waltz%20nymph."			
		);
		
		$mock	= $this -> getMock (	'gordian\reefknot\http\Request', 
										array ('getHeadersNatively'),
										array (
											$this -> get, 
											$this -> post, 
											$this -> cookie, 
											$this -> files, 
											$this -> prepServer (), 
											$this -> env));
		
		$mock	-> expects ($this -> any ())
				-> method ('getHeadersNatively')
				-> will ($this -> returnValue ($expected));
		
		$this -> object	= $mock;
		
		$this -> assertSame ($expected, $this -> object -> getHeaders ());
	}
	
	/**
	 * Test that we can get a header parameter
	 */
	public function testGetHeaderParamExists ()
	{
		$this -> assertEquals ('gzip, deflate', $this -> object -> getHeaderParam ('Accept-Encoding'));
	}

	/**
	 * Test that a non-existant header parameter returns NULL
	 */
	public function testGetHeaderParamDoesntExist ()
	{
		$this -> assertNull ($this -> object -> getHeaderParam ('Accept-Konquat'));
	}
	
	/**
	 * Test that an exception is thrown if an invalid key type is used
	 * 
	 * @expectedException invalidArgumentException
	 */
	public function testGetHeaderParamThrowsException ()
	{
		$this -> object -> getHeaderParam (array ());
	}
	
	/**
	 * Test that isXhr returns false if none of the requirements are met
	 */
	public function testIsXhrFalse ()
	{
		$this -> assertFalse ($this -> object -> IsXhr ());
	}

	/**
	 * Test that setting the proper header triggers isXhr to be true
	 */
	public function testIsXhrHeader ()
	{
		$server								= $this -> prepServer ();
		$server ['HTTP_X_REQUESTED_WITH']	= 'XmlHttpRequest';
		
		$this -> object	= new Request (	$this -> get, 
										$this -> post,
										$this -> cookie,
										$this -> files,
										$server, 
										$this -> env);
		
		$this -> assertTrue ($this -> object -> IsXhr ());
	}
	
	/**
	 * Test that setting the proper variable in the Query triggers isXhr to be true
	 */
	public function testIsXhrQuery ()
	{
		$get						= $this -> get;
		$get ['__reefknot']['xhr']	= 1;
		
		$this -> object	= new Request (	$get, 
										$this -> post,
										$this -> cookie,
										$this -> files,
										$this -> prepServer (), 
										$this -> env);
		
		$this -> assertTrue ($this -> object -> IsXhr ());
	}
	
	/**
	 * Test that setting the proper variable in the Post triggers isXhr to be true
	 */
	public function testIsXhrPost ()
	{
		$post						= $this -> post;
		$post ['__reefknot']['xhr']	= 1;
		
		$this -> object	= new Request (	$this -> get, 
										$post,
										$this -> cookie,
										$this -> files,
										$this -> prepServer (), 
										$this -> env);
		
		$this -> assertTrue ($this -> object -> IsXhr ());
	}
	
	/**
	 * Test getUri
	 */
	public function testGetUri ()
	{
		$this -> assertEquals ('/foo/bar/baz.php?queryParam1=1&queryParam2=The%20quick%20brown%20fox%20jumps%20over%20the%20lazy%20dog.#asdf', $this -> object -> getUri ());
	}

	/**
	 * Test that we can get the URL fragment
	 */
	public function testGetFragment ()
	{
		$this -> assertEquals ('asdf', $this -> object -> getFragment ());
	}

	/**
	 * Test that we can get the host
	 */
	public function testGetHost ()
	{
		$this -> assertEquals ('localhost', $this -> object -> getHost ());
	}

	/**
	 * Test that we can get the password encoded in the URL
	 * 
	 * @todo Implement testGetPassword().
	 */
	public function testGetPassword ()
	{
		// Remove the following lines when you implement this test.
		$this -> markTestIncomplete (
			'This test has not been implemented yet.'
		);
	}

	/**
	 * Test that we can get the path part of the URL
	 */
	public function testGetPath ()
	{
		$this -> assertEquals ('/foo/bar/baz.php', $this -> object -> getPath ());
	}

	/**
	 * Test that we can get the port
	 */
	public function testGetPort ()
	{
		$this -> assertEquals (80, $this -> object -> getPort ());
	}

	/**
	 * @covers gordian\reefknot\http\Request::getScheme
	 * @todo Implement testGetScheme().
	 */
	public function testGetScheme ()
	{
		// Remove the following lines when you implement this test.
		$this -> assertEquals ('http', $this -> object -> getScheme ());
	}

	/**
	 * @covers gordian\reefknot\http\Request::getUser
	 * @todo Implement testGetUser().
	 */
	public function testGetUser ()
	{
		// Remove the following lines when you implement this test.
		$this -> markTestIncomplete (
			'This test has not been implemented yet.'
		);
	}

}
