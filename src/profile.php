<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriGrow - Profile Setup</title>
    <link href="./output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    <style>
        /* Animation Styles */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fadeIn {
            animation: fadeIn 0.5s ease-out forwards;
        }
        
        .profile-pic {
            transition: all 0.3s ease;
            object-fit: cover;
        }
        
        .profile-pic:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(74, 222, 128, 0.3);
        }
        
        .input-field {
            transition: all 0.3s ease;
            background-color: rgba(31, 41, 55, 0.5);
        }
        
        .input-field:focus {
            background-color: rgba(31, 41, 55, 0.8);
            box-shadow: 0 0 0 2px #4ade80;
        }
        
        .save-btn {
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #4ade80, #3b82f6);
            background-size: 200% 200%;
        }
        
        .save-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(74, 222, 128, 0.4);
            background-position: right center;
        }
        
        /* Profile sections */
        .profile-create {
            display: block;
        }
        
        .profile-view {
            display: none;
        }
        
        /* Image upload styles */
        .image-upload-container {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto 20px;
        }
        
        .image-upload-preview {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #4ade80;
            display: none;
        }
        
        .image-upload-placeholder {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: #374151;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px dashed #4ade80;
            cursor: pointer;
        }
        
        .image-upload-input {
            display: none;
        }
        
        .image-upload-icon {
            font-size: 2rem;
            color: #4ade80;
        }
        
        .header-profile-img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body class="font-mono bg-gray-950 text-white min-h-screen flex flex-col">

    <!-- Header -->
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

    <!-- Profile Content -->
    <main class="flex-grow container mx-auto px-4 py-8 max-w-5xl">
        <!-- Create Profile Section (Visible by default) -->
        <div class="profile-create w-full max-w-2xl mx-auto">
            <div class="bg-gray-900/50 rounded-xl shadow-lg p-8 border border-lime-500/30">
                <div class="text-center mb-8">
                    <!-- Profile Picture Upload -->
                     
                    <h1 class="text-3xl font-bold mb-2">Complete Your Profile</h1>
                    <p class="text-gray-400">Set up your profile to get personalized farming recommendations</p>
                </div>
                
                <form id="create-profile-form" class="space-y-6" method="POST" action="create_profile.php">
                    <div>
                        <label class="block text-gray-400 mb-2">Full Name</label>
                        <input type="text" name="name" required class="input-field w-full px-4 py-3 rounded-lg border border-gray-700 focus:outline-none">
                    </div>
                    
                    <div>
                        <label class="block text-gray-400 mb-2">Email Address</label>
                        <input type="email" name="email" required class="input-field w-full px-4 py-3 rounded-lg border border-gray-700 focus:outline-none">
                    </div>
                    
                    <div>
                        <label class="block text-gray-400 mb-2">Farm Name</label>
                        <input type="text" name="farm_name" required class="input-field w-full px-4 py-3 rounded-lg border border-gray-700 focus:outline-none">
                    </div>
                    
                    <div>
                        <label class="block text-gray-400 mb-2">Farm Size (acres)</label>
                        <input type="number" name="farm_size" required class="input-field w-full px-4 py-3 rounded-lg border border-gray-700 focus:outline-none">
                    </div>
                    
                    <div>
                        <label class="block text-gray-400 mb-2">Location</label>
                        <input type="text" name="location" required class="input-field w-full px-4 py-3 rounded-lg border border-gray-700 focus:outline-none">
                    </div>
                    
                    <div class="pt-4">
                        <button type="submit" name="submit" class="save-btn w-full px-6 py-3 rounded-lg font-bold text-white text-lg">
                            Complete Profile
                        </button>
                    </div>
                    <?php
                    echo $message;
                    ?>
                </form>
            </div>
        </div>

        <!-- View Profile Section (Hidden by default) -->
        <div class="profile-view w-full" style="display: none;">
            <!-- Profile Header -->
            <div class="bg-gray-900/50 rounded-xl shadow-lg overflow-hidden border border-gray-800 mb-8">
                <div class="relative">
                    <!-- Cover Photo -->
                    <div class="h-40 bg-gradient-to-r from-gray-800 to-gray-900 w-full"></div>
                    
                    <!-- Profile Picture and Basic Info -->
                    <div class="flex flex-col md:flex-row items-start px-6 pb-6 -mt-16">
                        <div class="relative group">
                            <img id="profile-display-image" class="profile-pic w-32 h-32 rounded-full border-4 border-gray-900">
                            <button id="change-profile-pic" class="absolute bottom-2 right-2 bg-lime-500 hover:bg-lime-600 p-2 rounded-full transition-all opacity-0 group-hover:opacity-100">
                                <i class="fas fa-camera text-white text-sm"></i>
                            </button>
                            <input type="file" id="profile-image-update" class="hidden" accept="image/*">
                        </div>
                        
                        <div class="md:ml-6 mt-4 md:mt-0 w-full">
                            <div class="flex flex-col md:flex-row md:items-end justify-between">
                                <div>
                                    <h1 id="profile-name" class="text-3xl font-bold">John Farmer</h1>
                                    <p id="profile-email" class="text-gray-400">john@agrigrow.com</p>
                                </div>
                                <div class="mt-3 md:mt-0">
                                    <span class="inline-block bg-lime-500/20 text-lime-400 px-3 py-1 rounded-full text-sm font-medium">Premium Member</span>
                                </div>
                            </div>
                            
                            <!-- Edit Button -->
                            <div class="flex gap-3 mt-4">
                                <button id="edit-profile-btn" class="save-btn px-4 py-2 rounded-lg font-medium text-white">
                                    <i class="fas fa-edit mr-2"></i>Edit Profile
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Personal Info -->
                <div class="bg-gray-900/50 rounded-xl p-6 border border-gray-800">
                    <h2 class="text-xl font-bold mb-4 pb-2 border-b border-gray-800">Personal Information</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm text-gray-400 mb-1">Full Name</label>
                            <p id="view-fullname" class="font-medium">John Farmer</p>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400 mb-1">Email</label>
                            <p id="view-email" class="font-medium">john@agrigrow.com</p>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400 mb-1">Location</label>
                            <p id="view-location" class="font-medium">California, USA</p>
                        </div>
                    </div>
                </div>
                
                <!-- Farm Info -->
                <div class="bg-gray-900/50 rounded-xl p-6 border border-gray-800">
                    <h2 class="text-xl font-bold mb-4 pb-2 border-b border-gray-800">Farm Information</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm text-gray-400 mb-1">Farm Name</label>
                            <p id="view-farmname" class="font-medium">Green Valley Farms</p>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400 mb-1">Farm Size</label>
                            <p id="view-farmsize" class="font-medium">50 acres</p>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400 mb-1">Primary Crops</label>
                            <p id="view-crops" class="font-medium">Wheat, Corn, Soybeans</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 mt-10 w-full">
        <div class="flex justify-center items-center py-4">
            <p>© 2023 AgriGrow. All rights reserved</p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Check if profile exists
            const profileExists = localStorage.getItem('agrigrow_profile_created');
            
            // If profile exists, show view mode immediately
            if (profileExists) {
                showProfileView();
                
                // Load saved profile data
                const profileData = JSON.parse(localStorage.getItem('agrigrow_profile_data'));
                if (profileData) {
                    updateProfileDisplay(profileData);
                    
                    // Load profile image if exists
                    const savedImage = localStorage.getItem('agrigrow_profile_image');
                    if (savedImage) {
                        updateProfileImages(savedImage);
                    }
                }
            }
            
            // Profile dropdown toggle
            const profileBtn = document.getElementById('profile-btn');
            const profileDropdown = document.getElementById('profile-dropdown');
            
            profileBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                profileDropdown.classList.toggle('hidden');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', () => {
                profileDropdown.classList.add('hidden');
            });
            
            // Image upload functionality
            const imageUpload = document.getElementById('profile-image-upload');
            const uploadTrigger = document.getElementById('upload-trigger');
            const profilePreview = document.getElementById('profile-preview');
            
            uploadTrigger.addEventListener('click', () => {
                imageUpload.click();
            });
            
            imageUpload.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (event) => {
                        profilePreview.src = event.target.result;
                        profilePreview.style.display = 'block';
                        uploadTrigger.style.display = 'none';
                    };
                    reader.readAsDataURL(file);
                }
            });
            
            // Change profile picture in view mode
            const changeProfilePic = document.getElementById('change-profile-pic');
            const profileImageUpdate = document.getElementById('profile-image-update');
            
            changeProfilePic.addEventListener('click', () => {
                profileImageUpdate.click();
            });
            
            profileImageUpdate.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (event) => {
                        const imageUrl = event.target.result;
                        updateProfileImages(imageUrl);
                        localStorage.setItem('agrigrow_profile_image', imageUrl);
                    };
                    reader.readAsDataURL(file);
                }
            });
            
            // Create profile form submission
            const createForm = document.getElementById('create-profile-form');
            if (createForm) {
                createForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    
                    // Get form values
                    const formData = {
                        name: createForm.querySelector('input[type="text"]').value,
                        email: createForm.querySelector('input[type="email"]').value,
                        farmName: createForm.querySelectorAll('input[type="text"]')[1].value,
                        farmSize: createForm.querySelector('input[type="number"]').value,
                        location: createForm.querySelectorAll('input[type="text"]')[2].value
                    };
                    
                    // Save profile image if uploaded
                    if (profilePreview.src && profilePreview.src !== '') {
                        localStorage.setItem('agrigrow_profile_image', profilePreview.src);
                    }
                    
                    // Save profile data
                    localStorage.setItem('agrigrow_profile_created', 'true');
                    localStorage.setItem('agrigrow_profile_data', JSON.stringify(formData));
                    
                    // Switch to view mode
                    showProfileView();
                    updateProfileDisplay(formData);
                    
                    // Update profile images
                    if (profilePreview.src && profilePreview.src !== '') {
                        updateProfileImages(profilePreview.src);
                    }
                });
            }
            
            // Edit profile button
            const editBtn = document.getElementById('edit-profile-btn');
            if (editBtn) {
                editBtn.addEventListener('click', () => {
                    // Switch back to create mode (which will act as edit mode)
                    document.querySelector('.profile-create').style.display = 'block';
                    document.querySelector('.profile-view').style.display = 'none';
                    
                    // Load existing data into the form
                    const profileData = JSON.parse(localStorage.getItem('agrigrow_profile_data'));
                    if (profileData) {
                        const inputs = document.querySelectorAll('#create-profile-form input');
                        inputs[0].value = profileData.name;
                        inputs[1].value = profileData.email;
                        inputs[2].value = profileData.farmName;
                        inputs[3].value = profileData.farmSize;
                        inputs[4].value = profileData.location;
                    }
                    
                    // Load existing image if exists
                    const savedImage = localStorage.getItem('agrigrow_profile_image');
                    if (savedImage) {
                        profilePreview.src = savedImage;
                        profilePreview.style.display = 'block';
                        uploadTrigger.style.display = 'none';
                    }
                });
            }
            
            function showProfileView() {
                document.querySelector('.profile-create').style.display = 'none';
                document.querySelector('.profile-view').style.display = 'block';
            }
            
            function updateProfileDisplay(data) {
                document.getElementById('profile-name').textContent = data.name;
                document.getElementById('profile-email').textContent = data.email;
                document.getElementById('view-fullname').textContent = data.name;
                document.getElementById('view-email').textContent = data.email;
                document.getElementById('view-location').textContent = data.location;
                document.getElementById('view-farmname').textContent = data.farmName;
                document.getElementById('view-farmsize').textContent = data.farmSize + ' acres';
            }
            
            function updateProfileImages(imageUrl) {
                // Update main profile image
                document.getElementById('profile-display-image').src = imageUrl;
                
                // Update header profile image
                const headerProfilePic = document.getElementById('header-profile-pic');
                headerProfilePic.innerHTML = <img src="${imageUrl}" class="header-profile-img">;
            }
        });
    </script>
</body>
</html>