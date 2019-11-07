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
                <div id="brands">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 text-left">
                                    <button class="btn btn-primary" type="submit" @click="showCreate = true"> เพิ่มยี่ห้อสินค้า </button>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div v-if="loading" class="col-12 text-center"><img src="img/loading_v2.gif"></div>
                                <div v-else-if="brands.length == 0" class="col-12 text-center">NO Brand...</div>
                                <div v-else
                                    v-for="(brand, index) in brands"
                                    v-bind:key="brand.index"
                                    class="col-6"
                                >
                                    <div class="card org-card">
                                        <div class="card-body org-body-action">
                                            <strong class="header-org">ยี่ห้อสินค้า :</strong> {{brand.name}}<br/>
                                            <strong class="header-org">รายละเอียด :</strong> {{brand.description}}<br/>
                                            <div style="display: -webkit-inline-box;">
                                            <strong class="header-org">สถานะ : </strong>&nbsp;
                                                <div v-if="brand.isactive == 'Y'" style="color: #00dd00;">เปิดใช้งาน</div>
                                                <div v-else style="color: #dd0000;">ปิดใช้งาน</div>
                                            </div><br/>
                                            <hr/>
                                            <div class="row text-center">
                                                <div class="col-6"><button class="btn btn-success btn-block" type="submit" @click="showEdit(brand.id,brand.name,brand.description,brand.isactive)"><i class="mdi mdi-lead-pencil"></i> แก้ไข</button></div>
                                                <div class="col-6"><button class="btn btn-warning btn-block" type="submit" @click="brandDelete(brand.id,brand.name,index)"><i class="mdi mdi-delete-forever"></i> ลบ</button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <modal v-if="showCreate" @close="showCreate = false">
                                <h3 slot="header">เพิ่มยี่ห้อสินค้า</h3>
                                <div slot="body">
                                    <div style="color: #dd0000;">{{nameDuplicate}}</div>
                                    <input v-model="createBrand.name" class="form-control frm-product-category" type="text" name="name" id="name" required="" placeholder="ชื่อยี่ห้อสินค้า">
                                    <textarea v-model="createBrand.description" class="form-control frm-product-category" name="description" id="description" rows="6" placeholder="รายละเอียด (ถ้ามี)"></textarea>
                                    <div class="radio radio-info form-check-inline">
                                        <input v-model="createBrand.isactive" type="radio" id="isactive1" name="isactive" value="Y"><label for="isactive1" style="margin-right: 20px;">เปิดใช้งาน</label>
                                        <input v-model="createBrand.isactive" type="radio" id="isactive2" name="isactive" value="N"><label for="isactive2">ปิดใช้งาน</label>
                                    </div>
                                </div>
                                <div slot="footer">
                                    <button class="btn btn-success" @click="brandCreate()"><i class="mdi mdi-content-save"></i> บันทึก</button>
                                    <button class="btn btn-warning" @click="closeCreate()"><i class="mdi mdi-close-box"></i> ยกเลิก</button>
                                </div>
                            </modal>
                            <modal v-if="showModal" @close="showModal = false">
                                <h3 slot="header">เพิ่มยี่ห้อสินค้า</h3>
                                <div slot="body">
                                    <div style="color: #dd0000;">{{nameDuplicate}}</div>
                                    <input v-model="editBrand.name" class="form-control frm-product-category" type="text" name="name" id="name" required="" placeholder="ชื่อยี่ห้อสินค้า">
                                    <textarea v-model="editBrand.description" class="form-control frm-product-category" name="description" id="description" rows="6" placeholder="รายละเอียด (ถ้ามี)"></textarea>
                                    <div class="radio radio-info form-check-inline">
                                        <input v-model="editBrand.isactive" type="radio" id="isactive1" name="isactive" value="Y"><label for="isactive1" style="margin-right: 20px;">เปิดใช้งาน</label>
                                        <input v-model="editBrand.isactive" type="radio" id="isactive2" name="isactive" value="N"><label for="isactive2">ปิดใช้งาน</label>
                                    </div>
                                </div>
                                <div slot="footer">
                                    <button class="btn btn-success" @click="brandEdit()"><i class="mdi mdi-content-save"></i> บันทึก</button>
                                    <button class="btn btn-warning" @click="closeEdit()"><i class="mdi mdi-close-box"></i> ยกเลิก</button>
                                </div>
                            </modal>
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
<?=$this->Html->script('product/brand.js')?>