<?php
/* ProductGallery Test cases generated on: 2010-12-13 22:12:14 : 1292255954*/
App::import('Model', 'ProductGallery');

class ProductGalleryTestCase extends CakeTestCase {
	var $fixtures = array('app.product_gallery', 'app.product', 'app.product_info', 'app.category', 'app.products_category');

	function startTest() {
		$this->ProductGallery =& ClassRegistry::init('ProductGallery');
	}

	function endTest() {
		unset($this->ProductGallery);
		ClassRegistry::flush();
	}

}
?>