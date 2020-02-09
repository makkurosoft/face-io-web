<div class="container">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="<?php echo base_url() . "main/dashboard"?>">Face-io</a>
		<div class="collapse navbar-collapse justify-content-start">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link" href="<?php echo base_url() . "main/dashboard"?>">ダッシュボード</a>
				</li>
			</ul>
		</div>
		<li class="nav-item dropdown list-unstyled">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?php echo $user_name?>
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				<a class="dropdown-item" href="<?php echo base_url() . "main/dashboard"?>">ダッシュボード</a>
				<a class="dropdown-item" href="<?php echo base_url() . "main/signout"?>">サインアウト</a>
			</div>
		</li>
	</nav>

	<h1><?php echo $class_name->department_name . $class_name->grade;?>年の出席状況</h1>
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
<script>setTimeout(function(){location.reload();}, 10000);</script>
