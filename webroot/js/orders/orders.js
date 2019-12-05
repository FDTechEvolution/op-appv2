Vue.component('paginate', VuejsPaginate)
const nodata = 'ไม่มีข้อมูล...'
let raworder = new Vue({
    el: '#raworder',
    data () {
        return {
            rawOrders: [],
            users: [],
            products: [],
            search: '',
            loading: true,
            rawOrderData: '',
            confirmRawOrder: false,
            page: 1,
            raworder: {
                mobile: '',
                name: '',
                line1: '',
                subdistrict: '',
                district: '',
                province: '',
                zipcode: '',
                user: '',
                shipping: '',
                description: '',
                payment: ''
            }
        }
    },
    mounted () {
        this.loadRawOrder()
        this.loadUser()
        this.loadProduct()
    },
    methods: {
        clickCallback: function(pageNum) {
            console.log(pageNum)
        },
        loadRawOrder: function () {
            axios.get(apiUrl + 'raw-orders/all?org=' + localStorage.getItem('ORG'))
            .then((response) => {
                this.rawOrders = response.data
            })
            .catch((e) => {
                console.error(e)
            })
            .finally(() => this.loading = false)
        },
        showConfirmRawOrder: function (data) {
            this.rawOrderData = data
            this.confirmRawOrder = true
        },
        closeConfirmRawOrder: function () {
            this.rawOrderData = ''
            this.confirmRawOrder = false
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
            let boxes = document.getElementById("productList");
            let clone = boxes.cloneNode(true);
            document.getElementById("productListLast").appendChild(clone);
        },
        inPriceProduct: function(value) {
            console.log(value.target.value)
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