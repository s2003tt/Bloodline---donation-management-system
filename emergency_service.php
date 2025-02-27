<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emergency Service - Bloodline</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script defer src="script.js"></script>
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

    <!-- Emergency Service Section -->
    <div id="emergency-service" class="page-section">
        <h2>Emergency Blood Donation Service</h2>
        <p>In timeone you know requires immediate blood assiss of urgent need, our emergency blood donation service is here to help. If you or sometance, please follow the steps below:</p>
        
        <h3>How to Request Emergency Blood</h3>
        <ol>
            <li>Contact our emergency hotline at <strong>+94 33 22 79824</strong>.</li>
            <li>Provide details about the blood type required and the urgency of the situation.</li>
            <li>Our team will coordinate with nearby blood donors and blood banks to fulfill your request.</li>
        </ol>

        <h3>Emergency Blood Donation Locations</h3>
        <p>We have partnered with various hospitals and blood banks to ensure a quick response. Below are some of the locations:</p>
        <ul>
            <li>City Hospital - +94 33 22 12345</li>
            <li>General Blood Bank - +94 33 22 67890</li>
            <li>Community Health Center - +94 33 22 54321</li>
        </ul>

        <h3>Important Notes</h3>
        <ul>
            <li>Always carry your ID and any relevant medical documents when visiting a blood donation center.</li>
            <li>Ensure to inform the medical staff about any allergies or medical conditions.</li>
            <li>Stay hydrated and have a light meal before donating blood.</li>
        </ul>

        <h3>Join Us in Saving Lives</h3>
        <p>Your contribution can make a significant difference. If you are a healthy individual, consider registering as a blood donor to help those in need.</p>
        <a href="blood_form/register.php" class="form-btn">Register as a Donor<i class='bx bx-right-arrow-alt arrow'></i></a>
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

    <!-- Footer Section -->
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

<!-- Add this CSS in your existing <style> tag or in a separate CSS file -->
<style>
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
</body>

</html>