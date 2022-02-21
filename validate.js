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
        alert("Signup successful!");
        event.preventDefault(); //remove for final submission
    }
    // Add code for if validation is true.
}

function SignUpForm(event){
    event.preventDefault();


    var valid = true;
    // var errormessage = "";
    // var user_inputs = "";


    var elements = event.currentTarget;
    var email = elements[0].value; 
    var username = elements[1].value; 
    var password = elements[2].value;
    var passwordrepeat = elements[3].value;


    var regex_email = /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    var regex_uname = /^[a-zA-Z0-9_-]+$/;
    var regex_pswd  = /^(\S*)?\d+(\S*)?$/;

    var email_msg = document.getElementById("signup_email_msg");
    var uname_msg = document.getElementById("signup_uname_msg");
    var pswd_msg = document.getElementById("signup_pswd_msg");
    var pswdr_msg = document.getElementById("signup_pswdr_msg");

    email_msg.innerHTML  = "";
    uname_msg.innerHTML = "";
    pswd_msg.innerHTML = "";
    pswdr_msg.innerHTML = "";

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
        alert("Signup successful!");
        event.preventDefault(); //remove for final submission
    }
    // Add code for if validation is true.
}





