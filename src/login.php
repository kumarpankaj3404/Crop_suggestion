<!-- CREATE TABLE signin (
    name VARCHAR(100),
    email VARCHAR(100) PRIMARY KEY,
    password VARCHAR(255)
); -->

<?php
session_start(); // Must be the FIRST line

// Database connection
$conn = new mysqli("localhost", "root", "", "crop");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
$showSuccess = false;

// Signup Logic
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($name) && !empty($email) && !empty($password)) {
        $checkSql = "SELECT * FROM signin WHERE email='$email'";
        $checkResult = $conn->query($checkSql);

        if ($checkResult->num_rows > 0) {
            $message = "Email already registered!";
        } else {
            $sql = "INSERT INTO signin (name, email, password) VALUES ('$name', '$email', '$password')";
            if ($conn->query($sql) === TRUE) {
                $_SESSION['user_name'] = $name;
                $_SESSION['user_email'] = $email;
                $_SESSION['logged_in'] = true;
                $showSuccess = true;
                header("Location: homePage.php");
                exit();
            } else {
                $message = "Error: " . $conn->error;
            }
        }
    } else {
        $message = "Please fill all fields!";
    }
}

// Login Logic
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        $sql = "SELECT * FROM signin WHERE email='$email' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['logged_in'] = true;
            header("Location: homePage.php");
            exit();
        } else {
            $message = "Invalid email or password.";
        }
    } else {
        $message = "Please fill all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Modern Login Page</title>
    <style type="text/tailwindcss">
        @layer components {
            .container.active .sign-in {
                transform: translateX(100%);
                z-index: 5;
            }
            .container.active .sign-up {
                transform: translateX(100%);
                opacity: 1;
                z-index: 10;
            }
            .container.active .toggle-container {
                transform: translateX(-100%);
                border-radius: 0 150px 100px 0;
            }
            .container.active .toggle {
                transform: translateX(50%);
            }
            .container.active .toggle-left {
                transform: translateX(0);
            }
            .container.active .toggle-right {
                transform: translateX(200%);
            }
            .form-container {
                transition: all 0.6s ease-in-out;
            }
            .toggle-container {
                transition: all 0.6s ease-in-out;
            }
            .toggle {
                transition: all 0.6s ease-in-out;
            }
            .toggle-panel {
                transition: all 0.6s ease-in-out;
            }
        }
    </style>
</head>
<body class="font-['Montserrat'] bg-[url(../photos/home/farm.jpg)] bg-cover bg-no-repeat bg-center backdrop-blur-sm">
    <div class="flex items-center justify-center flex-col h-screen w-full">
        <div class="container bg-white rounded-[30px] shadow-lg relative overflow-hidden w-full max-w-4xl min-h-[480px]" id="container">
            <div class="form-container sign-up absolute top-0 h-full w-1/2 left-0 opacity-0 z-0">
                <form class="bg-white flex items-center justify-center flex-col px-10 h-full" method="POST" action="">
                    <h1 class="text-2xl font-bold mb-4">Create Account</h1>
                    <span class="text-xs mb-5">or use your email for registration</span>
                    <input type="text" name="name" placeholder="Name" class="bg-gray-100 border-none my-2 py-2.5 px-4 text-sm rounded-lg w-full outline-none">
                    <input type="email" name="email" placeholder="Email" class="bg-gray-100 border-none my-2 py-2.5 px-4 text-sm rounded-lg w-full outline-none">
                    <input type="password" name="password" placeholder="Password" class="bg-gray-100 border-none my-2 py-2.5 px-4 text-sm rounded-lg w-full outline-none">
                    <button type="submit" name="signup" class="bg-indigo-800 text-white text-xs py-2.5 px-11 border border-transparent rounded-lg font-semibold tracking-wider uppercase mt-2.5 cursor-pointer">
                        Sign Up
                    </button>
                    <?php if (!empty($message)) { ?>
                        <p class="<?php echo $showSuccess ? 'text-green-600' : 'text-red-600'; ?> mt-3 text-sm font-medium" id="signupMessage"><?php echo $message; ?></p>
                    <?php } ?>
                </form>
            </div>

            <div class="form-container sign-in absolute top-0 h-full w-1/2 left-0 z-20">
                <form class="bg-white flex items-center justify-center flex-col px-10 h-full" method="POST" action="">
                    <h1 class="text-2xl font-bold mb-4">Log In</h1>
                    <div class="social-icons my-5">
                        <a href="#" class="icon border border-gray-300 rounded-full inline-flex justify-center items-center mx-1 w-10 h-10">
                            <i class="fa-brands fa-google"></i>
                        </a>
                        <a href="#" class="icon border border-gray-300 rounded-full inline-flex justify-center items-center mx-1 w-10 h-10">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="#" class="icon border border-gray-300 rounded-full inline-flex justify-center items-center mx-1 w-10 h-10">
                            <i class="fa-brands fa-github"></i>
                        </a>
                        <a href="#" class="icon border border-gray-300 rounded-full inline-flex justify-center items-center mx-1 w-10 h-10">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                    </div>
                    <span class="text-xs mb-5">or use your email and password</span>
                    <input type="email" name="email" placeholder="Email" class="bg-gray-100 border-none my-2 py-2.5 px-4 text-sm rounded-lg w-full outline-none">
                    <input type="password" name="password" placeholder="Password" class="bg-gray-100 border-none my-2 py-2.5 px-4 text-sm rounded-lg w-full outline-none">
                    
                    <button class="bg-indigo-800 text-white text-xs mt-3 py-2.5 px-11 border border-transparent rounded-lg font-semibold tracking-wider uppercase cursor-pointer" name="login">
                        Log In
                    </button>
                    <?php if (!empty($message) && isset($_POST['signin'])) { ?>
                        <p class="text-red-600 mt-3 text-sm font-medium"><?php echo $message; ?></p>
                    <?php } ?>
                </form>
            </div>

            <div class="toggle-container absolute top-0 left-1/2 w-1/2 h-full overflow-hidden rounded-[150px_0_0_100px] z-30">
                <div class="toggle bg-gradient-to-r from-indigo-600 to-indigo-800 h-full text-white relative left-[-100%] w-[200%]">
                    <div class="toggle-panel toggle-left absolute w-1/2 h-full flex items-center justify-center flex-col px-8 text-center top-0 transform -translate-x-[200%]">
                        <h1 class="text-2xl font-bold mb-2">Welcome Back!</h1>
                        <p class="text-sm leading-5 tracking-wider my-5">Enter your personal details to use all of site features</p>
                        <button class="bg-transparent border border-white text-white text-xs py-2.5 px-11 rounded-lg font-semibold tracking-wider uppercase cursor-pointer" id="login">
                            Log In
                        </button>
                    </div>
                    <div class="toggle-panel toggle-right absolute w-1/2 h-full flex items-center justify-center flex-col px-8 text-center top-0 right-0 transform translate-x-0">
                        <h1 class="text-2xl font-bold mb-2">Hello, Friend!</h1>
                        <p class="text-sm leading-5 tracking-wider my-5">Register with your personal details to use all of site features</p>
                        <button class="bg-transparent border border-white text-white text-xs py-2.5 px-11 rounded-lg font-semibold tracking-wider uppercase cursor-pointer" id="register">
                            Sign Up
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const container = document.getElementById('container');
        const registerBtn = document.getElementById('register');
        const loginBtn = document.getElementById('login');
        const signupMessage = document.getElementById('signupMessage');

        registerBtn.addEventListener('click', () => {
            container.classList.add("active");
        });

        loginBtn.addEventListener('click', () => {
            container.classList.remove("active");
        });

        <?php if (!empty($message) && isset($_POST['signup'])) { ?>
            <?php if ($showSuccess) { ?>
                setTimeout(() => {
                    container.classList.remove("active");
                }, 2000);
            <?php } else { ?>
                container.classList.add("active");
            <?php } ?>
        <?php } ?>
    </script>
</body>
</html>