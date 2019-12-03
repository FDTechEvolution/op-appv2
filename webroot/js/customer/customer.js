let customer = new Vue ({
    el: '#customer',
    data () {
        return {
            customers: [],
            addresses: [],
            customerID: '',
            addressName: '',
            duplicateMsg: '',
            duplicated: false,
            duplicatedName: false,
            duplicatedMobile: false,
            loading: {
                customer: true,
                address: true
            },
            Customer: {
                name: '',
                mobile: '',
                description: ''
            },
            editCustomer: {
                id: '',
                name: '',
                mobile: '',
                description: ''
            },
            delCustomer: {
                id: '',
                name: '',
                index: ''
            },
            Address: {
                id: '',
                line1: '',
                subdistrict: '',
                district: '',
                province: '',
                zipcode: '',
                description: ''
            },
            errorMsg: {
                name: '',
                mobile: '',
                line1: '',
                subdistrict: '',
                district: '',
                province: '',
                zipcode: ''
            },
            validate: {
                name: false,
                mobile: false,
                line1: false,
                subdistrict: false,
                district: false,
                province: false,
                zipcode: false
            },
            showCustomerCreate: false,
            showCustomerEdit: false,
            showConfirmDeleteCustomer: false,
            showAddress: false,
            showCreateAddress: false,
            showModalEditAddress: false
        }
    },
    mounted () {
        this.loadCustomer()
    },
    methods: {
        loadCustomer: function () {
            axios.get(apiUrl + 'customers/all?org=' + localStorage.getItem('ORG'))
            .then((response) => {
                this.customers = response.data
            })
            .catch(e => {
                console.log(e)
            })
            .finally(() => this.loading.customer = false)
        },
        showCreateCustomer: function () {
            this.showCustomerCreate = true
        },
        closeCreateCustomer: function () {
            this.showCustomerCreate = false
            //customer data
            this.Customer.name = ''
            this.Customer.mobile = ''
            this.Customer.description = ''
            this.Address.line1 = ''
            this.Address.subdistrict = ''
            this.Address.district = ''
            this.Address.province = ''
            this.Address.zipcode = ''
            this.Address.description = ''
            //errorMsg
            this.errorMsg.name = ''
            this.errorMsg.mobile = ''
            this.errorMsg.line1 = ''
            this.errorMsg.subdistrict = ''
            this.errorMsg.district = ''
            this.errorMsg.province = ''
            this.errorMsg.zipcode = ''
            //validate
            this.validate.name = false
            this.validate.mobile = false
            this.validate.line1 = false
            this.validate.subdistrict = false
            this.validate.district = false
            this.validate.province = false
            this.validate.zipcode = false
            //duplicate
            this.duplicatedName = false
            this.duplicatedMobile = false
            this.duplicateMsg = ''
            this.duplicated = false
        },
        chkNullCustomer: function () {
            if (!this.Customer.name) {
                this.errorMsg.name = 'กรุณาเพิ่มชื่อลูกค้า'
                this.validate.name = true
            }else if (!this.Customer.mobile || this.Customer.mobile.length != 10) {
                if (!this.Customer.mobile) {
                    this.errorMsg.mobile = 'กรุณาระบบหมายเลขโทรศัพท์ของลูกค้า'
                }else if (this.Customer.mobile.length < 10) {
                    this.errorMsg.mobile = 'จำนวนหมายเลขโทรศัพท์มีไม่ครบ 10 หลัก'
                }else if (this.Customer.mobile.length > 10) {
                    this.errorMsg.mobile = 'จำนวนหมายเลขโทรศัพท์เกิน 10 หลัก'
                }
                this.validate.mobile = true
                this.errorMsg.name = ''
                this.validate.name = false
            }else if (!this.Address.line1) {
                this.errorMsg.line1 = 'กรุณาเพิ่มที่อยู่'
                this.validate.line1 = true
                this.errorMsg.mobile = ''
                this.validate.mobile = false
                this.errorMsg.name = ''
                this.validate.name = false
            }else if (!this.Address.subdistrict) {
                this.errorMsg.subdistrict = "กรุณาเพิ่มแขวง/ตำบล"
                this.validate.subdistrict = true
                this.errorMsg.line1 = ''
                this.validate.line1 = false
                this.errorMsg.mobile = ''
                this.validate.mobile = false
                this.errorMsg.name = ''
                this.validate.name = false
            }else if (!this.Address.district) {
                this.errorMsg.district = "กรุณาเพิ่มเขต/อำภอ"
                this.validate.district = true
                this.errorMsg.subdistrict = ''
                this.validate.subdistrict = false
                this.errorMsg.line1 = ''
                this.validate.line1 = false
                this.errorMsg.mobile = ''
                this.validate.mobile = false
                this.errorMsg.name = ''
                this.validate.name = false
            }else if (!this.Address.province) {
                this.errorMsg.province = "กรุณาเพิ่มจังหวัด"
                this.validate.province = true
                this.errorMsg.district = ''
                this.validate.district = false
                this.errorMsg.subdistrict = ''
                this.validate.subdistrict = false
                this.errorMsg.line1 = ''
                this.validate.line1 = false
                this.errorMsg.mobile = ''
                this.validate.mobile = false
                this.errorMsg.name = ''
                this.validate.name = false
            }else if (!this.Address.zipcode || this.Address.zipcode.length != 5) {
                if (!this.Address.zipcode) {
                    this.errorMsg.zipcode = "กรุณาเพิ่มรหัสไปรษณีย์"
                }else if (this.Address.zipcode.length != 5) {
                    this.errorMsg.zipcode = "รหัสไปรษณีย์ต้องมี 5 หลัก"
                }
                this.validate.zipcode = true
                this.errorMsg.province = ''
                this.validate.province = false
                this.errorMsg.district = ''
                this.validate.district = false
                this.errorMsg.subdistrict = ''
                this.validate.subdistrict = false
                this.errorMsg.line1 = ''
                this.validate.line1 = false
                this.errorMsg.mobile = ''
                this.validate.mobile = false
                this.errorMsg.name = ''
                this.validate.name = false
            }else {
                this.errorMsg.zipcode = ''
                this.validate.zipcode = false
                this.errorMsg.province = ''
                this.validate.province = false
                this.errorMsg.district = ''
                this.validate.district = false
                this.errorMsg.subdistrict = ''
                this.validate.subdistrict = false
                this.errorMsg.line1 = ''
                this.validate.line1 = false
                this.errorMsg.mobile = ''
                this.validate.mobile = false
                this.errorMsg.name = ''
                this.validate.name = false
                this.saveCreateCustomer()
            }
        },
        saveCreateCustomer: function () {
            axios.post(apiUrl + 'customers/create', {
                org_id: localStorage.getItem('ORG'),
                name: this.Customer.name,
                mobile: this.Customer.mobile,
                description: this.Customer.description,
                line1: this.Address.line1,
                subdistrict: this.Address.subdistrict,
                district: this.Address.district,
                province: this.Address.province,
                zipcode: this.Address.zipcode,
                addressDescription: this.Address.description
            })
            .then((response) => {
                if (!response.data[0].result) {
                    if(response.data[0].msg == 'name duplicate.') {
                        this.duplicateMsg = 'ชื่อลูกค้ามีอยู่ในระบบแล้ว กรุณาตรวจสอบ...'
                        this.duplicated = true
                        this.duplicatedName = true
                        this.duplicatedMobile = false
                    }else if (response.data[0].msg == 'mobile duplicate.') {
                        this.duplicateMsg = 'หมายเลขโทรศัพท์มีการใช้ซ้ำกัน กรุณาตรวจสอบ...'
                        this.duplicated = true
                        this.duplicatedMobile = true
                        this.duplicatedName = false
                    }
                }else{
                    this.loading.customer = true
                    this.closeCreateCustomer()
                    this.loadCustomer()
                }
            })
            .catch(e => {
                console.log(e)
            })
        },
        showEditCustomer: function (id, name, mobile, description) {
            this.showCustomerEdit = true
            this.editCustomer.id = id
            this.editCustomer.name = name
            this.editCustomer.mobile = mobile
            this.editCustomer.description = description
        },
        closeEditCustomer: function () {
            this.showCustomerEdit = false
            this.duplicatedName = false
            this.duplicatedMobile = false
            this.duplicateMsg = ''
            this.duplicated = false
        },
        chkNullEditCustomer: function () {
            if (!this.editCustomer.name) {
                this.errorMsg.name = 'กรุณาเพิ่มชื่อลูกค้า'
                this.validate.name = true
            }else if (!this.editCustomer.mobile || this.editCustomer.mobile.length != 10) {
                if (this.editCustomer.mobile == '') {
                    this.errorMsg.mobile = 'กรุณาระบบหมายเลขโทรศัพท์ของลูกค้า'
                }else if (this.editCustomer.mobile.length < 10) {
                    this.errorMsg.mobile = 'จำนวนหมายเลขโทรศัพท์มีไม่ครบ 10 หลัก'
                }else if (this.editCustomer.mobile.length > 10) {
                    this.errorMsg.mobile = 'จำนวนหมายเลขโทรศัพท์เกิน 10 หลัก'
                }
                this.validate.mobile = true
                this.errorMsg.name = ''
                this.validate.name = false
            }else{
                this.errorMsg.mobile = ''
                this.validate.mobile = false
                this.errorMsg.name = ''
                this.validate.name = false
                this.saveEditCustomer()
            }
        },
        saveEditCustomer: function () {
            axios.post(apiUrl + 'customers/update/' + this.editCustomer.id, {
                org_id: localStorage.getItem('ORG'),
                name: this.editCustomer.name,
                mobile: this.editCustomer.mobile,
                description: this.editCustomer.description
            })
            .then((response) => {
                if (!response.data.result) {
                    if(response.data.msg == 'name duplicate.') {
                        this.duplicateMsg = 'ชื่อลูกค้ามีอยู่ในระบบแล้ว กรุณาตรวจสอบ...'
                        this.duplicated = true
                        this.duplicatedName = true
                        this.duplicatedMobile = false
                    }else if (response.data.msg == 'mobile duplicate.') {
                        this.duplicateMsg = 'หมายเลขโทรศัพท์มีการใช้ซ้ำกัน กรุณาตรวจสอบ...'
                        this.duplicated = true
                        this.duplicatedMobile = true
                        this.duplicatedName = false
                    }
                }else{
                    this.duplicatedName = false
                    this.duplicatedMobile = false
                    this.showCustomerEdit = false
                    this.loadCustomer();
                }
            })
            .catch(e => {
                console.log(e)
            })
        },
        confirmDeleteCustomer: function (id, name, index) {
            this.showConfirmDeleteCustomer = true
            this.delCustomer.id = id
            this.delCustomer.name = name
            this.delCustomer.index = index
        },
        deleteCustomer: function (id, index) {
            axios.post(apiUrl + 'customers/delete/' + id)
            .then(() => {
                this.showConfirmDeleteCustomer = false
                this.customers.splice(index,1)
            })
            .catch(e => {
                console.log(e)
            })
        },

        /// Address Section //////////////////////////////////////////////////////////
        loadAddress: function (id) {
            this.customerID = id
            axios.get(apiUrl + 'customers/get_address/' + id)
            .then((response) => {
                this.addresses = response.data
            })
            .catch(e => {
                console.log(e)
            })
            .finally(() => this.loading.address = false)
        },
        showModalAddress: function (id, name) {
            this.showAddress = true
            this.addressName = name
            this.loadAddress(id)
        },
        closeAddress: function () {
            this.showAddress = false
            this.loading.address = true
            this.addressName = ''
        },
        createAddress: function () {
            this.showCreateAddress = true
        },
        closeCreateAddress: function () {
            this.showCreateAddress = false
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
            //
            this.Address.line1 = ''
            this.Address.subdistrict = ''
            this.Address.district = ''
            this.Address.province = ''
            this.Address.zipcode = ''
            this.Address.description = ''
            this.showModalAddress(this.customerID, this.addressName)
        },
        chkNullAddress: function () {
            if(!this.Address.line1) {
                this.errorMsg.line1 = "กรุณาเพิ่มที่อยู่"
                this.validate.line1 = true
            }
            else if(!this.Address.subdistrict) {
                this.errorMsg.subdistrict = "กรุณาเพิ่มแขวง/ตำบล"
                this.validate.subdistrict = true
                this.errorMsg.line1 = ""
                this.validate.line1 = false
            }
            else if(!this.Address.district) {
                this.errorMsg.district = "กรุณาเพิ่มเขต/อำภอ"
                this.validate.district = true
                this.errorMsg.line1 = ""
                this.validate.line1 = false
                this.errorMsg.subdistrict = ""
                this.validate.subdistrict = false
            }
            else if(!this.Address.province){
                this.errorMsg.province = "กรุณาเพิ่มจังหวัด"
                this.validate.province = true
                this.errorMsg.line1 = ""
                this.validate.line1 = false
                this.errorMsg.subdistrict = ""
                this.validate.subdistrict = false
                this.errorMsg.district = ""
                this.validate.district = false
            }
            else if(!this.Address.zipcode || this.Address.zipcode.length != 5){
                if(!this.Address.zipcode){
                    this.errorMsg.zipcode = "กรุณาเพิ่มรหัสไปรษณีย์"
                }else if(this.Address.zipcode.length != 5){
                    this.errorMsg.zipcode = "รหัสไปรษณีย์ต้องมี 5 หลัก"
                }
                this.validate.zipcode = true
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
                this.saveCreateAddress()
            }
        },
        saveCreateAddress: function () {
            axios.post(apiUrl + 'customers/createaddress', {
                customer_id: this.customerID,
                line1: this.Address.line1,
                subdistrict: this.Address.subdistrict,
                district: this.Address.district,
                province: this.Address.province,
                zipcode: this.Address.zipcode,
                description: this.Address.description
            })
            .then(() => {
                this.showCreateAddress = false
                this.loading.address = true
                this.showModalAddress(this.customerID, this.addressName)
            })
            .catch(e => {
                console.log(e)
            })
        },
        showEditAddress: function (id, line1, subdistrict, district, province, zipcode, description) {
            this.Address.id = id
            this.Address.line1 = line1
            this.Address.subdistrict = subdistrict
            this.Address.district = district
            this.Address.province = province
            this.Address.zipcode = zipcode
            this.Address.description = description
            this.showModalEditAddress = true
        },
        closeEditAddress: function () {
            this.showModalEditAddress = false
            this.Address.id = ''
            this.Address.line1 = ''
            this.Address.subdistrict = ''
            this.Address.district = ''
            this.Address.province = ''
            this.Address.zipcode = ''
            this.Address.description = ''
        },
        chkEditAddress: function (id) {
            if(!this.Address.line1) {
                this.errorMsg.line1 = "กรุณาเพิ่มที่อยู่"
                this.validate.line1 = true
            }
            else if(!this.Address.subdistrict) {
                this.errorMsg.subdistrict = "กรุณาเพิ่มแขวง/ตำบล"
                this.validate.subdistrict = true
                this.errorMsg.line1 = ""
                this.validate.line1 = false
            }
            else if(!this.Address.district) {
                this.errorMsg.district = "กรุณาเพิ่มเขต/อำภอ"
                this.validate.district = true
                this.errorMsg.line1 = ""
                this.validate.line1 = false
                this.errorMsg.subdistrict = ""
                this.validate.subdistrict = false
            }
            else if(!this.Address.province){
                this.errorMsg.province = "กรุณาเพิ่มจังหวัด"
                this.validate.province = true
                this.errorMsg.line1 = ""
                this.validate.line1 = false
                this.errorMsg.subdistrict = ""
                this.validate.subdistrict = false
                this.errorMsg.district = ""
                this.validate.district = false
            }
            else if(!this.Address.zipcode || this.Address.zipcode.length != 5){
                if(!this.Address.zipcode){
                    this.errorMsg.zipcode = "กรุณาเพิ่มรหัสไปรษณีย์"
                }else if(this.Address.zipcode.length != 5){
                    this.errorMsg.zipcode = "รหัสไปรษณีย์ต้องมี 5 หลัก"
                }
                this.validate.zipcode = true
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
                this.saveEditAddress(id)
            }
        },
        saveEditAddress: function (id) {
            axios.post(apiUrl + 'customers/updateaddress/' + id, {
                line1: this.Address.line1,
                subdistrict: this.Address.subdistrict,
                district: this.Address.district,
                province: this.Address.province,
                zipcode: this.Address.zipcode,
                description: this.Address.description
            })
            .then(() => {
                this.showModalEditAddress = false
                this.loading.address = true
                this.Address.id = ''
                this.Address.line1 = ''
                this.Address.subdistrict = ''
                this.Address.district = ''
                this.Address.province = ''
                this.Address.zipcode = ''
                this.Address.description = ''
                this.showModalAddress(this.customerID, this.addressName)
            })
            .catch(e => {
                console.log(e)
            })
        },
        delleteAddress: function (id, line1, subdistrict, district, province, zipcode, index) {
            if(confirm("ยืนยันการลบที่อยู่ " + line1 +" ต."+subdistrict+" อ."+district+" จ."+province+" "+zipcode+" ?")){
                axios.post(apiUrl + 'customers/deleteaddress/' + id)
                .then(() => {
                    setTimeout(function () {
                        this.addresses.splice(index,1)
                    }.bind(this), 0);
                })
                .catch (e => {
                    console.log(e)
                })
            }
        }
    }
})

Vue.component('create-customer', {
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

Vue.component('modal-customer', {
    template: `<transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container" style="max-height: 700px; overflow-y: scroll;">

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

Vue.component('address-detail', {
    template: `<transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container" style="width: 800px; max-height: 700px; overflow-y: scroll;">

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