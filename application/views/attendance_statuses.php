
<a href="<?php echo base_url() . "main/signout"?>">サインアウト</a>
<a href="<?php echo base_url() . "main/dashboard"?>">ダッシュボード</a>
<h1><?php echo $class_id;?>の出席状況</h1>

<?php
foreach($attendance_statuses as $attendence_status){
	?>
	<h3><?php echo $attendence_status['name'] . $attendence_status['出欠判定'] ?></h3>
	<?php
}
?>
