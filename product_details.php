<?php 
  session_start();
  include "./ADMIN/includes/connect_database.php";
  include "./ADMIN/includes/account_user.php";
  include "./ADMIN/includes/products.php";
  include "./ADMIN/includes/purchase_history.php";

  $database = new database();
  $db = $database->connect();

  $account_users = new account_users($db);
  $stmt_user_ID = $account_users->read_ID($_SESSION['user_ID']);
  $rows_user_ID = $stmt_user_ID->fetch(PDO::FETCH_ASSOC); 

  $products = new products($db);
  $stmt_products = $products->read_ID($_GET['details']);
  $rows_product_ID = $stmt_products->fetch(PDO::FETCH_ASSOC); 

  $purchase_history = new purchase_history($db);
  $stmt_purchase_history = $purchase_history->count_product($_GET['details']);
  $row_purchase_history = $stmt_purchase_history->fetch(PDO::FETCH_ASSOC); 

  $products->add_view($_GET['details']);
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
          <!-- ***** Details Start ***** -->
          <div class="game-details">
            <div class="row">
              <div class="col-lg-12">
                <h2>Chi tiết sản phẩm</h2>
              </div>
              <div class="col-lg-12">
                <div class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 style="text-align: center; margin-bottom:15px;"><?php echo $rows_product_ID['product_name']; ?></h4>
                    </div>
                </div>

                  <div class="row">
                    <div class="col-lg-12">
                      
                      <div class="left-info">
                        <div class="left">
                          <h4>Lượt xem :</h4>
                          <span>Lượt tải xuống:</span>
                        </div>
                        <ul>
                          <li><i class="fa fa-eye"></i> <?php echo $rows_product_ID['product_view']; ?></li>
                          <li><i class="fa fa-download"></i> <?php echo $row_purchase_history['LuotTai']; ?></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <img src="https://cdn-thumbs.imagevenue.com/76/6b/56/ME19HUHI_t.jpg" alt="" style="border-radius: 23px; margin-bottom: 30px;">
                    </div>
                    <div class="col-lg-4">
                      <img src="assets/images/details-02.jpg" alt="" style="border-radius: 23px; margin-bottom: 30px;">
                    </div>
                    <div class="col-lg-4">
                      <img src="assets/images/details-03.jpg" alt="" style="border-radius: 23px; margin-bottom: 30px;">
                    </div>
                    <div class="col-lg-12">
                      <p>Cyborg Gaming is free HTML CSS website template provided by TemplateMo. This is Bootstrap v5.2.0 layout. You can make a <a href="https://paypal.me/templatemo" target="_blank">small contribution via PayPal</a> to info [at] templatemo.com and thank you for supporting. If you want to get the PSD source files, please contact us. Lorem ipsum dolor sit consectetur es dispic dipiscingei elit, sed doers eiusmod lisum hored tempor.</p>
                    </div>
                    <div class="col-lg-12">
                      <div class="main-border-button">
                        <a href="#">Thêm vào giỏ hàng</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- ***** Details End ***** -->
        </div>
      </div>
    </div>
  </div>
  
  <?php include './includes/footer.php'?>


  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script>
    // Hàm để cập nhật mã QR khi người dùng nhập số tiền
    function updateQRCode() {
        // Lấy giá trị số tiền từ input
        var amount = document.getElementById("amount").value;
        var content = "naptien%20HcThanh03"; // Nội dung chuyển khoản cố định
        // Kiểm tra nếu người dùng nhập số tiền
        if (amount) {
            // Cập nhật URL mã QR
            var qrUrl = "https://img.vietqr.io/image/ACB-8357171-qr_only.jpg?amount=" + amount + "&addInfo=" + content;
            // Thay đổi thuộc tính src của hình ảnh mã QR
            document.getElementById("qrImage").src = qrUrl;
        }
    }
</script>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/tabs.js"></script>
  <script src="assets/js/popup.js"></script>
  <script src="assets/js/custom.js"></script>


  </body>

</html>
