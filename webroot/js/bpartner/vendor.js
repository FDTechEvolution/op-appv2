let bpartner = new Vue ({
    el: '#bpartner-vendor',
    data () {
        return {
            bpartners: [],
            addresses: [],
            showBpartner: false,
            showModalEditBpartner: false,
            showDeleteBpartner: false,
            showAddress: false,
            showCreateAddress: false,
            showModalEditAddress: false,
            addressCompany: '',
            bpartnerID: '',
            duplicateMsg: '',
            duplicated: false,
            loading: {
                bpartner: true,
                address: true
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
            editBpartner: {
                id: '',
                company: '',
                name: '',
                mobile: '',
                description: '',
                isactive: ''
            },
            delBpartner: {
                id: '',
                company: '',
                name: '',
                index: ''
            },
            Address: {
                line1: '',
                subdistrict: '',
                district: '',
                province: '',
                zipcode: '',
                addressDescription: ''
            },
            editAddress: {
                id: '',
                line1: '',
                subdistrict: '',
                district: '',
                province: '',
                zipcode: '',
                addressDescription: ''
            },
            errorMsg: {
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
        this.loadBpartner()
    },
    methods: {
        loadBpartner: function () {
            axios.get(apiUrl + 'bpartners/all?org=' + localStorage.getItem('ORG') + '&level=vendor')
            .then((response) => {
                this.bpartners = response.data
            })
            .catch(e => {
                console.log(e)
            })
            .finally(() => this.loading.bpartner = false)
        },

        // Create Bpartner ////////////////////////////////////////////////////////////////////
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

        // Edit Bpartner ////////////////////////////////////////////////////////////////////
        showEditBpartner:function (id, company, name, mobile, description, isactive) {
            this.editBpartner.id = id
            this.editBpartner.company = company
            this.editBpartner.name = name
            this.editBpartner.mobile = mobile
            this.editBpartner.description = description
            this.editBpartner.isactive = isactive
            this.showModalEditBpartner = true
        },
        checkNullEditBpartner: function () {
            if(this.editBpartner.company == '') {
                this.errorMsg.company = "กรุณาเพิ่มข้อมูลบริษัท"
                this.validate.company = true
            }
            else if(this.editBpartner.name == '') {
                this.errorMsg.name = "กรุณาเพิ่มชื่อผู้ติดต่อ"
                this.validate.name = true
                this.errorMsg.company = ""
                this.validate.company = false
            }
            else if(this.editBpartner.mobile == '') {
                this.errorMsg.mobile = "กรุณาเพิ่มหมายเลขติดต่อ"
                this.validate.mobile = true
                this.errorMsg.company = ""
                this.validate.company = false
                this.errorMsg.name = ""
                this.validate.name = false
            }
            else {
                this.errorMsg.mobile = ""
                this.validate.mobile = false
                this.errorMsg.company = ""
                this.validate.company = false
                this.errorMsg.name = ""
                this.validate.name = false
                this.editBpartnerfnc()
            }
        },
        editBpartnerfnc: function () {
            axios.post(apiUrl + 'bpartners/update/' + this.editBpartner.id , {
                company: this.editBpartner.company,
                name: this.editBpartner.name,
                mobile: this.editBpartner.mobile,
                description: this.editBpartner.description,
                isactive: this.editBpartner.isactive,
                org_id: localStorage.getItem('ORG')
            })
            .then((response) => {
                let Checked = response.data.result
                if(!Checked) {
                    this.duplicateMsg = "มีการใช้ซ้ำ กรุณาเปลี่ยน..."
                    this.duplicated = true
                }else{
                    this.duplicateMsg = ''
                    this.duplicated = false
                    this.showModalEditBpartner = false
                    setTimeout(function () {
                        this.loadBpartner();
                    }.bind(this), 0);
                }
            })
        },

        // Delete Bpartner ////////////////////////////////////////////////////////////////////
        confirmDelBpartner:function (id, company, name, index) {
            this.delBpartner.id = id
            this.delBpartner.company = company
            this.delBpartner.name = name
            this.delBpartner.index = index
            this.showDeleteBpartner = true
        },
        bpartnerDelete: function (id, index) {
            axios.post(apiUrl + 'bpartners/delete/' + id)
            .then(() => {
                this.showDeleteBpartner = false
                this.bpartners.splice(index,1)
            })
            .catch(e => {
                console.log(e)
            })
        },
        
        // Load Address ///////////////////////////////////////////////////////////////////
        loadAddress: function (id) {
            this.bpartnerID = id
            axios.get(apiUrl + 'bpartners/getaddress/' + id)
            .then((response) => {
                this.addresses = response.data
            })
            .catch(e => {
                console.log(e)
            })
            .finally(() => this.loading.address = false)
        },
        showModalAddress: function (id, company) {
            this.showAddress = true
            this.addressCompany = company
            this.loadAddress(id)
        },
        closeAddress: function () {
            this.showAddress = false
            this.loading.address = true
            this.addressCompany = ''
        },
        createAddress: function () {
            this.showCreateAddress = true
        },
        closeCreateAddress: function () {
            this.showCreateAddress = false
            this.showModalAddress(this.bpartnerID, this.addressCompany)
        },
        saveCreateAddress: function () {
            axios.post(apiUrl + 'bpartners/createaddress', {
                bpartner_id: this.bpartnerID,
                line1: this.Address.line1,
                subdistrict: this.Address.subdistrict,
                district: this.Address.district,
                province: this.Address.province,
                zipcode: this.Address.zipcode
            })
            .then(() => {
                this.showCreateAddress = false
                this.loading.address = true
                this.showModalAddress(this.bpartnerID, this.addressCompany)
            })
            .catch(e => {
                console.log(e)
            })
        },
        showEditAddress: function (id, line1, subdistrict, district, province, zipcode, description) {
            this.editAddress.id = id
            this.editAddress.line1 = line1
            this.editAddress.subdistrict = subdistrict
            this.editAddress.district = district
            this.editAddress.province = province
            this.editAddress.zipcode = zipcode
            this.editAddress.addressDescription = description
            this.showModalEditAddress = true
        },
        closeEditAddress: function () {
            this.showModalEditAddress = false
        },
        saveEditAddress: function (id) {
            axios.post(apiUrl + 'bpartners/updateaddress/' + id, {
                line1: this.editAddress.line1,
                subdistrict: this.editAddress.subdistrict,
                district: this.editAddress.district,
                province: this.editAddress.province,
                zipcode: this.editAddress.zipcode,
                description: this.editAddress.addressDescription
            })
            .then(() => {
                this.showModalEditAddress = false
                this.loading.address = true
                this.showModalAddress(this.bpartnerID, this.addressCompany)
            })
            .catch(e => {
                console.log(e)
            })
        },
        delleteAddress: function (id, line1, subdistrict, district, province, zipcode, index) {
            if(confirm("ยืนยันการลบที่อยู่ " + line1 +" ต."+subdistrict+" อ."+district+" จ."+province+" "+zipcode+" ?")){
                axios.post(apiUrl + 'bpartners/deleteaddress/' + id)
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

Vue.component('modal-bpartner', {
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