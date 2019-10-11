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
        <?=$this->Html->css('assets/css/bootstrap.min')?>
        <?=$this->Html->css('assets/css/icons.min')?>
        <?=$this->Html->css('assets/css/app.min')?>
        <?=$this->Html->css('assets/css/custom')?>

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
    <div id="app">
        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="text-center w-75 m-auto">
                            <p class="text-muted"><img src="img/logo/logo-v2-01.png" width="300"></p>
                        </div>
                            <div class="card">
                                <div class="card-body p-4">
                                    <?= $this->Form->create('register' , ['url' => ['controller' => 'register', 'action' => 'create'], 'id' => 'frmregis', 'class' => 'form-horizontal', 'role' => 'form', '@submit' => 'checkForm']) ?>
                                    <fieldset>
                                        <div class="form-group mb-3">
                                            <label for="mobile">ชื่อ - นามสกุล</label>
                                            <input v-model="name" class="form-control" type="text" name="name" id="name" required="" placeholder="ชื่อ - นามสกุล">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="mobile">หมายเลขมือถือ</label> <div style="color: #dd0000;">{{mobileduplicate}}</div>
                                            <input v-model="mobile" @keyup="checkmobile()" v-bind:class="{ unactive: mobileclass }" class="form-control" type="number" name="mobile" id="mobile" required="" placeholder="ใส่แค่ตัวเลขเท่านั้น">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="password">รหัสผ่าน</label> <div v-if="password != null" style="color: #dd0000;">{{passshort}}</div>
                                            <input v-model="password" v-bind:class="{ unactive: passwordclass }" class="form-control" type="password" name="password" required="" id="password" placeholder="ต้องมีจำนวนมากกว่า 6 ตัวขึ้นไป">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="password">ยืนยันรหัสผ่านอีกครั้ง</label> <div style="color: #dd0000;">{{passerror}}</div>
                                            <input v-model="confirmpassword" v-bind:class="{ unactive: passwordclass }" class="form-control" type="password" name="confirmpassword" required="" id="confirmpassword" placeholder="กรุณากรอกรหัสผ่านอีกครั้ง">
                                        </div>

                                        <div class="form-group mb-3">
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox-signup" type="checkbox" checked="checked" required="">
                                                <label for="checkbox-signup">
                                                    ยอมรับ <a href="#">ข้อกำหนดและเงื่อนไข</a>
                                                </label>
                                            </div>
                                        </div>
                                        {{mobileduplicate}}
                                        <div class="form-group mb-0 text-center">
                                            <button class="btn btn-primary btn-block" type="submit"> ลงทะเบียน </button>
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
    </div>

<script>
    const apiUrl = 'https://orderpang-service.herokuapp.com'
    new Vue({
        el: '#frmregis',
        data () {
            return {
                name: null,
                mobile: null,
                mobileduplicate: null,
                password: null,
                confirmpassword: null,
                passerror: null,
                passshort: null,
                passwordclass: false,
                mobileclass: false,
                active: false
            }
        },
        mounted () {

        },
        methods: {
            checkForm: function (e) {
                this.checkmobile()
                if(this.password.length < 6){
                    this.passshort = 'รหัสผ่านต้องมีจำนวน 6 ตัวขึ้นไป'
                    this.passwordclass = true
                }else{
                    if (this.password != this.confirmpassword) {
                        this.passerror = 'รหัสผ่านไม่ตรงกัน กรุณาตรวจสอบ!'
                        this.passwordclass = true
                    }else{
                        this.passerror = null
                        this.passwordclass = false
                        if(this.mobileduplicate == null){
                            return true
                        }
                    }
                    this.passshort = null
                    this.passwordclass = false
                }
                e.preventDefault();
            },
            checkmobile () {
                axios.get(apiUrl + 'users/chkmobile/' + this.mobile)
                .then((response) => {
                    let mobilechecked = response.data.result
                    if(!mobilechecked){
                        this.mobileclass = true
                        this.mobileduplicate = 'หมายเลขโทรศัพท์นี้ได้ถูกใช้ไปแล้ว กรุณาเปลี่ยนหมายเลขหรือติดต่อผู้ดูแล...'
                    }else{
                        this.mobileclass = false
                        this.mobileduplicate = null
                    }
                })
            },
            checkpassword () {
                if(this.password.length < 6){
                    this.passshort = 'รหัสผ่านต้องมีจำนวน 6 ตัวขึ้นไป'
                    this.passwordclass = true
                }else{
                    if (this.password != this.confirmpassword) {
                        this.passerror = 'รหัสผ่านไม่ตรงกัน กรุณาตรวจสอบ!'
                        this.passwordclass = true
                    }else{
                        this.passerror = null
                        this.passwordclass = false
                        if(this.mobileduplicate == null){
                            this.userCreate()
                        }
                    }
                    this.passshort = null
                    this.passwordclass = false
                }
            },
            userCreate () {
                axios.post(apiUrl + 'users/create', {
                    name: this.name,
                    mobile: this.mobile,
                    password: this.password
                })
            }
        }
    })
</script>

        <footer class="footer footer-alt">
            2019 &copy; OrderPang by <a href="" class="text-muted">FDTech</a> | V.1.0
        </footer>

        <?=$this->Html->script('/css/assets/js/vendor.min.js')?>

        <?=$this->Html->script('/css/assets/js/app.min.js')?>

    </body>
</html>