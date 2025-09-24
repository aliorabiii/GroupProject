<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Scholar - Online School HTML5 Template</title>

    <!-- Bootstrap core CSS -->
<link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<!-- Additional CSS Files -->
<link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/templatemo-scholar.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

<!--

TemplateMo 586 Scholar

https://templatemo.com/tm-586-scholar

-->
  </head>

<body class="bg-success">

 
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky bg-dark bg-opacity-75 fixed-top shadow-sm">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-12">
        <nav class="navbar navbar-expand-lg navbar-dark">
          
          <!-- Logo -->
          <a class="navbar-brand fw-bold fs-3 text-warning" href="index.html">
            <img src="assets/images/logo.png" alt="iWaiter Logo" style="height: 90px; width: auto;">
          </a>

          <!-- Mobile Toggle -->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <!-- Menu -->
          <div class="collapse navbar-collapse justify-content-end" id="navMenu">
            <ul class="navbar-nav mb-2 mb-lg-0">
              <li class="nav-item"><a class="nav-link active" href="index.html">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="about.html">About Us</a></li>
              <li class="nav-item"><a class="nav-link" href="Features.html">Features</a></li>
              <li class="nav-item"><a class="nav-link" href="Services.html">Services</a></li>
              <li class="nav-item"><a class="nav-link" href="Testimonials.html">Testimonials</a></li>
              <li class="nav-item"><a class="nav-link" href="Contact.html"></a></li>
            </ul>
          </div>

        </nav>
      </div>
    </div>
  </div>
</header>
  <!-- ***** Header Area End ***** -->

<div class="section bg-dark text-warning py-5">
    <div class="container">
        <div class="row">
            {{-- Accordion Column --}}
            <div class="col-lg-6 offset-lg-1">
                <div class="accordion" id="accordionExample">
                    @php
                        $accordion = json_decode($about->accordion_json ?? '[]', true) ?? [];
                    @endphp

                    @foreach($accordion as $index => $item)
                    <div class="accordion-item bg-dark border-warning mb-2">
                        <h2 class="accordion-header" id="heading{{ $index }}">
                            <button class="accordion-button {{ $index != 0 ? 'collapsed' : '' }} bg-dark text-warning" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                {{ $item['question'] ?? '' }}
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body text-light">
                                {!! $item['answer'] ?? '' !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- About Text Column --}}
            <div class="col-lg-5 align-self-center">
                <div class="section-heading text-warning">
                    <h6>About Us</h6>
                    <h2>{{ $about->title ?? 'What make us the best academy online?' }}</h2>
                    <p class="text-light">
                        {!! $about->content ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravid risus commodo.' !!}
                    </p>
                    <div class="main-button">
                        @if($about->cta_text && $about->cta_link)
                            <a href="{{ $about->cta_link }}" class="btn btn-warning text-dark">{{ $about->cta_text }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@role('abouteditor|super-admin')
    <div class="mt-4">
        <a href="{{ route('about.edit') }}" class="btn btn-warning">
            <i class="bi bi-pencil-square"></i> Edit About Page
        </a>
    </div>
@endrole

<!-- Footer -->
<!-- Footer -->
<footer class="footer bg-dark text-white pt-5 pb-3 mt-5">
  <div class="container">
    <div class="row gy-4">
      
      <!-- Brand / About -->
      <div class="col-lg-4 col-md-6 pb-5">
        <div class="footer-logo mb-3">
          <a href="index.html">
            <img src="assets/images/logo.png" alt="iWaiter Logo" style="height: 80px; width: auto;">
          </a>
        </div>
        <p>
          Smarter dining starts here. With iWaiter, customers enjoy faster, easier, and smarter ordering powered by iPad technology.
        </p>
        <div class="d-flex gap-3 mt-3">
          <a href="#" class="text-white fs-5"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="text-white fs-5"><i class="fab fa-instagram"></i></a>
          <a href="#" class="text-white fs-5"><i class="fab fa-linkedin-in"></i></a>
          <a href="#" class="text-white fs-5"><i class="fab fa-twitter"></i></a>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="col-lg-2 col-md-6">
        <h5 class="fw-bold mb-3">Quick Links</h5>
        <ul class="list-unstyled">
          <li><a href="index.html" class="text-white-50 text-decoration-none">Home</a></li>
          <li><a href="about.html" class="text-white-50 text-decoration-none">About Us</a></li>
          <li><a href="features.html" class="text-white-50 text-decoration-none">Features</a></li>
          <li><a href="#" class="text-white-50 text-decoration-none">Services</a></li>
          <li><a href="#" class="text-white-50 text-decoration-none">Testimonials</a></li>
          <li><a href="#" class="text-white-50 text-decoration-none">Contact Us</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div class="col-lg-3 col-md-6">
        <h5 class="fw-bold mb-3">Contact</h5>
        <p class="mb-2"><i class="fa fa-map-marker-alt me-2 text-warning"></i> Dubai, UAE</p>
        <p class="mb-2"><i class="fa fa-envelope me-2 text-warning"></i> support@iwaiter.com</p>
        <p><i class="fa fa-phone me-2 text-warning"></i> +971 55 123 4567</p>
      </div>

      <!-- Newsletter -->
      <div class="col-lg-3 col-md-6">
        <h5 class="fw-bold mb-3">Stay Updated</h5>
        <p class="mb-3">Subscribe to get the latest updates & offers from iWaiter.</p>
        <form class="d-flex">
          <input type="email" class="form-control rounded-start-pill" placeholder="Your email">
          <button class="btn btn-warning rounded-end-pill px-3">Go</button>
        </form>
      </div>

    </div>

    <hr class="border-light mt-4">

    <!-- Bottom -->
    <div class="row">
      <div class="col text-center">
        <p class="mb-0 small text-white-50">© <span id="year"></span> iWaiter. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>

<!-- Auto Year Script -->
<script>
  document.getElementById("year").textContent = new Date().getFullYear();
</script>


<!-- Bootstrap CSS + JS + Icons (include if not already in your project) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"> 





  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/isotope.min.js') }}"></script>
<script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
<script src="{{ asset('assets/js/counter.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>


  </body>
</html>
