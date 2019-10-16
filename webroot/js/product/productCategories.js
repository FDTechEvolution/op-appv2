Vue.component('modal', {
    template: '#modal-template'
})

let productCategory = new Vue ({
    el: '#product-category',
    data () {
        return {
            productCategories: [],
            loading: true,
            name: '',
            description: '',
            isactive: '',
            editProductCategories: false,
            editID: '',
            editName: '',
            editDescription: '',
            editIsactive: '',
            showModal: false
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
            .then(() => {
                this.showModal = false
                this.name = null
                this.description = null
                this.isactive = null
                setTimeout(function () {
                    this.loading = true
                    this.loadProductCategory();
                }.bind(this), 0);
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
        updateProductCategories: function () {
            axios.post(apiUrl + 'product-categories/update/' + this.editID, {
                name: this.editName,
                description: this.editDescription,
                isactive: this.editIsactive
            })
            .then(() => {
                this.editProductCategories = false
                setTimeout(function () {
                    this.loading = true
                    this.loadProductCategory();
                }.bind(this), 0);
            })
            .catch (e => {
                console.log(e)
            })
        },
        delProductCategories: function (del, name) {
            if(confirm("ลบประเภท/กลุ่มสินค้า : " + name + "\nหากลบแล้ว...รายการสินค้าที่อยู่ในกลุ่มนี้จะถูกลบไปด้วย \nยืนยันการลบ ?")){
                axios.post(apiUrl + 'product-categories/delete/' + del)
                .then(() => {
                    setTimeout(function () {
                        this.loading = true
                        this.loadProductCategory();
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
                this.email = response.data.email,
                localStorage.setItem('ORG', response.data.org_id)
            })
            .catch (e => {
                console.log(e)
            })
        }
    }
})