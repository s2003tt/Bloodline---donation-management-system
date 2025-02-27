<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
    $contact = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $adType = filter_input(INPUT_POST, 'adType', FILTER_SANITIZE_STRING);
    $bloodGroup = filter_input(INPUT_POST, 'bloodGroup', FILTER_SANITIZE_STRING);

    // Validate required fields
    if (empty($name) || empty($city) || empty($contact) || empty($description) || empty($adType)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required']);
        exit;
    }

    try {
        // Prepare SQL statement
        $stmt = $pdo->prepare("INSERT INTO ads (name, city, contact, description, ad_type, blood_group) VALUES (?, ?, ?, ?, ?, ?)");
        
        // Execute statement
        $result = $stmt->execute([$name, $city, $contact, $description, $adType, $bloodGroup]);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Ad created successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to create ad']);
        }
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation & Operation Support Ad Upload</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- box-icon link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script defer src="script.js"></script>

    
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background: white;
    margin: 0;
    padding: 0;
    /* display: flex; */
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.container {
    background-color: #3b6e72;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 750px;
    padding: 30px;
    margin: 20px;
    background-size: 100% 100%; 
    background-repeat: no-repeat;
}

h1 {
    text-align: center;
    color: white;
    font-weight:bold;
    margin-bottom: 30px;
    font-weight: 300;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 8px;
    color: black;
    font-weight:700;
}

input, 
textarea, 
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    transition: border-color 0.3s ease;
}

input:focus, 
textarea:focus, 
select:focus {
    outline: none;
    border-color: #4CAF50;
}

.submit-btn {
    width: 100%;
    padding: 12px;
    background-color:#970310;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.submit-btn:hover {
    background-color: black;
}

.message-box {
    margin-top: 20px;
    text-align: center;
}

.success-message {
    background-color: #dff0d8;
    color: #3c763d;
    padding: 15px;
    border-radius: 5px;
}

.error-message {
    background-color: #f2dede;
    color: #a94442;
    padding: 15px;
    border-radius: 5px;
}

.success-message a {
    color: #007bff;
    text-decoration: none;
    margin-left: 10px;
}
.page-navigation {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .nav-btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #2196F3;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        .nav-btn:hover {
            background-color: #1976D2;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .nav-btn i {
            margin-right: 8px;
        }

        /* Responsive adjustments */
        @media screen and (max-width: 600px) {
            .page-navigation {
                justify-content: center;
            }
        }

/* Responsive Design */
@media screen and (max-width: 600px) {
    .container {
        width: 90%;
        padding: 20px;
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
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="logo-container">
            <img src="images/logo.jpg" alt="Bloodline Logo">
        </div>
        <div class="nav-links">
            <a href="index.php" id="nav-home">Home</a>
            <a href="blood_form/donors_summary.php"  id="nav-home">FindBlood</a>
            <a href="emergency_service.php"  id="nav-home">Emergency service</a>
            <a href="channeling.php"  id="nav-home">Doctor Chaneling</a>
            <a href="index.php#aboutUs" id="nav-about">About</a>
            <a href="contactus.php" id="nav-contact">Contact Us</a>
            <a href="#" id="nav-user">
                <i class="fas fa-user"></i>
                <div class="logout-btn">
                    <a href="login/logout.php">Logout</a>
                </div>
            </a>
        </div>
    
    </nav>

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
    .footer {
    background-color: #f4f4f4;
    color: #333;
    padding: 50px 0 20px;
    font-family: Arial, sans-serif;
}

.footer-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

.footer-section {
    flex: 1;
    margin: 10px;
    min-width: 250px;
}

.footer-logo img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
}

.footer-logo h3 {
    display: inline-block;
    margin-left: 10px;
    color: #d9534f;
}

.footer-section h4 {
    color: #d9534f;
    border-bottom: 2px solid #d9534f;
    padding-bottom: 10px;
    margin-bottom: 15px;
}

.footer-section ul {
    list-style: none;
    padding: 0;
}

.footer-section ul li {
    margin-bottom: 10px;
}

.footer-section ul li a {
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-section ul li a:hover {
    color: #d9534f;
}

.contact-info p {
    margin-bottom: 10px;
}

.contact-info i {
    margin-right: 10px;
    color: #d9534f;
}

.social-links {
    display: flex;
    gap: 15px;
}

.social-icon {
    color: #fff;
    background-color: #d9534f;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.3s ease;
}

.social-icon:hover {
    background-color: #a33;
}

.footer-bottom {
    text-align: center;
    padding-top: 20px;
    border-top: 1px solid #ddd;
    margin-top: 20px;
}

@media (max-width: 768px) {
    .footer-container {
        flex-direction: column;
    }
    
    .footer-section {
        margin-bottom: 20px;
    }
}


</style>




    <div class="container">
        <h1>Blood Donation & Operation Support Ad Upload</h1>

        <div class="page-navigation">
            <a href="ads.php" class="nav-btn view-ads-btn">
                <i class="fas fa-list"></i> View All Ads
            </a>
        </div>

        <form id="adUploadForm">
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" required>
            </div>

            <div class="form-group">
                <label for="contact">Contact Number:</label>
                <input type="tel" id="contact" name="contact" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="5" required></textarea>
            </div>

            <div class="form-group">
                <label for="adType">Ad Type:</label>
                <select id="adType" name="adType">
                    <option value="blood">Blood Donation</option>
                    <option value="operation">Operation Support</option>
                </select>
            </div>

            <div class="form-group">
                <label for="bloodGroup">Blood Group (if applicable):</label>
                <select id="bloodGroup" name="bloodGroup">
                    <option value="">Select Blood Group</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                </select>
            </div>

            <button type="submit" class="submit-btn">Create Ad</button>
        </form>
    </div>

    <div id="messageBox" class="message-box"></div>

    <footer class="footer">
    <div class="footer-container">
        <div class="footer-section">
            <div class="footer-logo">
                <img src="images/logo.jpg" alt="Bloodline Logo">
                <h3>Blood<span>L</span>ine</h3>
            </div>
            <p>Saving lives through compassionate blood donation and community support.</p>
        </div>

        <div class="footer-section">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="blood_form/donors_summary.php">Find Blood</a></li>
                <li><a href="emergency_service.php">Emergency Service</a></li>
                <li><a href="channeling.php">Doctor Channeling</a></li>
                <li><a href="#aboutUs">About Us</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4>Contact Information</h4>
            <div class="contact-info">
                <p><i class="fas fa-map-marker-alt"></i> No. 123, Main Street, Colombo, Sri Lanka</p>
                <p><i class="fas fa-phone"></i> +94 33 22 79824</p>
                <p><i class="fas fa-envelope"></i> info@bloodline.com</p>
            </div>
        </div>

        <div class="footer-section">
            <h4>Follow Us</h4>
            <div class="social-links">
                <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2024 Bloodline. All Rights Reserved. | Designed with ❤️ by Tech Team</p>
    </div>
</footer>


    

    <script>
    document.getElementById('adUploadForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Create FormData object
        const formData = new FormData(this);

        // Send form data via AJAX
        fetch('create_ad.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            const messageBox = document.getElementById('messageBox');
            
            if (data.success) {
                messageBox.innerHTML = `
                    <div class="success-message">
                        ${data.message}
                        <a href="ads.php">View Ads</a>
                    </div>
                `;
                
                // Reset form
                this.reset();
            } else {
                messageBox.innerHTML = `
                    <div class="error-message">
                        ${data.message}
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
    </script>
</body>
</html>