<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "crop");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get email from login session
$email = $_SESSION['user_email'] ?? '';
$profileData = null;
$isEditing = isset($_GET['edit']) && $_GET['edit'] === 'true';
$message = '';

// Fetch user profile data
$sql = "SELECT * FROM farmer_profiles WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $profileData = $result->fetch_assoc();
    $_SESSION['has_profile'] = true;
} else {
    $_SESSION['has_profile'] = false;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $farm_name = $_POST['farm_name'] ?? '';
    $farm_size = $_POST['farm_size'] ?? '';
    $location = $_POST['location'] ?? '';
    
    // Handle image upload for both new profile and profile update
    $profile_image = null;
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $profile_image = file_get_contents($_FILES['profile_image']['tmp_name']);
    }
    
    if ($profileData) {
        // Update existing profile
        if ($profile_image !== null) {
            $sql = "UPDATE farmer_profiles SET name=?, farm_name=?, farm_size=?, location=?, profile_image=? WHERE email=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdsbs", $name, $farm_name, $farm_size, $location, $profile_image, $email);
        } else {
            $sql = "UPDATE farmer_profiles SET name=?, farm_name=?, farm_size=?, location=? WHERE email=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdss", $name, $farm_name, $farm_size, $location, $email);
        }
    } else {
        // Create new profile
        if ($profile_image !== null) {
            $sql = "INSERT INTO farmer_profiles (name, email, farm_name, farm_size, location, profile_image) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssdss", $name, $email, $farm_name, $farm_size, $location, $profile_image);
        } else {
            $sql = "INSERT INTO farmer_profiles (name, email, farm_name, farm_size, location) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssds", $name, $email, $farm_name, $farm_size, $location);
        }
    }
    
    if ($stmt->execute()) {
        $_SESSION['has_profile'] = true;
        header("Location: profile.php");
        exit();
    } else {
        $message = "Error: " . $conn->error;
    }
}

// Handle profile image upload separately
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
    $profile_image = file_get_contents($_FILES['profile_image']['tmp_name']);
    $sql = "UPDATE farmer_profiles SET profile_image=? WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("bs", $profile_image, $email);
    if ($stmt->execute()) {
        header("Location: profile.php");
        exit();
    }
}

// Function to get profile image
function getProfileImage($profileData) {
    if (isset($profileData['profile_image']) && $profileData['profile_image']) {
        return 'data:image/jpeg;base64,' . base64_encode($profileData['profile_image']);
    }
    return '../photos/home/default-profile.png';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - AgriGrow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .profile-section {
            transition: all 0.3s ease;
        }
        .profile-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        .input-field {
            transition: all 0.3s ease;
        }
        .input-field:focus {
            box-shadow: 0 0 0 2px #4ade80;
        }
        .btn-primary {
            background: linear-gradient(135deg, #4ade80, #3b82f6);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(74, 222, 128, 0.4);
        }
    </style>
</head>
<body class="bg-gray-900 text-white min-h-screen">
    <!-- Header -->
    <header class=" pt-3 pb-3 flex justify-between items-center bg-gray-950 h-15 sticky z-20 border-b-2 border-b-gray-900 top-0 pl-3 pr-3">
        <div class="flex gap-2 items-center">
            <a href="./homePage.php" class="flex items-center gap-2">
                <img src="../photos/home/logo.png" alt="logo" class="h-10 w-10 rounded-full">
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
            <div class="flex items-center gap-2">
                <button id="menu-btn" class="p-2 hover:bg-gray-800 rounded-lg transition-colors flex items-center gap-2">
                    <span class="text-white"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                    <i class="fa-solid fa-caret-down text-white text-sm"></i>
                </button>
                
                <div id="profile-menu" class="hidden absolute right-0 mt-10 w-48 bg-gray-800 rounded-lg shadow-xl py-2">
                    <span class="block px-4 py-2 text-gray-400 cursor-default"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                    <a href="./logout.php" class="block px-4 py-2 text-white hover:bg-gray-700">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        <?php if ($message): ?>
            <div class="mb-6 p-4 bg-red-500/20 border border-red-500 rounded-lg text-red-400">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if ($_SESSION['has_profile'] && !$isEditing): ?>
            <!-- Profile View -->
            <div class="max-w-4xl mx-auto">
                <form method="POST" enctype="multipart/form-data" id="profile-image-form" class="hidden">
                    <input type="file" name="profile_image" id="profile_image" accept="image/*" class="hidden" onchange="handleImageUpload()">
                </form>
                <!-- Profile Header -->
                <div class="bg-gray-800 rounded-xl shadow-xl overflow-hidden mb-8">
                    <div class="relative">
                        <!-- Cover Photo -->
                        <div class="h-40 bg-gradient-to-r from-gray-800 to-gray-900 w-full"></div>
                        
                        <!-- Profile Picture and Basic Info -->
                        <div class="flex flex-col md:flex-row items-start px-6 pb-6 -mt-16">
                            <div class="relative group">
                                <form method="POST" enctype="multipart/form-data" id="profile-image-form">
                                    <img src="<?php echo getProfileImage($profileData); ?>" alt="Profile" class="w-32 h-32 rounded-full border-4 border-gray-900 object-cover">
                                    <label for="profile_image" class="absolute bottom-2 right-2 bg-lime-500 hover:bg-lime-600 p-2 rounded-full transition-all opacity-0 group-hover:opacity-100 cursor-pointer">
                                        <i class="fas fa-camera text-white text-sm"></i>
                                    </label>
                                    <input type="file" name="profile_image" id="profile_image" accept="image/*" class="hidden" onchange="handleImageUpload(this)">
                                </form>
                            </div>
                            
                            <div class="md:ml-6 mt-4 md:mt-0 w-full">
                                <div class="flex flex-col md:flex-row md:items-end justify-between">
                                    <div>
                                        <h1 class="text-3xl font-bold"><?php echo htmlspecialchars($profileData['name']); ?></h1>
                                        <p class="text-gray-400"><?php echo htmlspecialchars($profileData['email']); ?></p>
                                    </div>
                                    <div class="mt-3 md:mt-0">
                                        <span class="inline-block bg-lime-500/20 text-lime-400 px-3 py-1 rounded-full text-sm font-medium">Farmer</span>
                                    </div>
                                </div>
                                
                                <!-- Edit Button -->
                                <div class="flex gap-3 mt-4">
                                    <a href="?edit=true" class="btn-primary px-4 py-2 rounded-lg font-medium text-white">
                                        <i class="fas fa-edit mr-2"></i>Edit Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Personal Info -->
                    <div class="bg-gray-800 rounded-xl p-6 border border-gray-700 profile-section">
                        <h2 class="text-xl font-bold mb-4 pb-2 border-b border-gray-700">Personal Information</h2>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm text-gray-400 mb-1">Full Name</label>
                                <p class="font-medium"><?php echo htmlspecialchars($profileData['name']); ?></p>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-400 mb-1">Email</label>
                                <p class="font-medium"><?php echo htmlspecialchars($profileData['email']); ?></p>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-400 mb-1">Location</label>
                                <p class="font-medium"><?php echo htmlspecialchars($profileData['location']); ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Farm Info -->
                    <div class="bg-gray-800 rounded-xl p-6 border border-gray-700 profile-section">
                        <h2 class="text-xl font-bold mb-4 pb-2 border-b border-gray-700">Farm Information</h2>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm text-gray-400 mb-1">Farm Name</label>
                                <p class="font-medium"><?php echo htmlspecialchars($profileData['farm_name']); ?></p>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-400 mb-1">Farm Size</label>
                                <p class="font-medium"><?php echo htmlspecialchars($profileData['farm_size']); ?> acres</p>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-400 mb-1">Member Since</label>
                                <p class="font-medium"><?php echo date('F j, Y', strtotime($profileData['created_at'])); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- Profile Form -->
            <div class="max-w-2xl mx-auto">
                <div class="bg-gray-800 rounded-xl shadow-xl p-8 border border-gray-700">
                    <div class="text-center mb-8">
                        <h1 class="text-3xl font-bold mb-2"><?php echo $profileData ? 'Edit Your Profile' : 'Complete Your Profile'; ?></h1>
                        <p class="text-gray-400"><?php echo $profileData ? 'Update your profile information' : 'Set up your profile to get personalized farming recommendations'; ?></p>
                    </div>
                    
                    <form method="POST" class="space-y-6" enctype="multipart/form-data">
                        <div class="text-center mb-6">
                            <div class="relative inline-block">
                                <img src="<?php echo $profileData ? getProfileImage($profileData) : '../photos/home/default-profile.png'; ?>" 
                                     alt="Profile" 
                                     class="w-32 h-32 rounded-full border-4 border-gray-700 object-cover mx-auto mb-4" 
                                     id="profile-preview">
                                <label for="profile_image" class="absolute bottom-2 right-2 bg-lime-500 hover:bg-lime-600 p-2 rounded-full transition-all cursor-pointer">
                                    <i class="fas fa-camera text-white text-sm"></i>
                                </label>
                            </div>
                            <input type="file" name="profile_image" id="profile_image" accept="image/*" class="hidden" onchange="previewImage(this)">
                        </div>

                        <div>
                            <label class="block text-gray-400 mb-2">Full Name</label>
                            <input type="text" name="name" value="<?php echo $profileData ? htmlspecialchars($profileData['name']) : htmlspecialchars($_SESSION['user_name']); ?>" 
                                   class="input-field w-full bg-gray-700 text-white rounded-lg px-4 py-3 border border-gray-600 focus:outline-none focus:border-lime-500" required>
                        </div>
                        
                        <div>
                            <label class="block text-gray-400 mb-2">Farm Name</label>
                            <input type="text" name="farm_name" value="<?php echo $profileData ? htmlspecialchars($profileData['farm_name']) : ''; ?>" 
                                   class="input-field w-full bg-gray-700 text-white rounded-lg px-4 py-3 border border-gray-600 focus:outline-none focus:border-lime-500" required>
                        </div>
                        
                        <div>
                            <label class="block text-gray-400 mb-2">Farm Size (acres)</label>
                            <input type="number" name="farm_size" value="<?php echo $profileData ? htmlspecialchars($profileData['farm_size']) : ''; ?>" 
                                   class="input-field w-full bg-gray-700 text-white rounded-lg px-4 py-3 border border-gray-600 focus:outline-none focus:border-lime-500" required>
                        </div>
                        
                        <div>
                            <label class="block text-gray-400 mb-2">Location</label>
                            <input type="text" name="location" value="<?php echo $profileData ? htmlspecialchars($profileData['location']) : ''; ?>" 
                                   class="input-field w-full bg-gray-700 text-white rounded-lg px-4 py-3 border border-gray-600 focus:outline-none focus:border-lime-500" required>
                        </div>
                        
                        <div class="flex justify-end gap-4">
                            <?php if ($profileData): ?>
                                <a href="profile.php" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">Cancel</a>
                            <?php endif; ?>
                            <button type="submit" class="btn-primary px-6 py-3 rounded-lg font-bold text-white">
                                <?php echo $profileData ? 'Update Profile' : 'Create Profile'; ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script>
        // Profile dropdown toggle
        const menuBtn = document.getElementById('menu-btn');
        const profileMenu = document.getElementById('profile-menu');
        
        menuBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            profileMenu.classList.toggle('hidden');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', () => {
            profileMenu.classList.add('hidden');
        });

        // Image preview functionality
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Update the preview image
                    const previewImg = document.getElementById('profile-preview');
                    if (previewImg) {
                        previewImg.src = e.target.result;
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>