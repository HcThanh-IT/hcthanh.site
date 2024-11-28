<?php 
  session_start();
  include "./ADMIN/includes/connect_database.php";
  include "./ADMIN/includes/products.php";
  include "./ADMIN/includes/account_user.php";
  include "./ADMIN/includes/cart.php";
  
  $database = new database;
  $db = $database->connect();

  $products = new products($db);
  $stmt_products = $products->read_all();
  
  $account_users = new account_users($db);

  $cart = new cart($db);

  if (isset($_SESSION['user_ID'])) {
  $stmt_user_ID = $account_users->read_ID($_SESSION['user_ID']);
  $rows_user_ID = $stmt_user_ID->fetch(PDO::FETCH_ASSOC);

  $stmt_cart_ID = $cart->cart_ID($_SESSION['user_ID']);
  }
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Website cung cấp source code miễn phí và có phí.">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>HcThanh</title>
    <link rel="icon" href="assets/images/logoHT.png" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-cyborg-gaming.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@latest"></script>
  </head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
  <?php include './includes/header.php'?>
  <!-- ***** Header Area End ***** -->

  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-content">

          <!-- ***** Gaming Library Start ***** -->
          <div class="gaming-library">
            <form action="">
              <?php 
                if (isset($_SESSION['user_ID'])) {
                  ?>
            <div class="col-lg-12">
    <div class="heading-section">
        <h4><em>Giỏ hàng</em></h4>
    </div>

    <?php
    // Biến để lưu tổng giá trị giỏ hàng
    $total_price = 0;

    // Lấy tất cả sản phẩm trước để không phải gọi fetch() trong vòng lặp lồng nhau
    $products = [];
    while ($row_products = $stmt_products->fetch()) {
        $products[$row_products['product_ID']] = $row_products; // Lưu trữ các sản phẩm trong mảng theo ID sản phẩm
    }

    // Lặp qua giỏ hàng và tính tổng giá
    while ($rows_cart_ID = $stmt_cart_ID->fetch()) {
        $product_ID = $rows_cart_ID['product_ID'];

        // Kiểm tra xem sản phẩm có tồn tại trong mảng $products không
        if (isset($products[$product_ID])) {
            $product = $products[$product_ID];

            // Cộng giá trị sản phẩm vào tổng
            $total_price += $product['product_price'];  // Giả sử giá sản phẩm là số, nếu có đơn vị tiền tệ, bạn có thể xử lý thêm

            ?>
            <div class="item">
                <ul>
                    <li><img src="./ADMIN/uploads/image/<?php echo $product['product_image']; ?>" alt=""></li>
                    <li><h4><?php echo $product['product_name']; ?></h4></li>
                    <li><h4><?php echo number_format($product['product_price'], 0, ',', '.'); ?> đ</h4></li> <!-- Hiển thị giá sản phẩm -->
                    <li><h4>Hours Played</h4></li>
                    <li><h4>Currently</h4></li>
                </ul>
            </div>
            <?php
        }
    }
    ?>

    <!-- Hiển thị tổng giá tiền -->
    <div class="total-price">
        <h4>Tổng tiền : <strong><?php echo number_format($total_price, 0, ',', '.'); ?> đ</strong></h4>
    </div>
</div>

              <div class="col-lg-12">
                <div class="main-button">
                  <a href="">Thanh toán</a>
                </div>
              </div>
            </form>
          </div>
          <!-- ***** Gaming Library End ***** -->
        </div>
      </div>
    </div>
  </div>
  <?php } else{
  ?>
  <div class="col-lg-12">
    <div class="heading-section">
        <h4>Vui lòng <em><a href="./login.php">đăng nhập</a></em> để xem giỏ hàng</h4>
    </div>
  </div>
  <?php }?>
  <?php include './includes/footer.php'?>


  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/tabs.js"></script>
  <script src="assets/js/popup.js"></script>
  <script src="assets/js/custom.js"></script>


  </body>

</html>
