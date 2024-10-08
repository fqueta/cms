@php
    $nome = '';
    if(Gate::allows('is_logado')){
        // $n = explode(' ',Auth::user()['name']);
        // $nome = $n[0];
        $nome = Auth::user()['email'];
    }
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{url('/assets/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{url('/assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{url('/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{url('/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{url('/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{url('/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{url('/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{url('/assets/css/style.css')}}" rel="stylesheet">
  @yield('css')
  <!-- =======================================================
  * Template Name: Moderna - v4.11.0
  * Template URL: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <div id="preload" class="d-print-none">
        <div class="lds-dual-ring"></div>
    </div>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent d-print-none">
    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo">
        <h1 class="text-light"><a href="index.html"><span>Moderna</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="active " href="{{url('/')}}">Home</a></li>
          <li><a href="{{route('sic.internautas.relatorios')}}">E-sic</a></li>
          <li><a href="{{route('cad.internautas',['tipo'=>'pf'])}}">Cadastrar P.F</a></li>
          <li><a href="{{route('cad.internautas',['tipo'=>'pj'])}}">Cadastrar P.J</a></li>
          {{-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li> --}}

          @can('is_logado')
            {{-- <li class="nav-item me-3 me-lg-0">
                <div class="dropdown">
                    <a class="me-3 dropdown-toggle hidden-arrow" href="#" id="notification"
                    role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell text-white"></i>
                        @if(isset($notification['total']) && $notification['total']>0)
                            <span class="badge rounded-pill badge-notification bg-danger" id="total-notifications">
                                {{$notification['total']}}
                            </span>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end1" style="width: 450px" aria-labelledby="notification">
                        <li class="w-100 cx-notification">
                            @include('site.layout.top_notification')
                        </li>
                    </ul>
                </div>
            </li> --}}

            @if (Gate::allows('is_user_front') || Gate::allows('is_user_back'))
                <li class="dropdown dropdown-menu-right"><a href="#" style="padding-left: 8px"><span><i class="fas fa-user-circle fa-2x"></i> {{@$nome}}</span> <i class="bi bi-chevron-down"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end1">
                    @can('is_user_back')
                        <li><a href="/admin">Painel Admin</a></li>
                    @endcan
                    {{-- <li class="dropdown"><a href="#"> <span>Gerenciar leilões</span> <i class="bi bi-chevron-right"></i> </a>
                        <ul>
                            <li><a href="{{url('/')}}/{{App\Qlib\Qlib::get_slug_post_by_id(2)}}">{{__('Cadastrar Sic')}}</a></li>
                            <li><a href="{{url('/')}}/{{App\Qlib\Qlib::get_slug_post_by_id(12)}}">{{__('Minhas solicitações')}}</a></li>
                        </ul>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li> --}}
                    <li><a href="{{url('/internautas/sic/create')}}">Cadastrar E-SIC</a></li>
                    <li><a href="{{url('/meu-cadastro')}}">Meu Cadastro</a></li>
                    {{-- <li><a href="#">Meus pacotes</a></li> --}}
                    {{-- <li><a href="#">Drop Down 3</a></li>
                    <li><a href="#">Drop Down 4</a></li> --}}
                    <li class="user-footer">
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{__('Sair')}}
                        </a>
                        <form id="logout-form" action="/logout" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    </ul>
                </li>
            @else
                {{-- <li>

                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{__('Usuario bloquedo clique para sair')}}
                    </a>
                    <form id="logout-form" action="/logout" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li> --}}
            @endif
            {{-- <li><a href="/cart"><i class="fas fa-cart-arrow-down"></i></a></li> --}}

            @else
            <li class="nav-item dropdown ms-3">
                <a class="nav-link dropdown-toggle show" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="true">
                    Minha conta
                </a>
                <ul class="dropdown-menu border-0 show" data-bs-popper="static">
                    <li>
                        <a class="dropdown-item" href="{{route('login')}}">
                            <small><i class="fa fa-user"></i> Login</small>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{url('/user/create')}}">
                            <small><i class="fa fa-address-card"></i> Cadastro</small>
                        </a>
                    </li>
                    {{-- <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item text-danger" href="#">
                            <small><i class="fa-solid fa-right-from-bracket"></i> Sair</small>
                        </a></li> --}}
                </ul>
            </li>
            {{-- <li><a class="btn btn-default btn-flat float-right" href="{{route('login')}}"><i class="fas fa-user"></i>&nbsp;Login</a></li>
            <li><a class="btn btn-default btn-flat float-right" href="{{url('/user/create')}}"><i class="fas fa-user"></i>&nbsp;Cadastrar</a></li> --}}
            @endcan
          {{-- <li><a href="contact.html">Contact Us</a></li> --}}
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>

      <!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex justify-cntent-center align-items-center d-print-none">
    {{-- <div id="heroCarousel" class="container carousel carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

      <!-- Slide 1 -->
      <div class="carousel-item active">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown">Welcome to <span>Moderna</span></h2>
          <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
          <a href="" class="btn-get-started animate__animated animate__fadeInUp">Read More</a>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown">Lorem Ipsum Dolor</h2>
          <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
          <a href="" class="btn-get-started animate__animated animate__fadeInUp">Read More</a>
        </div>
      </div>

      <!-- Slide 3 -->
      <div class="carousel-item">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown">Sequi ea ut et est quaerat</h2>
          <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
          <a href="" class="btn-get-started animate__animated animate__fadeInUp">Read More</a>
        </div>
      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>
      </a>

    </div> --}}
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Services Section ======= -->
    {{-- <section class="services">
      <div class="container">

        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="fade-up">
            <div class="icon-box icon-box-pink">
              <div class="icon"><i class="bx bxl-dribbble"></i></div>
              <h4 class="title"><a href="">Lorem Ipsum</a></h4>
              <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="icon-box icon-box-cyan">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4 class="title"><a href="">Sed ut perspiciatis</a></h4>
              <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="icon-box icon-box-green">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4 class="title"><a href="">Magni Dolores</a></h4>
              <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="icon-box icon-box-blue">
              <div class="icon"><i class="bx bx-world"></i></div>
              <h4 class="title"><a href="">Nemo Enim</a></h4>
              <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
            </div>
          </div>

        </div>

      </div>
    </section> --}}
    <!-- End Services Section -->
    @yield('content')

  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" data-aos="fade-up" class="d-print-none" data-aos-easing="ease-in-out" data-aos-duration="500">

    <div class="footer-newsletter">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <h4>Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
          </div>
          <div class="col-lg-6">
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-top ">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>

          </div>

          <div class="col-lg-3 col-md-6 footer-info">
            <h3>About Moderna</h3>
            <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Moderna</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{url('/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{url('/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{url('/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{url('/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{url('/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{url('/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{url('/assets/vendor/waypoints/noframework.waypoints.js')}}"></script>
  <script src="{{url('/assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{url('/assets/js/main.js')}}"></script>
  @yield('js')

</body>

</html>
