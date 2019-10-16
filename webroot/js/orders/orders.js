Vue.component('paginate', VuejsPaginate)
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