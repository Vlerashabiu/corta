<?php
session_start();
include 'db.php';

class PasswordReset{
    private $conn;

    public function __construct($db){
        $this->conn=$db->getConnection();
    }
    public function sendResetCode($email){
        $stmt=$this->db->prepare("SELECT * FROM users WHERE email =?");
        $stmt->execute([$email]);
        $user=$stmt->fetch();

        if($user){
           return false;
        }

        $reset_code=rand(100000,999999);
        $expires_at=date("Y-m-d H:i:s", strtotime("+5 minutes"));

        $stmt=$this->db->prepare("DELETE FROM password_resets WHERE email =?");
        $stmt->execute([$email]);

        $stmt=$this->db->prepare("INSERT INTO password_resets (email, reset_code, expires_at) VALUES (?,?,?");
        if(!stmt->execute([$email,$reset_code,$expires_at])){
            return false;
        }
        
    $subject= "Your Password Reset COde";
    $message= "Use this code to reset your password: ".$reset_code;
    $headers="From: noreply@corta.com";
    if(!mail($email,$subject,$message,$headers)){
        return false;
    }
    return true;
 }
    public function verifyCode($user_code,$email){
    $stmt = $this->db->prepare("SELECT * FROM password_resets WHERE email = ? AND reset_code = ? AND expires_at > NOW()");
    $stmt->execute([$email, $user_code]);
    $code_data = $stmt->fetch();

    if(!code_data){
        return "Invalid or expired code.";
    }
    $stmt = $this->db->prepare("DELETE FROM password_resets WHERE email = ?");
    $stmt->execute([$email]);

    return "valid";

    }

}
$db=new Database();
$passwordReset=new PasswordReset($db);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user_code=implode("",$_POST["code"]);
    $verificationResult=$passwordReset->verifyCode($user_code);

    if($verificationResult == "valid"){
        header("Location: resetpassword.php");
        exit();
    }else{
        $error=$verificationResult;
    }
}