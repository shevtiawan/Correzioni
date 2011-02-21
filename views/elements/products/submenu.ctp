<ul>
    <li><?php echo $this->Html->link("You are in :", "#") ?> </li>
    <li>
        <?php
        echo $this->Html->link(
            "Root",
            array(
                "controller" => "products",
                "action" => "index"
            ),
            array("class" => "sm-list")
        );
        ?>
    </li>
    <?php if (!empty($paths)): ?>
        <?php foreach($paths as $path): ?>
            <li>
                <?php
                echo $this->Html->link(
                    $path['Product']['title'],
                    array(
                        'controller' => 'products',
                        'action' => 'tabs',
                        'parent_id' => $path['Product']['id']
                    ),
                    array('class' => "sm-next")
                );
                ?>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>
