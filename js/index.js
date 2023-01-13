let tarefaedit = document.getElementById("tarefaedit")
window.addEventListener("click", function(e){
    if(e.target.parentNode.classList.contains("edit")){    
        tarefaedit.setAttribute("class","active")
    }
    if(e.target.classList.contains('active')){
        tarefaedit.setAttribute("class","disabledTarefa")
    }
})
