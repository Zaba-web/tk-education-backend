window.systemMessages = [
    //   {
    //        'title':"Title",
    //        'msg':'Lorem ipsum dolor sit amet.',
    //        'type':"error"
    //   }
];

document.addEventListener('click', function(e){
    if(e.target.classList.contains("system-message-accept")){
        let index = e.target.dataset.index;
        if(window.systemMessages[index]["callback"] != undefined){
            window.systemMessages[index]["callback"]();
            window.systemMessages.pop(index);
        }
    }

    if(e.target.classList.contains("filter")){
        let id = e.target.dataset.id;
        let elements = document.querySelectorAll('.unchecked-table tr:not(.t-head)');
        elements.forEach(element => {
            if(!element.classList.contains(`group-${id}`)){
                element.classList.add('tr-hidden');
            }
        });
    }else if(e.target.classList.contains("resetFilter")){
        let elements = document.querySelectorAll('.unchecked-table tr');
        elements.forEach(element => {
            element.classList.remove('tr-hidden');
        });
    }
    
});

document.addEventListener("DOMContentLoaded", function(event) {
    setTimeout(()=>{
        let tables = document.querySelectorAll("table");
        tables.forEach(table => {
            let rows = table.querySelectorAll("tr");
            if(rows.length == 1){
                let container = document.createElement('div');
                container.innerHTML = "<span class='p-like dark'>Більше тут нічого немає</span>";
                container.classList.add('table-end');
                table.after(container);
            }
        });
    },500);
});

function getToken(){
    return document.getElementById("token").innerHTML;
}

function clearMessageContainer(){
    for(let i = 0; i < window.systemMessages.length; i++){
        window.systemMessages.pop(i);
    }
}

function getXHR(method, url){
    let xhr = new XMLHttpRequest();
    xhr.open(method, url);
    return xhr;
}

let app = new Vue({
    el: '#application',
    data: {
        systemMessages:[],
        unactiveUsers:0,
        itemToDelete: {
            url:null,
            id:null,
            callback:null
        },
        adminChartWidth:0
    },
    methods:{
        switchMenu: function(){
            let sidebarContainer = document.querySelector(".sidebar-container");
            if(window.innerWidth <= 800){
                if(!sidebarContainer.classList.contains("enabled")){
                    anime({
                        targets:sidebarContainer,
                        width:"100vw",
                        height:"100vh",
                        borderRadius:0,
                        top:0,
                        left:0,
                        easing: 'easeInCubic',
                        duration:500,
                        complete:()=>{
                            sidebarContainer.classList.add("enabled");
                        }
                    });
                }else{
                    anime({
                        targets:sidebarContainer,
                        width:["100vw","90%"],
                        left:[0,"5%"],
                        top:[0,"20px"],
                        borderRadius:[0,"20px"],
                        height:["100%","20%"],
                        duration:500,
                        easing: 'easeInCubic',
                        complete:()=>{
                            sidebarContainer.classList.remove("enabled");
                            sidebarContainer.style = "";
                        }
                    });
                }
            }
        },

        validateInput: function(event){
            let element = event.target;
            let minLength = element.dataset.from;
            let maxLength = element.dataset.to;
    
            let value = element.value;
    
            function disable(target = element, msg = null){
                target.classList.add('invalid');
                target.dataset.validate = false;
    
                if(document.querySelector(`[data-parent='${target.dataset.field}']`) == null){
    
                    let errorMessage = document.createElement("div");
                    errorMessage.classList.add("form-error-container");
                    errorMessage.dataset.parent = target.dataset.field;
    
                    let messageText = "";
    
                    if(msg == null){
                        messageText = `Довжина поля ${target.dataset.field} повинна бути від ${minLength} до ${maxLength}`;
                    }else{
                        messageText = msg;
                    }
    
                    errorMessage.innerHTML=`<small class='form-error-msg'>${messageText}</small>`;
    
                    target.nextSibling.nextSibling.after(errorMessage);
    
                }
            }
    
            function enable(target = element){
                target.classList.remove('invalid');
                target.dataset.validate = true;
    
                if(document.querySelector(`[data-parent='${target.dataset.field}']`) != null)
                    document.querySelector(`[data-parent='${target.dataset.field}']`).remove();
            }
    
            if(value.length < minLength || value.length > maxLength){
                disable();
            }else{
                enable();
            }
    
            if(element.dataset.link != undefined){
                let confirmationInput = document.querySelector(`.${element.dataset.link}`);
                if(confirmationInput.value != value){
                    disable(confirmationInput, "Поля повинні співпадати");
                }else{
                    enable(confirmationInput);
                }
            }
        },
        
        validateForm: function(event){
            event.preventDefault();
            let form = event.target;
            let formInputs = form.querySelectorAll(`input`);
            let isFormValid = true;
    

            formInputs.forEach(element => {
                if(element.dataset.validate != undefined){
                    let inputValidate = element.dataset.validate;
    
                    if(inputValidate == 'false'){
                        isFormValid = false;
                    }
    
                }
            });

            if(isFormValid){
                let formData = new FormData(form);
                let requestURL = form.action;

                if(form.action == `http://${window.location.host}/admin/education/task/create` || form.action.includes("/admin/education/task/update/")){
                    formData.append('theory', CKEDITOR.instances['theory'].getData());
                    formData.append('task', CKEDITOR.instances['task'].getData());
                }

                let xhr = getXHR("POST", requestURL);
                xhr.send(formData);

                xhr.onload = ()=>{
                    window.systemMessages.push(JSON.parse(xhr.response));
                }

            }else{
                window.systemMessages.push({
                    'title':"Помилка",
                    'msg':'Для продовження заповніть всі поля форми коректними даними.',
                    'type':"error"
                });
            }
        },

        showDeleteConfirmMessage: function(data){
            let index =  window.systemMessages.length;
            let token = getToken();

            this.itemToDelete.url = data.url;
            this.itemToDelete.id = data.id;
            this.itemToDelete.callback = data.callback;

            let accept = {
                "title": data.title,
                "msg":`
                    <p class='white'>${data.msg}<br><form class='remove-group-${data.id}'><input type="hidden" name="_method" value='DELETE'><input type="hidden" name="_token" value='${token}'></form><a href='#' class='p-like white system-message-accept' data-index="${index}">Так</a></p>
                `,
                "type":"informative",
                "callback":this.deleteItem
            };

            window.systemMessages.push(accept);
        },
        
        deleteItem: function(){
            let xhr = getXHR("POST", `${this.itemToDelete.url}`);
            xhr.send(new FormData(document.querySelector(`.remove-group-${this.itemToDelete.id}`)));
            xhr.onload = ()=>{
                window.systemMessages.push(JSON.parse(decodeURI(xhr.response)));
                this.itemToDelete.callback();
            }
        }
    },
    mounted(){
        if(document.querySelector('.unactive') !== null){
            let unactiveUsers = document.querySelector('.unactive').innerHTML;
            let activeUsers = document.querySelector('.active').innerHTML;
            this.adminChartWidth = (unactiveUsers/activeUsers * 100).toString()+"%";
            console.log(this.adminChartWidth);
        }
    }
})
