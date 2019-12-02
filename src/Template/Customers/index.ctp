<div id="app">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div id="customer" class="card-box">
                <div class="row">
                    <div class="col-12 text-left">
                        <div id="create-product">
                            <button class="btn btn-primary" type="submit" @click="showCreateCustomer()"><i class="mdi mdi-cart-plus"></i> เพิ่มรายการลูกค้า </button>
                       </div>
                    </div>
                </div>
                <hr/>
                <table style="width: 100%;">
                    <thead style="border-bottom: 1px solid #333; margin-bottom: 10px;">
                        <tr>
                            <th class="text-center" style="width: 5%;">#</th>
                            <th style="width: 15%;">ชื่อลูกค้า</th>
                            <th class="text-center" style="width: 10%;">โทรศัพท์</th>
                            <th class="text-center" style="width: 15%;">ที่อยู่</th>
                            <th class="text-center" style="width: 25%;">รายละเอียด</th>
                            <th class="text-center" style="width: 20%;">การจัดการ</th>
                        </tr>
                    </thead>
                    <tbody id="show-products">
                        <tr v-if='loading.customer'><td colspan="6" class="text-center"><img src="img/loading_v2.gif"></td></tr>
                        <tr v-else-if="customers.length == 0" class="text-center"><td colspan="6" class="text-center">NO CUSTOMER...</td></tr>
                        <tr v-else
                            v-for="(customer, index) in customers"
                            v-bind:key="customer.index"
                            class="tr-bottom-line"
                        >
                            <td class="text-center">{{index+1}}.</td>
                            <td>{{customer.name}}</td>
                            <td class="text-center">{{customer.mobile}}</td>
                            <td class="text-center"><a href="#">ดูรายการที่อยู่</a></td>
                            <td class="text-center"><span v-if="!customer.description" style="color: #ccc;">ไม่มีรายละเอียด...</span><span v-else>{{customer.description}}</span></td>
                            <td class="text-center td-padding">
                                <button class="btn btn-success btn-sm" type="submit" @click="showEditCustomer(customer.id,customer.name,customer.mobile,customer.description)"><i class="mdi mdi-lead-pencil"></i> แก้ไข</button>
                                <button class="btn btn-warning btn-sm" type="submit" @click="confirmDeleteCustomer(customer.id,customer.name,index)"><i class="mdi mdi-delete-forever"></i> ลบ</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Create Customer -->
                <create-customer v-if="showCustomerCreate" @close="showCustomerCreate = false">
                    <h3 slot="header">เพิ่มรายการลูกค้า</h3>
                    <div slot="body">
                        <div class="row">
                            <div class="col-6" style="border-right: 1px solid #ccc;">
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-12">
                                        <label>ชื่อ - สกุล ลูกค้า <span style="color: #dd0000;">{{errorMsg.name}}</span></label>
                                        <input v-model="Customer.name" v-bind:class="{nodata : validate.name}" class="form-control frm-product-category" type="text" id="customer_name" placeholder="ชื่อ - สกุล">
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-12">
                                        <label>โทรศัพท์ <span style="color: #dd0000;">{{errorMsg.mobile}}</span></label>
                                        <input v-model="Customer.mobile" v-bind:class="{nodata : validate.mobile}" class="form-control frm-product-category" type="number" id="customer_mobile" placeholder="ใส่แค่ตัวเลขเท่านั้น">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label>รายละเอียด</label>
                                        <textarea v-model="Customer.description" class="form-control frm-product-category" id="customer_description" rows="6" placeholder="รายละเอียด (ถ้ามี)"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-12">
                                        <label>เลขที่อยู่ <span style="color: #dd0000;">{{errorMsg.line1}}</span></label>
                                        <input v-model="Address.line1" v-bind:class="{nodata : validate.line1}" class="form-control frm-product-category" type="text" id="customer_line1" placeholder="เลขที่ / หมู่บ้าน / อาคาร">
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-12">
                                        <label>แขวง / ตำบล <span style="color: #dd0000;">{{errorMsg.subdistrict}}</span></label>
                                        <input v-model="Address.subdistrict" v-bind:class="{nodata : validate.subdistrict}" class="form-control frm-product-category" type="text" id="customer_subdistrict" placeholder="">
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-12">
                                        <label>เขต / อำเภอ <span style="color: #dd0000;">{{errorMsg.district}}</span></label>
                                        <input v-model="Address.district" v-bind:class="{nodata : validate.district}" class="form-control frm-product-category" type="text" id="customer_district" placeholder="">
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-12">
                                        <label>จังหวัด <span style="color: #dd0000;">{{errorMsg.province}}</span></label>
                                        <input v-model="Address.province" v-bind:class="{nodata : validate.province}" class="form-control frm-product-category" type="text" id="customer_province" placeholder="">
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-12">
                                        <label>รหัสไปรษณีย์ <span style="color: #dd0000;">{{errorMsg.zipcode}}</span></label>
                                        <input v-model="Address.zipcode" v-bind:class="{nodata : validate.zipcode}" class="form-control frm-product-category" type="number" id="customer_zipcode" placeholder="ใส่แค่ตัวเลขเท่านั้น">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label>รายละเอียด</label>
                                        <textarea v-model="Address.addressDescription" class="form-control frm-product-category" id="customer_address_description" rows="6" placeholder="รายละเอียด (ถ้ามี)"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div slot="footer">
                        <button class="btn btn-success" @click="chkNullCustomer()"><i class="mdi mdi-content-save"></i> บันทึก</button>
                        <button class="btn btn-warning" @click="closeCreateCustomer()"><i class="mdi mdi-close-box"></i> ยกเลิก</button>
                    </div>
                </create-customer>

                <!-- Edit Customer -->
                <modal-customer v-if="showCustomerEdit" @close="showCustomerEdit = false">
                    <h3 slot="header">แก้ไขรายการลูกค้า</h3>
                    <div slot="body">
                        <div class="row">
                            <div class="col-12" style="border-right: 1px solid #ccc;">
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-12">
                                        <label>ชื่อ - สกุล ลูกค้า <span style="color: #dd0000;">{{errorMsg.name}}</span></label>
                                        <input v-model="editCustomer.name" v-bind:class="{nodata : validate.name}" class="form-control frm-product-category" type="text" id="customer_name" placeholder="ชื่อ - สกุล">
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-12">
                                        <label>โทรศัพท์ <span style="color: #dd0000;">{{errorMsg.mobile}}</span></label>
                                        <input v-model="editCustomer.mobile" v-bind:class="{nodata : validate.mobile}" class="form-control frm-product-category" type="number" id="customer_mobile" placeholder="ใส่แค่ตัวเลขเท่านั้น">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label>รายละเอียด</label>
                                        <textarea v-model="editCustomer.description" class="form-control frm-product-category" id="customer_description" rows="6" placeholder="รายละเอียด (ถ้ามี)"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div slot="footer">
                        <button class="btn btn-success" @click="chkNullEditCustomer()"><i class="mdi mdi-content-save"></i> บันทึก</button>
                        <button class="btn btn-warning" @click="closeEditCustomer()"><i class="mdi mdi-close-box"></i> ยกเลิก</button>
                    </div>
                </modal-customer>

                <!-- Delete Customer -->
                <modal-customer v-if="showConfirmDeleteCustomer" @close="showConfirmDeleteCustomer = false">
                    <h3 slot="header">ลบลูกค้า {{delCustomer.name}}</h3>
                    <div slot="body">
                        <div class="row">
                            <div class="col-12 text-center" style="margin-bottom: 20px;"><img src="img/Recycle_Bin.png" width="60"></div>
                            <div class="col-12 text-center" style="color: #dd0000;">ยืนยันการลบลูกค้า {{delCustomer.name}} นี้?</div>
                        </div>
                    </div>
                    <div slot="footer">
                        <button class="btn btn-success" @click="deleteCustomer(delCustomer.id,delCustomer.index)"><i class="mdi mdi-content-save"></i> ยืนยัน</button>
                        <button class="btn btn-warning" @click="showConfirmDeleteCustomer = false"><i class="mdi mdi-close-box"></i> ยกเลิก</button>
                    </div>
                </modal-customer>
            </div>
        </div>
    </div>
</div>

<script>
    const apiUrl = '<?=APIURL?>';
</script>
<?=$this->Html->script('customer/customer.js')?>