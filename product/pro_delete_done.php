<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>ろくまる農園</title>
</head>
<body>

	<?php

	try{

    $pro_code = $_POST['code'];

		$dsn = 'mysql:dbname=product;host=localhost;charset=utf8';
		$user = 'root';
		$password = 'root';
		$dbh = new PDO($dsn,$user,$password);
		$dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		$sql = 'DELETE FROM mst_product WHERE code=?';
		$stmt = $dbh -> prepare($sql);
		$data[] = $pro_code;
		$stmt -> execute($data);

		$dbh = null;
	}
	catch(Exception $e){
		print '只今、障害により大変ご迷惑お掛けしております。';
		exit();
	}
	?>

  削除しました。<br>
  <br>
	<a href="pro_list.php">戻る</a>

</body>
</html>