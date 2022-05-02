// Event registers
var email = document.getElementById("email");
var password = document.getElementById("password");

document.getElementById("email").addEventListener("blur", checkEmail);
document.getElementById("password").addEventListener("blur", checkPassword);
// document.getElementById("LogIn").addEventListener("submit", LogInForm, false);