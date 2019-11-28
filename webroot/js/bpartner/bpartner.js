let bpartner = new Vue ({
    el: '#bpartner',
    data () {
        return {
            bpartners: [],
            loading: {
                bpartner: true
            }
        }
    },
    mounted () {
        this.loadBpartner()
    },
    methods: {
        loadBpartner: function () {
            axios.get(apiUrl + 'bpartners/all?org=' + localStorage.getItem('ORG'))
            .then((response) => {
                this.bpartners = response.data
            })
            .catch(e => {
                console.log(e)
            })
            .finally(() => this.loading.bpartner = false)
        }
    }
})