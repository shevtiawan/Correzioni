<?php foreach ($latest as $prod): ?>
    <div class="bannerFeatureShow">
        <div class="left">
            <h4>
                <?php
                echo $this->Html->link(
                    $prod['Product']['title'],
                    array('controller' => 'products', 'action' => 'view', $prod['Product']['slug']),
                    array('class' => 'inside')
                );
                ?>
            </h4>
            <?php
            if (!empty($prod['ProductInfo'])) {
                echo $this->Info->getLocation(
                    $prod['ProductInfo']['city'],
                    $prod['ProductInfo']['state'],
                    $prod['ProductInfo']['country']
                );
            }
            ?>
            <br />
            <?php if (isset($prod['ProductRating'])): ?>
                <?php foreach ($prod['ProductRating'] as $pr): ?>
                    <span class="label"><?php echo $pr['Rating']['title']; ?> : </span>
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
                    <!--
                    <span class="rating" style="background: url(img/icon-rating-off.png)">
                        <span class="score" style="width: 50%; background: url(img/icon-rating-on.png)">&nbsp;</span>
                    </span>
                    -->
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <?php
        if (!empty($prod['ProductInfo']['thumbnail_path'])) {
            echo $this->Html->link(
                $this->Html->image($prod['ProductInfo']['medium_path'], array('width' => 87, 'height' => 87)),
                array('controller' => 'products', 'action' => 'view', $prod['Product']['slug']),
                array('escape' => false, 'class' => 'img')
            );
        }
        ?>
        <div class="clear">&nbsp;</div>
        <span class="label">Offered services : </span>
        <div class="icons">
            <?php if (isset($prod['ProductService'])): ?>
                <?php foreach ($prod['ProductService'] as $ps): ?>
                    <div class="icon">
                        <?php
                        echo $this->Html->image(
                            '/img/services/'.$ps['Service']['icon_dir']."/".$ps['Service']['icon'],
                            array('title' => $ps['Service']['title'], 'width' => 33, 'height' => 33)
                        );
                        ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>
<div class="clear">&nbsp;</div>
