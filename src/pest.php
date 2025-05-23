<?php
session_start(); // Start the session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesticide & Pest Management Info</title>
    <link rel="icon" href="../photos/home/favicon2.svg" type="image/svg+xml">
    <link href="./output.css" rel="stylesheet">
    <link rel="stylesheet" href="./homecss.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .bg-pest {
            background-image: url('../photos/home/Pesticides-Pros-Cons-2.jpg');
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

    <main class="bg-pest min-h-screen px-6 py-12">
        <div class="content-container max-w-6xl mx-auto space-y-10">
            <section class="bg-gray-700/90 m-10 rounded-2xl p-6 shadow-lg">
                <div class="bg-overlay">
                    <h2 class="text-3xl font-bold mb-4 text-center">🧪 Types of Pesticides & Their Uses</h2>
                    <div class="space-y-6 grid grid-cols-2 gap-4">
                        <div class="bg-gray-800 m-5 p-5 rounded-2xl flex flex-col justify-center items-center">
                            <h3 class="text-2xl font-semibold">1. Insecticides</h3>
                            <ul class="list-disc ml-5">
                                <li><strong>Organophosphates:</strong> Affect insect nervous system.</li>
                                <li><strong>Pyrethroids:</strong> Synthetic chemicals that target insect nervous systems.</li>
                                <li><strong>Neonicotinoids:</strong> Affect insect receptors (nicotinic acetylcholine).</li>
                            </ul>
                        </div>
                        <div class="bg-gray-800 m-5 p-5 rounded-2xl flex flex-col justify-center items-center">
                            <h3 class="text-2xl font-semibold">2. Herbicides</h3>
                            <ul class="list-disc ml-5">
                                <li><strong>Triazines:</strong> Inhibit plant photosynthesis.</li>
                                <li><strong>Glyphosate:</strong> A widely used broad-spectrum herbicide.</li>
                            </ul>
                        </div>
                        <div class="bg-gray-800 m-5 p-5 rounded-2xl flex flex-col justify-center items-center">
                            <h3 class="text-2xl font-semibold">3. Fungicides</h3>
                            <ul class="list-disc ml-5">
                                <li><strong>Benzimidazoles:</strong> Disrupt fungal cell division.</li>
                                <li><strong>Biofungicides:</strong> Like <em>Trichoderma</em> used in organic farming.</li>
                            </ul>
                        </div>
                        <div class="bg-gray-800 m-5 p-5 rounded-2xl flex flex-col justify-center items-center">
                            <h3 class="text-2xl font-semibold">4. Nematicides</h3>
                            <p>Control nematodes that harm plant roots.</p>
                        </div>
                        <div class="bg-gray-800 m-5 p-5 rounded-2xl flex flex-col justify-center items-center">
                            <h3 class="text-2xl font-semibold">5. Rodenticides</h3>
                            <p>Used to manage rodents.</p>
                        </div>
                        <div class="bg-gray-800 m-5 p-5 rounded-2xl flex flex-col justify-center items-center">
                            <h3 class="text-2xl font-semibold">6. Biopesticides</h3>
                            <ul class="list-disc ml-5">
                                <li><strong>Microbial:</strong> Contain organisms like <em>Bacillus thuringiensis</em>.</li>
                                <li><strong>Botanical:</strong> Derived from plants (e.g., neem oil).</li>
                                <li><strong>Biochemical:</strong> Natural substances like pheromones.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-gray-700/90 m-10 rounded-2xl p-6 shadow-lg">
                <div class="bg-overlay">
                    <h2 class="text-3xl font-bold mb-4 text-center">🌱 Soil Types & Suitable Pesticides</h2>
                    <div class="space-y-6 grid grid-cols-2 gap-4">
                        <div class="bg-gray-800 m-5 p-5 rounded-2xl flex flex-col justify-center items-center">
                            <h3 class="text-2xl font-semibold">1. Sandy Soils</h3>
                            <ul class="list-disc ml-5">
                                <li>Light, well-drained, low in organic matter.</li>
                                <li>Pesticides can leach quickly, increasing groundwater contamination risk.</li>
                                <li>Use granular or controlled-release formulations.</li>
                                <li>Apply during calm weather to reduce drift.</li>
                            </ul>
                        </div>
                        <div class="bg-gray-800 m-5 p-5 rounded-2xl flex flex-col justify-center items-center">
                            <h3 class="text-2xl font-semibold">2. Clay Soils</h3>
                            <ul class="list-disc ml-5">
                                <li>Heavy, retain water and nutrients well.</li>
                                <li>Pesticides may bind to particles, reducing effectiveness.</li>
                                <li>Avoid overwatering to reduce runoff.</li>
                                <li>Ensure proper drainage systems.</li>
                            </ul>
                        </div>
                        <div class="bg-gray-800 m-5 p-5 rounded-2xl flex flex-col justify-center items-center">
                            <h3 class="text-2xl font-semibold">3. Loamy Soils</h3>
                            <ul class="list-disc ml-5">
                                <li>Balanced mix of sand, silt, and clay.</li>
                                <li>Ideal for most crops and pesticide applications.</li>
                                <li>Monitor for runoff during rains.</li>
                            </ul>
                        </div>
                        <div class="bg-gray-800 m-5 p-5 rounded-2xl flex flex-col justify-center items-center">
                            <h3 class="text-2xl font-semibold">4. Peaty Soils</h3>
                            <ul class="list-disc ml-5">
                                <li>High in organic matter, acidic in nature.</li>
                                <li>Organic matter binds pesticides, reducing availability.</li>
                                <li>May require higher doses of pesticide.</li>
                                <li>Adjust soil pH for better pesticide efficacy.</li>
                            </ul>
                        </div>
                        <div class="bg-gray-800 m-5 p-5 rounded-2xl flex flex-col justify-center items-center">
                            <h3 class="text-2xl font-semibold">5. Silty Soils</h3>
                            <ul class="list-disc ml-5">
                                <li>Smooth texture, good moisture retention.</li>
                                <li>Prone to compaction, affecting infiltration.</li>
                                <li>Use conservation tillage to avoid compaction.</li>
                                <li>Monitor for surface runoff.</li>
                            </ul>
                        </div>
                        <div class="bg-gray-800 m-5 p-5 rounded-2xl flex flex-col justify-center items-center">
                            <h3 class="text-2xl font-semibold">6. Chalky Soils</h3>
                            <ul class="list-disc ml-5">
                                <li>Alkaline, stony, drains quickly.</li>
                                <li>High pH affects pesticide solubility and plant nutrients.</li>
                                <li>Use pesticides formulated for alkaline soils.</li>
                                <li>Add organic matter to improve fertility and retention.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-gray-700/90 m-10 rounded-2xl p-6 shadow-lg">
                <div class="bg-overlay">
                    <h2 class="text-3xl font-bold mb-4 text-center">🌿 Integrated Pest Management (IPM)</h2>
                    <p class="text-lg leading-relaxed">
                        Integrated Pest Management (IPM) is a sustainable, science-based approach to managing pests by combining multiple strategies to minimize economic, health, and environmental risks.<br><br>
                    </p>
                        <!-- Prevention Section -->
                    <div class="space-y-6 grid grid-cols-2 gap-4">
                    <div class="bg-gray-800 m-5 p-5 rounded-2xl">
                        <strong>1. Prevention:</strong><br>
                        Prevention is the first line of defense in IPM. This involves:
                        <ul class="list-disc ml-5">
                            <li>Cultural Practices such as crop rotation, pest-resistant varieties, pest-free rootstock.</li>
                            <li>Habitat Management by removing pest habitats, using clean farming techniques, and healthy soil management.</li>
                        </ul>
                    </div>

                    <!-- Monitoring and Identification Section -->
                    <div class="bg-gray-800 m-5 p-5 rounded-2xl">
                        <strong>2. Monitoring and Identification:</strong><br>
                        Early detection and accurate pest identification are key to successful pest management. Use:
                        <ul class="list-disc ml-5">
                            <li>Visual Inspections</li>
                            <li>Sticky Traps</li>
                            <li>Light Traps</li>
                            <li>Record-keeping to track pest trends.</li>
                        </ul>
                    </div>

                    <!-- Setting Action Thresholds Section -->
                    <div class="bg-gray-800 m-5 p-5 rounded-2xl">
                        <strong>3. Setting Action Thresholds:</strong><br>
                        Action thresholds define the pest level at which control becomes necessary. This helps avoid unnecessary pesticide use and supports informed decisions.
                    </div>

                    <!-- Control Methods Section -->
                    <div class="bg-gray-800 m-5 p-5 rounded-2xl">
                        <strong>4. Control Methods:</strong><br>
                        Once the threshold is met, employ a combination of methods:
                        <ul class="list-disc ml-5">
                            <li><strong>Biological:</strong> Use of natural enemies like parasitoids and predators.</li>
                            <li><strong>Physical:</strong> Mulching, row covers, and traps.</li>
                            <li><strong>Chemical:</strong> Only when necessary and using targeted, low-toxicity pesticides.</li>
                        </ul>
                    </div>

                    <!-- Evaluation Section -->
                    <div class="bg-gray-800 m-5 p-5 rounded-2xl">
                        <strong>5. Evaluation:</strong><br>
                        Post-control assessment is vital. Monitor pest resurgence, evaluate crop recovery, and refine techniques.
                    </div>

                    <!-- Benefits of IPM Section -->
                    <div class="bg-gray-800 m-5 p-5 rounded-2xl">
                        <strong>Benefits of IPM:</strong>
                        <ul class="list-disc ml-5">
                            <li>Reduces pesticide use</li>
                            <li>Protects human and animal health</li>
                            <li>Encourages biodiversity</li>
                            <li>Increases cost-effectiveness of farming practices</li>
                        </ul>
                    </div>
                </div>
                    <p>
                        Learn more at official agriculture resources like <a href="https://www.epa.gov/ipm" class="text-yellow-400 underline">EPA’s IPM Guide</a> or <a href="https://www.usda.gov" class="text-yellow-400 underline">USDA</a>.
                    </p>
                </div>
            </section>

            <section class="bg-gray-700/90 m-10 rounded-2xl p-6 shadow-lg">
                    <div class="max-w-7xl mx-auto">
                    <h2 class="text-4xl font-bold mb-6 text-center">🌿 Sustainable Agricultural Practices</h2>
                    <p class="mb-4">
                        Sustainable agriculture aims to meet society's current food and textile needs without compromising the ability of future generations to meet their own needs. It integrates three main goals: environmental health, economic profitability, and social equity.
                    </p>
                
                    <p class="mb-4">
                        Sustainable farming methods protect the environment, expand the Earth's natural resource base, and maintain and improve soil fertility. The ultimate goal of sustainable agriculture is to preserve ecological balance while increasing agricultural productivity. As climate change and environmental degradation pose growing threats to global food security, it becomes essential to embrace agricultural practices that minimize harm and maximize benefits. Farmers, scientists, and policy makers are all integral to transforming our food systems for a sustainable future.
                    </p>
                
                    <div class="space-y-6 grid grid-cols-2 gap-4">
                        <div class="bg-gray-800 m-5 p-5 rounded-2xl">
                        <h3 class="text-2xl font-semibold ">1. Soil Health Management</h3>
                            <ul class="list-disc ml-5">
                             <li><strong>Cover Cropping:</strong> Planting cover crops like clover or rye to prevent soil erosion, enhance soil fertility, and suppress weeds.</li>
                             <li><strong>Crop Rotation:</strong> Alternating the types of crops grown in each field to break pest cycles and improve soil structure.</li>
                             <li><strong>Composting:</strong> Adding organic matter to soil to improve its nutrient content and water retention capabilities.</li>
                             <li><strong>Soil Testing:</strong> Regular analysis to monitor pH levels and nutrient content to guide precise fertilization strategies.</li>
                             <li><strong>Minimal Soil Disturbance:</strong> Reduces the risk of erosion and maintains the ecosystem of beneficial microorganisms.</li>
                            </ul>
                        </div>
                
                        <div class="bg-gray-800 m-5 p-5 rounded-2xl">
                        <h3 class="text-2xl font-semibold">2. Water Conservation Techniques</h3>
                        <ul class="list-disc ml-5">
                            <li><strong>Drip Irrigation:</strong> Delivering water directly to plant roots, reducing evaporation and water waste.</li>
                            <li><strong>Rainwater Harvesting:</strong> Collecting and storing rainwater for agricultural use during dry periods.</li>
                            <li><strong>Mulching:</strong> Applying a layer of material on the soil surface to retain moisture and regulate temperature.</li>
                            <li><strong>Smart Irrigation Systems:</strong> Using automated, sensor-based irrigation to ensure optimal water use.</li>
                        </ul>
                        </div>
                
                        <div class="bg-gray-800 m-5 p-5 rounded-2xl">
                        <h3 class="text-2xl font-semibold">3. Integrated Pest Management (IPM)</h3>
                        <ul class="list-disc ml-5">
                            <li><strong>Biological Controls:</strong> Using natural predators or parasites to manage pest populations.</li>
                            <li><strong>Mechanical Controls:</strong> Employing physical methods like traps or barriers to prevent pest access.</li>
                            <li><strong>Cultural Practices:</strong> Implementing crop rotation and intercropping to disrupt pest habitats.</li>
                            <li><strong>Monitoring & Thresholds:</strong> Observing pest populations to determine the necessity and timing of control measures.</li>
                            <li><strong>Chemical Controls:</strong> Applying pesticides as a last resort, using the least toxic options in a targeted way.</li>
                        </ul>
                        </div>
                
                        <div class="bg-gray-800 m-5 p-5 rounded-2xl">
                        <h3 class="text-2xl font-semibold">4. Agroforestry</h3>
                        <ul class="list-disc ml-5">
                            <li><strong>Alley Cropping:</strong> Planting rows of trees between crops to enhance biodiversity and protect against wind erosion.</li>
                            <li><strong>Silvopasture:</strong> Integrating trees, forage, and livestock to create a more diverse and productive land-use system.</li>
                            <li><strong>Windbreaks:</strong> Establishing tree lines to reduce wind speed and protect crops.</li>
                            <li><strong>Carbon Storage:</strong> Trees sequester atmospheric carbon dioxide, contributing to climate change mitigation.</li>
                        </ul>
                        </div>
                
                        <div class="bg-gray-800 m-5 p-5 rounded-2xl">
                        <h3 class="text-2xl font-semibold">5. Organic Farming</h3>
                        <ul class="list-disc ml-5">
                            <li><strong>Natural Fertilizers:</strong> Using compost, green manure, and bone meal instead of synthetic fertilizers.</li>
                            <li><strong>Biopesticides:</strong> Employing naturally derived substances to control pests and diseases.</li>
                            <li><strong>Non-GMO Seeds:</strong> Cultivating crops from seeds that have not been genetically modified.</li>
                            <li><strong>Certification Standards:</strong> Following organic certification guidelines for inputs and production methods.</li>
                        </ul>
                        </div>
                
                        <div class="bg-gray-800 m-5 p-5 rounded-2xl">
                        <h3 class="text-2xl font-semibold">6. Renewable Energy Integration</h3>
                        <ul class="list-disc ml-5">
                            <li><strong>Solar Panels:</strong> Harnessing solar energy to power farm operations and reduce reliance on fossil fuels.</li>
                            <li><strong>Wind Turbines:</strong> Utilizing wind energy for electricity generation on farms.</li>
                            <li><strong>Bioenergy:</strong> Producing energy from organic materials like crop residues and animal waste.</li>
                            <li><strong>Energy-Efficient Equipment:</strong> Reducing greenhouse gas emissions through improved technology and machinery.</li>
                        </ul>
                        </div>
                
                        <div class="bg-gray-800 m-5 p-5 rounded-2xl">
                        <h3 class="text-2xl font-semibold">7. Conservation Tillage</h3>
                        <ul class="list-disc ml-5">
                            <li><strong>No-Till Farming:</strong> Avoiding plowing to maintain soil structure and reduce erosion.</li>
                            <li><strong>Strip Tillage:</strong> Tilling only narrow strips where seeds are planted, leaving the rest of the field undisturbed.</li>
                            <li><strong>Mulch Tillage:</strong> Leaving crop residues on the field surface to protect soil.</li>
                        </ul>
                        </div>
                
                        <div class="bg-gray-800 m-5 p-5 rounded-2xl">
                        <h3 class="text-2xl font-semibold">8. Biodiversity Enhancement</h3>
                        <ul class="list-disc ml-5">
                            <li><strong>Polyculture:</strong> Growing multiple crop species in the same space to mimic natural ecosystems.</li>
                            <li><strong>Habitat Conservation:</strong> Preserving natural habitats around farm areas to support wildlife.</li>
                            <li><strong>Seed Banks:</strong> Maintaining a diverse collection of seeds to preserve genetic diversity.</li>
                            <li><strong>Pollinator Support:</strong> Creating environments favorable to bees, butterflies, and other pollinators.</li>
                        </ul>
                        </div>
                
                        <div class="bg-gray-800 m-5 p-5 rounded-2xl">
                        <h3 class="text-2xl font-semibold">9. Climate-Smart Agriculture</h3>
                        <ul class="list-disc ml-5">
                            <li><strong>Resilient Crop Varieties:</strong> Developing and planting crops that can withstand extreme weather conditions.</li>
                            <li><strong>Carbon Sequestration:</strong> Implementing practices that capture and store atmospheric carbon dioxide in soils.</li>
                            <li><strong>Efficient Resource Use:</strong> Optimizing the use of water, nutrients, and inputs to reduce environmental impact.</li>
                            <li><strong>Climate Forecasting:</strong> Utilizing weather prediction models to make informed planting and irrigation decisions.</li>
                        </ul>
                        </div>
                    </div>
                    </div>
                </section>
        </div>
    </main>

    <footer class="bg-gray-900 mt-5 w-full py-4 text-center">
        <p>© 2025 AgriGrow. All rights reserved</p>
    </footer>
</body>
</html>