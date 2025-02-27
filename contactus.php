<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Bloodline</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
        }

        /* Contact Page Container */
        .contact-container {
            width: 90%;
            max-width: 1200px;
            margin: 50px auto;
            display: flex;
            flex-wrap: wrap;
            background-color: white;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        /* Contact Info Section */
        .contact-info {
            flex: 1;
            background-color: #8c3839;
            color: white;
            padding: 40px;
            min-width: 300px;
        }

        .contact-info h2 {
            margin-bottom: 20px;
            border-bottom: 2px solid white;
            padding-bottom: 10px;
        }

        .contact-details {
            margin-bottom: 30px;
        }

        .contact-details .detail {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .contact-details .detail i {
            font-size: 24px;
            margin-right: 15px;
            width: 40px;
        }

        /* Health Centers Section */
        .health-centers {
            margin-top: 30px;
        }

        .health-center {
            background-color: rgba(255,255,255,0.1);
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .health-center h3 {
            margin-bottom: 10px;
            color: white;
        }

        .health-center p {
            color: #f0f0f0;
        }

        /* Contact Form Section */
        .contact-form {
            flex: 1;
            padding: 40px;
            background-color: #f9f9f9;
            min-width: 300px;
        }

        .contact-form h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-group textarea {
            height: 150px;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #d9534f;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #a33;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .contact-container {
                flex-direction: column;
            }
        }

        /* Google Maps Embed */
        .map-container {
            width: 100%;
            height: 400px;
            margin-top: 30px;
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }
        /* Navbar Styling */
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

    <div class="contact-container">
        <!-- Contact Info Section -->
        <div class="contact-info">
            <h2>Contact Information</h2>
            
            <div class="contact-details">
                <div class="detail">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <h3>Address</h3>
                        <p>No. 123, Main Street, Colombo, Sri Lanka</p>
                    </div>
                </div>
                
                <div class="detail">
                    <i class="fas fa-phone"></i>
                    <div>
                        <h3>Phone</h3>
                        <p>+94 33 22 79824</p>
                    </div>
                </div>
                
                <div class="detail">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <h3>Email</h3>
                        <p>info@bloodline.com</p>
                    </div>
                </div>
            </div>

            <!-- Health Centers Section -->
            <div class="health-centers">
                <h2>Our Health Service Centers</h2>
                
                <div class="health-center">
                    <h3>Colombo Central Blood Bank</h3>
                    <p>Phone: +94 11 234 5678</p>
                    <p>Location: Colombo 02</p>
                </div>
                
                <div class="health-center">
                    <h3>Kandy Regional Blood Center</h3>
                    <p>Phone: +94 81 123 4567</p>
                    <p>Location: Kandy City</p>
                </div>
                
                <div class="health-center">
                    <h3>Galle District Blood Bank</h3>
                    <p>Phone: +94 91 987 6543</p>
                    <p>Location: Galle Town</p>
                </div>
            </div>
        </div>

        

        <!-- Contact Form Section -->
        <div class="contact-form">
            <h2>Send Us a Message</h2>
            <form action="submit_contact.php" method="POST">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone">
                </div>
                
                <div class="form-group">
                    <label for="message">Your Message</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                
                <button type="submit" class="submit-btn">Send Message</button>
            </form>

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

            <!-- Google Maps Embed -->
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.7816621044!2d79.84992857457256!3d6.927306493096525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s ```html
!1s0x3ae25c1c1c1c1c1c%3A0x3ae25c1c1c1c1c1c!2sNo.%20123%2C%20Main%20Street%2C%20Colombo%2C%20Sri%20Lanka!5e0!3m2!1sen!2slk!4v1616161616161!5m2!1sen!2slk" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </div>
</body>
</html>