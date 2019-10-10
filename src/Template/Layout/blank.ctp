<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Register - Order-Pang</title>
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
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    </head>
    <style>
        .unactive{ border-color: #dd0000; }
    </style>
    <body>
        <div id="preloader">
            <div id="status">
                <div class="bouncingLoader"><div ></div><div ></div><div ></div></div>
            </div>
        </div>
        <div id="app">
            <div class="account-pages mt-5 mb-5">
                <div class="container">

                   <?= $this->fetch('content') ?>
                </div>
                <!-- end container -->
            </div>
            <!-- end page -->
        </div>

        

        <?=$this->element('Layouts/default_footer_blank_layout')?>

        <?= $this->Html->script('/css/assets/js/vendor.min.js') ?>

        <?= $this->Html->script('/css/assets/js/app.js') ?>

    </body>
</html>