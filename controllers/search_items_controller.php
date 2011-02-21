<?php

class SearchItemsController extends AppController {

    public $name = 'SearchItems';

    public $uses = array('Product');

    public $components = array('Search.Prg');

    public $helpers = array('Text');

    public $presetVars = array(
        array('field' => 'title', 'type' => 'value'),
        array('field' => 'category', 'type' => 'value')
    );

    public function index() {
        $this->layout = 'frontend';
        $this->Prg->commonProcess();
        if (empty($this->params['named']['limit'])) $this->params['named']['limit'] = 3;
        /*$this->paginate = array(
            'conditions' => $this->Product->parseCriteria($this->passedArgs),
            'fields' => array('title', 'slug', 'description'),
            'contain' => array(
                'Category' => array(
                    'fields' => array('title', 'slug')
                )
            )
        );*/
        
        $this->paginate = array(
                    'contain' => array(
                        'ProductInfo',
                        'ProductRating' => array(
                            'Rating' => array('fields' => array('title', 'icon_path')),
                            'fields' => array('total_user', 'point', 'id', 'average', 'product_id', 'rating_id')
                        ),
                        'ProductService' => array(
                            'Service' => array('fields' => array('title', 'icon','icon_dir')),
                            'fields' => array('id')
                        ),
                        'Category' => array(
                            'fields' => array('title', 'slug')
                        )
                    ),
                    'conditions' => $this->Product->parseCriteria($this->passedArgs),
                    'fields' => array(
                        'Product.title', 'Product.slug', 'Product.description'
                    ),
                    'limit' => $this->params['named']['limit'],
                    'order' => 'Product.created DESC',
                );

        $items = array();
        if (!empty($this->data) &&
            (!empty($this->params['named']['title']) || !empty($this->params['named']['category'])))
        {
            $items = $this->paginate('Product');
        }

        $title_for_layout = 'Search';
        $this->set(compact('items', 'title_for_layout'));
    }
}
