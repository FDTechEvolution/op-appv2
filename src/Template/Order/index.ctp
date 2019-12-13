<div class="row">
    <div id="app">
        <div class="col-md-12">
            <div class="card-box">
                <h2 class="header-title m-t-0 m-b-30">คำสั่งซื้อทั้งหมด</h2>

                <ul class="nav nav-pills navtab-bg nav-justified">
                    <li class="nav-item">
                        <a href="#raworder" data-toggle="tab" aria-expanded="false" class="nav-link active">
                            ออเดอร์รอยืนยัน
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#confirmorder" data-toggle="tab" aria-expanded="false" class="nav-link">
                            ออเดอร์ยืนยันแล้ว
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#voidorder" data-toggle="tab" aria-expanded="false" class="nav-link">
                            ออเดอร์ยกเลิก
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#wprintorder" data-toggle="tab" aria-expanded="false" class="nav-link">
                            รอปริ้นที่อยู่
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#wsentorder" data-toggle="tab" aria-expanded="false" class="nav-link">
                            รอส่ง
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#sentedorder" data-toggle="tab" aria-expanded="false" class="nav-link">
                            ส่งแล้ว
                        </a>
                    </li>
                </ul>
                <br/>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="raworder">
                        <div class="card m-b-20">
                            <div class="card-body">
                                <div class="search-wrapper row">
                                    <div class="col-md-8"></div>
                                    <div class="col-md-4">
                                        <input type="text" v-model="search" placeholder="ค้นหารายการลูกค้า..." class="search-orders"/>
                                    </div>
                                </div>
                                <table style="width: 100%;">
                                    <thead style="border-bottom: 1px solid #333; margin-bottom: 10px;">
                                        <tr>
                                            <th style="width: 70%;">รายการ</th>
                                            <th class="text-center" style="width: 10%">วันที่</th>
                                            <th class="text-center" style="width: 20%;">การจัดการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if='loading'><td colspan="3" class="text-center"><img src="img/loading_v2.gif"></td></tr>
                                        <tr v-else-if='rawOrders.length == 0'><td colspan="3" class="text-center">NO DATA...</td></tr>
                                        <tr v-else
                                            v-for="(rawOrder, index) in filteredList"
                                            class="tr-order"
                                        >
                                            <td class="td-order">{{index+1}}. {{rawOrder.data}}</td>
                                            <td class="text-center">{{rawOrder.created}}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-success btn-sm" @click="showConfirmRawOrder(rawOrder.id, rawOrder.data, index)">ยืนยันออเดอร์</button>&nbsp;
                                                <button type="button" class="btn btn-warning btn-sm">ยกเลิก</button></td>
                                        </tr>
                                    </tbody>
                                    <paginate
                                        v-model="page"
                                        :page-count="rawOrders.length"
                                        :page-range="1"
                                        :click-handler="clickCallback"
                                        :prev-text="'Prev'"
                                        :next-text="'Next'"
                                        :container-class="'pagination'"
                                        :page-class="'page-item'">
                                    </paginate>
                                </table>
                            </div>
                        </div>

                        <!-- Conform RawOrder -->
                        <confirm-raworder v-if="confirmRawOrder" @close="confirmRawOrder = false">
                            <div slot="header" class="raw-order-data">
                                <div class="row">
                                    <div class="col-12">{{rawOrderData}}</div>
                                </div>
                                <div v-if="noMobileInData" class="row" style="margin-top: 10px;">
                                    <div class="col-12 text-center" style="color: #dd0000;">ไม่มีรายละเอียดลูกค้าตามหมายเลขโทรศัพท์ที่ระบุ กรุณาเพิ่มรายละเอียดลูกค้าด้วยตนเอง...</div>
                                </div>
                                <div class="row">
                                    <div class="col-12">{{testContent}}</div>
                                </div>
                            </div>
                            <div slot="body">
                                <div class="row">
                                    <div class="col-2">
                                        <label>โทร</label>
                                        <input v-model="raworder.mobile" v-bind:class="" v-on:change="chkCustomerByMobile()" class="form-control frm-product-category" type="number" id="" placeholder="">
                                    </div>
                                    <div class="col-4">
                                        <label>ชื่อ</label>
                                        <input v-model="raworder.name" v-bind:class="{setmobile : setMobile}" class="form-control frm-product-category" type="text" id="" placeholder="">
                                    </div>
                                    <div class="col-6">
                                        <label>ที่อยู่/บ้านเลขที่/ตึก/ซอย <span v-if="changeAddress">[<button class="a-button" @click="showAddress = true"><strong style="color: blue;"><u>เปลี่ยนที่อยู่</u></strong></button>]</span></label>
                                        <input v-model="raworder.line1" v-bind:class="{setmobile : setMobile}" class="form-control frm-product-category" type="text" id="" placeholder="">
                                    </div>
                                </div>
                                <span v-if="mobileLength" style="color: #dd0000;">กรุณาระบุหมายเลขโทรศัพท์ให้มากกว่า 7 หลัก เพื่อความแม่นยำในการค้นหา</span>
                                <div class="row">
                                    <div class="col-3">
                                        <label>แขวง/ตำบล</label>
                                        <input v-model="raworder.subdistrict" v-bind:class="{setmobile : setMobile}" class="form-control frm-product-category" type="text" id="" placeholder="">
                                    </div>
                                    <div class="col-3">
                                        <label>เขต/อำเภอ</label>
                                        <input v-model="raworder.district" v-bind:class="{setmobile : setMobile}" class="form-control frm-product-category" type="text" id="" placeholder="">
                                    </div>
                                    <div class="col-3">
                                        <label>จังหวัด</label>
                                        <input v-model="raworder.province" v-bind:class="{setmobile : setMobile}" class="form-control frm-product-category" type="text" id="" placeholder="">
                                    </div>
                                    <div class="col-3">
                                        <label>รหัสไปรษณีย์</label>
                                        <input v-model="raworder.zipcode" v-bind:class="{setmobile : setMobile}" class="form-control frm-product-category" type="number" id="" placeholder="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <label>พนักงานขาย</label>
                                        <select id="user" class="form-control">
                                            <option
                                                v-for="(user, index) in users"
                                                v-bind:key="user.index"
                                                v-bind:value="user.id">{{user.name}}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <label>ส่งโดย</label>
                                        <select v-model="raworder.shipping" class="form-control">
                                            <option value="" style="color: #ddd;">เลือก...</option>
                                            <option value="kerry">Kerry</option>
                                            <option value="ไปรษณีย์">ไปรษณีย์</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label>รายละเอียด/โน๊ต</label>
                                        <input v-model="raworder.description" v-bind:class="" class="form-control frm-product-category" type="text" id="" placeholder="">
                                    </div>
                                    <div class="col-2">
                                        <label>วิธีชำระเงิน</label>
                                        <div class="radio radio-info form-check-inline" style="margin-top: 7px;">
                                            <input v-model="raworder.payment" type="radio" id="payment1" name="payment" v-bind:value="COD" :checked="raworder.payment == 'COD'"><label for="payment1" style="margin-right: 20px;">COD</label>
                                            <input v-model="raworder.payment" type="radio" id="payment2" name="payment" v-bind:value="โอน" :checked="raworder.payment == 'โอน'"><label for="payment2">โอน</label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row" style="margin-bottom: 20px;">
                                    <div class="col-2"><button class="btn btn-success btn-rounded btn-block" type="submit" @click="cloneProduct()"> เพิ่มสินค้า </button></div>
                                </div>
                                <div class="row" v-for="(productSelect, index) in productSelected" id="productList">
                                    <div class="col-7">
                                        <select id="products" v-model="productSelect.product" v-on:change="inPriceProduct(index)" class="form-control frm-product-list">
                                            <option style="color: #ddd;" value="">เลือกสินค้า</option>
                                            <option
                                                v-for="(product, index) in products"
                                                v-bind:key="product.index"
                                                v-bind:value="product.id">{{product.name}}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <input v-model="productSelect.qty" v-bind:class="" v-on:change="inPriceProduct(index)" class="form-control frm-product-category" type="number" id="" placeholder="จำนวน">
                                    </div>
                                    <div class="col-2">
                                        <input v-model="productSelect.price" v-bind:class="" class="form-control frm-product-category" type="number" id="" placeholder="ราคา" readonly>
                                    </div>
                                    <div class="col-1 text-center">
                                        <button class="btn btn-icon waves-effect waves-light btn-warning m-b-5" @click="cloneProductDelete(index)" title="ลบรายการสินค้า"> <i class="mdi mdi-close"></i> </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-9 text-right">ราคารวม : </div>
                                    <div class="col-2 text-center">{{total}}</div>
                                    <div class="col-1">บาท</div>
                                </div>
                            </div>
                            <div slot="footer">
                                <button class="btn btn-success" @click="chkSaveOrder()"><i class="mdi mdi-content-save"></i> บันทึก</button>
                                <button class="btn btn-warning" @click="closeConfirmRawOrder()"><i class="mdi mdi-close-box"></i> ยกเลิก</button>
                            </div>
                        </confirm-raworder>

                        <!-- Show Address -->
                        <show-address v-if="showAddress" @close="showAddress = false">
                            <div slot="body">
                                <table style="width: 100%;">
                                    <tbody>
                                        <tr v-for="(address, index) in addresses"
                                            class="tr-order"
                                        >
                                            <td class="td-order">{{index+1}}. {{address.Addresses.line1}} ต.{{address.Addresses.subdistrict}} อ.{{address.Addresses.district}} จ.{{address.Addresses.province}} {{address.Addresses.zipcode}}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-success btn-sm" @click="selectedAddress(address.Addresses.id,address.Addresses.line1,address.Addresses.subdistrict,address.Addresses.district,address.Addresses.province,address.Addresses.zipcode)">เลือก</button>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div slot="footer">
                                <button class="btn btn-warning" @click="showAddress = false"><i class="mdi mdi-close-box"></i> ปิด</button>
                            </div>
                        </show-address>
                    </div>
                    <div class="tab-pane fade" id="confirmorder">
                        <div class="card m-b-20">
                            <div class="card-body">
                                <div class="search-wrapper row">
                                    <div class="col-md-8"></div>
                                    <div class="col-md-4">
                                        <input type="text" v-model="search" placeholder="ค้นหาชื่อลูกค้า..." class="search-orders"/>
                                    </div>
                                </div>
                                <table style="width: 100%;">
                                    <thead style="border-bottom: 1px solid #333; margin-bottom: 10px;">
                                        <tr>
                                            <th style="width: 70%;">รายการ</th>
                                            <th class="text-center" style="width: 20%;">ผู้ส่ง</th>
                                            <th class="text-center">วันที่</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if='loading'><td colspan="3" class="text-center">Loading...</td></tr>
                                        <tr v-else-if='orders.length == 0'><td colspan="3" class="text-center">NO DATA...</td></tr>
                                        <tr v-else
                                            v-for="(order, index) in filteredList"
                                            class="tr-order"
                                        >
                                            <td class="td-order">
                                                {{index+1}}. {{order.order_lines}} ราคา {{order.totalamt}} บาท ({{order.payment_method}}) | 
                                                {{order.customer}} - {{order.line1}} ต.{{order.subdistrict}} อ.{{order.district}} จ.{{order.province}} {{order.zipcode}}
                                            </td>
                                            <td class="text-center">{{order.user}}</td>
                                            <td class="text-center">{{order.modified}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="voidorder">
                        <div class="card m-b-20">
                            <div class="card-body">
                                <div class="search-wrapper row">
                                    <div class="col-md-8"></div>
                                    <div class="col-md-4">
                                        <input type="text" v-model="search" placeholder="ค้นหาชื่อลูกค้า..." class="search-orders"/>
                                    </div>
                                </div>
                                <table style="width: 100%;">
                                    <thead style="border-bottom: 1px solid #333; margin-bottom: 10px;">
                                        <tr>
                                            <th style="width: 70%;">รายการ</th>
                                            <th class="text-center" style="width: 20%;">ผู้ส่ง</th>
                                            <th class="text-center">วันที่</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if='loading'><td colspan="3" class="text-center">Loading...</td></tr>
                                        <tr v-else-if='orders.length == 0'><td colspan="3" class="text-center">NO DATA...</td></tr>
                                        <tr v-else
                                            v-for="(order, index) in filteredList"
                                            class="tr-order"
                                        >
                                            <td class="td-order">
                                                {{index+1}}. {{order.order_lines}} ราคา {{order.totalamt}} บาท ({{order.payment_method}}) | 
                                                {{order.customer}} - {{order.line1}} ต.{{order.subdistrict}} อ.{{order.district}} จ.{{order.province}} {{order.zipcode}}
                                            </td>
                                            <td class="text-center">{{order.user}}</td>
                                            <td class="text-center">{{order.modified}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="wprintorder">
                        <div class="card m-b-20">
                            <div class="card-body">
                                <div class="search-wrapper row">
                                    <div class="col-md-8"></div>
                                    <div class="col-md-4">
                                        <input type="text" v-model="search" placeholder="ค้นหาชื่อลูกค้า..." class="search-orders"/>
                                    </div>
                                </div>
                                <table style="width: 100%;">
                                    <thead style="border-bottom: 1px solid #333; margin-bottom: 10px;">
                                        <tr>
                                            <th style="width: 70%;">รายการ</th>
                                            <th class="text-center" style="width: 20%;">ผู้ส่ง</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if='loading'><td colspan="3" class="text-center">Loading...</td></tr>
                                        <tr v-else-if='orders.length == 0'><td colspan="3" class="text-center">NO DATA...</td></tr>
                                        <tr v-else
                                            v-for="(order, index) in filteredList"
                                            class="tr-order"
                                        >
                                            <td class="td-order">
                                                {{index+1}}. {{order.order_lines}} ราคา {{order.totalamt}} บาท ({{order.payment_method}}) | 
                                                {{order.customer}} - {{order.line1}} ต.{{order.subdistrict}} อ.{{order.district}} จ.{{order.province}} {{order.zipcode}}
                                            </td>
                                            <td class="text-center">{{order.user}}</td>
                                            <td class="text-center">....</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="wsentorder">
                        <div class="card m-b-20">
                            <div class="card-body">
                                <div class="search-wrapper row">
                                    <div class="col-md-8"></div>
                                    <div class="col-md-4">
                                        <input type="text" v-model="search" placeholder="ค้นหาชื่อลูกค้า..." class="search-orders"/>
                                    </div>
                                </div>
                                <table style="width: 100%;">
                                    <thead style="border-bottom: 1px solid #333; margin-bottom: 10px;">
                                        <tr>
                                            <th style="width: 70%;">รายการ</th>
                                            <th class="text-center" style="width: 20%;">ผู้ส่ง</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if='loading'><td colspan="3" class="text-center">Loading...</td></tr>
                                        <tr v-else-if='orders.length == 0'><td colspan="3" class="text-center">NO DATA...</td></tr>
                                        <tr v-else
                                            v-for="(order, index) in filteredList"
                                            class="tr-order"
                                        >
                                            <td class="td-order">
                                                {{index+1}}. {{order.order_lines}} ราคา {{order.totalamt}} บาท ({{order.payment_method}}) | 
                                                {{order.customer}} - {{order.line1}} ต.{{order.subdistrict}} อ.{{order.district}} จ.{{order.province}} {{order.zipcode}}
                                            </td>
                                            <td class="text-center">{{order.user}}</td>
                                            <td class="text-center">....</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="sentedorder">
                        <div class="card m-b-20">
                            <div class="card-body">
                                <div class="search-wrapper row">
                                    <div class="col-md-8"></div>
                                    <div class="col-md-4">
                                        <input type="text" v-model="search" placeholder="ค้นหาชื่อลูกค้า..." class="search-orders"/>
                                    </div>
                                </div>
                                <table style="width: 100%;">
                                    <thead style="border-bottom: 1px solid #333; margin-bottom: 10px;">
                                        <tr>
                                            <th style="width: 70%;">รายการ</th>
                                            <th class="text-center" style="width: 20%;">ผู้ส่ง</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if='loading'><td colspan="3" class="text-center">Loading...</td></tr>
                                        <tr v-else-if='orders.length == 0'><td colspan="3" class="text-center">NO DATA...</td></tr>
                                        <tr v-else
                                            v-for="(order, index) in filteredList"
                                            class="tr-order"
                                        >
                                            <td class="td-order">
                                                {{index+1}}. {{order.order_lines}} ราคา {{order.totalamt}} บาท ({{order.payment_method}}) | 
                                                {{order.customer}} - {{order.line1}} ต.{{order.subdistrict}} อ.{{order.district}} จ.{{order.province}} {{order.zipcode}}
                                            </td>
                                            <td class="text-center">{{order.user}}</td>
                                            <td class="text-center">....</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
</div>

<script>
    const apiUrl = '<?=APIURL?>';
</script>
<?=$this->Html->script('orders/orders.js')?>