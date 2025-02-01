<?php
class PasswordReset {
    private $conn;

    public function __construct($db) {
        $this->conn = $db->getConnection();
    }

    public function checkEmailExists($email) {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0; 
    }

    public function sendResetCode($email) {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $code = rand(100000, 999999);
            $_SESSION['reset_code'] = $code;
            $_SESSION['reset_email'] = $email;
    
            // Debugging Output
            echo "Reset code: $code <br>";
            echo "Sending email to: $email <br>";
    
            if (mail($email, "Password Reset Code", "Your reset code is: $code")) {
                echo "Mail sent successfully!<br>";
                return true;
            } else {
                echo "Failed to send email.<br>";
                return false;
            }
        }
        return false;
    }

    public function verifyCode($email, $user_code) {
        $stmt = $this->conn->prepare("SELECT * FROM password_resets WHERE email = ? AND reset_code = ? AND expires_at > NOW()");
        $stmt->execute([$email, $user_code]);
        $code_data = $stmt->fetch();

        if (!$code_data) {
            return "Invalid or expired code.";
        }

        $stmt = $this->conn->prepare("DELETE FROM password_resets WHERE email = ?");
        $stmt->execute([$email]);

        return "valid";
    }
    public function resetPassword($email, $new_password) {
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        $stmt = $this->conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        if (!$stmt->execute([$hashed_password, $email])) {
            return "Error updating password.";
        }

        return "Password updated successfully.";
    }
}
?>
