<div id="contentDetail">
    <div id="productDetail">
        <div id="sidebar">
            <div id="logoWrapper">
                <?php
                if (!empty($product['ProductInfo']['thumbnail_path'])) {
                    echo $this->Html->image($product['ProductInfo']['thumbnail_path']);
                }
                ?>
            </div>
            <div class="sidebarWrapper">
                <h4>Address and Contact Info :</h4>
                <div class="content">
                    Address:<br />
                    <?php
                    if (!empty($product['ProductInfo']['address'])) {
                        echo $product['ProductInfo']['address'];
                        echo '<br />';
                    }
                    if (!empty($product['ProductInfo']['city']) ||
                        !empty($product['ProductInfo']['state']) ||
                        !empty($product['ProductInfo']['country']))
                    {
                        echo $this->Info->getLocation(
                            $product['ProductInfo']['city'],
                            $product['ProductInfo']['state'],
                            $product['ProductInfo']['country']
                        );
                    }

                    ?><br /><br />
                    Email:<br />
                    <?php
                    if (!empty($product['ProductInfo']['email'])) {
                        echo $product['ProductInfo']['email'];
                    }
                    ?>
                    <br /><br />
                    Phone:<br />
                    <?php
                    if (!empty($product['ProductInfo']['phone'])) {
                        echo $product['ProductInfo']['phone'];
                    }
                    ?><br /><br />
                    Fax:<br />
                    <?php
                    if (!empty($product['ProductInfo']['fax'])) {
                        echo $product['ProductInfo']['fax'];
                    }
                    ?><br /><br />
                </div>
            </div>
            <div class="sidebarWrapper">
                <h4>Rating :</h4>
                <div class="content">
                    <?php foreach($product['ProductRating'] as $pr): ?>
                        <?php echo $pr['Rating']['title']; ?>:
                        <?php
                        $disabled = !$this->Session->check('Auth.User');
                        if (!empty($votedList)) {
                            $disabled = in_array($pr['id'], $votedList);
                        }
                        echo $this->StarRating->create(
                            $pr['id'],
                            array('controller' => 'product_ratings', 'action' => 'vote'),
                            $pr['average'],
                            $disabled
                        );
                        ?>
                        <br />
                        <!--
                        Quality: <img src="images/icon_star.png" alt="Quality" width="73" height="13" /><br />
                        Pricing: <img src="images/icon_$.png" alt="Price" width="73" height="13" /><br />
                        Rating: <img src="images/icon_smiley.png" alt="Rating" width="73" height="13" />
                        -->
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="sidebarWrapper">
                <h4>Offered Service :</h4>
                <div class="content">
                    <?php foreach($product['ProductService'] as $service): ?>
                        <?php
                        if (!empty($service['Service']['icon'])) {
                            $imgService = '/img/services/'
                                   . $service['Service']['icon_dir']
                                   . '/'
                                   . $service['Service']['icon'];
                            echo $this->Html->image(
                                $imgService,
                                array('width' => 33, 'height' => 33, 'alt' => $service['Service']['icon'])
                            );
                        }
                        ?>
                    <?php endforeach; ?>
                    <!--
                    <img src="images/icon_ser_ac.gif" alt="AC" width="33" height="33" /><img src="images/icon_ser_bath.gif" alt="Bath" width="33" height="33" /><img src="images/icon_ser_fa.gif" alt="Pans" width="33" height="33" /><img src="images/icon_ser_hd.gif" alt="Hair Dryer" width="33" height="33" /><img src="images/icon_ser_spa.gif" alt="Spa" width="33" height="33" /><img src="images/icon_ser_iron.gif" alt="Iron" width="33" height="33" /><img src="images/icon_ser_ph.gif" alt="Telephone" width="33" height="33" /><img src="images/icon_ser_cd.gif" alt="CD" width="33" height="33" /><img src="images/icon_ser_msg1.gif" alt="Massage" width="33" height="33" /><img src="images/icon_ser_msg2.gif" alt="Massage" width="33" height="33" /><img src="images/icon_ser_steam.gif" alt="Steam Bath" width="33" height="33" />
                    -->
                </div>
            </div>
            <div id="page_details_left_location">
                <div id="top">Location
                    <!--<span class="right"> [Zoom]</span>-->
                </div>
                <div id="mid">
                    <?php
                    if (!(empty($product['ProductInfo']['google_lat']) &&
                        empty($product['ProductInfo']['google_lang'])))
                    {
                        echo $this->GoogleMap->simple(
                            'mid',
                            $product['ProductInfo']['google_lat'],
                            $product['ProductInfo']['google_lang']
                        );
                    }
                    ?>
                </div>
                <div id="bottom"></div>
            </div>
        </div>
        <div id="rightContent">
            <div id="page_details_right_text">
                <h1><?php echo $product['Product']['title']; ?></h1>
                <?php
                echo $this->Html->image(
                        '/img/galleries/' . $mainImage['ProductGallery']['image_dir'] . DS . 'medium_' . $mainImage['ProductGallery']['image'],
                        array('width' => 367, 'height' => 215)
                ); ?>
                <?php echo $product['Product']['description']; ?>
            </div>
            <div id="page_details_right_slide">
                <?php
                if ($product['ProductGallery']) {
                    echo $this->Html->image('/img/arrow_left.png', array('width' => '36', 'height' => 65));
                }
                ?>
                <?php foreach($product['ProductGallery'] as $gallery): ?>
                    <?php
                    echo $this->Html->image(
                        '/img/galleries/' . $gallery['image_dir'] . DS . 'thumbnail_' . $gallery['image'],
                        array('width' => 101, 'height' => 101)
                    ); ?>
                <?php endforeach; ?>
                <?php
                if ($product['ProductGallery']) {
                    echo $this->Html->image('/img/arrow_right.png', array('width' => '36', 'height' => 65));
                }
                ?>
            </div>
            <div id="page_details_right_tab_block">
                <div id="page_details_right_tab_wrapper">&nbsp;</div>
                <div id="page_details_right_tab">
                    <?php if (!empty($productTabs)): ?>
                        <?php foreach ($productTabs as $tab): ?>
                            <?php echo $tab['Product']['title']; ?>
                            <br />
                            <br />
                            <?php
                            $link = $this->Html->link(
                                'read more',
                                array(
                                    'controller' => 'products',
                                    'action' => 'view',
                                    $tab['Product']['slug']
                                )
                            );
                            echo $this->Text->truncate(
                                $tab['Product']['description'],
                                500,
                                array(
                                    'html' => true,
                                    'ending' => " [{$link}] "
                                )
                            );
                            ?>
                            <br />
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="clear">&nbsp;</div>
    </div>
</div>
