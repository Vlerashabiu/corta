document.addEventListener('DOMContentLoaded', function(){
    const forgotPasswordForm = document.getElementById('forgotpasswordForm');
    
    if (forgotPasswordForm) {
        forgotPasswordForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const email = document.getElementById('email').value;
    
            if (validateEmail(email)) {
               alert(`A confirmation code has been sent to ${email}`); 
                window.location.href = "confirmationCode.html";
            } else {
                alert("Please enter a valid email address");
            }
        });
       }
       
       document.addEventListener('DOMContentLoaded', function () {
        const codeInputs = document.querySelectorAll('.code-input');
        const confirmationForm = document.querySelector('form');
    
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
    
        confirmationForm.addEventListener('submit', function (e) {
            e.preventDefault();
    
            const enterCode = Array.from(codeInputs)
                .map(input => input.value)
                .join('');
    
                const sessionCode = '<?php echo $_SESSION ["reset_code"] ?>';
    
                if(enterCode === sessionCode){
                    alert("Code vverified successfully");
                    window.location.href ="resetPassword.html";
                }else{
                    alert("Invalid confirmation code.");
                }
            });
        });
    
        document.getElementById("resetPassword").addEventListener("submit", function(e){
            const newPassword =document.getElementById('newPassword').value;
            const confirmPassword =document.getElementById('confirmPassword').value;
    
            if(newPassword !== confirmPassword){
                alert("Passwords do not match.");
                e.preventDefault();
            }
        });
    
        function validateEmail(email) {
        const emailRegex=/^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
        }
    });