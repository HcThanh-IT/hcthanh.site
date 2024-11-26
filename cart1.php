<?php 
  session_start();
  include ".\ADMIN\includes\connect_database.php";
  include ".\ADMIN\includes\products.php";
  include ".\ADMIN\includes\account_user.php";
  include ".\ADMIN\includes\cart.php";
  include ".\ADMIN\includes\purchase_history.php";

  $database = new database;
  $db = $database->connect(); // Kết nối với database

  $products = new products($db);
  $stmt_products = $products->read_all();
  
  $account_users = new account_users($db);

  $cart = new cart($db);

  $purchase_history = new purchase_history($db);

  if (isset($_SESSION['user_ID'])) {
    $stmt_user_ID = $account_users->read_ID($_SESSION['user_ID']);
    $rows_user_ID = $stmt_user_ID->fetch(PDO::FETCH_ASSOC);

    $stmt_cart_ID = $cart->cart_ID($_SESSION['user_ID']);
  }
  if (isset($_GET['cart_item'])) {
    if (isset($_SESSION['user_ID'])) {
        $cart_item_ID = intval($_GET['cart_item']);
        if ($cart_item_ID > 0) {
            if ($cart->delete_cart_item($cart_item_ID)) {
                // Chuyển hướng sau khi thêm thành công
                header("location: cart1.php");
                exit(); // Dừng script sau khi chuyển hướng
            } else {
                echo "Có lỗi khi xóa sản phẩm giỏ hàng.";
            }
        } else {
            echo "ID sản phẩm không hợp lệ.";
        }
    } else {
        echo "Vui lòng đăng nhập để xóa sản phẩm giỏ hàng.";
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
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

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
            <form action="" method="POST">
                <?php
                if (isset($_SESSION['user_ID'])) {
                    ?>
                    <div class="col-lg-12">
                        <div class="heading-section">
                            <h4><em>Giỏ hàng</em></h4>
                        </div>
                        <div class="item">
                                  <ul>
                                    <li><h4 style="color:#e75e8d">STT</h4></li>
                                    <li><h4 style="color:#e75e8d">Hình ảnh</h4></li>
                                    <li><h4 style="color:#e75e8d">Tên sản phẩm</h4></li>
                                    <li><h4 style="color:#e75e8d">Giá</h4></li>
                                    <li><h4 style="color:#e75e8d">Mã kích hoạt</h4></li>
                                    <li><h4 style="color:#e75e8d">Xóa</h4></li>
                                  </ul>
                              </div>

                        <?php
                        // Biến để lưu tổng giá trị giỏ hàng
                        $total_price = 0;

                        // Lấy tất cả sản phẩm trước để không phải gọi fetch() trong vòng lặp lồng nhau
                        $products = [];
                        while ($row_products = $stmt_products->fetch()) {
                            $products[$row_products['product_ID']] = $row_products; // Lưu trữ các sản phẩm trong mảng theo ID sản phẩm
                        }
                        $num = 1;
                        // Lặp qua giỏ hàng và tính tổng giá
                        while ($rows_cart_ID = $stmt_cart_ID->fetch()) {
                           // Số thứ tự sản phẩm
                          $product_ID = $rows_cart_ID['product_ID'];
                      
                          // Kiểm tra xem sản phẩm có tồn tại trong mảng $products không
                          if (isset($products[$product_ID])) {
                              $product = $products[$product_ID];
                      
                              // Cộng giá trị sản phẩm vào tổng
                              $total_price += $product['product_price'] ; // Cộng tổng giá theo số lượng
                      
                              ?>
                              <div class="item">
                                  <ul>
                                      <li><h4><?php echo $num; ?></h4></li>
                                      <li><img src="./ADMIN/uploads/image/<?php echo $product['product_image']; ?>" alt=""></li>
                                      <li><h4><?php echo $product['product_name']; ?></h4></li>
                                      <li><h4><?php echo number_format($product['product_price'], 0, ',', '.'); ?> đ</h4></li>
                                      <li><h4><?php echo $rows_cart_ID['product_code']?></h4></li>
                                      <li> <a href="?cart_item=<?php echo $rows_cart_ID['cart_temp_ID']?>"><i class="fa fa-trash"></i></a></li>
                                  </ul>
                              </div>
                              <?php
                          }
                          $num++; // Tăng số thứ tự lên 1
                      }
                    ?>

                        <!-- Hiển thị tổng giá tiền -->
                        <div class="total-price">
                            <h4>Tổng tiền : <strong><?php echo number_format($total_price, 0, ',', '.'); ?> đ</strong></h4>
                        </div>
                    </div>

                    <!-- Kiểm tra và thực hiện thanh toán -->
                    <?php
                    // Lấy số dư tài khoản của người dùng
                    $user_ID = $_SESSION['user_ID'];
                    $stmt_balance = $db->prepare("SELECT user_balance FROM account_users WHERE user_ID = :user_ID");
                    $stmt_balance->execute(['user_ID' => $user_ID]);
                    $user_balance = $stmt_balance->fetchColumn();

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                      if ($user_balance >= $total_price) {
                          try {
                              // Bắt đầu giao dịch
                              $db->beginTransaction();
                  
                              // Lặp qua giỏ hàng và thêm vào purchase_history
                              $stmt_cart_ID->execute();
                              while ($rows_cart_ID = $stmt_cart_ID->fetch(PDO::FETCH_ASSOC)) {
                                  $product_ID = $rows_cart_ID['product_ID'];
                                  $product_code = $rows_cart_ID['product_code'];
                  
                                  if (isset($products[$product_ID])) {
                                      if (!$purchase_history->add_purchase_history($product_ID, $user_ID, $product_code)) {
                                          throw new Exception("Không thể thêm sản phẩm {$product_ID} vào lịch sử mua hàng.");
                                      }
                                  } else {
                                      throw new Exception("Sản phẩm không tồn tại: {$product_ID}.");
                                  }
                              }
                  
                              // Xóa giỏ hàng
                              $stmt_delete = $db->prepare("DELETE FROM cart_temp WHERE user_ID = :user_ID");
                              $stmt_delete->execute(['user_ID' => $user_ID]);
                  
                              // Cập nhật số dư
                              $new_balance = $user_balance - $total_price;
                              $stmt_update_balance = $db->prepare("UPDATE account_users SET user_balance = :user_balance WHERE user_ID = :user_ID");
                              $stmt_update_balance->execute(['user_balance' => $new_balance, 'user_ID' => $user_ID]);
                  
                              // Cam kết giao dịch
                              $db->commit();
                  
                              // Thông báo thành công
                              echo "<script>alert('Thanh toán thành công!'); window.location.href = 'success.php';</script>";
                          } catch (Exception $e) {
                              // Rollback và ghi log lỗi
                              $db->rollBack();
                              error_log($e->getMessage());
                              echo "<script>alert('Có lỗi xảy ra trong quá trình thanh toán. Vui lòng thử lại.');</script>";
                          }
                      } else {
                          echo "<script>alert('Số dư tài khoản không đủ để thanh toán.'); window.location.href = 'cart.php';</script>";
                      }
                    } 
                      
                    ?>

                    <div class="col-lg-12">
                        <div class="main-button">
                          <a href="profile.html"><button style="border:none;background-color: #e75e8d;" type="submit">Thanh toán</button></a>
                            
                        </div>
                    </div>
                </form>
            </div>

          </div>
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
  <?php } ?>
  <?php include './includes/footer.php' ?>


  <!-- Scripts -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/tabs.js"></script>
  <script src="assets/js/popup.js"></script>
  <script src="assets/js/custom.js"></script>

</body>

</html>
