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

let orgs = new Vue ({
    el: '#orgs',
    data () {
        return {
            orgs: [],
            loading: true,
            name: '',
            code: '',
            address: '',
            editID: '',
            editname: '',
            editcode: '',
            editaddress: '',
            active: '',
            orgdelete: false,
            editorg: false,
            showModal: false
        }
    },
    mounted () {
        this.loadorgs()
    },
    methods: {
        loadorgs: function () {
            axios.get(apiUrl + 'orgs/getorgs/' + localStorage.getItem('USER_ID'))
            .then((response) => {
                this.orgs = response.data
            })
            .catch((e) => {
                console.error(e)
            })
            .finally(() => this.loading = false)
        },
        createOrg: function () {
            axios.post(apiUrl + 'orgs/create', {
                name: this.name,
                code: this.code,
                address: this.address,
                org: localStorage.getItem('ORG'),
                user: localStorage.getItem('USER_ID')
            })
            .then(() => {
                this.name = null,
                this.code = null,
                this.address = null,
                setTimeout(function () {
                    this.loading = true
                    this.loadorgs();
                }.bind(this), 0);
            })
            .catch (e => {
                console.log(e)
            })
        },
        showEditModal: function (id, name, code, address, isactive) {
            this.showModal = true,
            this.editID = id,
            this.editname = name,
            this.editcode = code,
            this.editaddress = address,
            this.active = isactive
        },
        showEdit: function (id, name, code, address, isactive) {
            this.showModal = true,
            this.editID = id,
            this.editname = name,
            this.editcode = code,
            this.editaddress = address,
            this.active = isactive
        },
        editOrg: function () {
            axios.post(apiUrl + 'orgs/update/' + this.editID, {
                name: this.editname,
                code: this.editcode,
                address: this.editaddress,
                isactive: this.active
            })
            .then(() => {
                this.showModal = false
                setTimeout(function () {
                    this.loading = true
                    this.loadorgs();
                }.bind(this), 0);
            })
            .catch (e => {
                console.log(e)
            })
        },
        delOrg: function (del) {
            if(confirm("Do you really want to delete?")){
                axios.post(apiUrl + 'orgs/delete/' + del)
                .then(() => {
                    setTimeout(function () {
                        this.loading = true
                        this.loadorgs();
                    }.bind(this), 0);
                })
                .catch (e => {
                    console.log(e)
                })
            }
        }
    }
})

// let users = new Vue ({
//     el: '#users',
//     data () {
//         return {
//             name: '',
//             mobile: '',
//             email: ''
//         }
//     },
//     mounted () {
//         this.loadUser()
//     },
//     methods: {
//         loadUser: function () {
//             axios.get(apiUrl + 'users/get/' + localStorage.getItem('USER_ID'))
//             .then((response) => {
//                 this.name = response.data.name,
//                 this.mobile = response.data.mobile,
//                 this.email = response.data.email
//             })
//         }
//     }
// })