<div id="app">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card-box">
                <div id="bpartner-distributor">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 text-left">
                                    <button class="btn btn-primary" type="submit" @click="showBpartner = true"> เพิ่ม Partner </button>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div v-if="loading.bpartner" class="col-12 text-center"><img src="../img/loading_v2.gif"></div>
                                <div v-else-if="bpartners.length == 0" class="col-12 text-center">NO Partner...</div>
                                <div v-else
                                    v-for="(bpartner, index) in bpartners"
                                    v-bind:key="bpartner.index"
                                    class="col-4"
                                >
                                    <div class="card org-card">
                                        <div class="card-body org-body-action">
                                            <h3 class="text-center no-margin">{{bpartner.company}}</h3>
                                            <p class="text-center size-12 no-margin"><strong class="header-bpartner">ระดับ :</strong> <span v-if="bpartner.level == 'Dealer'">ผู้จัดจำหน่าย</span> <p>
                                            <hr style="margin: 12px 0;">
                                            <strong class="header-bpartner">ผู้ติดต่อ :</strong> {{bpartner.name}} ({{bpartner.mobile}})<br/>
                                            <strong class="header-bpartner">รายละเอียด :</strong> <span v-if="!bpartner.description"> No Description... </span>{{bpartner.description}}<br/>
                                            <div style="display: -webkit-inline-box;">
                                            <strong class="header-bpartner">สถานะ : </strong>&nbsp;
                                                <div v-if="bpartner.isactive == 'Y'" style="color: #00dd00;">เปิดใช้งาน</div>
                                                <div v-else style="color: #dd0000;">ปิดใช้งาน</div>
                                            </div><br/>
                                            <strong class="header-bpartner">ที่อยู่ :</strong> <button class="a-button" @click="showModalAddress(bpartner.id,bpartner.company)"><strong><u>ดูรายการที่อยู่</u></strong></button><br/>
                                            <hr/>
                                            <div class="row text-center">
                                                <div class="col-6"><button class="btn btn-success btn-block" type="submit" @click="showEditBpartner(bpartner.id,bpartner.company,bpartner.name,bpartner.mobile,bpartner.description,bpartner.isactive)"><i class="mdi mdi-lead-pencil"></i> แก้ไข</button></div>
                                                <div class="col-6"><button class="btn btn-warning btn-block" type="submit" @click="confirmDelBpartner(bpartner.id,bpartner.company,bpartner.name,index)"><i class="mdi mdi-delete-forever"></i> ลบ</button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Create Bpartner -->
                    <create-bpartner v-if="showBpartner" @close="showBpartner = false">
                        <h3 slot="header">เพิ่มรายการ Business Partner</h3>
                        <div slot="body">
                            <div class="row">
                                <div class="col-6" style="border-right: 1px solid #ccc;">
                                    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col-12">
                                            <label>บริษัท <span style="color: #dd0000;">{{errorMsg.company}}</span></label>
                                            <input v-model="Bpartner.company" v-bind:class="{nodata : validate.company}" class="form-control frm-product-category" type="text" id="bpartner_company" placeholder="ชื่อบริษัทคู่ค้า">
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col-12">
                                            <label>ชื่อผู้ติดต่อ <span style="color: #dd0000;">{{errorMsg.name}}</span></label>
                                            <input v-model="Bpartner.name" v-bind:class="{nodata : validate.name}" class="form-control frm-product-category" type="text" id="bpartner_name" placeholder="ชื่อผู้ติดต่อโดยตรง">
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col-12">
                                            <label>โทรศัพท์ <span style="color: #dd0000;">{{errorMsg.mobile}}</span></label>
                                            <input v-model="Bpartner.mobile" v-bind:class="{nodata : validate.mobile}" class="form-control frm-product-category" type="number" id="bpartner_mobile" placeholder="ใส่แค่ตัวเลขเท่านั้น">
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col-12">
                                            <label>ระดับ <span style="color: #dd0000;">{{errorMsg.level}}</span></label>
                                            <select id="level" v-bind:class="{nodata : validate.level}" class="form-control frm-product-list">
                                                <option value="Dealer">Distributor (ตัวแทนจำหน่าย)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <label>รายละเอียด</label>
                                            <textarea v-model="Bpartner.description" class="form-control frm-product-category" id="bpartner_description" rows="6" placeholder="รายละเอียด (ถ้ามี)"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col-12">
                                            <label>เลขที่อยู่ <span style="color: #dd0000;">{{errorMsg.line1}}</span></label>
                                            <input v-model="Bpartner.line1" v-bind:class="{nodata : validate.line1}" class="form-control frm-product-category" type="text" id="bpartner_line1" placeholder="เลขที่ / หมู่บ้าน / อาคาร">
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col-12">
                                            <label>แขวง / ตำบล <span style="color: #dd0000;">{{errorMsg.subdistrict}}</span></label>
                                            <input v-model="Bpartner.subdistrict" v-bind:class="{nodata : validate.subdistrict}" class="form-control frm-product-category" type="text" id="bpartner_subdistrict" placeholder="">
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col-12">
                                            <label>เขต / อำเภอ <span style="color: #dd0000;">{{errorMsg.district}}</span></label>
                                            <input v-model="Bpartner.district" v-bind:class="{nodata : validate.district}" class="form-control frm-product-category" type="text" id="bpartner_district" placeholder="">
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col-12">
                                            <label>จังหวัด <span style="color: #dd0000;">{{errorMsg.province}}</span></label>
                                            <input v-model="Bpartner.province" v-bind:class="{nodata : validate.province}" class="form-control frm-product-category" type="text" id="bpartner_province" placeholder="">
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col-12">
                                            <label>รหัสไปรษณีย์ <span style="color: #dd0000;">{{errorMsg.zipcode}}</span></label>
                                            <input v-model="Bpartner.zipcode" v-bind:class="{nodata : validate.zipcode}" class="form-control frm-product-category" type="number" id="bpartner_zipcode" placeholder="ใส่แค่ตัวเลขเท่านั้น">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <label>รายละเอียด</label>
                                            <textarea v-model="Bpartner.addressDescription" class="form-control frm-product-category" id="bpartner_address_description" rows="6" placeholder="รายละเอียด (ถ้ามี)"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div slot="footer">
                            <button class="btn btn-success" @click="checkNullBpartner()"><i class="mdi mdi-content-save"></i> บันทึก</button>
                            <button class="btn btn-warning" @click="closeBpartner()"><i class="mdi mdi-close-box"></i> ยกเลิก</button>
                        </div>
                    </create-bpartner>

                    <!-- Edit Bpartner -->
                    <modal-bpartner v-if="showModalEditBpartner" @close="showModalEditBpartner = false">
                        <h3 slot="header">เพิ่มรายการ Business Partner</h3>
                        <div slot="body">
                            <div class="row">
                                <div class="col-12" style="border-right: 1px solid #ccc;">
                                    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col-12">
                                            <label>บริษัท <span style="color: #dd0000;">{{errorMsg.company}}</span></label>
                                            <input v-model="editBpartner.company" v-bind:class="{nodata : validate.company}" class="form-control frm-product-category" type="text" id="bpartner_company" placeholder="ชื่อบริษัทคู่ค้า">
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col-12">
                                            <label>ชื่อผู้ติดต่อ <span style="color: #dd0000;">{{errorMsg.name}}</span></label>
                                            <input v-model="editBpartner.name" v-bind:class="{nodata : validate.name}" class="form-control frm-product-category" type="text" id="bpartner_name" placeholder="ชื่อผู้ติดต่อโดยตรง">
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col-12">
                                            <label>โทรศัพท์ <span style="color: #dd0000;">{{errorMsg.mobile}}</span></label>
                                            <input v-model="editBpartner.mobile" v-bind:class="{nodata : validate.mobile}" class="form-control frm-product-category" type="number" id="bpartner_mobile" placeholder="ใส่แค่ตัวเลขเท่านั้น">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <label>รายละเอียด</label>
                                            <textarea v-model="editBpartner.description" class="form-control frm-product-category" id="bpartner_description" rows="6" placeholder="รายละเอียด (ถ้ามี)"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="radio radio-info form-check-inline">
                                                <input v-model="editBpartner.isactive" type="radio" id="isactive1" name="isactive" value="Y"><label for="isactive1" style="margin-right: 20px;">เปิดใช้งาน</label>
                                                <input v-model="editBpartner.isactive" type="radio" id="isactive2" name="isactive" value="N"><label for="isactive2">ปิดใช้งาน</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div slot="footer">
                            <button class="btn btn-success" @click="checkNullEditBpartner()"><i class="mdi mdi-content-save"></i> บันทึก</button>
                            <button class="btn btn-warning" @click="showModalEditBpartner = false"><i class="mdi mdi-close-box"></i> ยกเลิก</button>
                        </div>
                    </modal-bpartner>

                    <!-- Delete Bpartner -->
                    <modal-bpartner v-if="showDeleteBpartner" @close="showDeleteBpartner = false">
                        <h3 slot="header">ลบ {{delBpartner.company}}</h3>
                        <div slot="body">
                            <div class="row">
                                <div class="col-12 text-center"><img src="../img/Recycle_Bin.png" width="60"></div><br/>
                                <div class="col-12 text-center" style="color: #dd0000;">ยืนยันการลบ Partner {{delBpartner.name}} นี้?</div>
                            </div>
                        </div>
                        <div slot="footer">
                            <button class="btn btn-success" @click="bpartnerDelete(delBpartner.id,delBpartner.index)"><i class="mdi mdi-content-save"></i> ยืนยัน</button>
                            <button class="btn btn-warning" @click="showDeleteBpartner = false"><i class="mdi mdi-close-box"></i> ยกเลิก</button>
                        </div>
                    </modal-bpartner>

                    <!-- Address Detail -->
                    <address-detail v-if="showAddress" @close="showAddress = false">
                        <h3 slot="header">รายการที่อยู่ {{addressCompany}} <button class="btn btn-primary" type="submit" @click="createAddress()"> เพิ่มที่อยู่ Partner </button></h3>
                        <div slot="body">
                            <div class="row">
                                <table class="col-12" style="width: 100%;">
                                    <tbody>
                                        <tr v-if="loading.address"><td colspan="5" class="text-center"><img src="../img/loading_v2.gif"></td></tr>
                                        <tr v-else
                                            v-for="(address, index) in addresses"
                                            v-bind:key="address.index"
                                            class="tr-bottom-line"
                                        >
                                            <td class="text-center" style="padding: 10px 0;"><strong style="color: #333; font-weight: 600;">{{index+1}}.</strong></td>
                                            <td style="width: 70%;">{{address.Addresses.line1}} ต.{{address.Addresses.subdistrict}} อ.{{address.Addresses.district}} จ.{{address.Addresses.province}} {{address.Addresses.zipcode}}</td>
                                            <td class="text-right">
                                                <button class="btn btn-success btn-sm" style="margin-right: 6px;" type="submit" @click="showEditAddress(address.Addresses.id,address.Addresses.line1,address.Addresses.subdistrict,address.Addresses.district,address.Addresses.province,address.Addresses.zipcode,address.Addresses.description)"><i class="mdi mdi-lead-pencil"></i> แก้ไข</button></div>
                                                <button class="btn btn-warning btn-sm" type="submit" @click="delleteAddress(address.Addresses.id,address.Addresses.line1,address.Addresses.subdistrict,address.Addresses.district,address.Addresses.province,address.Addresses.zipcode,index)"><i class="mdi mdi-delete-forever"></i> ลบ</button></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div slot="footer">
                            <button class="btn btn-warning" @click="closeAddress()"><i class="mdi mdi-close-box"></i> ปิด</button>
                        </div>
                    </address-detail>

                    <!-- Create Address -->
                    <modal-bpartner v-if="showCreateAddress" @close="showCreateAddress = false">
                        <h3 slot="header">เพิ่มรายการที่อยู่ Partner</h3>
                        <div slot="body">
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-12">
                                    <label>เลขที่อยู่ <span style="color: #dd0000;">{{errorMsg.line1}}</span></label>
                                    <input v-model="Address.line1" v-bind:class="{nodata : validate.line1}" class="form-control frm-product-category" type="text" id="bpartner_line1" placeholder="เลขที่ / หมู่บ้าน / อาคาร">
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-12">
                                    <label>แขวง / ตำบล <span style="color: #dd0000;">{{errorMsg.subdistrict}}</span></label>
                                    <input v-model="Address.subdistrict" v-bind:class="{nodata : validate.subdistrict}" class="form-control frm-product-category" type="text" id="bpartner_subdistrict" placeholder="">
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-12">
                                    <label>เขต / อำเภอ <span style="color: #dd0000;">{{errorMsg.district}}</span></label>
                                    <input v-model="Address.district" v-bind:class="{nodata : validate.district}" class="form-control frm-product-category" type="text" id="bpartner_district" placeholder="">
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-12">
                                    <label>จังหวัด <span style="color: #dd0000;">{{errorMsg.province}}</span></label>
                                    <input v-model="Address.province" v-bind:class="{nodata : validate.province}" class="form-control frm-product-category" type="text" id="bpartner_province" placeholder="">
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-12">
                                    <label>รหัสไปรษณีย์ <span style="color: #dd0000;">{{errorMsg.zipcode}}</span></label>
                                    <input v-model="Address.zipcode" v-bind:class="{nodata : validate.zipcode}" class="form-control frm-product-category" type="number" id="bpartner_zipcode" placeholder="ใส่แค่ตัวเลขเท่านั้น">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label>รายละเอียด</label>
                                    <textarea v-model="Address.addressDescription" class="form-control frm-product-category" id="bpartner_address_description" rows="6" placeholder="รายละเอียด (ถ้ามี)"></textarea>
                                </div>
                            </div>
                        </div>
                        <div slot="footer">
                            <button class="btn btn-success" @click="chkNullAddress()"><i class="mdi mdi-content-save"></i> บันทึก</button>
                            <button class="btn btn-warning" @click="closeCreateAddress()"><i class="mdi mdi-close-box"></i> ยกเลิก</button>
                        </div>
                    </modal-bpartner>

                    <!-- Edit Address -->
                    <modal-bpartner v-if="showModalEditAddress" @close="showModalEditAddress = false">
                        <h3 slot="header">แก้ไขรายการที่อยู่ Partner</h3>
                        <div slot="body">
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-12">
                                    <label>เลขที่อยู่ <span style="color: #dd0000;">{{errorMsg.line1}}</span></label>
                                    <input v-model="editAddress.line1" v-bind:class="{nodata : validate.line1}" class="form-control frm-product-category" type="text" id="bpartner_line1" placeholder="เลขที่ / หมู่บ้าน / อาคาร">
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-12">
                                    <label>แขวง / ตำบล <span style="color: #dd0000;">{{errorMsg.subdistrict}}</span></label>
                                    <input v-model="editAddress.subdistrict" v-bind:class="{nodata : validate.subdistrict}" class="form-control frm-product-category" type="text" id="bpartner_subdistrict" placeholder="">
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-12">
                                    <label>เขต / อำเภอ <span style="color: #dd0000;">{{errorMsg.district}}</span></label>
                                    <input v-model="editAddress.district" v-bind:class="{nodata : validate.district}" class="form-control frm-product-category" type="text" id="bpartner_district" placeholder="">
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-12">
                                    <label>จังหวัด <span style="color: #dd0000;">{{errorMsg.province}}</span></label>
                                    <input v-model="editAddress.province" v-bind:class="{nodata : validate.province}" class="form-control frm-product-category" type="text" id="bpartner_province" placeholder="">
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-12">
                                    <label>รหัสไปรษณีย์ <span style="color: #dd0000;">{{errorMsg.zipcode}}</span></label>
                                    <input v-model="editAddress.zipcode" v-bind:class="{nodata : validate.zipcode}" class="form-control frm-product-category" type="number" id="bpartner_zipcode" placeholder="ใส่แค่ตัวเลขเท่านั้น">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label>รายละเอียด</label>
                                    <textarea v-model="editAddress.addressDescription" class="form-control frm-product-category" id="bpartner_address_description" rows="6" placeholder="รายละเอียด (ถ้ามี)"></textarea>
                                </div>
                            </div>
                        </div>
                        <div slot="footer">
                            <button class="btn btn-success" @click="chkEditAddress(editAddress.id)"><i class="mdi mdi-content-save"></i> บันทึก</button>
                            <button class="btn btn-warning" @click="closeEditAddress()"><i class="mdi mdi-close-box"></i> ยกเลิก</button>
                        </div>
                    </modal-bpartner>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const apiUrl = '<?=APIURL?>';
</script>
<?=$this->Html->script('bpartner/distributor.js')?>