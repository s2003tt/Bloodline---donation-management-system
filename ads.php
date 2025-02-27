<?php
require_once 'config.php';

// Fetch ads from database
$stmt = $pdo->query("SELECT * FROM ads ORDER BY created_at DESC");
$ads = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation & Operation Support Ads</title>
    <!-- cdnjs link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- box-icon link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:whitesmoke;
            margin: 0;
            
        }

        .container {
            max-width: 900px;
            margin:8% auto;
            background-color: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color:#3b6e72;
            
            background-repeat: no-repeat;
        }
        .create-ad-section h1{
            color:white;
            font-weight:bold;
        }
        .create-ad-section span{
            color:#800000;
            font-weight:bold;
        }

        .filter-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .filter-group {
            flex: 1;
            margin-right: 15px;
        }

        .filter-group label {
            display: block;
            margin-bottom: 5px;
        }

        .filter-group input,
        .filter-group select {
            width: 70%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .ad-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .ad-card {
            background-color: rgb(211, 208, 208);
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .ad-card:hover {
            transform: scale(1.05);
        }

        .ad-card h3 {
            margin-top: 0;
            color: #333;
        }

        .ad-card .ad-type {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.8em;
            margin-bottom: 10px;
        }

        .ad-card .ad-type.blood {
            background-color: #ff4d4d;
            color: white;
        }

        .ad-card .ad-type.operation {
            background-color: #4d79ff;
            color: white;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border-radius: 8px;
            max-width: 500px;
            position: relative;
        }

        .close-btn {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close-btn:hover {
            color: black;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #970310;
            padding: 5px 30px;
            position: fixed;
            width:100%;
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
            gap: 10px;
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

    <div class="container">

        <div class="create-ad-section"
            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h1><span>Blood  </span>Donation & Operation Support Ads</h1>
            <button onclick="window.location.href='create_ad.php'" style="
        background-color: #ff4d4d;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.3s ease;
    " onmouseover="this.style.backgroundColor='#ff6b6b'" onmouseout="this.style.backgroundColor='#ff4d4d'">
                + Create New Ad
            </button>
        </div>

        <div class="filter-section">
            <div class="filter-group">
                <label for="cityFilter">Filter by City:</label>
                <input type="text" id="cityFilter" placeholder="Enter city">
            </div>
            <div class="filter-group">
                <label for="adTypeFilter">Filter by Ad Type:</label>
                <select id="adTypeFilter">
                    <option value="">All Types</option>
                    <option value="blood">Blood Donation</option>
                    <option value="operation">Operation Support</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="bloodGroupFilter">Filter by Blood Group:</label>
                <select id="bloodGroupFilter">
                    <option value="">All Blood Groups</option>
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
        </div>

        <div id="adList" class="ad-list">
            <?php foreach ($ads as $ad): ?>
                <div class="ad-card" data-city="<?php echo htmlspecialchars($ad['city']); ?>"
                    data-ad-type="<?php echo htmlspecialchars($ad['ad_type']); ?>"
                    data-blood-group="<?php echo htmlspecialchars($ad['blood_group']); ?>"
                    onclick="showAdDetails(<?php echo htmlspecialchars(json_encode($ad)); ?>)">
                    <span class="ad-type <?php echo $ad['ad_type']; ?>">
                        <?php echo ucfirst($ad['ad_type']); ?>
                    </span>
                    <h3><?php echo htmlspecialchars($ad['name']); ?></h3>
                    <p><strong>City:</strong> <?php echo htmlspecialchars($ad['city']); ?></p>
                    <?php if (!empty($ad['blood_group'])): ?>
                        <p><strong>Blood Group:</strong> <?php echo htmlspecialchars($ad['blood_group']); ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div id="adDetailsModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <div id="modalAdDetails" class="modal-ad-details"></div>
        </div>
    </div>

    <div id="chatbot-widget">
        <div id="chatbot-icon">
            <i class="fas fa-comment-dots"></i>
        </div>
        <div id="chatbot-popup">
            <div id="chatbot-header">
                <span>Bloodline Support</span>
                <button id="close-chatbot"
                    style="background:none; border:none; color:white; font-size:20px;">&times;</button>
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
        document.addEventListener('DOMContentLoaded', function () {
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
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
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
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
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
        function showAdDetails(ad) {
            const modal = document.getElementById('adDetailsModal');
            const modalDetails = document.getElementById('modalAdDetails');

            modalDetails.innerHTML = `
                <h2>Ad Details</h2>
                <p><strong>Name:</strong> ${ad.name}</p>
                <p><strong>City:</strong> ${ad.city}</p>
                <p><strong>Contact:</strong> ${ad.contact}</p>
                <p><strong>Ad Type:</strong> ${ad.ad_type === 'blood' ? 'Blood Donation' : 'Operation Support'}</p>
                ${ad.blood_group ? `<p><strong>Blood Group:</strong> ${ad.blood_group}</p>` : ''}
                <p><strong>Description:</strong> ${ad.description}</p>
            `;

            modal.style.display = 'block';
        }

        document.querySelector('.close-btn').addEventListener('click', () => {
            document.getElementById('adDetailsModal').style.display = 'none';
        });

        window.addEventListener('click', (event) => {
            const modal = document.getElementById('adDetailsModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });



        // Filter functionality
        document.getElementById('cityFilter').addEventListener('input', filterAds);
        document.getElementById('adTypeFilter').addEventListener('change', filterAds);
        document.getElementById('bloodGroupFilter').addEventListener('change', filterAds);

        function filterAds() {
            const cityFilter = document.getElementById('cityFilter').value.toLowerCase();
            const adTypeFilter = document.getElementById('adTypeFilter').value;
            const bloodGroupFilter = document.getElementById('bloodGroupFilter').value;

            const ads = document.querySelectorAll('.ad-card');

            ads.forEach(ad => {
                const adCity = ad.getAttribute('data-city').toLowerCase();
                const adType = ad.getAttribute('data-ad-type');
                const adBloodGroup = ad.getAttribute('data-blood-group');

                const cityMatch = adCity.includes(cityFilter);
                const typeMatch = adTypeFilter === '' || adType === adTypeFilter;
                const bloodGroupMatch = bloodGroupFilter === '' || adBloodGroup === bloodGroupFilter;

                if (cityMatch && typeMatch && bloodGroupMatch) {
                    ad.style.display = 'block';
                } else {
                    ad.style.display = 'none';
                }
            });
        }
    </script>
</body>

</html>