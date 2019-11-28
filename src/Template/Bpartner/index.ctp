<div id="app">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card-box">
                <div id="bpartner">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div v-if="loading.bpartner" class="col-12 text-center"><img src="img/loading_v2.gif"></div>
                                <div v-else-if="bpartners.length == 0" class="col-12 text-center">NO Partner...</div>
                                <div v-else
                                    v-for="(bpartner, index) in bpartners"
                                    v-bind:key="bpartner.index"
                                    class="col-4"
                                >
                                    <div class="card org-card">
                                        <div class="card-body org-body-action">
                                            <strong class="header-org">บริษัท :</strong> {{bpartner.company}}<br/>
                                            <strong class="header-org">ผู้ติดต่อ</strong> {{bpartner.name}} ({{bpartner.mobile}})<br/>
                                            <strong class="header-org">ระดับ</strong> {{bpartner.level}}<br/>
                                            <strong class="header-org">รายละเอียด :</strong> <span v-if="!bpartner.description"> No Description... </span>{{bpartner.description}}<br/>
                                            <div style="display: -webkit-inline-box;">
                                            <strong class="header-org">สถานะ : </strong>&nbsp;
                                                <div v-if="bpartner.isactive == 'Y'" style="color: #00dd00;">เปิดใช้งาน</div>
                                                <div v-else style="color: #dd0000;">ปิดใช้งาน</div>
                                            </div><br/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const apiUrl = '<?=APIURL?>';
</script>
<?=$this->Html->script('bpartner/bpartner.js')?>