document.addEventListener('DOMContentLoaded', function(){
const forgotPasswordForm = document.getElementById('forgotpasswordForm');

if (forgotPasswordForm) {
    forgotPasswordForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const email = document.getElementById('email').value;

        if (validateEmail(email)) {
            const confirmationCode = Math.floor(100000 + Math.random() * 900000);
            localStorage.setItem('confirmationCode', confirmationCode);
            localStorage.setItem('email', email);
            
            console.log("Generated Confirmation Code:", confirmationCode);
            console.log("Stored Email:", email);

            alert(`A confirmation code has been sent to ${email}`);
            window.location.href = "confirmationCode.html";
        } else {
            alert("Please enter a valid email address");
        }
    });
   }
   
   document.addEventListener('DOMContentLoaded', function () {
    const confirmationForm = document.getElementById('confirmationForm');
    const codeInputs = document.querySelectorAll('.code-input');

    codeInputs.forEach((input, index) => {
        input.addEventListener('input', (e) => {
            if (e.target.value.length === 1 && index < codeInputs.length - 1) {
                codeInputs[index + 1].focus();
            }
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && e.target.value === '' && index > 0) {
                codeInputs[index - 1].focus();
            }
        });
    });

    if (confirmationForm) {
        confirmationForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const enterCode = Array.from(codeInputs)
                .map(input => input.value)
                .join('');

            const storedCode = localStorage.getItem('confirmationCode');

            console.log("Entered Code: ", enterCode);
            console.log("Stored Code: ", storedCode);

            if (!storedCode) {
                alert("No confirmation code found. Please request a new code.");
                return;
            }

            if (enterCode.trim() === storedCode.trim()) {
                alert("Code verified successfully");
                window.location.href = "resetPassword.html";
            } else {
                alert("Invalid confirmation code.");
            }
        });
    }
});
    const resetPassword=document.getElementById('resetPassword');
    if(resetPassword){
       resetPassword.addEventListener('submit', function (e){
       e.preventDefault();
       const newPassword=document.getElementById('newPassword').value;
       const confirmPassword=document.getElementById('confirmPassword').value;

       if(newPassword === confirmPassword){
        localStorage.setItem('newPassword', newPassword);
        alert("Your password has been successully changed");
        window.location.href= "login.html";
       }else{
        alert("Passwords do not match. Please try again.")
       }
        
     });
    }
function validateEmail(email) {
    const emailRegex=/^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
 }
});
    
