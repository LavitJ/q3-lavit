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
        table {
            margin: auto;
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
            $stmt = $pdo->prepare("SELECT * FROM product");
            $stmt->execute();
            echo "<h2>สินค้าทั้งหมด</h2>";
            echo "<table border='1px solid black'>";
            echo "<tr>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>รายละเอียดสินค้า</th>
                    <th>ราคา</th>
                </tr>";
            while ($row = $stmt->fetch()) {
                echo "<tr>".
                    "<td>".$row["pid"]."</td>".
                    "<td>".$row["pname"]."</td>".
                    "<td>".$row["pdetail"]."</td>".
                    "<td>".$row["price"]."</td>".
                    "</tr>";
            }
            echo "</table>";  

            echo "<h2>ข้อมูลสมาชิก</h2>";
            $stmt = $pdo->prepare("SELECT name, mobile, email FROM member");
            $stmt->execute();
            echo "<table border='1px solid black'>";
            echo "<tr>
                    <th>ชื่อ</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>อีเมล</th>
                </tr>";
            while ($row = $stmt->fetch()) {
                echo "<tr>".
                    "<td>".$row["name"]."</td>".
                    "<td>".$row["mobile"]."</td>".
                    "<td>".$row["email"]."</td>".
                    "</tr>";
            }
            echo "</table>"; 
            echo "<h2>สินค้าราคา 500 - 1000 บาท</h2>";
            $stmt = $pdo->prepare("SELECT * FROM product WHERE price >= 500 AND price <= 1000");
            $stmt->execute();
            echo "<table border='1px solid black'>";
            echo "<tr>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>รายละเอียดสินค้า</th>
                    <th>ราคา</th>
                </tr>";
            while ($row = $stmt->fetch()) {
                echo "<tr>".
                    "<td>".$row["pid"]."</td>".
                    "<td>".$row["pname"]."</td>".
                    "<td>".$row["pdetail"]."</td>".
                    "<td>".$row["price"]."</td>".
                    "</tr>";
            }
            echo "</table>"; 
            echo "<h2>สมาชิกที่มีชื่อขึ้นต้นด้วย 'บ'</h2>";
            $stmt = $pdo->prepare("SELECT * FROM member WHERE name LIKE 'บ%'");
            $stmt->execute();
            echo "<table border='1px solid black'>";
            echo "<tr>
                    <th>ชื่อ</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>อีเมล</th>
                </tr>";
            while ($row = $stmt->fetch()) {
                echo "<tr>".
                    "<td>".$row["name"]."</td>".
                    "<td>".$row["mobile"]."</td>".
                    "<td>".$row["email"]."</td>".
                    "</tr>";
            }
            echo "</table>"; 
            echo "<h2>สมาชิกที่มีอีเมลเป็น 'gmail'</h2>";
            $stmt = $pdo->prepare("SELECT * FROM member WHERE email LIKE '%gmail%' ORDER BY username DESC");
            $stmt->execute();
            echo "<table border='1px solid black'>";
            echo "<tr>
                    <th>ชื่อ</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>อีเมล</th>
                    <th>ชื่อผู้ใช้</th>
                </tr>";
            while ($row = $stmt->fetch()) {
                echo "<tr>".
                    "<td>".$row["name"]."</td>".
                    "<td>".$row["mobile"]."</td>".
                    "<td>".$row["email"]."</td>".
                    "<td>".$row["username"]."</td>". 
                    "</tr>";
            }
            echo "</table>"; 
            echo "<h2>ข้อมูลการสั่งซื้อ</h2>";
            $stmt = $pdo->prepare("SELECT member.name, orders.ord_date FROM member JOIN orders ON member.username = orders.username");
            $stmt->execute();
            echo "<table border='1px solid black'>";
            echo "<tr>
                    <th>ชื่อสมาชิก</th>
                    <th>วันที่สั่งซื้อ</th>
                </tr>";
            while ($row = $stmt->fetch()) {
                echo "<tr>".
                    "<td>".$row["name"]."</td>".
                    "<td>".$row["ord_date"]."</td>".
                    "</tr>";
            }
            echo "</table>"; 
            echo "<h2>จาก w7 +ยอดรวมแต่ละรายการสั่งซื้อ(order)</h2>";
            $stmt = $pdo->prepare("
                SELECT 
                    member.name, 
                    orders.ord_date, 
                    SUM(item.quantity) AS total_quantity, 
                    SUM(product.price * item.quantity) AS total_price
                FROM 
                    member 
                JOIN 
                    orders ON member.username = orders.username 
                JOIN 
                    item ON orders.ord_id = item.ord_id 
                JOIN 
                    product ON product.pid = item.pid 
                GROUP BY 
                    member.name, orders.ord_date
            ");
            $stmt->execute();
            echo "<table border='1px solid black'>";
            echo "<tr>
                    <th>ชื่อ</th>
                    <th>วันที่สั่งซื้อ</th>
                    <th>จำนวนรวม</th>
                    <th>ราคารวม</th>
                </tr>";
            while ($row = $stmt->fetch()) {
                echo "<tr>".
                    "<td>".$row["name"]."</td>".
                    "<td>".$row["ord_date"]."</td>".
                    "<td>".$row["total_quantity"]."</td>".
                    "<td>".$row["total_price"]." บาท</td>".
                    "</tr>";
            }
            echo "</table>";
            echo "<h2>ข้อมูลจำนวนสินค้าที่ขาย</h2>";
            $stmt = $pdo->prepare("
                SELECT 
                    product.pname, 
                    SUM(item.quantity) AS total_quantity 
                FROM 
                    product 
                JOIN 
                    item ON product.pid = item.pid 
                GROUP BY 
                    product.pname
            ");
            $stmt->execute();
            echo "<table border='1px solid black'>";
            echo "<tr>
                    <th>ชื่อสินค้า</th>
                    <th>จำนวนที่ขาย</th>
                </tr>";
            while ($row = $stmt->fetch()) {
                echo "<tr>".
                    "<td>".$row["pname"]."</td>".
                    "<td>".$row["total_quantity"]."</td>".
                    "</tr>";
            }
            echo "</table>";
            echo "<h2>วันที่สั่งซื้อของแต่ละชนิดสินค้า</h2>";
            $stmt = $pdo->prepare("
                SELECT product.pname, orders.ord_date 
                FROM product 
                JOIN item ON product.pid = item.pid 
                JOIN orders ON item.ord_id = orders.ord_id 
                ORDER BY product.pname, orders.ord_date
            ");
            $stmt->execute();
            
            echo "<table border='1px solid black'>";
            echo "<tr>
                    <th>ชื่อสินค้า</th>
                    <th>วันที่สั่งซื้อ</th>
                </tr>";
            
            while ($row = $stmt->fetch()) {
                echo "<tr>".
                    "<td>".$row["pname"]."</td>".
                    "<td>".$row["ord_date"]."</td>".
                    "</tr>";
            }
            
            echo "</table>";
            echo "<h2>ราคารวมของแต่ละชนิดสินค้า</h2>";
            $stmt = $pdo->prepare("
                SELECT product.pname, SUM(item.quantity * product.price) AS total_price
                FROM product 
                JOIN item ON product.pid = item.pid 
                GROUP BY product.pname
            ");
            $stmt->execute();
            
            
            echo "<table border='1px solid black'>";
            echo "<tr>
                    <th>ชื่อสินค้า</th>
                    <th>ราคารวม</th>
                </tr>";
            
            while ($row = $stmt->fetch()) {
                echo "<tr>".
                    "<td>".$row["pname"]."</td>".
                    "<td>".$row["total_price"]." บาท</td>".
                    "</tr>";
            }
            
            echo "</table>";
            echo "<h2>รายได้รวมจากการสั่งซื้อของแต่ละสมาชิก</h2>";
            $stmt = $pdo->prepare("
                SELECT member.name, SUM(item.quantity * product.price) AS total_revenue
                FROM member 
                JOIN orders ON member.username = orders.username 
                JOIN item ON orders.ord_id = item.ord_id 
                JOIN product ON item.pid = product.pid 
                GROUP BY member.name
            ");
            $stmt->execute();
            
            echo "<table border='1px solid black'>";
            echo "<tr>
                    <th>ชื่อสมาชิก</th>
                    <th>รายได้รวม</th>
                </tr>";
            
            while ($row = $stmt->fetch()) {
                echo "<tr>".
                    "<td>".$row["name"]."</td>".
                    "<td>".$row["total_revenue"]." บาท</td>".
                    "</tr>";
            }
            
            echo "</table>";
            echo "<h2>รายได้รวมตามวันที่สั่งซื้อ</h2>";
            $stmt = $pdo->prepare("
                SELECT orders.ord_date, SUM(item.quantity * product.price) AS total_revenue
                FROM orders 
                JOIN item ON orders.ord_id = item.ord_id 
                JOIN product ON item.pid = product.pid 
                GROUP BY orders.ord_date 
                ORDER BY orders.ord_date
            ");
            $stmt->execute();
            
            
            echo "<table border='1px solid black'>";
            echo "<tr>
                    <th>วันที่สั่งซื้อ</th>
                    <th>รายได้รวม</th>
                </tr>";
            
            while ($row = $stmt->fetch()) {
                echo "<tr>".
                    "<td>".$row["ord_date"]."</td>".
                    "<td>".$row["total_revenue"]." บาท</td>".
                    "</tr>";
            }
            
            echo "</table>";
            echo "<h2>ข้อมูลนักเรียน (เรียงตามชื่อ) Lab7_1</h2>";
            $stmt = $pdo->prepare("SELECT * FROM student ORDER BY std_name ASC");
            $stmt->execute();
            echo "<table border='1px solid black'>";
            echo "<tr><th>รหัสนักเรียน</th><th>ชื่อ</th><th>จังหวัด</th></tr>";
            while ($row = $stmt->fetch()) {
                echo "<tr><td>".$row["std_id"]."</td><td>".$row["std_name"]."</td><td>".$row["province"]."</td></tr>";
            }
            echo "</table>";

            
            echo "<h2>รหัสนักเรียนและชื่อ Lab7_2</h2>";
            $stmt = $pdo->prepare("SELECT std_id, std_name FROM student");
            $stmt->execute();
            echo "<table border='1px solid black'>";
            echo "<tr><th>รหัสนักเรียน</th><th>ชื่อ</th></tr>";
            while ($row = $stmt->fetch()) {
                echo "<tr><td>".$row["std_id"]."</td><td>".$row["std_name"]."</td></tr>";
            }
            echo "</table>";

            
            echo "<h2>นักเรียนจากขอนแก่น Lab7_3</h2>";
            $stmt = $pdo->prepare("SELECT * FROM student WHERE province = 'ขอนแก่น'");
            $stmt->execute();
            echo "<table border='1px solid black'>";
            echo "<tr><th>รหัสนักเรียน</th><th>ชื่อ</th><th>จังหวัด</th></tr>";
            while ($row = $stmt->fetch()) {
                echo "<tr><td>".$row["std_id"]."</td><td>".$row["std_name"]."</td><td>".$row["province"]."</td></tr>";
            }
            echo "</table>";

        
            echo "<h2>ข้อมูลวิชาสำหรับนักเรียนที่รหัส 5001100348 Lab7_4</h2>";
            $stmt = $pdo->prepare("SELECT course.course_id, course.title, course.credit 
                                    FROM student 
                                    JOIN register ON student.std_id = register.std_id 
                                    JOIN course ON register.course_id = course.course_id 
                                    WHERE student.std_id = '5001100348'");
            $stmt->execute();
            echo "<table border='1px solid black'>";
            echo "<tr><th>รหัสวิชา</th><th>ชื่อวิชา</th><th>หน่วยกิต</th></tr>";
            while ($row = $stmt->fetch()) {
                echo "<tr><td>".$row["course_id"]."</td><td>".$row["title"]."</td><td>".$row["credit"]."</td></tr>";
            }
            echo "</table>";

            
            echo "<h2>รวมหน่วยกิตต่อคน Lab7_5</h2>";
            $stmt = $pdo->prepare("SELECT student.std_id, SUM(course.credit) AS total_credits 
                                    FROM student 
                                    JOIN register ON student.std_id = register.std_id 
                                    JOIN course ON register.course_id = course.course_id 
                                    GROUP BY student.std_id");
            $stmt->execute();
            echo "<table border='1px solid black'>";
            echo "<tr><th>รหัสนักเรียน</th><th>รวมหน่วยกิต</th></tr>";
            while ($row = $stmt->fetch()) {
                echo "<tr><td>".$row["std_id"]."</td><td>".$row["total_credits"]."</td></tr>";
            }
            echo "</table>";

    ?>
      </article>
      <nav id="menu">
        <h2>Navigation</h2>
        <ul class="menu">
          <li><a href="./home.php">Home</a></li>
          <li><a href="./product.php">Products</a></li>
          <li><a href="./product-list.php">Products List</a></li>
          <li><a href="./add-product.html">Add Product</a></li>
          <li><a href="./mpage1.php">Workshop 1</a></li>
          <li><a href="./mpage2.php">Workshop 1</a></li>
          <li><a href="./mpage4.php">Workshop 4</a></li>
          <li><a href="./mpage7.php">Workshop 7</a></li>
          <li><a href="./mpage9.php">Workshop 9</a></li>
          <li class="dead"><a>Lab 7</a></li>
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