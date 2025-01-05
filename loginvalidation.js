document.getElementById('form'),
document.addEventListener('submit', function(event){
    event.preventDefault();
    const email=document.getElementById('email').value; 
    const emailRegex=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    const password=document.getElementById('password').value;
    const passwordRedex=/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    if(!emailRegex.test(email)){
        alert('Invalid email address!');
        return false;
    }
    if(!passwordRedex.test(password)){
        alert('Password must be at least 8 characters long, and include uppercase, lowercase, a number, and a special character.');
        return false;
    }
    return true;
});
