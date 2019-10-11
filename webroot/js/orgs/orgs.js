let interval = null
let intervalplus = null
let orgs = new Vue ({
    el: '#orgs',
    data () {
        return {
            orgs: [],
            loading: true,
            name: '',
            code: '',
            orgdelete: false
        }
    },
    mounted () {
        this.loadorgs()

        interval = setInterval(function () {
            if(interval < intervalplus){
                this.loading = true
                this.loadorgs();
            }
        }.bind(this), 0);
    },
    methods: {
        loadorgs: function () {
            axios.get(apiUrl + 'orgs')
            .then((response) => {
                this.orgs = response.data
                interval = response.data.length
            })
            .catch((e) => {
                console.error(e)
            })
            .finally(() => this.loading = false)
        },
        createOrg: function () {
            axios.post(apiUrl + 'orgs/create', {
                name: this.name,
                code: this.code
            })
            .then((response) => {
                this.name = null,
                this.code = null,
                intervalplus = interval+1
            })
            .catch (e => {
                console.log(e)
            })
        },
        delOrg: function (del) {
            console.log(del)
            axios.post(apiUrl + 'orgs/delete/' + del)
            .then((response) => {
                intervalplus = interval+1
            })
            .catch (e => {
                console.log(e)
            })
        }
    }
})