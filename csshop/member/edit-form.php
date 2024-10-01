<?php include "../connect.php" ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>CS Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../mcss.css" rel="stylesheet" type="text/css" />
    <script src="../mpage.js"></script>

    <style>
          .input-label {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            margin-bottom: 20px;
          }

          label {
            width: 120px;
            text-align: left;
            margin-right: 50px;
          }
          div>input {
            width: 180px;
          }


    </style>
  </head>

  <body>
    <header>
      <div class="logo">
        <img src="../cslogo.jpg" width="200" alt="Site Logo">
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
      <article>
            <?php
                $stmt = $pdo->prepare("SELECT * FROM member WHERE username = ?");
                $stmt->bindParam(1, $_GET["username"]);
                $stmt->execute(); 
                $row = $stmt->fetch();
            ?>
              
            <form action="edit-member.php" method="post" enctype="multipart/form-data" style="text-align: center; margin-bottom: 20px;">
              <div class="input-label">
                <img src='../../member_photo/<?=$row["username"]?>.jpg' width="180px" style="padding: 4px;">
              </div>

              <input type="hidden" name="username" value="<?=$row["username"]?>">
              
              <div class="input-label">
                <label>password :</label>
                <input type="password" name="password" value="<?=$row["password"]?>" required>
              </div>

              <div class="input-label">
                <label>ชื่อสมาชิก :</label>
                <input type="text" name="mname" value="<?=$row["name"]?>" required>
              </div>

              <div class="input-label">
                <label>ที่อยู่ :</label>
                <input type="text" name="address" value="<?=$row["address"]?>" required>
              </div>

              <div class="input-label">
                <label>เบอร์โทร :</label>
                <input type="text" name="mobile" pattern="[0-9]+" value="<?=$row["mobile"]?>" required>
              </div>

              <div class="input-label">
                <label>อีเมลล์ :</label>
                <input type="email" name="email" value="<?=$row["email"]?>" required>
              </div>

              <div class="input-label">
                <label>อัปโหลดรูปภาพ :</label>
                <input type="file" name="profile_pic" style="padding: 4px;">
              </div>

              <input type="submit" value="บันทึก">
            </form>
      </article>
      <nav id="menu">
        <h2>Navigation</h2>
        <ul class="menu">
          <li><a href="../home.php">Home</a></li>
          <li><a href="../product.php">Products</a></li>
          <li><a href="../product-list.php">Products List</a></li>
          <li><a href="../add-product.html">Add Product</a></li>
          <li><a href="../mpage1.php">Workshop 1</a></li>
          <li><a href="../mpage2.php">Workshop 2</a></li>
          <li><a href="../mpage4.php">Workshop 4</a></li>
          <li><a href="../mpage7.php">Workshop 7</a></li>
          <li><a href="../mpage9.php">Workshop 9</a></li>
          <li><a href="../lab7.php">Lab 7</a></li>
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