document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('forgotpasswordForm');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const email =document.getElementById('email').value;
        if (validateEmail(email)) {
            const confirmationCode=Math.floor(100000 +Math.random()*900000);
            localStorage.setItem('confirmationCode', confirmationCode);
            localStorage.setItem('email',email);
            alert(`A cofirmation code has been sent to ${email}!`);
            window.location.href='confirmationCode.html';
        }else{
            alert('Please enter a valid email adress.')
        }
    });


    const confirmationForm=document.getElementById('confirmationForm');
    if(confirmationForm){
        confirmationForm.addEventListener('submit', function(e){
            e.preventDefault();

            const enterCode=document.getElementById('confirmationCode').value;
            const storedCode = localStorage.getItem('confirmationCode');

            if(enterCode == storedCode){
                alert("Code verified successully");
                window.location.href="resetPassword.html";
            }else{
                alert("Invalid confirmation code.")
            }
        });
    }
    const resetPassword=document.getElementById('resetPassword');
    if(resetPassword){
       resetPassword.addEventListener('submit', function (e){
       e.preventDefault();
       const newPassword=document.getElementById('newPassword').value;
       const confirmPassword=document.getElementById('confirmPassword').value;

       if(newPassword == confirmPassword){
        localStorage.setItem('newPassword', newPassword);
        alert("Your password has been successully changed");
        window.location.href= "login.html";
       }else{
        alert("Passwords do not match. Please try again.")
       }
       


        
     });
    }
});
function validateEmail(email) {
    const emailRegex=/^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
 }
    
