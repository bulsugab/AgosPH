<?php
require('config.php');
?>
<html>
<body>
<script>
   let sidebar = document.querySelector(".sidebar");
   let sidebarBtn = document.querySelector(".sidebarBtn");
   sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}

function registerForm(){
    document.getElementById("blurer").style.visibility="visible";
    document.getElementById("form-container").style.visibility="visible";
}

function viewForm(){
    document.getElementById("blurer").style.visibility="visible";
    document.getElementById("form-container1").style.visibility="visible";
}
function eventForm(){
    document.getElementById("blurer").style.visibility="visible";
    document.getElementById("form-container3").style.visibility="visible";
}

 function viewEdit(){
    document.getElementById("blurer").style.visibility="visible";
    document.getElementById("form-container1").style.visibility="visible";

}

function closeRegister(){
    document.getElementById("blurer").style.visibility="hidden";
    document.getElementById("form-container").style.visibility="hidden";
}

function closeEdit(){
  document.getElementById("blurer").style.visibility="hidden";
  document.getElementById("form-container1").style.visibility="hidden";
} 

function closeEvent(){
    document.getElementById("blurer").style.visibility="hidden";
    document.getElementById("form-container3").style.visibility="hidden";
}
</script>
</body>
</html>
