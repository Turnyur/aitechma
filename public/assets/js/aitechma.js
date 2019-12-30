
//Handle User Registration page
function registerUser() {


let username =document.getElementById("username").value;
let phone =document.getElementById("phone").value;
let email =document.getElementById("email").value;
let action =document.getElementById("action").value;
let _token =document.getElementById("_token").value;


if (username !="" ) {
	let xhttp = new XMLHttpRequest();
 // let data = `username=${username}&phone=${phone}&email=${email}&action=${action}&_token=${_token}`;
  let paraValue = JSON.stringify({
    "username": username,
    "phone": phone,
    "email": email,
    "action": action,
    "_token": _token,
   
})
  
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    	let content =document.getElementById("login-content");
    	let data = JSON.parse(this.responseText);
    	if (data.status=='error') {
    		 content.innerHTML = "<p style='color:red;'> Error Occurred!</p>";
    	}else{
    	  let pin = data.message.pin;
    content.classList.remove('hide');
     content.innerHTML = "<p>Congratulatiions. Your details has been successfully registered.</p>";
     content.innerHTML += "<p> Your 10-digit pin is <strong>"+data.message.pin+"</strong></p>";
     content.classList.add('show');
    }
    }
  };
  xhttp.open("POST", "/process-form?post_data="+paraValue, true);
  //xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhttp.setRequestHeader('Content-Type', 'application/json');
  xhttp.send();
}else{
	alert("Please enter Username");
	
}
  
}


//Handle Find User page section
function findUser(){


let pin =document.getElementById("pin").value;
let action =document.getElementById("action").value;
let _token =document.getElementById("_token").value;

if (pin !="" ) {
	let xhttp = new XMLHttpRequest();
 // let data = `pin=${pin}&action=${action}&_token=${_token}`;
  let paraValue = JSON.stringify({
    "pin": pin,
    "action": action,
    "_token": _token,
  
})
  
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    	let content =document.getElementById("login-content");
    	
    	let data = JSON.parse(this.responseText);
    	if (data.status=='error') {
    		 content.innerHTML = "<p style='color:red;'> Invalid PIN! Supplied!</p>";
    	}else{


    	  let pin = data.message.pin;
    	  let username = data.message.username;
    	  let id = data.message.id;
    	  let phone = data.message.phone;
    	  let email = data.message.email;
    	  let created_at = data.message.created_at;
    content.classList.remove('hide');
     content.innerHTML = "<div id='dashboard'>";
      content.innerHTML +="<div><p>Username: <strong>"+username+"</strong></p></div>";
     content.innerHTML += "<div><p>ID: <strong>"+id+"</strong></p></div>";
     content.innerHTML += "<div><p>Phone: <strong>"+phone+"</strong></p></div>";
     content.innerHTML += "<div><p>Email: <strong>"+email+"</strong></p></div>";
     content.innerHTML += "<div><p>Date Created: <strong>"+created_at+"</strong></p></div>";
      content.innerHTML +="</div>";
     
     
     content.classList.add('show');

     	}
    
    }
  };
  xhttp.open("POST", "/process-form?post_data="+paraValue, true);
  //xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhttp.setRequestHeader('Content-Type', 'application/json');
  xhttp.send();
}else{
	alert("Please enter Valid PIN");
	
}
  
}

let registration_page =  document.getElementById("register_user_btn");
let find_user_page =  document.getElementById("find_user_btn");

if (typeof(registration_page) != 'undefined' && registration_page != null)
{
  registration_page.addEventListener("click", function(e){
  	e.preventDefault()
  	registerUser();
});

}else if(typeof(find_user_page) != 'undefined' && find_user_page != null){

	find_user_page.addEventListener("click", function(e){
  		e.preventDefault()
  		findUser();
});
}


