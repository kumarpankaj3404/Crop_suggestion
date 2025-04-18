<?php
session_start(); // Start the session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support - AgriGrow</title>
    <link rel="icon" href="../photos/home/favicon2.svg" type="image/svg+xml">
    <link href="./output.css" rel="stylesheet">
    <link rel="stylesheet" href="./homecss.css">
    <style>
        .bg-subsidies {
            background-image: url('../photos/home/subsidies.jpg');
            background-size: cover;
            background-position: center;
        }
        .hover-effect:hover {
            color: #63bbf1;
            text-decoration: underline;
        }
    </style>
</head>
<body class="font-mono bg-gray-950 text-white bg-subsidies ">

        <!-- Header -->
         <div class="bg-black/65">
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
                    
                        <div id="profile-menu" class="hidden absolute  right-0 mt-10 top-10 w-48 bg-gray-800 rounded-lg shadow-xl py-2">
                            <span class="block px-4 py-2 text-gray-400 cursor-default"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                            <a href="./logout.php" class="block px-4 py-2 text-white hover:bg-gray-700">Logout</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="./login.php" class="p-2 bg-lime-500 text-white rounded-lg hover:bg-lime-600 transition-colors">Login</a>
                <?php endif; ?>
            </div>
        </header>
        <!-- Sustainable Practices Section -->
<section class="p-10 ">
    <div class="max-w-7xl mx-auto">
      <h2 class="text-4xl font-bold mb-6 text-center">🌿 Sustainable Agricultural Practices</h2>
      <p class="mb-4  text-2xl">
        Sustainable agriculture aims to meet society's current food and textile needs without compromising the ability of future generations to meet their own needs. It integrates three main goals: environmental health, economic profitability, and social equity.
      </p>
  
      <!-- Schemes and Subsidies Grid Section -->
      <div class="  rounded-2xl p-10 my-10 bg-gray-700/55">
        <h2 class="text-3xl font-bold mb-6 text-center">🚜 Government Schemes & Subsidies Related to Agri-Tech</h2>
        <div class="grid md:grid-cols-2 gap-6">
          <div class="bg-gray-800 text-white p-5 rounded-2xl">
            <h3 class="text-xl font-semibold mb-2">
                <a href="https://pmkisan.gov.in/" target="_blank" class="hover:underline text-blue-400 hover-effect">Pradhan Mantri Kisan Samman Nidhi (PM-KISAN)</a>
            </h3>
            <ul class="list-disc ml-5 space-y-2">
              <li><strong>Income Support:</strong> Provides ₹6,000 per year in three equal installments to all landholding farmer families.</li>
              <li><strong>Direct Benefit Transfer:</strong> Funds are directly transferred to the beneficiary's bank account.</li>
              <li><strong>Eligibility:</strong> Small and marginal farmers owning up to 2 hectares of land.</li>
            </ul>
          </div>
  
          <div class="bg-gray-800 text-white p-5 rounded-2xl">
            <h3 class="text-xl font-semibold mb-2">
              <a href="https://pmfby.gov.in/" target="_blank" class="hover:underline text-blue-400 hover-effect">Pradhan Mantri Fasal Bima Yojana (PMFBY)</a></h3>
            <ul class="list-disc ml-5 space-y-2">
              <li><strong>Crop Insurance:</strong> Financial support to farmers for crop loss due to natural calamities, pests, and diseases.</li>
              <li><strong>Affordable Premium:</strong> Premium rate is 2% for Kharif, 1.5% for Rabi, and 5% for commercial crops.</li>
              <li><strong>Nationwide Coverage:</strong> Covers all food and oilseed crops and annual commercial/horticultural crops.</li>
            </ul>
          </div>
  
          <div class="bg-gray-800 text-white p-5 rounded-2xl">
            <h3 class="text-xl font-semibold mb-2">
              <a href="https://www.myscheme.gov.in/schemes/smam" target="_blank" class="hover:underline text-blue-400 hover-effect">Sub-Mission on Agricultural Mechanization (SMAM)</a></h3>
            <ul class="list-disc ml-5 space-y-2">
              <li><strong>Subsidy on Equipment:</strong> Up to 60% subsidy on farm mechanization tools and machinery.</li>
              <li><strong>Focus on Small Farmers:</strong> Helps small and marginal farmers access expensive agricultural machines.</li>
              <li><strong>Custom Hiring Centres:</strong> Establishment support for custom hiring centers to rent equipment to farmers.</li>
            </ul>
          </div>
  
          <div class="bg-gray-800 text-white p-5 rounded-2xl">
            <h3 class="text-xl font-semibold mb-2">
              <a href="https://www.myscheme.gov.in/schemes/aif" target="_blank" class="hover:underline text-blue-400 hover-effect">Agriculture Infrastructure Fund (AIF)</a></h3>
            <ul class="list-disc ml-5 space-y-2">
              <li><strong>Credit Facility:</strong> Provides medium-long term debt financing for infrastructure development in agriculture.</li>
              <li><strong>Interest Subvention:</strong> 3% interest subsidy on loans up to ₹2 crore for 7 years.</li>
              <li><strong>Credit Guarantee:</strong> Credit guarantee support for loans under this fund through CGTMSE.</li>
            </ul>
          </div>
  
          <div class="bg-gray-800 text-white p-5 rounded-2xl">
            <h3 class="text-xl font-semibold mb-2">
              <a href="https://www.myscheme.gov.in/schemes/kcc" target="_blank" class="hover:underline text-blue-400 hover-effect">Kisan Credit Card (KCC)</a></h3>
            <ul class="list-disc ml-5 space-y-2">
              <li><strong>Loan Facility:</strong> Short-term credit for crop cultivation and other allied activities.</li>
              <li><strong>Interest Rate:</strong> Concessional interest rate with up to ₹3 lakh loan limit.</li>
              <li><strong>Insurance Coverage:</strong> Includes personal accident insurance for the cardholder.</li>
            </ul>
          </div>
  
          <div class="bg-gray-800 text-white p-5 rounded-2xl">
            <h3 class="text-xl font-semibold mb-2">
              <a href="https://pmkusum.mnre.gov.in/"  target="_blank" class="hover:underline text-blue-400 hover-effect">PM-KUSUM (Kisan Urja Suraksha evam Utthaan Mahabhiyan)</a></h3>
            <ul class="list-disc ml-5 space-y-2">
              <li><strong>Solar Pumps:</strong> 60% subsidy on the installation of solar-powered irrigation pumps.</li>
              <li><strong>Renewable Energy:</strong> Supports farmers in installing solar power plants on barren land.</li>
              <li><strong>Grid Connection:</strong> Enables farmers to sell surplus solar power to the grid.</li>
            </ul>
          </div>
  
          <div class="bg-gray-800 text-white p-5 rounded-2xl">
            <h3 class="text-xl font-semibold mb-2">
              <a href="https://agriwelfare.gov.in/en/DigiAgriDiv"  target="_blank" class="hover:underline text-blue-400 hover-effect">Digital Agriculture Mission</a></h3>
            <ul class="list-disc ml-5 space-y-2">
              <li><strong>Technological Integration:</strong> Promotes use of AI, Big Data, IoT, and blockchain in agriculture.</li>
              <li><strong>Digital Infrastructure:</strong> Supports creation of digital land records and farmer databases.</li>
              <li><strong>Private Collaboration:</strong> Encourages public-private partnerships to scale digital agri-solutions.</li>
            </ul>
          </div>
        </div>
      </div>
  
      <!-- Existing Sustainable Practices content remains unchanged below -->
      <div class="space-y-6">
        <!-- Keep existing content about soil, water, pest, agroforestry, etc. -->
      </div>
    </div>
  </section>
    <!-- Technological Advancements Section -->
<section class=" p-10 ">
    <div class="max-w-7xl mx-auto bg-gray-700/55 p-10 rounded-2xl">
      <h2 class="text-4xl font-bold mb-6 text-center text-white">🚀 Technological Advancements in Agriculture</h2>
      <div class="grid md:grid-cols-2 gap-6">
        <div class="bg-gray-800 text-white p-5 rounded-2xl">
          <h3 class="text-xl font-semibold mb-2">1. Artificial Intelligence & Machine Learning</h3>
          <p>AI and ML are being used for predicting crop yields, disease detection, soil analysis, and weather forecasting. These technologies help in real-time decision-making and precision agriculture.</p>
        </div>
        <div class="bg-gray-800 text-white p-5 rounded-2xl">
          <h3 class="text-xl font-semibold mb-2">2. Drones and UAVs</h3>
          <p>Drones are revolutionizing field mapping, crop surveillance, and pesticide spraying. They offer faster, efficient, and safer solutions for large-scale farms.</p>
        </div>
        <div class="bg-gray-800 text-white p-5 rounded-2xl">
          <h3 class="text-xl font-semibold mb-2">3. IoT-Based Smart Farming</h3>
          <p>IoT devices collect data on soil moisture, crop health, and weather, enabling automated irrigation and resource optimization. Farmers can remotely monitor fields through mobile apps.</p>
        </div>
        <div class="bg-gray-800 text-white p-5 rounded-2xl">
          <h3 class="text-xl font-semibold mb-2">4. Blockchain for Supply Chain Transparency</h3>
          <p>Blockchain ensures transparent and tamper-proof tracking of agricultural products from farm to market, improving trust and reducing fraud in food supply chains.</p>
        </div>
        <div class="bg-gray-800 text-white p-5 rounded-2xl">
          <h3 class="text-xl font-semibold mb-2">5. Mobile Apps and e-NAM</h3>
          <p>Farmers are increasingly using mobile applications for weather updates, market rates, and government support. The e-NAM platform helps connect farmers with buyers across India to get better prices for produce.</p>
        </div>
        <div class="bg-gray-800 text-white p-5 rounded-2xl">
          <h3 class="text-xl font-semibold mb-2">6. Robotics and Automated Machinery</h3>
          <p>Robotic machines like automated weeders and harvesters help reduce manual labor and increase precision in agricultural tasks, especially in repetitive or hazardous processes.</p>
        </div>
      </div>
    </div>
  </section>




        <footer class="bg-gray-900 mt-10 py-4">
            <div class="text-center text-gray-400">
                © 2025 AgriGrow. All rights reserved.
            </div>
        </footer>
    </div>
</body>
</html>