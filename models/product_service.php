<?php
class ProductService extends AppModel {
	var $name = 'ProductService';

	var $belongsTo = array('Product', 'Service');

	var $actsAs = array(
        'Sequence.Sequence' => array(
            'order_field' => 'indexed_at',
            'group_fields' => 'product_id',
            'start_at' => 1
        )
	);

    function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
        $this->validate = array(
            'product_id' => array(
                'rule' => 'notEmpty',
                'message' => __('Please select at least 1 product', true)
            ),
            'service_id' => array(
                'empty' => array(
                    'rule' => 'notEmpty',
                    'message' => __('Please select at least 1 service', true)
                ),
                'exist' => array(
                    'rule' => array('exists'),
                    'message' => __('Product service is exist, please select another service type', true)
                )
            )
        );
    }

    /**
     * Validate record being inserted based on existing row.
     *
     * This method checks for existing row which has product_id and rating_id.
     * @return boolean
     */
    function exists() {
        if (!isset($this->data[$this->alias][$this->primaryKey]) ||
            empty($this->data[$this->alias][$this->primaryKey]))
        {
            $product_service = $this->find('first', array(
                'conditions' => array(
                    'product_id' => $this->data[$this->alias]['product_id'],
                    'service_id' => $this->data[$this->alias]['service_id']
                ),
                'fields' => array('id')
            ));
            if ($product_service) return false;
        }
        return true;
    }

	function availableService($product_id) {
        $current_services = $this->find('all', array(
            'conditions' => compact('product_id'),
            'fields' => array('service_id')
        ));
        $current_services = Set::extract('{n}.ProductService.service_id', $current_services);

        if ($current_services) {
            $services = $this->Service->find('list', array(
                'conditions' => array(
                    'NOT' => array('id' => $current_services)
                )
            ));
        } else {
            $services = $this->Service->find('list');
        }
        return $services;
    }

    function move_up($id) {
        $fields = array('id', 'product_id', 'indexed_at');
        $current_row = $this->read($fields, $id);

        if ($current_row) {
            $higher_index = $current_row[$this->alias]['indexed_at'] + 1;
            $conditions = array('indexed_at' => $higher_index);
            if (!empty($current_row[$this->alias]['product_id'])) {
                $conditions['product_id'] = $current_row[$this->alias]['product_id'];
            }

            $next_row = $this->find('first', compact('conditions', 'fields'));
            if ($next_row) {
                // swap the indexed_at
                $next_row[$this->alias]['indexed_at'] = $current_row[$this->alias]['indexed_at'];
                $current_row[$this->alias]['indexed_at'] = $higher_index;

                // update current_row
                $this->id = $current_row[$this->alias]['id'];
                if ($this->saveField('indexed_at', $current_row[$this->alias]['indexed_at'])) {
                    // update next_row
                    $this->id = $next_row[$this->alias]['id'];
                    return $this->saveField('indexed_at', $next_row[$this->alias]['indexed_at']);
                }
            }
        }
        return false;
    }

    function move_down($id) {
        $fields = array('id', 'product_id', 'indexed_at');
        $current_row = $this->read($fields, $id);

        if ($current_row) {
            $lower_index = $current_row[$this->alias]['indexed_at'] - 1;
            $conditions = array('indexed_at' => $lower_index);
            if (!empty($current_row[$this->alias]['product_id'])) {
                $conditions['product_id'] = $current_row[$this->alias]['product_id'];
            }

            $prev_row = $this->find('first', compact('conditions', 'fields'));
            if ($prev_row) {
                // swap the indexed_at
                $prev_row[$this->alias]['indexed_at'] = $current_row[$this->alias]['indexed_at'];
                $current_row[$this->alias]['indexed_at'] = $lower_index;

                // update current_row
                $this->id = $current_row[$this->alias]['id'];
                if ($this->saveField('indexed_at', $current_row[$this->alias]['indexed_at'])) {
                    // update next_row
                    $this->id = $prev_row[$this->alias]['id'];
                    return $this->saveField('indexed_at', $prev_row[$this->alias]['indexed_at']);
                }
            }
        }
        return false;
    }
}
