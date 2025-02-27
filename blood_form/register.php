<?php
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
    $dob = filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_STRING);
    $blood_group = filter_input(INPUT_POST, 'blood_group', FILTER_SANITIZE_STRING);
    $weight = filter_input(INPUT_POST, 'weight', FILTER_VALIDATE_FLOAT);
    $province = filter_input(INPUT_POST, 'province', FILTER_SANITIZE_STRING);
    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $contact = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    $pincode = filter_input(INPUT_POST, 'pincode', FILTER_SANITIZE_STRING);

    // Validation checks
    $errors = [];

    if (empty($name)) $errors[] = "Name is required";
    if (empty($gender)) $errors[] = "Gender is required";
    if (empty($dob)) $errors[] = "Date of Birth is required";
    if (empty($blood_group)) $errors[] = "Blood Group is required";
    if ($weight <= 0) $errors[] = "Invalid Weight";
    if (empty($email)) $errors[] = "Invalid Email";
    if (empty($contact)) $errors[] = "Contact Number is required";

    if (empty($errors)) {
        try {
            // Generate Unique Registration Number
            $reg_number = 'BLD' . date('Ym') . rand(1000, 9999);

            // Prepare SQL statement
            $stmt = $pdo->prepare("
                INSERT INTO donors (
                    unique_registration_number, 
                    full_name, 
                    gender, 
                    date_of_birth, 
                    blood_group, 
                    body_weight, 
                    email, 
                    contact_number, 
                    full_address, 
                    city, 
                    province, 
                    pincode
                ) VALUES (
                    :reg_number, 
                    :name, 
                    :gender, 
                    :dob, 
                    :blood_group, 
                    :weight, 
                    :email, 
                    :contact, 
                    :address, 
                    :city, 
                    :province, 
                    :pincode
                )
            ");

            // Bind parameters
            $stmt->bindParam(':reg_number', $reg_number);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':dob', $dob);
            $stmt->bindParam(':blood_group', $blood_group);
            $stmt->bindParam(':weight', $weight);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':contact', $contact);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':province', $province);
            $stmt->bindParam(':pincode', $pincode);

            // Execute the statement
            $stmt->execute();

            // Redirect with success message
            header("Location: registration_success.php?reg_number=" . $reg_number);
            exit();

        } catch(PDOException $e) {
            $errors[] = "Registration failed: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>BloodLine Registration and Search</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        /* General Page Styling */
body {
    background: white; /* Modern light gradient */
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    color: #333;
    overflow-x: hidden;
}

/* Title Styling */
h2.main-title {
    text-align: center;
    font-size: 42px;
    font-weight: bold;
    color:rgb(88, 5, 13);
    margin: 30px 0;
    text-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
    letter-spacing: 1px;
}

/* Glassmorphism Background for Form */
form.blood-form {
    width: 60%;
    max-width: 700px;
    margin: 40px auto;
    padding: 30px;
    background: rgba(252, 252, 252, 0.2); /* Glass-like transparency */
    backdrop-filter: blur(10px); /* Blur effect */
    border: 1px solid rgba(248, 2, 2, 0.97);
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(1, 2, 73, 0.95);
    color: white;
    animation: fadeIn 1.2s ease-in-out;
}
.form_input input{
    width: 95%;
}
.form_input textarea{
    width: 95%;
}
 
/* Form Title */
form h2.form-title {
    text-align: center;
    font-size: 32px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #970310;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
}

/* Label Styling */
form label {
    font-size: 16px;
    font-weight: 500;
    margin-bottom: 8px;
    display: block;
    color: #0e0101cc; /* Semi-transparent white */
}

/* Input Fields and Dropdowns */
form input,
form select,
form textarea {
    width: 98%;
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid rgba(255, 255, 255, 0.5);
    border-radius: 12px;
    font-size: 16px;
    background: rgba(255, 255, 255, 0.3); /* Glassy effect */
    backdrop-filter: blur(8px);
    color: #101213;
    box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease-in-out;
}



form input:focus,
form select:focus,
form textarea:focus {
    outline: none;
    transform: scale(1.02);
    border-color: #ff5252;
    box-shadow: 0 4px 10px rgba(255, 82, 82, 0.3);
}

/* Buttons */
form button.submit-button {
    width: 100%;
    padding: 15px;
    font-size: 18px;
    font-weight: bold;
    border: none;
    border-radius: 30px;
    background: linear-gradient(135deg, #b91627, #ff5252);
    color: white;
    cursor: pointer;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease-in-out;
}

form button.submit-button:hover {
    transform: translateY(-5px) scale(1.05);
    background: linear-gradient(135deg, #ff5252, #b91627);
}

/* Search Bar Styling */
.search-container {
    text-align: center;
    margin: 40px auto;
    padding: 10px;
}

.search-bar-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 15px;
}

.search-bar {
    width: 600px;
    padding: 15px;
    font-size: 18px;
    border: none;
    border-radius: 30px;
    background: rgba(199, 164, 164, 0.3);
    backdrop-filter: blur(8px);
    box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.1);
    color: #333;
    transition: all 0.3s ease;
}

.search-bar:focus {
    outline: none;
    transform: scale(1.05);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}

.search-button {
    padding: 12px 25px;
    font-size: 18px;
    font-weight: bold;
    border: none;
    border-radius: 30px;
    background: linear-gradient(135deg, #b91627, #ff5252);
    color: white;
    cursor: pointer;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
}

.search-button:hover {
    transform: translateY(-3px) scale(1.05);
    background: linear-gradient(135deg, #ff5252, #b91627);
}

/* Placeholder Styling */
::placeholder {
    color: rgba(110, 109, 109, 0.7);
    font-style: italic;
}
/* Button Container */
.button-container {
    text-align: center;
    margin-top: 20px;
}

/* Button Styling */
.button-container .submit-button {
    width: 30%;
    padding: 15px;
    font-size: 18px;
    font-weight: bold;
    border: none;
    border-radius: 30px;
    background: linear-gradient(135deg,rgb(1, 80, 1),rgb(20, 153, 42));
    color: white;
    cursor: pointer;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease-in-out;
}

.button-container .submit-button:hover {
    transform: translateY(-5px) scale(1.05);
   
}

/* Responsive Design */
@media (max-width: 768px) {
    form.blood-form {
        width: 90%;
    }

    .search-bar {
        width: 80%;
    }

    form h2.form-title {
        font-size: 26px;
    }

    form button.submit-button {
        font-size: 16px;
    }
}

/* Animations */
@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translateY(-20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #970310;
    padding: 5px 30px;
    position: sticky;
    top: 0;
    z-index: 1000;
    box-shadow: 0 5px 5px rgba(0, 0, 0, 0.3);
}

.logo-container img {
    height: auto;
    width: 80px;
    border-radius: 50%;
    filter: drop-shadow(2px 2px 2px rgba(0, 2, 4, 0.9));
}

/* navbar */
.nav-links {
    display: flex;
    gap:10px;
}

.nav-links .logout-btn a {
    font-size: 14px;
    margin: 25px 0px 0px -110px;
    color: rgb(125, 125, 235);
    font-weight: bold;
}

.nav-links .logout-btn a:hover {
    color: rgb(255, 0, 0);
    text-decoration: underline;
}

.navbar a {
    color: #ffffff;
    text-decoration: none;
    font-size: 18px;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: color 0.3s;
    padding-right: 60px;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.8);
}

.navbar a:hover {
    color: rgb(0, 0, 0);
}

.navbar i {
    font-size: 16px;
}



/* Scroll Smooth */
body {
    scroll-behavior: smooth;
}

    </style>
</head>

<nav class="navbar">
        <div class="logo-container">
            <img src="../images/logo.jpg" alt="Bloodline Logo">
        </div>
        <div class="nav-links">
            <a href="../index.php" id="nav-home">Home</a>
            <a href="../blood_form/donors_summary.php"  id="nav-home">FindBlood</a>
            <a href="../emergency_service.php"  id="nav-home">Emergency service</a>
            <a href="../channeling.php"  id="nav-home">Doctor Chaneling</a>
            <a href="../index.php#aboutUs" id="nav-about">About</a>
            <a href="../contactus.php" id="nav-contact">Contact Us</a>
            <a href="#" id="nav-user">
                <i class="fas fa-user"></i>
                <div class="logout-btn">
                    <a href="login/logout.php">Logout</a>
                </div>
            </a>
        </div>
    
    </nav>
<body class="page-background">

    <!-- Search Section -->
    <div class="search-container">
        <label for="search-bar" class="search-label">Search Donor Database:</label>
        <div class="search-bar-wrapper">
            <input type="text" id="search-bar" name="search_query" placeholder="Search by name or ID..." class="search-bar">
            <button type="button" class="search-button" onclick="performSearch()">Search</button>
        </div>
    </div>

    <div class="button-container">
    <a href="donors_summary.php">
        <button class="submit-button">View Donors Summary</button>
    </a>
</div>

    <!-- Page Title -->
    <h2 class="main-title">BloodLine Registration Portal</h2>

    <!-- BloodLine Registration Form -->
    <form action="register.php" method="POST" class="blood-form" id="bloodForm">
        <h2 class="form-title">Register as a Donor</h2>

        <div class="form_input">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" placeholder="Enter your full name" required>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="" disabled selected>Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>

        <label for="dob">D.O.B (YYYY-MM-DD):</label>
        <input type="date" id="dob" name="dob" required>

        <label for="blood_group">Blood Group:</label>
        <select id="blood_group" name="blood_group" required>
            <option value="" disabled selected>Select Blood Group</option>
            <option value="A+">A+</option>
            <option value="B+">B+</option>
            <option value="O+">O+</option>
            <option value="AB+">AB+</option>
            <option value="A-">A-</option>
            <option value="B-">B-</option>
            <option value="O-">O-</option>
            <option value="AB-">AB-</option>
        </select>

        <label for="weight">Body Weight (Kg):</label>
        <input type="number" id="weight" name="weight" placeholder="Enter weight in kg" required>

        <label for="province">Province:</label>
        <select id="province" name="province" required>
            <option value="" disabled selected>Select Province</option>
            <option value="Western">Western</option>
            <option value="Central">Central</option>
            <option value="Southern">Southern</option>
            <option value="North-Western">North-Western</option>
            <option value="Sabaragamuva">Sabaragamuva</option>
            <option value="Northern">Northern</option>
            <option value="Eastern">Eastern</option>
            <option value="Uva">Uva</option>
            <option value="North-Central">North-Central</option>
        </select>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" placeholder="Enter city" required>

        <label for="email">Email ID:</label>
        <input type="email" id="email" name="email" placeholder="Enter email address" required>

        <label for="contact">Contact No:</label>
        <input type="text" id="contact" name="contact" placeholder="Enter contact number" pattern="\d{10}" title="Enter a valid 10-digit number" required>

        <label for="address">Full Address:</label>
        <textarea id="address" name="address" placeholder="Enter your full address" required></textarea>

        <label for="pincode">Pincode:</label>
        <input type="text" id="pincode" name="pincode" placeholder="Enter pincode" pattern="\d{5,6}" title="Enter a valid 5 or 6-digit pincode" required>
        </div>

        <button type="submit" class="submit-button">Register</button>
    </form>

    <div class="button-container">
    <a href="donors_summary.php">
        <button class="submit-button">View Donors Summary</button>
    </a>
</div>

<div id="chatbot-widget">
    <div id="chatbot-icon">
        <i class="fas fa-comment-dots"></i>
    </div>
    <div id="chatbot-popup">
        <div id="chatbot-header">
            <span>Bloodline Support</span>
            <button id="close-chatbot" style="background:none; border:none; color:white; font-size:20px;">&times;</button>
        </div>
        <div id="chatbot-messages"></div>
        <div class="quick-buttons">
            <button class="quick-btn" data-topic="Blood Donation">Blood Donation</button>
            <button class="quick-btn" data-topic="Emergency">Emergency Services</button>
            <button class="quick-btn" data-topic="Eligibility">Donor Eligibility</button>
        </div>
        <div id="chatbot-input-container">
            <input type="text" id="chatbot-input" placeholder="Type your question...">
            <button class="quick-btn" data-topic="default" id="chatbot-send">Send</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Comprehensive Knowledge Base
    const knowledgeBase = {
        "blood donation": [
            "Blood donation is a simple, life-saving process where healthy individuals voluntarily give blood.",
            "Donors must be 18-65 years old, weigh at least 50 kg, and be in good health.",
            "You can donate whole blood every 3 months.",
            "The entire donation process takes about 10-15 minutes.",
            "Different blood types are always in need: A+, B+, O+, AB+, and their negative counterparts."
        ],
        "emergency": [
            "Our 24/7 emergency blood service is designed to provide immediate blood assistance.",
            "Call our emergency hotline at +94 33 22 79824 for urgent blood requirements.",
            "We coordinate rapidly with local blood banks and donors for critical situations.",
            "Priority is given to life-threatening medical emergencies."
        ],
        "eligibility": [
            "Must be between 18-65 years old",
            "Minimum weight of 50 kg",
            "No history of serious medical conditions",
            "Not pregnant or breastfeeding",
            "No recent tattoos or piercings",
            "No active infections or communicable diseases"
        ],
        "default": [
            "I'm here to help! Ask me about blood donation, emergency services, or donor eligibility.",
            "Need quick information? Try our quick buttons or type your specific question."
        ]
    };

    // DOM Elements
    const chatbotIcon = document.getElementById('chatbot-icon');
    const chatbotPopup = document.getElementById('chatbot-popup');
    const closeChatbot = document.getElementById('close-chatbot');
    const chatbotMessages = document.getElementById('chatbot-messages');
    const chatbotInput = document.getElementById('chatbot-input');
    const chatbotSend = document.getElementById('chatbot-send');
    const quickButtons = document.querySelectorAll('.quick-btn');

    // Toggle Chatbot
    chatbotIcon.addEventListener('click', () => {
        chatbotPopup.style.display = 
            chatbotPopup.style.display === 'none' ? 'flex' : 'flex';
    });

    // Close Chatbot
    closeChatbot.addEventListener('click', () => {
        chatbotPopup.style.display = 'none';
    });

    // Add Message to Chat
    function addMessage(message, type) {
        const messageElement = document.createElement('div');
        messageElement.classList.add('message', type);
        messageElement.textContent = message;
        chatbotMessages.appendChild(messageElement);
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
    }

    // Get Bot Response
    function getBotResponse(userMessage) {
        const lowerMessage = userMessage.toLowerCase();
        
        // Check specific topics
        for (const [topic, responses] of Object.entries(knowledgeBase)) {
            if (lowerMessage.includes(topic)) {
                return responses[Math.floor(Math.random() * responses.length)];
            }
        }

        // Default response
        return knowledgeBase.default[Math.floor(Math.random() * knowledgeBase.default.length)];
    }

    // Send Message
    function sendMessage() {
        const message = chatbotInput.value.trim();
        if (message) {
            addMessage(message, 'user- message');
            const botResponse = getBotResponse(message);
            setTimeout(() => addMessage(botResponse, 'bot-message'), 500);
            chatbotInput.value = '';
        }
    }

    // Event Listeners
    chatbotSend.addEventListener('click', sendMessage);
    chatbotInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') sendMessage();
    });

    // Quick Buttons Functionality
    quickButtons.forEach(button => {
        button.addEventListener('click', () => {
            const topic = button.getAttribute('data-topic').toLowerCase();
            const response = knowledgeBase[topic][Math.floor(Math.random() * knowledgeBase[topic].length)];
            addMessage(response, 'bot-message');
        });
    });
});
</script>

<style>
/* Chatbot Widget Styles */
#chatbot-widget {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
    }

    #chatbot-icon {
        width: 60px;
        height: 60px;
        background-color: #d9534f;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: 0 4px 6px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
    }

    #chatbot-icon i {
        color: white;
        font-size: 24px;
    }

    #chatbot-popup {
        position: fixed;
        bottom: 90px;
        right: 20px;
        width: 350px;
        height: 500px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.2);
        display: none;
        flex-direction: column;
        z-index: 1001;
    }

    #chatbot-header {
        background-color: #d9534f;
        color: white;
        padding: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    #chatbot-messages {
        flex-grow: 1;
        overflow-y: auto;
        padding: 15px;
        background-color: #f9f9f9;
    }

    .message {
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 8px;
        max-width: 80%;
        clear: both;
    }

    .bot-message {
        background-color: #e6f2ff;
        color: #333;
        float: left;
    }

    .user-message {
        background-color: #d9534f;
        color: white;
        float: right;
    }

    #chatbot-input-container {
        display: flex;
        padding: 15px;
        background-color: white;
        border-top: 1px solid #eee;
    }

    #chatbot-input {
        flex-grow: 1;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    #chatbot-send {
        background-color: #d9534f;
        color: white;
        border: none;
        padding: 10px 15px;
        margin-left: 10px;
        border-radius: 5px;
        cursor: pointer;
    }

    .quick-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        padding: 0 15px 15px;
    }

    .quick-btn {
        background-color: #f0f0f0;
        border: none;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        cursor: pointer;
    }

</style>

<br><br>

    <script>
        function performSearch() {
    const query = document.getElementById("search-bar").value.trim();
    if (query) {
        alert(`Searching for: ${query}`);
    } else {
        alert("Please enter a search term.");
    }
}

document.getElementById("bloodForm").addEventListener("submit", (e) => {
    alert("Thank you for registering!");
});
    </script>
</body>
</html>
