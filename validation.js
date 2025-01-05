
form.addEventListener("submit", (e) => {
    e.preventDefault();
function validateForm(){
    var username= document.getElementById("username").value;
    var email=document.getElementById("email").value;
    var password=document.getElementById("password").value;
    var password=document.getElementById("conirmPassword").value;
    


    if(username=="" || email=="" || password==""){
        alert("All fields are required");
        return false;
    }
    if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){
        alert("Invalid email address!");
        return false;

    }
    const passwordRedex=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    if(!passwordRedex(password)){
        alert("Password must be at least 8 characters long, and include uppercase, lowercase, a number, and a special character.");
        return false;
    }
    return true;
}
});
