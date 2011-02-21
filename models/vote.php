<?php
class Vote extends AppModel {
	var $name = 'Vote';

	var $belongsTo = array(
		'ProductRating' => array(
			'className' => 'ProductRating',
			'foreignKey' => 'product_rating_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	function votedList($user_id) {
        $list = $this->find('all', array(
            'conditions' => compact('user_id')
        ));
        return Set::extract('/Vote/product_rating_id', $list);
	}
}
