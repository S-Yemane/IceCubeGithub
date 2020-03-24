<?php
require_once "config.php";

$message = $userID = "";
$school = "csuf";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty(trim($_POST["post"]))) {
        $message = trim($_POST["post"]);
    }

    //if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        $userID = 5;
    //} else {
        //header("location: login.php");
    //}

    if (!empty($message)) {
        $sql = "INSERT INTO posts (message, school, userID) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_message, $param_school, $param_userID);
            
            // Set parameters
            $param_message = $message;
            $param_school = $school;
            $param_userID = $userID;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Refresh current page
                header("Refresh:0");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
        mysqli_close($link);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="stylesheets/stylesheet.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Home Feed!</title>
</head>
<body>
    <div>
        <div id="page-wrapper">
            <header>
                <nav style="vertical-align:middle">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <img src="img/logo31.png" height="85" width="300" style="align-self:center;" />
                        </div>

                        <a id="btnSignOut" href="sign_out.html" class="btn btn-danger navbar-btn"
                            style="float: right; margin-top: 30px; margin-right: 30px;">Sign
                            Out</a>
                    </div>
                </nav>
            </header>
        </div>
        <hr>
        <div id="page_start" class="start">
            <div style="display: block;">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form data-my-form="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label for="studentForm">Post</label>
                                <input class="form-control" name="post" id="pp" required>
                            </div>
                            <input id="btnSignin" type="submit" class="btn btn-primary" value="Post"></input>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Bootstrap Badges -->
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Why am I in quarantine?
                    <span class="badge badge-primary badge-pill">14</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    I'm going nuts.
                    <span class="badge badge-primary badge-pill">2</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    This is a testing post. Hopefully we can get some data here or something.
                    <span class="badge badge-primary badge-pill">1</span>
                </li>
            </ul>
            <!-- Display posted data -->
        </div>
    </div>
</body>
</html>