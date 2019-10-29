let createline = new Vue ({
    el: '#createline',
    data () {
        return {
            bpartners: [],
            warehouses: [],
            users: [],
            userlogin: '',
            description: '',
            showCreate: false
        }
    },
    mounted () {
        this.loadBpartner(),
        this.loadWarehouse(),
        this.loadUser()
    },
    methods: {
        createWH: function () {
            axios.post(apiUrl + 'goods-receive/create/', {
                org_id: localStorage.getItem('ORG'),
                bpartner_id: document.getElementById('bpartner').value,
                to_warehouse_id: document.getElementById('warehouse').value,
                user_id: document.getElementById('user').value,
                description: this.description
            })
            .then(() => {
                this.description = ''
                this.showCreate = false
                setTimeout(function () {
                    this.loading = true
                    this.loadShipment();
                }.bind(this), 0);
            })
            .catch (e => {
                console.log(e)
            })
        },
        createline: function (stat) {
            if(stat == true){
                this.showCreate = false
            }else{
                this.showCreate = true
            }
        },
        loadBpartner: function () {
            axios.get(apiUrl + 'bpartners/all/' + localStorage.getItem('ORG'))
            .then((response) => {
                this.bpartners = response.data
            })
            .catch (e => {
                console.log(e)
            })
        },
        loadWarehouse: function () {
            axios.get(apiUrl + 'warehouses/all/' + localStorage.getItem('ORG'))
            .then((response) => {
                this.warehouses = response.data
            })
            .catch (e => {
                console.log(e)
            })
        },
        loadUser: function () {
            axios.get(apiUrl + 'users/all?org=' + localStorage.getItem('ORG'))
            .then((response) => {
                this.users = response.data
                this.userlogin = localStorage.getItem('USER_ID')
            })
            .catch (e => {
                console.log(e)
            })
        }
    }
})

let shipmentline = new Vue ({
    el: '#shipment-line',
    data () {
        return {
            loading: true,
            shipments: [],
            products: [],
            addProducts: false,
            showProductLine: false,
            shipmentLines: {
                id: '',
                bpartner: '',
                towarehouse: ''
            },
            lineCreate: {
                product: '',
                qty: '',
                description: ''
            }
        }
    },
    mounted () {
        this.loadShipment()
        this.loadProduct()
        this.loadShipmentLine()
    },
    methods: {
        loadShipment: function () {
            axios.get(apiUrl + 'goods-receive/all/' + localStorage.getItem('ORG'))
            .then((response) => {
                this.shipments = response.data
            })
            .catch(e => {
                console.log(e)
            })
            .finally(() => this.loading = false)
        },
        shipmentLine: function (id, bpartner, towarehouse) {
            this.addProducts = true
            this.shipmentLines.id = id
            this.shipmentLines.bpartner = bpartner
            this.shipmentLines.towarehouse = towarehouse
        },
        createShipmentLine: function (){
            axios.post(apiUrl + 'goods-receive/createline/', {
                shipment_inout_id: this.shipmentLines.id,
                product_id: document.getElementById('products').value,
                qty: this.lineCreate.qty,
                description: this.shipmentLines.description
            })
            .then((response) => {
                this.showProductLine = false
                console.log(response)
            })
            .catch(e => {
                console.log(e)
            })
        },
        loadShipmentLine: function () {
            axios.get(apiUrl + 'goods-receive/shipmentline/')
            .then((response) => {
                this.loadShipmentLines = response.data
            })
            .catch(e => {
                console.log(e)
            })
        },
        confirmCreateShipmentLine: function () {

        },
        loadProduct: function () {
            axios.get(apiUrl + 'products/all?org=' + localStorage.getItem('ORG'))
            .then((response) => {
                this.products = response.data
            })
            .catch (e => {
                console.log(e)
            })
            .finally(() => this.loading = false)
        }
    }
})

let users = new Vue ({
    el: '#users',
    data () {
        return {
            name: '',
            mobile: '',
            email: ''
        }
    },
    mounted () {
        this.loadUser()
    },
    methods: {
        loadUser: function () {
            axios.get(apiUrl + 'users/get/' + localStorage.getItem('USER_ID'))
            .then((response) => {
                this.name = response.data.name,
                this.mobile = response.data.mobile,
                this.email = response.data.email,
                localStorage.setItem('ORG', response.data.org_id)
            })
            .catch (e => {
                console.log(e)
            })
        }
    }
})

Vue.component('modal', {
    template: `<transition name="modal">
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
  </transition>`
})