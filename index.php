<?php 
  include ".\ADMIN\includes\connect_database.php";
  include ".\ADMIN\includes\products.php";

  $database = new database;
  $db = $database->connect();

  $products = new products($db);
  $stmt_products = $products->read_all();
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
            <!-- <div class="row">
              <div class="col-lg-12">
                <div class="heading-section">
                  <h4><em>Most Popular</em> Right Now</h4>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-sm-6">
                    <div class="item">
                      <img src="assets/images/popular-01.jpg" alt="">
                      <h4>Fortnite<br><span>Sandbox</span></h4>
                      <ul>
                        <li><i class="fa fa-star"></i> 4.8</li>
                        <li><i class="fa fa-download"></i> 2.3M</li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <div class="item">
                      <img src="assets/images/popular-02.jpg" alt="">
                      <h4>PubG<br><span>Battle S</span></h4>
                      <ul>
                        <li><i class="fa fa-star"></i> 4.8</li>
                        <li><i class="fa fa-download"></i> 2.3M</li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <div class="item">
                      <img src="assets/images/popular-03.jpg" alt="">
                      <h4>Dota2<br><span>Steam-X</span></h4>
                      <ul>
                        <li><i class="fa fa-star"></i> 4.8</li>
                        <li><i class="fa fa-download"></i> 2.3M</li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <div class="item">
                      <img src="assets/images/popular-04.jpg" alt="">
                      <h4>CS-GO<br><span>Legendary</span></h4>
                      <ul>
                        <li><i class="fa fa-star"></i> 4.8</li>
                        <li><i class="fa fa-download"></i> 2.3M</li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="item">
                      <div class="row">
                        <div class="col-lg-6 col-sm-6">
                          <div class="item inner-item">
                            <img src="assets/images/popular-05.jpg" alt="">
                            <h4>Mini Craft<br><span>Legendary</span></h4>
                            <ul>
                              <li><i class="fa fa-star"></i> 4.8</li>
                              <li><i class="fa fa-download"></i> 2.3M</li>
                            </ul>
                          </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                          <div class="item">
                            <img src="assets/images/popular-06.jpg" alt="">
                            <h4>Eagles Fly<br><span>Matrix Games</span></h4>
                            <ul>
                              <li><i class="fa fa-star"></i> 4.8</li>
                              <li><i class="fa fa-download"></i> 2.3M</li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <div class="item">
                      <img src="assets/images/popular-07.jpg" alt="">
                      <h4>Warface<br><span>Max 3D</span></h4>
                      <ul>
                        <li><i class="fa fa-star"></i> 4.8</li>
                        <li><i class="fa fa-download"></i> 2.3M</li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <div class="item">
                      <img src="assets/images/popular-08.jpg" alt="">
                      <h4>Warcraft<br><span>Legend</span></h4>
                      <ul>
                        <li><i class="fa fa-star"></i> 4.8</li>
                        <li><i class="fa fa-download"></i> 2.3M</li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="main-button">
                      <a href="browse.html">Discover Popular</a>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
            
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
              <div class="col-lg-3 col-sm-6">
                <div class="item">
                  <div class="thumb">
                    <img src="assets/images/stream-05.jpg" alt="">
                    <div class="hover-effect">
                      <div class="content">
                        <div class="live">
                        <a href="#"><i class="fa fa-eye"></i> 1.2K</a>
                        </div>
                        <ul>
                          <li><a href="#"><i class="fa fa-download""></i></i> 2.2M</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="down-content">
                    <div class="avatar">
                      <!-- <img src="assets/images/avatar-01.jpg" alt="" style="max-width: 46px; border-radius: 50%; float: left;"> -->
                    </div>
                    <span><i class="fa fa-check"></i> HcThanh</span>
                    <h4>Happy Birthday</h4>
                  </div> 
                </div>
              </div>
              <div class="col-lg-3 col-sm-6">
                <div class="item">
                  <div class="thumb">
                    <img src="assets/images/stream-06.jpg" alt="">
                    <div class="hover-effect">
                      <div class="content">
                        <div class="live">
                          <a href="#">Live</a>
                        </div>
                        <ul>
                          <li><a href="#"><i class="fa fa-eye"></i> 1.2K</a></li>
                          <li><a href="#"><i class="fa fa-gamepad"></i> CS-GO</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="down-content">
                    <div class="avatar">
                      <img src="assets/images/avatar-02.jpg" alt="" style="max-width: 46px; border-radius: 50%; float: left;">
                    </div>
                    <span><i class="fa fa-check"></i> LahutaMalc</span>
                    <h4>CS-GO 36 Hours Live Stream</h4>
                  </div> 
                </div>
              </div>
              <div class="col-lg-3 col-sm-6">
                <div class="item">
                  <div class="thumb">
                    <img src="assets/images/stream-07.jpg" alt="">
                    <div class="hover-effect">
                      <div class="content">
                        <div class="live">
                          <a href="#">Live</a>
                        </div>
                        <ul>
                          <li><a href="#"><i class="fa fa-eye"></i> 1.2K</a></li>
                          <li><a href="#"><i class="fa fa-gamepad"></i> CS-GO</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="down-content">
                    <div class="avatar">
                      <img src="assets/images/avatar-03.jpg" alt="" style="max-width: 46px; border-radius: 50%; float: left;">
                    </div>
                    <span><i class="fa fa-check"></i> Areluwa</span>
                    <h4>Maybe Nathej Allnight Chillin'</h4>
                  </div> 
                </div>
              </div>
              <div class="col-lg-3 col-sm-6">
                <div class="item">
                  <div class="thumb">
                    <img src="assets/images/stream-08.jpg" alt="">
                    <div class="hover-effect">
                      <div class="content">
                        <div class="live">
                          <a href="#">Live</a>
                        </div>
                        <ul>
                          <li><a href="#"><i class="fa fa-eye"></i> 1.2K</a></li>
                          <li><a href="#"><i class="fa fa-gamepad"></i> CS-GO</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="down-content">
                    <div class="avatar">
                      <img src="assets/images/avatar-04.jpg" alt="" style="max-width: 46px; border-radius: 50%; float: left;">
                    </div>
                    <span><i class="fa fa-check"></i> NewGangTeam</span>
                    <h4>Live Streaming Till Morning</h4>
                  </div> 
                </div>
              </div>
              <div class="col-lg-3 col-sm-6">
                <div class="item">
                  <div class="thumb">
                    <img src="assets/images/stream-07.jpg" alt="">
                    <div class="hover-effect">
                      <div class="content">
                        <div class="live">
                          <a href="#">Live</a>
                        </div>
                        <ul>
                          <li><a href="#"><i class="fa fa-eye"></i> 1.2K</a></li>
                          <li><a href="#"><i class="fa fa-gamepad"></i> CS-GO</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="down-content">
                    <div class="avatar">
                      <img src="assets/images/avatar-01.jpg" alt="" style="max-width: 46px; border-radius: 50%; float: left;">
                    </div>
                    <span><i class="fa fa-check"></i> Kengan Omeg</span>
                    <h4>Just Talking With Fans</h4>
                  </div> 
                </div>
              </div>
              <div class="col-lg-3 col-sm-6">
                <div class="item">
                  <div class="thumb">
                    <img src="assets/images/stream-08.jpg" alt="">
                    <div class="hover-effect">
                      <div class="content">
                        <div class="live">
                          <a href="#">Live</a>
                        </div>
                        <ul>
                          <li><a href="#"><i class="fa fa-eye"></i> 1.2K</a></li>
                          <li><a href="#"><i class="fa fa-gamepad"></i> CS-GO</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="down-content">
                    <div class="avatar">
                      <img src="assets/images/avatar-02.jpg" alt="" style="max-width: 46px; border-radius: 50%; float: left;">
                    </div>
                    <span><i class="fa fa-check"></i> LahutaMalc</span>
                    <h4>CS-GO 36 Hours Live Stream</h4>
                  </div> 
                </div>
              </div>
              <div class="col-lg-3 col-sm-6">
                <div class="item">
                  <div class="thumb">
                    <img src="assets/images/stream-05.jpg" alt="">
                    <div class="hover-effect">
                      <div class="content">
                        <div class="live">
                          <a href="#">Live</a>
                        </div>
                        <ul>
                          <li><a href="#"><i class="fa fa-eye"></i> 1.2K</a></li>
                          <li><a href="#"><i class="fa fa-gamepad"></i> CS-GO</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="down-content">
                    <div class="avatar">
                      <img src="assets/images/avatar-03.jpg" alt="" style="max-width: 46px; border-radius: 50%; float: left;">
                    </div>
                    <span><i class="fa fa-check"></i> Areluwa</span>
                    <h4>Maybe Nathej Allnight Chillin'</h4>
                  </div> 
                </div>
              </div>
              <div class="col-lg-3 col-sm-6">
                <div class="item">
                  <div class="thumb">
                    <img src="assets/images/stream-06.jpg" alt="">
                    <div class="hover-effect">
                      <div class="content">
                        <div class="live">
                          <a href="#">Live</a>
                        </div>
                        <ul>
                          <li><a href="#"><i class="fa fa-eye"></i> 1.2K</a></li>
                          <li><a href="#"><i class="fa fa-gamepad"></i> CS-GO</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="down-content">
                    <div class="avatar">
                      <img src="assets/images/avatar-04.jpg" alt="" style="max-width: 46px; border-radius: 50%; float: left;">
                    </div>
                    <span><i class="fa fa-check"></i> NewGangTeam</span>
                    <h4>Live Streaming Till Morning</h4>
                  </div> 
                </div>
              </div>
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
