Vue.component('modal', {
    template: '#modal-template'
})

Vue.component('show-products', {
    template: '#modal-products'
})

let productCategory = new Vue ({
    el: '#product-category',
    data () {
        return {
            productCategories: [],
            products: [],
            loading: true,
            name: '',
            description: '',
            isactive: '',
            editProductCategories: false,
            editID: '',
            editName: '',
            editDescription: '',
            editIsactive: '',
            showCreate: false,
            nameDuplicate: '',
            cateNameInProduct: '',
            showCateProduct: false,
            loadingProduct: true,
            deleteCategory: {
                id: '',
                name: '',
                products: '',
                index: ''
            },
            delAll: '',
            showDelete: false
        }
    },
    mounted () {
        this.loadProductCategory()
    },
    methods: {
        loadProductCategory: function () {
            axios.get(apiUrl + 'product-categories/getcategories/' + localStorage.getItem('ORG'))
            .then((response) => {
                this.productCategories = response.data
            })
            .catch (e => {
                console.log(e)
            })
            .finally(() => this.loading = false)
        },
        creatProductCategory: function () {
            axios.post(apiUrl + 'product-categories/create', {
                org_id: localStorage.getItem('ORG'),
                name: this.name,
                description: this.description,
                isactive: this.isactive
            })
            .then((response) => {
                let nameChecked = response.data.result
                if(!nameChecked) {
                    this.nameDuplicate = 'ชื่อประเภท/กลุ่มสินค้า ไม่สามารถใช้ซ้ำได้...กรุณาเปลี่ยน'
                }else{
                    this.nameDuplicate = ''
                    this.showCreate = false
                    this.name = null
                    this.description = null
                    this.isactive = null
                    setTimeout(function () {
                        this.loading = true
                        this.loadProductCategory();
                    }.bind(this), 0);
                }
            })
            .catch (e => {
                console.log(e)
            })
        },
        showEdit: function (id, name, description, isactive) {
            this.editProductCategories = true,
            this.editID = id,
            this.editName = name,
            this.editDescription = description,
            this.editIsactive = isactive
        },
        updateProductCategory: function () {
            axios.post(apiUrl + 'product-categories/update/' + this.editID, {
                org_id: localStorage.getItem('ORG'),
                name: this.editName,
                description: this.editDescription,
                isactive: this.editIsactive
            })
            .then((response) => {
                let nameChecked = response.data.result
                if(!nameChecked) {
                    this.nameDuplicate = 'ชื่อประเภท/กลุ่มสินค้า ไม่สามารถใช้ซ้ำได้...กรุณาเปลี่ยน'
                }else{
                    this.nameDuplicate = ''
                    this.editProductCategories = false
                    setTimeout(function () {
                        this.loading = true
                        this.loadProductCategory();
                    }.bind(this), 0);
                }
            })
            .catch (e => {
                console.log(e)
            })
        },
        confirmDeleteCategory: function (id, name, products, index) {
            this.deleteCategory.id = id
            this.deleteCategory.name = name
            this.deleteCategory.products = products
            this.deleteCategory.index = index
            if(products == 0){
                this.delAll = true
            }
            this.showDelete = true
        },
        delProductCategories: function (del, index) {
            axios.post(apiUrl + 'product-categories/delete/' + del)
            .then(() => {
                this.showDelete = false
                this.productCategories.splice(index,1)
                this.delAll = ''
            })
            .catch (e => {
                console.log(e)
            })
        },
        closeDelete: function () {
            this.delAll = ''
            this.showDelete = false
        },
        showProducts: function (cateID,cateName) {
            this.showCateProduct = true
            this.cateNameInProduct = cateName
            axios.get(apiUrl + 'products/all?category=' + cateID)
            .then((response) => {
                this.products = response.data
            })
            .catch (e => {
                console.log(e)
            })
            .finally(() => this.loadingProduct = false)
        },
        closeProducts: function () {
            this.loadingProduct = true
            this.showCateProduct = false
        }
    }
})

Vue.component('category-delete', {
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