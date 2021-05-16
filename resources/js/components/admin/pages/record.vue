<template>
    <div  class="app">
        <!-- begin app-wrap -->
        <div class="app-wrap">
            <!-- begin app-header -->
                <vheader/>
            <!-- end app-header -->
            <!-- begin app-container -->
            <div class="app-container">
                <!-- begin app-nabar -->
                    <vsidebar/>
                <!-- end app-navbar -->
                <!-- begin app-main -->
                <div class="app-main" id="main">
                <div class="container-fluid">
                <!-- begin row -->
                   <div class="row">
                            <div class="col-md-12 m-b-30">
                                <!-- begin page title -->
                                <div class="d-block d-lg-flex flex-nowrap align-items-center">
                                    <div class="page-title mr-4 pr-4 border-right">
                                        <h1>Teacher</h1>
                                    </div>
                                    <div class="breadcrumb-bar align-items-center">
                                        <nav>
                                            <ol class="breadcrumb p-0 m-b-0">
                                                <li class="breadcrumb-item">
                                                    <router-link to="/teachers"><i class="ti ti-files"></i></router-link>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <router-link to="/teachers">Teacher</router-link>
                                                </li>
                                                <li class="breadcrumb-item  text-primary">Record </li>
                                                <li class="breadcrumb-item active text-success"  aria-current="page">{{ teacher.fullname }} </li>
                                            </ol>
                                        </nav>
                                    </div>
                                    <div class="ml-auto d-flex align-items-center secondary-menu text-center">
                                        <router-link to="/teachers" class="tooltip-wrapper mr-2" data-toggle="tooltip" data-placement="top">
                                            <i class="ti ti-angle-double-left btn btn-icon text-primary"></i>
                                        </router-link>
                                        <button class="btn btn-info btn-square" @click="usableModal"> <i class="ti ti-plus text-white pr-2"></i>Add record</button>
                                        <button class="btn btn-info btn-square ml-2" @click="downloadModal"> <i class="ti ti-download text-white pr-2"></i>Download</button>
                                        <button class="btn btn-info btn-square ml-2" @click="printLeave"> <i class="ti ti-printer text-white pr-2"></i>Print Leave</button>
                                        <a href="javascript:void(0);" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title="" data-original-title="Projects">
                                            <i class="fa fa-lightbulb-o btn btn-icon text-success"></i>
                                        </a>
                                    </div>
                                </div>
                                <!-- end page title -->
                            </div>
                    </div>
                <!-- end row -->
                <!-- start row -->
                <div class="card">
                    <div class="card-body" id="printable">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="example" class="table table-bordered text-center table-striped" style="font-size: 11px">
                                <thead>
                                <tr >
                                    <td style="background-color: #004d66" colspan="4" class="font-weight-bold text-white">VACATION SERVICE RENDERED</td>
                                    <td style="background-color: #4d6600" colspan="7" class="font-weight-bold text-white">RECORD OF LEAVE</td>
                                    <td style="background-color: #555e55" colspan="2" class="font-weight-bold text-white">EXTRA</td>
                                </tr>
                                <tr class="font-weight-bold text-white">
                                <td style="background-color: #007399" width="8%">Inclusive Period</td>
                                <td style="background-color: #007399" width="15%">Nature of Activitiy</td>
                                <td style="background-color: #007399" width="5%">No.of Days Credited</td>
                                <td style="background-color: #007399" width="5%">DSO No.</td>
                                <td style="background-color: #86b300" width="13%">Inclusive Dates</td>
                                <td style="background-color: #86b300" width="5%">No.of Days Leave</td>
                                <td style="background-color: #86b300" width="6%">Service Credit Balance</td>
                                <td style="background-color: #86b300" width="5%">Leave W/OUT PAY</td>
                                <td style="background-color: #86b300" width="5%">Nature of Leave</td>
                                <td style="background-color: #86b300" width="5%">DSO No.</td>
                                <td style="background-color: #86b300" width="5%">Remarks</td>
                                <td style="background-color: #738c73" width="2%">EDIT</td>
                                <td style="background-color: #738c73" width="2%">DELETE</td>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(record,i) in records" :key="i" v-show="records.length">
                                        <td>{{record.inclusivePeriod}}</td>
                                        <td>{{record.natureOfActivity}}</td>
                                        <td>{{record.noOfDaysCredited}}</td>
                                        <td>{{record.dsoNumber1}}</td>
                                        <td>{{record.inclusiveDates}}</td>
                                        <td>{{record.noOfDaysLeave}}</td>
                                        <td>{{record.serviceCreditBalance}}</td>
                                        <td>{{record.leaveWithoutpay}}</td>
                                        <td>{{record.natureOfLeave}}</td>
                                        <td>{{record.dsoNumber2}}</td>
                                        <td>{{record.remarks}}</td>
                                        <td><button type="button" @click="editRecord(record)" class="btn btn-square btn-sm btn-primary"><i class="fe fe-edit"></i></button></td>
                                        <td><button type="button" @click="deleteRecord(record)" class="btn btn-square btn-sm btn-danger"><i class="fe fe-trash"></i></button></td>
                                    </tr>
                                     <tr v-show="!records.length">
                                        <td colspan="13">
                                            No data available
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                </div>
                </div>
                <!-- end app-main -->
            </div>
            <!-- end app-container -->
            <!-- begin footer -->
                <vfooter/>
            <!-- end oter -->
        </div>
        <!-- end app-wrap -->
        <!-- start Modal -->
            <form @submit.prevent="editMode?update():store()">
                <div class="modal fade" id="leaveCard" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="leaveCardLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="leaveCardLabel">{{ editMode?"Update Information" : "Leave Form" }}</h6>
                        <button type="button" class="close" @click="closeModal('hide')" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <h6 class="font-weight-bold">VACATION SERVICE RENDERED</h6><br>
                        
                            <div class="form-group">
                                <label>Inclusive Period</label>
                                <input type="text" v-model="recordForm.inclusivePeriod" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label>Nature of Activity</label>
                                <input type="text" v-model="recordForm.natureOfActivity" class="form-control form-control-sm" autocomplete="natureOfActivity"><!---->
                            </div>

                            <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>No.of Days Credited</label>
                                <input type="number" v-model="recordForm.noOfDaysCredited" id="add_noOfDaysCredited" class="form-control form-control-sm">
                            </div>
                            <div class="form-group col-md-6">
                                <label>DSO Number</label>
                                <input type="text" v-model="recordForm.dsoNumber1" class="form-control form-control-sm">
                            </div>
                            </div>
                            <br>
                            <h6 class="font-weight-bold">RECORD OF LEAVE</h6><br>
                            <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Inclusive Dates</label>
                                <input type="text" v-model="recordForm.inclusiveDates" class="form-control form-control-sm">
                            </div>
                            <div class="form-group col-md-6">
                                <label>No.of Days Leave</label>
                                <input type="text" v-model="recordForm.noOfDaysLeave" id="minus_noOfDaysLeave" class="form-control form-control-sm">
                            </div>
                            </div>
                            <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Service Credit Balance</label>
                                <input type="text" v-model="recordForm.serviceCreditBalance" id="last_serviceCreditBalance" class="form-control form-control-sm">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Leave W/OUT PAY</label>
                                <input type="text" v-model="recordForm.leaveWithoutpay" class="form-control form-control-sm">
                            </div>
                            </div>
                            <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Nature of Leave</label>
                                 <select  v-model="recordForm.natureOfLeave" class="form-control form-control-sm">
                                    <option value="SL">Sick leave</option>
                                    <option value="VL">Vacation Leave</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>DSO Number</label>
                                <input type="text" v-model="recordForm.dsoNumber2" class="form-control form-control-sm">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Remarks</label>
                                <select  v-model="recordForm.remarks" class="form-control form-control-sm">
                                <option value="W/PAY">W/PAY</option>
                                <option value="W/OUT PAY">W/OUT PAY</option>
                                <option value="FULLPAY">FULLPAY</option>
                                <option value="REACHED">REACHED</option>
                                <option value="EXCEEDED">EXCEEDED</option>
                                </select>
                            </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" @click="closeModal('hide')">Close</button>
                        <button type="submit" :disabled="active" class="btn btn-sm btn-primary pl-5 pr-5">Save</button>
                    </div>
                    </div>
                </div>
                </div>
            </form>
        <!-- end Modal -->
        <!-- start Modal -->
        <div class="modal fade text-center" id="deleteModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header p-2">
                        <h5 class="modal-title " id="deleteModalTitle"><i class="ti ti-alert"></i> Delete confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you suse, you want delete this record?</p>
                    </div>
                    <div class="modal-footer p-1">
                        <button type="button" @click="destroy" :disabled="active" class="btn btn-block btn-sm pb-1 pt-1 btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Modal -->
        <!-- start Modal -->
        <div class="modal fade text-center" id="downloadModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header p-2">
                        <h5 class="modal-title " id="downloadModalTitle"><i class="ti ti-file"></i> File Manager</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-statistics">
                                    <div class="card-body">
                                        <div class="text-center p-2">
                                            <div class="mb-2">
                                                <img :src="'img/file-icon/xls.png'" alt="png-img">
                                            </div>
                                            <h6 class="mb-0">{{this.teacher.fullname}}.xls</h6>
                                            <p class="mb-2">28.8 kb</p>
                                            <button @click="downloadExcel" class="btn btn-light">Download</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-statistics">
                                    <div class="card-body">
                                        <div class="text-center p-2">
                                            <div class="mb-2">
                                                <img :src="'img/file-icon/pdf.png'" alt="png-img">
                                            </div>
                                            <h6 class="mb-0">{{this.teacher.fullname}}.pdf</h6>
                                            <p class="mb-2">28.8 kb</p>
                                            <a href="javascript:void(0)" class="btn btn-light">Download</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer p-1">
                        <button type="button" class="btn btn-sm pb-1 pt-1 btn-info"  data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Modal -->
    </div>
    
</template>
<script>
    export default{
        data(){
            return{
                recordForm:{
                    id:'',
                    teacher_id:this.$router.currentRoute.query.id,
                    inclusivePeriod:'',
                    natureOfActivity:'',
                    noOfDaysCredited:'',
                    dsoNumber1:'',
                    inclusiveDates:'',
                    noOfDaysLeave:'',
                    serviceCreditBalance:'',
                    leaveWithoutpay:'',
                    natureOfLeave:'',
                    dsoNumber2:'',
                    remarks:''
                },
                records:[],
                obj:'',
                active:false,
                editMode:false,
                teacher:[]
            }
        },
        methods:{
            usableModal(action){
                action||'show'
                $("#leaveCard").modal(action)
            },
            deleteModal(action){
                action||'show'
                $("#deleteModal").modal(action)  
            },
            closeModal(action){
                $("#leaveCard").modal(action)
                this.recordForm.id=null
                this.recordForm.teacher_id=null
                this.recordForm.inclusivePeriod=null
                this.recordForm.natureOfActivity=null
                this.recordForm.noOfDaysCredited=null
                this.recordForm.dsoNumber1=null
                this.recordForm.inclusiveDates=null
                this.recordForm.noOfDaysLeave=null
                this.recordForm.serviceCreditBalance=null
                this.recordForm.leaveWithoutpay=null
                this.recordForm.natureOfLeave=null
                this.recordForm.dsoNumber2=null
                this.recordForm.remarks=null

            },
             downloadModal(action){
                action||'show'
                $("#downloadModal").modal(action)  
            },
            async getRecords(){
                this.$Progress.start()
                const res = await this.callApi('get','api/getRecords/'+this.$router.currentRoute.query.id)
                if(res.status==200 || res.status==201){
                    this.$Progress.finish()
                    this.records=res.data
                }else{
                    this.notice('info','No Data!',res.data.message)
                    this.$Progress.fail();
                }
            },
            async store(){
                this.active=true
                this.$Progress.start()
                const res = await this.callApi('post','api/storeRecord',this.recordForm)
                if (res.status==200 || res.status==201) {
                     this.getRecords();
                    this.$Progress.finish()
                    this.notice('success','Saved','Succesfully saved one record!')
                    this.clearFields(this.recordForm)
                    this.recordForm.teacher_id=this.$router.currentRoute.query.id
                    this.active=false
                } else {
                    this.$Progress.fail()
                }
            },
            async editRecord(record){
                this.usableModal()
                this.editMode=true
                
                const res = await this.callApi('get',`api/editRecord/${record.id}`)
                if (res.status==200) {
                    this.recordForm=res.data;
                    this.$Progress.finish()
                } else {
                    this.$Progress.fail()
                    this.notice('error','Failed!','There\'s something went wrong!')
                } 
            },
            async update(){
                this.$Progress.start()
                this.active=true;
                const res = await this.callApi('put','api/updateRecord',this.recordForm)
                if (res.status==200) {
                    this.active=false
                    this.$Progress.finish()
                    this.getRecords()
                    this.notice('success','Updated!','Successfully updated one record!')
                } else {
                    this.$Progress.fail()
                }
            },
            async downloadExcel(){
                window.open(`api/getExcelRecord/${this.$router.currentRoute.query.id}`,'_blank');
            },
            // async downloadPdf(){
            //     window.open(`api/getPdfRecord/${this.$router.currentRoute.query.id}`,'_blank');
            // },
            deleteRecord(record){
                this.obj=record
                this.deleteModal()
            },
            printLeave(){
                this.popupCenter({
                    url: `http://127.0.0.1:8000/print/${this.$router.currentRoute.query.id}`,
                    title: "Print Leave",
                    w: 900,
                    h: 700,
                })
            },
            async destroy(){
                this.active=true
                const res = await this.callApi('delete',`api/destroyRecord/${this.obj.id}`)
                res.status==200?this.notice('success','Deleted','Succesfully deleted one record!'):this.notice('error','System Error!',"Something went wrong!")
                this.active=false
               this.getRecords()
                this.deleteModal('hide')
            }
            
        },
        async created(){
           this.getRecords()
           const res = await this.callApi('get',`api/getCurrentTeacher/${this.$router.currentRoute.query.id}`)
            res.status==200?this.teacher=res.data:this.notice('warning','There is something went wrong!')
            // console.log(this.$route);
            // this.baseaccount = this.$route.params.baseaccount;
        },
    }
</script>

