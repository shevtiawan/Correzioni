<ul id="user_details_menu">
    <li>Welcome <strong><?php echo $user['User']['username']; ?></strong></li>
    <li>
        <ul id="user_access">
            <li class="first">
                <?php
                echo $this->Html->link(
                    'My account',
                    array('controller' => 'users', 'action' => 'edit', $user['User']['id'])
                );
                ?>
            </li>
            <li class="last">
                <?php echo $this->Html->link('Log out', array(
                    'controller' => 'users',
                    'action' => 'logout',
                    'admin' => false
                )); ?>
            </li>
        </ul>
    </li>
</ul>
