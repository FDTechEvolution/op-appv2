<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Mintonzz - Responsive Admin Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <?= $this->Html->css('assets/css/bootstrap.min') ?>
        <?= $this->Html->css('assets/css/icons.min') ?>
        <?= $this->Html->css('assets/css/app.min') ?>
        <?= $this->Html->css('assets/css/custom') ?>

        <?= $this->Html->script('jquery.min.js') ?>
        <?= $this->Html->script('modernizr.min.js') ?>
        <?= $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js') ?>

        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="https://unpkg.com/vuejs-paginate@0.9.0"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

        <script>
            localStorage.setItem('USER_ID', '<?= $USERID ?>')
            localStorage.setItem('ORG', '<?= $ORGID ?>')
        </script>
    </head>

    <body>

        <!-- Navigation Bar-->
        <?= $this->element('Layouts/default_header') ?>
        <!-- End Navigation Bar-->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="wrapper">
            <div class="container-fluid" style="padding-top: 40px;">

                <!-- Start content -->
                <div class="content">
                    <?= $this->fetch('content') ?>
                    <!-- end container -->
                </div>
                <!-- end content -->


            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        2016 - 2019 &copy; Minton theme by <a href="">Coderthemes</a> 
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-right footer-links d-none d-sm-block">
                            <a href="javascript:void(0);">About Us</a>
                            <a href="javascript:void(0);">Help</a>
                            <a href="javascript:void(0);">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <?= $this->Html->script('/css/assets/js/vendor.min.js') ?>

        <?= $this->Html->script('/css/assets/js/app.min.js') ?>

        <script>
            var resizefunc = [];
        </script>

        <!-- Plugins  -->
        <?= $this->Html->script('popper.min.js') ?>
        <?= $this->Html->script('bootstrap.min.js') ?>
        <?= $this->Html->script('detect.js') ?>
        <?= $this->Html->script('fastclick.js') ?>
        <?= $this->Html->script('jquery.slimscroll.js') ?>
        <?= $this->Html->script('jquery.blockUI.js') ?>
        <?= $this->Html->script('waves.js') ?>
        <?= $this->Html->script('wow.min.js') ?>
        <?= $this->Html->script('jquery.nicescroll.js') ?>
        <?= $this->Html->script('jquery.scrollTo.min.js') ?>
        <?= $this->Html->script('/plugins/switchery/switchery.min.js') ?>

        <!-- Required datatable js -->
        <?= $this->Html->script("/plugins/datatables/jquery.dataTables.min.js") ?>
        <?= $this->Html->script("/plugins/datatables/dataTables.bootstrap4.min.js") ?>
        <!-- Buttons examples -->
        <?= $this->Html->script("/plugins/datatables/dataTables.buttons.min.js") ?>
        <?= $this->Html->script("/plugins/datatables/buttons.bootstrap4.min.js") ?>
        <?= $this->Html->script("/plugins/datatables/jszip.min.js") ?>
        <?= $this->Html->script("/plugins/datatables/pdfmake.min.js") ?>
        <?= $this->Html->script("/plugins/datatables/vfs_fonts.js") ?>
        <?= $this->Html->script("/plugins/datatables/buttons.html5.min.js") ?>
        <?= $this->Html->script("/plugins/datatables/buttons.print.min.js") ?>
        <?= $this->Html->script("/plugins/datatables/buttons.colVis.min.js") ?>
        <!-- Responsive examples -->
        <?= $this->Html->script("/plugins/datatables/dataTables.responsive.min.js") ?>
        <?= $this->Html->script("/plugins/datatables/responsive.bootstrap4.min.js") ?>

        <?= $this->Html->script('jquery.core.js') ?>
        <?= $this->Html->script('jquery.app.js') ?>

    </body>
</html>