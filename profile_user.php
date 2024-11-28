<?php 
  session_start();
  include "./ADMIN/includes/connect_database.php";
  include "./ADMIN/includes/account_user.php";
  include "./ADMIN/includes/purchase_history.php";
  include "./ADMIN/includes/products.php";

  $database = new database();
  $db = $database->connect();

  $account_users = new account_users($db);
  $stmt_user_ID = $account_users->read_ID($_SESSION['user_ID']);
  $rows_user_ID = $stmt_user_ID->fetch(PDO::FETCH_ASSOC); 

  $products = new products($db);
  $stmt_products = $products->read_all();

  $purchase_history = new purchase_history($db);
  $purchase_history_user_ID = $purchase_history->user_ID($_SESSION['user_ID']);

  if($_SERVER['REQUEST_METHOD']=='POST'){

    if ($purchase_history->update_active($_REQUEST['check_user_ID'],$_REQUEST['check_product_ID'],$_REQUEST['check_product_code'])) {
        header("location: profile_user.php");
    }

}
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
                      <span>Thông tin cá nhân</span>
                      <h4><?php echo ($rows_user_ID['user_name']); ?></h4>
                      
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
                  <div class="col-lg-4 align-self-center">
                    <div class="main-info header-text">
                      
                      <div class="main-border-button">
                        <a href="logout.php">Đăng xuất</a>
                      </div>
                    </div>
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
                  <li><h4>Tên sản phẩm</h4> <span>Mã kích hoạt</span></li>
                  <!-- <li><h4>Tên sản phẩm</h4></li> -->
                  <!-- <li><h4>Mã kích hoạt</h4></li> -->
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
                            <li><h4><?php echo $product['product_name']; ?></h4> <span><?php echo $rows_purchase_history_user_ID['product_code']; ?></span></li>
                            <!-- <li><h4><?php echo $product['product_name']; ?></h4></li>
                            <li><h4><?php echo $rows_purchase_history_user_ID['product_code']; ?></h4></li> -->

                            <?php 
                            // So sánh điều kiện thay vì gán
                            if ($rows_purchase_history_user_ID['active'] == '1') { ?>
                                <li><div class="main-border-button"><a href="<?php echo $product['product_link']; ?>">Chi tiết</a></div></li>
                            <?php } 
                            // So sánh điều kiện thay vì gán
                            if ($rows_purchase_history_user_ID['active'] == '0') { ?>
                                <li><div class="main-button"> <a href="#" data-bs-toggle="modal" data-bs-target="#active<?php echo $rows_purchase_history_user_ID['purchase_history_ID']; ?>">Kích hoạt</a></div></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="modal fade" id="active<?php echo $rows_purchase_history_user_ID['purchase_history_ID']; ?>" tabindex="-1" aria-labelledby="activationModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                      <form action="" method="POST">
                        <div class="modal-header">
                          <h5 class="modal-title" id="activationModalLabel" style="color: #ec6090;">Kích hoạt sản phẩm</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          Bạn có chắc chắn muốn kích hoạt sản phẩm này không?
                          <input type="text" name="check_product_code" class="form-control" id="recipient-name">
                          <input type="text" name="check_product_ID" class="form-control" id="recipient-name" value="<?php echo $rows_purchase_history_user_ID['product_ID']; ?>">
                          <input type="text" name="check_user_ID" class="form-control" id="recipient-name" value="<?php echo $rows_purchase_history_user_ID['user_ID']; ?>">
                        </div>
                        <div class="modal-footer">
                          
                          
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                          <button type="submit" class="btn btn-primary" id="confirmActivationButton">Xác nhận</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                    <?php
                }
                $num++; // Tăng số thứ tự lên 1
                }
                ?>

            <!-- Modal -->
                  
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
