<?php 
  include ".\ADMIN\includes\connect_database.php";
  include ".\ADMIN\includes\account_user.php";

  $database = new database();
  $db = $database->connect();

  $account_users = new account_users($db);
  
//   echo "<pre style='color: white; background-color: black;'>";  // Thiết lập chữ màu trắng, nền đen
//   print_r($_POST);  // In ra tất cả dữ liệu trong $_POST
//   echo "</pre>";
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_REQUEST['frm']) && $_REQUEST['frm'] == 'loginAccount') {
        $account_users->user_name = $_REQUEST['user_name'];
        $account_users->user_password = sha1($_REQUEST['user_password']);
        $stmt = $account_users->read_login();
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();  // Lấy dữ liệu dòng đầu tiên
            session_start();  // Khởi tạo session
            $_SESSION['user_ID'] = $row['user_ID'];  // Lưu user_ID vào session
            $stmt_user_ID = $account_users->read_ID();  // Đọc ID người dùng từ cơ sở dữ liệu
            header("location: index.php");  // Điều hướng đến trang chủ
        } else {
             // Nếu đăng nhập không thành công, truyền thông báo qua URL
             header("location: login.php?error=1");  // Điều hướng lại trang login với tham số lỗi
             exit();
        }
    }
}
    
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>HcThanh</title>
    <link rel="icon" href="assets/images/logoHT.png" type="image/png">
    <link rel="stylesheet" href="assets/css/login.css">

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
    <?php include './includes/header.php'?>
    <?php
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
?>
    <div class="login">
        <!-- Div 1: Form đăng ký -->
        <div class="login-box">
            <h1>WELCOME</h1>
            <?php echo $_SERVER['REQUEST_METHOD']; ?>
            <form name="frm" method="POST">
                <div class="user-box">
                    <input type="text" name="user_name" required="">
                    <label>Tên tài khoản</label>
                </div>
                <div class="user-box">
                    <input type="password" name="user_password" required="">
                    <label>Mật khẩu</label>
                </div>
                <center>
                    <input type="hidden" name="frm" value="loginAccount">
                    <button class="btn_a" type="submit">Đăng nhập</button>
                </center>
                <p style="margin: 10px 0;">HOẶC</p>
                <center>
                    <a class="btn_a" href="./register.php">tạo tài khoản</a>
                </center>
            </form>
        </div>

        <!-- Div 2: Phần thông tin thêm -->
        <div class="info-box">
            <svg class="animated" id="freepik_stories-programming" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 500 500" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                xmlns:svgjs="http://svgjs.com/svgjs">
                <g id="freepik--Floor--inject-993" class="animable" style="transform-origin: 250px 445.09px;">
                    <path
                        d="M472.86,445.09c0,.14-99.78.26-222.85.26s-222.87-.12-222.87-.26,99.76-.26,222.87-.26S472.86,444.94,472.86,445.09Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 250px 445.09px;" id="elxf25pktv56o"
                        class="animable"></path>
                </g>
                <g id="freepik--Screens--inject-993" class="animable" style="transform-origin: 254.065px 161.78px;">
                    <rect x="295.03" y="135.41" width="140.13" height="114.16"
                        style="fill: rgb(224, 224, 224); transform-origin: 365.095px 192.49px;" id="elysirctxdnn9"
                        class="animable"></rect>
                    <rect x="285.07" y="142.66" width="140.13" height="114.16"
                        style="fill: rgb(235, 235, 235); transform-origin: 355.135px 199.74px;" id="el8aofeu29ntw"
                        class="animable"></rect>
                    <rect x="271.34" y="150.61" width="143.87" height="117.21"
                        style="fill: rgb(255, 255, 255); transform-origin: 343.275px 209.215px;" id="elfid2awkh7g"
                        class="animable"></rect>
                    <path
                        d="M415.21,267.82s0-.75,0-2.16,0-3.53,0-6.26c0-5.48,0-13.51-.05-23.75,0-20.46-.07-49.73-.12-85l.22.22-143.85,0h0l.26-.26c0,42.38,0,82.4,0,117.21l-.24-.24,104,.12,29.42.06,7.79,0h2l.69,0h-2.64l-7.75,0-29.37.06-104.11.12h-.23v-.23c0-34.81,0-74.83,0-117.21v-.26h.28l143.85,0h.22v.22c-.05,35.36-.09,64.68-.11,85.18,0,10.21-.05,18.23-.06,23.7,0,2.71,0,4.8,0,6.21S415.21,267.82,415.21,267.82Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 343.405px 209.09px;" id="eld836pxrnd1"
                        class="animable"></path>
                    <path d="M288.88,167.55l-1.55.56,1.55.57v.58l-2.21-.84v-.61l2.21-.84Z"
                        style="fill: rgb(18, 17, 17); transform-origin: 287.775px 168.115px;" id="el6u4mknkjzar"
                        class="animable"></path>
                    <path d="M292.52,166.49v3.25h-.75v-1.33h-1.48v1.33h-.75v-3.25h.75v1.28h1.48v-1.28Z"
                        style="fill: rgb(18, 17, 17); transform-origin: 291.03px 168.115px;" id="eljx4x99eybsd"
                        class="animable"></path>
                    <path d="M294,167.1h-1v-.61h2.83v.61h-1v2.64H294Z"
                        style="fill: rgb(18, 17, 17); transform-origin: 294.415px 168.115px;" id="elbepi2cc3cfp"
                        class="animable"></path>
                    <path d="M299.11,169.74v-2l-1,1.6h-.34l-.95-1.56v1.91h-.71v-3.25h.62l1.22,2,1.2-2h.61v3.25Z"
                        style="fill: rgb(18, 17, 17); transform-origin: 297.935px 168.09px;" id="ellviyt0e5drd"
                        class="animable"></path>
                    <path d="M300.58,166.49h.75v2.64H303v.61h-2.38Z"
                        style="fill: rgb(18, 17, 17); transform-origin: 301.79px 168.115px;" id="el0nub7m4x0k1r"
                        class="animable"></path>
                    <path d="M305.48,167.81v.61l-2.2.84v-.58l1.54-.57-1.54-.56V167Z"
                        style="fill: rgb(18, 17, 17); transform-origin: 304.38px 168.13px;" id="elj1z4xh7xh4"
                        class="animable"></path>
                    <path d="M287.57,256.43,286,257l1.55.56v.58l-2.21-.84v-.61l2.21-.84Z"
                        style="fill: rgb(18, 17, 17); transform-origin: 286.455px 256.995px;" id="elb9u16mykjuk"
                        class="animable"></path>
                    <path d="M289.22,254.71h.65l-1.53,4.37h-.65Z"
                        style="fill: rgb(18, 17, 17); transform-origin: 288.78px 256.895px;" id="ela9fsqrv7v3b"
                        class="animable"></path>
                    <path d="M293,255.37v3.25h-.76v-1.33H290.8v1.33h-.75v-3.25h.75v1.28h1.47v-1.28Z"
                        style="fill: rgb(18, 17, 17); transform-origin: 291.525px 256.995px;" id="ellwx7aj1wtn"
                        class="animable"></path>
                    <path d="M294.46,256h-1v-.61h2.82V256h-1v2.64h-.76Z"
                        style="fill: rgb(18, 17, 17); transform-origin: 294.87px 257.015px;" id="el7i0593fqtfk"
                        class="animable"></path>
                    <path d="M299.61,258.62v-1.95l-1,1.61h-.34l-.95-1.57v1.91h-.7v-3.25h.62l1.21,2,1.2-2h.62v3.25Z"
                        style="fill: rgb(18, 17, 17); transform-origin: 298.445px 256.995px;" id="elx4p2nhekz2c"
                        class="animable"></path>
                    <path d="M301.08,255.37h.75V258h1.63v.61h-2.38Z"
                        style="fill: rgb(18, 17, 17); transform-origin: 302.27px 256.99px;" id="elnluly0j4p7"
                        class="animable"></path>
                    <path d="M306,256.69v.61l-2.21.84v-.58l1.55-.56-1.55-.57v-.58Z"
                        style="fill: rgb(18, 17, 17); transform-origin: 304.895px 256.995px;" id="eliuo4e0kdlor"
                        class="animable"></path>
                    <path d="M299.07,176.44l-1.65.63,1.65.64v.38l-2.08-.82v-.4l2.08-.82Z" id="el775gmgxcq0v"
                        class="animable" style="transform-origin: 298.03px 177.07px;"></path>
                    <path d="M302.65,175.45v3.25h-.46v-1.45h-1.86v1.45h-.47v-3.25h.47v1.4h1.86v-1.4Z" id="ele6cd5b8ycra"
                        class="animable" style="transform-origin: 301.255px 177.075px;"></path>
                    <path d="M306,178.29v.41h-2.36v-3.25h2.3v.4h-1.83v1h1.63v.39h-1.63v1Z" id="el3t4y48mpe1l"
                        class="animable" style="transform-origin: 304.82px 177.075px;"></path>
                    <path d="M308.8,177.88h-1.73l-.35.82h-.48l1.47-3.25h.46l1.47,3.25h-.49Zm-.16-.37-.7-1.59-.71,1.59Z"
                        id="el8jz58a448x5" class="animable" style="transform-origin: 307.94px 177.075px;"></path>
                    <path
                        d="M310.12,175.45h1.37a1.63,1.63,0,1,1,0,3.25h-1.37Zm1.34,2.84a1.22,1.22,0,1,0,0-2.44h-.88v2.44Z"
                        id="elsarjjlr6i48" class="animable" style="transform-origin: 311.684px 177.075px;"></path>
                    <path d="M315.85,176.87v.4l-2.08.82v-.38l1.65-.64-1.65-.63v-.39Z" id="eldc38alrla5j"
                        class="animable" style="transform-origin: 314.81px 177.07px;"></path>
                    <path d="M299.07,187.56l-1.65.63,1.65.64v.38l-2.08-.82V188l2.08-.82Z" id="elciy6q6ychkj"
                        class="animable" style="transform-origin: 298.03px 188.195px;"></path>
                    <path d="M300.51,187h-1.12v-.4h2.69v.4H301v2.85h-.46Z" id="elf94urq5mdcc" class="animable"
                        style="transform-origin: 300.735px 188.225px;"></path>
                    <path d="M302.58,186.57h.47v3.25h-.47Z" id="ela2yxgbxwj2m" class="animable"
                        style="transform-origin: 302.815px 188.195px;"></path>
                    <path d="M304.66,187h-1.11v-.4h2.68v.4h-1.11v2.85h-.46Z" id="el7clge46e1eo" class="animable"
                        style="transform-origin: 304.89px 188.225px;"></path>
                    <path d="M306.74,186.57h.46v2.84H309v.41h-2.22Z" id="el0q4gog10hm8n" class="animable"
                        style="transform-origin: 307.87px 188.195px;"></path>
                    <path d="M311.85,189.41v.41h-2.36v-3.25h2.29v.4H310v1h1.63v.4H310v1Z" id="el8g5ym8y7r6u"
                        class="animable" style="transform-origin: 310.67px 188.195px;"></path>
                    <path d="M314.5,188v.4l-2.08.82v-.38l1.65-.64-1.65-.63v-.39Z" id="eld0nxxuvnp4s" class="animable"
                        style="transform-origin: 313.46px 188.2px;"></path>
                    <path d="M316.54,186.57H317v2.84h1.76v.41h-2.22Z" id="elg74idwgyl07" class="animable"
                        style="transform-origin: 317.65px 188.195px;"></path>
                    <path
                        d="M319,188.59a1.28,1.28,0,1,1,1.28,1.26A1.22,1.22,0,0,1,319,188.59Zm2.1,0a.83.83,0,1,0-1.65,0,.83.83,0,1,0,1.65,0Z"
                        id="eln4snfhg4vfk" class="animable" style="transform-origin: 320.28px 188.571px;"></path>
                    <path
                        d="M323.46,187.34v.43h-.1a.74.74,0,0,0-.78.83v1.23h-.44v-2.46h.42v.41A.94.94,0,0,1,323.46,187.34Z"
                        id="elu7fmc0zeuom" class="animable" style="transform-origin: 322.8px 188.582px;"></path>
                    <path
                        d="M326.19,188.74h-2a.83.83,0,0,0,.89.72.91.91,0,0,0,.71-.3l.24.29a1.34,1.34,0,0,1-2.29-.86,1.21,1.21,0,0,1,1.24-1.25,1.18,1.18,0,0,1,1.21,1.26A.66.66,0,0,1,326.19,188.74Zm-2-.32h1.58a.79.79,0,0,0-1.58,0Z"
                        id="elyqbmxpy6cjm" class="animable" style="transform-origin: 324.967px 188.594px;"></path>
                    <path
                        d="M330.9,188.4v1.42h-.45v-1.37c0-.48-.23-.71-.63-.71a.71.71,0,0,0-.74.81v1.27h-.45v-1.37c0-.48-.23-.71-.63-.71a.71.71,0,0,0-.74.81v1.27h-.44v-2.46h.42v.37a1,1,0,0,1,.85-.39.91.91,0,0,1,.86.45,1.08,1.08,0,0,1,.94-.45A.94.94,0,0,1,330.9,188.4Z"
                        id="elg9wbw0a87ld" class="animable" style="transform-origin: 328.864px 188.578px;"></path>
                    <path
                        d="M332.88,186.6a.29.29,0,0,1,.3-.29.28.28,0,0,1,.3.28.29.29,0,0,1-.3.3A.29.29,0,0,1,332.88,186.6Zm.08.76h.45v2.46H333Z"
                        id="el5zldh60966c" class="animable" style="transform-origin: 333.18px 188.065px;"></path>
                    <path
                        d="M336.8,188.59a1.2,1.2,0,0,1-1.24,1.26,1.06,1.06,0,0,1-.86-.4v1.27h-.45v-3.36h.43v.39a1.06,1.06,0,0,1,.88-.41A1.19,1.19,0,0,1,336.8,188.59Zm-.45,0a.83.83,0,1,0-1.66,0,.83.83,0,1,0,1.66,0Z"
                        id="eleejttvhab95" class="animable" style="transform-origin: 335.526px 189.029px;"></path>
                    <path
                        d="M337.1,189.56l.19-.35a1.65,1.65,0,0,0,.86.25c.41,0,.59-.12.59-.33,0-.56-1.56-.08-1.56-1.06,0-.44.4-.73,1-.73a1.75,1.75,0,0,1,.89.22l-.19.35a1.31,1.31,0,0,0-.71-.19c-.39,0-.58.14-.58.34,0,.57,1.56.1,1.56,1.06,0,.44-.41.73-1.06.73A1.82,1.82,0,0,1,337.1,189.56Z"
                        id="elpqvetz8xmwe" class="animable" style="transform-origin: 338.125px 188.595px;"></path>
                    <path
                        d="M342,187.36v2.46h-.42v-.37a1,1,0,0,1-.84.4,1,1,0,0,1-1.06-1.08v-1.41h.45v1.36c0,.49.24.73.66.73a.72.72,0,0,0,.76-.82v-1.27Z"
                        id="elcy2x705hcvp" class="animable" style="transform-origin: 340.838px 188.606px;"></path>
                    <path
                        d="M347,188.4v1.42h-.44v-1.37c0-.48-.23-.71-.64-.71a.71.71,0,0,0-.73.81v1.27h-.45v-1.37c0-.48-.23-.71-.63-.71a.71.71,0,0,0-.74.81v1.27h-.45v-2.46h.43v.37a1,1,0,0,1,.85-.39.9.9,0,0,1,.85.45,1.11,1.11,0,0,1,.95-.45A.93.93,0,0,1,347,188.4Z"
                        id="elxbhwqui0d7r" class="animable" style="transform-origin: 344.965px 188.578px;"></path>
                    <path d="M351,187.56l-1.64.63,1.64.64v.38l-2.07-.82V188l2.07-.82Z" id="elaeug49vvwyv"
                        class="animable" style="transform-origin: 349.965px 188.195px;"></path>
                    <path d="M352.69,185.91h.41l-1.53,4.37h-.41Z" id="el8gizuvlyxrq" class="animable"
                        style="transform-origin: 352.13px 188.095px;"></path>
                    <path d="M354.19,187h-1.11v-.4h2.69v.4h-1.12v2.85h-.46Z" id="el0mw0y4la3xn" class="animable"
                        style="transform-origin: 354.425px 188.225px;"></path>
                    <path d="M356.27,186.57h.46v3.25h-.46Z" id="el0f6qg0onf15h" class="animable"
                        style="transform-origin: 356.5px 188.195px;"></path>
                    <path d="M358.35,187h-1.11v-.4h2.68v.4h-1.11v2.85h-.46Z" id="elkj2tg7bbh8" class="animable"
                        style="transform-origin: 358.58px 188.225px;"></path>
                    <path d="M360.43,186.57h.46v2.84h1.76v.41h-2.22Z" id="elqn3fz1u7p" class="animable"
                        style="transform-origin: 361.54px 188.195px;"></path>
                    <path d="M365.54,189.41v.41h-2.36v-3.25h2.29v.4h-1.83v1h1.63v.4h-1.63v1Z" id="eljzt9hxe4hn"
                        class="animable" style="transform-origin: 364.36px 188.195px;"></path>
                    <path d="M368.19,188v.4l-2.08.82v-.38l1.65-.64-1.65-.63v-.39Z" id="elc3gvte9y164" class="animable"
                        style="transform-origin: 367.15px 188.2px;"></path>
                    <path d="M299.07,198.68l-1.65.64,1.65.63v.39l-2.08-.83v-.39l2.08-.83Z" id="elvnv57u8p3kq"
                        class="animable" style="transform-origin: 298.03px 199.315px;"></path>
                    <path d="M300.78,197h.4l-1.53,4.37h-.41Z" id="elc0z1gsmcjx6" class="animable"
                        style="transform-origin: 300.21px 199.185px;"></path>
                    <path d="M304.28,197.69v3.25h-.46v-1.45H302v1.45h-.47v-3.25H302v1.4h1.86v-1.4Z" id="elniesmz8o2v"
                        class="animable" style="transform-origin: 302.905px 199.315px;"></path>
                    <path d="M307.61,200.53v.41h-2.35v-3.25h2.29v.41h-1.83v1h1.63v.4h-1.63v1Z" id="elka65l6vuwtl"
                        class="animable" style="transform-origin: 306.435px 199.315px;"></path>
                    <path d="M310.43,200.13H308.7l-.35.81h-.48l1.47-3.25h.46l1.47,3.25h-.48Zm-.16-.37-.7-1.6-.7,1.6Z"
                        id="eld40y99maqdq" class="animable" style="transform-origin: 309.57px 199.315px;"></path>
                    <path
                        d="M311.75,197.69h1.37a1.63,1.63,0,1,1,0,3.25h-1.37Zm1.34,2.84a1.22,1.22,0,1,0,0-2.43h-.87v2.43Z"
                        id="elwme82w1nk9f" class="animable" style="transform-origin: 313.314px 199.315px;"></path>
                    <path d="M317.48,199.12v.39l-2.08.83V200l1.65-.63-1.65-.64v-.39Z" id="eln4hc33ce3br"
                        class="animable" style="transform-origin: 316.44px 199.34px;"></path>
                    <path d="M290.45,208.33l-1.64.64,1.64.63V210l-2.08-.82v-.4l2.08-.82Z" id="el1ssv6n9tgn3"
                        class="animable" style="transform-origin: 289.41px 208.98px;"></path>
                    <path
                        d="M294,209.71c0,.56-.42.88-1.24.88h-1.55v-3.25h1.45c.75,0,1.17.32,1.17.84a.83.83,0,0,0,.17,1.53Zm-2.33-2v1h1c.48,0,.74-.18.74-.52s-.26-.52-.74-.52Zm1.86,2c0-.38-.28-.55-.79-.55h-1.07v1.08h1.07C293.29,210.21,293.57,210.05,293.57,209.68Z"
                        id="el8jkw44xodxm" class="animable" style="transform-origin: 292.605px 208.965px;"></path>
                    <path
                        d="M294.49,209a1.73,1.73,0,1,1,1.73,1.66A1.65,1.65,0,0,1,294.49,209Zm3,0a1.27,1.27,0,1,0-1.26,1.24A1.22,1.22,0,0,0,297.48,209Z"
                        id="elejh68zf63zl" class="animable" style="transform-origin: 296.219px 208.931px;"></path>
                    <path
                        d="M298.65,207.34H300a1.63,1.63,0,1,1,0,3.25h-1.37Zm1.34,2.85a1.22,1.22,0,1,0,0-2.44h-.88v2.44Z"
                        id="elmqr76yy8dmg" class="animable" style="transform-origin: 300.194px 208.965px;"></path>
                    <path d="M303.58,209.47v1.12h-.46v-1.13l-1.29-2.12h.5l1,1.72,1-1.72h.46Z" id="elxb4v8qolmmm"
                        class="animable" style="transform-origin: 303.31px 208.965px;"></path>
                    <path d="M307.24,208.77v.4l-2.08.82v-.39l1.65-.63-1.65-.64V208Z" id="el6taa8lfljl" class="animable"
                        style="transform-origin: 306.2px 208.995px;"></path>
                    <path d="M290.45,219.45l-1.64.64,1.64.63v.39l-2.08-.82v-.4l2.08-.82Z" id="eli9qa3frbt6o"
                        class="animable" style="transform-origin: 289.41px 220.09px;"></path>
                    <path d="M294,218.47v3.24h-.46v-1.44h-1.87v1.44h-.46v-3.24h.46v1.39h1.87v-1.39Z" id="eln8t80a1dvb"
                        class="animable" style="transform-origin: 292.605px 220.09px;"></path>
                    <path d="M295.75,218.47v3.24h-.46v-2.84h-.73v-.4Z" id="el0u33eizw17hg" class="animable"
                        style="transform-origin: 295.155px 220.09px;"></path>
                    <path d="M298.63,219.89v.4l-2.08.82v-.39l1.65-.63-1.65-.64v-.38Z" id="eleqfbalmvstl"
                        class="animable" style="transform-origin: 297.59px 220.09px;"></path>
                    <path d="M300.71,218.47h.34v2.95h1.82v.29h-2.16Z" id="elrsnf0e6o7wd" class="animable"
                        style="transform-origin: 301.79px 220.09px;"></path>
                    <path
                        d="M303.09,220.49a1.24,1.24,0,1,1,1.24,1.25A1.2,1.2,0,0,1,303.09,220.49Zm2.14,0a.91.91,0,1,0-.9.95A.89.89,0,0,0,305.23,220.49Z"
                        id="el2mn3w29nxwl" class="animable" style="transform-origin: 304.329px 220.5px;"></path>
                    <path
                        d="M307.47,219.25v.32h-.08a.79.79,0,0,0-.82.9v1.24h-.33v-2.44h.31v.48A1,1,0,0,1,307.47,219.25Z"
                        id="el8gz9zc26x8o" class="animable" style="transform-origin: 306.855px 220.479px;"></path>
                    <path
                        d="M310.16,220.59h-2a.91.91,0,0,0,1,.85,1,1,0,0,0,.75-.32l.18.22a1.19,1.19,0,0,1-.94.4,1.21,1.21,0,0,1-1.28-1.25,1.18,1.18,0,0,1,1.19-1.24,1.16,1.16,0,0,1,1.18,1.24Zm-2-.24h1.73a.87.87,0,0,0-1.73,0Z"
                        id="ela3cvm1voizj" class="animable" style="transform-origin: 309.056px 220.496px;"></path>
                    <path
                        d="M314.86,220.3v1.41h-.33v-1.38c0-.51-.26-.78-.7-.78a.78.78,0,0,0-.81.88v1.28h-.33v-1.38c0-.51-.26-.78-.71-.78a.79.79,0,0,0-.82.88v1.28h-.33v-2.44h.32v.45a1,1,0,0,1,.9-.47.88.88,0,0,1,.86.52,1.07,1.07,0,0,1,1-.52A.93.93,0,0,1,314.86,220.3Z"
                        id="elrcwxx3lrc3r" class="animable" style="transform-origin: 312.849px 220.478px;"></path>
                    <path
                        d="M316.89,218.5a.24.24,0,0,1,.24-.23.23.23,0,0,1,.24.23.24.24,0,0,1-.24.24A.24.24,0,0,1,316.89,218.5Zm.07.77h.33v2.44H317Z"
                        id="el1vwmbu9em0z" class="animable" style="transform-origin: 317.13px 219.99px;"></path>
                    <path
                        d="M320.68,220.49a1.19,1.19,0,0,1-1.21,1.25,1.06,1.06,0,0,1-.93-.49v1.36h-.33v-3.34h.32v.48a1.07,1.07,0,0,1,.94-.5A1.18,1.18,0,0,1,320.68,220.49Zm-.32,0a.91.91,0,1,0-1.82,0,.91.91,0,1,0,1.82,0Z"
                        id="elbukm96kjelu" class="animable" style="transform-origin: 319.446px 220.93px;"></path>
                    <path
                        d="M321,221.43l.15-.26a1.46,1.46,0,0,0,.87.28c.46,0,.65-.16.65-.4,0-.64-1.58-.14-1.58-1.1,0-.4.35-.7,1-.7a1.64,1.64,0,0,1,.86.23l-.14.27a1.26,1.26,0,0,0-.72-.21c-.44,0-.64.17-.64.4,0,.66,1.58.16,1.58,1.1,0,.42-.37.7-1,.7A1.59,1.59,0,0,1,321,221.43Z"
                        id="eltxa2surop4r" class="animable" style="transform-origin: 322.015px 220.496px;"></path>
                    <path
                        d="M325.82,219.27v2.44h-.32v-.44a1,1,0,0,1-.87.47.94.94,0,0,1-1-1.05v-1.42h.33v1.38c0,.52.26.79.73.79a.79.79,0,0,0,.83-.89v-1.28Z"
                        id="elmewt3ys0gtq" class="animable" style="transform-origin: 324.722px 220.506px;"></path>
                    <path
                        d="M330.76,220.3v1.41h-.32v-1.38c0-.51-.26-.78-.71-.78a.78.78,0,0,0-.81.88v1.28h-.33v-1.38c0-.51-.26-.78-.71-.78a.79.79,0,0,0-.81.88v1.28h-.33v-2.44h.31v.45a1,1,0,0,1,.9-.47.89.89,0,0,1,.87.52,1,1,0,0,1,1-.52A.93.93,0,0,1,330.76,220.3Z"
                        id="elwsva8j7c6z" class="animable" style="transform-origin: 328.754px 220.476px;"></path>
                    <path
                        d="M335.09,218.27v3.44h-.31v-.48a1.06,1.06,0,0,1-.94.51,1.25,1.25,0,0,1,0-2.49,1.07,1.07,0,0,1,.93.49v-1.47Zm-.32,2.22a.91.91,0,1,0-.9.95A.89.89,0,0,0,334.77,220.49Z"
                        id="elnlofyp9cjqe" class="animable" style="transform-origin: 333.896px 220.005px;"></path>
                    <path
                        d="M335.76,220.49a1.25,1.25,0,1,1,1.25,1.25A1.21,1.21,0,0,1,335.76,220.49Zm2.15,0a.91.91,0,1,0-.9.95A.89.89,0,0,0,337.91,220.49Z"
                        id="elqfoqas92m" class="animable" style="transform-origin: 337.01px 220.49px;"></path>
                    <path d="M338.92,218.27h.32v3.44h-.32Z" id="el9wp52egrbfw" class="animable"
                        style="transform-origin: 339.08px 219.99px;"></path>
                    <path
                        d="M339.92,220.49a1.24,1.24,0,1,1,1.24,1.25A1.2,1.2,0,0,1,339.92,220.49Zm2.14,0a.91.91,0,1,0-.9.95A.89.89,0,0,0,342.06,220.49Z"
                        id="elrrcy1bnthh" class="animable" style="transform-origin: 341.159px 220.5px;"></path>
                    <path d="M344.3,219.25v.32h-.08a.79.79,0,0,0-.82.9v1.24h-.33v-2.44h.31v.48A1,1,0,0,1,344.3,219.25Z"
                        id="ela4iylil6qbf" class="animable" style="transform-origin: 343.685px 220.479px;"></path>
                    <path
                        d="M345.8,221.43l.15-.26a1.41,1.41,0,0,0,.87.28c.46,0,.65-.16.65-.4,0-.64-1.58-.14-1.58-1.1,0-.4.34-.7,1-.7a1.68,1.68,0,0,1,.87.23l-.15.27a1.24,1.24,0,0,0-.72-.21c-.44,0-.63.17-.63.4,0,.66,1.58.16,1.58,1.1,0,.42-.37.7-1,.7A1.58,1.58,0,0,1,345.8,221.43Z"
                        id="elwt4oyx7c2zc" class="animable" style="transform-origin: 346.82px 220.496px;"></path>
                    <path
                        d="M348.33,218.5a.24.24,0,0,1,.24-.23.23.23,0,0,1,.24.23.24.24,0,0,1-.24.24A.24.24,0,0,1,348.33,218.5Zm.08.77h.32v2.44h-.32Z"
                        id="el4a3csi765r" class="animable" style="transform-origin: 348.57px 219.99px;"></path>
                    <path
                        d="M350.94,221.56a.78.78,0,0,1-.52.18.64.64,0,0,1-.71-.71v-1.48h-.44v-.28h.44v-.53H350v.53h.74v.28H350V221a.39.39,0,0,0,.42.44.56.56,0,0,0,.36-.12Z"
                        id="el1e3y1n9u81v" class="animable" style="transform-origin: 350.105px 220.242px;"></path>
                    <path
                        d="M354.59,220.2v1.51h-.32v-.38a.9.9,0,0,1-.84.41c-.55,0-.89-.29-.89-.71s.24-.7.94-.7h.78v-.14a.6.6,0,0,0-.69-.65,1.21,1.21,0,0,0-.81.29l-.15-.25a1.53,1.53,0,0,1,1-.33A.87.87,0,0,1,354.59,220.2Zm-.33.78v-.4h-.77c-.47,0-.62.19-.62.44s.23.46.61.46A.78.78,0,0,0,354.26,221Z"
                        id="elkaxeivf36p" class="animable" style="transform-origin: 353.567px 220.493px;"></path>
                    <path
                        d="M359.51,220.3v1.41h-.33v-1.38c0-.51-.26-.78-.7-.78a.79.79,0,0,0-.82.88v1.28h-.33v-1.38c0-.51-.26-.78-.7-.78a.79.79,0,0,0-.82.88v1.28h-.33v-2.44h.32v.45a1,1,0,0,1,.89-.47.88.88,0,0,1,.87.52,1.05,1.05,0,0,1,1-.52A.93.93,0,0,1,359.51,220.3Z"
                        id="el1wmnmsiy5i2" class="animable" style="transform-origin: 357.499px 220.478px;"></path>
                    <path
                        d="M362.53,220.59h-2a.91.91,0,0,0,1,.85,1,1,0,0,0,.75-.32l.18.22a1.19,1.19,0,0,1-.94.4,1.21,1.21,0,0,1-1.28-1.25,1.19,1.19,0,1,1,2.38,0S362.53,220.56,362.53,220.59Zm-2-.24h1.73a.87.87,0,0,0-1.73,0Z"
                        id="el8mvqy7mc40k" class="animable" style="transform-origin: 361.43px 220.521px;"></path>
                    <path
                        d="M364.49,221.56a.76.76,0,0,1-.51.18.65.65,0,0,1-.72-.71v-1.48h-.43v-.28h.43v-.53h.33v.53h.74v.28h-.74V221a.39.39,0,0,0,.42.44.54.54,0,0,0,.36-.12Z"
                        id="elm6dzk95q1w" class="animable" style="transform-origin: 363.66px 220.242px;"></path>
                    <path
                        d="M365.42,221.48a.71.71,0,0,1-.07.27l-.19.64h-.23l.16-.67a.24.24,0,0,1-.17-.24.25.25,0,0,1,.25-.25A.24.24,0,0,1,365.42,221.48Z"
                        id="elwmznz2i0i8" class="animable" style="transform-origin: 365.17px 221.81px;"></path>
                    <path
                        d="M367.08,220.49a1.2,1.2,0,0,1,1.26-1.24,1.09,1.09,0,0,1,1,.49l-.25.16a.83.83,0,0,0-.71-.36,1,1,0,0,0,0,1.9.82.82,0,0,0,.71-.35l.25.16a1.09,1.09,0,0,1-1,.49A1.21,1.21,0,0,1,367.08,220.49Z"
                        id="elt80ybm34gu" class="animable" style="transform-origin: 368.21px 220.495px;"></path>
                    <path
                        d="M369.65,220.49a1.24,1.24,0,1,1,1.25,1.25A1.21,1.21,0,0,1,369.65,220.49Zm2.15,0a.89.89,0,0,0-.9-1,1,1,0,0,0,0,1.9A.89.89,0,0,0,371.8,220.49Z"
                        id="elkgoarego1i" class="animable" style="transform-origin: 370.89px 220.5px;"></path>
                    <path
                        d="M375.05,220.3v1.41h-.33v-1.38a.68.68,0,0,0-.73-.78.8.8,0,0,0-.86.88v1.28h-.33v-2.44h.32v.45a1,1,0,0,1,.93-.47A.94.94,0,0,1,375.05,220.3Z"
                        id="elsfwgzd0x8p" class="animable" style="transform-origin: 373.928px 220.478px;"></path>
                    <path
                        d="M375.6,221.43l.15-.26a1.41,1.41,0,0,0,.87.28c.46,0,.65-.16.65-.4,0-.64-1.58-.14-1.58-1.1,0-.4.34-.7,1-.7a1.68,1.68,0,0,1,.87.23l-.15.27a1.24,1.24,0,0,0-.72-.21c-.44,0-.63.17-.63.4,0,.66,1.58.16,1.58,1.1,0,.42-.37.7-1,.7A1.58,1.58,0,0,1,375.6,221.43Z"
                        id="elm2wrapujlkl" class="animable" style="transform-origin: 376.62px 220.496px;"></path>
                    <path
                        d="M380.33,220.59h-2a.91.91,0,0,0,1,.85,1,1,0,0,0,.75-.32l.18.22a1.19,1.19,0,0,1-.94.4,1.21,1.21,0,0,1-1.28-1.25,1.18,1.18,0,0,1,1.19-1.24,1.16,1.16,0,0,1,1.18,1.24Zm-2-.24H380a.87.87,0,0,0-1.73,0Z"
                        id="el2uwdv3azvy7" class="animable" style="transform-origin: 379.226px 220.496px;"></path>
                    <path
                        d="M380.76,220.49a1.2,1.2,0,0,1,1.26-1.24,1.06,1.06,0,0,1,1,.49l-.24.16a.85.85,0,0,0-.71-.36,1,1,0,0,0,0,1.9.84.84,0,0,0,.71-.35l.24.16a1.06,1.06,0,0,1-1,.49A1.21,1.21,0,0,1,380.76,220.49Z"
                        id="elj1rj7nzu0v" class="animable" style="transform-origin: 381.89px 220.495px;"></path>
                    <path
                        d="M384.93,221.56a.78.78,0,0,1-.52.18.64.64,0,0,1-.71-.71v-1.48h-.44v-.28h.44v-.53H384v.53h.74v.28H384V221a.39.39,0,0,0,.42.44.56.56,0,0,0,.36-.12Z"
                        id="el36zis7o0pel" class="animable" style="transform-origin: 384.095px 220.242px;"></path>
                    <path
                        d="M387.56,220.59h-2a.91.91,0,0,0,1,.85,1,1,0,0,0,.75-.32l.18.22a1.19,1.19,0,0,1-.94.4,1.21,1.21,0,0,1-1.28-1.25,1.19,1.19,0,1,1,2.38,0S387.56,220.56,387.56,220.59Zm-2-.24h1.73a.87.87,0,0,0-1.73,0Z"
                        id="elz1p554k835p" class="animable" style="transform-origin: 386.46px 220.521px;"></path>
                    <path
                        d="M389.52,221.56a.78.78,0,0,1-.52.18.65.65,0,0,1-.71-.71v-1.48h-.44v-.28h.44v-.53h.33v.53h.74v.28h-.74V221a.39.39,0,0,0,.42.44.54.54,0,0,0,.36-.12Z"
                        id="el3qq5xbdmvh3" class="animable" style="transform-origin: 388.685px 220.242px;"></path>
                    <path
                        d="M392.31,219.27v2.44H392v-.44a1,1,0,0,1-.88.47,1,1,0,0,1-1-1.05v-1.42h.33v1.38c0,.52.27.79.73.79a.79.79,0,0,0,.83-.89v-1.28Z"
                        id="eljoy2kodxt7k" class="animable" style="transform-origin: 391.214px 220.505px;"></path>
                    <path
                        d="M395.36,220.59h-2a.9.9,0,0,0,1,.85.93.93,0,0,0,.74-.32l.19.22a1.29,1.29,0,0,1-2.22-.85,1.17,1.17,0,0,1,1.19-1.24,1.16,1.16,0,0,1,1.18,1.24Zm-2-.24h1.73a.87.87,0,0,0-1.73,0Z"
                        id="el6yvln8x9ew" class="animable" style="transform-origin: 394.255px 220.493px;"></path>
                    <path
                        d="M397.26,219.25v.32h-.08a.79.79,0,0,0-.82.9v1.24H396v-2.44h.32v.48A.92.92,0,0,1,397.26,219.25Z"
                        id="elj6fc99tp2t" class="animable" style="transform-origin: 396.63px 220.476px;"></path>
                    <path
                        d="M290.36,225.76v1.51h-.31v-.38a.93.93,0,0,1-.84.41c-.55,0-.89-.29-.89-.71s.24-.69.94-.69H290v-.15c0-.42-.23-.65-.69-.65a1.23,1.23,0,0,0-.81.29l-.15-.25a1.56,1.56,0,0,1,1-.33A.86.86,0,0,1,290.36,225.76Zm-.33.78v-.4h-.76c-.47,0-.63.19-.63.44s.23.46.62.46A.78.78,0,0,0,290,226.54Z"
                        id="el8shjxaexoej" class="animable" style="transform-origin: 289.343px 226.049px;"></path>
                    <path
                        d="M293.49,223.83v3.44h-.31v-.48a1.07,1.07,0,0,1-.95.51,1.25,1.25,0,0,1,0-2.49,1.06,1.06,0,0,1,.93.49v-1.47Zm-.32,2.22a.91.91,0,1,0-.91.95A.89.89,0,0,0,293.17,226.05Z"
                        id="eljhmrn5qoh3" class="animable" style="transform-origin: 292.291px 225.565px;"></path>
                    <path
                        d="M294.33,224.06a.24.24,0,0,1,.24-.23.24.24,0,0,1,.25.23.25.25,0,0,1-.49,0Zm.08.77h.33v2.44h-.33Z"
                        id="el9s5fqkb9jei" class="animable" style="transform-origin: 294.575px 225.55px;"></path>
                    <path
                        d="M298.13,226.05a1.19,1.19,0,0,1-1.22,1.25,1.07,1.07,0,0,1-.93-.49v1.36h-.33v-3.34H296v.49a1.06,1.06,0,0,1,.94-.51A1.19,1.19,0,0,1,298.13,226.05Zm-.33,0a.91.91,0,1,0-1.82,0,.91.91,0,1,0,1.82,0Z"
                        id="el2zruwn2ohww" class="animable" style="transform-origin: 296.891px 226.49px;"></path>
                    <path
                        d="M298.72,224.06a.24.24,0,0,1,.24-.23.23.23,0,0,1,.24.23.24.24,0,0,1-.24.24A.24.24,0,0,1,298.72,224.06Zm.08.77h.33v2.44h-.33Z"
                        id="elnnmjfv0h1xl" class="animable" style="transform-origin: 298.96px 225.55px;"></path>
                    <path
                        d="M299.7,227l.15-.26a1.46,1.46,0,0,0,.87.28c.46,0,.65-.16.65-.4,0-.64-1.58-.14-1.58-1.1,0-.4.34-.7,1-.7a1.67,1.67,0,0,1,.86.23l-.14.27a1.26,1.26,0,0,0-.72-.21c-.44,0-.64.17-.64.4,0,.66,1.58.16,1.58,1.1,0,.42-.37.7-1,.7A1.59,1.59,0,0,1,299.7,227Z"
                        id="el1zszp77s8q6" class="animable" style="transform-origin: 300.715px 226.066px;"></path>
                    <path
                        d="M302.06,226.05a1.2,1.2,0,0,1,1.26-1.24,1.09,1.09,0,0,1,1,.49l-.25.16a.85.85,0,0,0-.71-.36,1,1,0,0,0,0,1.9.84.84,0,0,0,.71-.35l.25.16a1.09,1.09,0,0,1-1,.49A1.21,1.21,0,0,1,302.06,226.05Z"
                        id="el0n38h7opjsql" class="animable" style="transform-origin: 303.19px 226.055px;"></path>
                    <path
                        d="M304.84,224.06a.24.24,0,0,1,.24-.23.23.23,0,0,1,.24.23.24.24,0,0,1-.24.24A.24.24,0,0,1,304.84,224.06Zm.08.77h.33v2.44h-.33Z"
                        id="elxjly6bn3nhr" class="animable" style="transform-origin: 305.08px 225.55px;"></path>
                    <path
                        d="M308.41,225.86v1.41h-.33v-1.38a.68.68,0,0,0-.73-.78.8.8,0,0,0-.86.88v1.28h-.33v-2.44h.32v.45a1,1,0,0,1,.93-.47A.94.94,0,0,1,308.41,225.86Z"
                        id="el49lqpup5le8" class="animable" style="transform-origin: 307.288px 226.038px;"></path>
                    <path
                        d="M311.57,224.83V227a1.07,1.07,0,0,1-1.22,1.22,1.72,1.72,0,0,1-1.14-.38l.17-.25a1.43,1.43,0,0,0,1,.33c.62,0,.9-.28.9-.88v-.31a1.1,1.1,0,0,1-.95.47,1.19,1.19,0,1,1,0-2.37,1.09,1.09,0,0,1,1,.49v-.47Zm-.32,1.16a.93.93,0,1,0-.93.9A.87.87,0,0,0,311.25,226Z"
                        id="el93yj4hsn1q8" class="animable" style="transform-origin: 310.307px 226.529px;"></path>
                    <path
                        d="M315.83,226.16h-2a.89.89,0,0,0,1,.84.93.93,0,0,0,.74-.32l.19.22a1.29,1.29,0,0,1-2.22-.85,1.17,1.17,0,0,1,1.19-1.24,1.16,1.16,0,0,1,1.18,1.24Zm-2-.25h1.73a.87.87,0,0,0-1.73,0Z"
                        id="elq2ihfl692mc" class="animable" style="transform-origin: 314.725px 226.053px;"></path>
                    <path d="M316.5,223.83h.33v3.44h-.33Z" id="elnowwzqz65oi" class="animable"
                        style="transform-origin: 316.665px 225.55px;"></path>
                    <path
                        d="M317.67,224.06a.24.24,0,0,1,.24-.23.24.24,0,0,1,.25.23.25.25,0,0,1-.49,0Zm.08.77h.33v2.44h-.33Z"
                        id="elo1k7rgf372" class="animable" style="transform-origin: 317.915px 225.55px;"></path>
                    <path
                        d="M320.28,227.12a.76.76,0,0,1-.51.18.65.65,0,0,1-.72-.71v-1.48h-.44v-.28h.44v-.53h.33v.53h.74v.28h-.74v1.46a.39.39,0,0,0,.42.44.54.54,0,0,0,.36-.12Z"
                        id="elk8dm01sxvsf" class="animable" style="transform-origin: 319.445px 225.802px;"></path>
                    <path
                        d="M321.2,227a.66.66,0,0,1-.06.27l-.2.64h-.22l.16-.67a.24.24,0,0,1-.17-.24.25.25,0,0,1,.25-.25A.24.24,0,0,1,321.2,227Z"
                        id="elc2xamotk784" class="animable" style="transform-origin: 320.955px 227.33px;"></path>
                    <path
                        d="M322.78,227l.15-.26a1.41,1.41,0,0,0,.87.28c.46,0,.65-.16.65-.4,0-.64-1.58-.14-1.58-1.1,0-.4.34-.7,1-.7a1.68,1.68,0,0,1,.87.23l-.15.27a1.24,1.24,0,0,0-.72-.21c-.44,0-.63.17-.63.4,0,.66,1.58.16,1.58,1.1,0,.42-.37.7-1,.7A1.58,1.58,0,0,1,322.78,227Z"
                        id="elyc07jgzjcdb" class="animable" style="transform-origin: 323.8px 226.066px;"></path>
                    <path
                        d="M327.51,226.16h-2a.91.91,0,0,0,1,.84,1,1,0,0,0,.75-.32l.18.22a1.29,1.29,0,0,1-2.22-.85,1.17,1.17,0,0,1,1.19-1.24,1.16,1.16,0,0,1,1.18,1.24Zm-2-.25h1.73a.87.87,0,0,0-1.73,0Z"
                        id="elqtmpiitpqx" class="animable" style="transform-origin: 326.405px 226.053px;"></path>
                    <path
                        d="M330.41,223.83v3.44h-.32v-.48a1,1,0,0,1-.94.51,1.25,1.25,0,0,1,0-2.49,1.06,1.06,0,0,1,.93.49v-1.47Zm-.32,2.22a.91.91,0,1,0-.91.95A.89.89,0,0,0,330.09,226.05Z"
                        id="eldxuadzawzz" class="animable" style="transform-origin: 329.211px 225.566px;"></path>
                    <path
                        d="M334.77,223.83v3.44h-.32v-.48a1.06,1.06,0,0,1-.94.51,1.25,1.25,0,0,1,0-2.49,1.07,1.07,0,0,1,.93.49v-1.47Zm-.33,2.22a.91.91,0,1,0-.9.95A.89.89,0,0,0,334.44,226.05Z"
                        id="eldsvxgoq64p" class="animable" style="transform-origin: 333.571px 225.565px;"></path>
                    <path d="M335.61,224.06a.24.24,0,1,1,.24.24A.23.23,0,0,1,335.61,224.06Zm.07.77H336v2.44h-.33Z"
                        id="el239g84kgr0z" class="animable" style="transform-origin: 335.85px 225.545px;"></path>
                    <path
                        d="M338.77,225.76v1.51h-.32v-.38a.9.9,0,0,1-.84.41c-.55,0-.89-.29-.89-.71s.24-.69.94-.69h.78v-.15a.6.6,0,0,0-.69-.65,1.21,1.21,0,0,0-.81.29l-.15-.25a1.53,1.53,0,0,1,1-.33A.87.87,0,0,1,338.77,225.76Zm-.33.78v-.4h-.77c-.47,0-.62.19-.62.44s.23.46.61.46A.78.78,0,0,0,338.44,226.54Z"
                        id="elx7epnvvxdtd" class="animable" style="transform-origin: 337.747px 226.053px;"></path>
                    <path
                        d="M343.69,225.86v1.41h-.33v-1.38c0-.51-.26-.78-.7-.78a.79.79,0,0,0-.82.88v1.28h-.33v-1.38c0-.51-.26-.78-.7-.78a.79.79,0,0,0-.82.88v1.28h-.33v-2.44H340v.45a1,1,0,0,1,.89-.47.88.88,0,0,1,.87.52,1.05,1.05,0,0,1,1-.52A.93.93,0,0,1,343.69,225.86Z"
                        id="eljmj8n6fam9h" class="animable" style="transform-origin: 341.679px 226.038px;"></path>
                    <path d="M346.51,225l-1.65.64,1.65.63v.39l-2.08-.82v-.4l2.08-.82Z" id="eljpdghuu7k3s"
                        class="animable" style="transform-origin: 345.47px 225.64px;"></path>
                    <path d="M348.22,223.37h.4l-1.53,4.37h-.4Z" id="elnd8dzarktv9" class="animable"
                        style="transform-origin: 347.655px 225.555px;"></path>
                    <path d="M351.73,224v3.24h-.47v-1.44H349.4v1.44h-.47V224h.47v1.39h1.86V224Z" id="el4haaljiszbd"
                        class="animable" style="transform-origin: 350.33px 225.62px;"></path>
                    <path d="M353.44,224v3.24H353v-2.84h-.73V224Z" id="elrbnqjf6vce" class="animable"
                        style="transform-origin: 352.855px 225.62px;"></path>
                    <path d="M356.31,225.45v.4l-2.08.82v-.39l1.66-.63-1.66-.64v-.38Z" id="el2bef2ig5mvo"
                        class="animable" style="transform-origin: 355.27px 225.65px;"></path>
                    <path d="M290.45,236.14l-1.64.63,1.64.64v.38l-2.08-.82v-.4l2.08-.82Z" id="elvsukhuw0zf"
                        class="animable" style="transform-origin: 289.41px 236.77px;"></path>
                    <path
                        d="M293.87,236.28c0,.7-.51,1.13-1.36,1.13h-.8v1h-.46v-3.24h1.26C293.36,235.15,293.87,235.57,293.87,236.28Zm-.47,0c0-.46-.31-.73-.9-.73h-.79V237h.79C293.09,237,293.4,236.74,293.4,236.28Z"
                        id="el4y0cd5cgpxl" class="animable" style="transform-origin: 292.56px 236.79px;"></path>
                    <path d="M296.49,236.57v.4l-2.07.82v-.38l1.65-.64-1.65-.63v-.39Z" id="el9pbhwvj44ed"
                        class="animable" style="transform-origin: 295.455px 236.77px;"></path>
                    <path d="M300.44,236.14l-1.65.63,1.65.64v.38l-2.08-.82v-.4l2.08-.82Z" id="elatxutjpkly9"
                        class="animable" style="transform-origin: 299.4px 236.77px;"></path>
                    <path d="M301.23,235.15h.47v3.24h-.47Z" id="el7nuiv33obhj" class="animable"
                        style="transform-origin: 301.465px 236.77px;"></path>
                    <path d="M305.68,238.39V236l-1.18,2h-.21l-1.18-2v2.35h-.44v-3.24h.38l1.35,2.28,1.34-2.28h.38v3.24Z"
                        id="el9w8p6chkrd8" class="animable" style="transform-origin: 304.395px 236.75px;"></path>
                    <path
                        d="M309.34,236.75h.45V238a1.92,1.92,0,0,1-1.23.41,1.66,1.66,0,1,1,1.26-2.82l-.29.29a1.28,1.28,0,0,0-.94-.38,1.25,1.25,0,1,0,0,2.5,1.34,1.34,0,0,0,.76-.21Z"
                        id="eldxnogg5e2tb" class="animable" style="transform-origin: 308.397px 236.751px;"></path>
                    <path
                        d="M311.62,238l.17-.36a1.67,1.67,0,0,0,1.07.38c.57,0,.81-.22.81-.5,0-.8-2-.3-2-1.5,0-.5.39-.93,1.24-.93a1.9,1.9,0,0,1,1.05.29l-.16.37a1.68,1.68,0,0,0-.89-.27c-.55,0-.79.24-.79.52,0,.79,2,.3,2,1.49,0,.49-.4.92-1.26.92A1.94,1.94,0,0,1,311.62,238Z"
                        id="elubq74mh3lm" class="animable" style="transform-origin: 312.87px 236.75px;"></path>
                    <path
                        d="M317,238.39l-.7-1h-1v1h-.46v-3.24h1.26c.85,0,1.36.42,1.36,1.13a1,1,0,0,1-.72,1l.77,1.09Zm0-2.11c0-.46-.31-.73-.9-.73h-.79V237h.79C316.64,237,317,236.74,317,236.28Z"
                        id="el63zca0p1xut" class="animable" style="transform-origin: 316.175px 236.77px;"></path>
                    <path
                        d="M317.9,236.77a1.64,1.64,0,0,1,1.72-1.66,1.61,1.61,0,0,1,1.24.51l-.31.29a1.18,1.18,0,0,0-.91-.39,1.25,1.25,0,1,0,0,2.5,1.21,1.21,0,0,0,.91-.39l.31.29a1.61,1.61,0,0,1-1.24.51A1.64,1.64,0,0,1,317.9,236.77Z"
                        id="el8ti6noyixts" class="animable" style="transform-origin: 319.38px 236.77px;"></path>
                    <path d="M321.34,236h2.08v.36h-2.08Zm0,1.1h2.08v.36h-2.08Z" id="elmbt7gnb3bf" class="animable"
                        style="transform-origin: 322.38px 236.73px;"></path>
                    <path d="M325.26,235.15h.39l0,1.25h-.33Zm.84,0h.39l0,1.25h-.33Z" id="elr3gait0kjlg" class="animable"
                        style="transform-origin: 325.875px 235.775px;"></path>
                    <path d="M327.27,235.15h.46V238h1.76v.4h-2.22Z" id="elpeb2ni7iww" class="animable"
                        style="transform-origin: 328.38px 236.775px;"></path>
                    <path
                        d="M329.7,237.16a1.28,1.28,0,1,1,1.28,1.26A1.22,1.22,0,0,1,329.7,237.16Zm2.1,0a.83.83,0,1,0-1.65,0,.83.83,0,1,0,1.65,0Z"
                        id="elxxh7z25ir9k" class="animable" style="transform-origin: 330.98px 237.141px;"></path>
                    <path
                        d="M334.19,235.91v.43h-.1a.74.74,0,0,0-.78.83v1.22h-.44v-2.45h.42v.41A1,1,0,0,1,334.19,235.91Z"
                        id="elzi8rl8gq4rr" class="animable" style="transform-origin: 333.53px 237.149px;"></path>
                    <path
                        d="M336.93,237.31h-2a.83.83,0,0,0,.89.72.91.91,0,0,0,.71-.29l.25.28a1.35,1.35,0,0,1-2.3-.86,1.21,1.21,0,0,1,1.24-1.25,1.18,1.18,0,0,1,1.21,1.27Zm-2-.32h1.58a.8.8,0,0,0-1.58,0Z"
                        id="elyasjxiyjpxc" class="animable" style="transform-origin: 335.706px 237.162px;"></path>
                    <path
                        d="M341.63,237v1.41h-.44V237c0-.48-.24-.72-.64-.72s-.74.28-.74.82v1.26h-.44V237c0-.48-.23-.72-.64-.72a.72.72,0,0,0-.74.82v1.26h-.44v-2.45H338v.36a1,1,0,0,1,.84-.39.91.91,0,0,1,.86.46,1.1,1.1,0,0,1,.94-.46A1,1,0,0,1,341.63,237Z"
                        id="elxb0jeto5cr" class="animable" style="transform-origin: 339.594px 237.144px;"></path>
                    <path
                        d="M343.61,235.18a.3.3,0,0,1,.31-.3.29.29,0,1,1,0,.58A.29.29,0,0,1,343.61,235.18Zm.08.76h.45v2.45h-.45Z"
                        id="elc4jeyitmite" class="animable" style="transform-origin: 343.91px 236.635px;"></path>
                    <path
                        d="M347.53,237.16a1.19,1.19,0,0,1-1.24,1.26,1,1,0,0,1-.86-.4v1.27H345v-3.35h.42v.39a1,1,0,0,1,.88-.42A1.19,1.19,0,0,1,347.53,237.16Zm-.45,0a.83.83,0,1,0-.83.87A.81.81,0,0,0,347.08,237.16Z"
                        id="eli3es8bczrn" class="animable" style="transform-origin: 346.266px 237.599px;"></path>
                    <path
                        d="M347.84,238.13l.18-.35a1.56,1.56,0,0,0,.86.26c.42,0,.59-.13.59-.34,0-.55-1.56-.07-1.56-1,0-.44.4-.74,1-.74a1.75,1.75,0,0,1,.89.23l-.18.35a1.26,1.26,0,0,0-.71-.2c-.39,0-.58.15-.58.34,0,.58,1.55.11,1.55,1.06,0,.45-.4.73-1.06.73A1.68,1.68,0,0,1,347.84,238.13Z"
                        id="eljjrgs7a9ima" class="animable" style="transform-origin: 348.86px 237.215px;"></path>
                    <path
                        d="M352.76,235.94v2.45h-.42V238a1,1,0,0,1-.84.4,1,1,0,0,1-1.06-1.07v-1.41h.45v1.36c0,.48.24.72.66.72a.71.71,0,0,0,.76-.81v-1.27Z"
                        id="elfsz2kywcydg" class="animable" style="transform-origin: 351.599px 237.161px;"></path>
                    <path
                        d="M357.69,237v1.41h-.45V237c0-.48-.23-.72-.63-.72s-.74.28-.74.82v1.26h-.45V237c0-.48-.23-.72-.63-.72s-.74.28-.74.82v1.26h-.44v-2.45H354v.36a1,1,0,0,1,.85-.39.9.9,0,0,1,.85.46,1.12,1.12,0,0,1,.95-.46A1,1,0,0,1,357.69,237Z"
                        id="el63vv6apvnl" class="animable" style="transform-origin: 355.654px 237.144px;"></path>
                    <path d="M358.37,235.15h.39l0,1.25h-.33Zm.84,0h.39l0,1.25h-.33Z" id="eljr8tm5ly3oc" class="animable"
                        style="transform-origin: 358.985px 235.775px;"></path>
                    <path d="M362.28,236.57v.4l-2.08.82v-.38l1.65-.64-1.65-.63v-.39Z" id="elzklbr0358hl"
                        class="animable" style="transform-origin: 361.24px 236.77px;"></path>
                    <path d="M365,236.14l-1.65.63,1.65.64v.38L362.9,237v-.4l2.08-.82Z" id="elgrwy5zauni9"
                        class="animable" style="transform-origin: 363.95px 236.785px;"></path>
                    <path d="M366.69,234.49h.4l-1.53,4.37h-.4Z" id="elyvnl47y9kul" class="animable"
                        style="transform-origin: 366.125px 236.675px;"></path>
                    <path
                        d="M370,236.28c0,.7-.51,1.13-1.36,1.13h-.8v1h-.47v-3.24h1.27C369.52,235.15,370,235.57,370,236.28Zm-.47,0c0-.46-.31-.73-.9-.73h-.79V237h.79C369.25,237,369.56,236.74,369.56,236.28Z"
                        id="elswhqyxmlir" class="animable" style="transform-origin: 368.685px 236.79px;"></path>
                    <path d="M372.65,236.57v.4l-2.08.82v-.38l1.66-.64-1.66-.63v-.39Z" id="elpgmhr90g18p"
                        class="animable" style="transform-origin: 371.61px 236.77px;"></path>
                    <path d="M290.45,247.26l-1.64.63,1.64.64v.38l-2.08-.82v-.4l2.08-.82Z" id="elp2ndl49ywqd"
                        class="animable" style="transform-origin: 289.41px 247.89px;"></path>
                    <path d="M292.16,245.61h.41L291,250h-.4Z" id="el1nqx57qsoiu" class="animable"
                        style="transform-origin: 291.585px 247.805px;"></path>
                    <path
                        d="M295.67,248.64c0,.56-.42.88-1.24.88h-1.55v-3.25h1.45c.75,0,1.17.31,1.17.84a.76.76,0,0,1-.44.72A.79.79,0,0,1,295.67,248.64Zm-2.33-2v1h1c.48,0,.75-.17.75-.52s-.27-.52-.75-.52Zm1.86,2c0-.37-.28-.54-.79-.54h-1.07v1.08h1.07C294.92,249.14,295.2,249,295.2,248.6Z"
                        id="elb09p8cjzhnw" class="animable" style="transform-origin: 294.276px 247.895px;"></path>
                    <path
                        d="M296.12,247.89a1.73,1.73,0,1,1,1.73,1.66A1.65,1.65,0,0,1,296.12,247.89Zm3,0a1.26,1.26,0,1,0-1.26,1.25A1.22,1.22,0,0,0,299.11,247.89Z"
                        id="el54w14u8mbyv" class="animable" style="transform-origin: 297.849px 247.821px;"></path>
                    <path
                        d="M300.28,246.27h1.37a1.63,1.63,0,1,1,0,3.25h-1.37Zm1.34,2.84a1.22,1.22,0,1,0,0-2.44h-.88v2.44Z"
                        id="elk59db9flaga" class="animable" style="transform-origin: 301.844px 247.895px;"></path>
                    <path d="M305.21,248.39v1.13h-.46v-1.14l-1.29-2.11h.5l1,1.71,1-1.71h.46Z" id="elvml65y7dtzf"
                        class="animable" style="transform-origin: 304.94px 247.895px;"></path>
                    <path d="M308.87,247.69v.4l-2.08.82v-.38l1.65-.64-1.65-.63v-.39Z" id="elyugp7d2z14j"
                        class="animable" style="transform-origin: 307.83px 247.89px;"></path>
                    <path
                        d="M415.21,160.36c0,.15-32.09.26-71.67.26s-71.68-.11-71.68-.26,32.08-.26,71.68-.26S415.21,160.22,415.21,160.36Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 343.535px 160.36px;" id="el3q327ffm5gc"
                        class="animable"></path>
                    <path d="M276.15,155.24a.92.92,0,1,1-.92-.92A.93.93,0,0,1,276.15,155.24Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 275.23px 155.24px;" id="elct4f6fznhqj"
                        class="animable"></path>
                    <circle cx="278.77" cy="155.24" r="0.92"
                        style="fill: rgb(38, 50, 56); transform-origin: 278.77px 155.24px;" id="elcxqblcu7us"
                        class="animable"></circle>
                    <path d="M283.24,155.24a.93.93,0,1,1-.92-.92A.93.93,0,0,1,283.24,155.24Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 282.31px 155.25px;" id="elmnqjpo0biia"
                        class="animable"></path>
                    <path
                        d="M281,268.78c-.14,0-.26-24.33-.26-54.33s.12-54.34.26-54.34.26,24.32.26,54.34S281.1,268.78,281,268.78Z"
                        style="fill: rgb(224, 224, 224); transform-origin: 281px 214.445px;" id="el6wlaj5znluo"
                        class="animable"></path>
                    <rect x="80.21" y="54.78" width="59.25" height="42.24"
                        style="fill: rgb(18, 17, 17); transform-origin: 109.835px 75.9px;" id="eldx2ftbr02ue"
                        class="animable"></rect>
                    <path
                        d="M139.93,61.05c0,.14-13.38.26-29.87.26s-29.88-.12-29.88-.26,13.38-.26,29.88-.26S139.93,60.9,139.93,61.05Z"
                        style="fill: rgb(255, 255, 255); transform-origin: 110.055px 61.05px;" id="elmxgil1v6aye"
                        class="animable"></path>
                    <path d="M85.05,58a.81.81,0,1,1-.8-.7A.75.75,0,0,1,85.05,58Z"
                        style="fill: rgb(255, 255, 255); transform-origin: 84.2475px 58.1091px;" id="elnr2br5m35l"
                        class="animable"></path>
                    <path d="M88,58a.74.74,0,0,1-.79.7A.71.71,0,1,1,88,58Z"
                        style="fill: rgb(255, 255, 255); transform-origin: 87.29px 57.9931px;" id="elvs181sks40g"
                        class="animable"></path>
                    <ellipse cx="90.06" cy="57.96" rx="0.8" ry="0.7"
                        style="fill: rgb(255, 255, 255); transform-origin: 90.06px 57.96px;" id="el9l11cjzm7wi"
                        class="animable"></ellipse>
                    <path
                        d="M102.12,77.89c0,2.54-1.83,4.07-4.86,4.07h-3.2v3.76H92.8V73.81h4.46C100.29,73.81,102.12,75.34,102.12,77.89Zm-1.25,0c0-1.9-1.26-3-3.65-3H94.06v5.95h3.16C99.61,80.85,100.87,79.76,100.87,77.89Z"
                        style="fill: rgb(255, 255, 255); transform-origin: 97.46px 79.765px;" id="elhcjoahf44nn"
                        class="animable"></path>
                    <path d="M114.79,73.81V85.72h-1.24v-5.5H106.1v5.5h-1.26V73.81h1.26v5.31h7.45V73.81Z"
                        style="fill: rgb(255, 255, 255); transform-origin: 109.815px 79.765px;" id="el35epsz9o5xb"
                        class="animable"></path>
                    <path
                        d="M128,77.89c0,2.54-1.83,4.07-4.86,4.07h-3.2v3.76h-1.26V73.81h4.46C126.16,73.81,128,75.34,128,77.89Zm-1.26,0c0-1.9-1.26-3-3.64-3h-3.16v5.95h3.16C125.47,80.85,126.73,79.76,126.73,77.89Z"
                        style="fill: rgb(255, 255, 255); transform-origin: 123.34px 79.765px;" id="elw4a1h127q1f"
                        class="animable"></path>
                    <rect x="402.39" y="216.3" width="53.56" height="38.18"
                        style="fill: rgb(18, 17, 17); transform-origin: 429.17px 235.39px;" id="elgo2lugytook"
                        class="animable"></rect>
                    <path d="M420.45,234v7.58H418.7v-3.1h-3.44v3.1H413.5V234h1.76v3h3.44v-3Z"
                        style="fill: rgb(255, 255, 255); transform-origin: 416.975px 237.79px;" id="elz61ba7emj1"
                        class="animable"></path>
                    <path d="M423.82,235.46h-2.43V234H428v1.43h-2.43v6.15h-1.75Z"
                        style="fill: rgb(255, 255, 255); transform-origin: 424.695px 237.79px;" id="elvebxawfc83"
                        class="animable"></path>
                    <path d="M438.13,234h1.76v6.15h3.8v1.43h-5.56Z"
                        style="fill: rgb(255, 255, 255); transform-origin: 440.91px 237.79px;" id="elpepxsbyjhj"
                        class="animable"></path>
                    <path
                        d="M435.56,241.61v-4.54l-2.23,3.74h-.79l-2.22-3.65v4.45h-1.65V234h1.45l2.84,4.71,2.79-4.71h1.44l0,7.58Z"
                        style="fill: rgb(255, 255, 255); transform-origin: 432.93px 237.805px;" id="elf0l8zw5w5jt"
                        class="animable"></path>
                    <path
                        d="M456.37,222c0,.09-12.09.17-27,.17s-27-.08-27-.17,12.09-.17,27-.17S456.37,221.88,456.37,222Z"
                        style="fill: rgb(255, 255, 255); transform-origin: 429.37px 222px;" id="ela70plm70fpm"
                        class="animable"></path>
                    <path d="M406.76,219.18a.73.73,0,0,1-1.44,0,.73.73,0,0,1,1.44,0Z"
                        style="fill: rgb(255, 255, 255); transform-origin: 406.04px 219.18px;" id="elx8fvflju82f"
                        class="animable"></path>
                    <path d="M409.39,219.18a.73.73,0,0,1-1.44,0,.73.73,0,0,1,1.44,0Z"
                        style="fill: rgb(255, 255, 255); transform-origin: 408.67px 219.18px;" id="elf1nzqb5khnp"
                        class="animable"></path>
                    <path d="M412,219.18a.73.73,0,1,1-.72-.63A.68.68,0,0,1,412,219.18Z"
                        style="fill: rgb(255, 255, 255); transform-origin: 411.277px 219.279px;" id="elaqk67de2nod"
                        class="animable"></path>
                    <rect x="51.78" y="215.76" width="39.49" height="28.15"
                        style="fill: rgb(18, 17, 17); transform-origin: 71.525px 229.835px;" id="elx5lmvpnn7fq"
                        class="animable"></rect>
                    <path
                        d="M91.57,219.93c0,.07-8.91.13-19.9.13s-19.91-.06-19.91-.13,8.91-.12,19.91-.12S91.57,219.86,91.57,219.93Z"
                        style="fill: rgb(255, 255, 255); transform-origin: 71.665px 219.935px;" id="eld9xxf0v9sfr"
                        class="animable"></path>
                    <path d="M55,217.88a.5.5,0,0,1-.53.46.49.49,0,0,1-.53-.46.5.5,0,0,1,.53-.47A.5.5,0,0,1,55,217.88Z"
                        style="fill: rgb(255, 255, 255); transform-origin: 54.47px 217.875px;" id="el7leor1esak"
                        class="animable"></path>
                    <path d="M56.94,217.88a.54.54,0,0,1-1.07,0,.54.54,0,0,1,1.07,0Z"
                        style="fill: rgb(255, 255, 255); transform-origin: 56.405px 217.88px;" id="eluobxrsqatk"
                        class="animable"></path>
                    <path d="M58.88,217.88a.54.54,0,1,1-.54-.47A.51.51,0,0,1,58.88,217.88Z"
                        style="fill: rgb(255, 255, 255); transform-origin: 58.3446px 217.95px;" id="elyj1t0s7z16h"
                        class="animable"></path>
                    <path
                        d="M287.05,107.29a7.4,7.4,0,0,1,7.67-7.51,7.07,7.07,0,0,1,5.27,2l-.68.7a6.18,6.18,0,0,0-4.54-1.75,6.51,6.51,0,1,0,0,13,6.2,6.2,0,0,0,4.54-1.78l.68.7a7.09,7.09,0,0,1-5.27,2.07A7.39,7.39,0,0,1,287.05,107.29Z"
                        style="fill: rgb(18, 17, 17); transform-origin: 293.52px 107.249px;" id="elc109fn1qtnj"
                        class="animable"></path>
                    <path
                        d="M302,112.78l.48-.8a7.08,7.08,0,0,0,4.88,1.86c3,0,4.27-1.29,4.27-2.9,0-4.44-9.23-1.77-9.23-7.22,0-2.1,1.6-3.94,5.24-3.94a7.89,7.89,0,0,1,4.46,1.34l-.4.86a7.37,7.37,0,0,0-4.06-1.24c-2.88,0-4.16,1.33-4.16,3,0,4.44,9.23,1.82,9.23,7.19,0,2.09-1.67,3.91-5.33,3.91A7.58,7.58,0,0,1,302,112.78Z"
                        style="fill: rgb(18, 17, 17); transform-origin: 307.355px 107.311px;" id="elxrl8q3quiwp"
                        class="animable"></path>
                    <path
                        d="M314.88,112.78l.49-.8a7.06,7.06,0,0,0,4.88,1.86c3,0,4.27-1.29,4.27-2.9,0-4.44-9.23-1.77-9.23-7.22,0-2.1,1.6-3.94,5.24-3.94a7.94,7.94,0,0,1,4.46,1.34l-.4.86a7.37,7.37,0,0,0-4.06-1.24c-2.88,0-4.17,1.33-4.17,3,0,4.44,9.24,1.82,9.24,7.19,0,2.09-1.67,3.91-5.33,3.91A7.62,7.62,0,0,1,314.88,112.78Z"
                        style="fill: rgb(18, 17, 17); transform-origin: 320.24px 107.311px;" id="eltecwq25wkb"
                        class="animable"></path>
                    <path
                        d="M338.19,126.52s0-.27,0-.78,0-1.28,0-2.26c0-2,0-4.87-.06-8.56,0-7.39-.06-18-.1-31l.2.21-65.88,0h0l.26-.26c0,15.12,0,29.51,0,42.56l-.24-.24,47.4.12,13.59.06,3.63,0,.94,0h0l-.91,0-3.58,0-13.54.06-47.56.12h-.24v-.24c0-13,0-27.44,0-42.56V83.7h.27l65.88.06h.21V84c0,13-.08,23.67-.11,31.09,0,3.67,0,6.54-.05,8.52,0,1,0,1.69,0,2.21S338.19,126.52,338.19,126.52Z"
                        style="fill: rgb(18, 17, 17); transform-origin: 305.28px 105.125px;" id="elbpaoidn8r9"
                        class="animable"></path>
                    <path
                        d="M338.19,90.28c0,.14-14.76.26-33,.26s-33-.12-33-.26S287,90,305.23,90,338.19,90.13,338.19,90.28Z"
                        style="fill: rgb(18, 17, 17); transform-origin: 305.19px 90.27px;" id="el4gcwiukvwzr"
                        class="animable"></path>
                    <path d="M277.17,87.17a.81.81,0,1,1-.8-.7A.75.75,0,0,1,277.17,87.17Z"
                        style="fill: rgb(18, 17, 17); transform-origin: 276.368px 87.2791px;" id="el4de5qc1pqer"
                        class="animable"></path>
                    <path d="M280.1,87.17a.81.81,0,1,1-.8-.7A.75.75,0,0,1,280.1,87.17Z"
                        style="fill: rgb(18, 17, 17); transform-origin: 279.298px 87.2791px;" id="elfhhcruvm8e"
                        class="animable"></path>
                    <path d="M283,87.17a.81.81,0,1,1-.8-.7A.75.75,0,0,1,283,87.17Z"
                        style="fill: rgb(18, 17, 17); transform-origin: 282.198px 87.2791px;" id="ellejhwkjqxb"
                        class="animable"></path>
                </g>
                <g id="freepik--Character--inject-993" class="animable" style="transform-origin: 251.345px 306.536px;">
                    <path
                        d="M147.88,272,174,360.13a9.23,9.23,0,0,0,8.84,6.61l106,.29a9.81,9.81,0,0,0,9.82-10.32h0a9.81,9.81,0,0,0-9.79-9.28H248.34L215.88,257H159.06A11.66,11.66,0,0,0,147.88,272Z"
                        style="fill: rgb(69, 90, 100); transform-origin: 223.032px 312.015px;" id="elynzw2tvsbjg"
                        class="animable"></path>
                    <path
                        d="M237.56,354.67c0,.21-10.81.37-24.14.37s-24.13-.16-24.13-.37,10.8-.37,24.13-.37S237.56,354.46,237.56,354.67Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 213.425px 354.67px;" id="elekws0t9mpza"
                        class="animable"></path>
                    <path
                        d="M155.68,259.78c.19-.06,7.41,21.05,16.12,47.16s15.6,47.33,15.41,47.39-7.41-21-16.12-47.16S155.48,259.85,155.68,259.78Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 171.445px 307.055px;" id="elr6ku2umfie"
                        class="animable"></path>
                    <polygon points="233.15 445.09 226.69 444.94 226.69 366.74 233.15 366.74 233.15 445.09"
                        style="fill: rgb(69, 90, 100); transform-origin: 229.92px 405.915px;" id="ellmg5j2s86i"
                        class="animable"></polygon>
                    <polygon points="199.86 444.73 259.99 444.73 232.75 435.26 226.29 435.26 199.86 444.73"
                        style="fill: rgb(69, 90, 100); transform-origin: 229.925px 439.995px;" id="el8hulqy79os"
                        class="animable"></polygon>
                    <path
                        d="M184.65,236.76l9.95,49.71-1.78,37.25L259.7,312.6,257.08,280,257,253l16.4,31.78,12.76-24.67-23.37-42.35h0a39.47,39.47,0,0,0-15.29-9.9,31.37,31.37,0,0,0-9.59-1.84h0a38.35,38.35,0,0,1-23.15,0c-.94.12-2.24.25-3.89.44l-.3,0a29.57,29.57,0,0,0-25.81,27.8Z"
                        style="fill: rgb(18, 17, 17); transform-origin: 235.405px 264.87px;" id="el1vf1a0povzp"
                        class="animable"></path>
                    <path d="M210.89,206.47s-27.48.21-30.88,29.23L179.55,257l23.66-.2Z"
                        style="fill: rgb(18, 17, 17); transform-origin: 195.22px 231.735px;" id="elhvluu8fdw4n"
                        class="animable"></path>
                    <path
                        d="M276.54,243.8c0,.21-21.62.38-48.29.38S180,244,180,243.8s21.61-.37,48.29-.37S276.54,243.6,276.54,243.8Z"
                        style="fill: rgb(250, 250, 250); transform-origin: 228.27px 243.805px;" id="eltaeg6azrse9"
                        class="animable"></path>
                    <path
                        d="M276.54,248.41c0,.2-21.62.37-48.29.37s-48.29-.17-48.29-.37,21.61-.38,48.29-.38S276.54,248.2,276.54,248.41Z"
                        style="fill: rgb(250, 250, 250); transform-origin: 228.25px 248.405px;" id="elp5f7wlei54g"
                        class="animable"></path>
                    <path d="M275,240c0,.21-21.27.38-47.51.38S180,240.2,180,240s21.27-.37,47.52-.37S275,239.79,275,240Z"
                        style="fill: rgb(250, 250, 250); transform-origin: 227.5px 240.005px;" id="el9pnjj2wtlaa"
                        class="animable"></path>
                    <path
                        d="M256.67,284.77c-.21,0-.12-11.77.2-26.27s.75-26.26.95-26.26.12,11.77-.2,26.27S256.87,284.77,256.67,284.77Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 257.243px 258.505px;" id="elafwblws46v"
                        class="animable"></path>
                    <path
                        d="M247.27,265.69s13,.93,15.34,4.37,5.91,13.23,4.56,13.3a3.68,3.68,0,0,1-2.34-.73l-3.56-6.32s.57,6.1-1.56,6.22S247,284.77,247,284.77Z"
                        style="fill: rgb(255, 190, 157); transform-origin: 257.233px 275.23px;" id="el19lu9pbdxpb"
                        class="animable"></path>
                    <path
                        d="M179.56,251.32l-.05,33.51a12.73,12.73,0,0,0,15.42,11.75l52.41-10.8-.11-21.49L202,273l-.6-22.75Z"
                        style="fill: rgb(18, 17, 17); transform-origin: 213.425px 273.561px;" id="elb5uk046zfeh"
                        class="animable"></path>
                    <path
                        d="M209.46,293.89a4.51,4.51,0,0,1,.69-.19l2-.46,7.7-1.63L247.16,286l-.27.32c0-6.74,0-14.2,0-22.07l.44.37-9.22,1.77-36,6.85-.39.08V273c.34-10,.63-18.28.83-24.16.12-2.86.21-5.13.28-6.75,0-.73.07-1.32.1-1.77a2.7,2.7,0,0,1,.07-.61,4.81,4.81,0,0,1,0,.61c0,.46,0,1,0,1.78,0,1.62-.06,3.89-.1,6.75-.14,5.89-.33,14.19-.56,24.16l-.38-.31,36-7,9.22-1.76.44-.09v.45c0,7.87,0,15.33,0,22.07v.28l-.27.05L220,292l-7.74,1.45-2.05.36A3.47,3.47,0,0,1,209.46,293.89Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 224.67px 266.8px;" id="elc93vlcq55qv"
                        class="animable"></path>
                    <path
                        d="M239.52,206.47s.1.16.21.49a10.15,10.15,0,0,1,.41,1.48,12.09,12.09,0,0,1-.25,5.64,14.82,14.82,0,0,1-4.54,7,14.14,14.14,0,0,1-9.54,3.61,13,13,0,0,1-9.43-3.83,13.25,13.25,0,0,1-3.51-7.59,11.86,11.86,0,0,1,.66-5.61,7.74,7.74,0,0,1,.67-1.38c.18-.3.28-.45.31-.44s-.32.67-.71,1.92a12.65,12.65,0,0,0-.41,5.44,13,13,0,0,0,3.48,7.18,12.42,12.42,0,0,0,8.94,3.56,13.62,13.62,0,0,0,9.08-3.37,14.63,14.63,0,0,0,4.5-6.66,12.67,12.67,0,0,0,.46-5.44C239.68,207.19,239.44,206.49,239.52,206.47Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 226.57px 215.266px;" id="el9ke6vs75t1d"
                        class="animable"></path>
                    <path
                        d="M242.05,287.56a15.75,15.75,0,0,1,0-3.31c.08-2,.18-4.84.2-7.94s0-5.91-.11-7.95a16.25,16.25,0,0,1,0-3.31,13.2,13.2,0,0,1,.5,3.28c.19,2,.34,4.86.32,8s-.2,5.94-.41,8A13.55,13.55,0,0,1,242.05,287.56Z"
                        style="fill: rgb(250, 250, 250); transform-origin: 242.462px 276.305px;" id="elxje52tgafmb"
                        class="animable"></path>
                    <path
                        d="M239.34,288.11a16.38,16.38,0,0,1-.09-3.29c0-2.31.05-5,.08-7.89V269a15.45,15.45,0,0,1,.12-3.28,13.33,13.33,0,0,1,.41,3.26c.13,2,.24,4.83.22,7.92s-.14,5.89-.3,7.92A13.58,13.58,0,0,1,239.34,288.11Z"
                        style="fill: rgb(250, 250, 250); transform-origin: 239.644px 276.915px;" id="el1u9n72mufi2"
                        class="animable"></path>
                    <path
                        d="M291.83,421.25l9.9,27.28,14.06,19.31a3,3,0,0,1-.83,4.27h0a3,3,0,0,1-2.71.23c-5.67-2.35-26.47-11.11-27.09-13.14-.71-2.36-14.14-31.7-14.14-31.7Z"
                        style="fill: rgb(18, 17, 17); transform-origin: 293.683px 446.905px;" id="elism4b1oe36"
                        class="animable"></path>
                    <g id="elrpccpeaqav">
                        <g style="opacity: 0.6; transform-origin: 299.745px 464.984px;" class="animable">
                            <path
                                d="M315,472.11l-30.51-14.74.45,1.15a4.54,4.54,0,0,0,2,2.32c2.5,1.35,9.5,4.92,25.23,11.53a3,3,0,0,0,2.79-.26Z"
                                style="fill: rgb(255, 255, 255); transform-origin: 299.745px 464.984px;"
                                id="el9wqe933x40t" class="animable"></path>
                        </g>
                    </g>
                    <g id="el758s5qt7pod">
                        <g style="opacity: 0.6; transform-origin: 286.227px 448.148px;" class="animable">
                            <path
                                d="M286.61,446.49a1.79,1.79,0,0,1,1.31,2,1.73,1.73,0,0,1-2,1.32,1.89,1.89,0,0,1-1.38-2.14,1.8,1.8,0,0,1,2.21-1.14"
                                style="fill: rgb(255, 255, 255); transform-origin: 286.227px 448.148px;"
                                id="elfw6mkyfwnxl" class="animable"></path>
                        </g>
                    </g>
                    <path
                        d="M304.18,462.7a8.91,8.91,0,0,1,1.56-3c1.27-1.42,2.91-1.63,2.88-1.81s-.43-.15-1.1,0a4.76,4.76,0,0,0-3.43,3.74C304,462.29,304.11,462.7,304.18,462.7Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 306.338px 460.233px;" id="el76ib5o3dxd3"
                        class="animable"></path>
                    <path
                        d="M307.52,465.57c.17.07.7-1.15,1.94-2.1a22.3,22.3,0,0,1,2.51-1.36c0-.17-1.5-.24-2.9.86S307.35,465.55,307.52,465.57Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 309.724px 463.793px;" id="elh77pytovleh"
                        class="animable"></path>
                    <path
                        d="M298.79,459.45c.18.08,1-1.79,2.78-3.43s3.71-2.32,3.65-2.5-2.17.24-4.08,2S298.63,459.43,298.79,459.45Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 301.993px 456.467px;" id="eld3lsdhlt3vc"
                        class="animable"></path>
                    <path
                        d="M295.09,451.41c.13.14,1.38-1.07,3.3-1.9s3.64-1,3.63-1.15-1.84-.34-3.89.57S295,451.32,295.09,451.41Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 298.552px 449.827px;" id="el30xj2g0zeey"
                        class="animable"></path>
                    <path
                        d="M292,443.48c.14.12,1.29-1.36,3.38-2.07s3.9-.31,3.94-.49-.41-.3-1.17-.42a6.5,6.5,0,0,0-5.5,1.92C292.11,443,291.91,443.43,292,443.48Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 295.651px 441.967px;" id="elnbxsy4oolp"
                        class="animable"></path>
                    <path
                        d="M294.73,439.92a2.66,2.66,0,0,0-.37-1,7.61,7.61,0,0,0-1.85-2.36,3.36,3.36,0,0,0-1.94-1,1.2,1.2,0,0,0-1.16.74,1.93,1.93,0,0,0,0,1.38A4.2,4.2,0,0,0,294.3,440a4.86,4.86,0,0,0,3.54-4.11,1.7,1.7,0,0,0-.43-1.34,1.19,1.19,0,0,0-1.37-.14,4.16,4.16,0,0,0-1.42,1.62,8.69,8.69,0,0,0-1,2.82,2.46,2.46,0,0,0,0,1.1,13.23,13.23,0,0,1,1.46-3.68,3.92,3.92,0,0,1,1.27-1.38.62.62,0,0,1,.75.07,1.16,1.16,0,0,1,.24.89,4.36,4.36,0,0,1-3.11,3.53,3.63,3.63,0,0,1-4.14-1.88,1.39,1.39,0,0,1-.08-1,.65.65,0,0,1,.64-.41,3.05,3.05,0,0,1,1.65.8A11.13,11.13,0,0,1,294.73,439.92Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 293.567px 437.197px;" id="elevrbwk8ytqj"
                        class="animable"></path>
                    <path d="M333.64,414.11l-.85,22.17s22.24,8.32,22.48,12.43l-43-.12L312.15,414Z"
                        style="fill: rgb(18, 17, 17); transform-origin: 333.71px 431.355px;" id="elr7vsj7o1jye"
                        class="animable"></path>
                    <g id="elrh65ds6pog">
                        <g style="opacity: 0.6; transform-origin: 319.903px 435.996px;" class="animable">
                            <path
                                d="M319.48,434.38a1.76,1.76,0,0,0-1.22,2,1.69,1.69,0,0,0,2,1.23,1.86,1.86,0,0,0,1.28-2.13,1.77,1.77,0,0,0-2.2-1.05"
                                style="fill: rgb(255, 255, 255); transform-origin: 319.903px 435.996px;"
                                id="elytqhm2abft" class="animable"></path>
                        </g>
                    </g>
                    <g id="elknm8wawhlse">
                        <g style="opacity: 0.6; transform-origin: 333.764px 446.925px;" class="animable">
                            <path d="M312.23,448.59v-3.45l41.36,1.38s1.91.84,1.69,2.19Z"
                                style="fill: rgb(255, 255, 255); transform-origin: 333.764px 446.925px;"
                                id="elgma6xxmba0v" class="animable"></path>
                        </g>
                    </g>
                    <path
                        d="M333.48,436.06c0,.21-1.05.31-2.09,1s-1.59,1.56-1.78,1.47.12-1.3,1.39-2.09S333.53,435.87,333.48,436.06Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 331.52px 437.208px;" id="elp3emeha7b2h"
                        class="animable"></path>
                    <path
                        d="M338,437.94c.05.21-.86.56-1.58,1.45s-.92,1.83-1.13,1.82-.34-1.2.57-2.29S338,437.74,338,437.94Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 336.57px 439.533px;" id="elzj8c4t5pfin"
                        class="animable"></path>
                    <path
                        d="M340.54,443.35c-.19,0-.48-1,.07-2.15s1.52-1.61,1.61-1.43-.52.79-1,1.74S340.75,443.33,340.54,443.35Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 341.26px 441.541px;" id="eljtgyupi9hv"
                        class="animable"></path>
                    <path
                        d="M333.12,431c-.09.19-1.05-.1-2.24,0s-2.12.45-2.23.27.79-.93,2.19-1S333.22,430.83,333.12,431Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 330.884px 430.793px;" id="el7cfv6zdcsna"
                        class="animable"></path>
                    <g id="elr4hl96jcjoa">
                        <g style="opacity: 0.3; transform-origin: 322.81px 420.475px;" class="animable">
                            <polygon points="333.47 418.5 333.32 422.45 312.17 422.2 312.15 418.64 333.47 418.5"
                                id="elrle8wv95gi" class="animable" style="transform-origin: 322.81px 420.475px;">
                            </polygon>
                        </g>
                    </g>
                    <path
                        d="M333.21,426.52a4.19,4.19,0,0,1-2.16,0,10.17,10.17,0,0,1-2.25-.7,10,10,0,0,1-1.24-.66,3,3,0,0,1-.65-.51.92.92,0,0,1-.09-1.12,1.16,1.16,0,0,1,.92-.48,2.71,2.71,0,0,1,.81.12,8.43,8.43,0,0,1,1.34.46,7.56,7.56,0,0,1,2,1.31c1,.93,1.34,1.71,1.27,1.76s-.58-.59-1.6-1.36a8.37,8.37,0,0,0-1.92-1.09,7.37,7.37,0,0,0-1.23-.38c-.46-.13-.85-.13-1,.07s-.05.11,0,.24a2.23,2.23,0,0,0,.48.38,11,11,0,0,0,1.14.65,12.11,12.11,0,0,0,2.08.8A13.74,13.74,0,0,1,333.21,426.52Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 329.941px 424.876px;" id="el6okk303zl1u"
                        class="animable"></path>
                    <path
                        d="M332.93,426.82a3.59,3.59,0,0,1-.56-2.09,7.2,7.2,0,0,1,.3-2.36,8,8,0,0,1,.55-1.3A1.8,1.8,0,0,1,334.6,420a1,1,0,0,1,.9.6,3.12,3.12,0,0,1,.22.8,4.7,4.7,0,0,1,0,1.45,5,5,0,0,1-.93,2.22c-.84,1.11-1.72,1.36-1.74,1.29s.67-.51,1.31-1.58a4.82,4.82,0,0,0,.69-2,4.4,4.4,0,0,0,0-1.25c-.06-.45-.23-.82-.4-.78s-.58.34-.76.71a7.54,7.54,0,0,0-.54,1.16,7.74,7.74,0,0,0-.42,2.15C332.83,426,333.05,426.78,332.93,426.82Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 334.07px 423.41px;" id="elwuh526l8ig"
                        class="animable"></path>
                    <path
                        d="M312.19,307.84c-25.43,2.63-59.14,6.09-59.14,6.09l4.6,41.39s49.52-13.09,49.17-12,2.3,88.06,2.3,88.06h29.82l.56-98.53A24.77,24.77,0,0,0,312.19,307.84Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 296.276px 369.545px;" id="elufn75p8f1ts"
                        class="animable"></path>
                    <path
                        d="M192.21,324.54v12.83c0,8.74,9.95,18,18.68,18h6.76c5.32,0,13.66-3.88,18-7l2.58-1.89,31.06,96.21s35.53-6.37,35.53-7.49-24.06-78.8-35.17-114.85c-4.54-14.72-20.31-23.28-34.88-18.29-.49.17-1,.36-1.49.56C217.32,309,192.21,324.54,192.21,324.54Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 248.515px 371.661px;" id="el79xdgui8e"
                        class="animable"></path>
                    <path
                        d="M304.78,435.19a1.79,1.79,0,0,1-.15-.34c-.11-.27-.24-.61-.4-1-.34-.91-.83-2.25-1.41-4-1.19-3.47-2.82-8.54-4.8-14.81-4-12.53-9.28-29.9-15.06-49.1-2.88-9.61-5.61-18.76-8.11-27.1-1.24-4.16-2.41-8.12-3.51-11.83q-.84-2.78-1.6-5.35a47.09,47.09,0,0,0-1.62-4.87,20,20,0,0,0-5-7.11,42.9,42.9,0,0,0-5.26-4.09c-1.52-1-2.73-1.77-3.56-2.27l-.93-.59a1.25,1.25,0,0,1-.31-.22,1.28,1.28,0,0,1,.34.16l1,.52c.85.46,2.09,1.17,3.64,2.16a39.78,39.78,0,0,1,5.38,4,20.14,20.14,0,0,1,5.22,7.2,47.09,47.09,0,0,1,1.68,4.91c.53,1.71,1.07,3.5,1.64,5.35l3.58,11.8c2.51,8.33,5.27,17.48,8.17,27.08,5.78,19.17,11,36.53,14.84,49.17l4.58,14.87,1.28,4c.13.43.23.77.32,1.05S304.8,435.19,304.78,435.19Z"
                        style="fill: rgb(69, 90, 100); transform-origin: 278.929px 368.85px;" id="ely64mqet0vge"
                        class="animable"></path>
                    <path
                        d="M312.28,330.88c.18.12-1.51,2.66-2.92,6.11s-2.05,6.43-2.27,6.39.1-3.14,1.58-6.68S312.13,330.76,312.28,330.88Z"
                        style="fill: rgb(69, 90, 100); transform-origin: 309.66px 337.128px;" id="el6winnjirz7"
                        class="animable"></path>
                    <path
                        d="M318,334.88c.08.2-2.48,1.33-5.15,3.44s-4.39,4.32-4.57,4.19,1.32-2.6,4.11-4.77S317.93,334.7,318,334.88Z"
                        style="fill: rgb(69, 90, 100); transform-origin: 313.134px 338.686px;" id="elaj10jkc5u8u"
                        class="animable"></path>
                    <path
                        d="M269.58,442.68c-.19.06-8.58-25.68-18.74-57.5s-18.22-57.67-18-57.73,8.58,25.68,18.74,57.51S269.78,442.62,269.58,442.68Z"
                        style="fill: rgb(69, 90, 100); transform-origin: 251.21px 385.065px;" id="elrymd5keiek"
                        class="animable"></path>
                    <polygon
                        points="231.47 292.59 333.12 293.57 352.08 239.99 278.14 240.49 260.98 288.67 231.47 289.12 231.47 292.59"
                        style="fill: rgb(69, 90, 100); transform-origin: 291.775px 266.78px;" id="el6q2orwyfuon"
                        class="animable"></polygon>
                    <path d="M308.54,271.4a4.12,4.12,0,1,1,4.65-3.5A4.12,4.12,0,0,1,308.54,271.4Z"
                        style="fill: rgb(255, 255, 255); transform-origin: 309.111px 267.32px;" id="elw8wj4vktg3o"
                        class="animable"></path>
                    <path
                        d="M223.17,147.57c1-3.57,3.65-5.32,7.14-6.51a11.48,11.48,0,0,1,10.5,1.7c2,1.5,3.5,3.67,5.84,4.48,3.84,1.33,8.34-1.54,12,.18a5.24,5.24,0,0,1-2.48,10c2.5.92,3.28,4.49,1.82,6.72s-4.47,3.07-7.1,2.58a14.72,14.72,0,0,1-6.89-3.86c-2-1.78-3.76-3.8-5.88-5.42a11.41,11.41,0,0,0-7.36-2.7c-3.61.19-6.7,2.91-8.31,6.15s-2,6.92-2.18,10.53-.26,7.27-1.33,10.72c-.13.41-.32.86-.72,1-.59.18-1.09-.44-1.38-1a53,53,0,0,1-6.05-19.71c-.41-4-.31-7.78,1.89-11.15s7.75-5.84,10.47-3.71"
                        style="fill: rgb(38, 50, 56); transform-origin: 236.16px 161.822px;" id="elpyfed9ufdl"
                        class="animable"></path>
                    <path
                        d="M216.2,164.3l-1.85,40.46c-.31,6.88.64,17.06,11.54,17.06h0c9.46-.72,12.25-9.56,12.54-16,.13-3,.25-5.58.29-5.89,0,0,10.34-.5,11.55-10.66.58-4.91,1-15.13,1.2-24.37a19.07,19.07,0,0,0-17-19.43l-1-.1C222.8,144.88,216.41,153.64,216.2,164.3Z"
                        style="fill: rgb(255, 190, 157); transform-origin: 232.889px 183.585px;" id="elodsm32xu09l"
                        class="animable"></path>
                    <path d="M238.75,199.8a23.76,23.76,0,0,1-12.86-5.18s2.35,7.65,12.6,7.82Z"
                        style="fill: rgb(235, 153, 110); transform-origin: 232.32px 198.53px;" id="elf9yjdwbxbsi"
                        class="animable"></path>
                    <path
                        d="M247.78,171.42a1.46,1.46,0,0,1-1.56,1.32,1.39,1.39,0,0,1-1.35-1.47,1.46,1.46,0,0,1,1.55-1.32A1.39,1.39,0,0,1,247.78,171.42Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 246.325px 171.345px;" id="elljxjgxt9bqc"
                        class="animable"></path>
                    <path
                        d="M248.75,169.68c-.2.17-1.21-.76-2.78-.92s-2.79.5-2.94.29.15-.42.69-.73a4.05,4.05,0,0,1,2.38-.47,3.82,3.82,0,0,1,2.18,1C248.72,169.25,248.85,169.61,248.75,169.68Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 245.887px 168.763px;" id="elim45m5ucgxa"
                        class="animable"></path>
                    <path
                        d="M232.39,170.32a1.46,1.46,0,0,1-1.56,1.32,1.41,1.41,0,0,1-1.36-1.47,1.48,1.48,0,0,1,1.56-1.32A1.4,1.4,0,0,1,232.39,170.32Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 230.93px 170.246px;" id="eldqd1x5zvydg"
                        class="animable"></path>
                    <path
                        d="M233.35,168.34c-.2.17-1.21-.76-2.78-.93s-2.79.5-2.94.29.15-.41.69-.72a4,4,0,0,1,2.38-.47,3.89,3.89,0,0,1,2.18,1C233.32,167.9,233.45,168.26,233.35,168.34Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 230.487px 167.423px;" id="elf8hgfytj5wc"
                        class="animable"></path>
                    <path
                        d="M237.79,180.54a10.23,10.23,0,0,1,2.59-.19c.41,0,.79,0,.89-.3a2.15,2.15,0,0,0-.14-1.22c-.28-1-.56-2.06-.86-3.16-1.18-4.5-2-8.19-1.81-8.24s1.29,3.57,2.47,8.07c.28,1.11.55,2.17.8,3.18a2.27,2.27,0,0,1,0,1.59,1,1,0,0,1-.71.52,2.74,2.74,0,0,1-.69,0A10.67,10.67,0,0,1,237.79,180.54Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 239.832px 174.121px;" id="elzt3li59gl4p"
                        class="animable"></path>
                    <path
                        d="M233.08,181.13c.25,0,.08,1.71,1.4,3.07s3.15,1.36,3.14,1.6-.44.29-1.21.23a4.28,4.28,0,0,1-2.63-1.25,3.69,3.69,0,0,1-1.06-2.56C232.73,181.51,233,181.11,233.08,181.13Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 235.17px 183.591px;" id="ely0vbpdgtlgm"
                        class="animable"></path>
                    <path
                        d="M234.41,162.25c-.2.41-1.74,0-3.6.07s-3.39.37-3.6,0c-.08-.19.22-.56.86-.91a6.19,6.19,0,0,1,5.48,0C234.19,161.69,234.5,162.06,234.41,162.25Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 230.811px 161.636px;" id="elt7deyzrznvr"
                        class="animable"></path>
                    <path
                        d="M248.66,165.1c-.31.32-1.35-.16-2.64-.32s-2.42,0-2.63-.41c-.1-.19.11-.53.63-.82a3.73,3.73,0,0,1,2.21-.35,3.67,3.67,0,0,1,2,.94C248.69,164.55,248.8,164.94,248.66,165.1Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 246.041px 164.184px;" id="el0f2d2hrd4v27"
                        class="animable"></path>
                    <path
                        d="M216.23,171.92c-.17-.09-6.77-2.81-7.29,4.17s6.6,6.06,6.62,5.86S216.23,171.92,216.23,171.92Z"
                        style="fill: rgb(255, 190, 157); transform-origin: 212.571px 176.712px;" id="elsbz2q8ebzi"
                        class="animable"></path>
                    <path
                        d="M213.63,179.15s-.13.08-.34.16a1.27,1.27,0,0,1-.91-.05,3.05,3.05,0,0,1-1.2-2.81,4.05,4.05,0,0,1,.47-1.71,1.42,1.42,0,0,1,1-.87.63.63,0,0,1,.69.39c.08.2,0,.34.06.35s.16-.1.13-.4a.74.74,0,0,0-.25-.45.9.9,0,0,0-.66-.23,1.73,1.73,0,0,0-1.35,1,4.19,4.19,0,0,0-.56,1.91c-.06,1.41.56,2.78,1.55,3.15a1.3,1.3,0,0,0,1.12-.11C213.6,179.32,213.65,179.16,213.63,179.15Z"
                        style="fill: rgb(235, 153, 110); transform-origin: 212.17px 176.598px;" id="elqe4nbgk1zc"
                        class="animable"></path>
                    <path
                        d="M253.85,163a14.81,14.81,0,0,1-12.74-4.33c-2.25-2.36-3.84-5.58-6.84-6.87a8.34,8.34,0,0,0-6.41.19,16,16,0,0,0-5.26,3.9c1.41,5.38-.52,11-2.43,16.23a2.79,2.79,0,0,1-1,1.52c-.89.55-2.07-.08-2.71-.91a8.63,8.63,0,0,1-1.4-4.73,28.69,28.69,0,0,1,1.26-11.28,19.68,19.68,0,0,1,6.4-9.26A18.54,18.54,0,0,1,236.21,144a22.75,22.75,0,0,1,12.64,6.09,13.33,13.33,0,0,1,3.75,5.38"
                        style="fill: rgb(38, 50, 56); transform-origin: 234.4px 158.84px;" id="ell8i49xcpsfn"
                        class="animable"></path>
                </g>
                <g id="freepik--Plant--inject-993" class="animable animator-active"
                    style="transform-origin: 48.0399px 387.571px;">
                    <path
                        d="M58.32,378.08A18.91,18.91,0,0,1,70,376.65c2.12.35,4.34,1,5.79,2.59s1.72,4.41.06,5.78a5.56,5.56,0,0,1-3.65.92c-3.1,0-6.54-.58-9,1.29-1.42,1.06-2.36,2.83-4,3.35a4,4,0,0,1-4.39-1.95,6.86,6.86,0,0,1-.49-5A7.68,7.68,0,0,1,58.32,378.08Z"
                        style="fill: rgb(18, 17, 17); transform-origin: 65.5238px 383.487px;" id="el6bh2wmak1ab"
                        class="animable"></path>
                    <path
                        d="M50.15,362.31c2.18,3.11,6.42,2.08,8.38.18s2.8-4.65,3.55-7.28c1.73-6,3.47-12.3,2.19-18.41a10.23,10.23,0,0,0-2.36-5,5.34,5.34,0,0,0-5.06-1.69c-2.13.57-3.46,2.66-4.42,4.65a43.87,43.87,0,0,0-4.34,18.83c0,3,.35,6.22,2.06,8.72"
                        style="fill: rgb(18, 17, 17); transform-origin: 56.4008px 347.147px;" id="eleyz00wqlv0d"
                        class="animable"></path>
                    <path
                        d="M44.16,366.78a11.34,11.34,0,0,0,1.77-10.43,20.13,20.13,0,0,0-6.18-9,33.15,33.15,0,0,0-11-6.53,11.86,11.86,0,0,0-5-.84,5.22,5.22,0,0,0-4.17,2.52c-1.16,2.22-.05,4.91,1.16,7.11A84.27,84.27,0,0,0,28,360.72c2.18,2.8,4.67,5.57,8,6.84s6.76,1.12,8.52-1.18"
                        style="fill: rgb(18, 17, 17); transform-origin: 32.793px 354.161px;" id="eliv7rq1nr4w"
                        class="animable"></path>
                    <path
                        d="M50,409.27a6.52,6.52,0,0,0,.2-1.41c.1-1,.23-2.32.38-3.86a55.86,55.86,0,0,1,.86-5.66,44.36,44.36,0,0,1,2.06-6.69,24.73,24.73,0,0,1,3.42-6A12.72,12.72,0,0,1,61.23,382a11.62,11.62,0,0,1,3.63-1.13,7,7,0,0,0,1.41-.21,7.14,7.14,0,0,0-1.43,0,10.81,10.81,0,0,0-3.79,1,12.58,12.58,0,0,0-4.55,3.61A24.24,24.24,0,0,0,53,391.43a40.82,40.82,0,0,0-2,6.8,47.89,47.89,0,0,0-.76,5.73c-.12,1.64-.16,3-.19,3.89A6.56,6.56,0,0,0,50,409.27Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 58.1262px 394.947px;" id="elp5ot58nd85"
                        class="animable"></path>
                    <path
                        d="M50.27,406.3a3,3,0,0,0,0-.65c0-.5,0-1.12,0-1.88,0-1.63,0-4,.09-6.9.14-5.82.64-12.09,1.61-20.92.92-8.31,2.15-18,3.45-24.26.27-1.43.55-2.72.82-3.84s.47-2.1.67-2.89.33-1.35.44-1.83a2.62,2.62,0,0,0,.12-.64,2.37,2.37,0,0,0-.23.61c-.15.47-.33,1.07-.55,1.8s-.49,1.75-.77,2.87-.6,2.41-.91,3.83a215.52,215.52,0,0,0-3.62,22.51C50.45,383,50,391,50,396.87c0,2.91,0,5.28.1,6.91,0,.76.09,1.38.12,1.87A2.46,2.46,0,0,0,50.27,406.3Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 53.735px 374.395px;" id="elsnbriox1c2"
                        class="animable"></path>
                    <path
                        d="M50.31,390.76a12.76,12.76,0,0,0,0-2,52.54,52.54,0,0,0-.6-5.32A70.48,70.48,0,0,0,48,375.74a63.67,63.67,0,0,0-3.24-9.16,48.93,48.93,0,0,0-9.51-14.8A25.58,25.58,0,0,0,33,349.7c-.35-.29-.65-.57-1-.8l-.87-.6a12.35,12.35,0,0,0-1.65-1.06,58.19,58.19,0,0,1,5.41,4.83,51.27,51.27,0,0,1,9.27,14.75,72.46,72.46,0,0,1,3.26,9.07c.85,2.85,1.41,5.46,1.84,7.66s.64,4,.78,5.27A11.71,11.71,0,0,0,50.31,390.76Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 39.9146px 369px;" id="el1xu0rp1701"
                        class="animable"></path>
                    <polygon points="35.28 418.18 36.84 439.52 64.26 439.52 65.81 418.18 35.28 418.18"
                        style="fill: rgb(38, 50, 56); transform-origin: 50.545px 428.85px;" id="elqi58zwmlmje"
                        class="animable"></polygon>
                    <rect x="32.63" y="409.77" width="36.45" height="8.41"
                        style="fill: rgb(38, 50, 56); transform-origin: 50.855px 413.975px;" id="el85vfvedq93"
                        class="animable"></rect>
                    <polygon points="32.63 438.71 32.63 441.04 34.34 441.04 68.48 441.04 68.48 438.71 32.63 438.71"
                        style="fill: rgb(69, 90, 100); transform-origin: 50.555px 439.875px;" id="elffz3o2jgoc"
                        class="animable"></polygon>
                    <polygon points="36.02 445.14 34.34 441.04 67.18 441.04 65.22 445.14 36.02 445.14"
                        style="fill: rgb(69, 90, 100); transform-origin: 50.76px 443.09px;" id="elx6qr4xiz6bn"
                        class="animable"></polygon>
                    <path
                        d="M65.31,425.16a2.07,2.07,0,0,1-.13.19l-.41.55-1.6,2-.07.09-.07-.09-3.92-5.43h.22L55.47,428l-.12.17-.14-.16c-1.42-1.7-3-3.54-4.58-5.45h.26c-.07.1-.16.2-.25.31L46.55,428l-.14.17-.13-.18-3.86-5.47h.22L37.88,428l-.08.09-.07-.11c-.62-1.05-1.12-1.89-1.49-2.5l-.38-.67-.12-.23s.07.06.16.21l.43.64,1.56,2.46-.15,0,4.69-5.48.11-.14.11.15,3.9,5.44h-.26l4.09-5.14.25-.32.13-.16.13.16,4.57,5.46H55.2l3.91-5.44.11-.16.11.16,3.84,5.48H63l1.67-2,.44-.52C65.24,425.21,65.3,425.15,65.31,425.16Z"
                        style="fill: rgb(224, 224, 224); transform-origin: 50.525px 425.205px;" id="ely0xb01yhxxd"
                        class="animable"></path>
                    <path d="M66.2,418c0,.1-6.87.17-15.35.17s-15.34-.07-15.34-.17,6.87-.17,15.34-.17S66.2,418,66.2,418Z"
                        style="fill: rgb(69, 90, 100); transform-origin: 50.855px 418px;" id="el9yjsdhphjtw"
                        class="animable"></path>
                    <path
                        d="M67.58,441.27c0,.09-7.47.17-16.67.17s-16.68-.08-16.68-.17,7.47-.17,16.68-.17S67.58,441.18,67.58,441.27Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 50.905px 441.27px;" id="elub62gu0ui2"
                        class="animable"></path>
                </g>
                <g id="freepik--Devices--inject-993" class="animable" style="transform-origin: 274.741px 320.24px;">
                    <polygon points="391.71 195.56 372.66 275.23 377.99 275.23 396.75 195.56 391.71 195.56"
                        style="fill: rgb(38, 50, 56); transform-origin: 384.705px 235.395px;" id="elz2q9ukvti3"
                        class="animable"></polygon>
                    <path d="M384.39,248c-.34,1.46,8.63,44.89,8.63,44.89H388.7l-6.77-34.42Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 387.475px 270.445px;" id="el1n5rwlnd17q"
                        class="animable"></path>
                    <rect x="358.6" y="350.33" width="89.23" height="94.59"
                        style="fill: rgb(18, 17, 17); transform-origin: 403.215px 397.625px;" id="eld1adb33f9sm"
                        class="animable"></rect>
                    <rect x="447.82" y="364.15" width="4.38" height="4.38"
                        style="fill: rgb(38, 50, 56); transform-origin: 450.01px 366.34px;" id="elmvjhdvln3i"
                        class="animable"></rect>
                    <rect x="447.82" y="378.06" width="4.38" height="4.38"
                        style="fill: rgb(38, 50, 56); transform-origin: 450.01px 380.25px;" id="el6plriv68s06"
                        class="animable"></rect>
                    <rect x="447.82" y="391.97" width="4.38" height="4.38"
                        style="fill: rgb(38, 50, 56); transform-origin: 450.01px 394.16px;" id="ellkcg0t1vy1"
                        class="animable"></rect>
                    <rect x="447.82" y="405.88" width="4.38" height="4.38"
                        style="fill: rgb(38, 50, 56); transform-origin: 450.01px 408.07px;" id="ely3mmb9dky5"
                        class="animable"></rect>
                    <path
                        d="M452.37,393.25a7,7,0,0,1,1.34-.29,21.33,21.33,0,0,1,3.76-.36,10.09,10.09,0,0,1,5.42,1.43,6.26,6.26,0,0,1,3,6,7.55,7.55,0,0,1-1.14,3.43,9,9,0,0,1-2.3,2.44,11.75,11.75,0,0,1-5.22,2.06,16.93,16.93,0,0,1-3.77.13,6,6,0,0,1-1.37-.19,8.53,8.53,0,0,1,1.37,0,19.94,19.94,0,0,0,3.71-.29,11.71,11.71,0,0,0,5-2.08,7.69,7.69,0,0,0,3.21-5.53,5.8,5.8,0,0,0-2.75-5.56,9.93,9.93,0,0,0-5.17-1.46,26,26,0,0,0-3.72.19A6.7,6.7,0,0,1,452.37,393.25Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 459.006px 400.369px;" id="el7094731dau3"
                        class="animable"></path>
                    <path
                        d="M451.28,379.42a1.84,1.84,0,0,1,.41-.25,9.06,9.06,0,0,1,1.3-.52,10.23,10.23,0,0,1,5.13-.29,4.68,4.68,0,0,1,1.63.65,2.83,2.83,0,0,1,1.15,1.56,4.75,4.75,0,0,1-2.85,5.35,2.91,2.91,0,0,1-2.41-.13,2.47,2.47,0,0,1-1.39-2.1,2.52,2.52,0,0,1,1.42-2.17,3.84,3.84,0,0,1,2.55-.27,5.42,5.42,0,0,1,2.23,1.06,6,6,0,0,1,2.22,4,5.58,5.58,0,0,1-1.14,4,8.08,8.08,0,0,1-2.74,2.31,13,13,0,0,1-5,1.3c-.6.05-1.07.07-1.39.07a1.56,1.56,0,0,1-.49,0s.67-.09,1.86-.24a13.87,13.87,0,0,0,4.82-1.42,7.85,7.85,0,0,0,2.57-2.25,5.21,5.21,0,0,0,1-3.65,5.53,5.53,0,0,0-2.06-3.63,4.79,4.79,0,0,0-2-.95,3.41,3.41,0,0,0-2.21.22,2,2,0,0,0-1.14,1.71,2,2,0,0,0,1.11,1.65,2.37,2.37,0,0,0,2,.11,3.9,3.9,0,0,0,1.65-1.2,4.06,4.06,0,0,0,1-3.56,3,3,0,0,0-2.45-2,10.56,10.56,0,0,0-5,.12C451.89,379.15,451.3,379.47,451.28,379.42Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 456.99px 386.085px;" id="elnvneghkazmi"
                        class="animable"></path>
                    <path
                        d="M451.32,365.85a2.37,2.37,0,0,1,1-.18A7,7,0,0,1,455,366a7.56,7.56,0,0,1,3.33,2.25,7.35,7.35,0,0,1,1.73,4.6,7.45,7.45,0,0,1-1.44,4.7A7.54,7.54,0,0,1,455.4,380a7,7,0,0,1-2.65.54,2.31,2.31,0,0,1-1-.12,9.88,9.88,0,0,0,3.48-.75,7.49,7.49,0,0,0,2.95-2.4,7.29,7.29,0,0,0-.26-8.7,7.63,7.63,0,0,0-3.09-2.21A9.85,9.85,0,0,0,451.32,365.85Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 455.693px 373.102px;" id="eleu8fhs8wwt"
                        class="animable"></path>
                    <path
                        d="M385.09,300.07a8.61,8.61,0,0,1,.75,1.77,33.75,33.75,0,0,1,1.19,5.37c.37,2.36.68,5.27,1,8.64s.59,7.23,1.13,11.46c.14,1.05.31,2.13.53,3.22a14.18,14.18,0,0,0,1,3.22,11.75,11.75,0,0,0,2.19,2.7,17.1,17.1,0,0,0,10.09,4.68,14.2,14.2,0,0,0,7.88-1.36,9.55,9.55,0,0,0,5.09-6.4,7.35,7.35,0,0,0-.3-4.25,7.51,7.51,0,0,0-2.77-3.35,8.32,8.32,0,0,0-4.22-1.4,6.67,6.67,0,0,0-4.27,1.25,4.68,4.68,0,0,0-1.45,1.71,3.49,3.49,0,0,0-.28,2.18,5.27,5.27,0,0,0,2.77,3.52,12.75,12.75,0,0,0,4.56,1.26,42.11,42.11,0,0,0,4.74.33,75.4,75.4,0,0,0,9.32-.52c6.08-.68,12-1.66,17.63-1.72s11.14.72,15.71,3a18.5,18.5,0,0,1,5.84,4.37,13.39,13.39,0,0,1,3,6A16.16,16.16,0,0,1,464.47,357a18.93,18.93,0,0,1-5.93,6.33,22.34,22.34,0,0,1-4.9,2.5,15.14,15.14,0,0,1-1.84.55l.46-.17c.31-.09.76-.26,1.34-.48a23.09,23.09,0,0,0,4.83-2.57,18.94,18.94,0,0,0,5.79-6.3,16,16,0,0,0,1.63-11,13.23,13.23,0,0,0-3-5.82,18.1,18.1,0,0,0-5.73-4.24c-4.5-2.18-9.91-3-15.51-2.87s-11.48,1.05-17.59,1.74a72.3,72.3,0,0,1-9.38.54,43.17,43.17,0,0,1-4.8-.33,13.19,13.19,0,0,1-4.74-1.32,5.81,5.81,0,0,1-3-3.88,4.05,4.05,0,0,1,.32-2.5,5.21,5.21,0,0,1,1.61-1.9,7.2,7.2,0,0,1,4.6-1.36,8.91,8.91,0,0,1,4.49,1.5,8,8,0,0,1,2.95,3.58,7.88,7.88,0,0,1,.32,4.55,10,10,0,0,1-5.36,6.71,14.58,14.58,0,0,1-8.15,1.39,17.27,17.27,0,0,1-7.38-2.54,17.1,17.1,0,0,1-2.95-2.29,12,12,0,0,1-2.26-2.82,14.48,14.48,0,0,1-1-3.33q-.32-1.65-.51-3.24c-.52-4.25-.77-8.1-1.06-11.48s-.57-6.28-.9-8.64a36.24,36.24,0,0,0-1.09-5.37,12.93,12.93,0,0,0-.47-1.35A4.57,4.57,0,0,1,385.09,300.07Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 425.825px 333.225px;" id="elqqnn8p3f989"
                        class="animable"></path>
                    <path
                        d="M442.75,441s0-.14,0-.42,0-.68,0-1.2c0-1.08,0-2.65,0-4.69,0-4.11,0-10.11-.06-17.72,0-15.23-.07-36.93-.12-62.89l.23.23-80.65,0h0l.26-.26c0,32,0,61.82,0,86.92l-.22-.22,58.44.11,16.39.06,4.33,0,1.5,0-1.45,0L437,441l-16.33.06-58.59.11h-.23V441c0-25.1,0-55,0-86.92v-.26h.27l80.65,0H443V354c-.05,26-.09,47.77-.12,63,0,7.6,0,13.58-.06,17.67,0,2,0,3.58,0,4.65,0,.51,0,.9,0,1.18S442.75,441,442.75,441Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 402.425px 397.495px;" id="el0bhskgwpjybv"
                        class="animable"></path>
                    <path d="M420,364.73a.41.41,0,0,1-.41.42.42.42,0,1,1,0-.83A.41.41,0,0,1,420,364.73Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 419.553px 364.735px;" id="elbxti272oqf8"
                        class="animable"></path>
                    <path d="M422.31,364.73a.41.41,0,0,1-.41.42.42.42,0,1,1,0-.83A.41.41,0,0,1,422.31,364.73Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 421.863px 364.735px;" id="elyjejuhelpvf"
                        class="animable"></path>
                    <path d="M424.59,364.73a.41.41,0,0,1-.41.42.42.42,0,1,1,0-.83A.41.41,0,0,1,424.59,364.73Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 424.143px 364.735px;" id="elaerszz7vhpw"
                        class="animable"></path>
                    <path d="M426.87,364.73a.42.42,0,1,1-.42-.41A.42.42,0,0,1,426.87,364.73Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 426.45px 364.74px;" id="el235le89gkvc"
                        class="animable"></path>
                    <path d="M429.15,364.73a.42.42,0,0,1-.42.42.42.42,0,0,1,0-.83A.42.42,0,0,1,429.15,364.73Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 428.762px 364.735px;" id="elw0zlabpc26q"
                        class="animable"></path>
                    <path d="M431.43,364.73a.42.42,0,0,1-.42.42.42.42,0,0,1,0-.83A.42.42,0,0,1,431.43,364.73Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 431.042px 364.735px;" id="el0bq14famrugo"
                        class="animable"></path>
                    <path d="M433.71,364.73a.42.42,0,0,1-.42.42.42.42,0,0,1,0-.83A.42.42,0,0,1,433.71,364.73Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 433.322px 364.735px;" id="elcd3w6423er"
                        class="animable"></path>
                    <circle cx="432.24" cy="366.27" r="0.41"
                        style="fill: rgb(38, 50, 56); transform-origin: 432.24px 366.27px;" id="ellfxrxai4bf"
                        class="animable"></circle>
                    <circle cx="429.91" cy="366.27" r="0.41"
                        style="fill: rgb(38, 50, 56); transform-origin: 429.91px 366.27px;" id="elstxwl9z187k"
                        class="animable"></circle>
                    <path
                        d="M428,366.27a.41.41,0,0,1-.41.41.41.41,0,0,1-.42-.41.42.42,0,0,1,.42-.42A.41.41,0,0,1,428,366.27Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 427.585px 366.265px;" id="eldpjkgtlbkbh"
                        class="animable"></path>
                    <circle cx="425.25" cy="366.27" r="0.41"
                        style="fill: rgb(38, 50, 56); transform-origin: 425.25px 366.27px;" id="elsdlhkrcit7i"
                        class="animable"></circle>
                    <circle cx="422.91" cy="366.27" r="0.41"
                        style="fill: rgb(38, 50, 56); transform-origin: 422.91px 366.27px;" id="el6c4e5necj2t"
                        class="animable"></circle>
                    <path
                        d="M421,366.27a.41.41,0,0,1-.42.41.41.41,0,0,1-.41-.41.41.41,0,0,1,.41-.42A.42.42,0,0,1,421,366.27Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 420.585px 366.265px;" id="elpqeytyw6ay"
                        class="animable"></path>
                    <path d="M420,368a.41.41,0,0,1-.41.41.41.41,0,0,1-.42-.41.42.42,0,0,1,.42-.42A.41.41,0,0,1,420,368Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 419.585px 367.995px;" id="elxdytuc2ryq"
                        class="animable"></path>
                    <path
                        d="M422.31,368a.41.41,0,0,1-.41.41.41.41,0,0,1-.42-.41.42.42,0,0,1,.42-.42A.41.41,0,0,1,422.31,368Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 421.895px 367.995px;" id="eln3tmaraxjf"
                        class="animable"></path>
                    <path
                        d="M424.59,368a.41.41,0,0,1-.41.41.41.41,0,0,1-.42-.41.42.42,0,0,1,.42-.42A.41.41,0,0,1,424.59,368Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 424.175px 367.995px;" id="elsxwz3o7gwvl"
                        class="animable"></path>
                    <path d="M426.87,368a.42.42,0,0,1-.83,0,.42.42,0,1,1,.83,0Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 426.455px 367.935px;" id="elnsjsldiskjg"
                        class="animable"></path>
                    <path
                        d="M429.15,368a.41.41,0,0,1-.42.41.41.41,0,0,1-.41-.41.41.41,0,0,1,.41-.42A.42.42,0,0,1,429.15,368Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 428.735px 367.995px;" id="elza2wmx1qew"
                        class="animable"></path>
                    <path
                        d="M431.43,368a.41.41,0,0,1-.42.41.41.41,0,0,1-.41-.41.41.41,0,0,1,.41-.42A.42.42,0,0,1,431.43,368Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 431.015px 367.995px;" id="elp5rlcz9kd4m"
                        class="animable"></path>
                    <path
                        d="M433.71,368a.41.41,0,0,1-.42.41.41.41,0,0,1-.41-.41.41.41,0,0,1,.41-.42A.42.42,0,0,1,433.71,368Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 433.295px 367.995px;" id="el83x4sozydtx"
                        class="animable"></path>
                    <path
                        d="M432.66,369.53a.42.42,0,0,1-.42.42.41.41,0,0,1-.41-.42.41.41,0,0,1,.41-.41A.41.41,0,0,1,432.66,369.53Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 432.245px 369.535px;" id="elkv4nrrxog8p"
                        class="animable"></path>
                    <path
                        d="M430.32,369.53a.41.41,0,0,1-.41.42.42.42,0,0,1-.42-.42.41.41,0,0,1,.42-.41A.41.41,0,0,1,430.32,369.53Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 429.905px 369.535px;" id="el5uumwrq3ooo"
                        class="animable"></path>
                    <path
                        d="M428,369.53a.41.41,0,0,1-.41.42.42.42,0,0,1-.42-.42.41.41,0,0,1,.42-.41A.41.41,0,0,1,428,369.53Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 427.585px 369.535px;" id="el8v2l3jx6pyg"
                        class="animable"></path>
                    <path
                        d="M425.66,369.53a.41.41,0,0,1-.41.42.42.42,0,0,1-.42-.42.41.41,0,0,1,.42-.41A.41.41,0,0,1,425.66,369.53Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 425.245px 369.535px;" id="elpadiun5upn8"
                        class="animable"></path>
                    <path d="M423.33,369.53a.42.42,0,1,1-.83,0,.42.42,0,0,1,.83,0Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 422.915px 369.595px;" id="elcxmnzptmqgh"
                        class="animable"></path>
                    <path
                        d="M421,369.53a.42.42,0,0,1-.42.42.41.41,0,0,1-.41-.42.41.41,0,0,1,.41-.41A.41.41,0,0,1,421,369.53Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 420.585px 369.535px;" id="el795jb2mncb"
                        class="animable"></path>
                    <path
                        d="M420,371.26a.41.41,0,0,1-.41.42.42.42,0,0,1-.42-.42.41.41,0,0,1,.42-.41A.41.41,0,0,1,420,371.26Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 419.585px 371.265px;" id="eligg0f6fur09"
                        class="animable"></path>
                    <path
                        d="M422.31,371.26a.41.41,0,0,1-.41.42.42.42,0,0,1-.42-.42.41.41,0,0,1,.42-.41A.41.41,0,0,1,422.31,371.26Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 421.895px 371.265px;" id="elbxb0i98rzh"
                        class="animable"></path>
                    <path
                        d="M424.59,371.26a.41.41,0,0,1-.41.42.42.42,0,0,1-.42-.42.41.41,0,0,1,.42-.41A.41.41,0,0,1,424.59,371.26Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 424.175px 371.265px;" id="elw1mujhgb9pn"
                        class="animable"></path>
                    <path d="M426.87,371.26a.42.42,0,1,1-.83,0,.42.42,0,0,1,.83,0Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 426.455px 371.325px;" id="elfgbm5vypoad"
                        class="animable"></path>
                    <path
                        d="M429.15,371.26a.42.42,0,0,1-.42.42.41.41,0,0,1-.41-.42.41.41,0,0,1,.41-.41A.41.41,0,0,1,429.15,371.26Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 428.735px 371.265px;" id="elghf9mcz1sb9"
                        class="animable"></path>
                    <path
                        d="M431.43,371.26a.42.42,0,0,1-.42.42.41.41,0,0,1-.41-.42.41.41,0,0,1,.41-.41A.41.41,0,0,1,431.43,371.26Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 431.015px 371.265px;" id="el1utlw5ushte"
                        class="animable"></path>
                    <path
                        d="M433.71,371.26a.42.42,0,0,1-.42.42.41.41,0,0,1-.41-.42.41.41,0,0,1,.41-.41A.41.41,0,0,1,433.71,371.26Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 433.295px 371.265px;" id="elb48xhw1p8r"
                        class="animable"></path>
                    <circle cx="432.24" cy="372.8" r="0.41"
                        style="fill: rgb(38, 50, 56); transform-origin: 432.24px 372.8px;" id="elhlcsucrtved"
                        class="animable"></circle>
                    <circle cx="429.91" cy="372.8" r="0.41"
                        style="fill: rgb(38, 50, 56); transform-origin: 429.91px 372.8px;" id="el8bzbhxmws54"
                        class="animable"></circle>
                    <path d="M428,372.8a.41.41,0,0,1-.41.41.42.42,0,1,1,0-.83A.41.41,0,0,1,428,372.8Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 427.553px 372.795px;" id="elpibiivet98k"
                        class="animable"></path>
                    <circle cx="425.25" cy="372.8" r="0.41"
                        style="fill: rgb(38, 50, 56); transform-origin: 425.25px 372.8px;" id="elbgoum63uhoa"
                        class="animable"></circle>
                    <circle cx="422.91" cy="372.8" r="0.41"
                        style="fill: rgb(38, 50, 56); transform-origin: 422.91px 372.8px;" id="elpkrkkmhgkb"
                        class="animable"></circle>
                    <path d="M421,372.8a.42.42,0,0,1-.42.41.42.42,0,0,1,0-.83A.42.42,0,0,1,421,372.8Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 420.612px 372.795px;" id="elwke4blf2ls"
                        class="animable"></path>
                    <path
                        d="M388.5,271.29a5.23,5.23,0,0,1,1.62.29,9.09,9.09,0,0,1,3.94,2.57,17.15,17.15,0,0,1,3.49,6.6,65.44,65.44,0,0,1,2.19,9.67,122,122,0,0,1,.64,25.75,15.11,15.11,0,0,1-2.24,7.14,9.19,9.19,0,0,1-2.82,2.73,6.32,6.32,0,0,1-3.9.93,6.06,6.06,0,0,1-3.71-1.73,4.53,4.53,0,0,1-1.09-1.81,3.84,3.84,0,0,1,0-2.15,4.61,4.61,0,0,1,2.79-3.15,3.29,3.29,0,0,1,2.21,0,3.94,3.94,0,0,1,1.76,1.33,5.46,5.46,0,0,1,1,4.14,11.26,11.26,0,0,1-1.45,3.94,15.23,15.23,0,0,1-20.5,5.94,17.4,17.4,0,0,1-5.4-4.65A22.78,22.78,0,0,1,363.7,323a38.5,38.5,0,0,1-2.19-11.8c-.19-3.67,0-7-.35-9.88a16.89,16.89,0,0,0-.93-3.9,11.13,11.13,0,0,0-1.67-2.92,8.41,8.41,0,0,0-3.72-2.75,12,12,0,0,0-1.59-.38,5.31,5.31,0,0,1,1.63.29,8.18,8.18,0,0,1,3.83,2.71,11.08,11.08,0,0,1,1.75,3,16.88,16.88,0,0,1,1,4c.39,2.91.21,6.24.43,9.89a38.46,38.46,0,0,0,2.23,11.67,22.46,22.46,0,0,0,3.23,5.74,17,17,0,0,0,5.27,4.51,14.75,14.75,0,0,0,19.82-5.78,10.74,10.74,0,0,0,1.38-3.75,4.92,4.92,0,0,0-.87-3.76,3.56,3.56,0,0,0-1.53-1.16,2.76,2.76,0,0,0-1.86,0,4.1,4.1,0,0,0-2.46,2.79,3.59,3.59,0,0,0,1,3.47,5.53,5.53,0,0,0,3.39,1.58,5.8,5.8,0,0,0,3.59-.85,8.65,8.65,0,0,0,2.67-2.58,14.65,14.65,0,0,0,2.17-6.91,123.82,123.82,0,0,0-.52-25.65,67,67,0,0,0-2.11-9.63,17.1,17.1,0,0,0-3.36-6.55,9.12,9.12,0,0,0-3.82-2.61A12.17,12.17,0,0,0,388.5,271.29Z"
                        style="fill: rgb(224, 224, 224); transform-origin: 377.015px 303.297px;" id="el66g1um3jrhl"
                        class="animable"></path>
                    <rect x="347.43" y="285.76" width="33.22" height="6.33"
                        style="fill: rgb(224, 224, 224); transform-origin: 364.04px 288.925px;" id="elgx9b5smqa4l"
                        class="animable"></rect>
                    <rect x="97.52" y="351.2" width="43.33" height="93.27"
                        style="fill: rgb(38, 50, 56); transform-origin: 119.185px 397.835px;" id="elm5no5g3l3e"
                        class="animable"></rect>
                    <path
                        d="M137.13,434.65s0-.14,0-.41,0-.66,0-1.16c0-1,0-2.53,0-4.46,0-3.9,0-9.55-.07-16.66,0-14.22-.07-34.24-.12-57.53l.25.24-36.25,0h0l.26-.26c0,31.16,0,59.46-.07,80.22l-.19-.19,26.47.1,7.24.05,1.89,0c.43,0,.66,0,.66,0l-.62,0-1.86,0-7.19,0-26.59.1h-.18v-.19c0-20.76,0-49.06-.08-80.22v-.26h36.77v.25c0,23.36-.09,43.44-.12,57.7,0,7.08,0,12.72-.07,16.6,0,1.91,0,3.39,0,4.41,0,.49,0,.86,0,1.13S137.13,434.65,137.13,434.65Z"
                        style="fill: rgb(69, 90, 100); transform-origin: 119.065px 394.355px;" id="ela2x60oyrreh"
                        class="animable"></path>
                    <path
                        d="M134.89,361.22s0-.35,0-1,0-1.56-.06-2.7l.11.11c-5.61.09-17.63.15-31.52.15h0l.26-.26h0v1.86c0,.61,0,1.22,0,1.81l-.25-.26c8.81,0,16.65.06,22.32.11l6.71.07,1.83,0a3.3,3.3,0,0,1,.66,0,4.08,4.08,0,0,1-.59,0l-1.78,0-6.64.07c-5.66.06-13.59.11-22.51.11h-.26v-3.93h0l.27-.26h0c13.89,0,25.91.06,31.52.15H135v.11c0,1.17,0,2.09-.06,2.77A8.53,8.53,0,0,1,134.89,361.22Z"
                        style="fill: rgb(69, 90, 100); transform-origin: 119.085px 359.195px;" id="eley2s26j5c26"
                        class="animable"></path>
                    <path
                        d="M106.54,363.86c0,.14-.65.26-1.45.26s-1.46-.12-1.46-.26.65-.26,1.46-.26S106.54,363.71,106.54,363.86Z"
                        style="fill: rgb(69, 90, 100); transform-origin: 105.085px 363.86px;" id="elcueqly666po"
                        class="animable"></path>
                    <path
                        d="M134.05,368.67c0,.14-6.71.26-15,.26s-15-.12-15-.26,6.7-.26,15-.26S134.05,368.53,134.05,368.67Z"
                        style="fill: rgb(69, 90, 100); transform-origin: 119.05px 368.67px;" id="elf29jpqct4ri"
                        class="animable"></path>
                    <path
                        d="M134.18,374.48c0,.15-6.6.26-14.73.26s-14.73-.11-14.73-.26,6.59-.26,14.73-.26S134.18,374.34,134.18,374.48Z"
                        style="fill: rgb(69, 90, 100); transform-origin: 119.45px 374.48px;" id="elhybcsstxvwg"
                        class="animable"></path>
                    <circle cx="119.06" cy="388.07" r="2.38"
                        style="fill: rgb(18, 17, 17); transform-origin: 119.06px 388.07px;" id="elhmem0fbbktm"
                        class="animable"></circle>
                    <path
                        d="M112.34,388a10.14,10.14,0,0,1-3.19.26A10.05,10.05,0,0,1,106,388a9.72,9.72,0,0,1,3.18-.26A9.81,9.81,0,0,1,112.34,388Z"
                        style="fill: rgb(69, 90, 100); transform-origin: 109.17px 387.998px;" id="elbyd8ckkaifn"
                        class="animable"></path>
                    <path
                        d="M131.7,387.34a8.91,8.91,0,0,1-3,.26,8.88,8.88,0,0,1-3-.26,9.18,9.18,0,0,1,3-.26A9.22,9.22,0,0,1,131.7,387.34Z"
                        style="fill: rgb(69, 90, 100); transform-origin: 128.7px 387.342px;" id="el39q5xmbdmp"
                        class="animable"></path>
                    <path
                        d="M99,398a9.25,9.25,0,0,1-1.62-.3,14.19,14.19,0,0,1-4.29-2,18.38,18.38,0,0,1-5.17-5.39,31.16,31.16,0,0,1-3.77-9.16A37.4,37.4,0,0,1,83,369.22a24.5,24.5,0,0,1,4.55-12.94,20.42,20.42,0,0,1,5.43-5.16,18.9,18.9,0,0,1,3.49-1.73,19.39,19.39,0,0,1,3.86-.92c2.64-.37,5.34-.32,8-.48a19.92,19.92,0,0,0,7.91-1.82,8.88,8.88,0,0,0,4.92-6,8.43,8.43,0,0,0-8.42-10.3,6,6,0,0,0-3.34,1.24,3.62,3.62,0,0,0-1.4,3,4.85,4.85,0,0,0,4.46,4.31,7.35,7.35,0,0,0,5.72-2.57A13.76,13.76,0,0,0,121,330.4a47,47,0,0,0,1.15-5.61,92.48,92.48,0,0,0,.53-17.31c-.1-2-.18-3.61-.24-4.71q0-.78-.06-1.23a2.21,2.21,0,0,1,0-.42,2.29,2.29,0,0,1,.06.42c0,.3.06.7.11,1.22.08,1.08.21,2.66.33,4.71a88.2,88.2,0,0,1-.37,17.37,46.56,46.56,0,0,1-1.13,5.67,14.19,14.19,0,0,1-2.83,5.61,7.76,7.76,0,0,1-6.07,2.73,5.3,5.3,0,0,1-4.91-4.74,4.13,4.13,0,0,1,1.57-3.42,6.38,6.38,0,0,1,3.61-1.35A9,9,0,0,1,119.84,344a10.3,10.3,0,0,1-3.35,2.61,20.41,20.41,0,0,1-8.12,1.88c-2.73.16-5.42.11-8,.46a19.44,19.44,0,0,0-3.76.89,17.84,17.84,0,0,0-3.39,1.68,20.12,20.12,0,0,0-5.32,5,24.16,24.16,0,0,0-4.5,12.68,37.41,37.41,0,0,0,1.12,11.83,31.49,31.49,0,0,0,3.66,9.09,18.34,18.34,0,0,0,5,5.38,14.78,14.78,0,0,0,4.21,2.06c.51.15.91.24,1.18.3A1.82,1.82,0,0,1,99,398Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 103.033px 349.56px;" id="elzpcfkpvqhpf"
                        class="animable"></path>
                    <rect x="84.25" y="206.51" width="102.6" height="70.46"
                        style="fill: rgb(38, 50, 56); transform-origin: 135.55px 241.74px;" id="elgd70ytq80su"
                        class="animable"></rect>
                    <rect x="127.62" y="267.36" width="13.97" height="26.58"
                        style="fill: rgb(38, 50, 56); transform-origin: 134.605px 280.65px;" id="elfs0hvkk2dao"
                        class="animable"></rect>
                </g>
                <g id="freepik--Desk--inject-993" class="animable" style="transform-origin: 253.36px 367.165px;">
                    <polygon
                        points="94.46 292.92 94.46 302.48 147.4 302.48 147.4 444.94 152.27 444.94 152.27 302.48 373.36 303.57 373.36 444.94 378.14 444.94 378.14 303.31 412.26 303.58 412.26 292.09 94.46 292.92"
                        style="fill: rgb(38, 50, 56); transform-origin: 253.36px 368.515px;" id="el32g8v314yj"
                        class="animable"></polygon>
                    <polygon points="128.34 300.62 149.21 315.65 147.4 317.39 126.35 301.54 128.34 300.62"
                        style="fill: rgb(38, 50, 56); transform-origin: 137.78px 309.005px;" id="el22r4jwqrmg"
                        class="animable"></polygon>
                    <polygon points="397.81 302.02 373.59 319.27 375.41 321.01 399.8 302.94 397.81 302.02"
                        style="fill: rgb(38, 50, 56); transform-origin: 386.695px 311.515px;" id="elpbdrj372rsg"
                        class="animable"></polygon>
                    <rect x="171.44" y="289.39" width="54.72" height="4.03"
                        style="fill: rgb(38, 50, 56); transform-origin: 198.8px 291.405px;" id="eln60dbj514fo"
                        class="animable"></rect>
                </g>
                <defs>
                    <filter id="active" height="200%">
                        <feMorphology in="SourceAlpha" result="DILATED" operator="dilate" radius="2"></feMorphology>
                        <feFlood flood-color="#32DFEC" flood-opacity="1" result="PINK"></feFlood>
                        <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>
                        <feMerge>
                            <feMergeNode in="OUTLINE"></feMergeNode>
                            <feMergeNode in="SourceGraphic"></feMergeNode>
                        </feMerge>
                    </filter>
                    <filter id="hover" height="200%">
                        <feMorphology in="SourceAlpha" result="DILATED" operator="dilate" radius="2"></feMorphology>
                        <feFlood flood-color="#ff0000" flood-opacity="0.5" result="PINK"></feFlood>
                        <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>
                        <feMerge>
                            <feMergeNode in="OUTLINE"></feMergeNode>
                            <feMergeNode in="SourceGraphic"></feMergeNode>
                        </feMerge>
                        <feColorMatrix type="matrix"
                            values="0   0   0   0   0                0   1   0   0   0                0   0   0   0   0                0   0   0   1   0 ">
                        </feColorMatrix>
                    </filter>
                </defs>
            </svg>
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
