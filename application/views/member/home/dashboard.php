<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Aplikasi OmniLaw</title>
    <!-- Favicon-->
    <link rel="icon" href="<?= base_url() ?>assets/images/logo-icon.png">
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="assets/css/styles.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/fontawesome/css/all.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">

</head>

<body>

    <!--Modal Login-->
    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Masuk Aplikasi OmniLaw</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo base_url('login/doLogin/'); ?>" method="post">
                    <div class="modal-body mx-3">
                        <div class="md-form mb-5">
                            <i class="fas fa-envelope prefix grey-text"></i>
                            <input type="text" name="username" id="defaultForm-email" class="form-control validate">
                            <label data-error="wrong" data-success="right" for="defaultForm-email">Username</label>
                        </div>

                        <div class="md-form mb-4">
                            <i class="fas fa-lock prefix grey-text"></i>
                            <input type="password" name="password" id="defaultForm-pass" class="form-control validate form-password">
                            <label data-error="wrong" data-success="right" for="defaultForm-pass">Password</label>
                        </div>
                        <input type="checkbox" class="form-checkbox"> Show password

                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button class="btn-sm btn-primary" type="submit"><i class="fas fa-sign-in-alt">
                                Masuk</i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Modal Login-->
    <!-- asidasdjijasidjaisjdiajsidj -->

    <!-- Navigation-->
    <nav class="navbar navbar-light bg-light static-top">
        <div class="container d-flex flex-column flex-md-row align-items-center">
            <h4 class="my-0 mr-md-auto text-primary"><i class="fas fa-landmark"></i> Aplikasi OmniLaw</h4>
            <a class="btn-sm btn-primary text-white" data-toggle="modal" data-target="#modalLoginForm"><i class="fas fa-sign-in-alt"> Masuk</i></a>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="text-center text-white">
                        <!-- Page heading-->
                        <h1>APLIKASI OMNILAW</h1>
                        <p>Aplikasi yang ditujukan untuk membantu efektivitas dan efisiensi perancangangan
                            Undang-Undang, dengan dukungan informasi kemiripan antar Undang-Undang dan informasi
                            spesifik per-pasal dalam berbagai tema Undang-Undang.
                            Nikmati berbagai kemudahan dalam merancang Undang-Undang dengan menekan tombol masuk.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Icons Grid-->
    <section class="features-icons bg-light text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                        <a href="<?= base_url() ?>home/arsip">
                            <div class="features-icons-icon d-flex"><i class="bi-window m-auto text-primary"></i></div>
                            <h3>Arsip UU</h3>
                            <p class="lead mb-0">Temukan data UU terkini sesuai dengan kebutuhan anda</p>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                        <a href="<?= base_url() ?>home/drafting">
                            <div class="features-icons-icon d-flex"><i class="bi-layers m-auto text-primary"></i></div>
                            <h3>Drafting UU</h3>
                            <p class="lead mb-0">Penyusunan UU berdasarkan kata kunci yang memiliki kemiripan dengan pasal
                                yang terkait!</p>
                        </a>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                        <a href="<?= base_url() ?>home/harmonisasi">
                            <div class="features-icons-icon d-flex"><i class="bi-terminal m-auto text-primary"></i></div>
                            <h3>Harmonisasi UU</h3>
                            <p class="lead mb-0">Lakukan perancangan Undang-Undang dengan dukungan pengecekan kemiripan antar Undang-Undang!</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Image Showcases-->
    <section class="showcase">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('assets/img/bg-showcase-1.jpg')"></div>
                <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                    <h2>Drafting Undang-Undang</h2>
                    <p class="lead mb-0">Proses merancang Undang-Undang yang anda lakukan akan jauh lebih efektif dan
                        efisien, dengan dukungan pengecekan kemiripan antar Undang-Undang,
                        anda tidak perlu melakukan penelusuran manual kesesuaian Rancangan Undang-Undang yang sedang
                        dibuat dengan Undang-Undang yang sudah ada.
                    </p>
                </div>
            </div>
            <div class="row g-0">
                <div class="col-lg-6 text-white showcase-img" style="background-image: url('assets/img/bg-showcase-2.jpg')"></div>
                <div class="col-lg-6 my-auto showcase-text">
                    <h2>Arsip Undang-Undang</h2>
                    <p class="lead mb-0">Temukan Undang-Undang yang anda perlukan sebagai referensi,dengan database
                        Undang-Undang terkini.</p>
                </div>
            </div>
            <!-- <div class="row g-0">
                <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('assets/img/bg-showcase-3.jpg')"></div>
                <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                    <h2>Pencarian Berdasarkan Tema Undang-Undang</h2>
                    <p class="lead mb-0">Temukan Undang-Undang dan pasal terkait sesuai dengan 'Kata Kunci' yang anda inginkan. Telusuri lebih lanjut Undang-Undang dan pasal sesuai dengan keinginan anda.</p>
                </div>
            </div> -->
        </div>
    </section>
    <!-- Testimonials-->
    <section class="testimonials text-center bg-light">
        <div class="container">
            <h2 class="mb-5">Tim Aplikasi OmniLaw</h2>
            <div class="row">
                <div class="col-lg-4">
                    <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                        <img class="img-fluid rounded-circle mb-3" src="assets/img/testimonials-1.jpg" alt="..." />
                        <h5>Rudy, S.H., LL.M., LL.D.</h5>
                        <p class="font-weight-light mb-0">Fakultas Hukum Universitas Lampung</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                        <img class="img-fluid rounded-circle mb-3" src="assets/img/testimonials-2.jpg" alt="..." />
                        <h5>Dr. Robi Cahyadi Kurniawan, S.I.P., M.A.</h5>
                        <p class="font-weight-light mb-0">Fakultas Sosial dan Politik Universitas Lampung</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                        <img class="img-fluid rounded-circle mb-3" src="assets/img/testimonials-3.jpg" alt="..." />
                        <h5>Aristoteles, S.Si., M.Si.</h5>
                        <p class="font-weight-light mb-0">Fakultas Matematika dan Ilmu Pengetahuan Alam Universitas
                            Lampung</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Call to Action-->
    <section class="call-to-action text-white text-center" id="signup">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <h2 class="mb-4">Ingin mendapatkan informasi dari kami? Silahkan tulis email anda!</h2>
                    <form class="form-subscribe" id="contactFormFooter" data-sb-form-api-token="API_TOKEN">
                        <!-- Email address input-->
                        <div class="row">
                            <div class="col">
                                <input class="form-control form-control-lg" id="emailAddressBelow" type="email" placeholder="Alamat Email" data-sb-validations="required,email" />
                                <div class="invalid-feedback text-white" data-sb-feedback="emailAddressBelow:required">
                                    Diperlukan alamat email.</div>
                                <div class="invalid-feedback text-white" data-sb-feedback="emailAddressBelow:email">
                                    Alamat email tidak valid.</div>
                            </div>
                            <div class="col-auto"><button class="btn btn-primary btn-lg disabled" id="submitButton" type="submit">Submit</button></div>
                        </div>
                        <div class="d-none" id="submitSuccessMessage">
                            <div class="text-center mb-3">
                                <div class="fw-bolder">Berhasil!</div>
                                <p>Silahkan masuk!</p>
                                <a class="text-white" href="https://localhost/omnilaw/">Aplikasi OmniLaw</a>
                            </div>
                        </div>
                        <div class="d-none" id="submitErrorMessage">
                            <div class="text-center text-danger mb-3">Error sending message!</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="footer bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 h-100 text-center text-lg-start my-auto">
                    <ul class="list-inline mb-2">
                        <li class="list-inline-item"><a href="#!">About</a></li>
                        <li class="list-inline-item">⋅</li>
                        <li class="list-inline-item"><a href="#!">Contact</a></li>
                        <li class="list-inline-item">⋅</li>
                        <li class="list-inline-item"><a href="#!">Terms of Use</a></li>
                        <li class="list-inline-item">⋅</li>
                        <li class="list-inline-item"><a href="#!">Privacy Policy</a></li>
                    </ul>
                    <p class="text-muted small mb-4 mb-lg-0">&copy; Aplikasi LPDP Unila 2021. All Rights Reserved.</p>
                </div>
                <div class="col-lg-6 h-100 text-center text-lg-end my-auto">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item me-4">
                            <a href="#!"><i class="bi-facebook fs-3"></i></a>
                        </li>
                        <li class="list-inline-item me-4">
                            <a href="#!"><i class="bi-twitter fs-3"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!"><i class="bi-instagram fs-3"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->
</body>

</html>


<!-- JavaScript -->
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="assets/js/scripts.js"></script>
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js">
</script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
<!-- JavaScript -->

<script type="text/javascript">
    $(document).ready(function() {
        $('.form-checkbox').click(function() {
            if ($(this).is(':checked')) {
                $('.form-password').attr('type', 'text');
            } else {
                $('.form-password').attr('type', 'password');
            }
        });
    });
</script>