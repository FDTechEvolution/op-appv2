let brands = new Vue ({
    el: '#brands',
    data () {
        return {
          brands: [],
          products: [],
          createBrand: {
            name: '',
            description: '',
            isactive: ''
          },
          editBrand: {
            id: '',
            name: '',
            description: '',
            isactive: ''
          },
          deleteBrand: {
            id: '',
            name: '',
            products: '',
            index: ''
          },
          nameDuplicate: '',
          delAll: '',
          brandNameInProduct: '',
          loading: true,
          showModal: false,
          showCreate: false,
          showDelete: false,
          loadingProduct: true,
          showBrandProduct: false
        }
    },
    mounted () {
      this.loadBrand()
    },
    methods: {
        loadBrand: function () {
          axios.get(apiUrl + 'brands/all?org=' + localStorage.getItem('ORG'))
          .then((response) => {
            this.brands = response.data
          })
          .catch(e => {
            console.log(e)
          })
          .finally(() => this.loading = false)
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
                  this.showCreate = false
                  setTimeout(function () {
                      this.loading = true
                      this.loadBrand();
                  }.bind(this), 0);
              }
          })
        },
        brandEdit: function () {
          axios.post(apiUrl + 'brands/update/' + this.editBrand.id, {
            name: this.editBrand.name,
            description: this.editBrand.description,
            isactive: this.editBrand.isactive,
            org_id: localStorage.getItem('ORG')
          })
          .then((response) => {
            let nameChecked = response.data.result
              if(!nameChecked) {
                  this.nameDuplicate = 'ชื่อยี่ห้อสินค้า ไม่สามารถใช้ซ้ำได้...กรุณาเปลี่ยน'
              }else{
                  this.nameDuplicate = ''
                  this.showModal = false
                  setTimeout(function () {
                      this.loading = true
                      this.loadBrand();
                  }.bind(this), 0);
              }
          })
          .catch(e => {
            console.log(e)
          })
        },
        confirmDelBrand: function (id, name, products, index) {
          this.deleteBrand.id = id
          this.deleteBrand.name = name
          this.deleteBrand.index = index
          this.deleteBrand.products = products
          if(products == 0){
            this.delAll = true
          }
          this.showDelete = true
        },
        brandDelete: function (id, index) {
          axios.post(apiUrl + 'brands/delete/' + id)
          .then(() => {
            this.showDelete = false
            this.brands.splice(index,1)
            this.delAll = ''
          })
          .catch(e => {
            console.log(e)
          })
        },
        loadProduct: function (brandID, name){
          this.brandNameInProduct = name
          this.showBrandProduct = true
          axios.get(apiUrl + 'products/all?brand=' + brandID + '&active=yes')
          .then((response) => {
            this.products = response.data
          })
          .catch(e => {
            console.log(e)
          })
          .finally(() => this.loadingProduct = false)
        },
        showEdit: function (id, name, description, isactive) {
          this.showModal = true,
          this.editBrand.id = id,
          this.editBrand.name = name,
          this.editBrand.description = description,
          this.editBrand.isactive = isactive
        },
        closeCreate: function () {
          this.showCreate = false
          this.createBrand.name = ''
          this.createBrand.description = ''
          this.createBrand.isactive = ''
        },
        closeEdit: function () {
          this.showModal = false
          this.nameDuplicate = ''
        },
        closeDelete: function () {
          this.delAll = ''
          this.showDelete = false
        },
        closeBrandProduct: function () {
          this.showBrandProduct = false
          this.loadingProduct = true
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

Vue.component('show-products', {
  template: `<transition name="modal">
  <div class="modal-mask">
    <div class="modal-wrapper-product">
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