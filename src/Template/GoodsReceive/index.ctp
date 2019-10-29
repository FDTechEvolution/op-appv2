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
                                        <div v-if="productBrand == 0" class="no-content">ไม่มีต้นทางสินค้า <a href="#">สร้างต้นทางสินค้า</a></div>
                                        <div v-else>
                                            <select id="bpartner" class="form-control">
                                                <option style="color: #ddd;">เลือกต้นทางสินค้า</option>
                                                <option
                                                    v-for="(brand, index) in productBrand"
                                                    v-bind:key="brand.index"
                                                    v-bind:value="brand.id">{{brand.name}}
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
                                    <div class="col-3 text-center"><button class="btn btn-success btn-block" @click=""><i class="mdi mdi-content-save"></i> บันทึก</button></div>
                                    <div class="col-3 text-center"><button class="btn btn-warning btn-block" @click="showCreate = false"><i class="mdi mdi-close-box"></i> ยกเลิก</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                <div id="shipment-line">
                
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    const apiUrl = '<?=APIURL?>';
</script>
<?=$this->Html->script('product/goodsReceive.js')?>