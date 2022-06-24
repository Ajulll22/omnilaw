<!DOCTYPE html>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aplikasi OmniLaw</title>
    <link rel="icon" href="<?= base_url() ?>assets/images/logo-icon.png">

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url() ?>assets/css/pricingtemplate.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="<?= base_url() ?>assets/fontawesome/css/all.css" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">

</head>

<body style="background-color:#F2F2F2;">
    <header class="mb-5">
        <nav class="navbar navbar-light bg-light static-top">
            <div class="container d-flex flex-column flex-md-row align-items-center">
                <h4 class="my-0 mr-md-auto text-primary"><i class="fas fa-landmark"></i> Aplikasi OmniLaw</h4>
                <a class="p-2 text-dark" href="<?= base_url() ?>">Beranda</a>
                <a class="p-2 text-dark" href="<?= base_url() ?>home/arsip">Arsip</a>
                <a class="p-2 text-dark" href="<?= base_url() ?>home/harmonisasi">Harmonisasi</a>
                <a class="p-2 text-dark" href="<?= base_url() ?>home/cousine">Drafting</a>
                <a class="p-2 text-dark" href="<?= base_url() ?>home/drafting">Drafting</a>
                <!-- <a class="p-2 text-dark" href="<?= base_url() ?>home/similiarity">Harmonisasi UU</a> -->
                <a class="btn-sm btn-primary text-white" data-toggle="modal" data-target="#modalLoginForm"><i class="fas fa-sign-in-alt"> Masuk</i></a>
            </div>
        </nav>

    </header>
</body>

<!--Modal Login-->
<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
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
                    <button class="btn-sm btn-primary" type="submit"><i class="fas fa-sign-in-alt"> Masuk</i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Modal Login-->





<!-- JavaScripts -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="<?= base_url() ?>assets/home/js/jquery-2.1.4.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="assets/js/vendor/jquery-slim.min.js"><\/script>')
  </script>
  <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>assets/fontawesome/js/all.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script> -->
<!-- JavaScripts -->

<!-- JavaScript -->
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="../assets/js/scripts.js"></script>
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
	$(document).ready(function(){		
		$('.form-checkbox').click(function(){
			if($(this).is(':checked')){
				$('.form-password').attr('type','text');
			}else{
				$('.form-password').attr('type','password');
			}
		});
	});
</script>