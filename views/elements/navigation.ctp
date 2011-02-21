<ul>
    <?php foreach ($nav as $menu): ?>
        <li>
            <?php
            echo $this->Html->link(
                $menu['Category']['title'],
                array(
                    'controller'=>'categories',
                    'action'=>'submenus',
                    'slug' => $menu['Category']['slug']
                ),
                array('style'=>"background-color:#{$menu['Category']['color']};")
            );
            ?>
        </li>
    <?php endforeach; ?>
</ul>
<div class="clear">&nbsp;</div>
