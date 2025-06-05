@extends('container.index')

@section('page')
    <!-- Page Header and Swiper-->
    <section class="section swiper-custom-container-3">
        <div class="swiper-container swiper-slider swiper-slider-7"
            data-swiper='{"autoplay":false,"simulateTouch":false,"loop":true,"navigation":{"nextEl":".swiper-button-next","prevEl":".swiper-button-prev"}}'>
            <div class="swiper-wrapper text-sm-left">
                <div class="swiper-slide" data-slide-bg="images/slide-1-1920x700.jpg">
                    <div class="swiper-slide-caption section-md">
                        <div class="swiper-box">
                            <h2 class="heading-1 swiper-title oh"><span class="d-block" data-caption-animate="slideInLeft"
                                    data-caption-delay="200">Find Safety in Your
                                    Home with a Home Security System</span></h2>
                            <p class="sub" data-caption-animate="slideInUp" data-caption-delay="200">Dester provides
                                top-notch security systems for homes and offices all over the US.</p><a
                                class="button button-white" data-caption-animate="fadeInUp" data-caption-delay="500"
                                href="project-page.html">Get a Quote<span class="icon mdi mdi-chevron-right"></span></a>
                        </div>
                        <div class="swiper-content-bg-1"></div>
                    </div>
                </div>
                <div class="swiper-slide" data-slide-bg="images/slide-2-1920x700.jpg">
                    <div class="swiper-slide-caption section-md">
                        <div class="swiper-box">
                            <h2 class="heading-1 swiper-title oh"><span class="d-block" data-caption-animate="slideInLeft"
                                    data-caption-delay="200">Make Your Home a
                                    Safe Place with Our Security Solutions</span></h2>
                            <p class="sub" data-caption-animate="slideInUp" data-caption-delay="200">Dester provides
                                top-notch security systems for homes and offices all over the US.</p><a
                                class="button button-white" data-caption-animate="fadeInUp" data-caption-delay="500"
                                href="project-page.html">Get a Quote<span class="icon mdi mdi-chevron-right"></span></a>
                        </div>
                        <div class="swiper-content-bg-1"></div>
                    </div>
                </div>
                <div class="swiper-slide" data-slide-bg="images/slide-3-1920x700.jpg">
                    <div class="swiper-slide-caption section-md">
                        <div class="swiper-box">
                            <h2 class="heading-1 swiper-title oh"><span class="d-block" data-caption-animate="slideInLeft"
                                    data-caption-delay="200">Dester Monitoring
                                    Plans and Packages</span></h2>
                            <p class="sub" data-caption-animate="slideInUp" data-caption-delay="200">Dester provides
                                top-notch security systems for homes and offices all over the US.</p><a
                                class="button button-white" data-caption-animate="fadeInUp" data-caption-delay="500"
                                href="project-page.html">Get a Quote<span class="icon mdi mdi-chevron-right"></span></a>
                        </div>
                        <div class="swiper-content-bg-1"></div>
                    </div>
                </div>
            </div>
            <!-- Swiper Navigation-->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
            <!-- Swiper Pagination-->
            <div class="swiper-pagination" data-bullet-custom="true"></div>
        </div>
    </section>

    <!-- Our Service-->
    <section class="section section-inset-6 bg-default">
        <div class="container">
            <h2 class="wow fadeInLeft">Our Services</h2>
            <p class="sub">We provide a wide range of services for our clients.</p>
            <div class="row row-xs no-md-gutters justify-content-center">
                <div class="col-sm-6 col-lg-4">
                    <div class="services-modern">
                        <article class="box-icon-modern wow fadeInDown"><span
                                class="box-icon-modern-icon icomoon-cameras icomoon"></span>
                            <h3 class="heading-4 box-icon-modern-title"><a href="single-service.html">Home Security
                                    Cameras</a></h3>
                            <p class="box-icon-modern-text">On the other hand, we denounce with righteous
                                indignation and dislike men who are so beguiled and demoralized by the charms of
                                pleasure of the moment, so blinded.</p><a class="box-icon-modern-link"
                                href="single-service.html">Read More<span class="icon mdi mdi-arrow-right"></span></a>
                        </article>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="services-modern">
                        <article class="box-icon-modern wow fadeInDown" data-wow-delay=".1s"><span
                                class="box-icon-modern-icon icomoon-home icomoon"></span>
                            <h3 class="heading-4 box-icon-modern-title"><a href="single-service.html">Home
                                    Automation</a></h3>
                            <p class="box-icon-modern-text">In a free hour, when our power of choice is untrammelled
                                and when nothing prevents our being able to do what we like best, every pleasure.
                                The wise man therefore always holds in these matters.</p><a class="box-icon-modern-link"
                                href="single-service.html">Read More<span class="icon mdi mdi-arrow-right"></span></a>
                        </article>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="services-modern">
                        <article class="box-icon-modern wow fadeInDown" data-wow-delay=".2s"><span
                                class="box-icon-modern-icon icomoon-group icomoon"></span>
                            <h3 class="heading-4 box-icon-modern-title"><a href="single-service.html">Fire and Life
                                    Safety</a></h3>
                            <p class="box-icon-modern-text">But in certain circumstances and owing to the claims of
                                duty or the obligations of business it will frequently occur that pleasures have to
                                be repudiated and annoyances accepted.</p><a class="box-icon-modern-link"
                                href="single-service.html">Read More<span class="icon mdi mdi-arrow-right"></span></a>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-image-4">
        <div class="container-fluid container-inset-0">
            <div class="row no-gutters">
                <div class="col-md-4 col-lg-5 col-xl-6 box-transform-wrap box-transform-1">
                    <div class="box-transform" style="background-image: url(images/bg-index-12.jpg);"></div>
                </div>
                <div class="col-md-8 col-lg-7 col-xl-6 bg-image-3">
                    <div class="tabs-custom tabs-custom-3" id="tabs-12">
                        <div class="tab-content tab-content-4 section-inset-7">
                            <div class="tab-pane fade show active" id="tabs-12-1">
                                <h2 class="oh-desktop"><span class="d-inline-block wow slideInLeft">A Few Words
                                        About Our Security Company</span></h2>
                                <p class="sub wow fadeInRight">For over 20 years, we have made the security of our
                                    customers our top priority. Today, over 5,000 professionals of Dester ensure
                                    your security.</p>
                                <div class="button-wrap oh-desktop"><a class="button button-primary wow slideInUp"
                                        href="about-us.html">Learn More<span class="icon mdi mdi-chevron-right"></span></a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-12-2">
                                <h2>What Goals We Pursue At Dester Security</h2>
                                <p class="sub">We aim to assist you in all your security requirements. Dester
                                    provides a comprehensive range of security services delivered by the best
                                    industry experts.</p>
                                <div class="button-wrap oh-desktop"><a class="button button-primary wow slideInUp"
                                        href="about-us.html">Learn More<span class="icon mdi mdi-chevron-right"></span></a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-12-3">
                                <h2>Mission & Vision of Dester Security Team</h2>
                                <p class="sub">Our team strives to achieve optimal customer satisfaction by being
                                    professional and efficient in delivering the best and friendliest service
                                    possible.</p>
                                <div class="button-wrap oh-desktop"><a class="button button-primary wow slideInUp"
                                        href="about-us.html">Learn More<span class="icon mdi mdi-chevron-right"></span></a>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-tabs-3">
                            <li class="nav-item-3" role="presentation"><a class="nav-link-3 active" href="#tabs-12-1"
                                    data-toggle="tab"><span>About Us</span></a></li>
                            <li class="nav-item-3" role="presentation"><a class="nav-link-3" href="#tabs-12-2"
                                    data-toggle="tab"><span>Our Goals</span></a></li>
                            <li class="nav-item-3" role="presentation"><a class="nav-link-3" href="#tabs-12-3"
                                    data-toggle="tab"><span>Mission & Vision</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest projects-->
    <section class="section section-xxl bg-default text-center">
        <div class="container">
            <div class="group-xl group-sm-justify">
                <h2 class="oh-desktop"><span class="d-inline-block wow slideInLeft">Why Choose Us</span></h2>
                <div class="dots-custom"></div>
            </div>
            <div class="owl-carousel owl-style-3" data-items="1" data-sm-items="2" data-lg-items="3" data-margin="30"
                data-autoplay="false" data-dots="true" data-animation-in="fadeIn" data-animation-out="fadeOut"
                data-pagination-class=".dots-custom">
                <!-- Services Creative-->
                <article class="services-creative"><span class="services-creative-icon icomoon icomoon-headphones"></span><a
                        class="services-creative-figure" href="single-service.html"><img
                            src="images/services-19-360x240.jpg" alt="" width="360" height="240" /></a>
                    <div class="services-creative-caption">
                        <h3 class="heading-4 services-creative-title"><a href="single-service.html">Always
                                Monitored</a></h3>
                        <p class="services-creative-text">Dester Security team guarantees full monitoring for you,
                            your family, your home &amp; office at any time to ensure your safety.</p>
                    </div>
                </article>
                <!-- Services Creative-->
                <article class="services-creative"><span class="services-creative-icon icomoon icomoon-tools"></span><a
                        class="services-creative-figure" href="single-service.html"><img src="images/services-7-360x240.jpg"
                            alt="" width="360" height="240" /></a>
                    <div class="services-creative-caption">
                        <h3 class="heading-4 services-creative-title"><a href="single-service.html">Installed Your
                                way</a></h3>
                        <p class="services-creative-text">We always take into account all your wishes and ideas
                            regarding security system in your home and we install them how you want.</p>
                    </div>
                </article>
                <!-- Services Creative-->
                <article class="services-creative"><span class="services-creative-icon icomoon icomoon-house"></span><a
                        class="services-creative-figure" href="single-service.html"><img
                            src="images/services-20-360x240.jpg" alt="" width="360" height="240" /></a>
                    <div class="services-creative-caption">
                        <h3 class="heading-4 services-creative-title"><a href="single-service.html">Theft protection
                                guarantee</a></h3>
                        <p class="services-creative-text">If a burglary occurs while your security system is armed,
                            weʼll pay up to $500 of your insurance deductible.</p>
                    </div>
                </article>
                <!-- Services Creative-->
                <article class="services-creative"><span class="services-creative-icon icomoon icomoon-house"></span><a
                        class="services-creative-figure" href="single-service.html"><img
                            src="images/services-20-360x240.jpg" alt="" width="360" height="240" /></a>
                    <div class="services-creative-caption">
                        <h3 class="heading-4 services-creative-title"><a href="single-service.html">Theft protection
                                guarantee</a></h3>
                        <p class="services-creative-text">If a burglary occurs while your security system is armed,
                            weʼll pay up to $500 of your insurance deductible.</p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="section section-wrap section-wrap-equal bg-sky-blue">
        <div class="container">
            <div class="row row-ten justify-content-md-center justify-content-lg-start">
                <div class="col-md-8 col-lg-5">
                    <div class="section-xxl section-left-align">
                        <h2 class="oh-desktop"><span class="d-inline-block wow slideInLeft">Trust Dester with Your
                                Home's Security</span></h2>
                        <p class="sub wow fadeInRight">With over 20 years of experience in security, we know how to
                            protect you and your home.</p>
                        <div class="button-wrap oh-desktop"><a class="button button-primary wow slideInUp"
                                href="about-us.html">Get a Quote<span class="icon mdi mdi-chevron-right"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-wrap-aside section-wrap-image"><img src="images/security-24-940x610.jpg" alt="" width="940"
                height="610" />
        </div>
    </section>

    <!-- Latest projects-->
    <section class="section section-xxl bg-default text-center">
        <div class="container">
            <h2 class="wow fadeInRight">Our Gallery</h2>
            <p class="sub">Take a look at the showcase of our featured solutions.</p>
        </div>
        <div class="container-fluid container-inset-0">
            <div class="row row-30 row-desktop-8 gutters-8 hoverdir justify-content-center" data-lightgallery="group">
                <div class="col-sm-6 col-lg-5 col-xl-3">
                    <div class="oh-desktop">
                        <!-- Thumbnail Modern-->
                        <article class="thumbnail thumbnail-modern hoverdir-item wow slideInRight"
                            data-hoverdir-target=".thumbnail-modern-caption"><a class="thumbnail-modern-figure"
                                href="images/grid-gallery-1-1050x700-original.jpg" data-lightgallery="item"><img
                                    src="images/grid-gallery-1-474x340.jpg" alt="" width="474" height="340" /></a>
                            <div class="thumbnail-modern-caption">
                                <h3 class="heading-4 thumbnail-modern-title"><a href="project-page.html">Fire
                                        Alarm</a></h3>
                                <div class="thumbnail-modern-badge">
                                    <time datetime="2021-08-05">August 05, 2021</time>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-5 col-xl-3">
                    <div class="oh-desktop">
                        <!-- Thumbnail Modern-->
                        <article class="thumbnail thumbnail-modern hoverdir-item wow slideInUp"
                            data-hoverdir-target=".thumbnail-modern-caption"><a class="thumbnail-modern-figure"
                                href="images/grid-gallery-2-510x700-original.jpg" data-lightgallery="item"><img
                                    src="images/grid-gallery-2-474x340.jpg" alt="" width="474" height="340" /></a>
                            <div class="thumbnail-modern-caption">
                                <h3 class="heading-4 thumbnail-modern-title"><a href="project-page.html">Access
                                        Control</a></h3>
                                <div class="thumbnail-modern-badge">
                                    <time datetime="2021-08-21">August 21, 2021</time>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-5 col-xl-3">
                    <div class="oh-desktop">
                        <!-- Thumbnail Modern-->
                        <article class="thumbnail thumbnail-modern hoverdir-item wow slideInDown"
                            data-hoverdir-target=".thumbnail-modern-caption"><a class="thumbnail-modern-figure"
                                href="images/grid-gallery-3-1050x700-original.jpg" data-lightgallery="item"><img
                                    src="images/grid-gallery-3-474x340.jpg" alt="" width="474" height="340" /></a>
                            <div class="thumbnail-modern-caption">
                                <h3 class="heading-4 thumbnail-modern-title"><a href="project-page.html">Sprinkler</a></h3>
                                <div class="thumbnail-modern-badge">
                                    <time datetime="2021-09-11">September 11, 2021</time>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-5 col-xl-3">
                    <div class="oh-desktop">
                        <!-- Thumbnail Modern-->
                        <article class="thumbnail thumbnail-modern hoverdir-item wow slideInLeft"
                            data-hoverdir-target=".thumbnail-modern-caption"><a class="thumbnail-modern-figure"
                                href="images/grid-gallery-4-474x340-original.jpg" data-lightgallery="item"><img
                                    src="images/grid-gallery-4-474x340.jpg" alt="" width="474" height="340" /></a>
                            <div class="thumbnail-modern-caption">
                                <h3 class="heading-4 thumbnail-modern-title"><a href="project-page.html">Business
                                        Automation</a></h3>
                                <div class="thumbnail-modern-badge">
                                    <time datetime="2021-10-03">October 03, 2021</time>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-5 col-xl-3">
                    <div class="oh-desktop">
                        <!-- Thumbnail Modern-->
                        <article class="thumbnail thumbnail-modern hoverdir-item wow slideInRight"
                            data-hoverdir-target=".thumbnail-modern-caption"><a class="thumbnail-modern-figure"
                                href="images/grid-gallery-5-1050x700-original.jpg" data-lightgallery="item"><img
                                    src="images/grid-gallery-5-474x340.jpg" alt="" width="474" height="340" /></a>
                            <div class="thumbnail-modern-caption">
                                <h3 class="heading-4 thumbnail-modern-title"><a href="project-page.html">Installation &amp;
                                        Maintenance</a></h3>
                                <div class="thumbnail-modern-badge">
                                    <time datetime="2021-08-05">August 05, 2021</time>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-5 col-xl-3">
                    <div class="oh-desktop">
                        <!-- Thumbnail Modern-->
                        <article class="thumbnail thumbnail-modern hoverdir-item wow slideInUp"
                            data-hoverdir-target=".thumbnail-modern-caption"><a class="thumbnail-modern-figure"
                                href="images/grid-gallery-6-1050x700-original.jpg" data-lightgallery="item"><img
                                    src="images/grid-gallery-6-474x340.jpg" alt="" width="474" height="340" /></a>
                            <div class="thumbnail-modern-caption">
                                <h3 class="heading-4 thumbnail-modern-title"><a href="project-page.html">Intrusion
                                        Detection</a></h3>
                                <div class="thumbnail-modern-badge">
                                    <time datetime="2021-08-21">August 21, 2021</time>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-5 col-xl-3">
                    <div class="oh-desktop">
                        <!-- Thumbnail Modern-->
                        <article class="thumbnail thumbnail-modern hoverdir-item wow slideInDown"
                            data-hoverdir-target=".thumbnail-modern-caption"><a class="thumbnail-modern-figure"
                                href="images/grid-gallery-7-1240x700-original.jpg" data-lightgallery="item"><img
                                    src="images/grid-gallery-7-474x340.jpg" alt="" width="474" height="340" /></a>
                            <div class="thumbnail-modern-caption">
                                <h3 class="heading-4 thumbnail-modern-title"><a href="project-page.html">Remote
                                        Control</a></h3>
                                <div class="thumbnail-modern-badge">
                                    <time datetime="2021-09-11">September 11, 2021</time>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-5 col-xl-3">
                    <div class="oh-desktop">
                        <!-- Thumbnail Modern-->
                        <article class="thumbnail thumbnail-modern hoverdir-item wow slideInLeft"
                            data-hoverdir-target=".thumbnail-modern-caption"><a class="thumbnail-modern-figure"
                                href="images/grid-gallery-8-470x700-original.jpg" data-lightgallery="item"><img
                                    src="images/grid-gallery-8-474x340.jpg" alt="" width="474" height="340" /></a>
                            <div class="thumbnail-modern-caption">
                                <h3 class="heading-4 thumbnail-modern-title"><a href="project-page.html">Home
                                        Automation</a></h3>
                                <div class="thumbnail-modern-badge">
                                    <time datetime="2021-10-03">October 03, 2021</time>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section swiper-container swiper-slider swiper-slider-8 swiper-slider-10 bg-gray-3"
        data-swiper='{"autoplay":false,"simulateTouch":false,"loop":true,"effect":"","pagination":{"el":".swiper-pagination","clickable":true}}'>
        <div class="swiper-wrapper text-left">
            <div class="swiper-slide context-dark">
                <div class="swiper-slide-caption section-xxl">
                    <div class="container">
                        <div class="row justify-content-center justify-content-md-between">
                            <div class="col-5 d-none d-md-block position-static">
                                <div class="quote-classic-figure"><img src="images/clients-24-960x680.jpg" alt=""
                                        width="960" height="680" />
                                </div>
                            </div>
                            <div class="col-sm-11 col-md-7 col-xl-6">
                                <div class="inset-left-xl-95">
                                    <h2>What People Say About Our Services</h2>
                                    <!-- Quote Classic-->
                                    <article class="quote-classic quote-classic-2 quote-classic-4"
                                        data-caption-animate="fadeInLeft" data-caption-delay="0">
                                        <div class="quote-classic-text">
                                            <p class="q">Everyone on the team of Dester is easy to deal with and
                                                very responsive. Many years ago, they helped us with our old
                                                security system and did their job perfectly.</p>
                                        </div>
                                        <!--if(obj.author)-->
                                        <!--  p.quote-classic-author=obj.author-->
                                    </article>
                                    <p class="quote-classic-author" data-caption-animate="fadeInLeft"
                                        data-caption-delay="200">— Emily Adams, Customer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide context-dark">
                <div class="swiper-slide-caption section-lg">
                    <div class="container">
                        <div class="row justify-content-center justify-content-md-between">
                            <div class="col-5 d-none d-md-block position-static">
                                <div class="quote-classic-figure"><img src="images/clients-25-960x680.jpg" alt=""
                                        width="960" height="680" />
                                </div>
                            </div>
                            <div class="col-sm-11 col-md-7 col-xl-6">
                                <div class="inset-left-xl-95">
                                    <h2>What People Say About Our Services</h2>
                                    <!-- Quote Classic-->
                                    <article class="quote-classic quote-classic-2 quote-classic-4"
                                        data-caption-animate="fadeInLeft" data-caption-delay="0">
                                        <div class="quote-classic-text">
                                            <p class="q">My home feels much more secure with alarms installed.
                                                Motion detectors are well placed and doors and windows are also
                                                secured. They key pad is easy to operate. The system works great!
                                            </p>
                                        </div>
                                        <!--if(obj.author)-->
                                        <!--  p.quote-classic-author=obj.author-->
                                    </article>
                                    <p class="quote-classic-author" data-caption-animate="fadeInLeft"
                                        data-caption-delay="200">— Sarah Green, Customer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide context-dark">
                <div class="swiper-slide-caption section-lg">
                    <div class="container">
                        <div class="row justify-content-center justify-content-md-between">
                            <div class="col-5 d-none d-md-block position-static">
                                <div class="quote-classic-figure"><img src="images/clients-26-960x680.jpg" alt=""
                                        width="960" height="680" />
                                </div>
                            </div>
                            <div class="col-sm-11 col-md-7 col-xl-6">
                                <div class="inset-left-xl-95">
                                    <h2>What People Say About Our Services</h2>
                                    <!-- Quote Classic-->
                                    <article class="quote-classic quote-classic-2 quote-classic-4"
                                        data-caption-animate="fadeInLeft" data-caption-delay="0">
                                        <div class="quote-classic-text">
                                            <p class="q">Everyone on the team of Dester is easy to deal with and
                                                very responsive. Very good service.</p>
                                        </div>
                                        <!--if(obj.author)-->
                                        <!--  p.quote-classic-author=obj.author-->
                                    </article>
                                    <p class="quote-classic-author" data-caption-animate="fadeInLeft"
                                        data-caption-delay="200">— John Nicolson, Customer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Swiper Pagination-->
        <div class="swiper-pagination swiper-pagination-vertical" data-bullet-custom="true"></div>
    </section>

    <!-- New Materials-->
    <section class="section section-xxl bg-default">
        <div class="container">
            <h2 class="wow fadeInRight">Our Products</h2>
            <p class="sub">Take a look at a variety of security products we offer</p>
            <div class="owl-carousel owl-style-14" data-items="1" data-sm-items="2" data-md-items="3" data-xl-items="4"
                data-margin="30" data-dots="true">
                <!-- Product-->
                <article class="product">
                    <div class="product-figure"><img src="images/product-1-260x260.jpg" alt="" width="260" height="260" />
                    </div>
                    <div class="product-rating"><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span
                            class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span>
                    </div>
                    <h5 class="product-title">iStep Smart Home Security Wi-Fi Camera</h5>
                    <div class="product-price-wrap">
                        <div class="product-price">$14.00</div>
                    </div>
                    <div class="product-button">
                        <div class="button-wrap"><a class="button button-xs button-primary button-winona"
                                href="cart-page.html">Add to cart</a></div>
                        <div class="button-wrap"><a class="button button-xs button-default button-winona"
                                href="single-product.html">View Product</a></div>
                    </div>
                </article>
                <!-- Product-->
                <article class="product">
                    <div class="product-figure"><img src="images/product-2-260x260.jpg" alt="" width="260" height="260" />
                    </div>
                    <div class="product-rating"><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span
                            class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span>
                    </div>
                    <h5 class="product-title">EXR Pro Smart Door Lock with Fingerprint &amp; PIN Access</h5>
                    <div class="product-price-wrap">
                        <div class="product-price">$14.00</div>
                    </div>
                    <div class="product-button">
                        <div class="button-wrap"><a class="button button-xs button-primary button-winona"
                                href="cart-page.html">Add to cart</a></div>
                        <div class="button-wrap"><a class="button button-xs button-default button-winona"
                                href="single-product.html">View Product</a></div>
                    </div><span class="product-badge product-badge-new">New</span>
                </article>
                <!-- Product-->
                <article class="product">
                    <div class="product-figure"><img src="images/product-3-260x260.jpg" alt="" width="260" height="260" />
                    </div>
                    <div class="product-rating"><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span
                            class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span>
                    </div>
                    <h5 class="product-title">GreenSec ABS Electronic Buzzer Alarm</h5>
                    <div class="product-price-wrap">
                        <div class="product-price product-price-sale">$14.00</div>
                        <div class="product-price product-price-old">$21.00</div>
                    </div>
                    <div class="product-button">
                        <div class="button-wrap"><a class="button button-xs button-primary button-winona"
                                href="cart-page.html">Add to cart</a></div>
                        <div class="button-wrap"><a class="button button-xs button-default button-winona"
                                href="single-product.html">View Product</a></div>
                    </div><span class="product-badge product-badge-sale">Sale</span>
                </article>
                <!-- Product-->
                <article class="product">
                    <div class="product-figure"><img src="images/product-4-260x260.jpg" alt="" width="260" height="260" />
                    </div>
                    <div class="product-rating"><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span
                            class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span>
                    </div>
                    <h5 class="product-title">Dester DS100 Biometric Fingerprint Scanner</h5>
                    <div class="product-price-wrap">
                        <div class="product-price">$14.00</div>
                    </div>
                    <div class="product-button">
                        <div class="button-wrap"><a class="button button-xs button-primary button-winona"
                                href="cart-page.html">Add to cart</a></div>
                        <div class="button-wrap"><a class="button button-xs button-default button-winona"
                                href="single-product.html">View Product</a></div>
                    </div>
                </article>
                <!-- Product-->
                <article class="product">
                    <div class="product-figure"><img src="images/product-5-260x260.jpg" alt="" width="260" height="260" />
                    </div>
                    <div class="product-rating"><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span
                            class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span>
                    </div>
                    <h5 class="product-title">SecureNS Fingerprint Wireless Scanner</h5>
                    <div class="product-price-wrap">
                        <div class="product-price product-price-sale">$14.00</div>
                        <div class="product-price product-price-old">$21.00</div>
                    </div>
                    <div class="product-button">
                        <div class="button-wrap"><a class="button button-xs button-primary button-winona"
                                href="cart-page.html">Add to cart</a></div>
                        <div class="button-wrap"><a class="button button-xs button-default button-winona"
                                href="single-product.html">View Product</a></div>
                    </div><span class="product-badge product-badge-sale">Sale</span>
                </article>
                <!-- Product-->
                <article class="product">
                    <div class="product-figure"><img src="images/product-6-260x260.jpg" alt="" width="260" height="260" />
                    </div>
                    <div class="product-rating"><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span
                            class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span>
                    </div>
                    <h5 class="product-title">SmartAge 2-Pack Fire Alarms Smoke Detector</h5>
                    <div class="product-price-wrap">
                        <div class="product-price">$14.00</div>
                    </div>
                    <div class="product-button">
                        <div class="button-wrap"><a class="button button-xs button-primary button-winona"
                                href="cart-page.html">Add to cart</a></div>
                        <div class="button-wrap"><a class="button button-xs button-default button-winona"
                                href="single-product.html">View Product</a></div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="section section-first bg-default">
        <div class="container"></div>
        <div class="parallax-container" data-parallax-img="images/bg-counter-1.jpg">
            <div class="parallax-content section-xxl">
                <div class="container">
                    <div class="row row-30 justify-content-center justify-content-xl-between align-items-lg-end">
                        <div class="col-6 col-sm-3">
                            <div class="counter-modern">
                                <h1 class="counter-modern-number"><span class="counter">380</span>
                                </h1>
                                <div class="counter-modern-decor"></div>
                                <p class="counter-modern-title">Employees</p>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="counter-modern">
                                <h1 class="counter-modern-number"><span class="counter">150</span><span
                                        class="symbol">k</span>
                                </h1>
                                <div class="counter-modern-decor"></div>
                                <p class="counter-modern-title">Clients</p>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="counter-modern">
                                <h1 class="counter-modern-number"><span class="counter">65</span>
                                </h1>
                                <div class="counter-modern-decor"></div>
                                <p class="counter-modern-title">Partners</p>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="counter-modern">
                                <h1 class="counter-modern-number"><span class="counter">100</span><span
                                        class="symbol">k+</span>
                                </h1>
                                <div class="counter-modern-decor"></div>
                                <p class="counter-modern-title">Positive Reviews</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Clients-->
    <section class="section section-xxl bg-default text-center">
        <div class="container">
            <h2 class="wow fadeInRight">Our Products</h2>
            <div class="owl-carousel" data-items="1" data-sm-items="2" data-md-items="3" data-lg-items="4" data-margin="30"
                data-autoplay="true" data-dots="true" data-animation-in="fadeIn" data-animation-out="fadeOut"><a
                    class="clients-creative" href="#"><img src="images/clients-12-260x160.png" alt="" width="260"
                        height="160" /></a><a class="clients-creative" href="#"><img src="images/clients-13-260x160.png"
                        alt="" width="260" height="160" /></a><a class="clients-creative" href="#"><img
                        src="images/clients-14-260x160.png" alt="" width="260" height="160" /></a><a
                    class="clients-creative" href="#"><img src="images/clients-15-260x160.png" alt="" width="260"
                        height="160" /></a><a class="clients-creative" href="#"><img src="images/clients-16-260x160.png"
                        alt="" width="260" height="160" /></a><a class="clients-creative" href="#"><img
                        src="images/clients-17-260x160.png" alt="" width="260" height="160" /></a></div>
        </div>
    </section>
@endsection
