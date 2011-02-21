<?php
/* Rating Test cases generated on: 2010-12-09 13:12:45 : 1291876845*/
App::import('Model', 'Rating');

class RatingTestCase extends CakeTestCase {
	var $fixtures = array('app.rating');

	function startTest() {
		$this->Rating =& ClassRegistry::init('Rating');
	}

	function endTest() {
		unset($this->Rating);
		ClassRegistry::flush();
	}

}
?>