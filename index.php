<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloodline</title>
    <link rel="stylesheet" href="style.css">
    <!-- cdnjs link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- box-icon link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script defer src="script.js"></script>
<style>
    .slider{
    width: 1000px;
    max-width: 100vw;
    height: 500px;
    margin: auto;
    position: relative;
    overflow: hidden;
}
.slider .list{
    position: absolute;
    width: max-content;
    height: 100%;
    left: 0;
    top: 0;
    display: flex;
    transition: 1s;
}
.slider .list img{
    width: 100%;
    max-width: 100vw;
    height: 100%;
    object-fit: cover;
}
.slider .buttons{
    position: absolute;
    top: 45%;
    left: 5%;
    width: 90%;
    display: flex;
    justify-content: space-between;
}
.slider .buttons button{
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: #fff5;
    color: #fff;
    border: none;
    font-family: monospace;
    font-weight: bold;
}
.slider .dots{
    position: absolute;
    bottom: 10px;
    left: 0;
    color: #fff;
    width: 100%;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
}
.slider .dots li{
    list-style: none;
    width: 10px;
    height: 10px;
    background-color: #fff;
    margin: 10px;
    border-radius: 20px;
    transition: 0.5s;
}
.slider .dots li.active{
    width: 30px;
}
@media screen and (max-width: 768px){
    .slider{
        height: 400px;
    }
}
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
            <a href="channeling.php" id="nav-home">Doctor Chaneling</a>
            <a href="#aboutUs" id="nav-about">About</a>
            <a href="contactus.php" id="nav-contact">Contact Us</a>
            <a href="login/index-L&S.php" id="nav-user">
                <i class="fas fa-user"></i>
                <div class="logout-btn">
                    <a href="login/logout.php">Logout</a>
                </div>
            </a>
        </div>
    
    </nav>

    <!-- Home Section -->
    <div id="home" class="page-sectiona">

        <div class="home-images">
            <img src="images/home-img.png" alt="Blood Donation 1">
            <div class="siteHead">
                <h1>Welcome to Blood<span>L</span>ine</h1>
            </div>
            <p>"Save lives. Every donation makes a difference. Schedule your appointment today and join the community of compassionate blood donors."</p>

        </div>

    </div>
    <hr style="width:80%;text-align:center;color:gray;font-weight:700; margin-top:20px;">
    <div class="bloodDonar-Link">

        <div class="sinhala">
            <p>මෙම Link එක වෙත පිවිසීමෙන් ඔබට රුධිර පරිත්‍යාගශීලියෙකු ලෙස ලියාපදිංචි විය හැක.</p>
        </div>
        <div class="tamil">
            <p>இந்த இணைப்பைப் பார்வையிடுவதன் மூலம் நீங்கள் இரத்த தானம் செய்பவராக பதிவு செய்யலாம்.</p>
        </div>
        <div class="english">
            <p>You can register as a blood donor by visiting this link.</p>
        </div>
        <img src="images/blood-packet.png">
        <a href="blood_form/register.php" class="form-btn">Fill Now<i class='bx bx-right-arrow-alt arrow'></i></a>

    </div>
    <hr style="width:80%;text-align:center;color:black;font-weight:bold; margin-top:20px;">

    <!-- Sliding Banner Section -->
<div class="slider">
        <div class="list">
            <div class="item">
                <img src="images/b1.jpg" alt="">
            </div>
            <div class="item">
                <img src="images/b2.jpg" alt="">
            </div>
            <div class="item">
                <img src="images/b3.jpg" alt="">
            </div>
            <div class="item">
                <img src="images/b1.jpg" alt="">
            </div>
            <div class="item">
                <img src="images/b1.jpg" alt="">
            </div>
        </div>
        <div class="buttons">
            <button id="prev"><</button>
            <button id="next">></button>
        </div>
        <ul class="dots">
            <li class="active"></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>

    <hr style="width:80%;text-align:center;color:gray;font-weight:700; margin-top:20px;">
    <div class="bloodDonar-Link">
    <h1>Notices</h1>
        <div class="sinhala">
            <p>රුධිර පරිත්යාග සහ ශල්යකර්ම සහාය</p>
        </div>
        <div class="tamil">
            <p>இரத்த தானம் மற்றும் அறுவை சிகிச்சை ஆதரவு</p>
        </div>
        <div class="english">
            <p>Blood Donation & Operation Support</p>
        </div>
        <img src="images/Blood Bank logo 2022-03.png">
        <a href="ads.php" class="form-btn">Donations<i class='bx bx-right-arrow-alt arrow'></i></a>

    </div>
    <hr style="width:80%;text-align:center;color:black;font-weight:bold; margin-top:20px;">


    <!-- About Us Section -->
    <a name="aboutUs"></a>
    <div id="about" class="about-section">

        <h2>About Us</h2>

        <p>We are a passionate community dedicated to saving lives through the power of blood donation. Our mission is
            to bridge the gap between those in need of blood and willing donors. We believe that every drop of blood
            donated has the potential to make a profound difference in someone's life.<br><br>

            Through our user-friendly platform, we connect individuals seeking blood with potential donors, facilitate
            blood drives, and raise awareness about the importance of regular blood donations. We strive to create a
            seamless and rewarding experience for both donors and recipients, ensuring a consistent and reliable supply
            of blood for those who need it most.<br><br>

            Join us in this vital mission to save lives. Donate blood, spread awareness, and together, let's build a
            healthier and stronger community.<br><br>

            <span>>> Mission: Clearly states the organization's core purpose.</span><br>
            <span> >> Values: Highlights the importance of community and saving lives.</span><br>
            <span> >> Impact: Emphasizes the positive impact of blood donation.</span><br>
            <span> >> Call to action: Encourages visitors to take action.</span>
        </p>

    </div>



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

<!-- Chatbot Widget HTML -->
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

<script>
let slider = document.querySelector('.slider .list');
let items = document.querySelectorAll('.slider .list .item');
let next = document.getElementById('next');
let prev = document.getElementById('prev');
let dots = document.querySelectorAll('.slider .dots li');

let lengthItems = items.length - 1;
let active = 0;
next.onclick = function(){
    active = active + 1 <= lengthItems ? active + 1 : 0;
    reloadSlider();
}
prev.onclick = function(){
    active = active - 1 >= 0 ? active - 1 : lengthItems;
    reloadSlider();
}
let refreshInterval = setInterval(()=> {next.click()}, 3000);
function reloadSlider(){
    slider.style.left = -items[active].offsetLeft + 'px';
    // 
    let last_active_dot = document.querySelector('.slider .dots li.active');
    last_active_dot.classList.remove('active');
    dots[active].classList.add('active');

    clearInterval(refreshInterval);
    refreshInterval = setInterval(()=> {next.click()}, 3000);

    
}

dots.forEach((li, key) => {
    li.addEventListener('click', ()=>{
         active = key;
         reloadSlider();
    })
})
window.onresize = function(event) {
    reloadSlider();
};


</script>
</body>
</html>