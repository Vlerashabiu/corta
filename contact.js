document.getElementById('form').addEventListener('submit', function(event) {
    event.preventDefault(); 

    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const message = document.getElementById('message').value;


    if (name === "" || email === "" || message === "") {
        alert("All fields are required!");
        return false;
    }

 
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailRegex.test(email)) {
        alert("Invalid email address!");
        return false;
    }

   
    if (message.length < 20) {
        alert("The message must be at least 20 characters long.");
        return false;
    }

    
    alert("Your message has been successfully sent!");
    this.submit(); 
});