<?php
/* Ratings Test cases generated on: 2010-12-09 13:12:29 : 1291877129*/
App::import('Controller', 'Ratings');

class TestRatingsController extends RatingsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class RatingsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.rating');

	function startTest() {
		$this->Ratings =& new TestRatingsController();
		$this->Ratings->constructClasses();
	}

	function endTest() {
		unset($this->Ratings);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
?>