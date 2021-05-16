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
                                    <div class="page-title mr-4 pr-4">
                                        <h1>Leave without pay</h1>
                                    </div>
                                    <div class="ml-auto d-flex align-items-center secondary-menu text-center">
                                        <button v-if="isPrint" class="btn btn-primary mr-3" @click="downloadWord()">
                                            <i class="ti ti-download text-white pr-2"></i> Print Certificate</button>
                                        <multiselect 
                                            v-model="value"
                                            :options="options"
                                            placeholder="Search name here..."
                                            label="fullname"
                                            track-by="id"
                                            />     
                                    </div>
                                </div>
                                <!-- end page title -->
                            </div>
                    </div>
                <!-- end row -->
                <!-- start row -->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="example" class="table table-bordered text-center table-striped" style="font-size: 11px">
                                <thead>
                                    <tr>
                                        <td style="background-color: #4d6600" colspan="8" class="font-weight-bold text-white text-center">RECORD OF LEAVE</td>
                                    </tr>
                                    <tr class="font-weight-bold text-white">
                                        <td style="background-color: #86b300" width="20%">Inclusive Dates</td>
                                        <td style="background-color: #86b300" width="6">No.of Days Leave</td>
                                        <td style="background-color: #86b300" width="6">Service Credit Balance</td>
                                        <td style="background-color: #86b300" width="6">Leave W/OUT PAY</td>
                                        <td style="background-color: #86b300" width="6">Nature of Leave</td>
                                        <td style="background-color: #86b300" width="6">DSO No.</td>
                                        <td style="background-color: #86b300" width="10%">Remarks</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(lawop,i) in lawops" :key="i" v-show="lawops.length">
                                        <td>{{ lawop.inclusivePeriod}}</td>
                                        <td>{{ lawop.noOfDaysLeave}}</td>
                                        <td>{{ lawop.serviceCreditBalance}}</td>
                                        <td>{{ lawop.leaveWithoutpay}}</td>
                                        <td>{{ lawop.natureOfLeave}}</td>
                                        <td>{{ lawop.dsoNumber2}}</td>
                                        <td>{{ lawop.remarks}}</td> 
                                    </tr>
                                    <tr>
                                        <td colspan="7" v-show="!lawops.length">
                                            <p v-show="isStatus==true">No data available</p>
                                            <p v-show="isStatus==null">Type the name of teacher in the search bar</p>
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
    </div>
</template>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<script>
import Multiselect from 'vue-multiselect'
    export default{
        mounted(){
           this.$Progress.start()
            this.$Progress.finish()
            this.getResults()
        },
                components: {
            Multiselect
        },
        data(){
          return{
              isStatus:null,
              isPrint:false,
              value: null,
              options:[],
              lawops:[],
          }  
        },
        methods:{
            async getResults(){
                
                const res = await this.callApi('get',`api/liveSearch`)
                if (res.status==200) {
                    
                    this.options=res.data
                } else {
                    console.log(res.data)
                }
            },
            downloadWord(){
                window.open(`api/getWordRecord/${this.value.id}`,'_blank');  
            },
            async getLawop(){
                this.isStatus=true
                this.$Progress.start()
                const res =await this.callApi('get',`api/getLawop/${this.value.id}`)
                if (res.status==200) {
                    res.data.length==0?this.isStatus=true:this.isStatus=false
                    this.$Progress.finish()
                    this.lawops=res.data
                    // console.log(res.data[0].id);
                    res.data.length>0?this.isPrint=true:this.isPrint=false
                    
                } else {
                    this.$Progress.fail()
                }
            }
        },
        watch:{
            value(after,before){
                this.getLawop()
            }
        },
    }
</script>