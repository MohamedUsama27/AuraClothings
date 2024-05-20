<?php
include("../connection.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);


if(!empty($_SESSION["id"])){
    $id = $_SESSION["id"];
    $result = mysqli_query($con, "SELECT * FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
}
else{
    header("Location: ../login/index.php");
}


			$select_rows = mysqli_query($con, "SELECT * FROM `order`") or die('query failed');
			$row_count = mysqli_num_rows($select_rows);

			$results = mysqli_query($con, "SELECT SUM(total_price) AS total_sales FROM `order`") or die(mysqli_error());

			$rows = mysqli_fetch_assoc($results);
			$total_sales = $rows['total_sales'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="adminstyle.css">
    <title>AURA_AdminPanel</title>
</head>
<body>
	<section id="sidebar">
		<a href="#" class="brand">
        <img src="image/logo.PNG" class="logo" alt="" >
			<span class="text">AdminPanel</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="#">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="addproduct.php">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">Add Products</span>
				</a>
			</li>
			<li>
				<a href="products.php">
					<i class="fa-solid fa-bars-progress"></i>
					<span class="text">Manage Products</span>
				</a>
			</li>
			<li>
				<a href="manageorder.php">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Manage Orders</span>
				</a>
			</li>
			<li>
				<a href="feedback.php">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">Feedbacks</span>
				</a>
			</li>
			<li>
				<a href="newsletter.php">
					<i class='bx bxs-envelope'></i>
					<span class="text">Newsletter</span>
				</a>
			</li>
			
		</ul>
		<ul class="side-menu">
			
			<li>
				<a href="../login/logout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>


	<section id="content">

                <!-- ----------------- Navbar start----------------- -->

		<nav>
			<i class='bx bx-menu' ></i>
			
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
			<a href="#" class="profile">
				<img src="image/tony.png">
			</a>
		</nav>
                <!-- ----------------- Navbar end----------------- -->

                <!-- ----------------- Main Start----------------- -->
        <main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
			
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3><?php echo $row_count; ?></h3>
						<p>New Order</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3>23</h3>
						<p>Users</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle'></i>
					<span class="text">
					<h3><?php echo number_format($total_sales); ?></h3>
						<p>Total Sales</p>
					</span>
    			</li>
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Recent Orders</h3>
					</div>
					<table>
						<thead>
							<tr>
								<th>User</th>
								<th>Order Amount</th>
								<th>Status</th>
							</tr>
						</thead>

						<?php
      
							$select_products = mysqli_query($con, "SELECT * FROM `order` ORDER BY id DESC LIMIT 4");
							if(mysqli_num_rows($select_products) > 0){
								while($fetch_product = mysqli_fetch_assoc($select_products)){
						?>

						<tbody>
							<tr>
								<td>
									<img src="image/tony.png">
									<p><?php echo $fetch_product['name']; ?></p>
								</td>
								<td><?php echo $fetch_product['total_price']; ?></td>
								<td><span class="status pending">Pending</span></td>
							</tr>
						</tbody>

						<?php
							};
						  };
						?>

					</table>
				</div>

				<div class="todo">
					<div class="head">
						<h3>Feedbacks</h3>
					</div>

					<ul class="todo-list">
					<?php
						$select_products = mysqli_query($con, "SELECT * FROM `feedback` ORDER BY id DESC LIMIT 7 ");
						if(mysqli_num_rows($select_products) > 0){
							while($fetch_product = mysqli_fetch_assoc($select_products)){
					?>
						<li>
							<p><?php echo $fetch_product['message']; ?>t</p>
							<i class='bx bxs-message-square-dots' ></i>
						</li>

						<?php
							}
						}
					?>

					</ul>
				</div>
			</div>
		</main>
                <!-- ----------------- Main End ----------------- -->
    </section>

    <script src="script.js"></script>
</body>
</html>