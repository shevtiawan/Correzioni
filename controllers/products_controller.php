<?php
class ProductsController extends AppController {

    var $name = 'Products';

    var $layout = 'admin';

    public $components = array('Search.Prg');

    public $presetVars = array(
        array('field' => 'title', 'type' => 'value'),
        array('field' => 'category', 'type' => 'value')
    );

    function admin_index() {
        $this->Prg->commonProcess();
        $conditions = array('Product.parent_id' => null);
        if (isset($this->params['named']['title']) || isset($this->params['named']['category'])) {
            $conditions = array_merge(
                $conditions,
                $this->Product->parseCriteria($this->passedArgs)
            );
        }
        $this->paginate = array(
            'conditions' => $conditions,
            'fields' => array('title', 'id', 'description'),
            'contain' => array(
                'Category' => array(
                    'fields' => array('title', 'id')
                )
            ),
            'order' => array('Product.indexed_at' => 'DESC', 'Product.lft' => 'ASC')
        );

        $this->set('products', $this->paginate());
    }

    function admin_tabs($parent_id = null) {
        $this->Prg->commonProcess();
        $conditions = array('Product.parent_id' => $parent_id);

        if (isset($this->params['named']['title']) || isset($this->params['named']['category'])) {
            // short circuit to have persistent route
            // redirect to actual url which parent_id is passed as a params
            if (!isset($this->params['parent_id'])) {
                $this->redirect(array(
                    'controller' => 'products',
                    'action' => 'tabs',
                    'admin' => true,
                    'parent_id' => $parent_id,
                    'title' => $this->params['named']['title'],
                    'category' => $this->params['named']['category']
                ));
            }

            $conditions = array_merge(
                $conditions,
                $this->Product->parseCriteria($this->passedArgs)
            );
        }

        $this->paginate = array(
            'order' => array('Product.indexed_at' => 'DESC', 'Product.lft' => 'ASC'),
            'conditions' => $conditions,
            'contain' => array('Category.title')
        );
        $this->set('products', $this->paginate());

        $product_info = $this->Product->ProductInfo->find('first', array(
            'conditions' => array('product_id' => $parent_id),
            'fields' => array("ProductInfo.id")
        ));
        if ($product_info) {
            $this->data['ProductInfo'] = $product_info['ProductInfo'];
        }
        $parent = $this->Product->find('first', array(
            'conditions' => array('id' => $parent_id)
        ));

        $this->set('product', $parent);
        $this->set('slug', $parent['Product']['slug']);
        $this->set("product_id", $parent_id);
        $this->set("parent_id", $parent_id);

        $paths = $this->Product->getPath($parent_id, array('id', 'parent_id', 'title'), -1);

        $isDetail = $isOffice = $isGallery = $isRatings = $isServices = '';
        $isTabs = "active";
        $this->set(compact(
            'isDetail','isOffice','isGallery','isTabs','isRatings','isServices',
            'paths'
        ));
    }

    public function admin_add($parent_id = null) {
        if (!empty($this->data)) {
            $this->Product->create();
            if ($this->Product->save($this->data)) {
                $redirection = array('action' => 'index');
                if (!empty($this->data['Product']['parent_id'])) {
                    $redirection = array(
                        'action' => 'tabs',
                        'parent_id' => $this->data['Product']['parent_id']
                    );
                }
                $this->Session->setFlash(__('The product has been saved', true));
                $this->redirect($redirection);
            } else {
                $this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
            }
        }
        $this->set(array(
            'parents' => $this->Product->generatetreelist(null, null, null, ' - '),
            'categories' => $this->Product->Category->generatetreelist(
                array('is_published' => true), null, null, ' - '
            ),
            'paths' => $this->Product->getPath($parent_id, array('id', 'parent_id', 'title'), -1)
        ));
        if ($parent_id) $this->set('parent_id', $parent_id);
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid product', true));
            $this->redirect(array('action' => 'index'));
        }

        if (!empty($this->data)) {
            if ($this->Product->save($this->data)) {
                $redirection = array('action' => 'index');
                if (!empty($this->data['Product']['parent_id'])) {
                    $redirection = array(
                        'action' => 'tabs',
                        'parent_id' => $this->data['Product']['parent_id']
                    );
                }
                $this->Session->setFlash(__('The product has been saved', true));
                $this->redirect($redirection);
            } else {
                $this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
            }
        }

        if (empty($this->data)) {
            $this->data = $this->Product->find('first', array(
                'conditions' => compact('id'),
                'contain' => array('Category')
            ));
            if (!empty($this->data['Product']['id'])) {
                $this->set(array(
                    "parent_id", $this->data['Product']['parent_id']
                ));
            }
        }
        $this->set("product_id", $id);
        $this->set(array(
            'parents' => $this->Product->generatetreelist(null, null, null, ' - '),
            'categories' => $this->Product->Category->generatetreelist(
                array('is_published' => true), null, null, ' - '
            ),
            'paths' => $this->Product->getPath($id, array('id', 'parent_id', 'title'), -1)
        ));

        $isDetail = "active";
        $isOffice = $isGallery = $isTabs = $isRatings = $isServices = "";
        $this->set(compact('isDetail','isOffice','isGallery','isTabs','isRatings','isServices'));
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for product', true));
            $this->redirect(array('action'=>'index'));
        }
        if (!empty($this->data)) {
            $redirection = array('action' => 'index');
            if (!empty($this->data['Product']['parent_id'])) {
                $redirection = array(
                    'action' => 'tabs',
                    'parent_id' => $this->data['Product']['parent_id']
                );
            }
            if ($this->Product->delete($id)) {
                $this->Session->setFlash(__('Product deleted', true));
                $this->redirect($redirection);
            }
            $this->Session->setFlash(__('Product was not deleted', true));
            $this->redirect($redirection);
        } else {
            $this->data = $this->Product->read(array('id', 'title', 'parent_id'), $id);
            $this->set(array(
                'paths' => $this->Product->getPath($id, array('id', 'parent_id', 'title'), -1),
                'parent_id' => $id
            ));
        }

        if (empty($this->data['Product'])) {
            $this->Session->setFlash(__('Invalid id for product', true));
            $this->redirect(array('action'=>'index'));
        }
    }

    function admin_move_up($id = null) {
        $redirection = array(
            'controller' => 'products', 'action' => 'index', 'admin' => true
        );
        if (!$id) {
	        $this->Session->setFlash(sprintf(__('Invalid product', true)));
            $this->redirect($redirection);
        }

        $parent_id = $this->Product->field('parent_id', compact('id'));
        if ($parent_id) {
            $redirection = array(
                'controller' => 'products',
                'action' => 'tabs',
                'admin' => true,
                'parent_id' => $parent_id
            );
        }

        if ($this->Product->move_up($id)) {
	        $this->Session->setFlash(sprintf(__('The %s has been saved', true), 'product'));
        } else {
			$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'product'));
		}
		$this->redirect($redirection);
    }

    function admin_move_down($id = null) {
        $redirection = array(
            'controller' => 'products', 'action' => 'index', 'admin' => true
        );
        if (!$id) {
	        $this->Session->setFlash(sprintf(__('Invalid product', true)));
            $this->redirect($redirection);
        }

        $parent_id = $this->Product->field('parent_id', compact('id'));
        if ($parent_id) {
            $redirection = array(
                'controller' => 'products',
                'action' => 'tabs',
                'admin' => true,
                'parent_id' => $parent_id
            );
        }

        if ($this->Product->move_down($id)) {
	        $this->Session->setFlash(sprintf(__('The %s has been saved', true), 'product'));
        } else {
			$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'product'));
		}
		$this->redirect($redirection);
    }

    function view($slug) {
        $this->layout = 'frontend';
        $this->helpers[] = 'GoogleMap';
        $this->helpers[] = 'Info';
        $this->helpers[] = 'Text';

        $product = $this->Product->find('first', array(
            'conditions' => array('slug' => $slug, 'is_published' => true),
            'contain' => array(
                'ProductRating' => array(
                    'Rating' => array('fields' => array('title', 'icon_path', 'icon_dir')),
                    'fields' => array('total_user', 'point', 'id', 'average')
                ),
                'ProductService' => array(
                    'Service' => array('fields' => array('title', 'icon','icon_dir')),
                    'fields' => array('id')
                ),
                'ProductInfo',
                'ProductGallery' => array(
                    'fields' => array('caption', 'image', 'image_dir'),
                    //'conditions' => array('NOT' => array('is_featured' => true))
                )
            ),
            'fields' => array('title', 'description', 'slug', 'id')
        ));
        if ($product) {
            $mainImage = $this->Product->ProductGallery->mainImage($product['Product']['id']);
            $productTabs = $this->Product->find('all', array(
                'conditions' => array(
                    'parent_id' => $product['Product']['id'],
                    'is_published' => true
                ),
                'fields' => array('title', 'slug', 'description'),
                'order' => 'indexed_at ASC',
                'limit' => 8
            ));
            $this->set(compact('mainImage', 'productTabs'));
        } else {
            $this->Session->setFlash(__('Product not found', true));
            $this->redirect(array(
                'controller' => 'pages',
                'action' => 'home'
            ));
        }
        $this->set(compact('product'));
    }

    public function feed() {
        if ($this->RequestHandler->isRss()) {
            $this->helpers[] = 'Rss';
            $this->layout = 'default';
            Configure::write('debug', 0);

            // IDs of products under published category
            $product_ids = Set::extract(
                '/ProductsCategory/product_id',
                $this->Product->ProductsCategory->find('all', array(
                    'conditions' => array('Category.is_published' => true),
                    'contain' => array('Category.is_published'),
                    'fields' => array('product_id')
                ))
            );

            $products = $this->Product->find('all', array(
                'conditions' => array(
                    'is_published' => true,
                    'parent_id' => null,
                    'id' => array_unique($product_ids)
                ),
                'fields' => array('title', 'slug', 'description', 'created'),
                'limit' => 20,
                'order' => 'created DESC'
            ));
            $this->set(compact('products'));
            $this->set('title_for_layout', 'Latest Products');
        }
    }
}
