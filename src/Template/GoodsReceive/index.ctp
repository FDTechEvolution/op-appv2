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
                <div id="createline">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button class="btn btn-primary" type="submit" @click="createline(showCreate)"> สร้างรายการรับสินค้าใหม่</button>
                                </div>
                            </div>
                            <div v-if="showCreate" class="slide-show-create">
                                <div class="row" style="margin-top: 20px;">
                                    <div class="col-4">
                                        <label>ต้นทางสินค้า</label>
                                        <div v-if="bpartners == 0" class="no-content">ไม่มีต้นทางสินค้า <a href="#">สร้างต้นทางสินค้า</a></div>
                                        <div v-else>
                                            <select id="bpartner" class="form-control">
                                                <option style="color: #ddd;">เลือกต้นทางสินค้า</option>
                                                <option
                                                    v-for="(bpartner, index) in bpartners"
                                                    v-bind:key="bpartner.index"
                                                    v-bind:value="bpartner.id">{{bpartner.company}}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label>รับเข้าคลังสินค้า</label>
                                        <div v-if="warehouses == 0" class="no-content">ไม่มีคลังสินค้า <a href="#">สร้างคลังสินค้า</a></div>
                                        <div v-else>
                                            <select id="warehouse" class="form-control">
                                                <option style="color: #ddd;">เลือกคลังสินค้า</option>
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
                                            <option style="color: #ddd;">เลือกผู้ทำรายการ</option>
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
                                    <div class="col-3 text-center"><button class="btn btn-success btn-block" @click="createWH()"><i class="mdi mdi-content-save"></i> บันทึก</button></div>
                                    <div class="col-3 text-center"><button class="btn btn-warning btn-block" @click="showCreate = false"><i class="mdi mdi-close-box"></i> ยกเลิก</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                <div id="shipment-line" class="row">
                    <div v-if="shipments != 0" class="col-12">
                        <div v-if="addProducts == false">
                            <h4>รายการรับสินค้า</h4>
                            <table style="width: 100%;">
                                <thead style="border-bottom: 1px solid #333; margin-bottom: 10px;">
                                    <tr>
                                        <th class="text-center" style="width: 5%;">#</th>
                                        <th style="width: 20%;">รายการ</th>
                                        <th class="text-center" style="width: 10%;">วันที่</th>
                                        <th class="text-center" style="width: 10%;">สถานะ</th>
                                        <th class="text-center" style="width: 20%;">การจัดการ</th>
                                    </tr>
                                </thead>
                                <tbody id="show-shipments">
                                    <tr v-if='loading'><td colspan="5" class="text-center"><img src="img/loading_v2.gif"></td></tr>
                                    <tr v-else
                                        v-for="(shipment, index) in shipments"
                                        v-bind:key="shipment.index"
                                        class="tr-bottom-line"
                                    >
                                        <td class="text-center">{{index+1}}</td>
                                        <td>{{shipment.company}} <i class="fa fa-arrow-right" style="color: #4fce00;"></i> {{shipment.towarehouse}}</td>
                                        <td>{{shipment.docdate}}</td>
                                        <td class="text-center">{{shipment.status}}</td>
                                        <td class="text-center td-padding">
                                            <button class="btn btn-success btn-sm" type="submit" @click="shipmentLine(shipment.id,shipment.company,shipment.towarehouse)"><i class="mdi mdi-lead-pencil"></i> แก้ไข</button>
                                            <button class="btn btn-warning btn-sm" type="submit" @click=""><i class="mdi mdi-delete-forever"></i> ลบ</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-else>
                            <h4>แก้ไขรายการรับสินค้า [{{shipmentLines.bpartner}} <i class="fa fa-arrow-right" style="color: #4fce00;"></i> {{shipmentLines.towarehouse}}]</h4>
                            <button class="btn btn-primary" type="submit" @click="showProductLine = true"> เพิ่มสินค้า</button>
                            <hr/>
                            <hr/>
                            <div class="row">
                                <div class="col-3"></div>
                                <div class="col-3"><button class="btn btn-success btn-block" @click="confirmCreateShipmentLine()"><i class="mdi mdi-content-save"></i> ยืนยันการรับสินค้า</button></div>
                                <div class="col-3"><button class="btn btn-warning btn-block" @click="addProducts = false"><i class="mdi mdi-close-box"></i> กลับหน้ารายการรับสินค้า</button></div>
                            </div>
                        </div>

                        <modal v-if="showProductLine" @close="showCreate = false">
                        <h3 slot="header">เพิ่มรายการรับสินค้า</h3>
                        <div slot="body">
                            <div class="row" style="margin-bottom: 20px;">
                                <div class="col-12">
                                    <label>รายการสินค้า</label>
                                    <select id="products" class="form-control frm-product-list">
                                        <option style="color: #ddd;">เลือกสินค้า</option>
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
                                    <label>จำนวน</label>
                                    <input v-model="lineCreate.qty" class="form-control frm-product-category" type="number" name="qty" id="qty" required="" placeholder="จำนวนสินค้าที่รับเข้ามา">
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
                            <button class="btn btn-success" @click="createShipmentLine()"><i class="mdi mdi-content-save"></i> บันทึก</button>
                            <button class="btn btn-warning" @click="showProductLine = false"><i class="mdi mdi-close-box"></i> ยกเลิก</button>
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
</style>

<script>
    const apiUrl = '<?=APIURL?>';
</script>
<?=$this->Html->script('product/goodsReceive.js')?>