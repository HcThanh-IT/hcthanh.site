<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="./index.php" class="logo">
                        <img src="./assets/images/logo.png" alt="">
                         <!-- <h1 style="color: #ec6090;">HcThanh</h1> -->
                    </a>
                    
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="./index.php" class="active">Trang chủ</a></li>
                        <li><a href="./deposit_money.php">Nạp tiền</a></li>
                        <li><a href="./cart.php">Giỏ hàng</a></li>
                        <?php 
                        if (isset($_SESSION['user_ID'])) {
                            // Nếu người dùng đã đăng nhập
                            echo '<li><a href="./profile_user.php">' . $rows_user_ID['user_name'] . ' - ' . number_format($rows_user_ID['user_balance'], 0, ',', '.') . 'đ<img src="./assets/images/avt_user.svg" alt=""></a></li>';

                        } else {
                            // Nếu người dùng chưa đăng nhập
                            echo '<li><a href="./login.php">Đăng nhập</a></li>';
                        }
?>

                    </ul>   
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>
  <?php 

//   echo "<pre style='color: white; background-color: black;'>";  // Thiết lập chữ màu trắng, nền đen
//   print_r($_SESSION);  // In ra tất cả dữ liệu trong $_POST
//   echo "</pre>";

  if (isset($_GET['error']) && $_GET['error'] == 1) {
    echo "
        <script type='text/javascript'>
            Swal.fire({
                icon: 'error',
                title: 'Lỗi đăng nhập!',
                text: 'Kiểm tra lại tên người dùng hoặc mật khẩu!',
                confirmButtonText: 'Đóng'
            });
        </script>
    ";
}
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo "
        <script type='text/javascript'>
            Swal.fire({
                icon: 'success',
                title: 'Đăng nhập thành công!',
                text: 'Chào mừng bạn đến với hệ thống!',
                confirmButtonText: 'Đóng'
            });
        </script>

    ";
}
?>