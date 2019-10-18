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
            showCateProduct: false
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
        delProductCategories: function (del, name, total) {
            if(total != 0){
                alert("ไม่สามารถลบประเภท/กลุ่มสินค้า : '" + name + "' \nเนื่องจากยังมีสินค้าอยู่ในกลุ่มนี้จำนวน " + total + " ชิ้น กรุณาจัดการก่อนลบกลุ่ม...")
            }else{
                if(confirm("ลบประเภท/กลุ่มสินค้า : '" + name + "' ยืนยันการลบ ?")){
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
        },
        showProducts: function (cateID) {
            this.showCateProduct = true
            axios.get(apiUrl + 'products/all?category=' + cateID)
            .then((response) => {
                this.products = response.data
            })
            .catch (e => {
                console.log(e)
            })
            .finally(() => this.loading = false)
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