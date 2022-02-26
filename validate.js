function LogInForm(event){
    event.preventDefault();


    var valid = true;
    // var errormessage = "";
    // var user_inputs = "";


    var elements = event.currentTarget;
    var email = elements[0].value; 
    var password = elements[1].value;

    var regex_email = /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    var regex_uname = /^[a-zA-Z0-9_-]+$/;
    var regex_pswd  = /^(\S*)?\d+(\S*)?$/;

    var email_msg = document.getElementById("email_msg");
    var pswd_msg = document.getElementById("pswd_msg");
    email_msg.innerHTML  = "";
    pswd_msg.innerHTML = "";

    //Variables for DOM Manipulation commands
    var textNode;
    var htmlNode;

    // Validate Username
    if(email == null || email == ""){
        textNode = document.createTextNode("Email address is empty.");
        email_msg.appendChild(textNode);
        valid = false;
    }
    else if(regex_email.test(email) == false){
        textNode = document.createTextNode("Follow email format: someone@gmail.com");
        email_msg.appendChild(textNode);
        valid = false;
    }

    if(password ==null || password ==""){
        textNode = document.createTextNode("Password is empty.");
        pswd_msg.appendChild(textNode);
        valid = false;
    }
    else if(password.length <= 6){
        textNode = document.createTextNode("Password has to be 6 characters or more. \n");
        pswd_msg.appendChild(textNode);
        valid = false;
    }

    else{
        alert("Login successful!");
        event.preventDefault(); //remove for final submission
    }
    // Add code for if validation is true.
}

function SignUpForm(event){
    event.preventDefault();

   
    var regex_email = /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    var regex_uname = /^[a-zA-Z0-9_-]+$/;
    var regex_pswd  = /^(\S*)?\d+(\S*)?$/;

    

    // The two passwords do not match. Please retype the passwords.

    // else{
    //     alert("Signup successful!");
    //     event.preventDefault(); //remove for final submission
    // }
}


// Dynamic counter for Create Note Page
function countChars(obj) {
    var maxLength = 256;
    var strLength = obj.value.length;

    if(strLength > maxLength){
        document.getElementById("charNum").innerHTML = '<span style="color: red;">'+strLength+' / '+maxLength+' characters</span>';
    }else{
        document.getElementById("charNum").innerHTML = strLength+' / '+maxLength+' characters';
    }
}

// Dynamic counter for View / contribute Note Page
function countNumOfChars(obj) {
    var maxLength = 1500;
    var strLength = obj.value.length;

    if(strLength > maxLength){
        document.getElementById("numofchars").innerHTML = '<span style="color: red;">'+strLength+' / '+maxLength+' characters</span>';
    }else{
        document.getElementById("numofchars").innerHTML = strLength+' / '+maxLength+' characters';
    }
}
// Required text field for Create Note Page
function validateForm(event) {
    if (event.value == "" || event.value == null) {
        alert("Please enter some text into the feedback field");
           return false;
    }
    else
        return true;
    }


