<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Login - Order-Pang</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <?=$this->Html->css('assets/css/bootstrap.min')?>
        <?=$this->Html->css('assets/css/icons.min')?>
        <?=$this->Html->css('assets/css/app.min')?>

        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    </head>

    <body>

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">

                            <div class="card-body p-4">

                                <div class="text-center w-75 m-auto">
                                    <p class="text-muted"><img src="img/logo/logo-v2.png" width="200"></p>
                                </div>

                                <?= $this->Form->create() ?>
                                <fieldset>
                                    <div class="form-group mb-3">
                                        <label for="mobile">Mobile</label>
                                        <input class="form-control" type="number" name="mobile" id="mobile" required="" placeholder="Enter your email">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" name="password" required="" id="password" placeholder="Enter your password">
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                                    </div>
                                </fieldset>
                                <?= $this->Form->end() ?>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->


        <footer class="footer footer-alt">
            2019 &copy; OrderPang by <a href="" class="text-muted">FDTech</a> | V.1.0
        </footer>

        <?=$this->Html->script('/css/assets/js/vendor.min.js')?>

        <?=$this->Html->script('/css/assets/js/app.min.js')?>

    </body>
</html>