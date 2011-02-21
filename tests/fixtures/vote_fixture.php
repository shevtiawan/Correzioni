<?php
/* Vote Fixture generated on: 2011-01-04 15:01:17 : 1294128917 */
class VoteFixture extends CakeTestFixture {
	var $name = 'Vote';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'product_rating_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'product_rating_id' => 1,
			'user_id' => 1,
			'created' => '2011-01-04 15:15:17',
			'modified' => '2011-01-04 15:15:17'
		),
	);
}
?>