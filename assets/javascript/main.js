document.getElementById("add-item-button").addEventListener('click',function(){
    document.getElementById("todo-form").classList.remove("d-none")
})

document.getElementById("hide-item-button").addEventListener('click',function(){
    console.log("Button Clicked");
    document.getElementById("todo-form").classList.add("d-none")
})