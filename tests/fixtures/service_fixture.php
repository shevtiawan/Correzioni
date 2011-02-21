<?php
/* Service Fixture generated on: 2010-12-23 09:12:12 : 1293070032 */
class ServiceFixture extends CakeTestFixture {
	var $name = 'Service';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'description' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'icon_path' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'created_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'icon_path' => 'Lorem ipsum dolor sit amet',
			'created_at' => '2010-12-23 09:07:12',
			'updated_at' => '2010-12-23 09:07:12'
		),
	);
}
?>