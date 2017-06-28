<?php
    // Show all except E_NOTICE.
    error_reporting(E_ALL & ~E_NOTICE);

    // Session handling.
    session_start();
    $_SESSION["logged"] = False;
    
    // Execute only when there's a POST request.
    if ( $_SERVER["REQUEST_METHOD"] === "POST") {
        
        // Configure mysql database.
        $server = "localhost";
        $username = "root";
        $password = "";
        $database = "challenge01";

        $conn = new mysqli($server, $username, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Login
        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql = "select 1 from User where username = '$username' and password = '$password'";
        
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $_SESSION["logged"] = True;
            header("Location: index.php");
        } else {
            echo "Error: Keep trying...";
        }

        // Close connection
        $conn->close();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Challenge 01 - Login</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div class="flex-container">
            <div class="section form-section">
                <div class="section-header login-header">
                    Challenge 01
                </div>
                <form class="form-control" action="login.php" method="post">
                    <div class="input-control">
                        <label for="username">Username</label>
                        <input type="text" name="username" required />
                    </div>
                    
                    <div class="input-control">
                        <label for="password">Password 
                            <a id="hint" href="#" onclick="window.open('hint.html', 'popup', 'width=300,height=300')">(Hint)</a>
                        </label>
                        <input type="password" name="password" required />
                    </div>

                    <div class="input-control">
                        <button>Login</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>