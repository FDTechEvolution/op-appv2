let warehouse = new Vue ({
    el: '#warehouse',
    data () {
        return {
            warehouses: [],
            nodata: '',
            loading: true,
            duplicateMsg: '',
            duplicated: false,
            showCreate: false,
            showEdit: false,
            create: {
                name: '',
                description: '',
                isactive: ''
            },
            edit: {
                id: '',
                name: '',
                description: '',
                isactive: ''
            }
        }
    },
    mounted () {
        this.loadWarehouse()
    },
    methods: {
        loadWarehouse: function () {
            axios.get(apiUrl + 'warehouses/all/' + localStorage.getItem('ORG'))
            .then((response) => {
                this.nodata = response.data.length
                this.warehouses = response.data
            })
            .catch (e => {
                console.log(e)
            })
            .finally(() => this.loading = false)
        },
        createWarehouse: function () {
            axios.post(apiUrl + 'warehouses/create/', {
                name: this.create.name,
                description: this.create.description,
                isactive: this.create.isactive,
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
                    this.showCreate = false
                    this.create.name = ''
                    this.create.description = ''
                    this.create.isactive = ''
                    setTimeout(function () {
                        this.loading = true
                        this.loadWarehouse();
                    }.bind(this), 0);
                }
            })
        },
        showEditing: function (id, name, description, isactive) {
            this.showEdit = true
            this.edit.id = id
            this.edit.name = name
            this.edit.description = description
            this.edit.isactive = isactive
        },
        updateWarehouse: function () {
            axios.post(apiUrl + 'warehouses/update/' + this.edit.id , {
                name: this.edit.name,
                description: this.edit.description,
                isactive: this.edit.isactive
            })
            .then((response) => {
                let Checked = response.data.result
                if(!Checked) {
                    this.duplicateMsg = "ชื่อสินค้า ในประเภทเดียวกันมีการใช้ซ้ำ กรุณาเปลี่ยน..."
                    this.duplicated = true
                }else{
                    this.duplicateMsg = ''
                    this.duplicated = false
                    this.showEdit = false
                    this.edit.name = ''
                    this.edit.description = ''
                    this.edit.isactive = ''
                    setTimeout(function () {
                        this.loading = true
                        this.loadWarehouse();
                    }.bind(this), 0);
                }
            })
        },
        delWarehouse: function (del, name, index) {
            if(confirm("ลบสินค้า : '" + name + "' ยืนยันการลบ ?")){
                axios.post(apiUrl + 'warehouses/delete/' + del)
                .then(() => {
                    this.warehouses.splice(index,1)
                })
                .catch (e => {
                    console.log(e)
                })
            }
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