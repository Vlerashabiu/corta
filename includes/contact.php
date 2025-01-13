<?php
include 'layout.php'; 

renderHeader("Contact Us - Corta");
?>

<h1>Contact Us</h1>
<p>If you have any questions, feel free to reach out!</p>

<form id="contact-form">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="message">Message:</label>
    <textarea id="message" name="message" required></textarea>
    
    <button type="submit">Submit</button>
</form>

<?php
renderFooter();
?>
