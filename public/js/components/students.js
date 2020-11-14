Vue.component("students-list-confirmed",{
    props:["group"],
    template:`
        <table v-on:click='getStudentData'>
            <tr id='students-list-confirmed'>
                <th>Дата реєстрації</th>
                <th>№</th>
                <th>Ім'я</th>
                <th>Підгрупа</th>
                <th>Статус</th>
                <th>Операції</th>
            </tr>
            <confirmed-student v-on:delete='deleteConfirm' v-for='(item, index) in this.confirmedStudents' :key='index' :online='item.online' :date='item.created_at' :name='item.name' :number='item.student_number' :subgroup='item.subgroup' :studentId='item.id'></confirmed-student>
        </table>
    `,
    data(){
        return{
            confirmedStudents:{}
        }
    },
    methods:{
        getStudentData: function(){
            let xhr = getXHR("GET", `http://${window.location.host}/data/groups/students/list/${this.group}/confirmed`);
            xhr.send();
            xhr.onload = ()=>{
               this.confirmedStudents = JSON.parse(decodeURI(xhr.response));
               console.log(this.confirmedStudents);
            }
        },
        deleteConfirm(id){
            let data = {
                "id":id,
                "url":`http://${window.location.host}/admin/users/delete/${id}`,
                "title": "Видалити учня?",
                "msg": "Ви впевнені, що хочете видалити цього учня?",
                "callback": this.getStudentData
            }

            this.$emit('delstart', data);
        }
    },
    beforeMount(){
        this.getStudentData();
    }
});

Vue.component("confirmed-student",{
    props:["date", "number", "name", "subgroup", "studentId", "online"],
    template:`
        <tr>
            <td>{{this.date}}</td>
            <td>{{this.number}}</td>
            <td>{{this.name}}</td>
            <td>{{this.subgroup}}</td>
            <td><div v-if='this.online' class='student-status online' title='Користувач онлайн'></div><div v-if='this.online == false' class='student-status offline' title='Користувач офлайн'></div></td>
            <td>
                <a href="#" class="dark" v-on:click='deleteStudent'>Видалити</a>
            </td>
        </tr>
    `,
    methods:{
        deleteStudent:function(){
            this.$emit('delete', this.studentId);
        }
    }
});


/***********************/


Vue.component("students-list-unconfirmed",{
    props:["group"],
    template:`
        <table>
            <tr>
                <th>Дата реєстрації</th>
                <th>Ім'я</th>
                <th>Операції</th>
            </tr>
            <unconfirmed-student v-on:submit='submitConfirm' v-on:reject='deleteConfirm' v-for='(item, index) in this.unconfirmedStudents' :key='index' :date='item.created_at' :name='item.name' :studentId='item.id'></unconfirmed-student>
        </table>
    `,
    data(){
        return{
            unconfirmedStudents:{}
        }
    },
    methods:{
        getStudentData(){
            let xhr = getXHR("GET", `http://${window.location.host}/data/groups/students/list/${this.group}/unconfirmed`);
            xhr.send();
            xhr.onload = ()=>{
               this.unconfirmedStudents = JSON.parse(decodeURI(xhr.response));
            }
        },
        deleteConfirm(id){
            let data = {
                "id":id,
                "url":`http://${window.location.host}/admin/users/delete/${id}`,
                "title": "Видалити учня?",
                "msg": "Ви впевнені, що хочете видалити цього учня?",
                "callback": this.getStudentData
            }

            this.$emit('delstart', data);
        },
        submitConfirm(info){
            let id = info[0];
            let name = info[1];
            let index = 0;
            let token = getToken();

            clearMessageContainer();

            let data = {
                'title':`Підтвердити учня ${name}?`,
                'msg':`
                    <form id='submit-student' method='POST'>
                        <input type='hidden' name='_method' value='PUT'>
                        <input type='hidden' name='_token' value='${token}'>
                        <input type='hidden' name='student_id' value='${id}'>
                        <input type="text" id="student-number" class="white" name='student_number' placeholder=" " autocomplete="off" >
                        <label for="student-number" class="white">Введіть номер учня по списку:</label>
                        <select name='subgroup' class="white">
                            <option disabled selected value='1' class='dark'>Оберіть підгрупу</option>
                            <option value='1' class='dark'>I</option>
                            <option value='2' class='dark'>II</option>
                        </select>
                    </form>
                    <a href='#' class='p-like white system-message-accept' data-index="${index}">Так</a>
                `,
                'type':"informative",
                'callback': this.submitStudent
            };

            window.systemMessages.push(data);
        },
        submitStudent(){
            let data = new FormData(document.getElementById("submit-student"));
            let id = document.querySelector("[name='student_id']").value;

            console.log(data);

            let xhr = getXHR("POST", `http://${window.location.host}/admin/users/confirm/${id}`);
            xhr.send(data);
            xhr.onload = ()=>{
                window.systemMessages.push(JSON.parse(decodeURI(xhr.response)));
                this.getStudentData();
                document.getElementById("students-list-confirmed").click();
            }
        }
    },
    beforeMount(){
        this.getStudentData();
    }
});

Vue.component("unconfirmed-student",{
    props:["date", "name", "studentId"],
    template:`
        <tr>
            <td>{{this.date}}</td>
            <td>{{this.name}}</td>
            <td>
                <a href="#" class="dark" v-on:click='submitStudent'>Підтвердити</a>
                <a href="#" class="dark" v-on:click='rejectStudent'>Відмовити</a>
            </td>
        </tr>
    `,
    methods:{
        rejectStudent:function(){
            this.$emit('reject', this.studentId);
        },
        submitStudent: function(){
            this.$emit('submit', [this.studentId, this.name]);
        }
    }
});