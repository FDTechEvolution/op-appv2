Vue.component('modal', {
    template: `<transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container-product">

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

let showproduct = new Vue ({
    el: '#products',
    data () {
        return {
            products: [],
            productCate: [],
            productBrand: [],
            duplicate: '',
            update: {
                id: '',
                name: '',
                code: '',
                cost: '',
                price: '',
                description: '',
                isactive: ''
            },
            create: {
                name: '',
                code: '',
                cost: '',
                price: '',
                description: '',
                isactive: ''
            },
            createBrand: {
                name: '',
                description: '',
                isactive: ''
            },
            createCategory: {
                name: '',
                description: '',
                isactive: ''
            },
            selected: {
                category: '',
                brand: ''
            },
            showCreate: false,
            showCreateBrand: false,
            showCreateCategory: false,
            showEditModal: false,
            loading: true,
            loadingEdit: true,
            duplicated: {
                name: false,
                code: false
            },
            validate: {
                category: false,
                brand: false,
                name: false,
                code: false,
                cost: false,
                price: false,
                isactive: false,
                msg: 'กรุณาใส่รายละเอียดให้ครบด้วยค่ะ...'
            },
            nameDuplicate: ''
        }
    },
    mounted () {
        this.loadProduct()
        this.loadCategory()
        this.loadBrand()
    },
    methods: {
        loadProduct: function () {
            axios.get(apiUrl + 'products/all?org=' + localStorage.getItem('ORG'))
            .then((response) => {
                this.products = response.data
            })
            .catch (e => {
                console.log(e)
            })
            .finally(() => this.loading = false)
        },
        chkvalidateCreate: function () {
            if(document.getElementById('category').value == ''){
                this.validate.category = true
            }else if(document.getElementById('brand').value == ''){
                this.validate.brand = true
                this.validate.category = false
            }else if(this.create.name == ''){
                this.validate.name = true
                this.validate.brand = false
                this.validate.category = false
            }else if(this.create.code == ''){
                this.validate.code = true
                this.validate.name = false
                this.validate.brand = false
                this.validate.category = false
            }else if(this.create.cost == ''){
                this.validate.cost = true
                this.validate.code = false
                this.validate.name = false
                this.validate.brand = false
                this.validate.category = false
            }else if(this.create.price == ''){
                this.validate.price = true
                this.validate.cost = false
                this.validate.code = false
                this.validate.name = false
                this.validate.brand = false
                this.validate.category = false
            }else if(this.create.isactive == ''){
                this.validate.isactive = true
                this.validate.price = false
                this.validate.cost = false
                this.validate.code = false
                this.validate.name = false
                this.validate.brand = false
                this.validate.category = false
            }else{
                this.creatProduct()
            }
        },
        closeCreate: function () {
            this.showCreate = false
            this.validate.isactive = false
            this.validate.price = false
            this.validate.cost = false
            this.validate.code = false
            this.validate.name = false
            this.validate.brand = false
            this.validate.category = false
        },
        creatProduct: function () {
            axios.post(apiUrl + 'products/create', {
                org_id: localStorage.getItem('ORG'),
                product_category_id: document.getElementById('category').value,
                brand_id: document.getElementById('brand').value,
                name: this.create.name,
                code: this.create.code,
                cost: this.create.cost,
                price: this.create.price,
                description: this.create.description,
                isactive: this.create.isactive
            })
            .then((response) => {
                let Checked = response.data.result
                let Reason = response.data.msg
                if(!Checked) {
                    if(Reason === 'Name Duplicate'){
                        this.duplicate = "ชื่อสินค้า ในประเภทเดียวกันมีการใช้ซ้ำ กรุณาเปลี่ยน..."
                        this.duplicated.name = true
                    }else if(Reason === 'Code Duplicate'){
                        this.duplicate = "รหัสสินค้า ในประเภทเดียวกันมีการใช้ซ้ำ กรุณาเปลี่ยน..."
                        this.duplicated.code = true
                        this.duplicated.name = false
                    }
                } else {
                    this.duplicate = ''
                    this.duplicated.name = false
                    this.duplicated.code = false
                    this.showCreate = false
                    this.create.name = ''
                    this.create.code = ''
                    this.create.cost = ''
                    this.create.price = ''
                    this.create.description = ''
                    this.create.isactive = ''
                    setTimeout(function () {
                        this.loading = true
                        this.loadProduct();
                    }.bind(this), 0);
                }
            })
        },
        showEdit: function (edit) {
            this.showEditModal = true
            this.loadingEdit = true
            axios.get(apiUrl + 'products/get/' + edit)
            .then((response) => {
                this.update.id = response.data.id
                this.update.name = response.data.name
                this.update.code = response.data.code
                this.update.cost = response.data.cost
                this.update.price = response.data.price
                this.update.description = response.data.description
                this.update.isactive = response.data.isactive
                this.selected.category = response.data.product_category_id
                this.selected.brand = response.data.brand_id
            })
            .catch (e => {
                console.log(e)
            })
            .finally(() => this.loadingEdit = false)
        },
        closeEdit: function () {
            this.showEditModal = false
            this.validate.isactive = false
            this.validate.price = false
            this.validate.cost = false
            this.validate.code = false
            this.validate.name = false
            this.validate.brand = false
            this.validate.category = false
        },
        chkvalidateUpdate: function (id) {
            if(document.getElementById('category').value == ''){
                this.validate.category = true
            }else if(document.getElementById('brand').value == ''){
                this.validate.brand = true
                this.validate.category = false
            }else if(this.update.name == ''){
                this.validate.name = true
                this.validate.brand = false
                this.validate.category = false
            }else if(this.update.code == ''){
                this.validate.code = true
                this.validate.name = false
                this.validate.brand = false
                this.validate.category = false
            }else if(this.update.cost == ''){
                this.validate.cost = true
                this.validate.code = false
                this.validate.name = false
                this.validate.brand = false
                this.validate.category = false
            }else if(this.update.price == ''){
                this.validate.price = true
                this.validate.cost = false
                this.validate.code = false
                this.validate.name = false
                this.validate.brand = false
                this.validate.category = false
            }else if(this.update.isactive == ''){
                this.validate.isactive = true
                this.validate.price = false
                this.validate.cost = false
                this.validate.code = false
                this.validate.name = false
                this.validate.brand = false
                this.validate.category = false
            }else{
                this.updateProduct(id)
            }
        },
        updateProduct: function (update) {
            axios.post(apiUrl + 'products/update/' + update, {
                org_id: localStorage.getItem('ORG'),
                product_category_id: document.getElementById('category').value,
                brand_id: document.getElementById('brand').value,
                name: this.update.name,
                code: this.update.code,
                cost: this.update.cost,
                price: this.update.price,
                description: this.update.description,
                isactive: this.update.isactive
            })
            .then((response) => {
                let Checked = response.data.result
                let Reason = response.data.msg
                if(!Checked) {
                    if(Reason === 'Name Duplicate'){
                        this.duplicate = "ชื่อสินค้า ในประเภทเดียวกันมีการใช้ซ้ำ กรุณาเปลี่ยน..."
                        this.duplicated.name = true
                    }else if(Reason === 'Code Duplicate'){
                        this.duplicate = "รหัสสินค้า ในประเภทเดียวกันมีการใช้ซ้ำ กรุณาเปลี่ยน..."
                        this.duplicated.code = true
                        this.duplicated.name = false
                    }
                } else {
                    this.duplicate = ''
                    this.duplicated.name = false
                    this.duplicated.code = false
                    this.showEditModal = false
                    setTimeout(function () {
                        this.loading = true
                        this.loadProduct();
                    }.bind(this), 0);
                }
            })
        },
        delProduct: function (del, name, index) {
            if(confirm("ลบสินค้า : '" + name + "' ยืนยันการลบ ?")){
                axios.post(apiUrl + 'products/delete/' + del)
                .then(() => {
                    this.products.splice(index,1)
                })
                .catch (e => {
                    console.log(e)
                })
            }
        },

        // Category functions
        loadCategory: function () {
            axios.get(apiUrl + 'product-categories/getcategories/' + localStorage.getItem('ORG'))
            .then((response) => {
                this.productCate = response.data
            })
            .catch (e => {
                console.log(e)
            })
        },
        creatProductCategory: function () {
            axios.post(apiUrl + 'product-categories/create', {
                org_id: localStorage.getItem('ORG'),
                name: this.createCategory.name,
                description: this.createCategory.description,
                isactive: this.createCategory.isactive
            })
            .then((response) => {
                let nameChecked = response.data.result
                if(!nameChecked) {
                    this.nameDuplicate = 'ชื่อประเภท/กลุ่มสินค้า ไม่สามารถใช้ซ้ำได้...กรุณาเปลี่ยน'
                }else{
                    this.nameDuplicate = ''
                    this.showCreateCategory = false
                    this.name = null
                    this.description = null
                    this.isactive = null
                    setTimeout(function () {
                        this.loadCategory();
                    }.bind(this), 0);
                    this.showCreate = true
                }
            })
            .catch (e => {
                console.log(e)
            })
        },
        addCategory: function () {
            this.showCreate = false
            this.showCreateCategory = true
        },
        closeCreateCategory: function () {
            this.showCreateCategory = false
            this.createCategory.name = ''
            this.createCategory.description = ''
            this.createCategory.isactive = ''
        },

        // Brand function
        addBrand: function () {
            this.showCreate = false
            this.showCreateBrand = true
        },
        brandCreate: function () {
            axios.post(apiUrl + 'brands/create', {
              name: this.createBrand.name,
              description: this.createBrand.description,
              isactive: this.createBrand.isactive,
              org_id: localStorage.getItem('ORG')
            })
            .then((response) => {
              let nameChecked = response.data.result
                if(!nameChecked) {
                    this.nameDuplicate = 'ชื่อยี่ห้อสินค้า ไม่สามารถใช้ซ้ำได้...กรุณาเปลี่ยน'
                }else{
                    this.nameDuplicate = ''
                    this.createBrand.name = ''
                    this.createBrand.description = ''
                    this.createBrand.isactive = ''
                    this.showCreateBrand = false
                    setTimeout(function () {
                        this.loadBrand();
                    }.bind(this), 0);
                    this.showCreate = true
                }
            })
        },
        closeCreateBrand: function () {
            this.showCreateBrand = false
            this.createBrand.name = ''
            this.createBrand.description = ''
            this.createBrand.isactive = ''
        },
        loadBrand: function () {
            axios.get(apiUrl + 'brands/all?org=' + localStorage.getItem('ORG'))
            .then((response) => {
                this.productBrand = response.data
            })
            .catch (e => {
                console.log(e)
            })
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