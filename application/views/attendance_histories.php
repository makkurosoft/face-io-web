<div class="container">
	<a href="<?php echo base_url() . "main/signout"?>">サインアウト</a>
	<a href="<?php echo base_url() . "main/dashboard"?>">ダッシュボード</a>
	<h1><?php echo $class_name->department_name . $class_name->grade;?>年の出席履歴</h1>
	<table class = "table table-hover">
	<tr>
		<th>出席番号</th><th>氏名</th>
		<?php
			foreach($dates as $date){
				echo "<th>".$date['dates']."</th>";
			}
		?>
	</tr>
	<?php
		/* foreach($students as $student){ */
		foreach(array_map(null, $students, $at_hists) as [$student, $at_hist]){
	?>
		<tr>
		<td><?php echo $student['attendance_number'] ?> </td>
		<td><?php echo $student['name'] ?></td>
		<?php
				foreach ($at_hist as $data_row){
					echo "<td>".$data_row['出欠判定']."</td>";
					}
			?>
		</tr>
	<?php
	}
	?>
	</table>
</div>
<!-- <script>setTimeout(function(){location.reload();}, 10000);</script> -->
