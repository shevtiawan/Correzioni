<ul>
  <li><?php echo $this->Html->link("Website", array("plugin" =>null, "controller" => "settings", "action" => "edit",$setting_id), array("class" => "sm-web")) ?></li>
  <li><?php echo $this->Html->link("Permission", array("plugin" =>null, "controller" => "acls", "action" => "index"), array("class" => "sm-auth")) ?></li>
  <li><?php echo $this->Html->link("Template", array("plugin" =>null, "controller" => "templates", "action" => "index"), array("class" => "sm-template")) ?></li>
  <li><?php echo $this->Html->link("Plugin", array("plugin" =>null, "controller" => "plugins", "action" => "index"), array("class" => "sm-plugin")) ?></li>
</ul>