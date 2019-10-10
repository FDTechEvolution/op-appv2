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
                                        <tr v-if='loading'><td colspan="3" class="text-center"><i class="fa-li fa fa-spinner fa-spin"></i> Loading...</td></tr>
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
                                            <td class="text-center"><button type="button" class="btn btn-success btn-sm">บันทึก</button>&nbsp;<button type="button" class="btn btn-warning btn-sm">ยกเลิก</button></td>
                                        </tr>
                                    </tbody>
                                    <paginate
                                        v-model="page"
                                        :page-count="orders.length"
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
    Vue.component('paginate', VuejsPaginate)
    const apiUrl = 'http://localhost/git/op-service/'
    const nodata = 'ไม่มีข้อมูล...'
    let raworder = new Vue({
        el: '#raworder',
        data () {
            return {
                orders: [],
                search: '',
                loading: true,
                page: 1
            }
        },
        methods: {
            clickCallback: function(pageNum) {
                console.log(pageNum)
            }
        },
        mounted () {
            axios
            .get(apiUrl + 'orders/get-order/DX')
            .then((response) => {
                this.orders = response.data
            })
            .catch((e) => {
                console.error(e)
            })
            .finally(() => this.loading = false)
        },
        computed: {
            filteredList() {
                return this.orders.filter(order => {
                    return order.customer.toLowerCase().includes(this.search.toLowerCase())
                })
            },
            sortedCats:function() {
                return this.cats.sort((a,b) => {
                    let modifier = 1;
                    if(this.currentSortDir === 'desc') modifier = -1;
                    if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
                    if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
                    return 0;
                }).filter((row, index) => {
                    let start = (this.currentPage-1)*this.pageSize;
                    let end = this.currentPage*this.pageSize;
                    if(index >= start && index < end) return true;
                });
            }
        }
    })

    let confirmorder = new Vue({
        el: '#confirmorder',
        data () {
            return {
                orders: [],
                search: '',
                loading: true
            }
        },
        mounted () {
            axios
            .get(apiUrl + 'orders/get-order/CO')
            .then(response => (
                this.orders = response.data
            ))
            .catch((e) => {
                console.error(e)
            })
            .finally(() => this.loading = false)
        },
        computed: {
            filteredList() {
                return this.orders.filter(order => {
                    return order.customer.toLowerCase().includes(this.search.toLowerCase())
                })
            }
        }
    })

    let voidorder = new Vue({
        el: '#voidorder',
        data () {
            return {
                orders: [],
                search: '',
                loading: true
            }
        },
        mounted () {
            axios
            .get(apiUrl + 'orders/get-order/VO')
            .then(response => (
                this.orders = response.data
            ))
            .catch((e) => {
                console.error(e)
            })
            .finally(() => this.loading = false)
        },
        computed: {
            filteredList() {
                return this.orders.filter(order => {
                    return order.customer.toLowerCase().includes(this.search.toLowerCase())
                })
            }
        }
    })

    let wprintorder = new Vue({
        el: '#wprintorder',
        data () {
            return {
                orders: [],
                search: '',
                loading: true,
                nodata: true
            }
        },
        mounted () {
            axios
            .get(apiUrl + 'orders/get-order/WPRINT')
            .then((response) => {
                if(response.data != null){
                    this.orders = response.data
                }else{
                    this.nodata = false
                }
            })
            .catch((e) => {
                console.error(e)
            })
            .finally(() => this.loading = false)
        },
        computed: {
            filteredList() {
                return this.orders.filter(order => {
                    return order.customer.toLowerCase().includes(this.search.toLowerCase())
                })
            }
        }
    })

    let wsentorder = new Vue({
        el: '#wsentorder',
        data () {
            return {
                orders: [],
                search: '',
                loading: true
            }
        },
        mounted () {
            axios
            .get(apiUrl + 'orders/get-order/WSENT')
            .then(response => (
                this.orders = response.data
            ))
            .catch((e) => {
                console.error(e)
            })
            .finally(() => this.loading = false)
        },
        computed: {
            filteredList() {
                return this.orders.filter(order => {
                    return order.customer.toLowerCase().includes(this.search.toLowerCase())
                })
            }
        }
    })

    let sentedorder = new Vue({
        el: '#sentedorder',
        data () {
            return {
                orders: [],
                search: '',
                loading: true
            }
        },
        mounted () {
            axios
            .get(apiUrl + 'orders/get-order/SENT')
            .then(response => (
                this.orders = response.data
            ))
            .catch((e) => {
                console.error(e)
            })
            .finally(() => this.loading = false)
        },
        computed: {
            filteredList() {
                return this.orders.filter(order => {
                    return order.customer.toLowerCase().includes(this.search.toLowerCase())
                })
            }
        }
    })
</script>