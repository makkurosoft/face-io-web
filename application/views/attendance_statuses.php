<div class="container">
	<a href="<?php echo base_url() . "main/signout"?>">サインアウト</a>
	<a href="<?php echo base_url() . "main/dashboard"?>">ダッシュボード</a>
	<h1><?php echo $class_name->department_name . $class_name->grade;?>の出席状況</h1>
	<table class = "table table-hover">
	<tr>
		<th>氏名</th><th>出欠</th>
	</tr>
	<?php
	foreach($attendance_statuses as $attendence_status){
	?>
		<tr>
		<td><?php echo $attendence_status['name'] ?> </td>
		<td><?php echo $attendence_status['出欠判定'] ?></td>
		</tr>
	<?php
	}
	?>
	</table>
</div>
