// LOG IN FORM VALIDATION **************************************************
function checkEmail(event) {

  // var valid = true;

  var field = event.currentTarget;
  var email = field.value;

  var regex_email = /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

  var email_msg = document.getElementById("email_msg");
  email_msg.innerHTML = "";

  //Variables for DOM Manipulation commands
  var textNode;
  var htmlNode;

  // Validate Email
  if (email == null || email == "") {
    textNode = document.createTextNode("Email address is empty.");
    email_msg.appendChild(textNode);
    // valid = false;
    return false;
  }
  else if (regex_email.test(email) == false) {
    textNode = document.createTextNode(
      "Follow email format: someone@gmail.com"
    );
    email_msg.appendChild(textNode);
    // valid = false;
    return false;
  }
  return true;
  event.preventDefault();
}

function checkPassword(event) {

  // var valid = true;

  var field = event.currentTarget;
  var password = field.value;

  var regex_pswd = /^\S*$/; //No spaces 

  var pswd_msg = document.getElementById("pswd_msg");
  pswd_msg.innerHTML = "";

  //Variables for DOM Manipulation commands
  var textNode;
  var htmlNode;

  if (password == null || password == "") {
    textNode = document.createTextNode("Password is empty.");
    pswd_msg.appendChild(textNode);
    // valid = false;
    return false;
  }
  else if(regex_pswd.test(password) == false){
    textNode = document.createTextNode("Password cannot contain whitespace.");
    pswd_msg.appendChild(textNode);
    // valid = false;
    return false;
  }
   else if (password.length < 6) {
    textNode = document.createTextNode(
      "Password has to be 6 characters or longer. \n"
    );
    pswd_msg.appendChild(textNode);
    // valid = false;
    return false;
  }
  return true;
 event.preventDefault();
}

function LogInForm(event) {
  var valid = true;

  var elements = event.currentTarget;
  var email = elements[0].value;
  var password = elements[1].value;

  var regex_email =
    /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
  var regex_pswd = /^\S*$/; //No spaces

  var email_msg = document.getElementById("email_msg");
  var pswd_msg = document.getElementById("pswd_msg");
  email_msg.innerHTML = "";
  pswd_msg.innerHTML = "";

  //Variables for DOM Manipulation commands
  var textNode;
  var htmlNode;

  // Validate Email
  if (email == null || email == "") {
    textNode = document.createTextNode("Email address is empty.");
    email_msg.appendChild(textNode);
    valid = false;
  } else if (regex_email.test(email) == false) {
    textNode = document.createTextNode(
      "Follow email format: someone@gmail.com"
    );
    email_msg.appendChild(textNode);
    valid = false;
  }

  if (password == null || password == "") {
    textNode = document.createTextNode("Password is empty.");
    pswd_msg.appendChild(textNode);
    valid = false;
  }
  else if(regex_pswd.test(password) == false){
    textNode = document.createTextNode("Password cannot contain whitespace.");
    pswd_msg.appendChild(textNode);
    valid = false;
  }
   else if (password.length < 6) {
    textNode = document.createTextNode(
      "Password has to be 6 characters or longer. \n"
    );
    pswd_msg.appendChild(textNode);
    valid = false;
  }
  if(result == false){
    event.preventDefault();
  }
  else if(result == true){
     window.location.href = "index.html";
  }
}
/******************** SIGN UP VALIDATION ***************/
  function SignUpForm(event) {
    var valid = true;
  
    var elements = event.currentTarget;
    var file = elements[0].value;
    var email = elements[1].value;
    var username = elements[2].value;
    var pswd = elements[3].value;
    var pswdr = elements[4].value;
  
    var regex_email =
      /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    var regex_uname = /^[a-zA-Z0-9_-]+$/; //No spaces or non character.
    var regex_pswd = /^(\S*)?\d*(\S*)?[!@#$&()\\-`.+,\/\"]+$/; //Matches atleast one special character.
  
    var file_msg = document.getElementById("file_msg");
    var signup_email_msg = document.getElementById("signup_email_msg");
    var signup_uname_msg = document.getElementById("signup_uname_msg");
    var signup_pswd_msg = document.getElementById("signup_pswd_msg");
    var signup_pswdr_msg = document.getElementById("signup_pswdr_msg");
  
    file_msg.innerHTML = "";
    signup_email_msg.innerHTML = "";
    signup_uname_msg.innerHTML = "";
    signup_pswd_msg.innerHTML = "";
    signup_pswdr_msg.innerHTML = "";
  
    //Variables for DOM Manipulation commands
    var textNode;
    var htmlNode;
  
    if (file == "" || file == null) {
      event.preventDefault();
      textNode = document.createTextNode("No image selected.");
      file_msg.appendChild(textNode);
      valid = false;
    }
  
    if (email == null || email == "") {
      textNode = document.createTextNode("Email address is empty.");
      signup_email_msg.appendChild(textNode);
      valid = false;
    } else if (regex_email.test(email) == false) {
      textNode = document.createTextNode(
        "Follow email format: someone@gmail.com"
      );
      signup_email_msg.appendChild(textNode);
      valid = false;
    }
  
    if (username == null || username == "") {
      textNode = document.createTextNode("Username is empty.");
      signup_uname_msg.appendChild(textNode);
      valid = false;
    } else if (regex_uname.test(username) == false) {
      textNode = document.createTextNode(
        "Username can not include whitespaces or other non-word characters"
      );
      signup_uname_msg.appendChild(textNode);
      valid = false;
    }
  
    if (pswd == null || pswd == "") {
      textNode = document.createTextNode("Password is empty.");
      signup_pswd_msg.appendChild(textNode);
      valid = false;
    } else if (regex_pswd.test(pswd) == false) {
      textNode = document.createTextNode(
        "Password must contain atleast one non-letter character."
      );
      signup_pswd_msg.appendChild(textNode);
      valid = false;
    } else if (pswd.length != 6) {
      textNode = document.createTextNode(
        "Password must be exactly 6 characters."
      );
      signup_pswd_msg.appendChild(textNode);
      valid = false;
    }
  
    if (pswdr != pswd) {
      textNode = document.createTextNode("Passwords must match.");
      signup_pswdr_msg.appendChild(textNode);
      valid = false;
    }

    if(valid == true){
      // form reset event to clear the form.
      document.getElementById("SignUp").reset();
    }
    else {
       event.preventDefault();
    }
  }
  
  // Dynamic counter for Create Note Page
  function countChars() {
    var maxLength = 256;
  
    var strLength = document.getElementById("noteTopic").value.length;
  
    if (strLength > maxLength) {
      document.getElementById("charNum").innerHTML =
        '<span style="color: red;">' +
        strLength +
        " / " +
        maxLength +
        " characters</span>";
    } else {
      document.getElementById("charNum").innerHTML =
        strLength + " / " + maxLength + " characters";
    }
  }
  
  // Dynamic counter for View / contribute Note Page
  function countNumOfChars() {
    var maxLength = 1500;
    var strLength = document.getElementById("noteContribution").value.length;
  
    if (strLength > maxLength) {
      document.getElementById("numofchars").innerHTML =
        '<span style="color: red;">' +
        strLength +
        " / " +
        maxLength +
        " characters</span>";
    } else {
      document.getElementById("numofchars").innerHTML =
        strLength + " / " + maxLength + " characters";
    }
  }
  
  // Required text field for Create Note Page
  function CreateNoteForm(event) {
    var noteTopic = document.getElementById("noteTopic");
  
    var noInput = document.getElementById("noInput");
    noInput.innerHTML = "";
  
    //Variables for DOM Manipulation commands
    var textNode;
  
    if (noteTopic.value == "" || noteTopic.value == null) {
      event.preventDefault();
  
      textNode = document.createTextNode("Please enter Note Title.");
      noInput.appendChild(textNode);
      return false;
    } else return true;
  }
  
  // Required text field for View / Contribute Note Page
  function AddNoteForm(event) {
    var noteContribution = document.getElementById("noteContribution");
  
    var noInput = document.getElementById("noInput");
    noInput.innerHTML = "";
  
    //Variables for DOM Manipulation commands
    var textNode;
  
    if (noteContribution.value == "" || noteContribution.value == null) {
      event.preventDefault();
  
      textNode = document.createTextNode("Add a note.");
      noInput.appendChild(textNode);
      return false;
    } else return true;
  }
