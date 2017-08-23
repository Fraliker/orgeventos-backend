<div class="events index">
<?php if (isset($userevents)) {
    echo "<script>window.location='" . "/event_users/confirm/" . $userevents['EventUser']['id'] . "';</script>";
            }  ?>
	<h2><?php echo __('Events'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('startdate'); ?></th>
			<th><?php echo $this->Paginator->sort('enddate'); ?></th>
			<th><?php echo $this->Paginator->sort('site'); ?></th>
			<th><?php echo $this->Paginator->sort('phone'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('organizer'); ?></th>
			<th><?php echo $this->Paginator->sort('supporters'); ?></th>
			<th><?php echo $this->Paginator->sort('audience_limit'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($events as $event): ?>
	<tr>
		<td><?php echo h($event['Event']['id']); ?>&nbsp;</td>
		<td><?php echo h($event['Event']['name']); ?>&nbsp;</td>
		<td><?php echo h($event['Event']['description']); ?>&nbsp;</td>
		<td><?php echo h($event['Event']['startdate']); ?>&nbsp;</td>
		<td><?php echo h($event['Event']['enddate']); ?>&nbsp;</td>
		<td><?php echo h($event['Event']['site']); ?>&nbsp;</td>
		<td><?php echo h($event['Event']['phone']); ?>&nbsp;</td>
		<td><?php echo h($event['Event']['email']); ?>&nbsp;</td>
		<td><?php echo h($event['Event']['address']); ?>&nbsp;</td>
		<td><?php echo h($event['Event']['organizer']); ?>&nbsp;</td>
		<td><?php echo h($event['Event']['supporters']); ?>&nbsp;</td>
		<td><?php echo h($event['Event']['audience_limit']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $event['Event']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $event['Event']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $event['Event']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $event['Event']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Event'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Event Users'), array('controller' => 'event_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event User'), array('controller' => 'event_users', 'action' => 'add')); ?> </li>
	</ul>
</div>
