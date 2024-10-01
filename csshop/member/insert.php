<?php include "../connect.php" ?>

<?php
    $stmt = $pdo->prepare("INSERT INTO member VALUE(?, ?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $_POST["username"]);
    $stmt->bindParam(2, $_POST["password"]);
    $stmt->bindParam(3, $_POST["mname"]);
    $stmt->bindParam(4, $_POST["address"]);
    $stmt->bindParam(5, $_POST["mobile"]);
    $stmt->bindParam(6, $_POST["email"]);

    if ($stmt->execute()) {
        $username = $_POST["username"];
        
        $file = "../../member_photo/" . $username . ".jpg";

        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $file)) {
            header("location: ../mpage5.php?username=" . $username);
        }
    }
?>
