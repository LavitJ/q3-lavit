<?php include "../connect.php" ?>
<?php
    $stmt = $pdo->prepare("DELETE FROM member WHERE username = ?");
    $stmt->bindParam(1, $_GET["username"]);
    
    if ($stmt->execute())
        unlink("../../member_photo/" . $_GET["username"] . ".jpg");
        header("location: ../mpage2.php");
?>