<div id="app">
    <div class="row">
        <div class="col-xl-3 col-lg-4">
            <div class="text-center card-box">
                <div class="member-card">
                    <div class="">
                        <h5 class="m-b-5">Mark McKnight</h5>
                        <p class="text-muted">Admin</p>
                    </div>

                    <button type="button" class="btn btn-success btn-sm w-sm waves-effect m-t-10 waves-light"><i class="fa fa-edit"></i> แก้ไข</button>
                    <button type="button" class="btn btn-danger btn-sm w-sm waves-effect m-t-10 waves-light"><i class="mdi mdi-account-plus"></i> เพิ่ม Admin</button>

                    <div class="text-center m-t-40" style="margin-top: 20px;">
                        <p style="margin-bottom: 0;" class="text-muted font-13"><strong>Mobile :</strong> <span class="m-l-15">(123) 123 1234</span></p>
                        <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15">coderthemes@gmail.com</span></p>
                    </div>
                </div>
            </div> <!-- end card-box -->
        </div>
        <div class="col-xl-9 col-lg-8">
            <div class="card-box">
                <div id="orgs">
                    <div class="row">
                    <div class="col-12">
                        เพิ่มรายการบริษัท / ร้าน
                        <div class="row">
                            <div class="col-3">
                                <input v-model="name" class="form-control" type="text" name="name" id="name" required="" placeholder="ชื่อ">
                            </div>
                            <div class="col-2">
                                <input v-model="code" class="form-control" type="text" name="code" id="code" required="" placeholder="รหัส">
                            </div>
                            <div class="col-2">
                                <button class="btn btn-primary btn-block" type="submit" @click="createOrg()"> ลงทะเบียน </button>
                            </div>
                        </div>
                        <hr/>
                    </div>
                    <div v-if="loading" class="col-12 text-center"><img src="img/loading_v2.gif"></div>
                    <div v-else
                        v-for="(org, index) in orgs"
                        v-bind:key="org.index"
                        class="col-6"
                    >
                        <div class="card org-card">
                            <div class="card-body org-body-action">
                                <strong class="header-org">บริษัท/ร้าน :</strong> {{org.name}}<br/>
                                <strong class="header-org">รหัส :</strong> {{org.code}}<br/>
                                <div style="display: -webkit-inline-box;">
                                <strong class="header-org">สถานะ : </strong>&nbsp;
                                    <div v-if="org.isactive == 'Y'" style="color: #00dd00;">เปิดใช้งาน</div>
                                    <div v-else style="color: #dd0000;">ปิดใช้งาน</div>
                                </div><br/>
                                <hr/>
                                <div class="row text-center">
                                    <div class="col-4"><a class="btn btn-info btn-block" href="#"><i class="mdi mdi-eye"></i> รายละเอียด</a></div>
                                    <div class="col-4"><a class="btn btn-success btn-block" href="#"><i class="mdi mdi-lead-pencil"></i> แก้ไข</a></div>
                                    <div class="col-4"><button class="btn btn-warning btn-block" type="submit" @click="delOrg(org.id)"><i class="mdi mdi-delete-forever"></i> ลบ</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const apiUrl = '<?=APIURL?>';
</script>
<?=$this->Html->script('orgs/orgs.js')?>