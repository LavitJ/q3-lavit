<?php include "connect.php" ?>
<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <title>CS Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="mcss.css" rel="stylesheet" type="text/css" />
    <script src="mpage.js"></script>

    <script>
        function confirmDelete(pid, pname) {
            var ans = confirm("ต้องการลบสินค้า " + pname + " ใช่หรือไม่?");
            if (ans == true) {
                document.location = "product/delete.php?pid=" + pid;
            }
        }
    </script>

    <style>
      .input-label {
            display: flex;
            margin-right: 50px;
            justify-content: center;
            margin-top: 20px;
            margin-bottom: 20px;
          }
          label {
            width: 100px;
            text-align: left;
          }
          div>input {
            width: 180px;
          }
    </style>
  </head>

  <body>
    <header>
      <div class="logo">
        <img src="cslogo.jpg" width="200" alt="Site Logo">
      </div>
      <div class="search">
        <form>
          <input type="search" placeholder="Search the site...">
          <button>Search</button>
        </form>
      </div>
    </header>

    <div class="mobile_bar">
      <a href="#"><img src="responsive-demo-home.gif" alt="Home"></a>
      <a href="#" onClick='toggle_visibility("menu"); return false;'><img src="responsive-demo-menu.gif" alt="Menu"></a>
    </div>

    <main>
      <article style="text-align: center;">
        <?php
            $stmt = $pdo->prepare("SELECT * FROM product ORDER BY pid");
            $stmt->execute();
          
            while ($row = $stmt->fetch()) {
        ?>    
              <div style="display:flex; justify-content: center; margin: 30px;">
                <img src="../product_photo/<?=$row["pname"]?>.jpg" width="150px" height="180px" >
              </div>

              <div style="display: inline-block; text-align: left;">
                <b>รหัสสินค้า:</b> <?=$row["pid"]?><br>
                <b>ชื่อสินค้า:</b> <?=$row["pname"]?><br>
                <b>รายละเอียด:</b> <?=$row["pdetail"]?><br>
                <b>ราคา:</b> <?=$row["price"]?><br>
                <a href="product/product-detail.php?pname=<?=$row["pname"]?>" style="color: blue;">แสดงรายละเอียด</a>
                <a href="#" style="color: blue;" onclick='confirmDelete("<?=$row["pid"]?>", "<?=$row["pname"]?>")'>ลบ</a>
                <a href="product/edit-form.php?pid=<?=$row["pid"]?>" style="color: blue;">แก้ไข</a>
              </div>
              <hr>
        <?php }; ?>
      </article>
      <nav id="menu">
        <h2>Navigation</h2>
        <ul class="menu">
          <li><a href="./home.php">Home</a></li>
          <li><a href="./product.php">Products</a></li>
          <li class="dead"><a>Product List</a></li>
          <li><a href="./add-product.html">Add Product</a></li>
          <li><a href="./mpage1.php">Workshop 1</a></li>
          <li><a href="./mpage2.php">Workshop 2</a></li>
          <li><a href="./mpage4.php">Workshop 4</a></li>
          <li><a href="./mpage7.php">Workshop 7</a></li>
          <li><a href="./mpage9.php">Workshop 9</a></li>
          <li><a href="./lab7.php">Lab 7</a></li>
        </ul>
      </nav>
      <aside>
        <h2>Aside</h2>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed blandit libero sit amet nunc ultricies, eu feugiat diam placerat. Phasellus tincidunt nisi et lectus pulvinar, quis tincidunt lacus viverra. Phasellus in aliquet massa. Integer iaculis massa id dolor venenatis scelerisque.
          <br><br>
        </p>
      </aside>
    </main>
    <footer>
      <a href="#">Sitemap</a>
      <a href="#">Contact</a>
      <a href="#">Privacy</a>
    </footer>
  </body>
</html>