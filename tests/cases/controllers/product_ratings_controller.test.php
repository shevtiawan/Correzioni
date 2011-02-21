<?php
/* ProductRatings Test cases generated on: 2010-12-30 08:12:51 : 1293672711*/
App::import('Controller', 'ProductRatings');

class TestProductRatingsController extends ProductRatingsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ProductRatingsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.product_rating', 'app.product', 'app.product_info', 'app.product_gallery', 'app.product_service', 'app.service', 'app.category', 'app.products_category', 'app.rating', 'app.country', 'app.setting');

	function startTest() {
		$this->ProductRatings =& new TestProductRatingsController();
		$this->ProductRatings->constructClasses();
	}

	function endTest() {
		unset($this->ProductRatings);
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