<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>laundryku - Clean & White </title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/assets/css/templatemo-scholar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/assets/css/animate.css') }}">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
<!--

TemplateMo 586 Scholar

https://templatemo.com/tm-586-scholar

-->
@livewireStyles
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
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.html" class="logo">
                        <h1>Laundryku</h1>
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Serach Start ***** -->
                    <div class="search-input">
                      <form id="search" action="#">
                        <input type="text" placeholder="Cari......" id='searchText' name="searchKeyword" onkeypress="handle" />
                        <i class="fa fa-search"></i>
                      </form>
                    </div>
                    <!-- ***** Serach Start ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                      <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                      <li class="scroll-to-section"><a href="#services">Layanan</a></li>
                      <li class="scroll-to-section"><a href="#about">Tentang Kami</a></li>
                      <li class="scroll-to-section"><a href="#testimoni">Testimoni</a></li>
                      <li class="scroll-to-section"><a href="#course">Acara</a></li>
                      <li class="scroll-to-section"><a href="#contact">Kontak Kami</a></li>
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
  <!-- ***** Header Area End ***** -->

  <div class="main-banner" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="owl-carousel owl-banner">
            <div class="item item-1">
              <div class="header-text">
                <span class="category">Cepat & Tepat</span>
                <h2>Layanan Laundry Cepat dan Tepat</h2>
                <p>Nikmati Pakaian Bersih dengan Cepat, Kami mengerti betapa berharganya waktu Anda. Dengan layanan cepat kami, pakaian Anda akan bersih dan siap pakai dalam waktu singkat.</p>
                <div class="buttons">
                  <div class="main-button">
                    <a href="#">Pesan Sekarang</a>
                  </div>

                </div>
              </div>
            </div>
            <div class="item item-2">
              <div class="header-text">
                <span class="category">Murah & terjangkau</span>
                <h2>Kualitas Terbaik, Harga Terjangkau</h2>
                <p>Hasil Bersih dan Wangi, Kami menggunakan deterjen berkualitas tinggi yang ramah lingkungan untuk memastikan pakaian Anda selalu bersih, wangi, dan terawat.</p>
                <div class="buttons">
                  <div class="main-button">
                    <a href="#">Pesan Sekarang</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="item item-3">
              <div class="header-text">
                <span class="category">Layanan Profesional</span>
                <h2>Layanan Profesional dan Terpercaya</h2>
                <p>Tim Ahli dan Berpengalaman: Pakaian Anda ditangani oleh tim profesional yang berpengalaman dalam industri laundry. Kami memastikan setiap pakaian mendapatkan perawatan terbaik.</p>
                <div class="buttons">
                  <div class="main-button">
                    <a href="#">Pesan Sekarang</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="services section" id="services">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <div class="service-item">
            <div class="icon">
              <img src="assets/assets/images/basket.png" alt="online degrees">
            </div>
            <div class="main-content">
              <h4>Laundry Kiloan</h4>
              <p>Solusi hemat untuk pakaian sehari-hari Anda. Kami memastikan setiap helai pakaian dicuci dengan teliti dan rapi.</p>
              <div class="main-button">
                <a href="#">Selengkapnya</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="service-item">
            <div class="icon">
              <img src="assets/assets/images/satuan.png" alt="short courses">
            </div>
            <div class="main-content">
              <h4>Laundry Satuan</h4>
              <p>Perawatan khusus untuk pakaian dan barang berharga Anda. Cocok untuk pakaian dengan bahan khusus seperti jas, gaun, dan lainnya.</p>
              <div class="main-button">
                <a href="#">Selengkapnya</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="service-item">
            <div class="icon">
              <img src="assets/assets/images/ironing-board.png" alt="web experts">
            </div>
            <div class="main-content">
              <h4>Setrika</h4>
              <p>Layanan setrika profesional untuk pakaian yang rapi dan bebas kusut. Kami menggunakan setrika uap berkualitas untuk hasil terbaik.</p>
              <div class="main-button">
                <a href="#">Selengkapnya</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="section about-us" id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-1">
          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Mengapa Memilih Kami?
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    Dengan pengalaman bertahun-tahun dalam industri laundry, kami memiliki keahlian untuk menangani berbagai jenis kain dan pakaian dengan perawatan yang tepat.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Layanan Antar Jemput Gratis
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    Untuk kenyamanan Anda, kami menyediakan layanan antar jemput gratis, sehingga Anda tidak perlu repot mengantar dan mengambil pakaian.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Harga Kompetitif
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    Kami menawarkan harga yang bersaing dengan berbagai paket layanan yang bisa disesuaikan dengan kebutuhan dan anggaran Anda.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    Pelayanan Ramah
                </button>
              </h2>
              <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    Tim kami selalu siap melayani Anda dengan ramah dan profesional, memastikan setiap kebutuhan Anda terpenuhi dengan baik.
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5 align-self-center">
          <div class="section-heading">
            <h6>Tentang Kami</h6>
            <h2>Siapa Kami</h2>
            <p>Kami adalah penyedia layanan laundry yang berkomitmen untuk memberikan hasil terbaik dan pengalaman pelanggan yang memuaskan. Dengan tim profesional dan berpengalaman, kami selalu berusaha untuk memenuhi kebutuhan laundry Anda dengan kualitas tertinggi.</p>
            <div class="main-button">
              <a href="#">Pelajari selengkapnya</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <div class="section fun-facts">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="wrapper">
            <div class="row">
              <div class="col-lg-3 col-md-6">
                <div class="counter">
                  <h2 class="timer count-title count-number" data-to="150" data-speed="1000"></h2>
                   <p class="count-text ">Pelanggan</p>
                </div>
              </div>
              <div class="col-lg-3 col-md-6">
                <div class="counter">
                  <h2 class="timer count-title count-number" data-to="804" data-speed="1000"></h2>
                  <p class="count-text ">Kilo Pakaian Dicuci</p>
                </div>
              </div>
              <div class="col-lg-3 col-md-6">
                <div class="counter">
                  <h2 class="timer count-title count-number" data-to="5" data-speed="1000"></h2>
                  <p class="count-text ">Perusahaan yang Dilayani</p>
                </div>
              </div>
              <div class="col-lg-3 col-md-6">
                <div class="counter end">
                  <h2 class="timer count-title count-number" data-to="15" data-speed="1000"></h2>
                  <p class="count-text ">Tahun Pengalaman</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- <div class="team section" id="team">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <div class="team-member">
            <div class="main-content">
              <img src="assets/assets/images/member-01.jpg" alt="">
              <span class="category">UX Teacher</span>
              <h4>Sophia Rose</h4>
              <ul class="social-icons">
                <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="team-member">
            <div class="main-content">
              <img src="assets/assets/images/member-02.jpg" alt="">
              <span class="category">Graphic Teacher</span>
              <h4>Cindy Walker</h4>
              <ul class="social-icons">
                <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="team-member">
            <div class="main-content">
              <img src="assets/assets/images/member-03.jpg" alt="">
              <span class="category">Full Stack Master</span>
              <h4>David Hutson</h4>
              <ul class="social-icons">
                <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="team-member">
            <div class="main-content">
              <img src="assets/assets/images/member-04.jpg" alt="">
              <span class="category">Digital Animator</span>
              <h4>Stella Blair</h4>
              <ul class="social-icons">
                <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> --}}

  <div class="section testimonials" id="testimoni">
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
          <div class="owl-carousel owl-testimonials">
            <div class="item">
              <p>“Layanan laundry ini benar-benar mengagumkan! Pakaian saya selalu kembali dalam kondisi terbaik, bersih dan wangi. Saya sangat menghargai layanan antar jemput gratis yang mereka tawarkan. Terima kasih banyak!”</p>
              <div class="author">
                <img src="assets/assets/images/testimonial-author.jpg" alt="">
                <span class="category">Ibu Rumah Tangga</span>
                <h4>Sophia Latjuba</h4>
              </div>
            </div>
            <div class="item">
              <p>“Saya telah menggunakan layanan laundry ini selama lebih dari setahun dan tidak pernah kecewa. Pakaian saya selalu ditangani dengan baik, dan saya suka bahwa mereka menggunakan deterjen yang ramah lingkungan. Benar-benar layanan laundry terbaik di kota!”</p>
              <div class="author">
                <img src="assets/assets/images/testimonial-author.jpg" alt="">
                <span class="category">Pekerja Kantor</span>
                <h4>Layla Hutabarat</h4>
              </div>
            </div>
            <div class="item">
              <p>“Sebagai seorang ibu yang sibuk, saya sangat terbantu dengan layanan laundry ini. Mereka cepat, efisien, dan hasilnya selalu memuaskan. Tim mereka juga sangat ramah dan profesional. Sangat direkomendasikan”</p>
              <div class="author">
                <img src="assets/assets/images/testimonial-author.jpg" alt="">
                <span class="category">Ibu Rumah Tangga</span>
                <h4>Cindy Gula</h4>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5 align-self-center">
          <div class="section-heading">
            <h6>TESTIMONIAL</h6>
            <h2>Apa Kata Pelanggan Kami</h2>
            <p>Layanan laundry ini benar-benar mengagumkan! Pakaian saya selalu kembali dalam kondisi terbaik, bersih dan wangi. Saya sangat menghargai layanan antar jemput gratis yang mereka tawarkan. Terima kasih banyak!</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="section events" id="course">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="section-heading">
            <h6>Jadwal</h6>
            <h2>Jadwal Acara Mendatang</h2>
          </div>
        </div>
        <div class="col-lg-12 col-md-6">
          <div class="item">
            <div class="row">
              <div class="col-lg-3">
                <div class="image">
                  <img src="assets/assets/images/event-01.jpg" alt="">
                </div>
              </div>
              <div class="col-lg-9">
                <ul>
                  <li>
                    <span class="category">Pencucian dan Perawatan Pakaian</span>
                    <h4>Pelatihan Cuci Pakaian Efektif</h4>
                  </li>
                  <li>
                    <span>Tanggal:</span>
                    <h6>16 Juli 2024</h6>
                  </li>
                  <li>
                    <span>Durasi:</span>
                    <h6>6 Jam</h6>
                  </li>
                  <li>
                    <span>Harga:</span>
                    <h6>Rp 300.000</h6>
                  </li>
                </ul>
                <a href="#"><i class="fa fa-angle-right"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12 col-md-6">
          <div class="item">
            <div class="row">
              <div class="col-lg-3">
                <div class="image">
                  <img src="assets/assets/images/event-02.jpg" alt="">
                </div>
              </div>
              <div class="col-lg-9">
                <ul>
                  <li>
                    <span class="category">Perawatan Khusus</span>
                    <h4>Perawatan Pakaian Berbahan Khusus</h4>
                  </li>
                  <li>
                    <span>Tanggal:</span>
                    <h6>24 Juli 2024</h6>
                  </li>
                  <li>
                    <span>Durasi:</span>
                    <h6>8 Jam</h6>
                  </li>
                  <li>
                    <span>Harga:</span>
                    <h6>Rp 300.000</h6>
                  </li>
                </ul>
                <a href="#"><i class="fa fa-angle-right"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12 col-md-6">
          <div class="item">
            <div class="row">
              <div class="col-lg-3">
                <div class="image">
                  <img src="assets/assets/images/event-03.jpg" alt="">
                </div>
              </div>
              <div class="col-lg-9">
                <ul>
                  <li>
                    <span class="category">Layanan Pelanggan</span>
                    <h4>Teknik Layanan Pelanggan untuk Bisnis Laundry</h4>
                  </li>
                  <li>
                    <span>Tanggal:</span>
                    <h6>12 Agustus 2024</h6>
                  </li>
                  <li>
                    <span>Durasi:</span>
                    <h6>4 Jam</h6>
                  </li>
                  <li>
                    <span>Harga:</span>
                    <h6>$440</h6>
                  </li>
                </ul>
                <a href="#"><i class="fa fa-angle-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="contact-us section" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-6  align-self-center">
          <div class="section-heading">
            <h6>Hubungi Kami</h6>
            <h2>Hubungi Kami Kapan Saja</h2>
            <p>Terima kasih telah memilih layanan laundry kami. Kami siap membantu Anda kapan saja. Jika Anda memiliki pertanyaan, saran, atau membutuhkan informasi lebih lanjut mengenai layanan kami, jangan ragu untuk menghubungi kami. Kepuasan Anda adalah prioritas kami.</p>
            <div class="special-offer">
              <span class="offer">Diskon<br><em>10%</em></span>
              <h6>Berlaku Hingga: <em>31 Desember 2024</em></h6>
              <h4>Penawaran Special <em>10%</em></h4>
              <a href="#"><i class="fa fa-angle-right"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="contact-us-content">
            <form id="contact-form" action="" method="post">
              <div class="row">
                <div class="col-lg-12">
                  <fieldset>
                    <input type="name" name="name" id="name" placeholder="Nama" autocomplete="on" required>
                  </fieldset>
                </div>
                <div class="col-lg-12">
                  <fieldset>
                    <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="E-mail" required="">
                  </fieldset>
                </div>
                <div class="col-lg-12">
                  <fieldset>
                    <textarea name="message" id="message" placeholder="Message"></textarea>
                  </fieldset>
                </div>
                <div class="col-lg-12">
                  <fieldset>
                    <button type="submit" id="form-submit" class="orange-button">Kirim Pesan Sekarang</button>
                  </fieldset>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <div class="container">
      <div class="col-lg-12">
        <p>Copyright © 2024 LaundryKu Organization. All rights reserved. &nbsp;&nbsp;&nbsp;</p>
      </div>
    </div>
  </footer>
  
  @livewireScripts
  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}s"></script>
  <script src="{{ asset('assets/assets/js/isotope.min.js') }}"></script>
  <script src="{{ asset('assets/assets/js/owl-carousel.js') }}"></script>
  <script src="{{ asset('assets/assets/js/counter.js') }}s"></script>
  <script src="{{ asset('assets/assets/js/custom.js') }}"></script>

  </body>
</html>
