<?php
/* ProductRating Test cases generated on: 2010-12-30 08:12:26 : 1293672566*/
App::import('Model', 'ProductRating');

class ProductRatingTestCase extends CakeTestCase {
	var $fixtures = array('app.product_rating', 'app.product', 'app.product_info', 'app.product_gallery', 'app.product_service', 'app.service', 'app.category', 'app.products_category', 'app.rating');

	function startTest() {
		$this->ProductRating =& ClassRegistry::init('ProductRating');
	}

	function endTest() {
		unset($this->ProductRating);
		ClassRegistry::flush();
	}

}
?>