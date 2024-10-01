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
            <h1>Add New Member</h1>
            <form action="member/insert.php" method="post" enctype="multipart/form-data">
              
              <div class="input-label">
                <label>username : </label>
                <input type="text" name="username" required><br>
              </div>

              <div class="input-label">
                <label>password :</label>
                <input type="password" name="password" required>
              </div>

              <div class="input-label">
                <label>ชื่อสมาชิก :</label>
                <input type="text" name="mname" required>
              </div>

              <div class="input-label">
                <label>ที่อยู่ :</label>
                <input type="text" name="address" required>
              </div>

              <div class="input-label">
                <label>เบอร์โทร :</label>
                <input type="text" name="mobile" pattern="[0-9]+" required>
              </div>

              <div class="input-label">
                <label>อีเมลล์ :</label>
                <input type="email" name="email" required>
              </div>

              <div class="input-label">
                <label>รูปภาพ :</label>
                <input type="file" name="profile_pic" required>
              </div>
                
              <input type="submit" value="เพิ่มสมาชิก">
            </form>
      </article>
      <nav id="menu">
        <h2>Navigation</h2>
        <ul class="menu">
          <li><a href="./home.php">Home</a></li>
          <li><a href="./product.php">Products</a></li>
          <li><a href="./product-list.php">Products List</a></li>
          <li><a href="./add-product.html">Add Product</a></li>
          <li><a href="./mpage1.php">Workshop 1</a></li>
          <li><a href="./mpage2.php">Workshop 2</a></li>
          <li><a href="./mpage4.php">Workshop 4</a></li>
          <li class="dead"><a>Workshop 7</a></li>
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