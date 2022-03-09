<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="shortcut icon" href="/assets/images/logo.png" type="image/x-icon">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <link rel="stylesheet" href="/assets/css/style.css">

    <title>@yield('title') - Baby Elephant Shoot</title>
</head>

<body id="auth">

    <section class="hero-content" id="home">
        <div class="container ">
            @if($scan ?? '')
            @yield('content')
            @else
            <div class="row content justify-content-center">
                <div class="col-lg-5 col-md-8 col-11 text-dark ">
                    <div class="card bg-transparent shadow p-2">
                        @yield('content')
                    </div>
                </div>
            </div>

            @endif
        </div>
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
    </section>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="/assets/js/script.js"></script>

</body>

</html>