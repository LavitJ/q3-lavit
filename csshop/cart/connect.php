<?php
try {
	$pdo = new PDO("mysql:host=localhost;dbname=sec1_30;charset=utf8", username:"Wstd30", password:"CPtUcRzc");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "เกิดข้อผิดพลาด : ".$e->getMessage();
}
?>