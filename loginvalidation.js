document.getElementById('form').addEventListener('submit', function(event){
    event.preventDefault();
    var email=document.getElementById('email').value; 
    var password=document.getElementById('password').value;
   
    const emailRegex=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(!emailRegex.test(email)){
        alert('Invalid email address!');
        return false;
    }
    const passwordRegex=/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    if(!passwordRegex.test(password)){
        alert('Password must be at least 8 characters long, and include uppercase, lowercase, a number, and a special character.');
        return false;
    }
    return true;
});
