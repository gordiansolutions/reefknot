<?php


namespace gordian\reefknot\autoload\classmap;
use org\bovigo\vfs\vfsStream;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-12-15 at 12:42:11.
 */
class IniFileClassMapTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var IniFileClassMap
	 */
	protected $object;
	
	/**
	 * Mock filesystem
	 * 
	 * @var \org\bovigo\vfs\vfsStreamDirectory
	 */
	protected $fs;
	
	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp ()
	{
		$this -> object = new IniFileClassMap ();
		$this -> fs = vfsStream::setup ('inifileclassmap');
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown ()
	{
		
	}

	/**
	 * Test normal operation of load()
	 */
	public function testLoad ()
	{
		// Set up a typical ini file
		$expected	= [
			"\vendor\application\classes\Foo"	=> "/filesystem/vendor/application/classes/Foo.php",
			"\vendor\application\classes\Bar"	=> "/filesystem/vendor/application/classes/Bar.php",
			"\vendor\application\classes\Baz"	=> "/filesystem/vendor/application/classes/Baz.php",
			"\vendor\application\classes\Quux"	=> "/filesystem/vendor/application/classes/Quux.php"
		];
		$url		= vfsStream::url ('inifileclassmap/text.txt');
		$content	= "
\vendor\application\classes\Foo	= /filesystem/vendor/application/classes/Foo.php
\vendor\application\classes\Bar	= /filesystem/vendor/application/classes/Bar.php
\vendor\application\classes\Baz	= /filesystem/vendor/application/classes/Baz.php
\vendor\application\classes\Quux	= /filesystem/vendor/application/classes/Quux.php
";
		file_put_contents ($url, $content);

		$this -> object -> setFileName ($url);
		$this -> object -> load ();
		$actual	= $this -> object -> getAll ();
		$this -> assertEmpty (array_diff_assoc ($actual, $expected));
		$this -> assertEmpty (array_diff_assoc ($expected, $actual));
	}
	
	/**
	 * Test that attempting to load when no file has been specified yet throws an exception
	 * 
	 * @expectedException \RuntimeException
	 */
	public function testLoadFileNotSet () {
		$this -> object -> load ();
	}
	
	/**
	 * Test that loading a missing file throws an exception
	 * 
	 * @expectedException \RuntimeException
	 */
	public function testLoadFileMissing () {
		$url		= vfsStream::url ('inifileclassmap/testLoadFileMissing.txt');

		$this -> object -> setFileName ($url);
		$this -> object -> load ();
	}
	
	/**
	 * Test we can load an empty file without difficulty
	 */
	public function testLoadEmptyFile () {
		$url		= vfsStream::url ('inifileclassmap/text2.txt');
		$content	= "";
		file_put_contents ($url, $content);

		$this -> object -> setFileName ($url);
		$this -> object -> load ();
		$this -> assertEmpty ($this -> object -> getAll ());
	}
	
	/**
	 * Test that invalid file data causes an exception to be thrown
	 * 
	 * @expectedException \RuntimeException
	 */
	public function testLoadInvalidFile () {
		$url		= vfsStream::url ('inifileclassmap/text3.txt');
		$content	= "file = !@£$%^&*()";
		file_put_contents ($url, $content);

		$this -> object -> setFileName ($url);
		$this -> object -> load ();
	}
	
	/**
	 * Test that saved ini file contains the correct class map data
	 */
	public function testSave ()
	{
		$url	= vfsStream::url ('inifileclassmap/text3.txt');
		$this -> object -> setFileName ($url)
						-> addMapping ("\\vendor\\application\\classes\\Foo", "/filesystem/vendor/application/classes/Foo.php")
						-> addMapping ("\\vendor\\application\\classes\\Bar", "/filesystem/vendor/application/classes/Bar.php")
						-> addMapping ("\\vendor\\application\\classes\\Baz", "/filesystem/vendor/application/classes/Baz.php")
						-> addMapping ("\\vendor\\application\\classes\\Quux", "/filesystem/vendor/application/classes/Quux.php");
		
		$expected	= $this -> object -> getAll ();
		$this -> object -> save ();
		$actual		= parse_ini_file ($url);
		
		$this -> assertEmpty (array_diff_assoc ($expected, $actual));
		$this -> assertEmpty (array_diff_assoc ($actual, $expected));
	}
	
	/**
	 * Test that a file write failure triggers an exception
	 * 
	 * @expectedException \RuntimeException
	 */
	public function testSaveInvalid () {
		$url	= vfsStream::url ('inifileclassmap/text3.txt');
		$this -> object -> setFileName ($url)
						-> addMapping ("\\vendor\\application\\classes\\Foo", "/filesystem/vendor/application/classes/Foo.php")
						-> addMapping ("\\vendor\\application\\classes\\Bar", "/filesystem/vendor/application/classes/Bar.php")
						-> addMapping ("\\vendor\\application\\classes\\Baz", "/filesystem/vendor/application/classes/Baz.php")
						-> addMapping ("\\vendor\\application\\classes\\Quux", "/filesystem/vendor/application/classes/Quux.php");
		touch ($url);
		chmod ($url, 0);
		$this -> object -> save ();
	}
}
