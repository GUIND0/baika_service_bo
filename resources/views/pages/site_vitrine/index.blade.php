<!DOCTYPE html>
<html lang="en">

@include('pages.site_vitrine.head')

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
          @include('pages.site_vitrine.nav')

            <div class="container-xxl py-5 bg-primary hero-header mb-5">
                <div class="container my-5 py-5 px-lg-5">
                    <div class="row g-5">
                        <div class="col-lg-8 pt-5 text-center text-lg-start">
                            <h1 class="display-4 text-white mb-4 animated slideInLeft">La plateforme ideale pour vous simplifier la vie</h1>
                            <p class="text-white animated slideInLeft">BEKST-EXPRESS est une plateforme digitale mise en place pour vous permettre de faire vos achats de billets d'avion ,tickets transports, faire une location et la livraison de vos colis en quelque clic .</p>
                            <div class="row">
                                <div class="col-5">
                                     <a href="https://play.google.com/store/apps/details?id=com.bekst.app&hl=fr&gl=US" target="_blank"><img class="img-fluid animated zoomIn" width="100%;"  src="{{ url('site/img/store.png')}}" alt=""></a>
                                </div>
                                <div class="col-5">
                                    <a href="https://play.google.com/store/apps/details?id=com.bekst.app&hl=fr&gl=US" target="_blank"><img class="img-fluid animated zoomIn"   width="90%;" src="{{ url('site/img/AppStore.png')}}" alt=""></a>
                                </div>
                                <div class="col-2">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-left text-lg-start">
                           <img class="img-fluid animated zoomIn" src="{{ url('site/img/llll.jpeg')}}" width="275"  alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->








        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container px-lg-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="section-title position-relative mb-4 pb-4">
                            <h1 class="mb-2">Bienvenue chez BEKST</h1>
                        </div>
                        <p class="mb-4">En quelque chiffre les taches accomplies par Baika Services Express</p>
                        <div class="row g-3">
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.1s">
                                <div class="bg-light rounded text-center p-4">
                                    <i class="fa fa-users-cog fa-2x text-primary mb-2"></i>
                                    <h2 class="mb-1" data-toggle="counter-up">19</h2>
                                    <p class="mb-0">Chauffeurs</p>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.3s">
                                <div class="bg-light rounded text-center p-4">
                                    <i class="fa fa-users fa-2x text-primary mb-2"></i>
                                    <h2 class="mb-1" data-toggle="counter-up">358</h2>
                                    <p class="mb-0">Clients</p>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.5s">
                                <div class="bg-light rounded text-center p-4">
                                    <i class="fa fa-check fa-2x text-primary mb-2"></i>
                                    <h2 class="mb-1" data-toggle="counter-up">2876</h2>
                                    <p class="mb-0">Livraison</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <img class="img-fluid wow zoomIn" data-wow-delay="0.5s" src="{{ url('site/img/logoback.png')}}">
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        {{-- <!-- Pricing Start -->
        <div class="container-xxl py-5">
            <div class="container px-lg-5">
                <div class="section-title position-relative text-center mx-auto mb-5 pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Our Hosting Plans</h1>
                    <p class="mb-1">Vero justo sed sed vero clita amet. Et justo vero sea diam elitr amet ipsum eos ipsum clita duo sed. Sed vero sea diam erat vero elitr sit clita.</p>
                </div>
                <div class="row gy-5 gx-4">
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="position-relative shadow rounded border-top border-5 border-primary">
                            <div class="d-flex align-items-center justify-content-center position-absolute top-0 start-50 translate-middle bg-primary rounded-circle" style="width: 45px; height: 45px; margin-top: -3px;">
                                <i class="fa fa-share-alt text-white"></i>
                            </div>
                            <div class="text-center border-bottom p-4 pt-5">
                                <h4 class="fw-bold">Share Hosting</h4>
                                <p class="mb-0">Eirmod erat dolor amet est clita lorem erat justo rebum elitr eos</p>
                            </div>
                            <div class="text-center border-bottom p-4">
                                <p class="text-primary mb-1">Latest Offer - <strong>Save 30%</strong></p>
                                <h1 class="mb-3">
                                    <small class="align-top" style="font-size: 22px; line-height: 45px;">$</small>2.49<small
                                        class="align-bottom" style="font-size: 16px; line-height: 40px;">/ Month</small>
                                </h1>
                                <a class="btn btn-primary px-4 py-2" href="">Buy Now</a>
                            </div>
                            <div class="p-4">
                                <p class="border-bottom pb-3"><i class="fa fa-check text-primary me-3"></i>100 GB Disk Space</p>
                                <p class="border-bottom pb-3"><i class="fa fa-check text-primary me-3"></i>Unlimited Bandwith</p>
                                <p class="border-bottom pb-3"><i class="fa fa-check text-primary me-3"></i>Upgrade to Positive SSL</p>
                                <p class="border-bottom pb-3"><i class="fa fa-check text-primary me-3"></i>Automatic Malware Removal</p>
                                <p class="mb-0"><i class="fa fa-check text-primary me-3"></i>30 Days Money Back Guarantee</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="position-relative shadow rounded border-top border-5 border-secondary">
                            <div class="d-flex align-items-center justify-content-center position-absolute top-0 start-50 translate-middle bg-secondary rounded-circle" style="width: 45px; height: 45px; margin-top: -3px;">
                                <i class="fa fa-server text-white"></i>
                            </div>
                            <div class="text-center border-bottom p-4 pt-5">
                                <h4 class="fw-bold">VPS Hosting</h4>
                                <p class="mb-0">Eirmod erat dolor amet est clita lorem erat justo rebum elitr eos</p>
                            </div>
                            <div class="text-center border-bottom p-4">
                                <p class="text-primary mb-1">Latest Offer - <strong>Save 30%</strong></p>
                                <h1 class="mb-3">
                                    <small class="align-top" style="font-size: 22px; line-height: 45px;">$</small>5.49<small
                                        class="align-bottom" style="font-size: 16px; line-height: 40px;">/ Month</small>
                                </h1>
                                <a class="btn btn-secondary px-4 py-2" href="">Buy Now</a>
                            </div>
                            <div class="p-4">
                                <p class="border-bottom pb-3"><i class="fa fa-check text-primary me-3"></i>100 GB Disk Space</p>
                                <p class="border-bottom pb-3"><i class="fa fa-check text-primary me-3"></i>Unlimited Bandwith</p>
                                <p class="border-bottom pb-3"><i class="fa fa-check text-primary me-3"></i>Upgrade to Positive SSL</p>
                                <p class="border-bottom pb-3"><i class="fa fa-check text-primary me-3"></i>Automatic Malware Removal</p>
                                <p class="mb-0"><i class="fa fa-check text-primary me-3"></i>30 Days Money Back Guarantee</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="position-relative shadow rounded border-top border-5 border-primary">
                            <div class="d-flex align-items-center justify-content-center position-absolute top-0 start-50 translate-middle bg-primary rounded-circle" style="width: 45px; height: 45px; margin-top: -3px;">
                                <i class="fa fa-cog text-white"></i>
                            </div>
                            <div class="text-center border-bottom p-4 pt-5">
                                <h4 class="fw-bold">Dedi Hosting</h4>
                                <p class="mb-0">Eirmod erat dolor amet est clita lorem erat justo rebum elitr eos</p>
                            </div>
                            <div class="text-center border-bottom p-4">
                                <p class="text-primary mb-1">Latest Offer - <strong>Save 30%</strong></p>
                                <h1 class="mb-3">
                                    <small class="align-top" style="font-size: 22px; line-height: 45px;">$</small>11.49<small
                                        class="align-bottom" style="font-size: 16px; line-height: 40px;">/ Month</small>
                                </h1>
                                <a class="btn btn-primary px-4 py-2" href="">Buy Now</a>
                            </div>
                            <div class="p-4">
                                <p class="border-bottom pb-3"><i class="fa fa-check text-primary me-3"></i>100 GB Disk Space</p>
                                <p class="border-bottom pb-3"><i class="fa fa-check text-primary me-3"></i>Unlimited Bandwith</p>
                                <p class="border-bottom pb-3"><i class="fa fa-check text-primary me-3"></i>Upgrade to Positive SSL</p>
                                <p class="border-bottom pb-3"><i class="fa fa-check text-primary me-3"></i>Automatic Malware Removal</p>
                                <p class="mb-0"><i class="fa fa-check text-primary me-3"></i>30 Days Money Back Guarantee</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pricing End --> --}}


        <!-- Comparison Start -->
        <div class="container-xxl py-5">
            <div class="container px-lg-5">
                <div class="section-title position-relative text-center mx-auto mb-5 pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Domaine d'intervention</h1>
                    <p class="mb-1">BEKST est une entreprise qui intervient dans plusieurs domaines qui sont les suivants :</p>
                </div>
                <div class="row g-5 comparison position-relative">
                    <div class="col-lg-6 pe-lg-5">
                        <div class="section-title position-relative mx-auto mb-4 pb-4">
                            <h3 class="fw-bold mb-0">Livraison et Transport</h3>
                        </div>
                        <div class="row gy-3 gx-5">
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                                <i class="fa fa-taxi fa-3x text-primary mb-3"></i>
                                <h5 class="fw-bold">Taxi</h5>
                                <p>Appeler un taxi depuis votre position</p>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                                <i class="fa fa-car fa-3x text-primary mb-3"></i>
                                <h5 class="fw-bold">Location de Vehicules</h5>
                                <p>Louer les meilleurs vehicules</p>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.5s">
                                <i class="fa fa-cubes fa-3x text-primary mb-3"></i>
                                <h5 class="fw-bold">Envois et Reception de colis</h5>
                                <p>Envoyer et receptionner vos colis depuis votre emplacement</p>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.7s">
                                <i class="fa fa-users fa-3x text-primary mb-3"></i>
                                <h5 class="fw-bold">Recrutement</h5>
                                <p>Recruter des chauffeurs,des vigiles etc..</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 ps-lg-5">
                        <div class="section-title position-relative mx-auto mb-4 pb-4">
                            <h3 class="fw-bold mb-0">Billet Express et Evenementielle</h3>
                        </div>
                        <div class="row gy-3 gx-5">
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                                <i class="fa fa-plane fa-3x text-secondary mb-3"></i>
                                <h5 class="fw-bold">Billet d'avion</h5>
                                <p>Reserver votre billet d'avion</p>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                                <i class="fa fa-bus fa-3x text-secondary mb-3"></i>
                                <h5 class="fw-bold">Billet (Car)</h5>
                                <p>Reserver vos tickets de transport</p>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.5s">
                                <i class="fa fa-table fa-3x text-secondary mb-3"></i>
                                <h5 class="fw-bold">Evenement</h5>
                                <p>Reserver vos tickets pour les evenements</p>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.7s">
                                <i class="fa fa-map fa-3x text-secondary mb-3"></i>
                                <h5 class="fw-bold">Tourisme</h5>
                                <p>Tourisme ...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Comparison Start -->


        <!-- Testimonial Start -->
        <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container px-lg-5">
                <div class="owl-carousel testimonial-carousel">
                    <div class="testimonial-item position-relative bg-light border-top border-5 border-primary rounded p-4 my-4">
                        <div class="d-flex align-items-center justify-content-center position-absolute top-0 start-0 ms-5 translate-middle bg-primary rounded-circle" style="width: 45px; height: 45px; margin-top: -3px;">
                            <i class="fa fa-quote-left text-white"></i>
                        </div>
                        <p class="mt-3">Le service de livraison est impecable </p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="{{ url('site/img/testimonial-1.jpg')}}" style="width: 50px; height: 50px;">
                            <div class="ps-3">
                                <h6 class="fw-bold mb-1">Moussa Traore</h6>
                                <small>Journaliste</small>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item position-relative bg-light border-top border-5 border-primary rounded p-4 my-4">
                        <div class="d-flex align-items-center justify-content-center position-absolute top-0 start-0 ms-5 translate-middle bg-primary rounded-circle" style="width: 45px; height: 45px; margin-top: -3px;">
                            <i class="fa fa-quote-left text-white"></i>
                        </div>
                        <p class="mt-3">La reservation de billet est tres rapide et avec les meilleurs places</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="{{ url('site/img/testimonial-2.jpg')}}" style="width: 50px; height: 50px;">
                            <div class="ps-3">
                                <h6 class="fw-bold mb-1">Adama Soumare</h6>
                                <small>Mecanicien</small>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item position-relative bg-light border-top border-5 border-primary rounded p-4 my-4">
                        <div class="d-flex align-items-center justify-content-center position-absolute top-0 start-0 ms-5 translate-middle bg-primary rounded-circle" style="width: 45px; height: 45px; margin-top: -3px;">
                            <i class="fa fa-quote-left text-white"></i>
                        </div>
                        <p class="mt-3">Je suis satisfait du chauffeur que j'ai embauche a travers votre plateforme</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="{{ url('site/img/testimonial-3.jpg')}}" style="width: 50px; height: 50px;">
                            <div class="ps-3">
                                <h6 class="fw-bold mb-1">Issa Barry</h6>
                                <small>Femme de menage</small>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item position-relative bg-light border-top border-5 border-primary rounded p-4 mt-4">
                        <div class="d-flex align-items-center justify-content-center position-absolute top-0 start-0 ms-5 translate-middle bg-primary rounded-circle" style="width: 45px; height: 45px; margin-top: -3px;">
                            <i class="fa fa-quote-left text-white"></i>
                        </div>
                        <p class="mt-3">Service Impecable</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="{{ url('site/img/testimonial-4.jpg')}}" style="width: 50px; height: 50px;">
                            <div class="ps-3">
                                <h6 class="fw-bold mb-1">Ousmane Diallo</h6>
                                <small>Comptable</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->


        <!-- Team Start -->
        <div class="container-xxl py-5">
            <div class="container px-lg-5">
                <div class="section-title position-relative text-center mx-auto mb-5 pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Notre equipe</h1>

                </div>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item border-top border-5 border-primary rounded shadow overflow-hidden">
                            <div class="text-center p-4">
                                <img class="img-fluid rounded-circle mb-4"  src="{{ url('site/img/bag.jpeg')}}" alt="">
                                <h5 class="fw-bold mb-1"> Mamadou BAGAYA </h5>
                                <small>CEO</small>
                            </div>
                            <div class="d-flex justify-content-center bg-primary p-3">
                                <a class="btn btn-square text-primary bg-white m-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square text-primary bg-white m-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square text-primary bg-white m-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="team-item border-top border-5 border-primary rounded shadow overflow-hidden">
                            <div class="text-center p-4">
                                <img class="img-fluid rounded-circle mb-4" width="250" src="{{ url('site/img/autre.jpeg')}}" alt="">
                                <h5 class="fw-bold mb-1">Souleymane WELE</h5>
                                <small>COMPTABLE</small>
                            </div>
                            <div class="d-flex justify-content-center bg-primary p-3">
                                <a class="btn btn-square text-primary bg-white m-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square text-primary bg-white m-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square text-primary bg-white m-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="team-item border-top border-5 border-primary rounded shadow overflow-hidden">
                            <div class="text-center p-4">
                                <img class="img-fluid rounded-circle mb-4" src="{{ url('site/img/femme.jpeg')}}" alt="">
                                <h5 class="fw-bold mb-1">Fatima BAH</h5>
                                <small>COMMERCIAL</small>
                            </div>
                            <div class="d-flex justify-content-center bg-primary p-3">
                                <a class="btn btn-square text-primary bg-white m-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square text-primary bg-white m-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square text-primary bg-white m-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="team-item border-top border-5 border-primary rounded shadow overflow-hidden">
                            <div class="text-center p-4">
                                <img class="img-fluid rounded-circle mb-4" src="{{ url('site/img/petit.jpeg')}}" alt="">
                                <h5 class="fw-bold mb-1">Oumar FOFANA</h5>
                                <small>COMMUNITY MANAGER</small>
                            </div>
                            <div class="d-flex justify-content-center bg-primary p-3">
                                <a class="btn btn-square text-primary bg-white m-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square text-primary bg-white m-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square text-primary bg-white m-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="team-item border-top border-5 border-primary rounded shadow overflow-hidden">
                            <div class="text-center p-4">
                                <img class="img-fluid rounded-circle mb-4" src="{{ url('site/img/looo.jpeg')}}" style="width: 300px;" alt="">
                                <h5 class="fw-bold mb-1">Oumar FOFANA</h5>
                                <small>RESPONSABLE LOG. ET TRANS.</small>
                            </div>
                            <div class="d-flex justify-content-center bg-primary p-3">
                                <a class="btn btn-square text-primary bg-white m-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square text-primary bg-white m-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square text-primary bg-white m-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team End -->


        <!-- Footer Start -->
        <div class="container-fluid bg-primary text-white footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5 px-lg-5">
                <div class="row gy-5 gx-4 pt-5">

                    <div class="col-lg-5 col-md-12">
                            <div class="col-md-6">
                                <h5 class="fw-bold text-white mb-4">Nos Services</h5>
                                <a class="btn btn-link" href="#">Taxi</a>
                                <a class="btn btn-link" href="#">Billet Express</a>
                                <a class="btn btn-link" href="#">Envois et reception de colis</a>
                                <a class="btn btn-link" href="#">Livraison de Marchandise</a>
                                <a class="btn btn-link" href="#">Location de Vehicule</a>
                                <a class="btn btn-link" href="#">Recrutement et Tourisme</a>
                            </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h5 class="fw-bold text-white mb-4">Adresse</h5>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Banankabougou R77 P99 BKO/MALi</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+223  71 71 73 68 </p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>Hello@bekstexpress.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mt-lg-n5">
                        <div class="bg-light rounded" style="padding: 30px;">
                            <input type="text" class="form-control border-0 py-2 mb-2" placeholder="Nom complet">
                            <input type="email" class="form-control border-0 py-2 mb-2" placeholder="Email">
                            <textarea class="form-control border-0 mb-2" rows="2" placeholder="Message"></textarea>
                            <button class="btn btn-primary w-100 py-2">Envoyer</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container px-lg-5">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">BEKST-EXPRESS</a>, All Right Reserved. {{ date('Y') }}

							<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
							Designed By <a class="border-bottom" href="http://kononkoulou.com/">Kononkoulou</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-secondary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('site/lib/wow/wow.min.js')}}"></script>
    <script src="{{ url('site/lib/easing/easing.min.js')}}"></script>
    <script src="{{ url('site/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{ url('site/lib/counterup/counterup.min.js')}}"></script>
    <script src="{{ url('site/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{ url('site/js/main.js')}}"></script>
</body>

</html>
