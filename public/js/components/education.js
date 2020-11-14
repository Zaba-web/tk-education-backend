Vue.component("course-list",{
    template: `                
        <table>
            <tr>
                <th>Розділ</th>
                <th>К-сть тем</th>
                <th>Операції</th>
            </tr>
            <course v-for="(item, index) in this.courses" :key='index' :courseName='item.name' :courseId='item.id' :themeCount='item.themeCount' v-on:delete='deleteConfirm'></course>
        </table>
    `,
    data(){
        return{
            courses:{},
        }
    },
    beforeMount(){
        this.getCoursesList();
    },
    methods:{
        deleteConfirm: function(id){
            let data = {
                "id":id,
                "url":`http://${window.location.host}/admin/education/course/delete/${id}`,
                "title": "Видалити розділ?",
                "msg": "Ви впевнені, що хочете видалити цей розділ?",
                "callback": this.getCoursesList
            }

            this.$emit('delstart', data);

        },
        getCoursesList:function(){
            let xhr = getXHR("GET", `http://${window.location.host}/data/courses/list`);
            xhr.send();
            xhr.onload = ()=>{
                this.courses = JSON.parse(decodeURI(xhr.response));
            }
        }
    }
});

Vue.component("course",{
    props:['courseName', 'courseId', 'themeCount'],
    template:
    `
        <tr>
            <td>{{this.courseName}}</td>
            <td>{{this.themeCount}}</td>
            <td>
                <a :href="'http://${window.location.host}/admin/education/course/manage/'+this.courseId" class="dark">Керувати</a>
                <a href="#" class="dark" v-on:click='sendDeleteRequest'>Видалити</a>
                <a :href="'http://${window.location.host}/admin/education/course/edit/'+this.courseId" class="dark">Редагувати</a>
            </td>
        </tr>
    `,
    methods:{
        sendDeleteRequest: function(){
            this.$emit('delete',this.courseId);
        }
    }
});




Vue.component("theme-list",{
    props:["course"],
    template: `                
        <table>
            <tr>
                <th>ID</th>
                <th>Заголовок</th>
                <th>Кількість завдань</th>
                <th>Операції</th>
            </tr>
            <theme v-on:delete='deleteConfirm' v-for="item in this.themes" :themeId='item.id' :themeTitle='item.title' :taskCount='item.taskCount'></theme>
        </table>
    `,
    data(){
        return{
            themes:{},
        }
    },
    mounted(){
        this.getThemesList();
    },
    methods:{
        deleteConfirm: function(id){
            let data = {
                "id":id,
                "url":`http://${window.location.host}/admin/education/theme/delete/${id}`,
                "title": "Видалити тему?",
                "msg": "Ви впевнені, що хочете видалити цю тему?",
                "callback": this.getThemesList
            }

            this.$emit('delstart', data);

        },
        getThemesList:function(){
            let xhr = getXHR("GET", `http://${window.location.host}/data/themes/list/${this.course}`);
            xhr.send();
            xhr.onload = ()=>{
                this.themes = JSON.parse(decodeURI(xhr.response));
            }
        }
    }
});

Vue.component('theme',{
    props:["themeId", "themeTitle", "taskCount"],
    template: 
    `
        <tr>
            <td>{{this.themeId}}</td>
            <td>{{this.themeTitle}}</td>
            <td>{{this.taskCount}}</td>
            <td>
                <a href="#" class="dark" v-on:click='giveAccessToGroupConfirmation'>Надати доступ</a>
                <a :href="'http://${window.location.host}/admin/education/theme/manage/'+this.themeId" class="dark">Керувати</a>
                <a href="#" class="dark" v-on:click='sendDeleteRequest'>Видалити</a>
                <a :href="'http://${window.location.host}/admin/education/theme/edit/'+this.themeId" class="dark">Редагувати</a>
            </td>
        </tr>
    `,
    methods:{
        sendDeleteRequest: function(){
            this.$emit('delete',this.themeId);
        },
        giveAccessToGroupConfirmation: function(){
            let groupData;

            let xhr = getXHR("GET", `http://${window.location.host}/data/groups/list`);
            xhr.send();
            xhr.onload = ()=>{
                groupData = JSON.parse(decodeURI(xhr.response));

                let groups = "";

                groupData.forEach(element => {
                    groups += `<option value='${element.id}|${element.name}'>${element.name}</option>`;
                });

                clearMessageContainer();

                let data = {
                    "title": "Надати доступ",
                    "msg":`
                        <p class='white'>Оберіть групу<br><select class='white' id='give-group-access'>${groups}</select><br><a href='#' class='p-like white system-message-accept' data-index="0">Надати</a></p>
                    `,
                    "type":"informative",
                    "callback":this.giveAccessToGroup
                };

                window.systemMessages.push(data);
            }
        },
        giveAccessToGroup: function(){
            let value = document.getElementById("give-group-access").value;
            value = value.split("|");
            let group_id = value[0];
            let group_name = value[1];
            let token = getToken();

            let formData = new FormData();
            formData.append("group_id", group_id);
            formData.append("group_name", group_name);
            formData.append("theme_id", this.themeId);
            formData.append("theme_title", this.themeTitle);
            formData.append("_token", token);

            let xhr = getXHR("POST", `http://${window.location.host}/admin/education/theme/open`);
            xhr.send(formData);
            xhr.onload = ()=>{
                window.systemMessages.push(JSON.parse(decodeURI(xhr.response)));
            }
        }
    }
});




Vue.component("task-list",{
    props:["theme"],
    template: `                
        <table>
            <tr>
                <th>ID</th>
                <th>Заголовок</th>
                <th>Операції</th>
            </tr>
            <task v-on:delete='deleteConfirm' v-for="item in this.tasks" :taskId="item.id" :taskTitle='item.title' :isDraft='item.is_draft' :isThematic='item.is_themactic' :markType='item.check_mode'></task>
        </table>
    `,
    data(){
        return{
            tasks:{},
        }
    },
    mounted(){
        this.getTaskList();
    },
    methods:{
        deleteConfirm: function(id){
            let data = {
                "id":id,
                "url":`http://${window.location.host}/admin/education/task/delete/${id}`,
                "title": "Видалити завдання?",
                "msg": "Ви впевнені, що хочете видалити це завдання?",
                "callback": this.getTaskList
            }

            this.$emit('delstart', data);

        },
        getTaskList:function(){
            let xhr = getXHR("GET", `http://${window.location.host}/data/tasks/list/${this.theme}`);
            xhr.send();
            xhr.onload = ()=>{
                this.tasks = JSON.parse(decodeURI(xhr.response));
            }
        }
    }
});

Vue.component('task',{
    props:["taskId", "taskTitle", "isDraft", "isThematic", "markType"],
    template: 
    `
        <tr>
            <td>{{this.taskId}}</td>
            <td>{{this.taskTitle}} <small class='dark' v-if='isTaskThematic'> | Тематична </small> <sup class='draft' v-if="isTaskDraft">Чернетка</sup></td>
            <td>
                <a :href="'http://${window.location.host}/admin/education/task/view/'+this.taskId" class="dark">Переглянути</a>
                <a href="#" class="dark" v-on:click='sendDeleteRequest'>Видалити</a>
                <a :href="'http://${window.location.host}/admin/education/task/edit/'+this.taskId" class="dark">Редагувати</a>
            </td>
        </tr>
    `,
    data(){
        return{
            isTaskDraft:false,
            canCheck: false,
            isTaskThematic: false
        }
    },
    methods:{
        sendDeleteRequest: function(){
            this.$emit('delete',this.taskId);
        }
    },
    mounted(){
        if(this.isDraft == 2){
            this.isTaskDraft = true;
        }

        if(this.markType >= 2){
            this.canCheck = true;
        }

        if(this.isThematic == "on"){
            this.isTaskThematic = true;
        }
    }
});

