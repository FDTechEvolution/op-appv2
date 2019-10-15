<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-5">
        <?= $this->Flash->render() ?>

        <div class="card">

            <div class="card-body p-4">

                <div class="text-center m-auto">
                    <p class="text-muted"><?= $this->Html->image('logo/logo-v2-01.png', ['class' => 'w-100']) ?></p>
                </div>

                <?= $this->Form->create() ?>
                <fieldset>
                    <div class="form-group mb-3">
                        <label for="mobile">หมายเลขโทรศัพท์</label>
                        <input class="form-control" type="number" name="mobile" id="mobile" required="" placeholder="หมายเลขโทรศัพท์">
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" required="" id="password" placeholder="รหัสผ่าน">
                    </div>

                    <div class="form-group mb-0 text-center">
                        <button class="btn btn-primary btn-block" type="submit"> เข้าสู่ระบบ </button>
                    </div>
                </fieldset>
                <?= $this->Form->end() ?>

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p> 
                   
                            <?=$this->Html->link('หรือว่าคุณกำลังลืมรหัสผ่าน?',['controller'=>'recoverpw'],['class'=>'text-muted ml-1'])?>
                        </p>
                        <p class="text-muted">คุณยังไม่มีบัญชีผู้ใช้งาน? 
                            
                            <?=$this->Html->link('สมัครเลย',['controller'=>'register'],['class'=>'text-primary font-weight-medium ml-1'])?>
                        </p>
                    </div> <!-- end col -->
                </div>

            </div> <!-- end card-body -->
        </div>
        <!-- end card -->


    </div> <!-- end col -->
</div>