document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('form');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        if (validateForm()) {
            alert("Form submitted successfully!");
        }
    });

    function validateForm() {
        var email = document.getElementById('email').value;
        const emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        
        if (!emailRegex.test(email)) {
            alert("Invalid email address!");
            return false;
        }
        
        return true;
    }
});
    