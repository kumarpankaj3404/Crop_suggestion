<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Establish database connection
$conn = mysqli_connect("localhost", "root", "", "crop");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$recommended_crop = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ensure all expected keys exist before using them
    $expected_keys = ['nitrogen', 'phosphorus', 'potassium', 'temperature', 'humidity', 'ph', 'rainfall'];
    $input = [];

    foreach ($expected_keys as $key) {
        // If key is missing or empty, set to 0 or handle appropriately
        $input[$key] = isset($_POST[$key]) ? (float)$_POST[$key] : 0;
    }

    // Fetch crop data
    $query = "SELECT * FROM crop_data";
    $result = mysqli_query($conn, $query);

    $min_diff = PHP_FLOAT_MAX;
    $closest_crop = "No crop found";

    while ($row = mysqli_fetch_assoc($result)) {
        $diff = 0;
        foreach ($expected_keys as $key) {
            if (isset($row[$key])) {
                $diff += abs($input[$key] - (float)$row[$key]);
            }
        }

        // Assuming crop name is stored in a column named 'crop'
        if ($diff < $min_diff) {
            $min_diff = $diff;
            $closest_crop = $row['crop'];
        }
    }

    $recommended_crop = $closest_crop;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="./output.css" rel="stylesheet">
    <link rel="stylesheet" href="./homecss.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    .bg-crop_recommendation {
        background-image: url('../photos/home/crops.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        position: relative;
        padding-top: 35px;
        text-align: center;
    }
    .bg-crop_recommendation::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(6, 5, 5, 0.584);
            position: fixed;
            z-index: 0;
        }
    .content-container {
        position: relative;
        z-index: 1;
    }
    </style>
</head>
<body class="font-mono bg-gray-950 text-white relative">
<header class="flex justify-between  items-center bg-gray-950 h-15 sticky  z-20 border-b-2 border-b-gray-900 top-0 pl-3 pr-3">
        <div class="flex gap-2  items-center">
            <a href="./homePage.html" class="flex items-center gap-2">
                <img src="../photos/home/logo.png" alt="logo" class="h-10 w-10 rounded-4xl">
                <h3 class="">AgriGrow</h3>
            </a>
        </div>

        <div class=" text-gray-400 flex items-center gap-5 border-2 border-gray-800 rounded-2xl pl-4 pr-4 pt-1 pb-1">
            <a href="./homePage.html" class=" hover:text-white">Home</a>
            <a href="./SUNSIDIES.html" class=" hover:text-white">Subsidies</a>
            <a href="./blog.html" class=" hover:text-white">Blog</a>
            <a href="./homePage.html#About" class=" hover:text-white">About us</a>
        </div>
        

        <div class="relative">
            <button id="menu-btn" class="p-2 hover:bg-gray-800 rounded-lg transition-colors">
                <i class="fa-solid fa-bars text-white text-xl"></i>
            </button>
        
            <div id="profile-menu" class="hidden absolute right-0 mt-2 w-48 bg-gray-800 rounded-lg shadow-xl py-2">
                <a href="#" class="block px-4 py-2 text-white hover:bg-gray-700">Profile</a>
                <a href="./login.html" class="block px-4 py-2 text-white hover:bg-gray-700">Logout</a>
            </div>
        </div>

    </header>

    <script src="../jquery-3.7.1.js"></script>
    <div class="bg-crop_recommendation min-h-screen flex flex-col items-center ">
        <div class="content-container container mx-auto px-4  flex flex-col items-center justify-end w-full text-center" >
            <h1 class="text-6xl font-bold mb-6 text-white py-2">Crop Recommendation</h1>
            <p class="text-center mb-10 text-xl text-white px-4 py-2 max-w-4xl mx-auto">Our Crop Recommendation service helps farmers choose the best crops based on weather, soil conditions, and seasonal trends. Using real-time data and smart analysis, we suggest the most suitable crops for your region—boosting yield, profit, and sustainability.
                Make smarter farming decisions and grow with confidence.</p>
            <div class="w-full max-w-4xl mx-auto bg-opacity-70 p-8 rounded-xl mb-10">
                <h3 class="text-xl font-semibold   text-white text-center">Tell us about your agricultural field</h3>
                <h3 class="text-xl font-semibold mb-6 py-2 text-white text-center">Please enter the following soil and environmental details</h3>                
               
                <form action="" method="POST">
                    <div class="space-y-8">
                        <!-- All input fields remain the same -->
                        <!-- Just add name="" attributes to each input -->
                        <div class="flex flex-row justify-center mb-2 gap-3">
                            <div class="min-w-[180px]">
                                <label class="block text-white mb-2 text-center">Nitrogen (ppm)</label>
                                <input type="number" name="nitrogen" placeholder="90" class="w-full bg-gray-700 text-white px-4 py-3 rounded-lg">
                            </div>
                            <div class="min-w-[180px]">
                                <label class="block text-white mb-2 text-center">Phosphorous (ppm)</label>
                                <input type="number" name="phosphorus" placeholder="42" class="w-full bg-gray-700 text-white px-4 py-3 rounded-lg">

                            </div>
                            <div class="min-w-[180px]">
                                <label class="block text-white mb-2 text-center">Potassium (ppm)</label>
                                <input type="number" name="potassium" placeholder="43" class="w-full bg-gray-700 text-white px-4 py-3 rounded-lg">
                            </div>
                            <div class="min-w-[180px]">
                                <label class="block text-white mb-2 text-center">Temperature (°C)</label>
                                <input type="number" name="temperature" placeholder="21" class="w-full bg-gray-700 text-white px-4 py-3 rounded-lg">
                            </div>
                        </div>
                
                        <div class="flex flex-row justify-center gap-3">
                            <div class="min-w-[180px]">
                                <label class="block text-white mb-2 text-center">Humidity (%)</label>
                                <input type="number" name="humidity" placeholder="82" class="w-full bg-gray-700 text-white px-4 py-3 rounded-lg">
                            </div>
                            <div class="min-w-[180px]">
                                <label class="block text-white mb-2 text-center">pH Level</label>
                                <input type="number" step="0.1" name="ph" placeholder="6.5" class="w-full bg-gray-700 text-white px-4 py-3 rounded-lg">
                            </div>
                            <div class="min-w-[180px]">
                                <label class="block text-white mb-2 text-center">Rainfall (mm)</label>
                                <input type="number" name="rainfall" placeholder="203" class="w-full bg-gray-700 text-white px-4 py-3 rounded-lg">
                            </div>
                        </div>
                    </div>
                
                    <div class="text-center mt-6">
                        <button type="submit" id="show" class="bg-lime-500 hover:bg-lime-600 text-white font-bold py-2 px-6 rounded-2xl mt-8 mb-2 shadow-lg transition-all duration-300 ease-in-out text-lg hover:scale-105 active:scale-95">
                            Get Crop Recommendations
                        </button>
                    </div>
                </form>

                <?php if (!empty($recommended_crop)): ?>
                    <div class="mt-8 bg-green-800 text-white p-4 rounded-lg text-xl font-semibold">
                        Recommended Crop: <span class="text-lime-300"><?php echo htmlspecialchars($recommended_crop); ?></span>
                    </div>
                <?php endif; ?>
                

            </div>
        </div> 

        
        <footer class=" bg-gray-900  h-8 mt-5  w-full">
            <div class="flex justify-center items-center ">
                <p>© 2021 AgriGrow. All rights reserved</p>
            </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#show").click(function(){
                $().fadeIn(200);
            });
        });

    </script>
</body>
</html>