<?php
/* ProductsCategories Test cases generated on: 2010-12-09 13:12:35 : 1291876835*/
App::import('Controller', 'ProductsCategories');

class TestProductsCategoriesController extends ProductsCategoriesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ProductsCategoriesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.products_category', 'app.product', 'app.category');

	function startTest() {
		$this->ProductsCategories =& new TestProductsCategoriesController();
		$this->ProductsCategories->constructClasses();
	}

	function endTest() {
		unset($this->ProductsCategories);
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