<footer class="footer mt-5">
    <div class="container">
        <div class="row">

            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="widget_title">
                    <h4><span>Hak Cipta</span></h4>
                </div>
                <div class="widget_content">
                    <li>Seluruh isi website ini dilindungi oleh Undang-Undang</li>
                </div>
                <div class="widget_content">
                    <div class="tweet_go"></div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="widget_title">
                    <h4><span>Contact Us</span></h4>
                </div>
                <div class="widget_content">
                    <ul class="contact-details-alt">
                        <li>Nusantara 3 Building 2nd Floor Jl. Gatot Subroto, RT.1/RW.3, Senayan DKI Jakarta, Indonesia, 10270</p>
                        </li>
                        <li><i class="fa fa-user"></i>
                            <p><strong style="width:30%">Telepon</strong>: 021 - 571 5818, 021 - 571 5815</p>
                        </li>
                        <li><i class="fa fa-envelope"></i>
                            <p><strong style="width:30%">Email</strong>: <a href="#">putrasaut@gmail.com</a></p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="widget_title">
                    <h4><span>Follow Us</span></h4>
                </div>
                <div class="widget_content">
                    <ul class="contact-details-alt">
                        <li><i class="fa fa-facebook" style="font-size: 30px; padding-left: 40px;"></i></li>
                        <li><i class="fa fa-twitter" style="font-size: 30px;  padding-left: 25px;"></i></li>
                        <li><i class="fa fa-instagram" style="font-size: 30px;  padding-left: 40px;"></i></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--end footer-->

<script src="<?= base_url() ?>assets/home/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/home/js/jquery.easing.1.3.js"></script>
<script src="<?= base_url() ?>assets/home/js/retina-1.1.0.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/home/js/jquery.cookie.js"></script> <!-- jQuery cookie -->
<script src="<?= base_url() ?>assets/home/js/jquery.fractionslider.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/home/js/jquery.smartmenus.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/home/js/jquery.smartmenus.bootstrap.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/home/js/jquery.jcarousel.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/home/js/jflickrfeed.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/home/js/jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/home/js/jquery.isotope.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/home/js/swipe.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/home/js/jquery-scrolltofixed-min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/home/js/plugins.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/home/myjs/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/home/myjs/dataTables.bootstrap.min.js"></script>

<script src="<?= base_url() ?>assets/home/js/main.js"></script>
<script src="<?= base_url() ?>assets/home/js/custom.js"></script>
<script src="mage/advanced.js"></script>


<!-- Start Style Switcher -->

<div class="switcher"></div>
<script type="text/javascript" src="<?= base_url() ?>assets/home/js/wow.min.js"></script>
<!-- End Style Switcher -->
<script>
    $(window).load(function() {

        $('.slider').fractionSlider({

            'fullWidth': true,

            'controls': true,

            'responsive': true,

            'dimensions': "1920,450",

            'increase': true,

            'pauseOnHover': true,

            'slideEndAnimation': true,

            'autoChange': true

        });

    });
</script>



<script type="text/javascript">
    $('#tabelkab').DataTable({

        "columnDefs": [

            {

                "targets": [-1], //last column

                "orderable": false, //set not orderable

            },

            {

                "targets": [-8], //2 last column (photo)

                "orderable": false, //set not orderable

            },

        ],

    });

    $('#sampleTable').DataTable({});

    $('#sampleTable1').DataTable();

    $('#sampleTable2').DataTable();

    $('#sampleTable3').DataTable();

    $('#sampleTable4').DataTable();

    $('#sampleTable5').DataTable();

    $('#sampleTable6').DataTable();
</script>







<script>
    /*Portfolio*/

    (function($) {

        "use strict";

        var $container = $('.portfolio'),

            $items = $container.find('.portfolio-item'),

            portfolioLayout = 'fitRows';



        if ($container.hasClass('portfolio-centered')) {

            portfolioLayout = 'masonry';

        }



        $container.isotope({

            filter: '*',

            animationEngine: 'best-available',

            layoutMode: portfolioLayout,

            animationOptions: {

                duration: 750,

                easing: 'linear',

                queue: false

            },

            masonry: {

            }

        }, refreshWaypoints());



        function refreshWaypoints() {

            setTimeout(function() {

            }, 1000);

        }



        $('ul#filter li').on('click', function() {

            var selector = $(this).attr('data-filter');

            $container.isotope({
                filter: selector
            }, refreshWaypoints());

            $('ul#filter li').removeClass('selected');

            $(this).addClass('selected');

            return false;

        });



        function getColumnNumber() {

            var winWidth = $(window).width(),

                columnNumber = 1;



            if (winWidth > 1200) {

                columnNumber = 5;

            } else if (winWidth > 950) {

                columnNumber = 4;

            } else if (winWidth > 600) {

                columnNumber = 3;

            } else if (winWidth > 400) {

                columnNumber = 2;

            } else if (winWidth > 250) {

                columnNumber = 1;

            }

            return columnNumber;

        }



        function setColumns() {

            var winWidth = $(window).width(),

                columnNumber = getColumnNumber(),

                itemWidth = Math.floor(winWidth / columnNumber);



            $container.find('.portfolio-item').each(function() {

                $(this).css({

                    width: itemWidth + 'px'

                });

            });

        }



        function setPortfolio() {

            setColumns();

            $container.isotope('reLayout');

        }



        $container.imagesLoaded(function() {

            setPortfolio();

        });



        $(window).on('resize', function() {

            setPortfolio();

        });

    })(jQuery);
</script>



<script>
    function view_det(id)

    {

        var id = id;

        $('#modal_form1').modal('show'); // show bootstrap modal

        $('.modal-title').text('Detail Agenda'); // Set Title to Bootstrap modal title



        $('#gambar_nodin').attr('src', ""); // hide photo preview modal

        $('#photo-preview').hide(); // hide photo preview modal



        $('#label-photo').text('Upload Photo'); // label photo upload





        $.ajax({

            url: "https://www.pariwisata.papua.go.id/detail/agenda/" + id,

            type: "GET",

            dataType: "JSON",

            success: function(tampil)

            {

                //$('.modal-title').text(tampil.judul);

                $('#text_isi').text("Isi Agenda :");

                $('#n_tanggal').text(tampil.tgl);

                $('#n_waktu').text(tampil.waktu);

                $('#n_author').text(tampil.penyunting);

                $('#n_judul').text(tampil.judul);

                var src_foto = "file/agenda/index.html";

                $('#gambar_nodin2').attr('src', src_foto + tampil.cover);

                $('#n_isi').html(tampil.isi);

            },

            error: function(jqXHR, textStatus, errorThrown)

            {

                alert('Data tidak dapat dibuka!');

            }

        });



    }



    function view_berita(id)

    {

        var id = id;

        $('#modal_form1').modal('show'); // show bootstrap modal

        $('.modal-title').text('Detail Berita'); // Set Title to Bootstrap modal title



        $('#gambar_nodin').attr('src', ""); // hide photo preview modal

        $('#photo-preview').hide(); // hide photo preview modal



        $('#label-photo').text('Upload Photo'); // label photo upload





        $.ajax({

            url: "https://www.pariwisata.papua.go.id/detail/berita/" + id,

            type: "GET",

            dataType: "JSON",

            success: function(tampil)

            {

                $('#text_isi').text("Isi Berita :");

                $('#n_tanggal').text(tampil.tgl);

                $('#n_waktu').text(tampil.waktu);

                $('#n_author').text(tampil.penyunting);

                $('#n_judul').text(tampil.judul);

                var src_foto = "file/berita/index.html";

                $('#gambar_nodin2').attr('src', src_foto + tampil.cover);

                $('#n_isi').html(tampil.isi);

            },

            error: function(jqXHR, textStatus, errorThrown)

            {

                alert('Data tidak dapat dibuka!');

            }

        });



    }
</script>

<script>
    // WOW Animation

    new WOW().init();
</script>

<!-- Bootstrap modal -->

<div class="modal fade" id="modal_form1" role="dialog">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h3 class="modal-title"></h3>

            </div>

            <div class="modal-body">



                <div class="pull-left image"><img src="#" id="gambar_nodin2" width="200" alt="Preview Gambar" class="img-rounded" style="margin-right:20px" />

                </div>

                <div class="pull-left info">

                    <table>

                        <tr>

                            <td>Judul &nbsp;</td>

                            <td width="20px">:</td>

                            <td><b><span id="n_judul"></span></b></td>

                        </tr>

                        <tr>

                            <td>Tanggal Publish</td>

                            <td width="20px">:</td>

                            <td><b><span id="n_tanggal"></span></b></td>

                        </tr>

                        <tr>

                            <td>Waktu Publish</td>

                            <td width="20px">:</td>

                            <td><b><span id="n_waktu"></span></b></td>

                        </tr>

                        <tr>

                            <td>Author</td>

                            <td width="20px">:</td>

                            <td><b><span id="n_author"></span></b></td>

                        </tr>

                    </table>

                </div>

                <div class="clearfix"></div>

                <h3 id="text_isi">Isi : </h3>

                <div class="pull-left info" id="n_isi">



                </div>

                <div class="clearfix"></div>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>

            </div>

        </div><!-- /.modal-content -->

    </div><!-- /.modal-dialog -->

</div><!-- /.modal -->





</body>


</html>