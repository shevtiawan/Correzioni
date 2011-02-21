<?php
/* ProductInfos Test cases generated on: 2010-12-10 05:12:36 : 1291935576*/
App::import('Controller', 'ProductInfos');

class TestProductInfosController extends ProductInfosController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ProductInfosControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.product_info', 'app.product', 'app.category', 'app.products_category');

	function startTest() {
		$this->ProductInfos =& new TestProductInfosController();
		$this->ProductInfos->constructClasses();
	}

	function endTest() {
		unset($this->ProductInfos);
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