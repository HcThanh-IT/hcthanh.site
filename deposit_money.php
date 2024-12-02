<?php 
  session_start();
  include "./ADMIN/includes/connect_database.php";
  include "./ADMIN/includes/account_user.php";

  $database = new database();
  $db = $database->connect();

  $account_users = new account_users($db);
  if (isset($_SESSION["user_ID"])) {
  $stmt_user_ID = $account_users->read_ID($_SESSION['user_ID']);
  $rows_user_ID = $stmt_user_ID->fetch(PDO::FETCH_ASSOC); 
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
          <?php if (isset($_SESSION["user_ID"])) { ?>
          <!-- ***** Details Start ***** -->
          <div class="game-details">
            <div class="row">
              <div class="col-lg-12">
                <h2>Nạp tiền tự động</h2>
              </div>
              <div class="col-lg-12">
                <div class="content">
                  <div class="row">
                    <div class="col-lg-4">
                    <img id="qrImage" src="https://img.vietqr.io/image/ACB-8357171-qr_only.jpg?amount=10000&addInfo=naptien%20<?php echo ($rows_user_ID['user_name']); ?>" alt="QR Code chuyển khoản" style="border-radius: 23px; margin-bottom: 30px;"/>
                    </div>
                    <div class="col-lg-6">
                      <label style="color: red;" for="">* Mã QR sẽ được tạo tự động khi bạn nhập số tiền</label>
                      <h6 class="mt-2">Số tiền nạp: </h6>
                      <!-- Input cho số tiền, khi thay đổi sẽ gọi hàm updateQRCode -->
                      <input type="number" min="10000" step="1000" value="10000" id="amount" name="amount" placeholder="Nhập số tiền" oninput="updateQRCode()">
                      <label style="color: red;" for="">* Tối thiểu là 10000đ</label>
                      <h6 class="mt-2">Nội dung chuyển khoản: </h6>
                      <input type="text" name="user_name" id="user_name" value="naptien <?php echo ($rows_user_ID['user_name']); ?>" disabled>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- ***** Details End ***** -->
          <?php } 
          else {
          ?>
          <div class="col-lg-12">
            <div class="heading-section">
                <h4>Vui lòng <em><a href="./login.php">đăng nhập</a></em> để xem nạp tiền</h4>
            </div>
          </div>
          <?php } ?>
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
