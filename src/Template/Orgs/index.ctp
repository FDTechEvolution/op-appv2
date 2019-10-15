<div id="app">
    <div class="row">
        <div class="col-xl-3 col-lg-4">
            <div class="text-center card-box">
                <div id="users" class="member-card">
                    <div class="">
                        <h5 class="m-b-5">{{name}}</h5>
                        <p class="text-muted">Admin</p>
                    </div>

                    <button type="button" class="btn btn-success btn-sm w-sm waves-effect m-t-10 waves-light"><i class="fa fa-edit"></i> แก้ไข</button>
                    <button type="button" class="btn btn-danger btn-sm w-sm waves-effect m-t-10 waves-light"><i class="mdi mdi-account-plus"></i> เพิ่ม Admin</button>

                    <div class="text-center m-t-40" style="margin-top: 20px;">
                        <p style="margin-bottom: 0;" class="text-muted font-13"><strong>Mobile :</strong> <span class="m-l-15">{{mobile}}</span></p>
                        <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15">{{email}}</span></p>
                    </div>

                    <button type="button" class="btn btn-warning btn-sm w-sm waves-effect m-t-10 waves-light"><i class="mdi mdi-logout"></i> ออกจากระบบ</button>
                </div>
            </div> <!-- end card-box -->
        </div>
        <div class="col-xl-9 col-lg-8">
            <div class="card-box">
                <div id="orgs">
                    <div class="row">
                    <div v-if="loading" class="col-12 text-center"><img src="img/loading_v2.gif"></div>
                    <div v-else-if="orgs.length == 0" class="col-12">
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
                    <div v-else-if="editorg == false"
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
                                    <div class="col-4"><button class="btn btn-success btn-block" type="submit" @click="showEdit(org.id,org.name,org.code,org.isactive)"><i class="mdi mdi-lead-pencil"></i> แก้ไข</button></div>
                                    <div class="col-4"><button class="btn btn-warning btn-block" type="submit" @click="delOrg(org.id)"><i class="mdi mdi-delete-forever"></i> ลบ</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else-if="editorg == true" class="col-6">
                        <div class="card edit-active">
                            <div class="card-body org-body-action">
                                <div class="row">
                                    <div class="col-3" style="padding-top: 6px;"><strong class="header-org">บริษัท/ร้าน :</strong></div>
                                    <div class="col-9"><input v-model="editname" type="text" class="form-control frm-orgs" required=""></div>
                                </div>
                                <div class="row">
                                    <div class="col-3" style="padding-top: 6px;"><strong class="header-org">รหัส :</strong></div>
                                    <div class="col-9"><input v-model="editcode" class="form-control frm-orgs" type="text" required=""></div>
                                </div>
                                <div style="display: -webkit-inline-box; margin-top: 10px;">
                                    <div class="radio radio-info form-check-inline">
                                        <input v-model="active" type="radio" id="isactive1" name="isactive" value="Y"><label for="isactive1" style="margin-right: 20px;">เปิดใช้งาน</label>
                                        <input v-model="active" type="radio" id="isactive2" name="isactive" value="N"><label for="isactive2">ปิดใช้งาน</label>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row text-center">
                                    <div class="col-4"></div>
                                    <div class="col-4"><button class="btn btn-success btn-block" @click="editOrg()"><i class="mdi mdi-content-save"></i> Save</button></div>
                                    <div class="col-4"><button class="btn btn-warning btn-block" @click="editorg = false"><i class="mdi mdi-close-box"></i> Cancel</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <modal v-if="showModal" @close="showModal = false">
                        <h3 slot="header">แก้ไขรายการ {{editname}}</h3>
                        <div slot="body">
                            <strong>แก้ไขชื่อบริษัท/ร้าน :</strong> <input v-model="editname" type="text" class="form-control" required=""><br/>
                            <strong>แก้ไขรหัส :</strong> <input v-model="editcode" class="form-control" type="text" required=""><br/>
                            <div class="radio radio-info form-check-inline">
                                <input v-model="active" type="radio" id="isactive1" name="isactive" value="Y"><label for="isactive1" style="margin-right: 20px;">เปิดใช้งาน</label>
                                <input v-model="active" type="radio" id="isactive2" name="isactive" value="N"><label for="isactive2">ปิดใช้งาน</label>
                            </div>
                        </div>
                        <div slot="footer">
                            <button class="btn btn-success" @click="editOrg()"><i class="mdi mdi-content-save"></i> Save</button>
                            <button class="btn btn-warning" @click="showModal = false"><i class="mdi mdi-close-box"></i> Close</button>
                        </div>
                    </modal>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/x-template" id="modal-template">
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">

          <div class="modal-header">
            <slot name="header"></slot>
          </div>

          <div class="modal-body">
            <slot name="body"></slot>
          </div>

          <div class="modal-footer">
            <slot name="footer"></slot>
          </div>
        </div>
      </div>
    </div>
  </transition>
</script>

<script>
    const apiUrl = '<?=APIURL?>';
</script>
<?=$this->Html->script('orgs/orgs.js')?>