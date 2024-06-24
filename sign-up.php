
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection details
    $servername = "localhost";
    $username = "root";  // Change if necessary
    $password = "";      // Change if necessary
    $dbname = "mybook";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password0 = $_POST['password0'];
    $password2 = $_POST['password2'];

    // Check if passwords match
    if ($password0 != $password2) {
        echo "Passwords do not match!";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password0, PASSWORD_BCRYPT);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, gender, email, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $first_name, $last_name, $gender, $email, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign-Up Page</title>
</head>
<body>
  <style>
    #bar{
      height:80px;
       background-color:rgb(59,89,152);
       color:azure; 
    }
   #sign-btn{
    background-color :#42b72a;
    width: 70px;
    text-align: center;
    padding:4px;
    border-radius: 4px;
    float:right;
    cursor: pointer;

   }
   #signUp-bar1{
    background-color: azure; 
    width:600px;
    height:500px;
    margin:auto;
    margin-top:20px;
    padding: 10px;
    padding-top: 45px;
    text-align: center;
    transition: background-color 0.3s ease;
    font-weight: bold;
   }
  
   
   #text{
     height: 35px;
     width: 300px;
     border-radius: 4px;
     border: solid 1px #ccc;

   }
   #signUp-btn{
    text-align: center;
    width: 300px;
    height: 35px;
    border-radius: 5px;
    border-style: solid;
    background-color: blue;
    cursor:pointer;
    transition: opacity 1s;
    font-weight: bold;
    
   }
   #signUp-btn:hover{
    opacity :0.4;
   }
   #signUp-btn:active{
    opacity: 0.2;
   }
  </style>
  
</head>

<body style="font-family:tahoma; background-color:#e9ebee;">
  <div id="bar">
      <div style="  font-size :40px;">MyBook</div>
      <div id="sign-btn"><a href="login.php">Log in</a></div>
  </div>

 <div id="signUp-bar1" >
   Sign-Up to MyBook
    <br><br>
    <form method="post" action=" ">
      
         <input name="first_name"  type="text" id="text" 
           placeholder="First Name">
         <br><br>
         <input name="last_name" type="text" id="text" 
           placeholder="Last Name">
         <br><br>
         <span style="font-weight: normal;">Gender: </span> 
           <br><br>
         <select id="text" name="gender" >
         <!-- #region -->

         <option>Male</option>
         <option>Female</option>

         </select>
         <br><br>     
         <input name="email" type="text" id="text" 
          placeholder="Email">
         <br><br>
         <input name="password0" type="password" id="text" 
          placeholder="Password">
         <br><br>
         <input name="password2" type="password" id="text"   
          placeholder="Confirm  Password">
         <br><br>
         <input type="submit" id="signUp-btn" value="Sign-Up">
         
      </div>

    </form>
  
</body>
</html>