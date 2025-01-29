document.addEventListener('DOMContentLoaded', ()=>{
    const form = document.getElementById('form');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
       if (validateForm()){
        alert("Form submitted successfully!");
    
       }
    });
    function validateForm() {
        
        var email=document.getElementById('email').value;
        var password=document.getElementById('password').value;
        
        const emailRegex=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if(!emailRegex.test(email)){
            alert("Invalid email address!");
            return false;
    
        }
        const passwordRedex=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        if(!passwordRegex.test(password)){
            alert("Password must be at least 8 characters long, and include uppercase, lowercase, a number, and a special character.");
            return false;
        }
        
        return true;
    }
    });