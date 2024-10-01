<?php include "connect.php";?>
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
        article {
          justify-content: center; 
          display: flex;
        }
        .product-pic {
          margin-top: 30px;
          margin-right: 20px;
        }
        .detail {
          text-align: left; 
          margin-left: 20px;
          font-size: 18px;
        }
    </style>

	<script>
		function update(pid) {
			var qty = document.getElementById(pid).value;
			document.location = "cart.php?action=update&pid=" + pid + "&qty=" + qty; 
		}
	</script>
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
      <article >
	  <?php
			session_start();
			// เพิ่มสินค้า
			if ($_GET["action"]=="add") {

				$pid = $_GET['pid'];

				$cart_item = array(
					'pid' => $pid,
					'pname' => $_GET['pname'],
					'price' => $_GET['price'],
					'qty' => $_POST['qty'],
					'remaining' => $_POST['remaining']
				);

				if(empty($_SESSION['cart']))
					$_SESSION['cart'] = array();
			
				if(array_key_exists($pid, $_SESSION['cart']))
					$_SESSION['cart'][$pid]['qty'] += $_POST['qty'];
			
				// หากยังไม่เคยเลือกสินค้นนั้นจะ
				else
					$_SESSION['cart'][$pid] = $cart_item;

			// ปรับปรุงจำนวนสินค้า
			} else if ($_GET["action"]=="update") {
				$pid = $_GET["pid"];     
				$qty = $_GET["qty"];
				$_SESSION['cart'][$pid]['qty'] = $qty;

			// ลบสินค้า
			} else if ($_GET["action"]=="delete") {
				
				$pid = $_GET['pid'];
				unset($_SESSION['cart'][$pid]);
			}
		?>
	  	<form>
			<table border="1">
			<?php 
				$sum = 0;
				foreach ($_SESSION["cart"] as $item) {
					$sum += $item["price"] * $item["qty"];
			?>
				<tr>
					<td><?=$item["pname"]?></td>
					<td><?=$item["price"]?></td>
					<td>			
						<input type="number" id="<?=$item["pid"]?>" value="<?=$item["qty"]?>" min="1" max="<?=$item["remaining"]?>">
						<a href="#" onclick="update(<?=$item['pid']?>)">แก้ไข</a>
						<a href="?action=delete&pid=<?=$item["pid"]?>">ลบ</a>
					</td>
				</tr>
			<?php } ?>
			<tr><td colspan="3" align="right">รวม <?=$sum?> บาท</td></tr>
			</table>
		</form>

		<a href="index.php">< เลือกสินค้าต่อ</a>
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