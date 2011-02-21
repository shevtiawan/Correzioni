<?php
/* ProductServices Test cases generated on: 2010-12-31 03:12:05 : 1293742685*/
App::import('Controller', 'ProductServices');

class TestProductServicesController extends ProductServicesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ProductServicesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.product_service', 'app.product', 'app.product_info', 'app.product_gallery', 'app.product_rating', 'app.rating', 'app.category', 'app.products_category', 'app.service', 'app.country', 'app.setting');

	function startTest() {
		$this->ProductServices =& new TestProductServicesController();
		$this->ProductServices->constructClasses();
	}

	function endTest() {
		unset($this->ProductServices);
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