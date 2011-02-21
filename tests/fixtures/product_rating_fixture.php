<?php
/* ProductRating Fixture generated on: 2010-12-30 08:12:26 : 1293672566 */
class ProductRatingFixture extends CakeTestFixture {
	var $name = 'ProductRating';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'product_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'rating_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'total_user' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'point' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexed_at' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'product_id' => 1,
			'rating_id' => 1,
			'total_user' => 1,
			'point' => 1,
			'indexed_at' => 1,
			'created' => '2010-12-30 08:29:26',
			'modified' => '2010-12-30 08:29:26'
		),
	);
}
?>