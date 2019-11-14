<div id="app">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card-box">
                <div id="createline">
                    <div class="row">
                        <div class="col-12">
                            <div v-if="addProducts == false" class="row">
                                <div class="col-12 text-right">
                                    <button class="btn btn-primary" type="submit" @click="createline(showCreate)"> สร้างรายการรับสินค้าใหม่</button>
                                </div>
                            </div>
                            <div v-if="showCreate" class="slide-show-create">
                                <div class="row" style="margin-top: 20px;">
                                    <div class="col-4">
                                        <label>ต้นทางสินค้า (Partner) <span style="color: #dd0000;">{{errorMsg.bpartner}}</span></label>
                                        <div v-if="bpartners == 0" class="no-content">ไม่มีต้นทางสินค้า <button class="a-button" style="color: #dd0000;" @click="showBpartner = true"><u>#เพิ่มต้นทางสินค้า</u></button></div>
                                        <div v-else>
                                            <select id="bpartner" v-bind:class="{nodata: validate.bpartner}" class="form-control">
                                                <option style="color: #ddd;" value="">เลือกต้นทางสินค้า</option>
                                                <option
                                                    v-for="(bpartner, index) in bpartners"
                                                    v-bind:key="bpartner.index"
                                                    v-bind:value="bpartner.id">{{bpartner.company}}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label>รับเข้าคลังสินค้า (Warehouse) <span style="color: #dd0000;">{{errorMsg.warehouse}}</span></label>
                                        <div v-if="warehouses == 0" class="no-content">ไม่มีคลังสินค้า <button class="a-button" style="color: #dd0000;" @click="showCreateWarehouse = true"><u>#สร้างคลังสินค้า</u></button></div>
                                        <div v-else>
                                            <select id="warehouse" v-bind:class="{nodata: validate.warehouse}" class="form-control">
                                                <option style="color: #ddd;" value="">เลือกคลังสินค้า</option>
                                                <option
                                                    v-for="(warehouse, index) in warehouses"
                                                    v-bind:key="warehouse.index"
                                                    v-bind:value="warehouse.id">{{warehouse.name}}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label>วันที่รับสินค้า</label>
                                        <input type="text" class="form-control" id="docdate" value="<?php echo date('d-m-Y') ?>" readonly>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 20px;">
                                    <div class="col-4">
                                        <label>ผู้ทำรายการ</label>
                                        <select v-model="userlogin" id="user" class="form-control">
                                            <option
                                                v-for="(user, index) in users"
                                                v-bind:key="user.index"
                                                v-bind:value="user.id">{{user.name}}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-8">
                                        <label>รายละเอียด / หมายเหตุ</label>
                                        <textarea v-model="description" class="form-control" rows="4" id="description"></textarea>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 20px;">
                                    <div class="col-3"></div>
                                    <div class="col-3 text-center"><button class="btn btn-success btn-block" @click="checkNullWH()"><i class="mdi mdi-content-save"></i> บันทึก</button></div>
                                    <div class="col-3 text-center"><button class="btn btn-warning btn-block" @click="createline(showCreate)"><i class="mdi mdi-close-box"></i> ยกเลิก</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div v-if="addProducts == false" class="col-12">
                            <h4>รายการรับสินค้า</h4>
                            <table style="width: 100%;">
                                <thead style="border-bottom: 1px solid #333; margin-bottom: 10px;">
                                    <tr>
                                        <th class="text-center" style="width: 5%;">#</th>
                                        <th style="width: 30%;">รายการ</th>
                                        <th class="text-center" style="width: 20%">ผู้ทำรายการ</th>
                                        <th class="text-center" style="width: 15%;">วันที่</th>
                                        <th class="text-center" style="width: 15%;">สถานะ</th>
                                        <th class="text-center" style="width: 15%;">การจัดการ</th>
                                    </tr>
                                </thead>
                                <tbody id="show-shipments">
                                    <tr v-if='loadingShipment'><td colspan="6" class="text-center"><img src="img/loading_v2.gif"></td></tr>
                                    <tr v-else-if='shipments.length == 0'><td colspan="6" class="text-center"><img src="img/loading_v2.gif"></td></tr>
                                    <tr v-else
                                        v-for="(shipment, index) in shipments"
                                        v-bind:key="shipment.index"
                                        class="tr-bottom-line"
                                    >
                                        <td class="text-center">{{index+1}}</td>
                                        <td>{{shipment.company}} <i class="fa fa-arrow-right" style="color: #4fce00;"></i> {{shipment.towarehouse}}</td>
                                        <td class="text-center">{{shipment.user}}</td>
                                        <td class="text-center">{{shipment.date}}</td>
                                        <td class="text-center">
                                            <span v-if="shipment.status == 'DR'" style="color: #333;">ยังไม่เสร็จ</span>
                                            <span v-else-if="shipment.status == 'CO'" style="color: #00dd00;"><strong>เสร็จเรียบร้อย</strong></span>
                                        </td>
                                        <td class="text-center td-padding">
                                            <div style="display: -webkit-inline-box;" v-if="shipment.status == 'DR'">
                                                <button class="btn btn-success btn-sm" type="submit" @click="shipmentLine(shipment.id,shipment.company,shipment.towarehouse,shipment.status,shipment.user,shipment.date,shipment.description)"><i class="mdi mdi-lead-pencil"></i> แก้ไข</button>
                                            </div>
                                            <div style="display: -webkit-inline-box;" v-else-if="shipment.status == 'CO'">
                                                <button class="btn btn-info btn-sm" type="submit" @click="shipmentLine(shipment.id,shipment.company,shipment.towarehouse,shipment.status,shipment.user,shipment.date,shipment.description)"><i class="mdi mdi-lead-pencil"></i> รายละเอียด</button>
                                            </div>
                                            <div style="display: -webkit-inline-box;" v-if="shipment.status == 'DR'">
                                                <button class="btn btn-warning btn-sm" type="submit" @click="shipmentDel(shipment.id,index)"><i class="mdi mdi-delete-forever"></i> ลบ</button>
                                            <div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-else class="col-12">
                            <div style="display: -webkit-inline-box;">
                                <h4 style="margin-right: 10px;"><span v-if="shipmentLines.status == 'DR'">แก้ไข</span><span v-else-if="shipmentLines.status == 'CO'">รายละเอียด</span>รายการรับสินค้า [{{shipmentLines.bpartner}} <i class="fa fa-arrow-right" style="color: #4fce00;"></i> {{shipmentLines.towarehouse}}]</h4>
                                <button v-if="shipmentLines.status == 'DR'" class="btn btn-primary" type="submit" @click="showProductLine = true"> เพิ่มสินค้า</button>
                            </div>
                            <hr/>
                            <div class="row" style="padding: 0 30px;">
                                <div class="col-4">
                                    <strong style="color: #000; font-weight: 700;">ผู้ทำรายการ : </strong>{{shipmentLines.user}}<br/>
                                    <strong style="color: #000; font-weight: 700;">วันที่สร้าง : </strong>{{shipmentLines.date}}
                                </div>
                                <div class="col-8">
                                    <strong style="color: #000; font-weight: 700;">รายละเอียด / หมายเหตุ</strong><br/>
                                    <span v-if="!shipmentLines.description" style="padding-left:20px;">ไม่มีรายละเอียด.....</span>
                                    <span v-else style="padding-left:20px;">{{shipmentLines.description}}</span>
                                </div>
                            </div>
                            <hr/>
                                <table style="width: 100%;">
                                    <thead style="border-bottom: 1px solid #333; margin-bottom: 10px;">
                                        <tr>
                                            <th class="text-center" style="width: 5%;">#</th>
                                            <th style="width: 20%;">รายการสินค้า</th>
                                            <th style="width: 20%;">รายละเอียด</th>
                                            <th class="text-center" style="width: 10%;">จำนวน</th>
                                            <th class="text-center" style="width: 5%"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="show-shipments">
                                        <tr v-if='loadingShipmentLine'><td colspan="5" class="text-center"><img src="img/loading_v2.gif"></td></tr>
                                        <tr v-else-if='loadShipmentLines.length == 0'><td colspan="5" class="text-center">ไม่มีรายการสินค้า...</td></tr>
                                        <tr v-else
                                            v-for="(loadShipmentLine, index) in loadShipmentLines"
                                            v-bind:key="loadShipmentLine.index"
                                            class="tr-bottom-line"
                                        >
                                            <td class="text-center">{{index+1}}</td>
                                            <td>{{loadShipmentLine.product}}</td>
                                            <td>{{loadShipmentLine.description}}</td>
                                            <td class="text-center">{{loadShipmentLine.qty}}</td>
                                            <td v-if="shipmentLines.status == 'DR'" class="text-center">
                                                <button class="btn btn-icon waves-effect waves-light btn-primary m-b-5" title="ลบรายการสินค้า" @click="shipmentLineDel(loadShipmentLine.id,index)"><i class="mdi mdi-delete-forever"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            <hr/>
                            <div v-if="shipmentLines.status == 'DR'" class="row">
                                <div class="col-3"></div>
                                <div class="col-3"><button class="btn btn-success btn-block" @click="confirmCreateShipmentLine(shipmentLines.id)"><i class="mdi mdi-content-save"></i> ยืนยันการรับสินค้า</button></div>
                                <div class="col-3"><button class="btn btn-warning btn-block" @click="backToShipment()"><i class="mdi mdi-close-box"></i> กลับหน้ารายการรับสินค้า</button></div>
                            </div>
                            <div v-else-if="shipmentLines.status == 'CO'" class="row">
                                <div class="col-4"></div>
                                <div class="col-4"><button class="btn btn-warning btn-block" @click="backToShipment()"><i class="mdi mdi-close-box"></i> กลับหน้ารายการรับสินค้า</button></div>
                            </div>
                        </div>

                        <modal v-if="showProductLine" @close="showCreate = false">
                            <h3 slot="header">เพิ่มรายการรับสินค้า</h3>
                            <div slot="body">
                                <div class="row" style="margin-bottom: 20px;">
                                    <div class="col-12">
                                        <label>รายการสินค้า <span style="color: #dd0000;">{{errorMsg.productList}}</span></label>
                                        <select id="products" v-bind:class="{nodata : validate.productList}" class="form-control frm-product-list">
                                            <option style="color: #ddd;" value="">เลือกสินค้า</option>
                                            <option
                                                v-for="(product, index) in products"
                                                v-bind:key="product.index"
                                                v-bind:value="product.id">{{product.name}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 20px;">
                                    <div class="col-12">
                                        <label>จำนวน <span style="color: #dd0000;">{{errorMsg.productQty}}</span></label>
                                        <input v-model="lineCreate.qty" v-bind:class="{nodata : validate.productQty}" class="form-control frm-product-category" type="number" name="qty" id="qty" required="" placeholder="จำนวนสินค้าที่รับเข้ามา">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label>รายละเอียด</label>
                                        <textarea v-model="lineCreate.description" class="form-control frm-product-category" name="description" id="description" rows="6" placeholder="รายละเอียด (ถ้ามี)"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div slot="footer">
                                <button class="btn btn-success" @click="checkNullShipmentLine()"><i class="mdi mdi-content-save"></i> บันทึก</button>
                                <button class="btn btn-warning" @click="closeProductLine()"><i class="mdi mdi-close-box"></i> ยกเลิก</button>
                            </div>
                        </modal>

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
                                                    <option style="color: #eee;" value="">เลือกระดับคู่ค้า</option>
                                                    <option value="Dealer">Dealer (ผู้จัดจำหน่าย)</option>
                                                    <option value="Vendor">Vendor (ผู้รับสินค้า)</option>
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

                        <!-- Create Warehouse -->
                        <modal v-if="showCreateWarehouse" @close="showCreateWarehouse = false">
                            <h3 slot="header">เพิ่มคลังสินค้า</h3>
                            <div slot="body">
                                <div style="color: #dd0000;">{{duplicateMsg}}{{errorMsg.warehouseName}}</div>
                                <input v-model="warehouse.name" v-bind:class="{nodata : validate.warehouseName}" class="form-control frm-product-category" type="text" id="warehouse_name" placeholder="ชื่อคลังสินค้า">
                                <textarea v-model="warehouse.description" class="form-control frm-product-category" id="warehouse_description" rows="6" placeholder="รายละเอียด (ถ้ามี)"></textarea>
                            </div>
                            <div slot="footer">
                                <button class="btn btn-success" @click="checkNullWarehouse()"><i class="mdi mdi-content-save"></i> บันทึก</button>
                                <button class="btn btn-warning" @click="closeCreateWarehouse()"><i class="mdi mdi-close-box"></i> ยกเลิก</button>
                            </div>
                        </modal>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
label { margin-bottom: 0; }
.unactive { border-color: #dd0000; }
.nodata { border-color: #dd0000; }
</style>

<script>
    const apiUrl = '<?=APIURL?>';
</script>
<?=$this->Html->script('product/goodsReceive.js')?>