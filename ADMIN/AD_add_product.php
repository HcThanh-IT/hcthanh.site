<?php
    include "./includes/connect_database.php";
    include "./includes/categories.php";
    include "./includes/products.php";

    $database = new database;
    $db = $database->connect();

    $categories = new categories($db);
    $stmt_categories = $categories->read_all();

    $product = new products($db);

    function generateProductCode($length = 6) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; // Các ký tự có thể có
        $charactersLength = strlen($characters);
        $randomCode = ''; // Biến chứa mã sản phẩm
    
        for ($i = 0; $i < $length; $i++) {
            $randomCode .= $characters[rand(0, $charactersLength - 1)]; // Chọn ngẫu nhiên 1 ký tự
        }
    
        return $randomCode; // Trả về mã sản phẩm ngẫu nhiên
    }
//         echo "<pre>";
// print_r($_POST);
// echo "</pre>";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Gán các giá trị từ form vào đối tượng $product
        $product->categories_ID=$_REQUEST['categories_ID'];
        $product->product_name = $_REQUEST['product_name'];
        $product->product_image=$_FILES['product_image']['name'];
        // $product->product_image = $_REQUEST['product_image'];
        $product->product_price = $_REQUEST['product_price'];
        $product->product_content = $_REQUEST['product_content'];
        $product->product_link = $_REQUEST['product_link'];
    
        if(isset($_FILES['product_image']['name'])){
            $path="./uploads/image/";
            move_uploaded_file($_FILES['product_image']['tmp_name'], $path.$_FILES['product_image']['name']);
        }
        // Gọi hàm generateProductCode để tạo mã sản phẩm ngẫu nhiên
    
        // Thêm sản phẩm vào cơ sở dữ liệu
        if ($product->add_product()) {
            $status = "Add product successfully!";
            header('Location: AD_product.php');
            exit(); // Dùng exit() để dừng script sau khi redirect
        }
    }
    $stmt_product = $product->read_all();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Quixlab - Bootstrap Admin Dashboard Template by Themefisher.com</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <?php include './includes/nav_header.php'?>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <?php include './includes/header.php'?>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php include './includes/sidebar.php'?>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Thêm sản phẩm</h4>
                                    <div class="basic-form">
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Tên sản phẩm</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="product_name" class="form-control" placeholder="Tên sản phẩm">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Link hình ảnh</label>
                                                <div class="col-sm-10">
                                                    <input type="file" name="product_image" class="form-control" placeholder="Link hình ảnh">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Giá</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="product_price" class="form-control" placeholder="Giá">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Nội dung</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="product_content" class="form-control" placeholder="Nội dung">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Link source code</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="product_link" class="form-control" placeholder="Link source code">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label" for="val-skill">Danh mục sản phẩm</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="categories_ID">
                                                        <option value="">Danh mục sản phẩm</option>
                                                        <?php
                                                            while ($row_categories=$stmt_categories->fetch()) {
                                                                echo"<option value='".$row_categories['categories_ID']."''>".$row_categories['categories_name']."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <button type="submit" class="btn mb-1 btn-rounded btn-success">Thêm sản phẩm</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="https://themeforest.net/user/quixlab">Quixlab</a> 2018</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>

</body>

</html>