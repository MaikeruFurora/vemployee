<template>
     <Modal v-model="modal2" width="360">
        <p slot="header" style="color:#f60;text-align:center">
            <Icon type="ios-information-circle"></Icon>
            <span>Delete confirmation</span>
        </p>
        <div style="text-align:center">
            <p>After this task is deleted, the downstream 10 tasks will not be implemented.</p>
            <p>Will you delete it?</p>
        </div>
        <div slot="footer">
            <Button type="error" size="large" long :loading="modal_loading" @click="del">Delete</Button>
        </div>
    </Modal>
</template>
<script>
    export default{
        data(){
            return{
                teacherForm:{
                    fullname:'',
                    position:'',
                    dateEmployed:'',
                    sex:'',
                    dob:'',
                    pob:'',
                    employeeNumber:'',
                    station:'',
                    civilStatus:''
                }
            }
        },
        methods:{
            AddTeacherNow(){

                this.addModal('hide')
            }
        }
    }
</script>