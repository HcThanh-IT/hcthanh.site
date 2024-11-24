<?php 
  session_start();
  include ".\ADMIN\includes\connect_database.php";
  include ".\ADMIN\includes\products.php";
  include ".\ADMIN\includes\account_user.php";
  include ".\ADMIN\includes\cart.php";

  $database = new database;
  $db = $database->connect();

  $products = new products($db);
  $stmt_products = $products->read_all();
  
  $account_users = new account_users($db);

  $cart = new cart($db);

  if (isset($_SESSION['user_ID'])) {
    // Lấy thông tin người dùng từ session
    $stmt_user_ID = $account_users->read_ID($_SESSION['user_ID']);
    $rows_user_ID = $stmt_user_ID->fetch(PDO::FETCH_ASSOC);
}

if (isset($_GET['add_cart'])) {
    // Kiểm tra nếu người dùng đã đăng nhập
    if (isset($_SESSION['user_ID'])) {
        // Kiểm tra và xác nhận giá trị 'add_cart' (ví dụ: đảm bảo là số nguyên và hợp lệ)
        $product_ID = intval($_GET['add_cart']);
        
        if ($product_ID > 0) {
            // Thêm sản phẩm vào giỏ hàng
            if ($cart->add_cart($product_ID, $_SESSION['user_ID'])) {
                // Chuyển hướng sau khi thêm thành công
                header("location: cart.php");
                exit(); // Dừng script sau khi chuyển hướng
            } else {
                echo "Có lỗi khi thêm sản phẩm vào giỏ hàng.";
            }
        } else {
            echo "ID sản phẩm không hợp lệ.";
        }
    } else {
        echo "Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng.";
    }
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

          <!-- ***** Banner Start ***** -->
          <div class="main-banner">
            <div class="row">
              <div class="col-lg-7">
                <div class="header-text">
                </div>
              </div>
            </div>
          </div>
          <!-- ***** Banner End ***** -->

          <!-- ***** Most Popular Start ***** -->
          <div class="most-popular">
            
          </div>
          <!-- ***** Most Popular End ***** -->
            <!-- ***** Live Stream Start ***** -->
          <div class="live-stream">
            <div class="col-lg-12">
              <div class="heading-section">
                <h4><em>Most Popular</em> Live Stream</h4>
              </div>
            </div>
            <div class="row">
            <?php 
                while ($row_products = $stmt_products->fetch()) {
            ?>
              <div class="col-lg-3 col-sm-6">
                <div class="item">
                  <div class="thumb">
                    <img src="./ADMIN/uploads/image/<?php echo $row_products['product_image'] ?>" alt="">
                    <div class="hover-effect">
                      <div class="content">
                        <div class="live">
                        <a href="#"><i class="fa fa-eye"></i> <?php echo $row_products['product_view'] ?></a>
                        </div>
                        <ul>
                          <li><a href="?add_cart=<?php echo $row_products['product_ID'] ?>"><i class="fa fa-cart-plus""></i></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="down-content">
                    <div class="avatar">
                      <!-- <img src="assets/images/avatar-01.jpg" alt="" style="max-width: 46px; border-radius: 50%; float: left;"> -->
                    </div>
                    <span><i class="fa fa-check"></i> HcThanh</span>
                    <h4><?php echo $row_products['product_name'] ?></h4>
                  </div> 
                </div>
              </div>
            <?php
            }
            ?>
              <div class="col-lg-12">
                <div class="main-button">
                  <a href="streams.html">Load More Streams</a>
                </div>
              </div>
            </div>
          </div>
          <!-- ***** Live Stream End ***** -->

          <!-- ***** Gaming Library Start ***** -->
          <div class="gaming-library">
            <div class="col-lg-12">
              <div class="heading-section">
                <h4><em>Your Gaming</em> Library</h4>
              </div>
              <div class="item">
                <ul>
                  <li><img src="assets/images/game-01.jpg" alt="" class="templatemo-item"></li>
                  <li><h4>Dota 2</h4><span>Sandbox</span></li>
                  <li><h4>Date Added</h4><span>24/08/2036</span></li>
                  <li><h4>Hours Played</h4><span>634 H 22 Mins</span></li>
                  <li><h4>Currently</h4><span>Downloaded</span></li>
                  <li><div class="main-border-button border-no-active"><a href="#">Donwloaded</a></div></li>
                </ul>
              </div>
              <div class="item">
                <ul>
                  <li><img src="assets/images/game-02.jpg" alt="" class="templatemo-item"></li>
                  <li><h4>Fortnite</h4><span>Sandbox</span></li>
                  <li><h4>Date Added</h4><span>22/06/2036</span></li>
                  <li><h4>Hours Played</h4><span>740 H 52 Mins</span></li>
                  <li><h4>Currently</h4><span>Downloaded</span></li>
                  <li><div class="main-border-button"><a href="#">Donwload</a></div></li>
                </ul>
              </div>
              <div class="item last-item">
                <ul>
                  <li><img src="assets/images/game-03.jpg" alt="" class="templatemo-item"></li>
                  <li><h4>CS-GO</h4><span>Sandbox</span></li>
                  <li><h4>Date Added</h4><span>21/04/2036</span></li>
                  <li><h4>Hours Played</h4><span>892 H 14 Mins</span></li>
                  <li><h4>Currently</h4><span>Downloaded</span></li>
                  <li><div class="main-border-button border-no-active"><a href="#">Donwloaded</a></div></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="main-button">
                <a href="profile.html">View Your Library</a>
              </div>
            </div>
          </div>
          <!-- ***** Gaming Library End ***** -->
        </div>
      </div>
    </div>
  </div>
  
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
