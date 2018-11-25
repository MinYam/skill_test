<?php echo Form::open(); ?>
<div class="container">
	<div class="row" style="margin-bottom: 10px">
		<?php $key = 'image_path'; ?>
		<?php echo Form::input($key, Input::post($key, null), array('class' => 'form-control', 'placeholder' => '画像パスを入力してください')); ?>
	</div>
	<div class="row">
		<?php echo Form::button('success', '正常系', array('type' => 'submit', 'class' => 'btn btn-success')); ?>
		<?php echo Form::button('error', '異常系', array('type' => 'submit', 'class' => 'btn btn-danger')); ?>
	</div>
</div>
<?php echo Form::close(); ?>

<?php if ((bool) count($logs)): ?>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>id</th>
				<th>image_path</th>
				<th>success</th>
				<th>message</th>
				<th>class</th>
				<th>confidence</th>
				<th>request_timestamp</th>
				<th>response_timestamp</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($logs as $row): ?>
			<tr>
				<th><?php echo $row['id']; ?></th>
				<th><?php echo $row['image_path']; ?></th>
				<th><?php echo $row['success']; ?></th>
				<th><?php echo $row['message']; ?></th>
				<th><?php echo $row['class']; ?></th>
				<th><?php echo $row['confidence']; ?></th>
				<th><?php echo $row['request_timestamp']; ?></th>
				<th><?php echo $row['response_timestamp']; ?></th>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>

<script>
	<?php /* エンターキー無効化対策 */ ?>
	$(function(){
		$("input"). keydown(function(e) {
			if ((e.which && e.which === 13) || (e.keyCode && e.keyCode === 13)) {
				return false;
			}
			return true;
		});
	});
</script>