<?php
/* Services Test cases generated on: 2010-12-23 09:12:46 : 1293070066*/
App::import('Controller', 'Services');

class TestServicesController extends ServicesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ServicesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.service', 'app.product', 'app.product_info', 'app.category', 'app.products_category', 'app.products_service', 'app.country');

	function startTest() {
		$this->Services =& new TestServicesController();
		$this->Services->constructClasses();
	}

	function endTest() {
		unset($this->Services);
		ClassRegistry::flush();
	}

	function testAdminIndex() {

	}

	function testAdminView() {

	}

	function testAdminAdd() {

	}

	function testAdminEdit() {

	}

	function testAdminDelete() {

	}

}
?>