<?php
/* Vote Test cases generated on: 2011-01-04 15:01:18 : 1294128918*/
App::import('Model', 'Vote');

class VoteTestCase extends CakeTestCase {
	var $fixtures = array('app.vote', 'app.product_rating', 'app.product', 'app.product_info', 'app.product_gallery', 'app.product_service', 'app.service', 'app.products_category', 'app.category', 'app.rating', 'app.user', 'app.group');

	function startTest() {
		$this->Vote =& ClassRegistry::init('Vote');
	}

	function endTest() {
		unset($this->Vote);
		ClassRegistry::flush();
	}

}
?>