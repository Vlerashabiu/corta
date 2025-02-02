<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    header("Location: login.php");
    exit();
}

include 'db.php';

class User {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }

    public function addUser($username, $password, $role) {
        if (empty($username) || empty($password) || !in_array($role, ['admin', 'user'])) {
            return "Invalid input!";
        }
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashed_password, $role);
        
        if ($stmt->execute()) {
            return "User added successfully!";
        } else {
            return "Error: " . $this->db->error;
        }
    }

    public function deleteUser($id) {
        if (!is_numeric($id)) {
            return "Invalid user ID!";
        }
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            return "User deleted successfully!";
        } else {
            return "Error: " . $this->db->error;
        }
    }

    public function updateUserRole($id, $role) {
        if (!is_numeric($id) || !in_array($role, ['admin', 'user'])) {
            return "Invalid input!";
        }
        $stmt = $this->db->prepare("UPDATE users SET role = ? WHERE id = ?");
        $stmt->bind_param("si", $role, $id);
        
        if ($stmt->execute()) {
            return "User role updated successfully!";
        } else {
            return "Error: " . $this->db->error;
        }
    }

    public function getUsers() {
        $result = $this->db->query("SELECT id, username, role FROM users");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

$db = new Database();
$user = new User($db->getConnection());

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])){
   $action=$_POST['action'];
   
   if ($action === 'add') {
    $message = $user->addUser(trim($_POST['username']), trim($_POST['password']), $_POST['role']);
} elseif ($action === 'delete') {
    $message = $user->deleteUser($_POST['id']);
} elseif ($action === 'update') {
    $message = $user->updateUserRole($_POST['id'], $_POST['role']);
}
echo $message;
exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="user.css">
</head>
<body>
    <h2>Manage Users</h2>
    <h4>Add User</h4>
    <form method="POST">
        <input type="hidden" name="action" value="add">
        <label>Username:</label>
        <input type="text" name="username" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <label>Role:</label>
        <select name="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <button type="submit">Add User</button>
    </form>

    <h4>User List</h4>
    <table border="1">
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        </thead>
       <tbody>
         <?php
         
        $result = $conn-> query("SELECT id, username, role From users");
        while ($row = $result->fetch_assoc()){
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['username']) . "</td>";
            echo "<td>" . htmlspecialchars($row['role']) . "</td>";
            echo "<td>
                    <form method='POST' style='display:inline-block;'>
                        <input type='hidden' name='action' value='update'>
                        <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
                        <select name='role'>
                            <option value='user'" . ($row['role'] == 'user' ? ' selected' : '') . ">User</option>
                            <option value='admin'" . ($row['role'] == 'admin' ? ' selected' : '') . ">Admin</option>
                        </select>
                        <button type='submit'>Update</button>
                  </form>
                  <form method='POST' style='display:inline-block;'>
                        <input type='hidden' name='action' value='delete'>
                        <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
                        <button type='submit' onclick='return confirm(\"Are you sure?\");'>Delete</button>
                    </form>
                  </tr>";
                  echo "</tr>";
        }

        ?>
       </tbody>
    </table>
    
</body>
</html>