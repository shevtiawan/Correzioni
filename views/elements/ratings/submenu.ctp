<ul>
    <li><?php echo $this->Html->link("You are in :", "#") ?> </li>
    <li>
        <?php
        echo $this->Html->link("Root", array(
            "controller" => "ratings", "action" => "index"), array("class" => "sm-list"
        )); ?>
    </li>
    <?php if (!empty($paths)): ?>
        <?php foreach($paths as $path): ?>
            <li>
                <?php
                echo $this->Html->link(
                    $path['Rating']['title'],
                    array(
                        'action' => 'subs',
                        'parent_id' => $path['Rating']['id']
                    ),
                    array('class' => "sm-next")
                );
                ?>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>
