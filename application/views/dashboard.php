<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>管理クラス一覧</title>
</head>
<body>

	<a href="<?php echo base_url() . "main/signout"?>">サインアウト</a>
	<h1><?php echo $user_name;?>さんの管理クラス一覧</h1>

	<!-- クラス一覧をリンクで表示 -->
	<?php
	foreach($classes as $class){
	?>
		<a href="<?php echo base_url() . "main/dashboard/" . $class['department_name'] . $class['grade']?>"><?php echo $class['department_name'] . $class['grade'] ?></a><br>
	<?php
	}
	?>

</body>
</html>
