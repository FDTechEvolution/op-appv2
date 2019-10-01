<div class="row">
    <div div id="app">
        <div class="col-md-12">
            <div class="card-box">
                <h4 class="header-title m-t-0 m-b-30">คำสั่งซื้อทั้งหมด</h4>

                <ul class="nav nav-pills navtab-bg nav-justified">
                    <li class="nav-item">
                        <a href="#home1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                            Order1
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#profile1" data-toggle="tab" aria-expanded="false" class="nav-link">
                            Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#messages1" data-toggle="tab" aria-expanded="false" class="nav-link">
                            Messages
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#settings1" data-toggle="tab" aria-expanded="false" class="nav-link">
                            Settings
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="home1">
                        <div v-if="loading"><i class="fa-li fa fa-spinner fa-spin"></i></div>
                        <div v-else
                            v-for="order in orders"
                            class="order"
                        >
                            {{order}}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile1">
                        <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                    </div>
                    <div class="tab-pane fade" id="messages1">
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                        <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                    </div>
                    <div class="tab-pane fade" id="settings1">
                        <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
</div>

<script>
    let app = new Vue({
        el: '#app',
        data () {
            return {
                orders: null,
                loading: true
            }
        },
        mounted () {
            axios
            .get('https://sv.orderpang.com/orders/get-order/DX')
            .then(response => (
                this.orders = response.data
            ))
            .catch((e) => {
                console.error(e)
            })
            .finally(() => this.loading = false)
        }
    })
</script>