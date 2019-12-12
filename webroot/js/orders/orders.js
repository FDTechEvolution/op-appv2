Vue.component('paginate', VuejsPaginate)
const nodata = 'ไม่มีข้อมูล...'
let raworder = new Vue({
    el: '#raworder',
    data () {
        return {
            rawOrders: [],
            users: [],
            products: [],
            customers: [],
            addresses: [],
            search: '',
            loading: true,
            rawOrderData: '',
            confirmRawOrder: false,
            showAddress: false,
            changeAddress: false,
            noMobileInData: false,
            mobileLength: false,
            setMobile: true,
            page: 1,
            raworder: {
                id: '',
                index: '',
                cus_id: '',
                mobile: '',
                name: '',
                address_id: '',
                line1: '',
                subdistrict: '',
                district: '',
                province: '',
                zipcode: '',
                user: '',
                shipping: '',
                description: '',
                payment: ''
            },
            productSelected: [{
                product: '',
                qty: '',
                price: ''
            }],
            testContent: ''
        }
    },
    mounted () {
        this.loadRawOrder()
        this.loadUser()
        this.loadProduct()
        this.loadCustomer()
    },
    methods: {
        clickCallback: function(pageNum) {
            console.log(pageNum)
        },
        loadRawOrder: function () {
            axios.get(apiUrl + 'raw-orders/all?org=' + localStorage.getItem('ORG') + '&status=DR')
            .then((response) => {
                this.rawOrders = response.data
            })
            .catch((e) => {
                console.error(e)
            })
            .finally(() => this.loading = false)
        },
        showConfirmRawOrder: function (id, data, index) {
            this.raworder.id = id
            this.rawOrderData = data
            this.raworder.index = index
            this.confirmRawOrder = true
            let exlopded = data.split(" ")
            //console.log(exlopded)
            exlopded.forEach(ex => {
                if(!isNaN(ex) && ex.length > 8) {
                    this.raworder.mobile = ex
                    this.chkCustomerByMobile('yes')
                }
            });
            
        },
        closeConfirmRawOrder: function () {
            this.rawOrderData = ''
            this.productSelected = [{
                product: '',
                qty: '',
                price: ''
            }]
            this.raworder.name = ''
            this.raworder.mobile = ''
            this.raworder.line1 = ''
            this.raworder.subdistrict = ''
            this.raworder.district = ''
            this.raworder.province = ''
            this.raworder.zipcode = ''
            this.raworder.user = ''
            this.raworder.shipping = ''
            this.raworder.description = ''
            this.raworder.payment = ''
            this.changeAddress = false
            this.confirmRawOrder = false
            this.mobileLength = false
            this.noMobileInData = false
            this.setMobile = true
        },
        loadCustomer: function () {
            axios.get(apiUrl + 'customers/all?org=' + localStorage.getItem('ORG') + '&active=yes')
            .then((response) => {
                this.customers = response.data
            })
            .catch(e => {
                console.log(e)
            })
        },
        loadUser: function () {
            axios.get(apiUrl + 'users/all?org=' + localStorage.getItem('ORG') + '&active=yes')
            .then((response) => {
                this.users = response.data
            })
            .catch(e => {
                console.log(e)
            })
        },
        loadProduct: function () {
            axios.get(apiUrl + 'products/all?org=' + localStorage.getItem('ORG') + '&active=yes')
            .then((response) => {
                this.products = response.data
            })
            .catch (e => {
                console.log(e)
            })
        },
        cloneProduct: function () {
            this.productSelected.push({ product: '' , qty: '', price: ''});
        },
        cloneProductDelete: function (index) {
            this.productSelected.splice(index,1)
        },
        inPriceProduct: function (index) {
            let prices = this.products.filter(product => {
                return product.id.includes(this.productSelected[index].product)
            })
            if(!this.productSelected[index].qty){
                this.productSelected[index].price = prices[0].price
                this.productSelected[index].qty = 1
            }else{
                this.productSelected[index].price = (this.productSelected[index].qty * prices[0].price)
            }
        },
        chkCustomerByMobile: function (auto) {
            if(auto == 'yes') {
                let customerData = this.customers.filter(customer => {
                    return customer.mobile.includes(this.raworder.mobile)
                })
                if(customerData.length != 0){
                    this.raworder.cus_id = customerData[0].id
                    this.raworder.name = customerData[0].name
                    this.raworder.mobile = customerData[0].mobile
                    this.mobileLength = false
                    this.setMobile = false
                    this.loadAddress(customerData[0].id)
                }else{
                    this.raworder.name = ''
                    this.raworder.line1 = ''
                    this.raworder.subdistrict = ''
                    this.raworder.district = ''
                    this.raworder.province = ''
                    this.raworder.zipcode = ''
                    this.changeAddress = false
                    this.noMobileInData = true
                    this.setMobile = false
                }
            }else{
                if(this.raworder.mobile){
                    if(this.raworder.mobile.length < 7){
                        this.mobileLength = true
                    }else{
                        let customerData = this.customers.filter(customer => {
                            return customer.mobile.includes(this.raworder.mobile)
                        })
                        if(customerData.length != 0){
                            this.raworder.cus_id = customerData[0].id
                            this.raworder.name = customerData[0].name
                            this.raworder.mobile = customerData[0].mobile
                            this.mobileLength = false
                            this.setMobile = false
                            this.loadAddress(customerData[0].id)
                        }else{
                            this.raworder.name = ''
                            this.raworder.line1 = ''
                            this.raworder.subdistrict = ''
                            this.raworder.district = ''
                            this.raworder.province = ''
                            this.raworder.zipcode = ''
                            this.changeAddress = false
                            this.noMobileInData = true
                            this.setMobile = false
                        }
                    }
                }else{
                    this.raworder.name = ''
                    this.raworder.line1 = ''
                    this.raworder.subdistrict = ''
                    this.raworder.district = ''
                    this.raworder.province = ''
                    this.raworder.zipcode = ''
                    this.changeAddress = false
                    this.setMobile = true
                }
            }
        },
        loadAddress: function (id) {
            axios.get(apiUrl + 'customers/get-address/' + id)
            .then((response) => {
                if(response.data.length > 1){
                    this.showAddress = true
                    this.addresses = response.data
                }else{
                    this.raworder.address_id = response.data[0].Addresses.id
                    this.raworder.line1 = response.data[0].Addresses.line1
                    this.raworder.subdistrict = response.data[0].Addresses.subdistrict
                    this.raworder.district = response.data[0].Addresses.district
                    this.raworder.province = response.data[0].Addresses.province
                    this.raworder.zipcode = response.data[0].Addresses.zipcode
                }
            })
            .catch(e => {
                console.log(e)
            })
        },
        selectedAddress: function (id, line1, subdistrict, district, province, zipcode) {
            this.raworder.address_id = id
            this.raworder.line1 = line1
            this.raworder.subdistrict = subdistrict
            this.raworder.district = district
            this.raworder.province = province
            this.raworder.zipcode = zipcode
            this.showAddress = false
            this.changeAddress = true
        },
        saveRawOrder: function () {
            axios.post(apiUrl + 'orders/create/', {
                org_id: localStorage.getItem('ORG'),
                customer_id: this.raworder.cus_id,
                user_id: document.getElementById('user').value,
                payment_method: 'ปลายทาง',
                description: this.raworder.description,
                totalamt: this.total,
                shipping: this.raworder.shipping,
                raw_order_id: this.raworder.id
            })
            .then((response) => {
                this.saveOrderLine(response.data.msg)
                this.setConfirmRawOrder(this.raworder.id, this.raworder.index)
            })
            .catch(e => {
                console.log(e)
            })
        },
        saveOrderLine: function (id) {
            axios.post(apiUrl + 'order-lines/create/' + id, {
                org_id: localStorage.getItem('ORG'),
                products: this.productSelected
            })
            .then(() => {
                this.closeConfirmRawOrder()
            })
            .catch(e => {
                console.log(e)
            })
        },
        setConfirmRawOrder: function (id, index) {
            axios.post(apiUrl + 'raw-orders/confirm-order/' + id)
            .then(() => {
                this.rawOrders.splice(index,1)
            })
            .catch(e => {
                console.log(e)
            })
        }
    },
    computed: {
        filteredList() {
            return this.rawOrders.filter(rawOrder => {
                return rawOrder.data.toLowerCase().includes(this.search.toLowerCase())
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
        },
        total: function () {
            return this.productSelected.reduce(function(total, product){
                return total + product.price
            },0)
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

Vue.component('confirm-raworder', {
    template: `<transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container" style="width: 70%; max-height: 700px; overflow-y: scroll;">

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
  </transition>`
})

Vue.component('show-address', {
    template: `<transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container" style="width: 80%; max-height: 700px; overflow-y: scroll;">

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
  </transition>`
})