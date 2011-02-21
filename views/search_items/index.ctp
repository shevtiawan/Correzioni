<div id="page-open-line">
  <div id="search_desc">
    <?php
      $this->Paginator->options(array(
                    'url' => array('controller' => 'search', 'action' => 'index', 'title' => $this->params['named']['title'])
                ));
                echo $this->Paginator->counter(array(
                    'format' => 'Page %page% of %pages% | total %count% item(s) matching your keyword: '
                ));
  
            if (count($items) > 0):
                $limiter = array(9, 6, 3);
                foreach ($limiter as $limit):
                  echo $this->Html->link(
                              $this->Html->image('search_by_'.$limit.'.png',array('border'=>0)),
                              $this->Paginator->url(array('controller' => 'search', 'action' => 'index', 'title' => $this->params['named']['title'], 'limit' => $limit), true),
                              array('class' => "limiter-{$limit}", 'escape' => false)
                          );
                endforeach;
            endif; 
    ?>
  </div>
</div>


<?php 

if(!empty($items)):
   echo "<div id=\"search_results_block\">";
   echo "<table width=\"100%\" height=\"100%\">";
   echo "<tr>";
   echo "<td width=\"10%\" align=\"right\">";
   echo $this->Paginator->prev($this->Html->image('arrow_left.png', array('border'=>0,'height'=>65,'width'=>36)),array('escape'=>false));
   echo "</td>";
   echo "<td width=\"80%\">";
   
   foreach($items as $prod): 
     echo '<div id="search_results_details">';
     echo "<h2>";
     echo $this->Html->link( $prod['Product']['title'], array('controller' => 'products', 'action' => 'view', $prod['Product']['slug']));
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