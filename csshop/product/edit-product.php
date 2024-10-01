<?php include "../connect.php" ?>

<?php
    $stmt = $pdo->prepare("UPDATE product SET pname=?, pdetail=?, price=? WHERE pid=?");  
    
    $stmt->bindParam(1, $_POST["pname"]); 
    $stmt->bindParam(2, $_POST["pdetail"]); 
    $stmt->bindParam(3, $_POST["price"]);
    $stmt->bindParam(4, $_POST["pid"]);
    
    if ($stmt->execute()){
        
        $pname = $_POST["pname"];

        $file = "../../product_photo/" . $pname . ".jpg";

        move_uploaded_file($_FILES["product_pic"]["tmp_name"], $file);

        header("location: ./product-detail.php?pname=" . $pname);
    }
?>