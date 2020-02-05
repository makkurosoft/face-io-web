<div class="container">
	<a href="<?php echo base_url() . "main/signout"?>">サインアウト</a>
	<h1><?php echo $user_name;?>さんの管理クラス一覧</h1>

	<!-- クラス一覧をリンクで表示 -->
	<?php
	foreach($classes as $class){
	?>
	<a href="<?php echo base_url() . "main/dashboard/" . $class['class_id']?>"><?php echo $class['department_name'] . $class['grade'] ."年"?></a><br>
	<?php
	}
	?>
</div>
