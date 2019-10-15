<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="text-center m-auto">
            <p class="text-muted"><?=$this->Html->image('logo/logo-v2-01.png',['class'=>'w-100'])?></p>
        </div>
        <div class="card">
            <div class="card-body p-4">
                <?= $this->Form->create('register', ['url' => ['controller' => 'register'], 'id' => 'frmregis', 'class' => 'form-horizontal', 'role' => 'form', '@submit' => 'checkForm']) ?>
                <fieldset>
                    <div class="form-group mb-3">
                        <label for="mobile">ชื่อ - นามสกุล</label>
                        <input class="form-control" type="text" name="name" id="name" required="" placeholder="ชื่อ - นามสกุล">
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
<script>
    const apiUrl = '<?=APIURL?>';
</script>
<?=$this->Html->script('register/register.js')?>