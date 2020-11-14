Vue.component("user-list",{
    template: `                
        <table>
            <tr>
                <th>Дата реєстрації</th>
                <th>Логін</th>
                <th>Ім'я</th>
                <th>Email</th>
                <th>Статус</th>
                <th>Операції</th>
            </tr>
            <user v-on:delete='deleteConfirm' v-on:access='changeAccessLevel' v-for="item in this.users" :regDate='item.created_at' :userId='item.id' :login='item.login' :userName='item.name' :userEmail='item.email' :accessLevel='item.access_level'></user>
        </table>
    `,
    data(){
        return{
            users:{},
        }
    },
    beforeMount(){
        this.getUsersList();
    },
    methods:{
        deleteConfirm: function(id){
            let data = {
                "id":id,
                "url":`http://${window.location.host}/admin/users/delete/${id}`,
                "title": "Видалити користувача?",
                "msg": "Ви впевнені, що хочете видалити цього користувача?",
                "callback": this.getUsersList
            }

            this.$emit('delstart', data);

        },
        getUsersList:function(){
            let xhr = getXHR("GET", `http://${window.location.host}/data/users/list`);
            xhr.send();
            xhr.onload = ()=>{
                this.users = JSON.parse(decodeURI(xhr.response));
            }
        },
        changeAccessLevel:function(id){
            let data = new FormData();

            let token = getToken();

            data.append("_method","PUT");
            data.append("_token",token);

            let xhr = getXHR("POST", `http://${window.location.host}/admin/users/access/${id}`);
            xhr.send(data);

            xhr.onload = ()=>{
                window.systemMessages.push(JSON.parse(xhr.response));
                this.getUsersList();
            }
        }
    }
});

Vue.component('user',{
    props:['regDate', 'login', 'userName', 'userEmail', 'accessLevel', 'userId'],
    template:
    `
        <tr>
            <td>{{this.regDate}}</td>
            <td>{{this.login}}</td>
            <td>{{this.userName}}</td>
            <td>{{this.userEmail}}</td>
            <td>{{this.status}}</td>
            <td>
                <a href="#" class="dark" v-on:click='changeAccessLevel'><span v-if="isStudent">Підвищити</span><span v-if="isAdmin">Понизити</span></a>
                <a href="#" class="dark" v-on:click='sendDeleteRequest'>Видалити</a>
            </td>
        </tr>
    `,
    data(){
        return{
            status:"Учень"   ,
            isAdmin: false,
            isStudent: true 
        }
    },
    methods:{
        sendDeleteRequest:function(){
            this.$emit('delete',this.userId);
        },
        changeAccessLevel: function(){
            this.$emit('access',this.userId);
        }
    },
    mounted(){
        if(this.accessLevel == 2){
            this.status = "Адміністратор";
            this.isAdmin = true;
            this.isStudent = false;
        }
    }
});