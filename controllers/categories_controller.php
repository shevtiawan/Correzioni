<?php
class CategoriesController extends AppController {

    var $name = 'Categories';

    var $layout = 'admin';

    public function admin_index() {
        $this->paginate = array(
            'order' => array('Category.indexed_at' => 'DESC', 'Category.lft' => 'ASC'),
            'conditions' => array('Category.parent_id' => null),
        );
        $this->set('categories', $this->paginate());
    }

    function admin_subs($parent_id = null) {
        $this->paginate = array(
            'order' => array('Category.indexed_at' => 'DESC', 'Category.lft' => 'ASC'),
            'conditions' => array('Category.parent_id' => $parent_id),
        );
        $this->set(array(
            'categories' => $this->paginate(),
            'paths' => $this->Category->getPath($parent_id, array('id', 'parent_id', 'title'), -1)
        ));
        if ($parent_id) $this->set('parent_id', $parent_id);
    }

    public function admin_list_ajax($parent_id = null){
        $this->layout = 'ajax';
        $conditions = array('Category.parent_id' => $parent_id);
        $categories = $this->Category->find('all', array('fields' => array("Category.id, Category.title"), 'conditions' => $conditions));
        $this->set('categories', $categories);
    }

    public function admin_add($parent_id = null) {
        if (!empty($this->data)) {
            $this->Category->create();
            if ($this->Category->save($this->data)) {
                $redirection = array('action' => 'index');
                if (!empty($this->data['Category']['parent_id'])) {
                    $redirection = array(
                        'action' => 'subs',
                        'parent_id' => $this->data['Category']['parent_id']
                    );
                }
                $this->Session->setFlash(__('The category has been saved', true));
                $this->redirect($redirection);
            } else {
                $this->Session->setFlash(__('The category could not be saved. Please, try again.', true));
            }
        }
        $this->set('parents', $this->Category->generatetreelist(null, null, null, ' - '));
        if ($parent_id) $this->set('parent_id', $parent_id);
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid category', true));
            $this->redirect(array('action' => 'index'));
        }

        if (!empty($this->data)) {
            if ($this->Category->save($this->data)) {
                $redirection = array('action' => 'index');
                if (!empty($this->data['Category']['parent_id'])) {
                    $redirection = array(
                        'action' => 'subs',
                        'parent_id' => $this->data['Category']['parent_id']
                    );
                }
                $this->Session->setFlash(__('The category has been saved', true));
                $this->redirect($redirection);
            } else {
                $this->Session->setFlash(__('The category could not be saved. Please, try again.', true));
            }
        }

        if (empty($this->data)) {
            $this->data = $this->Category->find('first', array(
                'conditions' => compact('id')
            ));
            if (!empty($this->data['Category']['id'])) {
                $this->set("parent_id", $this->data['Category']['parent_id']);
            }
        }
        $this->set('parents', $this->Category->generatetreelist(null, null, null, ' - '));
    }

    function admin_move_up($id = null) {
        $redirection = array(
            'controller' => 'categories', 'action' => 'index', 'admin' => true
        );
        if (!$id) {
	        $this->Session->setFlash(sprintf(__('Invalid category', true)));
            $this->redirect($redirection);
        }

        $parent_id = $this->Category->field('parent_id', compact('id'));
        if ($parent_id) {
            $redirection = array(
                'controller' => 'categories',
                'action' => 'subs',
                'admin' => true,
                'parent_id' => $parent_id
            );
        }

        if ($this->Category->move_up($id)) {
	        $this->Session->setFlash(sprintf(__('The %s has been saved', true), 'category'));
        } else {
			$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'category'));
		}
		$this->redirect($redirection);
    }

    function admin_move_down($id = null) {
        $redirection = array(
            'controller' => 'categories', 'action' => 'index', 'admin' => true
        );
        if (!$id) {
	        $this->Session->setFlash(sprintf(__('Invalid category', true)));
            $this->redirect($redirection);
        }

        $parent_id = $this->Category->field('parent_id', compact('id'));
        if ($parent_id) {
            $redirection = array(
                'controller' => 'categories',
                'action' => 'subs',
                'admin' => true,
                'parent_id' => $parent_id
            );
        }

        if ($this->Category->move_down($id)) {
	        $this->Session->setFlash(sprintf(__('The %s has been saved', true), 'category'));
        } else {
			$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'category'));
		}
		$this->redirect($redirection);
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for category', true));
            $this->redirect(array('action'=>'index'));
        }
        if (!empty($this->data)) {
            $redirection = array('action' => 'index');
            if (!empty($this->data['Category']['parent_id'])) {
                $redirection = array(
                    'action' => 'subs',
                    'parent_id' => $this->data['Category']['parent_id']
                );
            }
            if ($this->Category->delete($id)) {
                $this->Session->setFlash(__('Category deleted', true));
                $this->redirect($redirection);
            }
            $this->Session->setFlash(__('Category was not deleted', true));
            $this->redirect($redirection);
        } else {
            $this->data = $this->Category->read(array('id', 'title', 'parent_id'), $id);
        }
        if (empty($this->data['Category'])) {
            $this->Session->setFlash(__('Invalid id for category', true));
            $this->redirect(array('action'=>'index'));
        }
    }

    public function submenus($slug = null) {
        $parent = $this->Category->find('first', array(
            'conditions' => array('slug' => $slug, 'is_published' => true),
            'fields' => array('id', 'slug', 'color')
        ));
        $menus = $this->Category->find('all', array(
            'conditions' => array(
                'parent_id' => $parent['Category']['id'],
                'is_published' => true
            ),
            'fields' => array('slug', 'title'),
            'order' => 'indexed_at ASC'
        ));
        if ($menus) {
            foreach ($menus as $key => $nav) {
                $menus[$key]['Category']['color'] = $parent['Category']['color'];
            }
        }
        $this->set(compact('menus', 'parent'));
        $this->layout = $this->RequestHandler->isAjax() ? 'ajax' : 'frontend';
    }

    function lists($parent_slug = null, $slug = null) {
        $this->layout = 'ajax';
        $this->helpers[] = 'Info';

        if (empty($this->params['named']['limit'])) $this->params['named']['limit'] = 3;

        $products = $menus = array();
        $parent = $breadCrumbs = null;

        $paths = $this->Category->getpath(
            $this->Category->field('id', array('slug' => $slug)),
            array('id', 'title', 'slug', 'description', 'parent_id', 'is_published')
        );

        if ($paths) {
            // copy the original paths for displaying breadcrumbs
            $breadCrumbs = $paths;
            // parent is the last path
            $parent = array_pop($paths);
            
            // submenus
            //is parent has subcategories ?
            $menus = $this->Category->children(
                $parent['Category']['id'],
                true,
                array('id', 'title', 'slug', 'description', 'is_published'),
                'indexed_at ASC'
            );

            // group menus by published status
            $menus = Set::combine($menus, '{n}.Category.id', '{n}', '{n}.Category.is_published');
            // extract published submenus which having key 1
            if (isset($menus[1])) {
                $menus = Set::extract('1.{n}', $menus);
            }

            //if (count($menus) < 1) {
                $product_ids = Set::extract(
                    '/ProductsCategory/product_id',
                    $this->Category->ProductsCategory->find('all', array(
                        'conditions' => array('category_id' => $parent['Category']['id'])
                    ))
                );
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
                        )
                    ),
                    'conditions' => array(
                        'Product.id' => $product_ids,
                        'Product.is_published' => true,
                        'Product.parent_id' => null
                    ),
                    'fields' => array(
                        'Product.title', 'Product.slug', 'Product.description'
                    ),
                    'limit' => $this->params['named']['limit'],
                    'order' => 'Product.created DESC',
                );
                $products = $this->paginate('Product');
            //}
        }
        $this->set(compact('menus', 'parent', 'products', 'breadCrumbs'));
    }

    // deprecated
    protected function crop_image() {
        if ($this->data['Category']['x1'] != "") {
            $this->data['Category']['width'] = $this->data['Category']['w'];
            $this->data['Category']['height'] = $this->data['Category']['h'];

            if ($this->Category->save($this->data)) {
                if ($this->data['Category']['x1'] != "") {
                    $this->JqImgcrop->cropImage(50, $this->data['Category']['x1'],
                                                    $this->data['Category']['y1'],
                                                    $this->data['Category']['x2'],
                                                    $this->data['Category']['y2'],
                                                    $this->data['Category']['w'],
                                                    $this->data['Category']['h'],
                                                    $this->data['Category']['icon_path'],
                                                    $this->data['Category']['icon_path']);
                    $width = $this->data['Category']['width'];
                    $height = $this->data['Category']['height'];
                    $uploaded = array(
                        'imagePath' => $this->data['Category']['icon_path'],
                        'imageWidth' => $width, 'imageHeight' => $height
                    );
                    $this->set(compact('uploaded'));
                }
            }
        }
    }
}
