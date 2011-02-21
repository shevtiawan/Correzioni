<?php 
if (count($menus) > 0 && count($breadCrumbs) < 3): 
      $bg_arrays = array('#7faac8','#99bbd3','#b2ccde','#ccdde9','#d8e5ee','#e5eef4');
      $counter = 0;
      foreach ($menus as $menu): ?>
        <?php
            $background = $counter < count($bg_arrays) ? $bg_arrays[$counter] : '#e5eef4';
            $counter += 1;
            $icon_path = 'no_photo.gif';
            if (!empty($menu['Category']['thumbnail_path'])) {
                $icon_path = $menu['Category']['thumbnail_path'];
            }
            $href = $this->Html->url(array(
                'controller'=>'categories',
                'action'=>'lists',
                'parent_slug' => $parent['Category']['slug'],
                'slug' => $menu['Category']['slug']
            ));
        ?>
        <div class="category-list" href="<?php echo $href; ?>">
            <ul style="background-color:<?php echo $background; ?>">
                <li class="image"><?php echo $this->Html->image($icon_path, array('width' => 32, 'height' => 25)); ?></li>
                <li class="title"><?php echo $menu['Category']['title']; ?></li>
                <li class="description"><?php echo substr($menu['Category']['description'],0,40); ?></li>
                <li>
                    <?php echo $this->Html->link(
                            $this->Html->image('btn_down_blue.png', array('style'=>"border:0px")),
                            "#",
                            array('class'=>"showChildren",'escape'=>false));
                    ?>
                </li>
            </ul>
            
        </div>
        <div style="display:hidden;"  id="productContainer">
        </div>
    <?php endforeach; ?>

<?php elseif (count($breadCrumbs) > 2): ?>
    <div id="contentDetail" style="display:inline-table;">
        <script type="text/javascript">
            $.ready(function() {
                $('.linkToProductDetail').click(function() {
                    var linkProduct = $(this).attr('href');
                    $.get(linkProduct,function(result) {
                        $('#mainContent').html(result);
                    });
                    return false;
                });
            });
        </script>
        
        <div id="page-open-line">
          <div id="top">
            <div id="top-left">
              <?php 
              $icon_path = 'no_photo.gif';
              if (isset($parent['Category']['thumbnail_path'])) {
                  $icon_path = $parent['Category']['thumbnail_path'];
              }
              echo $this->Html->image($icon_path, array('width' => 118, 'height' => 87)); ?>
              <h1><?php echo $parent['Category']['title']; ?></h1>
              <?php echo substr($parent['Category']['description'],0,200); ?>
            </div>
            <div id="top-right-arrow">
              <?php echo $this->Html->link(
                             $this->Html->image('btn_up_blue.png', array('style'=>"border:0px")),
                            "#",
                            array('class'=>"showChildren",'escape'=>false));
                ?>
            </div>
          </div>      
        <?php 
          if(count($menus) > 0):
            $j = 0;
            echo '<div id="subNav">';
            foreach ($menus as $menu):
              $j++;
              echo $this->Html->link(
                            $menu,
                            array(
                                'controller' => 'categories',
                                'action' => 'lists',
                                'parent_slug' => $parent['Category']['slug'],
                                'slug' => $menu['Category']['slug']
                            ),
                            array('class'=>"inside")
                        );
              if ($j < count($menus)):
                echo " | ";
              endif;
            endforeach;
          echo '</div>';
          endif;
        ?>
        
        <div id="search_desc">
            <?php
                $this->Paginator->options(array(
                    'url' => array(
                        'controller' => 'categories',
                        'action' => 'lists',
                        'parent_slug' => $this->params['parent_slug'],
                        'slug' => $this->params['slug'],
                        'limit' => $this->params['named']['limit']
                    )
                ));
                echo $this->Paginator->counter(array(
                    'format' => 'Page %page% of %pages% | total %count% item(s) matching your selection: '
                ));
            ?>
            <!-- breadcrumbs -->
            <?php if ($breadCrumbs): ?>
                <span>
                    <?php echo implode('&nbsp;&gt;&nbsp;', Set::extract('/Category/title', $breadCrumbs)); ?>
                </span>
            <?php endif; ?>
            <!-- limit selector -->
            <?php 
              if (count($products) > 0):
                $limiter = array(9, 6, 3);
                foreach ($limiter as $limit):
                  echo $this->Html->link(
                              $this->Html->image('search_by_'.$limit.'.png',array('border'=>0)),
                              $this->Paginator->url(array(
                                  'controller' => 'categories',
                                  'action' => 'lists',
                                  'slug' => $this->params['slug'],
                                  'parent_slug' => $this->params['parent_slug'],
                                  'limit' => $limit
                              ), true),
                              array('class' => "limiter-{$limit}", 'escape' => false)
                          );
                endforeach;
               endif;
              ?>
          </div>
        </div>
        
        
        <?php
          if (count($products) > 0):
            echo "<div id=\"search_results_block\">";
              echo "<table width=\"100%\" height=\"100%\">";
                  echo "<tr>";
                      echo "<td width=\"10%\" align=\"right\">";
                      echo $this->Paginator->prev($this->Html->image('arrow_left.png', array('border'=>0,'height'=>65,'width'=>36)),array('escape'=>false));
                      echo "</td>";
                      echo "<td width=\"80%\">";
                      foreach ($products as $prod):
                        echo '<div id="search_results_details">';
                        echo "<h2>";
                        echo $this->Html->link($prod['Product']['title'], array('controller' => 'products', 'action' => 'view', $prod['Product']['slug']),
                                                                                         array('class' => 'linkToProductDetail') );
                        echo "</h2><br>";
                        
                        if (!empty($prod['ProductInfo']['thumbnail_path'])) {
                            echo $this->Html->link(
                                $this->Html->image($prod['ProductInfo']['medium_path'], array('width' => 187, 'height' => 123,'style'=>'display:inline;')),
                                array('controller' => 'products', 'action' => 'view', $prod['Product']['slug']),
                                array('escape' => false, 'class' => 'img'));
                        }
                        
                        echo "<br><br>";
                        
                        if (isset($prod['ProductRating'])):
                          echo "<table>";
                          foreach ($prod['ProductRating'] as $pr):
                            echo "<tr><td>";
                            echo $pr['Rating']['title']." : ";
                            echo "</td><td>";
                            $disabled = false;
                            
                            if (!empty($votedList)) {
                               $disabled = in_array($pr['id'], $votedList);
                            }
                            
                            echo $this->StarRating->create( $pr['id'], array('controller' => 'product_ratings', 'action' => 'vote'), $pr['average'], $disabled);
                            echo "</td></tr>";
                          endforeach;
                          echo "</table>";
                        endif;
                        
                        if (isset($prod['ProductService'])):
                           echo "<div style=\"display:-moz-inline-box\">";
                           foreach ($prod['ProductService'] as $ps):
                             echo $this->Html->image( "services/".$ps['Service']['icon_dir']."/".$ps['Service']['icon'], array('title' => $ps['Service']['title']));
                           endforeach;
                           echo "</div>";
                           echo "<br>";
                        endif;
                        echo substr($prod['Product']['description'],0,100);
                        echo '</div>';
                      endforeach;
                      echo "</td>";
                      echo "<td width=\"10%\" align=\"left\">";
                      echo $this->Paginator->next($this->Html->image('arrow_right.png', array('border'=>0,'height'=>65,'width'=>36)),array('escape'=>false));
                      echo "</td>";                  
                  echo "</tr>";
              echo "</table>";
            echo "</div>";
          endif;
        ?>
        <div class="clear">&nbsp;</div>
    </div>
<?php endif; ?>
<script type="text/javascript">
    $(function() {
        $('#contentDetail a.prev').click(function(e) {
            e.preventDefault();
            $.get($(this).attr('href'), function(result) {
                $('#mainContent').html(result);
            });
        });
        $('#contentDetail a.next').click(function(e) {
            e.preventDefault();
            $.get($(this).attr('href'), function(result) {
                $('#mainContent').html(result);
            });
        });
        $('a.limiter-3').click(function(e) {
            e.preventDefault();
            $.get($(this).attr('href'), function(result) {
                $('a.limiter-3').parent().parent().parent().html(result);
                $('a.limiter-3').children().first().addClass('selected');
            });
        });
        $('a.limiter-6').click(function(e) {
            e.preventDefault();
            $.get($(this).attr('href'), function(result) {
                $('a.limiter-6').parent().parent().parent().html(result);
                $('a.limiter-6').children().first().addClass('selected');
            });
        });
        $('a.limiter-9').click(function(e) {
            e.preventDefault();
            $.get($(this).attr('href'), function(result) {
                $('a.limiter-9').parent().parent().parent().html(result);
                $('a.limiter-9').children().first().addClass('selected');
            });
        });
    });
</script>