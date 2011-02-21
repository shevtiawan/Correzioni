<?php
class ProductRating extends AppModel {

    public $name = 'ProductRating';

    public $belongsTo = array('Product', 'Rating');

    public $hasMany = array(
        'Vote' => array(
            'className' => 'Vote',
            'foreignKey' => 'product_rating_id',
            'dependent' => true
        )
    );

    public $actsAs = array(
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
            'rating_id' => array(
                'empty' => array(
                    'rule' => 'notEmpty',
                    'message' => __('Please select at least 1 rating', true)
                ),
                'exist' => array(
                    'rule' => array('exists'),
                    'message' => __('Product rating is exist, please select another rating type', true)
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
            $product_rating = $this->find('first', array(
                'conditions' => array(
                    'product_id' => $this->data[$this->alias]['product_id'],
                    'rating_id' => $this->data[$this->alias]['rating_id']
                ),
                'fields' => array('id')
            ));
            if ($product_rating) return false;
        }
        return true;
    }

    /**
     * Get available ratings for current ProductRating
     *
     * @param string|integer $product_id ID of Product
     * @return array Available ratings
     */
    public function availableRating($product_id) {
        $current_ratings = $this->find('all', array(
            'conditions' => compact('product_id'),
            'fields' => array('rating_id')
        ));
        $current_ratings = Set::extract('{n}.ProductRating.rating_id', $current_ratings);

        if ($current_ratings) {
            $ratings = $this->Rating->find('list', array(
                'conditions' => array(
                    'is_published' => true,
                    'NOT' => array('id' => $current_ratings)
                )
            ));
        } else {
            $ratings = $this->Rating->find('list', array(
                'conditions' => array('is_published' => true)
            ));
        }
        return $ratings;
    }

    /**
     * Set average rating
     *
     * @param string|integer $id ID of ProductRating
     * @param integer $rate Value of voted item
     * @return boolean
     */
    function vote($id = null, $rate = null) {
        $P_Rating = $this->find('first', array(
            'conditions' => compact('id'),
            'fields' => array('total_user', 'point', 'average', 'product_id', 'rating_id')
        ));
        if ($P_Rating) {
            # (n / (n + C)) * j + (C / (n + C)) * m
            # C is the average number of ratings an item receives => $rate
            # n is the number of ratings the current item => $P_Rating[$this->alias]['point']
            # j is the average rating for the current => $P_Rating[$this->alias]['average']
            # m ??
            // average rating will be stored in ProductRating.average
            // somehow this bayesian missing "m" variable
            $P_Rating[$this->alias]['new_point'] = $P_Rating[$this->alias]['point'] + $rate;
            $avg = ($P_Rating[$this->alias]['point'] / $P_Rating[$this->alias]['new_point'])
                 * $P_Rating[$this->alias]['average']
                 + ($rate / $P_Rating[$this->alias]['new_point']);

            return $this->updateAll(
                array(
                    'ProductRating.average' => round($avg),
                    'ProductRating.point' => $P_Rating[$this->alias]['new_point'],
                    'ProductRating.total_user' => $P_Rating[$this->alias]['total_user'] + 1,
                ),
                array('ProductRating.id' => $id)
            );
        }
        return false;
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
