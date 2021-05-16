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
                        <div class="d-block d-sm-flex flex-nowrap align-items-center">
                            <div class="page-title mb-2 mb-sm-0">
                                <h1>Teachers</h1>
                            </div>
                            <div class="ml-auto d-flex align-items-center secondary-menu text-center">
                                <button @click="useModal('show')" class="btn btn-outline-primary"> <i class="fe fe-plus text-primary pr-2"></i>Add teacher</button>
                            </div>
                        </div>
                        <!-- end page title -->
                    </div>
                </div>
                <!-- end row -->
                <div class="card">
                    <div class="card-body">
               <div class="row">
                <div class="col-md-2 my-1">
                  <strong class="">Search By :</strong>
                </div>
                <div class="col-md-3">
                  <select v-model="queryFiled" class="form-control form-control-sm" id="fileds">
                    <option value="Fullname" selected>Fullname</option>
                    <option value="position">Position</option>
                    <option value="dateEmployed">Date Employed</option>
                    <option value="sex">Sex</option>
                    <option value="dob">DOB</option>
                    <option value="pob">POB</option>
                  </select>
                </div>
                <div class="col-md-5">
                  <input v-model="query" type="text" class="form-control form-control-sm" placeholder="Search">
                </div>
                <div class="col-md-2">
                     <button type="button" class="btn btn-outline-secondary btn-sm btn-block" @click="reload">Reload
                    <i class="fas fa-sync"></i>
              </button>
                </div>
              </div>
                <!-- begin row -->
                <div class="row">
                    
                    <div class="col-md-12 m-b-30 mt-2">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <td>Fullname</td>
                                        <td>Position</td>
                                        <td>Date Employed</td>
                                        <td>Sex</td>
                                        <td>DOB</td>
                                        <td>POB</td>
                                        <td>Employee No</td>
                                        <td>Station</td>
                                        <td>Civil Status</td>
                                        <td class="text-center">Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(employee,i) in employees" :key="i" v-show="employees.length">
                                        <td>{{employee.fullname}}</td>
                                        <td>{{employee.position}}</td>
                                        <td>{{employee.dateEmployed}}</td>
                                        <td>{{employee.sex}}</td>
                                        <td>{{employee.dob}}</td>
                                        <td>{{employee.pob}}</td>
                                        <td>{{employee.employeeNumber}}</td>
                                        <td>{{employee.station}}</td>
                                        <td>{{employee.civilStatus}}</td>
                                        <td class="text-center">
                                        <router-link :to="{path:'record',query: { id: employee.id }}" class="btn btn-secondary btn-sm"><i class="ti ti-files"></i></router-link>
                                        <button type="button" @click="show(employee)" class="btn btn-info btn-sm">
                                            <i class="ti ti-eye"></i>
                                        </button>
                                        <button type="button" @click="edit(employee)" class="btn btn-primary btn-sm">
                                            <i class="ti ti-pencil-alt"></i>
                                        </button>
                                        <button type="button" @click="destroy(employee)" class="btn btn-danger btn-sm">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                        </td>
                                    </tr>
                                     <tr v-show="!employees.length">
                                        <td colspan="10" class="text-center">
                                            <small class="text-muted ">No data found. </small>
                                                <div class="spinner-border spinner-border-sm" v-if="isLoading" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <pagination v-if="pagination.last_page > 1" :pagination="pagination" :offset="5" @paginate="query === '' ? getData() : searchData()">
                            </pagination>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                </div>
                </div>
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
        <!-- begin Modal -->
        <form @submit.prevent="editMode ? update() : store()">
        <div class="modal fade" id="verticalCenter" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span v-if="view">
                            <h5 class="modal-title" id="verticalCenterTitle">{{ view? teacherForm.fullname:""}}</h5>
                        </span>
                        <span v-else>
                            <h5 class="modal-title" id="verticalCenterTitle">{{editMode ? "Update Information" : "Add Teacher"}}</h5>
                        </span>
                        <button type="button" class="close" @click="cancelModal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="inputName">Name</label>
                                <input type="text" class="form-control" id="inputName" required v-model="teacherForm.fullname">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputDateEmployed">Date Employed</label>
                                    <input type="text" class="form-control" id="inputDateEmployed" required v-model="teacherForm.dateEmployed">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPosition">Position</label>
                                    <input type="text" class="form-control" id="inputPosition" required v-model="teacherForm.position">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="selectSex">Sex</label>
                                <select id="selectSex" required v-model="teacherForm.sex" class="form-control">
                                    <option selected>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputDOB">DOB</label>
                                    <input type="text" class="form-control" id="inputDOB" required v-model="teacherForm.dob">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPOB">POB</label>
                                    <input type="text" class="form-control" id="inputPOB" required v-model="teacherForm.pob">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputEmployeeNo">Employee No.</label>
                                    <input type="number" class="form-control" id="inputEmployeeNo" required v-model="teacherForm.employeeNumber">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputStation">Station</label>
                                    <input type="text" class="form-control" id="inputStation" required v-model="teacherForm.station">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputCivilStatus">Civil Status</label>
                                    <input type="text" class="form-control" id="inputCivilStatus" required v-model="teacherForm.civilStatus">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer p-1" v-if="view">
                        <button type="button" class="btn btn-danger pt-1 pb-1" @click="cancelModal">Close</button>
                    </div>
                    <div class="modal-footer p-1" v-else>
                        <button type="button" class="btn btn-danger pt-1 pb-1" @click="cancelModal">Close</button>
                        <button type="submit" class="btn btn-success pt-1 pb-1">Save</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <!-- end Modal -->
        <!-- start Modal -->
        <div class="modal fade text-center" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header p-2">
                        <h5 class="modal-title " id="deleteModalTitle"><i class="ti ti-alert"></i> Delete confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you suse, you want delete this record?{{teacherForm.fullname}}</p>
                    </div>
                    <div class="modal-footer p-1">
                        <button type="button" @click="deleteNow" class="btn btn-block btn-sm pb-1 pt-1 btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Modal -->
    </div>
</template>
<script>
    import pagination from './../extra/pagination'
    export default{
        components:{
            pagination
        },
        data(){
            return{
                teacherForm:{
                    id:'',
                    fullname:'',
                    position:'',
                    dateEmployed:'',
                    sex:'',
                    dob:'',
                    pob:'',
                    employeeNumber:'',
                    station:'',
                    civilStatus:''
                },
                isLoading:false,
                editMode:false,
                view:false,
                employees:[],
                queryFiled: "fullname",
                query:'',
                pagination: {
                    current_page: 1
                },
                obj:{}
            }
        },
         watch: {
            query: function(newQ, old) {
            if (newQ === "") {
                this.getData();
            } else {
                this.searchData();
            }
            }
        },
        methods:{
            deleteModal(action){
                $('#deleteModal').modal(action)
            },
            useModal(action){
                $('#verticalCenter').modal(action)
            },
            cancelModal(){
                this.clearFields(this.teacherForm)
                this.useModal('hide')
            },
            viewRecord(id){
                this.$router.push({
                    name: 'record',
                    params: {
                        id: id
                    } 
                })
            },
            async getData(){
                this.isLoading=true
                this.$Progress.start()
                const res = await this.callApi('get',`api/getTeacher/?page=${this.pagination.current_page}`)
                if (res.status==200 || res.status==201) {
                    res.data.data.length!=0?this.isLoading=true:this.isLoading=false
                    this.$Progress.finish()
                    this.employees=res.data.data
                    this.pagination=res.data.meta
                } else {
                    this.$Progress.fail()
                }
            },
            async store() {
                this.$Progress.start()
                const res = await this.callApi('post','api/storeTeacher',this.teacherForm)
                if(res.status==200 || res.status==201){
                    this.getData()
                    this.$Progress.finish()
                    this.clearFields(this.teacherForm)
                    this.useModal('hide')
                    // this.toastMe()
                    this.notice('success','Success','Successfully added new data!')
                }else{

                }
            },
            async searchData() {
                this.$Progress.start()
                 const res = await this.callApi('get',`api/searchTeacher/${this.queryFiled}/${this.query}?page=${this.pagination.current_page}`)
                    if (res.status==200) {
                        this.$Progress.finish()
                        this.employees = res.data.data
                        this.pagination = res.data.meta;
                    } else {
                        this.$Progress.fail()
                    }    
            },
            show(employee){
                this.view=true
                Object.keys(this.teacherForm).forEach(param=>{
                    this.teacherForm[param]=employee[param]
                })
                this.useModal("show");
            },
            edit(employee){
                this.obj=employee
                this.editMode=true
                 Object.keys(this.teacherForm).forEach(param=>{
                    this.teacherForm[param]=employee[param]
                })
                this.useModal('show')
            },
            async update(){
                const res = await this.callApi('put','api/updateTeacher',this.teacherForm)
                res.status==200||res.status==201?this.notice('success','Update','Successfully Update one Record'):this.notice('error','System Error','Something went wrong')
                this.getData()
                this,clearFields(this.teacherForm)
            },
            destroy(employee){
                this.obj=employee
                this.deleteModal('show')
                this.teacherForm.fullname=employee.fullname
            },
            async deleteNow(){
                this.deleteModal('hide')
                const res = await this.callApi('delete',`api/deleteTeacher/${this.obj.id}`)
                res.status==200||res.status==201?this.notice('success','Deleted','Successfully deleted one Record'):this.notice('error','System Error','Something went wrong')
                this.getData()
            },
            reload() {
                this.getData();
                this.query = "";
                this.queryFiled = "fullname";
                // this.$snotify.success("Data Successfully Refresh", "Success");
            },
        },
        mounted(){
            console.log('teacher')
            this.getData()
        }
    }
</script>