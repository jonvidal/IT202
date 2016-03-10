
function validate(){

var xmlhttp;
if(window.XMLHttpRequest){
  xmlhttp = new XMLHttpRequest();
}else {
  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function(){
  if(xmlhttp.readyState==4 && xmlhttp.status==200){
    document.getElementById("message").innerHTML=xmlhttp.responseText;
  }
}
xmlhttp.open("POST","process.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
var username = document.getElementById("username").value;
var password = document.getElementById("password").value;
var request = document.getElementById("submit").value;
xmlhttp.send("username="+encodeURIComponent(username)+"password="+encodeURIComponent(password)+"submit="+encodeURIComponent(request));
}
