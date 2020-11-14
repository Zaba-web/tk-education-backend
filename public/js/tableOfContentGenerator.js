document.addEventListener("DOMContentLoaded", function(){
    let headersClasses = {
        "H1": "redFrame",
        "H2": "redFrame",
        "H3": "darkFrame",
        "H4": "lightFrame",
        "H5": "lightFrame",
        "H6": "lightFrame"
    }
    
    let headers = document.querySelectorAll(".content h1, .content h2, .content h3, .content h4, .content h4");
    
    let tableOfContentsContainer = document.querySelector('.table-of-contents');

    headers.forEach((el, index)=>{
        let neeededClass = headersClasses[el.tagName];
        el.id = `header-${index}`;
        
        let tableOfContentsItem = document.createElement("li");
        tableOfContentsItem.innerHTML = `<a href='#header-${index}'>${el.textContent} </a>`;
        tableOfContentsItem.classList.add(neeededClass);
        
        tableOfContentsContainer.appendChild(tableOfContentsItem);
    });
});