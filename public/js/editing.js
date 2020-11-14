let htmlEditor = CodeMirror(document.getElementById("html-editor"),{
    value: "<h1>HTML-редактор готовий!</h1>",
    mode:  "htmlmixed",
    lineNumbers:true
});

let cssEditor = CodeMirror(document.getElementById("css-editor"),{
    value: "{{CSS-редактор готовий!}}",
    mode:  "css",
    lineNumbers:true
});

let jsEditor = CodeMirror(document.getElementById("js-editor"),{
    value: "JS.редактор готовий!;",
    mode:  "javascript",
    lineNumbers:true
});

htmlEditor.setSize("100%", "100%");
cssEditor.setSize("100%", "100%");
jsEditor.setSize("100%", "100%");

let resultBlock = document.querySelector(".code-result");
let styleTag = document.getElementsByTagName('style')[0];
let scriptTag = null;
window.onload=()=>{
    scriptTag = document.getElementById("user-script");
}

let scriptStarter = document.querySelector(".eval-script");

let editorTriggers = document.querySelectorAll(".editors");
for(let i = 0; i < editorTriggers.length; i++){
    editorTriggers[i].addEventListener('click', handleEditorTriggers);
}

console.log(scriptTag);

function handleEditorTriggers(e){
    let targetEditor = e.target.value;
    let query = `.${targetEditor}-editor-container`;
    let editor = document.querySelector(query);

    if(e.target.checked){
        editor.classList.remove("editor-disabled");
    }else{
        editor.classList.add("editor-disabled");
    }
}

scriptStarter.onclick = ()=>{
    eval(scriptTag.innerHTML);
}

window.onkeydown = ()=>{
    if(htmlEditor.hasFocus){
        checkHTML();
        setTimeout(checkHTML,200);
    }

    if(cssEditor.hasFocus){
        checkCSS();
        setTimeout(checkCSS,200);
    }

    if(jsEditor.hasFocus){
        checkJS();
        setTimeout(checkJS,200);
    }
}

function checkHTML(){
    let code = htmlEditor.getValue();
    resultBlock.innerHTML = code;
}

function checkCSS(){
    let styles = cssEditor.getValue();
    stylesSplitted = styles.split("}");
    let styling = "";

    for(let i = 0; i < stylesSplitted.length; i++){
        if(i != 0){
            styling += `}`;
        }
        if(i != stylesSplitted.length-1){
            styling += `.code-result ${stylesSplitted[i]}`;
        }
    }
    
    styleTag.innerHTML = styling;
}

function checkJS(){
    let scripts = jsEditor.getValue();
    scriptTag.innerHTML = scripts;
}
