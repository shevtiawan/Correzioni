<div class="forms">
<?php 
  echo $form->hidden('aco_id');
  echo $form->input('aro_id', array('label' => 'Access Request Object', 'empty' => true));
  echo $form->input('_create', array('options' => $perms));
  echo $form->input('_read', array('options' => $perms));
  echo $form->input('_update', array('options' => $perms));
  echo $form->input('_delete', array('options' => $perms));
?>
    <div class="input">
      <label>&nbsp;</label>
      <div class="buttons" style="padding:0;">
        <span class="button send_form_btn"><span><span>SAVE</span></span><input name="" type="submit" /></span>
        <?php if($this->Form->value('Permission.id') > 0){ ?>
          <span class="button" style="padding-left:10px">&nbsp;</span>
          <span class="button red_btn"><span><span>DELETE</span></span><input name="" type="delete" onclick="javascript:confirmDelete()" /></span>
        <?php } ?>
      </div>
    </div>
</div>


<script type="text/javascript">  
  function confirmDelete(){
    if(confirm('Are you sure you want to delete this permission?')){
      window.location = "<?php echo $this->Html->url(array('action' => 'delete', $this->Form->value('Permission.id'))) ?>";
    }
  }
  
</script>