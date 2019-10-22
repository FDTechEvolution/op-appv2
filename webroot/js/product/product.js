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
            selected: {
                category: '',
                brand: ''
            },
            showCreate: false,
            showEditModal: false,
            loading: true,
            loadingEdit: true,
            duplicated: {
                name: false,
                code: false
            }
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
                if(!Checked) {
                    this.duplicate = "ชื่อสินค้า หรือ รหัส ในประเภทเดียวกันมีการใช้ซ้ำ กรุณาเปลี่ยน..."
                    this.duplicated = true
                } else {
                    this.duplicate = ''
                    this.duplicated = false
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
                let seterror = ''
                if(!Checked) {
                    switch(response.data.stat){
                        case 1:
                            seterror = "ชื่อสินค้า"
                            this.duplicated.name = true
                        break
                        case 2:
                            seterror = "รหัส"
                            this.duplicated.code = true
                        break
                    }
                    this.duplicate = seterror + " ในประเภทเดียวกันมีการใช้ซ้ำ กรุณาเปลี่ยน..."
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
        loadCategory: function () {
            axios.get(apiUrl + 'product-categories/getcategories/' + localStorage.getItem('ORG'))
            .then((response) => {
                this.productCate = response.data
            })
            .catch (e => {
                console.log(e)
            })
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