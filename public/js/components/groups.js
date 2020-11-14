Vue.component("group-list",{
    template: `                
        <table>
            <tr>
                <th>Дата створення</th>
                <th>Назва</th>
                <th>Кількість учнів</th>
                <th>Нових запитів</th>
                <th>Майстер В/Н.</th>
                <th>Операції</th>
            </tr>
            <group v-for="item in this.groupData" :key="item.id" :created_at="item.created_at" :name="item.name" :confirmed_students="item.confirmed_students" :unconfirmed_students="item.unconfirmed_students" :master_vn="item.master_vn" :group_id='item.id' v-on:delete="deleteGroupConfirm"></group> 
        </table>
    `,
    data(){
        return{
            groupData:{},
        }
    },
    beforeMount(){
        this.getGroupList();
    },
    methods:{
        deleteGroupConfirm: function(id){
            let data = {
                "id":id,
                "url":`http://${window.location.host}/admin/groups/delete/${id}`,
                "title": "Видалити групу?",
                "msg": "Ви впевнені, що хочете видалити цю групу?",
                "callback": this.getGroupList
            }

            this.$emit('delstart', data);

        },
        getGroupList:function(){
            let xhr = getXHR("GET", `http://${window.location.host}/data/groups/list`);
            xhr.send();
            xhr.onload = ()=>{
                this.groupData = JSON.parse(decodeURI(xhr.response));
            }
        }
    }
});

Vue.component("group",{
    props:["created_at", "name", "confirmed_students", "unconfirmed_students", "master_vn", "group_id"],
    template:`
        <tr>
            <td>{{this.created_at}}</td>
            <td>{{this.name}}</td>
            <td>{{this.confirmed_students}}</td>
            <td>{{this.unconfirmed_students}}</td>
            <td>{{this.master_vn}}</td>
            <td>
                <a :href="'http://${window.location.host}/admin/groups/manage/'+this.group_id" class="dark">Керувати</a>
                <a href="#" class="dark" v-on:click='sendDeleteRequest'>Видалити</a>
                <a :href="'http://${window.location.host}/admin/groups/edit/'+this.group_id" class="dark">Редагувати</a>
            </td>
        </tr>
    `,
    methods:{
        sendDeleteRequest:function(){
            this.$emit('delete', this.group_id);
        }
    }
});