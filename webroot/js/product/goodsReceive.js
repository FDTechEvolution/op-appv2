let createline = new Vue ({
    el: '#createline',
    data () {
        return {
            bpartners: [],
            warehouses: [],
            users: [],
            userlogin: '',
            description: '',
            showCreate: false,
            loading: true,
            shipments: [],
            products: [],
            loadShipmentLines: [],
            addProducts: false,
            showProductLine: false,
            shipmentLines: {
                id: '',
                bpartner: '',
                towarehouse: '',
                status: ''
            },
            lineCreate: {
                product: '',
                qty: '',
                description: ''
            }
        }
    },
    mounted () {
        this.loadBpartner(),
        this.loadWarehouse(),
        this.loadUser(),
        this.loadShipment()
        this.loadProduct()
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
                    this.loading = false
                    this.loadShipment();
                }.bind(this), 0);
            })
            .catch (e => {
                console.log(e)
            })
        },
        shipmentDel: function (id, index) {
            if(confirm("ยืนยันการลบ?")){
                axios.post(apiUrl + 'goods-receive/shipmentdel/' + id)
                .then(() => {
                    this.shipments.splice(index,1)
                })
                .catch(e => {
                    console.log(e)
                })
            }
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
        },

        // shipmentline section

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
        shipmentLine: function (id, bpartner, towarehouse, status) {
            this.addProducts = true
            this.shipmentLines.id = id
            this.shipmentLines.bpartner = bpartner
            this.shipmentLines.towarehouse = towarehouse
            this.shipmentLines.status = status
            this.loadShipmentLine()
        },
        backToShipment: function () {
            this.addProducts = false
            this.shipmentLines.id = ''
            this.shipmentLines.bpartner = ''
            this.shipmentLines.towarehouse = ''
            this.shipmentLines.status = ''
        },
        createShipmentLine: function (){
            axios.post(apiUrl + 'goods-receive/createline/', {
                shipment_inout_id: this.shipmentLines.id,
                product_id: document.getElementById('products').value,
                qty: this.lineCreate.qty,
                description: this.lineCreate.description
            })
            .then(() => {
                this.showProductLine = false
                this.lineCreate.qty = ''
                this.shipmentLines.description = ''
                setTimeout(function () {
                    this.loadShipmentLine(this.shipmentLines.id);
                }.bind(this), 0);
            })
            .catch(e => {
                console.log(e)
            })
        },
        loadShipmentLine: function () {
            axios.get(apiUrl + 'goods-receive/shipmentline/' + this.shipmentLines.id)
            .then((response) => {
                this.loadShipmentLines = response.data
            })
            .catch(e => {
                console.log(e)
            })
        },
        confirmCreateShipmentLine: function (id) {
            if(confirm("ถ้ายืนยันแล้วจะไม่สามารถแก้ไขได้อีก \n ยืนยันการรับสินค้า?")){
                axios.post(apiUrl + 'goods-receive/lineconfirm/' + id)
                .then((response) => {
                    let Checked = response.data.result
                    if(!Checked){
                        alert("ไม่มีรายการสินค้า ไม่สามารถยืนยันการรับรายการสินค้าได้!")
                    }else{
                        this.addProducts = false
                    }
                })
                .catch(e => {
                    console.log(e)
                })
            }
        },
        shipmentLineDel: function (id, index) {
            axios.post(apiUrl + 'goods-receive/delete/' + id)
            .then(() => {
                this.loadShipmentLines.splice(index,1)
            })
            .catch (e => {
                console.log(e)
            })
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