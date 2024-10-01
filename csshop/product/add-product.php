<?php include "../connect.php" ?>

<?php
    $stmt = $pdo->prepare("INSERT INTO product(pname, pdetail, price) VALUES (?, ?, ?)");

    $stmt->bindParam(1, $_POST["pname"]);
    $stmt->bindParam(2, $_POST["pdetail"]);
    $stmt->bindParam(3, $_POST["price"]);

    if ($stmt->execute()) {
        $pname = $_POST["pname"];

        $file = "../../product_photo/" . $pname . ".jpg";

        if (move_uploaded_file($_FILES["product_pic"]["tmp_name"], $file)) {
            header("location: ../product-list.php");
        }
    }
?>
