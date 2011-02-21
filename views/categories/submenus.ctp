<?php if (!empty($menus)): ?>
    <?php
        if (empty($parent['Category']['color'])) {
            $parent['Category']['color'] = '2F373A';
        }
    ?>
    <div id="subNav" style="background-color: #<?php echo $parent['Category']['color']; ?>">
        <ul>
            <?php $i = 0; ?>
            <?php foreach ($menus as $menu): ?>
                <?php $i++; ?>
                <li>
                    <?php
                        echo $this->Html->link(
                            $menu['Category']['title'],
                            array(
                                'controller' => 'categories',
                                'action' => 'lists',
                                'parent_slug' => $parent['Category']['slug'],
                                'slug' => $menu['Category']['slug']
                            ),
                            array('class'=>"inside")
                        );
                    ?>
                </li>
                <?php if ($i < count($menus)): ?>
                    <li> | </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <div class="clear">&nbsp;</div>
    </div>
    
    <script type="text/javascript">
      $('#subNav a').click(function() {
        if($('#mainPic').length < 1){
          $('#page-open-line').remove(); 
          $('#search_results_block').remove();
          $('#mainContent').append('<div id="mainPic"></div>');
        }
        $('#subNav a').removeClass('selected');
        $(this).addClass('selected');
        $('#bannerFeature').hide();
        if($('#subNavContainer').size() < 1){
          $('#mainPic').prepend('<div id="subNavContainer"></div>');

            $('#subNavContainer').accordion({
              header: 'div.category-list',
              active: false,
              clearStyle: true,
              alwaysOpen: false,
            }).bind("change.ui-accordion", function(event, ui) {
                if(ui.newHeader.text() != ui.oldHeader.text()){
                  var _nextProduct = $('.category-list.selected').attr('href');
                  var _productContainer = $('.category-list.selected').next();
                  _productContainer.html('<img src="./img/ajax-loader-small.gif">');
                  $.get(_nextProduct,function(content){
                    if(content.length < 1){
                      content = "<p style='color:#000000;font-size:12px;'> no result </p>";
                    }
                    _productContainer.html(content);
                  });
                }
            });
        }

        var _preloader = '<div style="text-align:center;border-bottom:1px solid #8e9ca6;"><img src="./img/ajax-loader-small.gif" /></div>';
        $('#subNavContainer').html(_preloader);

        $('#subNavContainer').slideDown('normal', showProductsOrSubMenus(this));

        function showProductsOrSubMenus(a){
          $.get($(a).attr('href'), function(content){
            $('#subNavContainer').html(content);
          });
        }
        return false;

      });
    </script>
    
<?php endif; ?>
