document.addEventListener("DOMContentLoaded", function(){

    CKEDITOR.stylesSet.add('my_custom_style', [
        { 
            name: 'Універсальний контейнер', 
            element: 'div', 
            attributes: { 'class': 'user-con' },
            styles: { 'background-color': '#f8f8f8', "padding":"10px", "border":"1px solid #EBEDEE"} 
        },
        { 
            name: 'Невидимий контейнер', 
            element: 'div', 
            attributes: { 'class': 'user-con-trans' }
        },
        { 
            name: 'Код', 
            element: 'code',
            styles: { 'background-color': '#f8f8f8', "padding":"10px", "line-height":"10px"} 
        },
        { 
            name: 'Блок "Зверніть увагу"', 
            element: 'div', 
            attributes: { 'class': 'user-important-notice'},
            styles: { 'background-color': '#f8f8f8', "padding":"10px 10px 10px 25px", "border-left":"3px solid #B10640"} 
        },
        { 
            name: 'Виділений блок', 
            element: 'div', 
            attributes: { 'class': 'user-selected-box'},
            styles: { 'border': '2px dashed #EBEDEE', "padding":"10px"} 
        },
        { 
            name: 'Виділений текст', 
            element: 'strong', 
            attributes: {'class': 'user-text-selected'},
            styles: { 'background': '#EBEDEE', "padding":"2px 8px", "font-weight":"100", "border-radius":"100px"} 
        }
    ]);

    var theoryEditor = CKEDITOR.replace("theory", {
        stylesSet: "my_custom_style",
        filebrowserUploadUrl:`http://${window.location.host}/upload-image`,
        filebrowserUploadMethod : "form"
    });

    var taskEditor = CKEDITOR.replace("task", {
        stylesSet: "my_custom_style",
        filebrowserUploadUrl:`http://${window.location.host}/upload-image`,
        filebrowserUploadMethod : "form"
    });

})