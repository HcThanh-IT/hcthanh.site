<?php 
  session_start();
  include ".\ADMIN\includes\connect_database.php";
  include ".\ADMIN\includes\account_user.php";
  include ".\ADMIN\includes\purchase_history.php";
  include ".\ADMIN\includes\products.php";

  $database = new database();
  $db = $database->connect();

  $account_users = new account_users($db);
  $stmt_user_ID = $account_users->read_ID($_SESSION['user_ID']);
  $rows_user_ID = $stmt_user_ID->fetch(PDO::FETCH_ASSOC); 

  $products = new products($db);
  $stmt_products = $products->read_all();

  $purchase_history = new purchase_history($db);
  $purchase_history_user_ID = $purchase_history->user_ID($_SESSION['user_ID']);
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Cyborg - Awesome HTML5 Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-cyborg-gaming.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
<!--

TemplateMo 579 Cyborg Gaming

https://templatemo.com/tm-579-cyborg-gaming

-->
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
          <div class="row">
            <div class="col-lg-12">
              <div class="main-profile ">
                <div class="row">
                  <div class="col-lg-4">
                    <img src="./assets/images/avt_user.svg" alt="" style="border-radius: 23px;">
                  </div>
                  <div class="col-lg-4 align-self-center">
                    <div class="main-info header-text">
                      <span>#<?php echo ($rows_user_ID['user_ID']); ?></span>
                      <h4><?php echo ($rows_user_ID['user_name']); ?></h4>
                      <p>You Haven't Gone Live yet. Go Live By Touching The Button Below.</p>
                      <div class="main-border-button">
                        <a href="#">Đăng xuất</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 align-self-center">
                    <ul>
                      <li>ID: <span>#<?php echo ($rows_user_ID['user_ID']); ?></span></li>
                      <li>Email: <span><?php echo ($rows_user_ID['user_email']); ?></span></li>
                      <li>Số dư: <span><?php echo ($rows_user_ID['user_balance']); ?>đ</span></li>
                      <li>Ngày tạo: <span><?php echo ($rows_user_ID['user_date_created']); ?></span></li>
                    </ul>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
          <!-- ***** Banner End ***** -->

          <!-- ***** Gaming Library Start ***** -->
          <div class="gaming-library profile-library">
            <div class="col-lg-12">
              <div class="heading-section">
                <h4><em>Lịch sử</em> mua hàng</h4>
              </div>
              <div class="item">
                <ul>
                  <li><h4>STT</h4></li>
                  <li><h4>Hình ảnh</h4></li>
                  <li><h4>Tên sản phẩm</h4></li>
                  <li><h4>Mã kích hoạt</h4></li>
                  <li><h4>Thao tác</h4></li>
                </ul>
              </div>
              <?php

                // Lấy tất cả sản phẩm trước để không phải gọi fetch() trong vòng lặp lồng nhau
                $products = [];
                while ($row_products = $stmt_products->fetch()) {
                    $products[$row_products['product_ID']] = $row_products; // Lưu trữ các sản phẩm trong mảng theo ID sản phẩm
                }
                $num = 1;
                // Lặp qua giỏ hàng và tính tổng giá
                while ($rows_purchase_history_user_ID = $purchase_history_user_ID->fetch()) {
                  // Số thứ tự sản phẩm
                  $product_ID = $rows_purchase_history_user_ID['product_ID'];

                // Kiểm tra xem sản phẩm có tồn tại trong mảng $products không
                if (isset($products[$product_ID])) {
                    $product = $products[$product_ID];

                    ?>
                    <div class="item">
                        <ul>
                            <li><h4><?php echo $num; ?></h4></li>
                            <li><img src="./ADMIN/uploads/image/<?php echo $product['product_image']; ?>" alt=""></li>
                            <li><h4><?php echo $product['product_name']; ?></h4></li>
                            <li><h4><?php echo $rows_purchase_history_user_ID['product_code']; ?></h4></li>

                            <?php 
                            // So sánh điều kiện thay vì gán
                            if ($rows_purchase_history_user_ID['active'] == '1') { ?>
                                <li><div class="main-border-button"><a href="<?php echo $product['product_link']; ?>">Chi tiết</a></div></li>
                            <?php } 
                            // So sánh điều kiện thay vì gán
                            if ($rows_purchase_history_user_ID['active'] == '0') { ?>
                                <li><div class="main-button"><a href="#">Kích hoạt</a></div></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php
                }
                $num++; // Tăng số thứ tự lên 1
                }
                ?>


              <!-- <div class="item">
                <ul>
                  <li><img src="assets/images/game-02.jpg" alt="" class="templatemo-item"></li>
                  <li><h4>Fortnite</h4><span>Sandbox</span></li>
                  <li><h4>Date Added</h4><span>22/06/2036</span></li>
                  <li><h4>Hours Played</h4><span>745 H 22 Mins</span></li>
                  <li><h4>Currently</h4><span>Downloaded</span></li>
                  <li><div class="main-border-button"><a href="product_details.php">Chi tiết</a></div></li>
                </ul>
              </div>
              <div class="item last-item">
                <ul>
                  <li><img src="assets/images/game-03.jpg" alt="" class="templatemo-item"></li>
                  <li><h4>CS-GO</h4><span>Sandbox</span></li>
                  <li><h4>Date Added</h4><span>21/04/2022</span></li>
                  <li><h4>Hours Played</h4><span>632 H 46 Mins</span></li>
                  <li><h4>Currently</h4><span>Downloaded</span></li>
                  <li><div class="main-button"><a href="#">Kích hoạt</a></div></li>
                </ul>
              </div> -->
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
