let createline = new Vue ({
    el: '#createline',
    data () {
        return {
            productBrand: [],
            warehouses: [],
            users: [],
            userlogin: '',
            description: '',
            showCreate: false
        }
    },
    mounted () {
        this.loadBrand(),
        this.loadWarehouse(),
        this.loadUser()
    },
    methods: {
        createWH: function () {
            axios.post(apiUrl + 'goods-receive/create/', {
                org_id: localStorage.getItem('ORG'),
                brand_id: document.getElementById('bpartner').value,
                to_warehouse_id: document.getElementById('warehouse').value,
                docdate: document.getElementById('docdate').value,
                user_id: document.getElementById('user').value,
                description: this.description,
                isshipment: 'Y',
                status: 'DR'
            })
            .then(() => {
                this.description = ''
            })
            .catch (e => {
                console.log(e)
            })
        },
        createline: function (stat) {
            if(stat == true){
                this.showCreate = false
            }else{
                this.showCreate = true
            }
        },
        loadBrand: function () {
            axios.get(apiUrl + 'brands/all?org=' + localStorage.getItem('ORG'))
            .then((response) => {
                this.productBrand = response.data
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
        }
    }
})

let shipmentline = new Vue ({
    el: '#shipment-line',
    data () {
        return {

        }
    },
    mounted () {

    },
    methods: {

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