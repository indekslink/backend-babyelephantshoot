<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" href="/assets/images/logo.png" type="image/x-icon">
    <meta name="description" content="Baby Elephant Shoot" />
    <meta name="author" content="Indekslink Indonesia" />
    <title>{{ $title ?? ''}} {{ $title ? '-' : ''}} Baby Elephant Shoot</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="/main/css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/main/css/my-style.css">
    <style>
        #layoutSidenav_content #slideHeroContent {
            position: absolute;
            inset: 0;
            left: 225px;
            z-index: 2;
            filter: opacity(0.1);
        }

        #layoutSidenav_content #slideHeroContent .carousel-inner,
        #layoutSidenav_content #slideHeroContent .carousel-inner .carousel-item,
        #layoutSidenav_content #slideHeroContent .carousel-inner .carousel-item img {
            height: 100%;
        }

        #layoutSidenav_content main {
            position: relative;
            z-index: 3;
        }

        @media (max-width: 575.98px) {
            #layoutSidenav_content #slideHeroContent {
                top: 50%;
                transform: translateY(-50%);
            }
        }
    </style>
    @yield('css')
</head>

<body class="sb-nav-fixed">
    @include('partials.navbar')
    <div id="layoutSidenav">
        @include("partials.sidebar")
        <div id="layoutSidenav_content" class="position-relative">
            <div id="slideHeroContent" class="carousel slide carousel-fade" data-bs-interval="5000" data-bs-ride="carousel" data-bs-pause="false">
                <div class="carousel-inner">
                    <div class="carousel-item carousel-item-next carousel-item-start">
                        <img src="/assets/images/logo.png" class="d-block mx-auto img-fluid" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="/assets/images/6.jpeg" class="d-block mx-auto img-fluid" alt="...">
                    </div>
                    <div class="carousel-item active carousel-item-start">
                        <img src="/assets/images/7.jpeg" class="d-block mx-auto img-fluid" alt="...">
                    </div>
                </div>
            </div>
            <main>
                @yield('content')
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2021</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="/main/js/scripts.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="/main/assets/demo/chart-area-demo.js"></script>
    <script src="/main/assets/demo/chart-bar-demo.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="/main/js/datatables-simple-demo.js"></script> -->

    <script src="/assets/js/script.js"></script>

    @yield('script')
</body>

</html>