<ul class="section_menu">
	<li>
	    <?php
	    echo $this->Html->link(
	        "<span><span>Detail</span></span>",
	        array('controller'=>'products', 'action' => "edit", $product_id),
	        array('class' => $isDetail, 'escape' => false)
        ); ?>
    </li>
    <li>
        <?php
        echo $this->Html->link(
	        "<span><span>Office</span></span>",
	        array(
	            'controller' => 'product_infos',
	            'action' => 'office',
	            'product_id' => $product_id,
	            'admin' => true
            ),
	        array('class' => $isOffice, 'escape' => false)
        ); ?>
    </li>
	<li>
	    <?php
	    echo $this->Html->link(
	        "<span><span>Galleries</span></span>",
	        array(
	            'controller' => 'product_galleries',
	            'action' => "index",
	            'product_id' => $product_id
            ),
	        array('class' => $isGallery, 'escape' => false)
        ); ?>
    </li>
	<li>
	    <?php
	    echo $this->Html->link(
	        "<span><span>Tabs</span></span>",
	        array('controller'=>'products', 'action' => "tabs", 'parent_id' => $product_id),
	        array('class' => $isTabs, 'escape' => false)
        ); ?>
    </li>
	<li>
	    <?php
	    echo $this->Html->link(
	        "<span><span>Ratings</span></span>",
	        array(
	            'controller' => 'product_ratings',
	            'action' => 'index',
	            'product_id' => $product_id,
	            'admin' => true
            ),
	        array('class' => $isRatings, 'escape' => false)
        ); ?>
    </li>
    <li>
        <?php
	    echo $this->Html->link(
	        "<span><span>Services</span></span>",
	        array(
	            'controller' => 'product_services',
	            'action' => 'index',
	            'product_id' => $product_id,
	            'admin' => true
            ),
	        array('class' => $isServices, 'escape' => false)
        ); ?>
    </li>
</ul>
