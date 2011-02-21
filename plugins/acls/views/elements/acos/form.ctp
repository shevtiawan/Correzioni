<div class="forms">
    <?php 
      echo $form->input('parent_id');
      echo $form->input('alias');
      echo $form->input('model');
      echo $form->input('foreign_key');
    ?>
    <div class="input">
      <label>&nbsp;</label>
      <div class="buttons" style="padding:0;">
        <span class="button send_form_btn"><span><span>SAVE</span></span><input name="" type="submit" /></span>
        <?php if($this->Form->value('Aco.id') > 0){ ?>
          <span class="button" style="padding-left:10px">&nbsp;</span>
          <span class="button red_btn"><span><span>DELETE</span></span><input name="" type="delete" onclick="javascript:confirmDelete()" /></span>
        <?php } ?>
      </div>
    </div>
</div>


<script type="text/javascript">  
  function confirmDelete(){
    if(confirm('Are you sure you want to delete # <?php echo $this->Form->value('Aco.alias') ?>?')){
      window.location = "<?php echo $this->Html->url(array('action' => 'delete', $this->Form->value('Aco.id'))) ?>";
    }
  }
  
</script>
