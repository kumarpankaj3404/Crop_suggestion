<?php
session_start(); // Start the session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agri-Grow</title>
    <link rel="icon" href="../photos/home/favicon2.svg" type="image/svg+xml">
    <link href="./output.css" rel="stylesheet">
    <link rel="stylesheet" href="./homecss.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body class="font-mono bg-gray-950 text-white relative">



<header class="flex justify-between items-center bg-gray-950 h-15 sticky z-20 border-b-2 border-b-gray-900 top-0 pl-3 pr-3">
    <div class="flex gap-2 items-center">
        <a href="./homePage.php" class="flex items-center gap-2">
            <img src="../photos/home/logo.png" alt="logo" class="h-10 w-10 rounded-4xl">
            <h3 class="">AgriGrow</h3>
        </a>
    </div>

    <div class="text-gray-400 flex items-center gap-5 border-2 border-gray-800 rounded-2xl pl-4 pr-4 pt-1 pb-1">
        <a href="./homePage.php" class="hover:text-white">Home</a>
        <a href="./SUNSIDIES.php" class="hover:text-white">Subsidies</a>
        <a href="./blog.php" class="hover:text-white">Blog</a>
        <a href="./homePage.php#About" class="hover:text-white">About us</a>
    </div>

    <div class="relative">
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <div class="flex items-center gap-2">
                <button id="menu-btn" class="p-2 hover:bg-gray-800 rounded-lg transition-colors flex items-center gap-2">
                    <span class="text-white"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                    <i class="fa-solid fa-caret-down text-white text-sm"></i>
                </button>
            
                <div id="profile-menu" class="hidden absolute  right-0 mt-20 w-48 bg-gray-800 rounded-lg shadow-xl py-2">
                    <span class="block px-4 py-2 text-gray-400 cursor-default"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                    <a href="./logout.php" class="block px-4 py-2 text-white hover:bg-gray-700">Logout</a>
                    <a href="./profile.php" class="block px-4 py-2 text-white hover:bg-gray-700">Profile</a>

                </div>
            </div>
        <?php else: ?>
            <a href="./login.php" class="p-2 bg-lime-500 text-white rounded-lg hover:bg-lime-600 transition-colors">Login</a>
        <?php endif; ?>
    </div>
</header>




    <div class="mt-5 relative h-155 flex flex-col items-center justify-center rounded-2xl ml-5 mr-5 overflow-hidden">
    <video 
        autoplay 
        loop 
        muted 
        playsinline
        class="absolute z-0 w-full h-full object-cover"
    >

        <source src="../photos/home/8333971-uhd_4096_2160_25fps.mp4" type="video/mp4">
    </video>

        <div class=" relative z-10 flex flex-col items-center justify-center w-200 text-white">
            <h1 class="text-6xl font-bold text-center mb-10">
                Sustainable farming<br> for a healthier planet
            </h1>
            <p class="text-xl font-bold text-center">
                Empowering farmers with smart, eco-friendly practices to boost crop yield while protecting the environment.
Get personalized crop recommendations based on your soil and weather conditions.
Together, let’s grow more with less and build a greener tomorrow.
            </p>
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                <p class="bg-lime-500 px-6 py-2 rounded-2xl font-bold mt-25 inline-block">
                   Welcome <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                </p>
            <?php else: ?>
            <a href="login.php" class="bg-lime-500 px-6 py-2 rounded-2xl font-bold mt-25 cursor-pointer inline-block">
                Get Started
            </a>
            <?php endif; ?>
        </div>
    </div>




    







    <div class="flex flex-col items-center">
        <div class="flex flex-col items-center mt-25">

            <h1 class="text-3xl font-bold ">Our Services</h1>
            <p class="w-150">
                Discover our range of innovative services designed to empower farmers and promote sustainable agriculture. From personalized crop recommendations to advanced weather predictions and pest management solutions, we provide tools to help you grow smarter and more efficiently.
            </p>

            <div class="flex gap-10 mt-10">
    <!-- Crop Recommendation Card -->
    <a href="./crop_recom.php" class="block">
        <div class="rounded-2xl border-2 border-gray-900 bg-gray-800 w-80 hover:scale-110 transition-transform duration-300 ease-in-out">
            <img src="../photos/home/service_crop-recomendation2.jpg" alt="crop" class="h-70 w-80 rounded-t-2xl">
            <h3 class="m-3 text-lg font-bold">
                Crop Recommendation
            </h3>
            <p class="m-3 text-lg">
                Get personalized crop recommendations based on your soil conditions.
            </p>
        </div>
    </a>

    <!-- Weather Predictions Card -->
    <a href="./weather.php" class="block">
        <div class="rounded-2xl border-2 border-gray-900 bg-gray-800 w-80 hover:scale-110 transition-transform duration-300 ease-in-out">
            <img src="../photos/home/service_weather2.jpg" alt="weather" class="h-70 w-80 rounded-t-2xl">
            <h3 class="m-3 text-lg font-bold">
                Weather Predictions
            </h3>
            <p class="m-3 text-lg">
                Enter the city name and get the weather prediction for the next 15 days.
            </p>
        </div>
    </a>

    <!-- Pest and Disease Card -->
    <a href="./pest.php" class="block">
        <div class="rounded-2xl border-2 border-gray-900 bg-gray-800 w-80 hover:scale-110 transition-transform duration-300 ease-in-out">
            <img src="../photos/home/service_pesticidesjpg.jpg" alt="pest" class="h-70 w-80 rounded-t-2xl">
            <h3 class="m-3 text-lg font-bold">
                Pest and Disease
            </h3>
            <p class="m-3 text-lg">
                Explore effective pest and disease management strategies to protect your crops.
            </p>
        </div>
    </a>
</div>
        </div>
        <!-- <button class="gradient-button bg-lime-400 px-6 py-2 rounded-2xl font-bold mt-10 cursor-pointer">
            View All
        </button> -->
    </div>








    <div class="flex flex-col items-center mt-25" >
        <h1 class="text-3xl font-bold mb-4">
            Our Farming Methodology
        </h1>
        <p class="w-150 text-center mb-8">
            Innovative agricultural practices combining technology and sustainability
        </p>
        <div class="relative flex gap-8 items-start">
            <img src="../photos/home/tractor-spray.jpg" alt="farming-methods" 
                 class="h-110 w-150 rounded-xl object-cover sticky top-4">
    
            <div class="flex flex-col justify-between gap-2 h-110 overflow-y-auto w-120 pr-2 hover:pr-0 transition-all duration-300" 
     id="accordion-container">
                <!-- Precision Agriculture -->
                <div class="accordion-item border-2 border-gray-800 rounded-xl bg-gray-700">
                    <div class="accordion-header flex justify-between items-center p-4 cursor-pointer">
                        <h3 class="text-lg font-semibold">Precision Agriculture</h3>
                        <img src="../photos/home/down.svg" class="h-5 w-5 transition-transform accordion-arrow">
                    </div>
                    <div class="accordion-content px-4 pb-4 space-y-3">
                        <ul class="list-disc pl-6 text-gray-300 space-y-2">
                            <li>Real-time soil moisture monitoring</li>
                            <li>Crop health imaging (NDVI analysis)</li>
                            <li>Variable-rate fertilizer application</li>
                            <li>Automated yield mapping</li>
                        </ul>
                    </div>
                </div>
    
                <!-- Soil Health Optimization -->
                <div class="accordion-item border-2 border-gray-800 rounded-xl bg-gray-700">
                    <div class="accordion-header flex justify-between items-center p-4 cursor-pointer">
                        <h3 class="text-lg font-semibold">Soil Health Optimization</h3>
                        <img src="../photos/home/down.svg" class="h-5 w-5 transition-transform accordion-arrow">
                    </div>
                    <div class="accordion-content px-4 pb-4 space-y-3">
                        <div class="grid grid-cols-2 gap-3 text-gray-300">
                            <div class="bg-gray-800 p-3 rounded-lg">
                                <h4 class="text-lime-300 text-sm font-semibold">Cover Cropping</h4>
                                <p class="text-xs mt-1">Legume rotations adding 50kg N/ha</p>
                            </div>
                            <div class="bg-gray-800 p-3 rounded-lg">
                                <h4 class="text-lime-300 text-sm font-semibold">Biochar Amendment</h4>
                                <p class="text-xs mt-1">20% increase in water retention</p>
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- Smart Irrigation -->
                <div class="accordion-item border-2 border-gray-800 rounded-xl bg-gray-700">
                    <div class="accordion-header flex justify-between items-center p-4 cursor-pointer">
                        <h3 class="text-lg font-semibold">Smart Irrigation</h3>
                        <img src="../photos/home/down.svg" class="h-5 w-5 transition-transform accordion-arrow">
                    </div>
                    <div class="accordion-content px-4 pb-4 space-y-3">
                        <ul class="list-disc pl-6 text-gray-300 space-y-2">
                            <li>Soil tension monitoring</li>
                            <li>Evapotranspiration calculations</li>
                            <li>Drip irrigation automation</li>
                        </ul>
                    </div>
                </div>
    
                <!-- Eco-Pest Management -->
                <div class="accordion-item border-2 border-gray-800 rounded-xl bg-gray-700">
                    <div class="accordion-header flex justify-between items-center p-4 cursor-pointer">
                        <h3 class="text-lg font-semibold">Eco-Pest Management</h3>
                        <img src="../photos/home/down.svg" class="h-5 w-5 transition-transform accordion-arrow">
                    </div>
                    <div class="accordion-content px-4 pb-4 space-y-3">
                        <div class="grid grid-cols-2 gap-3 text-gray-300">
                            <div class="bg-gray-800 p-3 rounded-lg">
                                <h4 class="text-lime-300 text-sm font-semibold">Biological Controls</h4>
                                <ul class="text-xs list-disc pl-4 mt-1 space-y-1">
                                    <li>Ladybugs for aphids</li>
                                    <li>Nematodes for grubs</li>
                                </ul>
                            </div>
                            <div class="bg-gray-800 p-3 rounded-lg">
                                <h4 class="text-lime-300 text-sm font-semibold">Monitoring</h4>
                                <ul class="text-xs list-disc pl-4 mt-1 space-y-1">
                                    <li>AI pest recognition</li>
                                    <li>Smart trap networks</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    





    
    <div class="flex flex-col items-center mt-25" id="About">
    <h1 class="text-3xl font-bold mb-4 mt-20">About AgriGrow</h1>
    <p class="w-180 text-center mb-8">
        AgriGrow is a revolutionary agricultural platform designed to empower farmers with AI-driven insights for sustainable farming. Our mission is to bridge the gap between traditional farming practices and modern technology, helping growers make data-driven decisions to optimize yields while preserving environmental resources.
    </p>
    <div class="flex items-center gap-8">
        <!-- Development Team -->
        <div class="bg-gray-800 p-6 rounded-xl text-center">
            <h3 class="text-lg font-semibold mb-2">The AgriGrow Team</h3>
            <div class="space-y-4 mt-4">
                <div>
                <a href="https://linkedin.com/in/asthasinghal24" target="_blank"><p class="font-medium">Astha Singhal</p></a>
                </div>
                <div>
                <a href="https://linkedin.com/in/kaif-khan-20073228a" target="_blank"><p class="font-medium">Kaif Khan</p></a>
                </div>
                <div>
               <a href="https://linkedin.com/in/muwahid-mir-4652a8295" target="_blank"><p class="font-medium">Muwahid Mir</p></a>
                </div>
                <div>
                    <a href="https://linkedin.com/in/pankaj-kumar-513a10298" target="_blank"><p class="font-medium">Pankaj Kumar</p></a>

                </div>
                
            </div>
        </div>

        <!-- Platform Features -->
        <div class="bg-gray-800 p-6 rounded-xl">
            <h3 class="text-lg font-semibold mb-4">Our Features</h3>
            <ul class="list-disc pl-6 text-gray-300 space-y-2">
                <li>Smart crop recommendations</li>
                <li>Real-time weather analysis</li>
                <li>Pest management solutions</li>
                <li>Sustainable practice guides</li>
            </ul>
        </div>
    </div>
</div>









    <div class="partner bg-gray-900 pl-20 pr-20 ml-5 mr-5 rounded-2xl pt-5 pb-5 mt-25">
        <div>
            <h1><strong class="text-2xl">Benifits</strong> to be partnered with us</h1>
            <p>Partner with us to access advanced agricultural technologies, expert support, and a community dedicated to sustainable farming.</p>
            <div class="partner_img flex justify-between gap-5 mt-10">
                <img src="../photos/home/farm_tech.svg" alt="tech" class="h-25 w-30 rounded-2xl">
                <img src="../photos/home/support.svg" alt="partner2" class="h-25 w-30 rounded-2xl">
                <img src="../photos/home/sustainable.svg" alt="partner3" class="h-25 w-30 rounded-2xl rotate-image">
                <img src="../photos/home/community.svg" alt="partner4" class="h-25 w-30 rounded-2xl">
            </div>
            <div class="partner_img flex justify-between gap-5 mt-3">
                <a href="./farmtech.php"><p class="w-30 text-center ">farm_tech </p></a>
                <a href="./support.php"><p class="w-30 text-center ">Support </p></a>
                <a href="./sustainable.php"><p class="w-30 text-center ">Sustainable </p></a>
                <a href="./community.php"><p class="w-30 text-center ">community </p></a>
                
            </div>
        </div>

    </div>
    <!-- About Us Section -->




    <div class="flex items-center mt-25 gap-20 justify-between ml-10 mr-10">

        <div class="Agri_pro w-85 flex flex-col " >
            <span class="flex gap-2 items-center">
                <img src="../photos/home/logo.png" alt="logo" class="h-10 w-10 rounded-4xl">
                <h1>AgriGrow</h1>
            </span>
            <p class="mt-6">Join AgriGrow to revolutionize your farming practices and contribute to a greener, more sustainable future.</p>
        </div>

        <div class="Quick_link  flex flex-col" >
            <h1>Quick Links</h1>
            <div class="flex flex-col gap-2 mt-3">
                <a href="./homePage.php" class="flex items-center gap-3"><img src="../photos/home/home-1-svgrepo-com.svg" alt="" class="h-4 w-3">Home</a>
                <a href="./blog.php" class="flex items-center gap-3"><img src="../photos/home/blog-svgrepo-com.svg" alt="" class="h-4 w-3">Blog</a>
                <a href="./homePage.php#About" class="flex items-center gap-3"><img src="../photos/home/about.svg" alt="" class="h-4 w-4">About us</a>
            </div>
        </div>

        <div class="Services_link  flex flex-col" >
            <h1 class="text-center">Services</h1>
            <div class="flex flex-col gap-2 mt-3">
                <a href="./crop_recom.php">Crop Recomendation</a>
                <a href="./weather.php">Weather Alerts</a>
                <a href="./pest.php">Pest Management </a>
            </div>
        </div>

        <div class="Social_link  flex flex-col" >
            <h1>Social_link</h1>
            <div class="flex flex-col gap-2 mt-3">
                <a href="https://facebook.com/agrigrow"  target="_blank"  class="flex gap-2 items-center"><img src="../photos/home/facebook.svg" alt="" class="h-4 w-4">Facebook</a>
                <a href="https://instagram.com/agrigrow" target="_blank" class="flex gap-2 items-center"><img src="../photos/home/insta.svg" alt="" class="h-4 w-4">Instagram</a>
                <a href="https://twitter.com/agrigrow"   target="_blank"  class="flex gap-2 items-center"><img src="../photos/home/twitter.svg" alt="" class="h-4 w-4">Twitter</a>
                <!-- <a href="https://www.linkedin.com/muwahidmir"  target="_blank"  class="flex gap-2 items-center"><img src="../photos/home/linkedin.svg" alt="" class="h-4 w-4">LinkedIn</a> -->
            </div>
        </div>
        
    </div>
    
    <div>

    </div>

    <footer class=" bg-gray-900  mt-5  w-full">
        <div class="flex justify-center items-center ">
            <p>© 2021 AgriGrow. All rights reserved</p>
        </div>
    </footer>



    <script>
        document.addEventListener('DOMContentLoaded', () => {
        const accordionItems = document.querySelectorAll('.accordion-item');
    
        accordionItems.forEach(item => {
            const header = item.querySelector('.flex.justify-between');
            const content = item.querySelector('.accordion-content');
            const arrow = item.querySelector('img');
    
            header.addEventListener('click', () => {
                // Close all other items
                accordionItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.querySelector('.accordion-content').style.maxHeight = null;
                        otherItem.querySelector('img').classList.remove('rotate-180');
                    }
                });
    
                // Toggle current item
                content.style.maxHeight = content.style.maxHeight ? null : `${content.scrollHeight}px`;
                arrow.classList.toggle('rotate-180');
                
                // Smooth scroll
                if (content.style.maxHeight) {
                    item.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }
            });
        });
    });

    const menuButton = document.getElementById('menu-btn');
const profileMenu = document.getElementById('profile-menu');

menuButton.addEventListener('click', (e) => {
    e.stopPropagation();
    profileMenu.classList.toggle('active');
});

// Close menu when clicking outside
document.addEventListener('click', (e) => {
    if (!profileMenu.contains(e.target) && !menuButton.contains(e.target)) {
        profileMenu.classList.remove('active');
    }
});
        </script>
        
</body>
</html>