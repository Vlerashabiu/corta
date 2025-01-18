document.addEventListener('DOMContentLoaded', ()=>{
    const form = document.getElementById('signupForm');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
       if (validateForm()){
        alert("Form submitted successfully!");
    
       }
    });
    function validateForm() {
        var email=document.getElementById('email').value;

        if(!emailRegex.test(email)){
            alert("Invalid email address!");
            return false;
    
        }
        return true;
    }
});