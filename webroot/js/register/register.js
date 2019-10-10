/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


new Vue({
    el: '#frmregis',
    data() {
        return {
            mobile: null,
            mobileduplicate: null,
            password: null,
            confirmpassword: null,
            passerror: null,
            passshort: null,
            passwordclass: false,
            mobileclass: false,
            active: false
        }
    },
    mounted() {

    },
    methods: {
        checkForm: async function (e) {
            await this.checkmobile();
            await this.checkpassword();
            return true;
            e.preventDefault();
            //console.log('hi');
            
        },
        checkmobile() {
            axios.get(apiUrl + 'users/chkmobile/' + this.mobile)
                    .then((response) => {
                        let mobilechecked = response.data.result
                        if (!mobilechecked) {
                            this.mobileclass = true
                            this.mobileduplicate = 'หมายเลขโทรศัพท์นี้ได้ถูกใช้ไปแล้ว กรุณาเปลี่ยนหมายเลขหรือติดต่อผู้ดูแล...'
                        } else {
                            this.mobileclass = false
                            this.mobileduplicate = null
                        }
                    })
        },
        checkpassword() {
            if (this.password.length < 6) {
                this.passshort = 'รหัสผ่านต้องมีจำนวน 6 ตัวขึ้นไป'
                this.passwordclass = true
            } else {
                if (this.password != this.confirmpassword) {
                    this.passerror = 'รหัสผ่านไม่ตรงกัน กรุณาตรวจสอบ!'
                    this.passwordclass = true
                } else {
                    this.passerror = null
                    this.passwordclass = false
                    if (this.mobileduplicate == null) {
                        return true
                    }
                }
                this.passshort = null
                this.passwordclass = false
            }
        }
    }
})