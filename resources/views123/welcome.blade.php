@extends('layouts.website')
@section('content')
 <!--Slider Section-->
 <section class="bg-white pb-8" id="home">
        <div class="container-small hero-header-container px-lg-7 px-xxl-3">
          <div class="row align-items-center">
            <div class="col-12 col-lg-auto order-0 order-md-1 text-end order-1">
              <div class="position-relative p-5 p-md-7 d-lg-none">
                <div class="bg-holder" style="background-image:url({{asset('assets/img/bg/bg-23.png')}});background-size:contain;">
                </div>
                <!--/.bg-holder-->

                <div class="position-relative">
				<img class="w-100 shadow-lg d-dark-none rounded-2" src="{{asset('assets/img/bg/bg-31.png')}}" alt="hero-header" />
				<img class="w-100 shadow-lg d-light-none rounded-2" src="{{asset('assets/img/bg/bg-30.png')}}" alt="hero-header" />
				</div>
              </div>
              <div class="hero-image-container position-absolute top-0 bottom-0 end-0 d-none d-lg-block">
                <div class="position-relative h-100 w-100">
                  <div class="position-absolute h-100 top-0 d-flex align-items-center end-0 hero-image-container-bg">
				  <img class="pt-7 pt-md-0 w-100" src="{{asset('assets/img/bg/bg-1-2.png')}}" alt="hero-header" /></div>
                  <div class="position-absolute h-100 top-0 d-flex align-items-center end-0">
				  <img class="pt-7 pt-md-0 w-100 shadow-lg d-dark-none rounded-2" src="{{asset('assets/img/bg/bg-28.png')}}" alt="hero-header" />
				  <img class="pt-7 pt-md-0 w-100 shadow-lg d-light-none rounded-2" src="{{asset('assets/img/bg/bg-29.png')}}" alt="hero-header" />
				  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 text-lg-start text-center pt-8 pb-6 order-0 position-relative">
              <h1 class="fs-5 fs-lg-6 fs-md-7 fs-lg-6 fs-xl-7 fs fw-black mb-4"><span class="text-primary me-3">Elegance</span>for<br />your web app</h1>
              <p class="mb-5">Standard, modern and Elegant solution for your next web app so you don’t have to look further. Sign up or check the demo below.</p><a class="btn btn-lg btn-primary rounded-pill me-3" href="#!" role="button">Sign up</a><a class="btn btn-link me-2 fs-0 p-0" href="#!" role="button">Check Demo<span class="fa-solid fa-angle-right ms-2 fs--1"></span></a>
            </div>
          </div>
        </div>
      </section>


      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="py-5 pt-xl-13 bg-white">

        <div class="container-small px-lg-7 px-xxl-3">
          <div class="row g-0">
            <div class="col-6 col-md-3">
              <div class="p-2 p-lg-5 d-flex flex-center h-100 border-1 border-dashed border-bottom border-end"><img class="w-100" src="{{asset('assets/img/brand2/netflix-n.png')}}" alt="" /></div>
            </div>
            <div class="col-6 col-md-3">
              <div class="p-2 p-lg-5 d-flex flex-center h-100 border-1 border-dashed border-bottom border-end-md"><img class="w-100" src="{{asset('assets/img/brand2/blender.png')}}" alt="" /></div>
            </div>
            <div class="col-6 col-md-3">
              <div class="p-2 p-lg-5 d-flex flex-center h-100 border-1 border-dashed border-bottom border-end border-end-md"><img class="w-100" src="{{asset('assets/img/brand2/upwork.png')}}" alt="" /></div>
            </div>
            <div class="col-6 col-md-3">
              <div class="p-2 p-lg-5 d-flex flex-center h-100 border-1 border-dashed border-bottom border-end-lg-0"><img class="w-100" src="{{asset('assets/img/brand2/facebook-f.png')}}" alt="" /></div>
            </div>
            <div class="col-6 col-md-3">
              <div class="p-2 p-lg-5 d-flex flex-center h-100 border-1 border-dashed border-end border-bottom border-bottom-md-0"><img class="w-100" src="{{asset('assets/img/brand2/pocket.png')}}" alt="" /></div>
            </div>
            <div class="col-6 col-md-3">
              <div class="p-2 p-lg-5 d-flex flex-center h-100 border-1 border-dashed border-end-md border-bottom border-bottom-md-0"><img class="w-100" src="{{asset('assets/img/brand2/mail-bluster-1.png')}}" alt="" /></div>
            </div>
            <div class="col-6 col-md-3">
              <div class="p-2 p-lg-5 d-flex flex-center h-100 border-1 border-dashed border-end"><img class="w-100" src="{{asset('assets/img/brand2/discord.png')}}" alt="" /></div>
            </div>
            <div class="col-6 col-md-3">
              <div class="p-2 p-lg-5 d-flex flex-center h-100 border-1 border-dashed border-end-lg-0"><img class="w-100" src="{{asset('assets/img/brand2/google-g.png')}}" alt="" /></div>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->




      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="pt-15 pb-0" id="feature">

        <div class="container-small px-lg-7 px-xxl-3">
          <div class="position-relative z-index-2">
            <div class="row">
              <div class="col-lg-6 text-center text-lg-start pe-xxl-3">
                <h4 class="text-primary fw-bolder mb-4">Features</h4>
                <h2 class="mb-3 text-black lh-base">Seamless Payments: A Fully <br class="d-md-none" />Integrated Suite</h2>
                <p class="mb-5">With the power of Phoenix, you can now focus only on functionaries for your digital products, while leaving the UI design on us!With the power of Phoenix, you can now focus only on functionaries for your digital products, while leaving the UI design on us!</p><a class="btn btn-lg btn-outline-primary rounded-pill me-2" href="#!" role="button">Find out more<i class="fa-solid fa-angle-right ms-2"></i></a>
              </div>
              <div class="col-sm-6 col-lg-3 mt-7 text-center text-lg-start">
                <div class="h-100 d-flex flex-column justify-content-between">
                  <div class="border-start-lg border-dashed ps-4"><img class="mb-4" src="{{asset('assets/img/icons/illustrations/bolt.png')}}" width="48" height="48" alt="" />
                    <div>
                      <h5 class="fw-bolder mb-2">Lightning Speed</h5>
                      <p class="fw-semi-bold lh-sm">Present everything you need in one place within minutes! Grow with Phoenix!</p>
                    </div>
                    <div><a class="btn btn-link me-2 p-0 fs--1" href="#!" role="button">Check Demo<span class="fa-solid fa-angle-right ms-2"></span></a></div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-3 mt-7 text-center text-lg-start">
                <div class="h-100 d-flex flex-column">
                  <div class="border-start-lg border-dashed ps-4"><img class="mb-4" src="{{asset('assets/img/icons/illustrations/pie.png')}}" width="48" height="48" alt="" />
                    <div>
                      <h5 class="fw-bolder mb-2">All-in-one solution</h5>
                      <p class="fw-semi-bold lh-sm">Show your production and growth graph in one place with Phoenix!</p>
                    </div>
                    <div><a class="btn btn-link me-2 p-0 fs--1" href="#!" role="button">Check Demo<i class="fa-solid fa-angle-right ms-2"></i></a></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-12 align-items-center justify-content-between text-center text-lg-start mb-6 mb-lg-0">
              <div class="col-lg-5">
			  <img class="feature-image img-fluid mb-9 mb-lg-0 d-dark-none" src="{{asset('assets/img/spot-illustrations/22_2.png')}}" alt="" />
			  <img class="feature-image img-fluid mb-9 mb-lg-0 d-light-none" src="{{asset('assets/img/spot-illustrations/dark_22.png')}}" alt="" /></div>
              <div class="col-lg-6">
                <h6 class="text-primary mb-2 ls-2">SIGNAL</h6>
                <h3 class="fw-bolder mb-3">Recieve the signals instantly</h3>
                <p class="mb-4 px-md-7 px-lg-0">Phoenix makes it possible for you to quickly and effectively receive every signal. No need for drawn-out waiting.</p><a class="btn btn-link me-2 p-0 fs--1" href="#!" role="button">Check Demo<i class="fa-solid fa-angle-right ms-2"></i></a>
              </div>
            </div>
            <div class="row mt-2 align-items-center justify-content-between text-center text-lg-start mb-6 mb-lg-0">
              <div class="col-lg-5 order-0 order-lg-1">
			  <img class="feature-image img-fluid mb-9 mb-lg-0 d-dark-none" src="{{asset('assets/img/spot-illustrations/23_2.png')}}" height="394" alt="" />
			  <img class="feature-image img-fluid mb-9 mb-lg-0 d-light-none" src="{{asset('assets/img/spot-illustrations/dark_23.png')}}" height="394" alt="" /></div>
              <div class="col-lg-6">
                <h6 class="text-primary mb-2 ls-2">REVENUE</h6>
                <h3 class="fw-bolder mb-3">See Your Revenue Grow</h3>
                <p class="mb-4 px-md-7 px-lg-0">Grow with Phoenix. We help you with everything you might need., We make it easy and keep it simple.</p><a class="btn btn-link me-2 p-0 fs--1" href="#!" role="button">Check Demo<i class="fa-solid fa-angle-right ms-2"></i></a>
              </div>
            </div>
            <div class="row mt-2 align-items-center justify-content-between text-center text-lg-start mb-6 mb-lg-0">
              <div class="col-lg-5"><img class="feature-image img-fluid mb-9 mb-lg-0 d-dark-none" src="{{asset('assets/img/spot-illustrations/24_2.png')}}" height="394" alt="" />
			  <img class="feature-image img-fluid mb-9 mb-lg-0 d-light-none" src="{{asset('assets/img/spot-illustrations/dark_24.png')}}" height="394" alt="" /></div>
              <div class="col-lg-6 text-center text-lg-start">
                <h6 class="text-primary mb-2 ls-2">REPORTS</h6>
                <h3 class="fw-bolder mb-3">Get Reports Ready</h3>
                <p class="mb-4 px-md-7 px-lg-0">With Phoenix, you can get ready reports on your growth analysis anytime. This dashboard also has all filters accessible according to your needs.</p><a class="btn btn-link me-2 p-0 fs--1" href="#!" role="button">Check Demo<i class="fa-solid fa-angle-right ms-2"></i></a>
              </div>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->

 <div class="position-relative">
        <div class="bg-holder z-index-2 d-none d-md-block" style="background-image:url({{asset('assets/img/bg/13.png')}});background-size:auto;background-position:right;">
        </div>
        <!--/.bg-holder-->

        <div class="bg-holder z-index-2 d-none d-md-block d-lg-none d-xl-block" style="background-image:url({{asset('assets/img/bg/bg-12.png')}});background-size:auto;background-position:left;">
        </div>
        <!--/.bg-holder-->

        <div class="bottom-0 start-0 end-0 bg-white">
          <svg class="w-100 text-soft" viewBox="0 0 1920 368" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1920 0.44L0 367.74V0H1920V0.44Z" fill="currentColor"></path>
          </svg>
        </div>
        <section class="pb-0 bg-white overflow-hidden position-static">
          <div class="container-small px-lg-7 px-xxl-3">
            <div class="row">
              <div class="col-lg-6 mb-6 text-center text-lg-start z-index-2">
                <h4 class="text-primary fw-bolder mb-3">Testimonial</h4>
                <h2 class="mb-3 text-black">More than 2 Millions happy<br />Customers and counting</h2>
                <p class="mb-5">You may now concentrate on the functionality and other <br class="d-none d-sm-block" />aspects of your web products thanks to Phoenix's strength<br class="d-none d-sm-block" />before leaving the UI design to us. It is simple to complete<br class="d-none d-sm-block" />the work after checking and double-checking.</p>
              </div>
              <div class="col-lg-6 z-index-2">
                <div class="carousel slide" id="carouselExampleIndicators" data-bs-ride="carousel">
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <div class="row g-1 g-lg-0 g-xl-1 pb-lg-3 pb-xl-0 ps-lg-1 ps-xl-0">
                        <div class="col-lg-6 col-xl-5 text-center">
                          <div class="testimonial-avatar-container d-inline-block position-relative">
                            <div class="bg-holder" style="background-image:url({{asset('assets/img/bg/bg-2.png')}});background-size:contain;">
                            </div>
                            <!--/.bg-holder-->
                            <img class="rounded-3 mb-lg-0 opacity-100 position-relative" src="{{asset('assets/img/team/61.webp')}}" width="153" height="153" alt="" />
                          </div>
                        </div>
                        <div class="col-lg-6 col-xl-7 text-center text-lg-start">
                          <div class="mb-4 light"><span class="fa fa-star text-primary"></span><span class="fa fa-star text-primary"></span><span class="fa fa-star text-primary"></span><span class="fa fa-star text-primary"></span><span class="fa fa-star text-primary"></span>
                          </div>
                          <h3 class="fs-1 fs-xl-2 mb-5 lh-sm me-md-7 me-lg-0">Brilliant app! Will definitely going to be my first choice starting from today</h3>
                          <h6>Monica Gomez</h6>
                          <h6 class="fw-normal">UX designer, Google</h6>
                        </div>
                      </div>
                    </div>
                    <div class="carousel-item">
                      <div class="row g-1 g-lg-0 g-xl-1 pb-lg-3 pb-xl-0 ps-lg-1 ps-xl-0">
                        <div class="col-lg-6 col-xl-5 text-center">
                          <div class="testimonial-avatar-container d-inline-block position-relative">
                            <div class="bg-holder" style="background-image:url({{asset('assets/img/bg/bg-2.png')}});background-size:contain;">
                            </div>
                            <!--/.bg-holder-->
                            <img class="rounded-3 mb-lg-0 opacity-100 position-relative" src="{{asset('assets/img/team/8.webp')}}" width="154" alt="" />
                          </div>
                        </div>
                        <div class="col-lg-6 col-xl-7 text-center text-lg-start">
                          <div class="mb-4 light"><span class="fa fa-star text-primary"></span><span class="fa fa-star text-primary"></span><span class="fa fa-star text-primary"></span><span class="fa fa-star text-primary"></span><span class="fa fa-star text-primary"></span>
                          </div>
                          <h3 class="fs-1 fs-xl-2 mb-5 lh-sm me-md-7 me-lg-0">“Excellent to work with and comfortable to customize. This is what I was looking for till the date!”</h3>
                          <h6>Marc Chiasson</h6>
                          <h6 class="fw-normal">UX designer, Adobe</h6>
                        </div>
                      </div>
                    </div>
                    <div class="carousel-item">
                      <div class="row g-1 g-lg-0 g-xl-1 pb-lg-3 pb-xl-0 ps-lg-1 ps-xl-0">
                        <div class="col-lg-6 col-xl-5 text-center">
                          <div class="testimonial-avatar-container d-inline-block position-relative">
                            <div class="bg-holder" style="background-image:url({{asset('assets/img/bg/bg-2.png')}});background-size:contain;">
                            </div>
                            <!--/.bg-holder-->
                            <img class="rounded-3 mb-lg-0 opacity-100 position-relative" src="{{asset('assets/img/team/35.webp')}}" width="154" alt="" />
                          </div>
                        </div>
                        <div class="col-lg-6 col-xl-7 text-center text-lg-start">
                          <div class="mb-4 light"><span class="fa fa-star text-primary"></span><span class="fa fa-star text-primary"></span><span class="fa fa-star text-primary"></span><span class="fa fa-star text-primary"></span><span class="fa fa-star text-primary"></span>
                          </div>
                          <h3 class="fs-1 fs-xl-2 mb-5 lh-sm me-md-7 me-lg-0">“Phoenix is all you can ask for. This is perfect fit for everything you might want to work on!”</h3>
                          <h6>Axel Barry</h6>
                          <h6 class="fw-normal">UX designer, Apple</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <div class="position-relative">
        <div class="bg-holder world-map-bg" style="background-image:url({{asset('assets/img/bg/bg-13.png')}});">
        </div>
        <!--/.bg-holder-->

        <div class="bg-holder z-index-2 opacity-25" style="background-image:url({{asset('assets/img/bg/bg-right-21.png')}});background-size:auto;background-position:right;">
        </div>
        <!--/.bg-holder-->

        <div class="bg-holder z-index-2 mt-9 opacity-25" style="background-image:url({{asset('assets/img/bg/bg-left-21.png')}});background-size:auto;background-position:left;">
        </div>
        <!--/.bg-holder-->

        <svg class="w-100 text-white position-relative" preserveAspectRatio="none" viewBox="0 0 1920 368" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1920 0.44L0 367.74V0H1920V0.44Z" fill="currentColor"></path>
        </svg>
        <section class="overflow-hidden z-index-2">
          <div class="container-small light px-lg-7 px-xxl-3">
            <div class="position-relative">
              <div class="row mb-6">
                <div class="col-xl-6 text-center text-md-start">
                  <h2 class="text-white mb-2">Being used by millions of users</h2>
                  <h1 class="fs-md-5 fs-xl-6 fw-black text-gradient-info text-uppercase mb-4 mb-md-0">WORLDWIDE</h1>
                </div>
                <div class="col-xl-6 text-center text-md-start">
                  <p class="text-white">You can get all the reports, data analysis, and growth maps you need with the help of Phoenix's power, and you may review and modify them whenever you want. These features make this dashboard outstanding.</p>
                </div>
              </div>
              <div class="row">
                <div class="col-xl-8 text-center text-md-start mb-6 mb-xl-0">
                  <div class="d-md-flex justify-content-md-between">
                    <div class="mb-6 mb-md-0 me-4">
                      <h1 class="display-1 text-white fw-bolder" data-countup='{"endValue":125,"duration":10,"suffix":"+"}'>0 <span>+</span></h1>
                      <p class="text-white">Every month, there are more<br class="d-md-none d-lg-block" />than 125+ sales.</p>
                    </div>
                    <div class="mb-6 mb-md-0 me-4">
                      <h1 class="display-1 text-white fw-bolder" data-countup='{"endValue":308,"duration":10,"suffix":"k"}'>0</h1>
                      <p class="text-white">We have 308+ active paid.<br class="d-md-none d-lg-block" />subscribers.</p>
                    </div>
                    <div class="mb-6 mb-md-0 me-4">
                      <h1 class="display-1 text-white fw-bolder" data-countup='{"endValue":12,"duration":0.5}'>0</h1>
                      <p class="text-white">We have won 12 awards so<br class="d-md-none d-lg-block" />far with great success. </p>
                    </div>
                  </div>
                </div>
                <div class="col-xl-4 text-center text-md-start"><img class="img-fluid" src="{{asset('assets/img/generic/capterra.png')}}" alt="" /></div>
              </div>
            </div>
          </div>
        </section>
        <svg class="text-white w-100 position-relative" viewBox="0 0 1920 368" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M0 368L1920 0.730011L1920 368L0 368Z" fill="currentColor"></path>
        </svg>
      </div>
      <section class="bg-white pb-lg-6 pb-xl-8">
        <div class="bg-holder d-dark-none" style="background-image:url({{asset('assets/img/bg/bg-5.png')}});background-size:auto;">
        </div>
        <!--/.bg-holder-->

        <div class="bg-holder d-light-none" style="background-image:url({{asset('assets/img/bg/bg-dark-5.png')}});background-size:auto;">
        </div>
        <!--/.bg-holder-->

        <div class="bg-holder" style="background-image:url({{asset('assets/img/bg/bg-left-5.png')}});background-position:left;background-size:auto;">
        </div>
        <!--/.bg-holder-->

        <div class="bg-holder" style="background-image:url({{asset('assets/img/bg/bg-right-6.png')}});background-position:right;background-size:auto;">
        </div>
        <!--/.bg-holder-->

        <div class="container-small position-relative px-lg-7 px-xxl-3">
          <div class="row mb-8 text-center text-sm-start">
            <div class="col-12 mb-4">
              <h4 class="text-primary fw-bolder mb-3">Gallery</h4>
              <h2>Some of Our Best Works</h2>
            </div>
            <div class="col-lg-6">
              <p>Rise like Phoenix focusing only on functionalities for your digital products leaving the design for us. Show what you do, with our latest admin dashboard. Check our best works and let us know what you want to find.</p>
            </div>
            <div class="col-lg-6">
              <p>Want to tell your customers about the details of how and what? Tell them with all the posts at one place without them ridirecting to another page or site.</p>
            </div>
          </div>
          <ul class="nav font-sans-serif mb-6 justify-content-center justify-content-sm-start w-max-content" data-filter-nav="data-filter-nav">
            <li class="nav-item"><a class="isotope-nav cursor-pointer active" data-filter="*">First</a></li>
            <li class="nav-item"><a class="isotope-nav cursor-pointer" data-filter=".second">Second</a></li>
            <li class="nav-item"><a class="isotope-nav cursor-pointer" data-filter=".third">Third</a></li>
            <li class="nav-item"> <a class="isotope-nav cursor-pointer" data-filter=".fourth">Fourth</a></li>
          </ul>
          <div class="row g-3" id="image_gallery" style="min-height: 948px" data-sl-isotope='{"layoutMode":"packery"}'>
            <div class="col-6 col-md-4 col-lg-3 px-2 isotope-item fourth"><a href="#!" data-bigpicture='{"gallery":"#image_gallery"}' data-bp="{{asset('assets/img/gallery/1.png')}}"><img class="rounded img-fluid w-100" src="{{asset('assets/img/gallery/1.png')}}" alt="" /></a>
            </div>
            <div class="col-6 col-md-4 col-lg-3 px-2 isotope-item third"><a href="#!" data-bigpicture='{"gallery":"#image_gallery"}' data-bp="{{asset('assets/img/gallery/2.png')}}"><img class="rounded img-fluid w-100" src="{{asset('assets/img/gallery/2.png')}}" alt="" /></a>
            </div>
            <div class="col-6 col-md-4 col-lg-3 px-2 isotope-item second"><a href="#!" data-bigpicture='{"gallery":"#image_gallery"}' data-bp="{{asset('assets/img/gallery/3.png')}}"><img class="rounded img-fluid w-100" src="{{asset('assets/img/gallery/3.png')}}" alt="" /></a>
            </div>
            <div class="col-6 col-md-4 col-lg-3 px-2 isotope-item third"><a href="#!" data-bigpicture='{"gallery":"#image_gallery"}' data-bp="{{asset('assets/img/gallery/5.png')}}"><img class="rounded img-fluid w-100" src="{{asset('assets/img/gallery/5.png')}}" alt="" /></a>
            </div>
            <div class="col-6 col-md-4 col-lg-3 px-2 isotope-item third second"><a href="#!" data-bigpicture='{"gallery":"#image_gallery"}' data-bp="{{asset('assets/img/gallery/4.png')}}"><img class="rounded img-fluid w-100" src="{{asset('assets/img/gallery/4.png')}}" alt="" /></a>
            </div>
            <div class="col-6 col-md-4 col-lg-3 px-2 isotope-item second"><a href="#!" data-bigpicture='{"gallery":"#image_gallery"}' data-bp="{{asset('assets/img/gallery/6.png')}}"><img class="rounded img-fluid w-100" src="{{asset('assets/img/gallery/6.png')}}" alt="" /></a>
            </div>
            <div class="col-6 col-md-4 col-lg-3 px-2 isotope-item second"><a href="#!" data-bigpicture='{"gallery":"#image_gallery"}' data-bp="{{asset('assets/img/gallery/7.png')}}"><img class="rounded img-fluid w-100" src="{{asset('assets/img/gallery/7.png')}}" alt="" /></a>
            </div>
            <div class="col-6 col-md-4 col-lg-6 px-2 isotope-item second"><a href="#!" data-bigpicture='{"gallery":"#image_gallery"}' data-bp="{{asset('assets/img/gallery/9.png')}}"><img class="rounded img-fluid w-100" src="{{asset('assets/img/gallery/9.png')}}" alt="" /></a>
            </div>
            <div class="col-6 col-md-4 col-lg-3 px-2 isotope-item fourth"><a href="#!" data-bigpicture='{"gallery":"#image_gallery"}' data-bp="{{asset('assets/img/gallery/8.png')}}"><img class="rounded img-fluid w-100" src="{{asset('assets/img/gallery/8.png')}}" alt="" /></a>
            </div>
            <div class="col-6 col-md-4 col-lg-6 px-2 isotope-item second"><a href="#!" data-bigpicture='{"gallery":"#image_gallery"}' data-bp="{{asset('assets/img/gallery/10.png')}}"><img class="rounded img-fluid w-100" src="{{asset('assets/img/gallery/10.png')}}" alt="" /></a>
            </div>
          </div>
        </div>
      </section>
      <section class="bg-white pt-lg-0 pt-xl-8">
        <div class="bg-holder d-none d-md-block" style="background-image:url({{asset('assets/img/bg/bg-left-15.png')}});background-position:left;background-size:auto;">
        </div>
        <!--/.bg-holder-->

        <div class="bg-holder d-none d-md-block" style="background-image:url({{asset('assets/img/bg/bg-right-15.png')}});background-position:right;background-size:auto;">
        </div>
        <!--/.bg-holder-->

        <div class="container-small position-relative px-lg-7 px-xxl-3">
          <div class="row">
            <div class="col-12 mb-4 text-center text-sm-start">
              <h4 class="text-primary fw-bolder mb-3">Pricing</h4>
              <h2>Choose the best deal for you</h2>
            </div>
            <div class="col-md-6 text-center text-sm-start">
              <p>Entice your customers with Phoenix admin dashboard. Show your best deal in this section to help customers choose from your best offers and place them all in one place with this efficient template. If you are availing more than one </p>
            </div>
            <div class="col-md-6 text-center text-sm-start">
              <p>offer to your customers, let them compare among them and search for what they need to get. Show offer details here and entice them to buy.</p>
            </div>
          </div>
          <div class="row pt-9 g-3 g-xl-0">
            <div class="col-md-6 col-xl-3">
              <div class="card h-100 rounded-xl-end-0 rounded-start">
                <div class="card-body px-6">
                  <div class="px-5">
                    <div class="text-center pt-5"><img src="{{asset('assets/img/icons/illustrations/pie.png')}}" width="48" height="48" alt="" />
                      <h3 class="fw-semi-bold my-4">Starter</h3>
                    </div>
                    <div class="text-center">
                      <h1 class="fw-semi-bold text-primary">$<span class="fw-bolder">6</span><span class="text-black fs-1 ms-1 fw-bolder">USD</span></h1>
                      <h5 class="mb-4 text-900"></h5>
                      <button class="btn btn-lg mb-6 w-100 btn-outline-primary">Buy</button>
                    </div>
                  </div>
                  <ul class="fa-ul pricing-list">
                    <li class="mb-4 d-flex align-items-center"><span class="fa-li"><span class="fas fa-check text-primary"></span></span><span class="text-800" style="--phoenix-text-opacity:1;">Timeline</span>
                    </li>
                    <li class="mb-4 d-flex align-items-center"><span class="fa-li"><span class="fas fa-check text-primary"></span></span><span class="text-800" style="--phoenix-text-opacity:1;">Advanced Search</span>
                    </li>
                    <li class="mb-4 d-flex align-items-center"><span class="text-800" style="--phoenix-text-opacity:.5;">Custom fields</span><span class="badge badge-phoenix badge-phoenix-warning ms-2 fs--2 opacity-50">New</span>
                    </li>
                    <li class="mb-4 d-flex align-items-center"><span class="text-800" style="--phoenix-text-opacity:.5;">Task dependencies</span>
                    </li>
                    <li class="mb-4 d-flex align-items-center"><span class="text-800" style="--phoenix-text-opacity:.5;">Private teams &amp; projects</span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-3">
              <div class="card h-100  rounded-top-0 rounded-xl-0 border border-2 border-primary dark__border-primary mt-5 mt-md-0">
                <div class="position-absolute d-flex flex-center bg-primary-100 rounded-top py-1 end-0 start-0 badge-pricing">
                  <p class="text-primary-600 mb-0 dark__text-primary-200">Most popular</p>
                </div>
                <div class="card-body px-6">
                  <div class="px-5">
                    <div class="text-center pt-5"><img src="{{asset('assets/img/icons/illustrations/bolt.png')}}" width="48" height="48" alt="" />
                      <h3 class="fw-semi-bold my-4">Team</h3>
                    </div>
                    <div class="text-center">
                      <h1 class="fw-semi-bold text-primary">$<span class="fw-bolder">12</span><span class="text-black fs-1 ms-1 fw-bolder">USD</span></h1>
                      <h5 class="mb-4 text-900"></h5>
                      <button class="btn btn-lg mb-6 w-100 btn-primary">Buy</button>
                    </div>
                  </div>
                  <ul class="fa-ul pricing-list">
                    <li class="mb-4 d-flex align-items-center"><span class="fa-li"><span class="fas fa-check text-primary"></span></span><span class="text-800" style="--phoenix-text-opacity:1;">Timeline</span>
                    </li>
                    <li class="mb-4 d-flex align-items-center"><span class="fa-li"><span class="fas fa-check text-primary"></span></span><span class="text-800" style="--phoenix-text-opacity:1;">Advanced Search</span>
                    </li>
                    <li class="mb-4 d-flex align-items-center"><span class="fa-li"><span class="fas fa-check text-primary"></span></span><span class="text-800" style="--phoenix-text-opacity:1;">Custom fields</span><span class="badge badge-phoenix badge-phoenix-warning ms-2 fs--2">New</span>
                    </li>
                    <li class="mb-4 d-flex align-items-center"><span class="text-800" style="--phoenix-text-opacity:.5;">Task dependencies</span>
                    </li>
                    <li class="mb-4 d-flex align-items-center"><span class="text-800" style="--phoenix-text-opacity:.5;">Private teams &amp; projects</span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-3">
              <div class="card h-100 rounded-start rounded-xl-start-0 mt-5 mt-md-0">
                <div class="card-body px-6">
                  <div class="px-5">
                    <div class="text-center pt-5"><img src="{{asset('assets/img/icons/illustrations/edit.png')}}" width="48" height="48" alt="" />
                      <h3 class="fw-semi-bold my-4">Business</h3>
                    </div>
                    <div class="text-center">
                      <h1 class="fw-semi-bold text-primary">$<span class="fw-bolder">23</span><span class="text-black fs-1 ms-1 fw-bolder">USD</span></h1>
                      <h5 class="mb-4 text-900"></h5>
                      <button class="btn btn-lg mb-6 w-100 btn-outline-primary">Buy</button>
                    </div>
                  </div>
                  <ul class="fa-ul pricing-list">
                    <li class="mb-4 d-flex align-items-center"><span class="fa-li"><span class="fas fa-check text-primary"></span></span><span class="text-800" style="--phoenix-text-opacity:1;">Timeline</span>
                    </li>
                    <li class="mb-4 d-flex align-items-center"><span class="fa-li"><span class="fas fa-check text-primary"></span></span><span class="text-800" style="--phoenix-text-opacity:1;">Advanced Search</span>
                    </li>
                    <li class="mb-4 d-flex align-items-center"><span class="fa-li"><span class="fas fa-check text-primary"></span></span><span class="text-800" style="--phoenix-text-opacity:1;">Custom fields</span><span class="badge badge-phoenix badge-phoenix-warning ms-2 fs--2">New</span>
                    </li>
                    <li class="mb-4 d-flex align-items-center"><span class="fa-li"><span class="fas fa-star text-primary"></span></span><span class="text-800" style="--phoenix-text-opacity:1;">Task dependencies</span>
                    </li>
                    <li class="mb-4 d-flex align-items-center"><span class="text-800" style="--phoenix-text-opacity:.5;">Private teams &amp; projects</span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3 ps-xl-3">
              <div class="row g-0 h-100 justify-content-center">
                <div class="col-xl-12">
                  <div class="card h-100 mt-5 mt-md-0">
                    <div class="card-body">
                      <div class="px-5">
                        <div class="text-center pt-5"><img src="{{asset('assets/img/icons/illustrations/shield.png')}}" width="48" height="48" alt="" />
                          <h3 class="fw-semi-bold my-4">Enterprise</h3>
                        </div>
                        <div class="text-center">
                          <h1 class="fw-semi-bold text-primary">$<span class="fw-bolder">40</span><span class="text-black fs-1 ms-1 fw-bolder">USD</span></h1>
                          <h5 class="mb-4 text-900"></h5>
                          <button class="btn btn-lg mb-6 w-100 btn-outline-primary">Buy</button>
                        </div>
                      </div>
                      <ul class="fa-ul pricing-list">
                        <li class="mb-4 d-flex align-items-center"><span class="fa-li"><span class="fas fa-check text-primary"></span></span><span class="text-800" style="--phoenix-text-opacity:1;">Timeline</span>
                        </li>
                        <li class="mb-4 d-flex align-items-center"><span class="fa-li"><span class="fas fa-check text-primary"></span></span><span class="text-800" style="--phoenix-text-opacity:1;">Advanced Search</span>
                        </li>
                        <li class="mb-4 d-flex align-items-center"><span class="fa-li"><span class="fas fa-check text-primary"></span></span><span class="text-800" style="--phoenix-text-opacity:1;">Custom fields</span><span class="badge badge-phoenix badge-phoenix-warning ms-2 fs--2">New</span>
                        </li>
                        <li class="mb-4 d-flex align-items-center"><span class="fa-li"><span class="fas fa-star text-primary"></span></span><span class="text-800" style="--phoenix-text-opacity:1;">Task dependencies</span>
                        </li>
                        <li class="mb-4 d-flex align-items-center"><span class="fa-li"><span class="fas fa-star text-primary"></span></span><span class="text-800" style="--phoenix-text-opacity:1;">Private teams &amp; projects</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 text-center mt-8">
              <p>For Enterprise Solution with Managed SMTP, Custom API setup, Dedicated Support, and more - <a href="#!"> Contact us</a></p>
            </div>
          </div>
        </div>
      </section>


      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="bg-white" id="blog">

        <div class="container-small px-lg-7 px-xxl-3">
          <div class="row">
            <div class="col-12 mb-4 text-center text-sm-start">
              <h4 class="text-primary fw-bolder mb-3">Blog</h4>
              <h2>Latest articles</h2>
            </div>
            <div class="col-lg-6 text-center text-sm-start">
              <p>See the latest articles we published with this dashboard. Your customers will be happy to find all the latest posts in one place. This menu efficiently shows all related topics from search filters and provides the customers with what</p>
            </div>
            <div class="col-lg-6 text-center text-sm-start">
              <p>they need. Also you can just educate your customers about everything they need to know and follow to avail a service with you. This menu is the one to show them that.</p>
            </div>
          </div>
          <div class="row h-100 g-3 justify-content-center">
            <div class="col-sm-6 col-lg-3 mb-3 mb-md-0">
              <div class="card text-white h-100"><img class="rounded-top h-100 fit-cover" src="{{asset('assets/img/blog/blog-1.png')}}" alt="..." />
                <div class="card-body rounded-top">
                  <div class="d-flex align-items-cente mb-3">
                    <div class="d-flex align-items-center me-3"><a class="btn-link text-decoration-none d-flex align-items-center" href="#!"><span class="fa-solid fa-eye text-500 me-1"></span><span class="text-900 fs--2 lh-1">2563</span></a></div>
                    <div class="d-flex align-items-center me-3"><a class="btn-link text-decoration-none d-flex align-items-center" href="#!"><span class="fa-solid fa-heart text-500 me-1"></span><span class="text-900 fs--2 lh-1">125</span></a></div>
                    <div class="d-flex align-items-center"><a class="btn-link text-decoration-none d-flex align-items-center" href="#!"><span class="fa-solid fa-comment text-500 me-1"></span><span class="text-900 fs--2 lh-1">125</span></a></div>
                  </div><span class="badge badge-phoenix badge-phoenix-primary mb-2">SEO</span>
                  <h4 class="fw-bold mb-3 lh-sm line-clamp-2">Top 10 ways to Ace SEO for your business</h4><a class="btn-link px-0 d-flex align-items-center fs--1 fw-bold" href="#!" role="button">Read more<span class="fa-solid fa-angle-right ms-2"></span></a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-3 mb-md-0">
              <div class="card text-white h-100"><img class="rounded-top h-100 fit-cover" src="{{asset('assets/img/blog/blog-2.png')}}" alt="..." />
                <div class="card-body rounded-top">
                  <div class="d-flex align-items-cente mb-3">
                    <div class="d-flex align-items-center me-3"><a class="btn-link text-decoration-none d-flex align-items-center" href="#!"><span class="fa-solid fa-eye text-500 me-1"></span><span class="text-900 fs--2 lh-1">1256</span></a></div>
                    <div class="d-flex align-items-center me-3"><a class="btn-link text-decoration-none d-flex align-items-center" href="#!"><span class="fa-solid fa-heart text-500 me-1"></span><span class="text-900 fs--2 lh-1">325</span></a></div>
                    <div class="d-flex align-items-center"><a class="btn-link text-decoration-none d-flex align-items-center" href="#!"><span class="fa-solid fa-comment text-500 me-1"></span><span class="text-900 fs--2 lh-1">32</span></a></div>
                  </div><span class="badge badge-phoenix badge-phoenix-primary mb-2">Marketing</span>
                  <h4 class="fw-bold mb-3 lh-sm line-clamp-2">Top 12 Marketing strategies you can take</h4><a class="btn-link px-0 d-flex align-items-center fs--1 fw-bold" href="#!" role="button">Read more<span class="fa-solid fa-angle-right ms-2"></span></a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-3 mb-md-0">
              <div class="card text-white h-100"><img class="rounded-top h-100 fit-cover" src="{{asset('assets/img/blog/blog-3.png')}}" alt="..." />
                <div class="card-body rounded-top">
                  <div class="d-flex align-items-cente mb-3">
                    <div class="d-flex align-items-center me-3"><a class="btn-link text-decoration-none d-flex align-items-center" href="#!"><span class="fa-solid fa-eye text-500 me-1"></span><span class="text-900 fs--2 lh-1">142</span></a></div>
                    <div class="d-flex align-items-center me-3"><a class="btn-link text-decoration-none d-flex align-items-center" href="#!"><span class="fa-solid fa-heart text-500 me-1"></span><span class="text-900 fs--2 lh-1">123</span></a></div>
                    <div class="d-flex align-items-center"><a class="btn-link text-decoration-none d-flex align-items-center" href="#!"><span class="fa-solid fa-comment text-500 me-1"></span><span class="text-900 fs--2 lh-1">22</span></a></div>
                  </div><span class="badge badge-phoenix badge-phoenix-primary mb-2">Marketing</span>
                  <h4 class="fw-bold mb-3 lh-sm line-clamp-2">The top 7 methods to improve as a marketer</h4><a class="btn-link px-0 d-flex align-items-center fs--1 fw-bold" href="#!" role="button">Read more<span class="fa-solid fa-angle-right ms-2"></span></a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-3 mb-md-0">
              <div class="card text-white h-100"><img class="rounded-top h-100 fit-cover" src="{{asset('assets/img/blog/blog-4.png')}}" alt="..." />
                <div class="card-body rounded-top">
                  <div class="d-flex align-items-cente mb-3">
                    <div class="d-flex align-items-center me-3"><a class="btn-link text-decoration-none d-flex align-items-center" href="#!"><span class="fa-solid fa-eye text-500 me-1"></span><span class="text-900 fs--2 lh-1">2563</span></a></div>
                    <div class="d-flex align-items-center me-3"><a class="btn-link text-decoration-none d-flex align-items-center" href="#!"><span class="fa-solid fa-heart text-500 me-1"></span><span class="text-900 fs--2 lh-1">325</span></a></div>
                    <div class="d-flex align-items-center"><a class="btn-link text-decoration-none d-flex align-items-center" href="#!"><span class="fa-solid fa-comment text-500 me-1"></span><span class="text-900 fs--2 lh-1">112</span></a></div>
                  </div><span class="badge badge-phoenix badge-phoenix-primary mb-2">Tech</span>
                  <h4 class="fw-bold mb-3 lh-sm line-clamp-2">Best places for a tech job in U.S</h4><a class="btn-link px-0 d-flex align-items-center fs--1 fw-bold" href="#!" role="button">Read more<span class="fa-solid fa-angle-right ms-2"></span></a>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center mt-6"><a class="btn btn-outline-primary" href="#!">View All<span class="fa-solid fa-angle-right ms-2"></span></a></div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->




      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="bg-white">

        <div class="container-small px-lg-7 px-xxl-3">
          <div class="row mb-3 text-center text-sm-start">
            <div class="col-12 mb-4">
              <h4 class="text-primary fw-bolder mb-3">Address</h4>
              <h2>If you need to find us:</h2>
            </div>
            <div class="col-md-6">
              <p>Do not lose your potential customers to others. Tell them exactly where you are with Geolocation enabled Phoenix admin dashboard, No need to take the burden of communicating directly.</p>
            </div>
            <div class="col-md-6">
              <p>You can easily tell your customers where to find you with precise location map. Getting closer was never easier!</p>
            </div>
          </div>
          <div class="row">
            <div class="col-12 mb-15">
              <div class="googlemap" data-googlemap="data-googlemap" data-gmap="data-gmap" data-latlng="40.7228022,-74.0020158" data-scrollwheel="false" data-zoom="15" style="height: 381px; border-radius:1.5rem;">
                <div class="marker-content py-3">
                  <h5>Google map</h5>
                  <p>A nice template for your site.<br />Customize it as you want.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="row g-5 g-lg-5">
            <div class="col-md-6 mb-5 mb-md-0 text-center text-md-start">
              <h3 class="mb-3">Stay connected</h3>
              <p class="mb-5">Stay connected with Phoenix's Help Center; Phoenix is available for your necessities at all times.</p>
              <div class="d-flex flex-column align-items-center align-items-md-start gap-3 gap-md-0">
                <div class="d-md-flex align-items-center">
                  <div class="icon-wrapper shadow-info"><span class="uil uil-phone text-primary light fs-4 z-index-1 ms-2"></span></div>
                  <div class="flex-1 ms-3"><a class="link-900" href="tel:+871406-7509">(871) 406-7509</a></div>
                </div>
                <div class="d-md-flex align-items-center">
                  <div class="icon-wrapper shadow-info"><span class="uil uil-envelope text-primary light fs-4 z-index-1 ms-2"></span></div>
                  <div class="flex-1 ms-3"><a class="fw-semi-bold text-900" href="mailto:phoenix@email.com">phoenix@email.com</a></div>
                </div>
                <div class="mb-6 d-md-flex align-items-center">
                  <div class="icon-wrapper shadow-info"><span class="uil uil-map-marker text-primary light fs-4 z-index-1 ms-2"></span></div>
                  <div class="flex-1 ms-3"><a class="fw-semi-bold text-900" href="#!">39163 Amir Drive Suite 802</a></div>
                </div>
                <div class="d-flex"><a href="#!"><span class="fa-brands fa-facebook fs-2 text-primary me-3"></span></a><a href="#!"><span class="fa-brands fa-twitter fs-2 text-primary me-3"></span></a><a href="#!"><span class="fa-brands fa-linkedin-in fs-2 text-primary"></span></a></div>
              </div>
            </div>
            <div class="col-md-6 text-center text-md-start">
              <h3 class="mb-3">Drop us a line</h3>
              <p class="mb-7">If you have any query or suggestion , we are open to learn from you, Lets talk, reach us anytime.</p>
              <form class="row g-4">
                <div class="col-12">
                  <input class="form-control bg-white" type="text" name="name" placeholder="Name" required="required" />
                </div>
                <div class="col-12">
                  <input class="form-control bg-white" type="email" name="email" placeholder="Email" required="required" />
                </div>
                <div class="col-12">
                  <textarea class="form-control bg-white" rows="6" name="message" placeholder="Message" required="required"></textarea>
                </div>
                <div class="col-12 d-grid">
                  <button class="btn btn-outline-primary" type="submit">Submit</button>
                </div>
                <div class="feedback"></div>
              </form>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->


      <section id="team">
        <div class="bg-holder z-index-2" style="background-image:url({{asset('assets/img/bg/bg-left-17.png')}});background-size:auto;background-position:left center;">
        </div>
        <!--/.bg-holder-->

        <div class="bg-holder z-index-2" style="background-image:url({{asset('assets/img/bg/bg-right-17.png')}});background-size:auto;background-position:right center;">
        </div>
        <!--/.bg-holder-->

        <div class="position-absolute top-0 end-0 start-0">
          <svg class="w-100 text-white" preserveAspectRatio="none" viewBox="0 0 1920 368" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1920 0.44L0 367.74V0H1920V0.44Z" fill="currentColor"></path>
          </svg>
        </div>
        <div class="position-absolute bottom-0 end-0 start-0">
          <svg class="text-white w-100" viewBox="0 0 1920 368" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 368L1920 0.730011L1920 368L0 368Z" fill="currentColor"></path>
          </svg>
        </div>
        <div class="container-small position-relative py-1 px-lg-7 px-xxl-3" style="z-index:10">
          <div class="row">
            <div class="col-12 mb-4 text-center text-sm-start">
              <h4 class="text-primary fw-bolder mb-3">Team</h4>
              <h2>Our small team behind our success</h2>
            </div>
            <div class="col-md-6 text-center text-sm-start">
              <p>We have a small but strong development team to follow up on the development process. Reach out to us for further information.</p>
            </div>
            <div class="col-md-6 text-center text-sm-start">
              <p>The team is ready to answer all your questions within minutes. The efficient team is always at your beck and call.</p>
            </div>
          </div>
          <div class="row align-items-center ps-lg-11 pe-lg-9">
            <div class="col-sm-6 col-md-4 col-lg-3">
              <div class="text-center mt-5 position-relative">
                <div class="team-avatar-container d-inline-block position-relative">
                  <div class="bg-holder" style="background-image:url({{asset('assets/img/bg/bg-21.png')}});background-size:contain;">
                  </div>
                  <!--/.bg-holder-->
                  <img class="img-fluid rounded mb-3 position-relative" src="{{asset('assets/img/team/62.webp')}}" alt="..." />
                </div>
                <h4>John Smith</h4>
                <h6 class="mb-3 fw-semi-bold">CEO, Global Cheat</h6><a href="#!"><span class="fa-brands fa-facebook text-primary me-3"></span></a><a href="#!"><span class="fa-brands fa-twitter text-primary me-3"></span></a><a href="#!"><span class="fa-brands fa-linkedin-in text-primary"></span></a>
              </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
              <div class="text-center mt-5 position-relative">
                <div class="team-avatar-container d-inline-block position-relative">
                  <div class="bg-holder" style="background-image:url({{asset('assets/img/bg/bg-21.png')}});background-size:contain;">
                  </div>
                  <!--/.bg-holder-->
                  <img class="img-fluid rounded mb-3 position-relative" src="{{asset('assets/img/team/63.webp')}}" alt="..." />
                </div>
                <h4>Marc Chiasson</h4>
                <h6 class="mb-3 fw-semi-bold">Vice President</h6><a href="#!"><span class="fa-brands fa-facebook text-primary me-3"></span></a><a href="#!"><span class="fa-brands fa-twitter text-primary me-3"></span></a><a href="#!"><span class="fa-brands fa-linkedin-in text-primary"></span></a>
              </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
              <div class="text-center mt-5 position-relative">
                <div class="team-avatar-container d-inline-block position-relative">
                  <div class="bg-holder" style="background-image:url({{asset('assets/img/bg/bg-21.png')}});background-size:contain;">
                  </div>
                  <!--/.bg-holder-->
                  <img class="img-fluid rounded mb-3 position-relative" src="{{asset('assets/img/team/64.webp')}}" alt="..." />
                </div>
                <h4>Lilah Lola</h4>
                <h6 class="mb-3 fw-semi-bold">Marketing Manager</h6><a href="#!"><span class="fa-brands fa-facebook text-primary me-3"></span></a><a href="#!"><span class="fa-brands fa-twitter text-primary me-3"></span></a><a href="#!"><span class="fa-brands fa-linkedin-in text-primary"></span></a>
              </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
              <div class="text-center mt-5 position-relative">
                <div class="team-avatar-container d-inline-block position-relative">
                  <div class="bg-holder" style="background-image:url({{asset('assets/img/bg/bg-21.png')}});background-size:contain;">
                  </div>
                  <!--/.bg-holder-->
                  <img class="img-fluid rounded mb-3 position-relative" src="{{asset('assets/img/team/65.webp')}}" alt="..." />
                </div>
                <h4>Thomas Doe</h4>
                <h6 class="mb-3 fw-semi-bold">UX Designer</h6><a href="#!"><span class="fa-brands fa-facebook text-primary me-3"></span></a><a href="#!"><span class="fa-brands fa-twitter text-primary me-3"></span></a><a href="#!"><span class="fa-brands fa-linkedin-in text-primary"></span></a>
              </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
              <div class="text-center mt-5 position-relative">
                <div class="team-avatar-container d-inline-block position-relative">
                  <div class="bg-holder" style="background-image:url({{asset('assets/img/bg/bg-21.png')}});background-size:contain;">
                  </div>
                  <!--/.bg-holder-->
                  <img class="img-fluid rounded mb-3 position-relative" src="{{asset('assets/img/team/66.webp')}}" alt="..." />
                </div>
                <h4>Alan Casey</h4>
                <h6 class="mb-3 fw-semi-bold">Front End Developer</h6><a href="#!"><span class="fa-brands fa-facebook text-primary me-3"></span></a><a href="#!"><span class="fa-brands fa-twitter text-primary me-3"></span></a><a href="#!"><span class="fa-brands fa-linkedin-in text-primary"></span></a>
              </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
              <div class="text-center mt-5 position-relative">
                <div class="team-avatar-container d-inline-block position-relative">
                  <div class="bg-holder" style="background-image:url({{asset('assets/img/bg/bg-21.png')}});background-size:contain;">
                  </div>
                  <!--/.bg-holder-->
                  <img class="img-fluid rounded mb-3 position-relative" src="{{asset('assets/img/team/67.webp')}}" alt="..." />
                </div>
                <h4>Narokin Hijita</h4>
                <h6 class="mb-3 fw-semi-bold">CEO, Global Cheat</h6><a href="#!"><span class="fa-brands fa-facebook text-primary me-3"></span></a><a href="#!"><span class="fa-brands fa-twitter text-primary me-3"></span></a><a href="#!"><span class="fa-brands fa-linkedin-in text-primary"></span></a>
              </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
              <div class="text-center mt-5 position-relative">
                <div class="team-avatar-container d-inline-block position-relative">
                  <div class="bg-holder" style="background-image:url({{asset('assets/img/bg/bg-21.png')}});background-size:contain;">
                  </div>
                  <!--/.bg-holder-->
                  <img class="img-fluid rounded mb-3 position-relative" src="{{asset('assets/img/team/68.webp')}}" alt="..." />
                </div>
                <h4>Narokin Hijita</h4>
                <h6 class="mb-3 fw-semi-bold">CEO, Global Cheat</h6><a href="#!"><span class="fa-brands fa-facebook text-primary me-3"></span></a><a href="#!"><span class="fa-brands fa-twitter text-primary me-3"></span></a><a href="#!"><span class="fa-brands fa-linkedin-in text-primary"></span></a>
              </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
              <div class="text-center mt-5 position-relative">
                <div class="team-avatar-container d-inline-block position-relative">
                  <div class="bg-holder" style="background-image:url({{asset('assets/img/bg/bg-21.png')}});background-size:contain;">
                  </div>
                  <!--/.bg-holder-->
                  <img class="img-fluid rounded mb-3 position-relative" src="{{asset('assets/img/team/69.webp')}}" alt="..." />
                </div>
                <h4>Narokin Hijita</h4>
                <h6 class="mb-3 fw-semi-bold">CEO, Global Cheat</h6><a href="#!"><span class="fa-brands fa-facebook text-primary me-3"></span></a><a href="#!"><span class="fa-brands fa-twitter text-primary me-3"></span></a><a href="#!"><span class="fa-brands fa-linkedin-in text-primary"></span></a>
              </div>
            </div>
          </div>
        </div>
      </section>
<section class="bg-white pb-0">

        <div class="container-small px-lg-7 px-xxl-3">
          <div class="row justify-content-center">
            <div class="col-12 text-center">
              <div class="card py-md-9 px-md-13 border-0 z-index-1 shadow-lg cta-card">
                <div class="bg-holder" style="background-image:url({{asset('assets/img/bg/bg-18.png')}});background-position:right;background-size:auto;">
                </div>
                <!--/.bg-holder-->

                <div class="card-body position-relative"><img class="img-fluid mb-5 d-dark-none" src="{{asset('assets/img/spot-illustrations/27.png')}}" width="210" alt="..." /><img class="img-fluid mb-5 d-light-none" src="{{asset('assets/img/spot-illustrations/dark_27.png')}}" width="210" alt="..." />
                  <div class="d-flex align-items-center fw-bold justify-content-center mb-3">
                    <p class="mb-0">2008 Premium Icons </p><span class="text-primary fa-solid fa-circle" data-fa-transform="shrink-12"></span>
                    <p class="mb-0">Included FREE with it</p>
                  </div>
                  <h1 class="fs-2 fs-sm-4 fs-lg-6 fw-bolder lh-sm mb-3">Join<span class="gradient-text-primary mx-2">Phoenix</span><span>Today</span></h1>
                  <form class="d-flex justify-content-center mb-3 px-xxl-12">
                    <div class="d-grid d-sm-block"></div>
                    <input class="form-control me-3" id="ctaEmail1" type="email" placeholder="Email" aria-describedby="ctaEmail1" />
                    <button class="btn btn-primary" type="submit">Subscribe</button>
                  </form>
                  <p>Best support in the world, Only Phoenix can ensure </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->	  







@endsection