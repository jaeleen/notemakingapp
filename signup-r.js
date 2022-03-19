// 
var email = document.getElementById("email");
var username = document.getElementById("username");
var pswd = document.getElementById("pswd");
var file_upload = document.getElementById("file_upload");


document.getElementById("email").addEventListener("blur", checkEmail);
document.getElementById("username").addEventListener("blur", checkUsername);
document.getElementById("pswd").addEventListener("blur", checkSignUpPassword);
document.getElementById("SignUp").addEventListener("submit", SignUpNow);