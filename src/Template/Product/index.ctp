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
            <div id="products" class="card-box">
                <div class="row">
                    <div class="col-12 text-left">
                        <div id="create-product">
                            <button class="btn btn-primary" type="submit" @click="showCreate = true"><i class="mdi mdi-cart-plus"></i> เพิ่มรายการสินค้า </button>
                       </div>
                    </div>
                </div>
                <hr/>
                <table style="width: 100%;">
                    <thead style="border-bottom: 1px solid #333; margin-bottom: 10px;">
                        <tr>
                            <th class="text-center" style="width: 10%;">ลำดับ</th>
                            <th style="width: 20%;">ชื่อสินค้า</th>
                            <th style="width: 20%;">ประเภท</th>
                            <th class="text-center" style="width: 10%;">ต้นทุน (฿)</th>
                            <th class="text-center" style="width: 10%;">ราคา (฿)</th>
                            <th class="text-center" style="width: 10%;">คงเหลือ</th>
                            <th class="text-center" style="width: 20%;">การจัดการ</th>
                        </tr>
                    </thead>
                    <tbody id="show-products">
                        <tr v-if='loading'><td colspan="7" class="text-center"><img src="img/loading_v2.gif"></td></tr>
                        <tr v-else-if="products.length == 0" class="text-center"><td colspan="7" class="text-center">NO PRODUCT...</td></tr>
                        <tr v-else
                            v-for="(product, index) in products"
                            v-bind:key="index"
                        >
                            <td class="text-center">{{index+1}}</td>
                            <td>{{product.name}}</td>
                            <td>{{product.category}}</td>
                            <td class="text-center">{{product.cost}}</td>
                            <td class="text-center">{{product.price}}</td>
                            <td class="text-center">0</td>
                            <td class="text-center">
                                <button class="btn btn-success" type="submit" @click="showEdit(product.id)"><i class="mdi mdi-lead-pencil"></i> แก้ไข</button>
                                <button class="btn btn-warning" type="submit" @click="delProduct(product.id,product.name,index)"><i class="mdi mdi-delete-forever"></i> ลบ</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- Create Product -->
                    <modal v-if="showCreate" @close="showCreate = false">
                        <h3 slot="header">เพิ่มรายการสินค้า</h3>
                        <div slot="body">
                            <div class="row">
                                <div class="col-3 product-add-title">หมวดหมู่</div>
                                <div v-if="productCate == 0" class="col-9 no-content">ไม่มีหมวดหมู่ <a href="#">สร้างหมวดหมู่</a></div>
                                <div v-else class="col-9">
                                    <select id="category" class="form-control frm-product-category">
                                        <option style="color: #ddd;">เลือกหมวดหมู่</option>
                                        <option
                                            v-for="(category, index) in productCate"
                                            v-bind:key="category.index"
                                            v-bind:value="category.id">{{category.name}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 product-add-title">ยี่ห้อ</div>
                                <div v-if="productBrand == 0" class="col-9 no-content">ไม่มียี่ห้อ <a href="#">สร้างยี่ห้อ</a></div>
                                <div v-else class="col-9">
                                    <select id="brand" class="form-control frm-product-category">
                                        <option style="color: #ddd;">เลือกยี่ห้อ</option>
                                        <option
                                            v-for="(brand, index) in productBrand"
                                            v-bind:key="brand.index"
                                            v-bind:value="brand.id">{{brand.name}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 product-add-title">ชื่อสินค้า</div>
                                <div class="col-9"><input v-model="create.name" class="form-control frm-product-category" type="text" name="name" id="name" required="" placeholder="ชื่อรายการสินค้า"></div>
                            </div>
                            <div class="row">
                                <div class="col-3 product-add-title">รหัสสินค้า</div>
                                <div class="col-9"><input v-model="create.code" class="form-control frm-product-category" type="text" name="code" id="code" required="" placeholder="รหัส"></div>
                            </div>
                            <div class="row">
                                <div class="col-3 product-add-title">ราคาต้นทุน</div>
                                <div class="col-9"><input v-model="create.cost" class="form-control frm-product-category" type="number" name="cost" id="cost" required="" placeholder="ราคาต้นทุน (฿)"></div>
                            </div>
                            <div class="row">
                                <div class="col-3 product-add-title">ราคาขาย</div>
                                <div class="col-9"><input v-model="create.price" class="form-control frm-product-category" type="number" name="price" id="price" required="" placeholder="ราคาขาย (฿)"></div>
                            </div>
                            <div class="row">
                                <div class="col-3 product-add-title">รายละเอียด</div>
                                <div class="col-9"><textarea v-model="create.description" class="form-control frm-product-category" name="description" id="description" rows="6" placeholder="รายละเอียด (ถ้ามี)"></textarea></div>
                            </div>
                            <div class="row">
                                <div class="col-3 product-add-title">สถานะ</div>
                                <div class="col-9">
                                    <div class="radio radio-info form-check-inline">
                                        <input v-model="create.isactive" type="radio" id="isactive1" name="isactive" value="Y"><label for="isactive1" style="margin-right: 20px;">เปิดใช้งาน</label>
                                        <input v-model="create.isactive" type="radio" id="isactive2" name="isactive" value="N"><label for="isactive2">ปิดใช้งาน</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div slot="footer">
                            <button class="btn btn-success" @click="creatProduct()"><i class="mdi mdi-content-save"></i> บันทึก</button>
                            <button class="btn btn-warning" @click="showCreate = false"><i class="mdi mdi-close-box"></i> ยกเลิก</button>
                        </div>
                    </modal>

                    <!-- Show Edit -->
                    <modal v-if="showEditModal" @close="showEditModal = false">
                        <h3 slot="header">แก้ไขรายการสินค้า</h3>
                        <div v-if="loadingEdit" slot="body"><div class="row"><div class="col-12 text-center"><img src="img/loading_v2.gif"></div></div></div>
                        <div v-else slot="body">
                            <div class="row">
                                <div class="col-3 product-add-title">หมวดหมู่</div>
                                <div v-if="productCate == 0" class="col-9 no-content">ไม่มีหมวดหมู่ <a href="#">สร้างหมวดหมู่</a></div>
                                <div v-else class="col-9">
                                    <select id="category" v-model="selected.category" class="form-control frm-product-category">
                                        <option style="color: #ddd;">เลือกหมวดหมู่</option>
                                        <option
                                            v-for="(category, index) in productCate"
                                            v-bind:key="category.index"
                                            v-bind:value="category.id">{{category.name}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 product-add-title">ยี่ห้อ</div>
                                <div v-if="productBrand == 0" class="col-9 no-content">ไม่มียี่ห้อ <a href="#">สร้างยี่ห้อ</a></div>
                                <div v-else class="col-9">
                                    <select id="brand" v-model="selected.brand" class="form-control frm-product-category">
                                        <option style="color: #ddd;">เลือกยี่ห้อ</option>
                                        <option
                                            v-for="(brand, index) in productBrand"
                                            v-bind:key="brand.index"
                                            v-bind:value="brand.id">{{brand.name}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 product-add-title">ชื่อสินค้า</div>
                                <div class="col-9"><input v-model="update.name" class="form-control frm-product-category" type="text" name="name" id="name" required="" placeholder="ชื่อรายการสินค้า"></div>
                            </div>
                            <div class="row">
                                <div class="col-3 product-add-title">รหัสสินค้า</div>
                                <div class="col-9"><input v-model="update.code" class="form-control frm-product-category" type="text" name="code" id="code" required="" placeholder="รหัส"></div>
                            </div>
                            <div class="row">
                                <div class="col-3 product-add-title">ราคาต้นทุน</div>
                                <div class="col-9"><input v-model="update.cost" class="form-control frm-product-category" type="number" name="cost" id="cost" required="" placeholder="ราคาต้นทุน (฿)"></div>
                            </div>
                            <div class="row">
                                <div class="col-3 product-add-title">ราคาขาย</div>
                                <div class="col-9"><input v-model="update.price" class="form-control frm-product-category" type="number" name="price" id="price" required="" placeholder="ราคาขาย (฿)"></div>
                            </div>
                            <div class="row">
                                <div class="col-3 product-add-title">รายละเอียด</div>
                                <div class="col-9"><textarea v-model="update.description" class="form-control frm-product-category" name="description" id="description" rows="6" placeholder="รายละเอียด (ถ้ามี)"></textarea></div>
                            </div>
                            <div class="row">
                                <div class="col-3 product-add-title">สถานะ</div>
                                <div class="col-9">
                                    <div class="radio radio-info form-check-inline">
                                        <input v-model="update.isactive" type="radio" id="isactive1" name="isactive" value="Y"><label for="isactive1" style="margin-right: 20px;">เปิดใช้งาน</label>
                                        <input v-model="update.isactive" type="radio" id="isactive2" name="isactive" value="N"><label for="isactive2">ปิดใช้งาน</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div slot="footer">
                            <button class="btn btn-success" @click="updateProduct(update.id)"><i class="mdi mdi-content-save"></i> บันทึก</button>
                            <button class="btn btn-warning" @click="showEditModal = false"><i class="mdi mdi-close-box"></i> ยกเลิก</button>
                        </div>
                    </modal>
            </div>
        </div>
    </div>
</div>

<script>
    const apiUrl = '<?=APIURL?>';
</script>
<?=$this->Html->script('product/product.js')?>