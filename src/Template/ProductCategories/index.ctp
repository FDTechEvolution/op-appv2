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
                <div id="product-category">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 text-left">
                                    <button class="btn btn-primary" type="submit" @click="showCreate = true"> เพิ่มประเภท / กลุ่มสินค้า </button>
                                </div>
                            </div>
                            <hr/>
                        </div>
                        <div v-if="loading" class="col-12 text-center"><img src="img/loading_v2.gif"></div>
                        <div v-else-if="productCategories.length == 0" class="col-12 text-center">NO CATEGORY...</div>
                        <div v-else
                            v-for="(productCategory, index) in productCategories"
                            v-bind:key="productCategory.index"
                            class="col-6"
                        >
                            <div class="card org-card">
                                <div class="card-body org-body-action">
                                    <strong class="header-org">ประเภท / กลุ่มสินค้า :</strong> {{productCategory.name}}<br/>
                                    <strong class="header-org">รายละเอียด :</strong> {{productCategory.description}}<br/>
                                    <div style="display: -webkit-inline-box;">
                                    <strong class="header-org">สถานะ : </strong>&nbsp;
                                        <div v-if="productCategory.isactive == 'Y'" style="color: #00dd00;">เปิดใช้งาน</div>
                                        <div v-else style="color: #dd0000;">ปิดใช้งาน</div>
                                    </div><br/>
                                    <strong class="header-org">จำนวนสินค้า :</strong> {{productCategory.total}} <strong class="header-org">ชิ้น</strong>
                                    <hr/>
                                    <div class="row text-center">
                                        <div class="col-4"><button class="btn btn-info btn-block" type="submit" @click="showProducts(productCategory.id)"><i class="mdi mdi-format-list-bulleted"></i> ดูสินค้า</button></div>
                                        <div class="col-4"><button class="btn btn-success btn-block" type="submit" @click="showEdit(productCategory.id,productCategory.name,productCategory.description,productCategory.isactive)"><i class="mdi mdi-lead-pencil"></i> แก้ไข</button></div>
                                        <div class="col-4"><button class="btn btn-warning btn-block" type="submit" @click="delProductCategories(productCategory.id,productCategory.name,productCategory.total)"><i class="mdi mdi-delete-forever"></i> ลบ</button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <!-- Create Category -->
                        <modal v-if="showCreate" @close="showCreate = false">
                            <h3 slot="header">เพิ่มประเภท / กลุ่มสินค้า</h3>
                            <div slot="body">
                                <div style="color: #dd0000;">{{nameDuplicate}}</div>
                                <input v-model="name" class="form-control frm-product-category" type="text" name="name" id="name" required="" placeholder="ชื่อประเภท / กลุ่มสินค้า">
                                <textarea v-model="description" class="form-control frm-product-category" name="description" id="description" rows="6" placeholder="รายละเอียด (ถ้ามี)"></textarea>
                                <div class="radio radio-info form-check-inline">
                                    <input v-model="isactive" type="radio" id="isactive1" name="isactive" value="Y"><label for="isactive1" style="margin-right: 20px;">เปิดใช้งาน</label>
                                    <input v-model="isactive" type="radio" id="isactive2" name="isactive" value="N"><label for="isactive2">ปิดใช้งาน</label>
                                </div>
                            </div>
                            <div slot="footer">
                                <button class="btn btn-success" @click="creatProductCategory()"><i class="mdi mdi-content-save"></i> บันทึก</button>
                                <button class="btn btn-warning" @click="showCreate = false"><i class="mdi mdi-close-box"></i> ยกเลิก</button>
                            </div>
                        </modal>

                        <!-- Edit Category -->
                        <modal v-if="editProductCategories" @close="editProductCategories = false">
                            <h3 slot="header">แก้ไขประเภท / กลุ่มสินค้า</h3>
                            <div slot="body">
                                <div class="row">
                                    <div class="col-3" style="padding-top: 6px;"><strong class="header-org">กลุ่มสินค้า :</strong></div>
                                    <div class="col-9"><input v-model="editName" type="text" class="form-control frm-orgs" required=""><div style="color: #dd0000;">{{nameDuplicate}}</div></div>
                                </div>
                                <div class="row">
                                    <div class="col-3" style="padding-top: 6px;"><strong class="header-org">รายละเอียด :</strong></div>
                                    <div class="col-9"><textarea v-model="editDescription" class="form-control frm-orgs" rows="6"></textarea></div>
                                </div>
                                <div class="row">
                                    <div class="col-3"></div>
                                    <div class="col-9">
                                        <div style="display: -webkit-inline-box; margin-top: 10px;">
                                            <div class="radio radio-info form-check-inline">
                                                <input v-model="editIsactive" type="radio" id="isactive1" name="isactive" value="Y"><label for="isactive1" style="margin-right: 20px;">เปิดใช้งาน</label>
                                                <input v-model="editIsactive" type="radio" id="isactive2" name="isactive" value="N"><label for="isactive2">ปิดใช้งาน</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                            </div>
                            <div slot="footer">
                                <button class="btn btn-success" @click="updateProductCategory()"><i class="mdi mdi-content-save"></i> บันทึก</button>
                                <button class="btn btn-warning" @click="editProductCategories = false"><i class="mdi mdi-close-box"></i> ยกเลิก</button>
                            </div>
                        </modal>

                        <!-- Show Products -->
                        <show-products v-if="showCateProduct" @close="showCateProduct = false">
                            <h3 slot="header">รายการสินค้าในกลุ่ม</h3>
                            <div slot="body">
                                <table style="width: 100%;">
                                    <thead style="border-bottom: 1px solid #333; margin-bottom: 10px;">
                                        <tr>
                                            <th class="text-center" style="width: 10%;">ลำดับ</th>
                                            <th style="width: 30%;">ชื่อสินค้า</th>
                                            <th style="width: 30%;">ยี่ห้อ</th>
                                            <th class="text-center" style="width: 15%;">ต้นทุน (฿)</th>
                                            <th class="text-center" style="width: 15%;">ราคา (฿)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if='loading'><td colspan="5" class="text-center"><img src="img/loading_v2.gif"></td></tr>
                                        <tr v-else-if="products.length == 0" class="text-center"><td colspan="5" class="text-center">NO PRODUCT...</td></tr>
                                        <tr v-else
                                            v-for="(product, index) in products"
                                            v-bind:key="product.index"
                                        >
                                            <td class="text-center">{{index+1}}</td>
                                            <td>{{product.name}}</td>
                                            <td>{{product.brand_id}}</td>
                                            <td class="text-center">({{product.cost}}</td>
                                            <td class="text-center">{{product.price}}</td>                             
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div slot="footer">
                                <button class="btn btn-warning" @click="showCateProduct = false"><i class="mdi mdi-close-box"></i> ยกเลิก</button>
                            </div>
                        </show-products>
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

<script type="text/x-template" id="modal-products">
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper-product">
        <div class="modal-container-product">

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
<?=$this->Html->script('product/productCategories.js')?>