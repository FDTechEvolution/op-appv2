<div id="app">
    <div class="row" id="orgregis">
        <div class="col-3">
            <input v-model="name" class="form-control" type="text" name="name" id="name" required="" placeholder="ชื่อ">
        </div>
        <div class="col-2">
            <input v-model="code" class="form-control" type="text" name="code" id="code" required="" placeholder="รหัส">
        </div>
        <div class="col-2">
            <button class="btn btn-primary btn-block" type="submit" @click="createOrg()"> ลงทะเบียน </button>
        </div>
    </div>
    <br/><br/>
    <div id="orgs">
        <div class="row">
        <div v-if="loading" class="col-12"><p class="text-center">Loading...</p></div>
        <div v-else
            v-for="(org, index) in orgs"
            v-bind:key="org.index"
            class="col-3"
        >
            <div class="card">
                <a href="#">
                    <div class="card-body">{{org.name}} - {{org.code}}</div>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    const apiUrl = 'https://orderpang-service.herokuapp.com/'
    let interval = null
    let intervalplus = null
    let orgregis = new Vue ({
        el: '#orgregis',
        data () {
            return {
                name: '',
                code: ''
            }
        },
        methods: {
            createOrg: function () {
                axios.post(apiUrl + 'orgs/create', {
                    name: this.name,
                    code: this.code
                }).then((response) => {
                    this.name = null,
                    this.code = null,
                    intervalplus = interval+1
                }).catch (e => {
                    console.log(e)
                })
            }
        }
    })

    let orgs = new Vue ({
        el: '#orgs',
        data () {
            return {
                orgs: [],
                loading: true
            }
        },
        mounted () {
            this.loadorgs()

            interval = setInterval(function () {
                if(interval < intervalplus){
                    this.loadorgs();
                }
            }.bind(this), 500);
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
            }
        }
    })
</script>