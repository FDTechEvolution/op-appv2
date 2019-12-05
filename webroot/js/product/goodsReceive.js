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
            loadingShipment: true,
            loadingShipmentLine: true,
            shipments: [],
            products: [],
            loadShipmentLines: [],
            addProducts: false,
            showProductLine: false,
            showBpartner: false,
            duplicateMsg: '',
            duplicated: false,
            showCreateWarehouse: false,
            shipmentLines: {
                id: '',
                bpartner: '',
                towarehouse: '',
                status: '',
                user: '',
                date: '',
                description: ''
            },
            Bpartner: {
                company: '',
                name: '',
                mobile: '',
                description: '',
                line1: '',
                subdistrict: '',
                district: '',
                province: '',
                zipcode: '',
                addressDescription: ''
            },
            warehouse: {
                name: '',
                description: ''
            },
            lineCreate: {
                product: '',
                qty: '',
                description: ''
            },
            errorMsg: {
                bpartner: '',
                warehouse: '',
                company: '',
                name: '',
                mobile: '',
                level: '',
                line1: '',
                subdistrict: '',
                district: '',
                province: '',
                zipcode: '',
                warehouseName: '',
                productList: '',
                productQty: ''     
            },
            validate: {
               bpartner: false,
               warehouse: false,
               company: false,
               name: false,
               mobile: false,
               level: false,
               line1: false,
               subdistrict: false,
               district: false,
               province: false,
               zipcode: false,
               warehouseName: false,
               productList: false,
               productQty: false
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
        checkNullWH: function () {
            if (this.bpartners.length == 0) {
                this.errorMsg.bpartner = 'กรุณาเพิ่ม'
            }
            else if (document.getElementById('bpartner').value == '') {
                this.errorMsg.bpartner = 'กรุณาเลือก'
                this.validate.bpartner = true
            }
            else if (this.warehouses.length == 0) {
                this.errorMsg.warehouse = 'กรุณาเพิ่ม'
                this.errorMsg.bpartner = ''
                this.validate.bpartner = false
            }
            else if (document.getElementById('warehouse').value == '') {
                this.errorMsg.warehouse = 'กรุณาเลือก'
                this.validate.warehouse = true
                this.errorMsg.bpartner = ''
                this.validate.bpartner = false
            }
            else {
                this.createWH()
            }
        },
        createWH: function () {
            axios.post(apiUrl + 'goods-receive/create/', {
                org_id: localStorage.getItem('ORG'),
                bpartner_id: document.getElementById('bpartner').value,
                to_warehouse_id: document.getElementById('warehouse').value,
                user_id: document.getElementById('user').value,
                description: this.description
            })
            .then((response) => {
                this.description = ''
                this.showCreate = false
                this.loading = true
                this.loadingShipment = true
                setTimeout(function () {
                    this.loadShipment();
                }.bind(this), 0);
                this.loadShipmentCreate(response.data.msg)
            })
            .catch (e => {
                console.log(e)
            })
        },
        checkNullBpartner: function () {
            if(this.Bpartner.company == '') {
                this.errorMsg.company = "กรุณาเพิ่มข้อมูลบริษัท"
                this.validate.company = true
            }
            else if(this.Bpartner.name == '') {
                this.errorMsg.name = "กรุณาเพิ่มชื่อผู้ติดต่อ"
                this.validate.name = true
                this.errorMsg.company = ""
                this.validate.company = false
            }
            else if(this.Bpartner.mobile == '') {
                this.errorMsg.mobile = "กรุณาเพิ่มหมายเลขติดต่อ"
                this.validate.mobile = true
                this.errorMsg.company = ""
                this.validate.company = false
                this.errorMsg.name = ""
                this.validate.name = false
            }
            else if(document.getElementById('level').value == '') {
                this.errorMsg.level = "กรุณาเลือกระดับคู่ค้า"
                this.validate.level = true
                this.errorMsg.company = ""
                this.validate.company = false
                this.errorMsg.name = ""
                this.validate.name = false
                this.errorMsg.mobile = ""
                this.validate.mobile = false
            }
            else if(this.Bpartner.line1 == '') {
                this.errorMsg.line1 = "กรุณาเพิ่มที่อยู่"
                this.validate.line1 = true
                this.errorMsg.company = ""
                this.validate.company = false
                this.errorMsg.name = ""
                this.validate.name = false
                this.errorMsg.mobile = ""
                this.validate.mobile = false
                this.errorMsg.level = ""
                this.validate.level = false
            }
            else if(this.Bpartner.subdistrict == '') {
                this.errorMsg.subdistrict = "กรุณาเพิ่มแขวง/ตำบล"
                this.validate.subdistrict = true
                this.errorMsg.company = ""
                this.validate.company = false
                this.errorMsg.name = ""
                this.validate.name = false
                this.errorMsg.mobile = ""
                this.validate.mobile = false
                this.errorMsg.level = ""
                this.validate.level = false
                this.errorMsg.line1 = ""
                this.validate.line1 = false
            }
            else if(this.Bpartner.district == '') {
                this.errorMsg.district = "กรุณาเพิ่มเขต/อำภอ"
                this.validate.district = true
                this.errorMsg.company = ""
                this.validate.company = false
                this.errorMsg.name = ""
                this.validate.name = false
                this.errorMsg.mobile = ""
                this.validate.mobile = false
                this.errorMsg.level = ""
                this.validate.level = false
                this.errorMsg.line1 = ""
                this.validate.line1 = false
                this.errorMsg.subdistrict = ""
                this.validate.subdistrict = false
            }
            else if(this.Bpartner.province == ''){
                this.errorMsg.province = "กรุณาเพิ่มจังหวัด"
                this.validate.province = true
                this.errorMsg.company = ""
                this.validate.company = false
                this.errorMsg.name = ""
                this.validate.name = false
                this.errorMsg.mobile = ""
                this.validate.mobile = false
                this.errorMsg.level = ""
                this.validate.level = false
                this.errorMsg.line1 = ""
                this.validate.line1 = false
                this.errorMsg.subdistrict = ""
                this.validate.subdistrict = false
                this.errorMsg.district = ""
                this.validate.district = false
            }
            else if(this.Bpartner.zipcode == ''){
                this.errorMsg.zipcode = "กรุณาเพิ่มรหัสไปรษณีย์"
                this.validate.zipcode = true
                this.errorMsg.company = ""
                this.validate.company = false
                this.errorMsg.name = ""
                this.validate.name = false
                this.errorMsg.mobile = ""
                this.validate.mobile = false
                this.errorMsg.level = ""
                this.validate.level = false
                this.errorMsg.line1 = ""
                this.validate.line1 = false
                this.errorMsg.subdistrict = ""
                this.validate.subdistrict = false
                this.errorMsg.district = ""
                this.validate.district = false
                this.errorMsg.province = ""
                this.validate.province = false
            }
            else {
                this.errorMsg.company = ""
                this.validate.company = false
                this.errorMsg.name = ""
                this.validate.name = false
                this.errorMsg.mobile = ""
                this.validate.mobile = false
                this.errorMsg.level = ""
                this.validate.level = false
                this.errorMsg.line1 = ""
                this.validate.line1 = false
                this.errorMsg.subdistrict = ""
                this.validate.subdistrict = false
                this.errorMsg.district = ""
                this.validate.district = false
                this.errorMsg.province = ""
                this.validate.province = false
                this.errorMsg.zipcode = ""
                this.validate.zipcode = false
                this.createBpartner()
            }
        },
        createBpartner: function () {
            axios.post(apiUrl + 'bpartners/create/', {
                org_id: localStorage.getItem('ORG'),
                company: this.Bpartner.company,
                name: this.Bpartner.name,
                mobile: this.Bpartner.mobile,
                level: document.getElementById('level').value,
                description: this.Bpartner.description,
                org_id: localStorage.getItem('ORG'),
                line1: this.Bpartner.line1,
                subdistrict: this.Bpartner.subdistrict,
                district: this.Bpartner.district,
                province: this.Bpartner.province,
                zipcode: this.Bpartner.zipcode,
                addressDescription: this.Bpartner.addressDescription
            })
            .then(() => {
                this.showBpartner = false
                setTimeout(function () {
                    this.loadBpartner();
                }.bind(this), 0);
            })
            .catch (e => {
                console.log(e)
            })
        },
        closeBpartner: function () {
            this.showBpartner = false
            //data
            this.Bpartner.company = ''
            this.Bpartner.name = ''
            this.Bpartner.mobile = ''
            this.Bpartner.description = ''
            this.Bpartner.line1 = ''
            this.Bpartner.subdistrict = ''
            this.Bpartner.district = ''
            this.Bpartner.province = ''
            this.Bpartner.zipcode = ''
            this.Bpartner.addressDescription = ''
            //errorMsg
            this.errorMsg.company = ''
            this.errorMsg.name = ''
            this.errorMsg.mobile = ''
            this.errorMsg.line1 = ''
            this.errorMsg.subdistrict = ''
            this.errorMsg.district = ''
            this.errorMsg.province = ''
            this.errorMsg.zipcode = ''
            //validate
            this.validate.company = false
            this.validate.name = false
            this.validate.mobile = false
            this.validate.line1 = false
            this.validate.subdistrict = false
            this.validate.district = false
            this.validate.province = false
            this.validate.zipcode = false
        },
        checkNullWarehouse: function () {
            if(this.warehouse.name == ''){
                this.errorMsg.warehouseName = 'กรุณาเพิ่มชื่อคลังสินค้า'
                this.validate.warehouseName = true
            }
            else{
                this.errorMsg.warehouseName = ''
                this.validate.warehouseName = false
                this.createWarehouse()
            }
        },
        createWarehouse: function () {
            axios.post(apiUrl + 'warehouses/create/', {
                name: this.warehouse.name,
                description: this.warehouse.description,
                org_id: localStorage.getItem('ORG')
            })
            .then((response) => {
                let Checked = response.data.result
                if(!Checked) {
                    this.duplicateMsg = "ชื่อสินค้า ในประเภทเดียวกันมีการใช้ซ้ำ กรุณาเปลี่ยน..."
                    this.duplicated = true
                }else{
                    this.duplicateMsg = ''
                    this.duplicated = false
                    this.showCreateWarehouse = false
                    this.warehouse.name = ''
                    this.warehouse.description = ''
                    setTimeout(function () {
                        this.loadWarehouse();
                    }.bind(this), 0);
                }
            })
        },
        closeCreateWarehouse: function () {
            this.duplicateMsg = ''
            this.duplicated = false
            this.showCreateWarehouse = false
            this.warehouse.name = ''
            this.warehouse.description = ''
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
                //errorMsg
                this.errorMsg.bpartner = ''
                this.errorMsg.warehouse = ''
                //validate
                this.validate.bpartner = false
                this.validate.warehouse = false
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
            axios.get(apiUrl + 'users/all?org=' + localStorage.getItem('ORG') + '&active=yes')
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
            axios.get(apiUrl + 'goods-receive/all?org=' + localStorage.getItem('ORG'))
            .then((response) => {
                this.shipments = response.data
            })
            .catch(e => {
                console.log(e)
            })
            .finally(() => this.loadingShipment = false)
        },
        loadShipmentCreate: function (id) {
            axios.get(apiUrl + 'goods-receive/all?shipment=' + id)
            .then((response) => {
                this.shipmentLine(response.data[0].id, response.data[0].company, response.data[0].towarehouse, response.data[0].status, response.data[0].user, response.data[0].date, response.data[0].description)
            })
            .catch(e => {
                console.log(e)
            })
        },
        shipmentLine: function (id, bpartner, towarehouse, status, user, date, description) {
            this.addProducts = true
            this.shipmentLines.id = id
            this.shipmentLines.bpartner = bpartner
            this.shipmentLines.towarehouse = towarehouse
            this.shipmentLines.status = status
            this.shipmentLines.user = user
            this.shipmentLines.date = date
            this.shipmentLines.description = description
            this.loadingShipmentLine = true
            this.loadShipmentLine()
        },
        backToShipment: function () {
            this.addProducts = false
            this.shipmentLines.id = ''
            this.shipmentLines.bpartner = ''
            this.shipmentLines.towarehouse = ''
            this.shipmentLines.status = ''
        },
        checkNullShipmentLine: function () {
            if(document.getElementById('products').value == '') {
                this.errorMsg.productList = 'กรุณาเลือกรายการสินค้า'
                this.validate.productList = true
            }
            else if (this.lineCreate.qty == '') {
                this.errorMsg.productQty = 'กรุณาระบุจำนวนสินค้า'
                this.validate.productQty = true
                this.errorMsg.productList = ''
                this.validate.productList = false
            }
            else {
                this.errorMsg.productQty = ''
                this.validate.productQty = false
                this.errorMsg.productList = ''
                this.validate.productList = false
                this.createShipmentLine()
            }
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
                this.lineCreate.description = ''
                this.loadingShipmentLine = true
                setTimeout(function () {
                    this.loadShipmentLine(this.shipmentLines.id);
                }.bind(this), 0);
            })
            .catch(e => {
                console.log(e)
            })
        },
        closeProductLine: function () {
            this.showProductLine = false
            this.errorMsg.productQty = ''
            this.validate.productQty = false
            this.errorMsg.productList = ''
            this.validate.productList = false
            this.lineCreate.qty = ''
            this.lineCreate.description = ''
        },
        loadShipmentLine: function () {
            axios.get(apiUrl + 'goods-receive/shipmentline/' + this.shipmentLines.id)
            .then((response) => {
                this.loadShipmentLines = response.data
            })
            .catch(e => {
                console.log(e)
            })
            .finally(() => this.loadingShipmentLine = false)
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
                        this.loadingShipment = true
                        setTimeout(function () {
                            this.loadShipment();
                        }.bind(this), 0);
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
            axios.get(apiUrl + 'products/all?org=' + localStorage.getItem('ORG') + '&active=yes')
            .then((response) => {
                this.products = response.data
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

Vue.component('create-bpartner', {
    template: `<transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container" style="width: 1100px; height: 700px; overflow: scroll;">

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