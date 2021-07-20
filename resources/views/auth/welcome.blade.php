<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    /* root */
    * {
      box-sizing: border-box !important;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      color: #666666;
      font-size: 14px;
      font-family: 'Roboto', sans-serif;
      line-height: 1.80857;
      font-weight: normal;
    }

    a {
      color: #1f1f1f;
      text-decoration: none !important;
      outline: none !important;
      -webkit-transition: all .3s ease-in-out;
      -moz-transition: all .3s ease-in-out;
      -ms-transition: all .3s ease-in-out;
      -o-transition: all .3s ease-in-out;
      transition: all .3s ease-in-out;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      letter-spacing: 0;
      font-weight: normal;
      position: relative;
      padding: 0 0 10px 0;
      font-weight: normal;
      line-height: normal;
      color: #111111;
      margin: 0
    }

    h1 {
      font-size: 24px
    }

    h2 {
      font-size: 22px
    }

    h3 {
      font-size: 18px
    }

    h4 {
      font-size: 16px
    }

    h5 {
      font-size: 14px
    }

    h6 {
      font-size: 13px
    }

    *,
    *::after,
    *::before {
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
    }

    h1 a,
    h2 a,
    h3 a,
    h4 a,
    h5 a,
    h6 a {
      color: #212121;
      text-decoration: none !important;
      opacity: 1
    }

    /* root */
    /* RESPONSIVE */
    @media (min-width: 768px) and (max-width: 991px) {
      .text-bg h1 {
        padding-top: 0px;
        font-size: 44px;
        line-height: 61px;
        padding-bottom: 18px;
      }

      .text-bg span {
        font-size: 28px;
        line-height: 30px;
      }

      .text-bg a {
        margin-right: 5px;
        padding: 10px 23px;
        float: inherit;
        max-width: 156px;
      }

    }

    @media (min-width: 576px) and (max-width: 767px) {

      .text-bg a {
        float: inherit;
        margin-bottom: 30px;
      }
    }

    @media (max-width: 575px) {

      .text-bg h1 {
        font-size: 41px;
        line-height: 55px;
        padding-bottom: 18px;
      }

      .text-bg a {
        float: inherit;
        margin-bottom: 30px;
      }

      .text-bg span {
        font-size: 26px;
        line-height: 30px;
      }
    }

    /* RESPONSIVE */

    .intro-header {
      /* padding-top: 50px;
      padding-bottom: 50px; */
      text-align: center;
      color: #f8f8f8;
      background: url("{{ asset('gambar/sistem/bg.jpg')}}") no-repeat center center;
      background-size: cover;
      background-position: center;
    }

    .intro-message {
      position: relative;
      padding-top: 20%;
      /* padding-bottom: 20%; */
    }

    .intro-message>h1 {
      margin: 0;
      text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.6);
      font-size: 2em;
    }

    .intro-divider {
      width: 400px;
      border-top: 1px solid #f8f8f8;
      border-bottom: 1px solid rgba(0, 0, 0, 0.2);
      padding-bottom: 20px;
    }

    .intro-message>h3 {
      text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.6);
      padding-top: 20px;
    }

    /* //dataweb */
    .banner_main {
      background: #0c0f38;
      background-size: 100% 100%;
      background-repeat: no-repeat;
      padding-bottom: 90px;
      padding-top: 70px;
    }

    .text-bg h1 {
      color: #fff;
      font-size: 60px;
      line-height: 80px;
      padding-bottom: 25px;
      font-weight: bold;
    }

    .text-bg span {
      color: #fdd430;
      font-size: 40px;
      line-height: 35px;
      font-weight: bold;
    }

    .text-bg p {
      color: #fff;
      font-size: 17px;
      line-height: 28px;
      padding: 40px 0;
    }

    .text-bg a {
      font-size: 16px;
      background-color: #fff;
      color: #000;
      padding: 10px 0px;
      width: 100%;
      max-width: 190px;
      text-align: center;
      display: inline-block;
      text-transform: uppercase;
    }

    .text-bg a:hover {
      background-color: #000;
      color: #fff;
    }

    .text-img figure {
      margin: 0px;
    }

    .text-img figure img {
      width: 100%;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-dark navbar-expand-sm bg-dark fixed-top">
    <div class="container">
      <a href="/" class="navbar-brand">
        <i class="fas fa-blog"></i> &nbsp;
        Blog Template
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a href="" class="nav-link active">
              Home
            </a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link active">
              Blog
            </a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link active">
              About
            </a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link active">
              Contact
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  {{-- carousel --}}
  {{-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active intro-header">
        <div class="container">
          <div class="intro-message">
            <h1>SWI</h1>
            <h3>Sustainable Weste Indonesia</h3>
            <hr class="intro-divider">
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="http://placekitten.com/1600/600" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="http://placekitten.com/1600/600" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div> --}}

  <section class="banner_main">
    <div class="container">
      <div class="row d_flex">
        <div class="col-md-5">
          <div class="text-bg">
            <h1>Power ful<br> Web Hosting</h1>
            <span>Landing Page 2019</span>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
              dolore magna aliqua. Ut enim ad minim veniam, quis nostrud </p>
            <a href="#">Get Started</a>
          </div>
        </div>
        <div class="col-md-7">
          <div class="text-img">
            <figure><img src="{{ asset('gambar/sistem/lnding.png')}}"></figure>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
  </script>

  <script>
    $('.carousel').carousel({
    interval: 20000
  })
  </script>
</body>

</html>