<?php
require_once 'web/WindWebApplicationTest.php';
require_once 'web/WindUrlHelperTest.php';
require_once 'web/WindForwardTest.php';
require_once 'web/WindErrorHandlerTest.php';
require_once 'web/WindDispatcherTest.php';
require_once 'web/WindControllerTest.php';
/**
 * Static test suite.
 *
 * @author Qiong Wu <papa0924@gmail.com> 2011-10-14
 * @copyright ©2003-2103 phpwind.com
 * @license http://www.windframework.com
 * @version $Id$
 * @package web
 */
class AllWebTest extends PHPUnit_Framework_TestSuite {

	public static function main() {
		PHPUnit_TestUI_TestRunner::run(self::suite());
	}

	public static function suite() {
		$suite = new PHPUnit_Framework_TestSuite('WindFramework AllWebTest');
		$suite->addTestSuite("WindWebApplicationTest");
		$suite->addTestSuite("WindUrlHelperTest");
		$suite->addTestSuite("WindForwardTest");
		$suite->addTestSuite("WindErrorHandlerTest");
		$suite->addTestSuite("WindDispatcherTest");
		$suite->addTestSuite("WindControllerTest");
		return $suite;
	}
}

