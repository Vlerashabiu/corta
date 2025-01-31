<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    header("Location: login.php");
    exit();
}

include 'db.php';

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])){
   $action=$_POST['action'];
   
   if($action === 'add'){
    $username=trim($_POST['username']);
    $password=trim($_POST['password']);
    $role=$_POST['role'];

    if(empty($username) || empty($password) || !in_array($role, ['admin', 'user'])){
        echo "Invalid input!";
        exit();
    }
    $hashed_password =password_hash($password, PASSWORD_BCRYPT);

    $stmt= $conn -> prepare("INSERT INTO users (username, password, role) VALUES (?,?,?)");
    $stmt-> bind_param("sss", $username, $hashed_password, $role);

    if($stmt->execute()){
        echo "User added successfully!";
    }else{
        echo "Error: " . $conn->error;
    }

    $stmt-> close();

   }elseif ($action === 'delete'){
    $id=$_POST['id'];

    if(!is_numeric($id)){
        echo "Invalid user ID!";
        exit();
    }
    $stmt =$conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    if($stmt->execute()){
        echo "User deleted successfully!";
    }else{
        echo "Error: " . $conn->error;
    }
    $stmt->close();
   }elseif($action === 'update'){
    $id=$_POST['id'];
    $role =$_POST['role'];

    if(!is_numeric($id) || !in_array($role,['admin', 'user'])){
        echo "Invalid input!";
        exit();
    }
    $stmt=$conn->prepare("UPDATE users SET role = ? WHERE id =?");
    $stmt->bind_param("si", $role, $id);

    if($stmt->execute()){
        echo "User role updated successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
    $stmt->close();
   }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="manage_users.css">
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