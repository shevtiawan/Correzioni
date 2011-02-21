<ul>
  <li><?php echo $this->Html->link("Website", array("controller" => "settings", "action" => "edit",$setting_id), array("class" => "sm-web")) ?></li>
  <li><?php echo $this->Html->link("Permission", array("controller" => "acls", "action" => "index"), array("class" => "sm-auth")) ?></li>
  <li><?php echo $this->Html->link("Template", array("controller" => "templates", "action" => "index"), array("class" => "sm-template")) ?></li>
  <li><?php echo $this->Html->link("Plugin", array("controller" => "plugins", "action" => "index"), array("class" => "sm-plugin")) ?></li>
</ul>