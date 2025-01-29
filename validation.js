document.addEventListener('DOMContentLoaded', ()=>{
    const form = document.getElementById('signupForm');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
       if (validateForm()){
        alert("Form submitted successfully!");
    
       }
    });
    function validateForm() {
        var username= document.getElementById('username').value;
        var email=document.getElementById('email').value;
        var password=document.getElementById('password').value;
        var confirmPassword=document.getElementById('confirmPassword').value;
        const emailRegex=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if(!emailRegex.test(email)){
            alert("Invalid email address!");
            return false;
    
        }
        const passwordRedex=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        if(!passwordRedex.test(password)){
            alert("Password must be at least 8 characters long, and include uppercase, lowercase, a number, and a special character.");
            return false;
        }
        if(password !== confirmPassword){
            alert("Passwords do not match.");
            return false;
        }
        return true;
    }
    });
    
   
   