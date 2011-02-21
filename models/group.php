<?php
class Group extends AppModel {

	var $name = 'Group';

	function __construct($id = false, $table = null, $ds = null) {
	    parent::__construct($id, $table, $ds);

	    $this->validate = array(
	        'name' => array(
	            'notEmpty' => array(
	                'rule' => 'notEmpty',
	                'message' => __('Name cannot be blank', true)
                ),
                'isUnique' => array(
                    'rule' => 'isUnique',
                    'message' => __('This name has already been taken', true)
                )
	        ),
	        'alias' => array(
	            'notEmpty' => array(
	                'rule' => 'alphanumeric',
	                'message' => __('Alias contains only letters and numbers', true)
                ),
                'isUnique' => array(
                    'rule' => 'isUnique',
                    'message' => __('This name has already been taken', true)
                )
	        )
	    );
	}
}
