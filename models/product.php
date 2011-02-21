<?php
class Product extends AppModel {
    var $name = 'Product';

    var $actsAs = array(
        'Sequence.Sequence' => array(
            'order_field' => 'indexed_at',
            'group_fields' => 'parent_id',
            'start_at' => 1
        ),
        'Sluggable' => array(
            'separator' => '-',
            'update' => true
        ),
        'Search.Searchable',
        'Tree'
    );

    var $belongsTo = array(
        'ParentProduct' => array(
            'className' => 'Product',
            'foreignKey' => 'parent_id'
        )
    );

    var $hasOne = array(
        'ProductInfo' => array(
            'className' => 'ProductInfo',
            'foreignKey' => 'product_id',
            'dependent' => true
        )
    );

    var $hasMany = array(
        'ChildProduct' => array(
            'className' => 'Product',
            'foreignKey' => 'parent_id',
            'dependent' => false
        ),
        'ProductGallery' => array(
            'className' => 'ProductGallery',
            'foreignKey' => 'product_id'
        ),
        'ProductService' => array(
            'className' => 'ProductService',
            'foreignKey' => 'product_id',
            'dependent' => true
        ),
        'ProductRating' => array(
          'className' => 'ProductRating',
          'foreignKey' => 'product_id',
          'dependent' => true
        ),
        'ProductsCategory' => array(
          'className' => 'ProductsCategory',
          'foreignKey' => 'product_id',
          'dependent' => true
        )
    );

    var $hasAndBelongsToMany = array(
        'Category' => array(
            'className' => 'Category',
            'joinTable' => 'products_categories',
            'foreignKey' => 'product_id',
            'associationForeignKey' => 'category_id',
            'unique' => true
        )
    );

    // search params
    public $filterArgs = array(
        array('name' => 'title', 'type' => 'query', 'method' => 'searchPublished'),
        array('name' => 'category', 'type' => 'query', 'method' => 'searchInCategory', 'field' => 'Product.id')
#        array('name' => 'category', 'type' => 'like', 'field' => 'Category.title')
    );

    function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
        $this->validate = array(
            'title' => array(
                'rule' => 'notEmpty',
                'message' => __('Title cannot be left blank', true)
            )
        );
    }

    public function beforeSave(){
        if (empty($this->data[$this->alias]['parent_id'])) {
            unset($this->data[$this->alias]['parent_id']);
            // adding
            if (empty($this->data[$this->alias][$this->primaryKey])) {
                $last = $this->find('first', array(
                    'fields' => array('MAX(indexed_at) AS max_index')
                ));
                if (!empty($last[0]['max_index'])) {
                    $this->data[$this->alias]['indexed_at'] = $last[0]['max_index'] + 1;
                }
            }
        }
        return true;
    }

    public function latest() {
	    // IDs of products under published category
	    $product_ids = Set::extract(
            '/ProductsCategory/product_id',
            $this->ProductsCategory->find('all', array(
                'conditions' => array('Category.is_published' => true),
                'contain' => array('Category.is_published'),
                'fields' => array('product_id')
            ))
        );
        $products = $this->find('all', array(
            'contain' => array(
                'ProductInfo',
                'ProductRating' => array(
                    'Rating' => array('fields' => array('title', 'icon_path')),
                    'fields' => array('total_user', 'point', 'id', 'average', 'product_id', 'rating_id')
                ),
                'ProductService' => array(
                    'Service' => array('fields' => array('title', 'icon','icon_dir')),
                    'fields' => array('id')
                )
            ),
            'conditions' => array(
                'Product.id' => array_unique($product_ids),
                'Product.is_published' => true,
                'Product.parent_id' => null
            ),
            'fields' => array(
                'Product.title', 'Product.slug'
            ),
            'limit' => 3,
            'order' => 'Product.created DESC',
        ));
        return $products;
    }

    public function lists($category_id) {
        // IDs of products under specific category
        $product_ids = Set::extract(
            '/ProductsCategory/product_id',
            $this->ProductsCategory->find('all', array(
                'conditions' => compact('category_id')
            ))
        );
        $products = $this->find('all', array(
            'contain' => array(
                'ProductInfo',
                'ProductRating' => array(
                    'Rating' => array('fields' => array('title', 'icon_path')),
                    'fields' => array('total_user', 'point', 'id', 'average', 'product_id', 'rating_id')
                ),
                'ProductService' => array(
                    'Service' => array('fields' => array('title', 'icon','icon_dir')),
                    'fields' => array('id')
                )
            ),
            'conditions' => array(
                'Product.id' => $product_ids,
                'Product.is_published' => true
            ),
            'fields' => array(
                'Product.title', 'Product.slug', 'Product.description'
            ),
            'order' => 'Product.created DESC',
        ));
        return $products;
    }

    // deprecated
    function getBrief(){
       return $this->find('all', array(
            'contain' => array(
                'ProductRating' => array(
                    'Rating' => array('fields' => array('title', 'icon_path')),
                    'fields' => array('total_user', 'point')
                ),
                'ProductService' => array(
                    'Service' => array('fields' => array('title', 'icon','icon_dir')),
                    'fields' => array('id')
                ),
                'ProductInfo' => array(
                    'fields' => array('city', 'state', 'country')
                )
            ),
            'conditions' => array(
              'Product.parent_id' => null,
              'Product.is_published' => true
            ),
            'fields' => array(
                'Product.title', 'Product.slug'
            ),
            'limit' => 3,
            'order' => 'Product.created DESC',
        ));
    }

    function move_up($id) {
        $fields = array('id', 'parent_id', 'indexed_at');
        $current_row = $this->read($fields, $id);

        if ($current_row) {
            $higher_index = $current_row[$this->alias]['indexed_at'] + 1;
            $conditions = array('indexed_at' => $higher_index);
            if (!empty($current_row[$this->alias]['parent_id'])) {
                $conditions['parent_id'] = $current_row[$this->alias]['parent_id'];
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
        $fields = array('id', 'parent_id', 'indexed_at');
        $current_row = $this->read($fields, $id);

        if ($current_row) {
            $lower_index = $current_row[$this->alias]['indexed_at'] - 1;
            $conditions = array('indexed_at' => $lower_index);
            if (!empty($current_row[$this->alias]['parent_id'])) {
                $conditions['parent_id'] = $current_row[$this->alias]['parent_id'];
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

    public function searchPublished($data) {
        return array(
            $this->alias . '.title LIKE' => "%{$data['title']}%",
            $this->alias . '.is_published' => true
        );
    }

    public function searchInCategory($data) {
        // which categories do are looking for?
        $category_ids = Set::extract(
            '/Category/id',
            $this->Category->find('all', array(
                'conditions' => array('title LIKE' => "%{$data['category']}%"),
                'fields' => array('id')
            ))
        );
        // get products under this categories
        $product_ids = Set::extract(
            '/ProductsCategory/product_id',
            $this->ProductsCategory->find('all', array(
                'conditions' => array('category_id' => $category_ids),
                'fields' => array('product_id')
            ))
        );
        return array(
            $this->alias . '.id' => $product_ids
        );
    }
}
