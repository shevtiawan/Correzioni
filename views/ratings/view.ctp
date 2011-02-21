<div class="ratings view">
<h2><?php  __('Rating');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rating['Rating']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Parent Rating'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($rating['ParentRating']['title'], array('controller' => 'ratings', 'action' => 'view', $rating['ParentRating']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rating['Rating']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Icon Path'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rating['Rating']['icon_path']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rating['Rating']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Indexed At'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rating['Rating']['indexed_at']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lft'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rating['Rating']['lft']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rght'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rating['Rating']['rght']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Published'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rating['Rating']['is_published']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created At'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rating['Rating']['created_at']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated At'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rating['Rating']['updated_at']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Total User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rating['Rating']['total_user']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Point'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rating['Rating']['point']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Rating', true), array('action' => 'edit', $rating['Rating']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Rating', true), array('action' => 'delete', $rating['Rating']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $rating['Rating']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Ratings', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rating', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ratings', true), array('controller' => 'ratings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Rating', true), array('controller' => 'ratings', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Ratings');?></h3>
	<?php if (!empty($rating['ChildRating'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Parent Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Icon Path'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Indexed At'); ?></th>
		<th><?php __('Lft'); ?></th>
		<th><?php __('Rght'); ?></th>
		<th><?php __('Is Published'); ?></th>
		<th><?php __('Created At'); ?></th>
		<th><?php __('Updated At'); ?></th>
		<th><?php __('Total User'); ?></th>
		<th><?php __('Point'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($rating['ChildRating'] as $childRating):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $childRating['id'];?></td>
			<td><?php echo $childRating['parent_id'];?></td>
			<td><?php echo $childRating['title'];?></td>
			<td><?php echo $childRating['icon_path'];?></td>
			<td><?php echo $childRating['description'];?></td>
			<td><?php echo $childRating['indexed_at'];?></td>
			<td><?php echo $childRating['lft'];?></td>
			<td><?php echo $childRating['rght'];?></td>
			<td><?php echo $childRating['is_published'];?></td>
			<td><?php echo $childRating['created_at'];?></td>
			<td><?php echo $childRating['updated_at'];?></td>
			<td><?php echo $childRating['total_user'];?></td>
			<td><?php echo $childRating['point'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'ratings', 'action' => 'view', $childRating['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'ratings', 'action' => 'edit', $childRating['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'ratings', 'action' => 'delete', $childRating['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $childRating['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Rating', true), array('controller' => 'ratings', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
