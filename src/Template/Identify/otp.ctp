<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="text-center w-75 m-auto">
            <p class="text-muted">
                
                <?=$this->Html->image('logo/logo-v2-01.png',['class'=>'w-100'])?>
            </p>
        </div>
        <div class="card">
            <div class="card-body p-4">
                <?= $this->Form->create('otp', ['id' => 'frm-otp', 'class' => 'form-horizontal', 'role' => 'form']) ?>
                <fieldset>
                  
                    <div class="form-group mb-3">
                        <label for="password">OTP Password</label> <div v-if="password != null" style="color: #dd0000;">{{passshort}}</div>
                        <input v-model="password" v-bind:class="{ unactive: passwordclass }" class="form-control" type="password" name="otppassword" required="" id="otppassword" placeholder="">
                    </div>

                    

                    <div class="form-group mb-0 text-center">
                        <button class="btn btn-primary btn-block" type="submit"> ยืนยัน </button>
                    </div>
                </fieldset>
                <?= $this->Form->end() ?>

            </div> <!-- end card-body -->
        </div>
    </div> <!-- end col -->
</div>
<script>
    const apiUrl = '<?=APIURL?>';
</script>
