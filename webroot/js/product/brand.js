let brands = new Vue ({
    el: '#brands',
    data () {
        return {
          brands: [],
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
          nameDuplicate: '',
          loading: true,
          showModal: false,
          showCreate: false
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
        brandDelete: function (id, name, index) {
          if(confirm("ลบยี่ห้อสินค้า : '" + name + "' ยืนยันการลบ ?")){
            axios.post(apiUrl + 'brands/delete/' + id)
            .then(() => {
              this.brands.splice(index,1)
            })
            .catch(e => {
              console.log(e)
            })
          }
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