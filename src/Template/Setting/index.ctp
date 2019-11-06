<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="header-title mb-4">ตั้งค่าระบบ</h4>

            <ul class="nav nav-tabs nav-bordered nav-justified">
                <li class="nav-item">
                    <a href="#home-b2" data-toggle="tab" aria-expanded="true" class="nav-link active">
                        <span class="d-inline-block d-sm-none"><i class="fas fa-home"></i></span>
                        <span class="d-none d-sm-inline-block">ทั่วไป</span> 
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#profile-b2" data-toggle="tab" aria-expanded="false" class="nav-link ">
                        <span class="d-inline-block d-sm-none"><i class="far fa-user"></i></span>
                        <span class="d-none d-sm-inline-block">Org</span> 
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#messages-b2" data-toggle="tab" aria-expanded="false" class="nav-link">
                        <span class="d-inline-block d-sm-none"><i class="far fa-envelope"></i></span>
                        <span class="d-none d-sm-inline-block">Messages</span>  
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#settings-b2" data-toggle="tab" aria-expanded="false" class="nav-link">
                        <span class="d-inline-block d-sm-none"><i class="fas fa-cog"></i></span>
                        <span class="d-none d-sm-inline-block">Settings</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="home-b2">
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                    <p class="mb-0">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                </div>
                <div class="tab-pane " id="profile-b2">
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
                                    <div class="col-3">
                                        <input v-model="code" class="form-control" type="text" name="code" id="code" required="" placeholder="รหัส">
                                    </div>
                                </div><br/>
                                <div class="row">
                                    <div class="col-6">
                                        <textarea v-model="address" class="form-control" rows="5" cols="10" name="address" id="address" required="" placeholder="ที่อยู่"></textarea>
                                    </div>
                                </div><br/>
                                <div class="row">
                                    <div class="col-2"></div>
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
                                        <div class="row">
                                            <div class="col-5">
                                                <strong class="header-org">บริษัท/ร้าน :</strong> {{org.name}}<br/>
                                                <strong class="header-org">รหัส :</strong> {{org.code}}<br/>
                                                <div style="display: -webkit-inline-box;">
                                                <strong class="header-org">สถานะ : </strong>&nbsp;
                                                    <div v-if="org.isactive == 'Y'" style="color: #00dd00;">เปิดใช้งาน</div>
                                                    <div v-else style="color: #dd0000;">ปิดใช้งาน</div>
                                                </div><br/>
                                            </div>
                                            <div class="col-7" style="padding: 10px; border: 1px solid #eee; border-radius: 3px;">
                                                {{org.address}}
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="row text-center">
                                            <div class="col-4"><a class="btn btn-info btn-block" href="#"><i class="mdi mdi-eye"></i> รายละเอียด</a></div>
                                            <div class="col-4"><button class="btn btn-success btn-block" type="submit" @click="showEdit(org.id,org.name,org.code,org.address,org.isactive)"><i class="mdi mdi-lead-pencil"></i> แก้ไข</button></div>
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
                                    <strong>แก้ไขที่อยู่ :</strong> <textarea v-model="editaddress" class="form-control" rows="4" required=""></textarea><br/>
                                    <div class="radio radio-info form-check-inline">
                                        <input v-model="active" type="radio" id="isactive1" name="isactive" value="Y"><label for="isactive1" style="margin-right: 20px;">เปิดใช้งาน</label>
                                        <input v-model="active" type="radio" id="isactive2" name="isactive" value="N"><label for="isactive2">ปิดใช้งาน</label>
                                    </div>
                                </div>
                                <div slot="footer">
                                    <button class="btn btn-success" @click="editOrg()"><i class="mdi mdi-content-save"></i> บันทึก</button>
                                    <button class="btn btn-warning" @click="showModal = false"><i class="mdi mdi-close-box"></i> ยกเลิก</button>
                                </div>
                            </modal>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="tab-pane" id="messages-b2">
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                    <p class="mb-0">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                </div>
                <div class="tab-pane" id="settings-b2">
                    <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                    <p class="mb-0">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
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