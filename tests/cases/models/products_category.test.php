<?php
/* ProductsCategory Test cases generated on: 2010-12-09 13:12:23 : 1291876823*/
App::import('Model', 'ProductsCategory');

class ProductsCategoryTestCase extends CakeTestCase {
	var $fixtures = array('app.products_category', 'app.product', 'app.category');

	function startTest() {
		$this->ProductsCategory =& ClassRegistry::init('ProductsCategory');
	}

	function endTest() {
		unset($this->ProductsCategory);
		ClassRegistry::flush();
	}

}
?>