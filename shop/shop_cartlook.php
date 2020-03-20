<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['member_login']) == false) {
	print 'ようこそゲスト様　';
	print '<a href="member_login.html">会員ログイン</a><br>';
	print '<br>';
}
else{
	print 'ようこそ';
	print $_SESSION['member_name'];
	print '様　';
	print '<a href="member_logout.php">ログアウト</a><br>';
	print '<br>';
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>ろくまる農園</title>
</head>
<body>

	<?php

	try{
		$cart = $_SESSION['cart'];

		$dsn = 'mysql:dbname=product;host=localhost;charset=utf8';
		$user = 'root';
		$password = 'root';
		$dbh = new PDO($dsn,$user,$password);
		$dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	catch(Exception $e) {
    print '只今、障害により大変ご迷惑お掛けしております。';
    exit();
	}
	?>

	<form>
	<input type="button" onclick="history.back()" value="戻る">
	</form>

</body>
</html>