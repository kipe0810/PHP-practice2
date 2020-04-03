<?php
  session_start();
  session_regenerate_id(true);
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
	  	require_once('../common/common.php');

			$post = sanitize($_POST);

			$onamae = $post['onamae'];
			$email = $post['email'];
			$postal1 = $post['postal1'];
			$postal2 = $post['postal2'];
			$address = $post['address'];
			$tel = $post['tel'];

			print $onamae.'様<br>';
		  print 'ご注文ありがとうございました。<br>';
		  print $email.'にメールを送りましたのでご確認ください。<br>';
		  print '商品は以下の住所に発送させていただきます。<br>';
		  print $postal1.'-'.$postal2.'<br>';
		  print $address.'<br>';
		  print $tel.'<br>';

		  $honbun = '';
		  $honbun .= $onamae."様 \n\n この度はご注文ありがとうございました。 \n";
		  $honbun .= "\n";
		  $honbun .= "ご注文商品 \n";
		  $honbun .= "--------------------------\n";

		  $cart = $_SESSION['cart'];
		  $kazu = $_SESSION['kazu'];
		  $max = count($cart);

		  $dsn = 'mysql:dbname=product;host=localhost;charset=utf8';
		$user = 'root';
		$password = 'root';
		$dbh = new PDO($dsn,$user,$password);
		$dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		for ($i=0; $i < $max; $i++) {
			$sql = 'SELECT name,price FROM mst_product WHERE code=?';
			$stmt = $dbh -> prepare($sql);
			$data[0] = $cart[$i];
			$stmt -> execute($data);

			$rec = $stmt -> fetch(PDO::FETCH_ASSOC);

      $name = $rec['name'];
      $price = $rec['price'];
      $suryo = $kazu['kazu'];
      $shokei = $price*$suryo;

      $honban .= $name.'';
      $honban .= $price.'円 x ';
      $honban .= $suryo.'個 = ';
      $honban .= $shokei."円 \n";
		}

		$dbh = null;

		$honban .= "送料は無料です。 \n";
		$honban .= "---------------------\n";
		$honban .= "\n";
		$honban .= "代金は以下の口座にお振込ください。\n";
		$honban .= "ろくまる銀行　やさい支店　普通口座　１２３４５６７\n";
		$honban .= "入金確認が取れ次第、梱包、発送させていただきます。\n";
		$honban .= "\n";
		$honban .= "□□□□□□□□□□□□□□□□□□□□\n";
		$honban .= "　〜安心野菜のろくまる農園〜\n";
		$honban .= "\n";
		$honban .= "○○県六丸郡六丸村１２３−４\n";
		$honban .= "電話　090-1111-1111\n";
		$honban .= "メール　info@xxxxxxxx.xxxxxxxxx\n";
		$honban .= "□□□□□□□□□□□□□□□□□□□□\n";
	  }
	  catch(Exception $e){
	  	print '只今、障害により大変ご迷惑をお掛けしております。';
	  	exit();
	  }

	?>

</body>
</html>