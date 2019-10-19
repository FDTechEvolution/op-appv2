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
            productEdit: [],
            loading: true,
            productCate: [],
            productBrand: [],
            name: '',
            code: '',
            cost: '',
            price: '',
            description: '',
            isactive: '',
            showCreate: false,
            showEdit: false
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
                name: this.name,
                code: this.code,
                cost: this.cost,
                price: this.price,
                description: this.description,
                isactive: this.isactive
            })
            .then(() => {
                this.showCreate = false
                this.name = ''
                this.code = ''
                this.cost = ''
                this.price = ''
                this.description = ''
                this.isactive = ''
                setTimeout(function () {
                    this.loading = true
                    this.loadProduct();
                }.bind(this), 0);
            })
        },
        showEdit: function (id) {
            axios.get(apiUrl + 'products/get/' + id)
            .then((response) => {
                this.showEdit = true
                this.productEdit = response.data
            })
            .catch (e => {
                console.log(e)
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