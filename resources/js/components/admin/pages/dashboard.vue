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
                                <div class="page-title mb-2 mb-sm-4">
                                    <h1>Dashboard</h1>
                                </div>
                            </div>
                            <!-- end page title -->
                            <div class="row">
                            <div class="col-sm-12">
                                <div class="card card-statistics">
                                    <div class="row no-gutters">
                                        <div class="col-xxl-3 col-lg-6">
                                            <div class="p-20 border-lg-right border-bottom border-xxl-bottom-0">
                                                <div class="d-flex m-b-10">
                                                    <p class="mb-0 font-regular text-muted font-weight-bold">Total Teachers</p>
                                                </div>
                                                <div class="d-block d-sm-flex h-100 align-items-center">
                                                    <div class="apexchart-wrapper">
                                                        <!-- <i class="fa fa-signal p-0 text-success" style="font-size:40px"></i> -->
                                                        <div id="analytics7"></div>
                                                    </div>
                                                    <div class="statistics mt-3 mt-sm-0 ml-sm-auto text-center text-sm-right">
                                                        <h3 class="mb-0"><i class="fa fa-group"></i> <span class="noTeacher"></span></h3>
                                                        <p>Number of Teachers</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-6">
                                            <div class="p-20 border-xxl-right border-bottom border-xxl-bottom-0">
                                                <div class="d-flex m-b-10">
                                                    <p class="mb-0 font-regular text-muted font-weight-bold">Total School</p>
                                                </div>
                                                <div class="d-block d-sm-flex h-100 align-items-center">
                                                    <div class="apexchart-wrapper">
                                                        <!-- <i class="fa fa-signal p-0 text-info" style="font-size:40px"></i> -->
                                                        <div id="analytics8"></div>
                                                    </div>
                                                    <div class="statistics mt-3 mt-sm-0 ml-sm-auto text-center text-sm-right">
                                                        <h3 class="mb-0"><i class="fa fa-graduation-cap"></i> <span class="noSchool"></span></h3>
                                                        <p>Number of Schools</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-6">
                                            <div class="p-20 border-lg-right border-bottom border-lg-bottom-0">
                                                <div class="d-flex m-b-10">
                                                    <p class="mb-0 font-regular text-muted font-weight-bold">Total Sales</p>
                                                </div>
                                                <div class="d-block d-sm-flex h-100 align-items-center">
                                                    <div class="apexchart-wrapper">
                                                        <div id="analytics9"></div>
                                                    </div>
                                                    <div class="statistics mt-3 mt-sm-0 ml-sm-auto text-center text-sm-right">
                                                        <h3 class="mb-0"><i class="icon-arrow-up-circle"></i>569</h3>
                                                        <p>Avg. Sales per day</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-6">
                                            <div class="p-20">
                                                <div class="d-block d-sm-flex h-100 align-items-center">
                                                    <div class="apexchart-wrapper">
                                                        <div id="analytics10"></div>
                                                    </div>
                                                    <div class="statistics ml-sm-auto mt-4 mt-sm-0 pr-sm-5">
                                                        <ul class="list-style-none p-0">
                                                            <li class="d-flex py-1">
                                                                <span><i class="fa fa-circle text-primary pr-2"></i> Redirect Visits</span> <span class="pl-2 font-weight-bold">456</span></li>
                                                            <li class="d-flex py-1"><span><i class="fa fa-circle text-warning pr-2"></i> New Visits</span> <span class="pl-2 font-weight-bold">256</span></li>
                                                            <li class="d-flex py-1"><span><i class="fa fa-circle text-info pr-2"></i> Direct Visits</span> <span class="pl-2 font-weight-bold">128</span></li>
                                                        </ul>
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
<script>
    export default{
        mounted(){
            console.log('dashboard')
            this.getTotal()
            this.statistic()
        },
        methods:{
            async getTotal(){
                this.$Progress.start()
                const res = await this.callApi('get',`api/getTotal`)
                // console.log(res);
                if (res.status==200 || res.status==201) {
                    this.$Progress.finish()
                    $(".noTeacher").text(res.data.length)
                    const stationLength = res.data.filter((value,index,array) => {
                        return  array.indexOf(value.station)==index
                    });

                    const result = [];
                    const map = new Map();
                    for (const item of res.data) {
                        if(!map.has(item.id)){
                            map.set(item.id, true);    // set any value to Map
                            result.push({
                                id: item.id,
                                name: item.name
                            });
                        }
                    }
                    $(".noSchool").text(result.length)
                } else {
                    this.$Progress.fail()
                }
            },

            statistic(){
                // analytics7
        var analytics7 = jQuery('#analytics7')
            if (analytics7.length > 0) {
                var options = {
                    chart: {
                        type: 'bar',
                        width: 120,
                        height: 50,
                        sparkline: {
                          enabled: true
                        }
                      },
                      colors:['#8E54E9'],
                      plotOptions: {
                        bar: {
                          columnWidth: '20%',
                           endingShape: 'rounded',
                        }
                      },
                      series: [{
                        data: [15, 55, 60, 69, 53, 35, 54]
                      }],
                      labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                      xaxis: {
                        crosshairs: {
                          width: 1
                        },
                      },
                      tooltip: {
                        fixed: {
                          enabled: false
                        },
                        x: {
                          show: false
                        },
                        y: {
                          title: {
                            formatter: function (seriesName) {
                              return ''
                            }
                          }
                        },
                        marker: {
                          show: false
                        }
                      },
                      responsive: [{
                        breakpoint: 360,
                        options: {
                            chart: {
                                width:60,
                                height:60
                            }
                        },
                    },{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width:100,
                                height:80
                            }
                        },
                    }]
                }

              var chart = new ApexCharts(
                        document.querySelector("#analytics7"),
                        options
                    );
                    chart.render();
               }

               // analytics8
                var analytics8 = jQuery('#analytics8')
            if (analytics8.length > 0) {
                var options = {
                    chart: {
                        type: 'bar',
                        width: 120,
                        height: 50,
                        sparkline: {
                          enabled: true
                        }
                      },
                      colors:['#2bcbba'],
                      plotOptions: {
                        bar: {
                          columnWidth: '20%',
                           endingShape: 'rounded',
                        }
                      },
                      series: [{
                        data: [15, 55, 60, 69, 53, 35, 54]
                      }],
                      labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                      xaxis: {
                        crosshairs: {
                          width: 1
                        },
                      },
                      tooltip: {
                        fixed: {
                          enabled: false
                        },
                        x: {
                          show: false
                        },
                        y: {
                          title: {
                            formatter: function (seriesName) {
                              return ''
                            }
                          }
                        },
                        marker: {
                          show: false
                        }
                      },
                      responsive: [{
                        breakpoint: 360,
                        options: {
                            chart: {
                                width:60,
                                height:60
                            }
                        },
                    },{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width:100,
                                height:80
                            }
                        },
                    }]
                }

              var chart = new ApexCharts(
                        document.querySelector("#analytics8"),
                        options
                    );
                    chart.render();
               }
            }

        },
        
    }
</script>