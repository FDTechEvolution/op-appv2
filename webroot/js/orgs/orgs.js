Vue.component('modal', {
    template: '#modal-template'
})

let orgs = new Vue ({
    el: '#orgs',
    data () {
        return {
            orgs: [],
            loading: true,
            name: '',
            code: '',
            editID: '',
            editname: '',
            editcode: '',
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
                user_id: localStorage.getItem('USER_ID')
            })
            .then(() => {
                this.name = null,
                this.code = null
                setTimeout(function () {
                    this.loading = true
                    this.loadorgs();
                }.bind(this), 0);
            })
            .catch (e => {
                console.log(e)
            })
        },
        showEditModal: function (id, name, code, isactive) {
            this.showModal = true,
            this.editID = id,
            this.editname = name,
            this.editcode = code,
            this.active = isactive
        },
        showEdit: function (id, name, code, isactive) {
            this.editorg = true,
            this.editID = id,
            this.editname = name,
            this.editcode = code,
            this.active = isactive
        },
        editOrg: function () {
            axios.post(apiUrl + 'orgs/update/' + this.editID, {
                name: this.editname,
                code: this.editcode,
                isactive: this.active
            })
            .then(() => {
                this.editorg = false
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
                this.email = response.data.email
            })
        }
    }
})