<h3><?php echo $text_order_history; ?></h3>
<p><?php echo $text_your_order; ?></p>
<?php if (!empty($order_histories)) { ?>
<div class="table-responsive">
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th class="text-left"><?php echo $column_status; ?></th>
				<th class="text-left"><?php echo $column_date_added; ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($order_histories as $order_history) { ?>
			<tr>
				<td class="text-left"><?php echo $order_history['order_status']; ?></td>
				<td class="text-left"><?php echo $order_history['date_added']; ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<?php } else { ?>
<p><?php echo $text_empty; ?></p>
<?php } ?>