<?php
class ProductsCategory extends AppModel {

	public $name = 'ProductsCategory';

	public $belongsTo = array('Product', 'Category');
}
