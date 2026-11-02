<!-- FOOTER -->
<footer style="background-color: #1a1f2b; color: #a0a5b1; padding: 60px 0 20px; font-size: 0.9rem; border-top: 1px solid rgba(0,255,255,0.1);">
    <div class="container">
        <div class="row g-4 mb-5">
            <!-- Column 1: Services -->
            <div class="col-lg-4 col-md-6">
                <h5 class="text-white fw-bold mb-4" style="letter-spacing: 1px; font-size: 1rem;">OUR SERVICES</h5>
                <ul class="list-unstyled" style="line-height: 2.2;">
                    <li><a href="#" class="text-decoration-none text-muted" style="transition:0.3s;" onmouseover="this.style.color='#00ffff'" onmouseout="this.style.color='#6c757d'"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem; margin-right:8px;"></i> Air Freight</a></li>
                    <li><a href="#" class="text-decoration-none text-muted" style="transition:0.3s;" onmouseover="this.style.color='#00ffff'" onmouseout="this.style.color='#6c757d'"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem; margin-right:8px;"></i> Sea Freight</a></li>
                    <li><a href="#" class="text-decoration-none text-muted" style="transition:0.3s;" onmouseover="this.style.color='#00ffff'" onmouseout="this.style.color='#6c757d'"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem; margin-right:8px;"></i> Road Freight</a></li>
                    <li><a href="#" class="text-decoration-none text-muted" style="transition:0.3s;" onmouseover="this.style.color='#00ffff'" onmouseout="this.style.color='#6c757d'"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem; margin-right:8px;"></i> Warehousing</a></li>
                    <li><a href="#" class="text-decoration-none text-muted" style="transition:0.3s;" onmouseover="this.style.color='#00ffff'" onmouseout="this.style.color='#6c757d'"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem; margin-right:8px;"></i> Drone Delivery <span class="badge bg-info text-dark" style="font-size: 0.6em;">AI</span></a></li>
                    <li><a href="#" class="text-decoration-none text-muted" style="transition:0.3s;" onmouseover="this.style.color='#00ffff'" onmouseout="this.style.color='#6c757d'"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem; margin-right:8px;"></i> Smart Lockers</a></li>
                    <li><a href="#" class="text-decoration-none text-muted" style="transition:0.3s;" onmouseover="this.style.color='#00ffff'" onmouseout="this.style.color='#6c757d'"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem; margin-right:8px;"></i> Crowd Shipping</a></li>
                </ul>
            </div>

            <!-- Column 2: Site Map -->
            <div class="col-lg-4 col-md-6">
                <h5 class="text-white fw-bold mb-4" style="letter-spacing: 1px; font-size: 1rem;">SITE MAP</h5>
                <ul class="list-unstyled" style="line-height: 2.2;">
                    <?php $base = (in_array(basename($_SERVER['PHP_SELF']), ['index.php', 'login.php', 'register.php'])) ? '' : '../'; ?>
                    <li><a href="<?php echo $base; ?>index.php" class="text-decoration-none text-muted" style="transition:0.3s;" onmouseover="this.style.color='#00ffff'" onmouseout="this.style.color='#6c757d'"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem; margin-right:8px;"></i> Home</a></li>
                    <li><a href="<?php echo $base; ?>pages/services.php" class="text-decoration-none text-muted" style="transition:0.3s;" onmouseover="this.style.color='#00ffff'" onmouseout="this.style.color='#6c757d'"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem; margin-right:8px;"></i> Services</a></li>
                    <li><a href="<?php echo $base; ?>pages/about.php" class="text-decoration-none text-muted" style="transition:0.3s;" onmouseover="this.style.color='#00ffff'" onmouseout="this.style.color='#6c757d'"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem; margin-right:8px;"></i> About Us</a></li>
                    <li><a href="<?php echo $base; ?>pages/contact.php" class="text-decoration-none text-muted" style="transition:0.3s;" onmouseover="this.style.color='#00ffff'" onmouseout="this.style.color='#6c757d'"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem; margin-right:8px;"></i> Contact us</a></li>
                    <li><a href="<?php echo $base; ?>pages/tracking.php" class="text-decoration-none text-muted" style="transition:0.3s;" onmouseover="this.style.color='#00ffff'" onmouseout="this.style.color='#6c757d'"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem; margin-right:8px;"></i> Track Your Shipment</a></li>
                    <li><a href="<?php echo $base; ?>pages/intercome.php" class="text-decoration-none text-muted" style="transition:0.3s;" onmouseover="this.style.color='#00ffff'" onmouseout="this.style.color='#6c757d'"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem; margin-right:8px;"></i> Incoterms Learning</a></li>
                    <li><a href="#" class="text-decoration-none text-muted" style="transition:0.3s;" onmouseover="this.style.color='#00ffff'" onmouseout="this.style.color='#6c757d'"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem; margin-right:8px;"></i> Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Column 3: Connect With Us -->
            <div class="col-lg-4 col-md-12">
                <h5 class="text-white fw-bold mb-4" style="letter-spacing: 1px; font-size: 1rem;">CONNECT WITH US</h5>
                <ul class="list-unstyled" style="line-height: 2.2;">
                    <li class="d-flex align-items-start mb-3">
                        <i class="fa-solid fa-location-dot mt-1 me-3" style="color:#6c757d; width: 15px;"></i>
                        <span class="text-muted">124 Main Boulevard, DHA Phase 6, Karachi, Pakistan.</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="fa-solid fa-envelope me-3" style="color:#6c757d; width: 15px;"></i>
                        <a href="mailto:shipping@parcelpulselogistics.com" class="text-decoration-none" style="color: #ff6a00; transition:0.3s;" onmouseover="this.style.color='#ff8833'" onmouseout="this.style.color='#ff6a00'">shipping@parcelpulselogistics.com</a>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="fa-solid fa-clock me-3" style="color:#6c757d; width: 15px;"></i>
                        <span class="text-muted">8:00AM - 12:00PM | 2:00PM - 4:00PM</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <hr style="border-color: rgba(255,255,255,0.1); margin-bottom: 20px;">
        
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0 text-muted" style="font-size: 0.8rem;">Copyright © 2012-2026 Parcel Pulse Logistics. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<!-- FLOATING AI ASSISTANT -->
<div class="floating-ai-btn" id="openChatBtn" title="AI Assistant">
    <i class="fa-solid fa-robot"></i>
</div>

<!-- AI Chatbot Window -->
<div class="ai-chat-window" id="aiChatWindow">
    <div class="chat-header">
        <div>
            <i class="fa-solid fa-robot text-info"></i> Pulse AI <span class="badge bg-success" style="font-size: 0.6rem; vertical-align: middle;">Online</span>
        </div>
        <button class="btn-close btn-close-white" id="closeChatBtn" style="font-size: 0.8rem;"></button>
    </div>
    
    <div class="chat-body" id="chatBody">
        <div class="chat-message bot">
            Hello! I am The Neural Core. I can help you track parcels, get quotes, or explain shipping terms. How can I assist you today?
        </div>
        <div class="chat-chips mt-2">
            <span class="chip" onclick="sendChipMessage('Track my parcel')">Track my parcel</span>
            <span class="chip" onclick="sendChipMessage('Get a quote')">Get a quote</span>
            <span class="chip" onclick="sendChipMessage('Are there any delays?')">Are there any delays?</span>
        </div>
    </div>
    
    <div class="chat-footer">
        <div class="input-group">
            <button class="btn text-info border-0" id="chatVoiceBtn" title="Speak">
                <i class="fa-solid fa-microphone"></i>
            </button>
            <input type="text" id="chatInput" class="form-control shadow-none bg-transparent text-light border-0" placeholder="Type a message...">
            <button class="btn text-info border-0" id="sendChatBtn">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </div>
    </div>
</div>

<style>
/* AI Chatbot Glassmorphism Styles */
.floating-ai-btn {
    position: fixed;
    bottom: 30px;
    right: 30px;
    background: linear-gradient(45deg, #00d2ff, #3a7bd5);
    color: white;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1.8rem;
    cursor: pointer;
    box-shadow: 0 0 20px rgba(0, 210, 255, 0.5);
    z-index: 1050;
    transition: all 0.3s ease;
    animation: bounceBot 2s infinite;
}
.floating-ai-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 0 30px rgba(0, 210, 255, 0.8);
}
@keyframes bounceBot {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.ai-chat-window {
    position: fixed;
    bottom: 100px;
    right: 30px;
    width: 350px;
    height: 500px;
    background: rgba(15, 20, 35, 0.85);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(0, 255, 255, 0.3);
    border-radius: 20px;
    box-shadow: 0 0 40px rgba(0, 255, 255, 0.15);
    z-index: 1040;
    display: none;
    flex-direction: column;
    overflow: hidden;
    transform: translateY(20px);
    opacity: 0;
    transition: all 0.3s ease;
}
.ai-chat-window.show {
    display: flex;
    transform: translateY(0);
    opacity: 1;
}

.chat-header {
    background: rgba(0, 255, 255, 0.1);
    padding: 15px 20px;
    border-bottom: 1px solid rgba(0, 255, 255, 0.2);
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: bold;
    color: white;
}
.chat-body {
    flex: 1;
    padding: 15px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.chat-body::-webkit-scrollbar { width: 5px; }
.chat-body::-webkit-scrollbar-thumb { background: rgba(0,255,255,0.3); border-radius: 5px; }

.chat-message {
    max-width: 80%;
    padding: 10px 15px;
    border-radius: 15px;
    font-size: 0.9rem;
    line-height: 1.4;
    word-wrap: break-word;
}
.chat-message.bot {
    align-self: flex-start;
    background: rgba(0, 255, 255, 0.1);
    border: 1px solid rgba(0, 255, 255, 0.2);
    border-bottom-left-radius: 2px;
    color: #e0e0e0;
}
.chat-message.user {
    align-self: flex-end;
    background: linear-gradient(45deg, #00d2ff, #3a7bd5);
    color: white;
    border-bottom-right-radius: 2px;
}
.typing-indicator {
    color: #00ffff;
    font-size: 0.8rem;
    margin-left: 10px;
    font-style: italic;
    display: none;
}

.chat-footer {
    padding: 10px 15px;
    background: rgba(0, 0, 0, 0.5);
    border-top: 1px solid rgba(0, 255, 255, 0.2);
}
.chat-footer .form-control:focus {
    box-shadow: none;
}

.chat-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
}
.chip {
    font-size: 0.75rem;
    padding: 5px 10px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(0,255,255,0.3);
    color: #00ffff;
    border-radius: 20px;
    cursor: pointer;
    transition: 0.3s;
}
.chip:hover {
    background: rgba(0,255,255,0.2);
}

.voice-recording {
    animation: micPulse 1s infinite;
    color: #ff0055 !important;
}
@keyframes micPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.2); }
    100% { transform: scale(1); }
}
</style>

<script>
// Chatbot Logic
const chatBtn = document.getElementById('openChatBtn');
const chatWindow = document.getElementById('aiChatWindow');
const closeChat = document.getElementById('closeChatBtn');
const chatBody = document.getElementById('chatBody');
const chatInput = document.getElementById('chatInput');
const sendBtn = document.getElementById('sendChatBtn');
const voiceChatBtn = document.getElementById('chatVoiceBtn');

chatBtn.addEventListener('click', () => {
    chatWindow.classList.add('show');
    chatBtn.style.display = 'none';
});

closeChat.addEventListener('click', () => {
    chatWindow.classList.remove('show');
    setTimeout(() => { chatBtn.style.display = 'flex'; }, 300);
});

function appendMessage(text, sender) {
    const msgDiv = document.createElement('div');
    msgDiv.className = `chat-message ${sender}`;
    msgDiv.innerHTML = text;
    chatBody.appendChild(msgDiv);
    chatBody.scrollTop = chatBody.scrollHeight;
}

function showTyping() {
    const typingDiv = document.createElement('div');
    typingDiv.className = 'typing-indicator';
    typingDiv.id = 'typingIndicator';
    typingDiv.innerHTML = 'AI is typing...';
    typingDiv.style.display = 'block';
    chatBody.appendChild(typingDiv);
    chatBody.scrollTop = chatBody.scrollHeight;
}

function hideTyping() {
    const indicator = document.getElementById('typingIndicator');
    if(indicator) indicator.remove();
}

function processAIResponse(userText) {
    showTyping();
    let lowerText = userText.toLowerCase();
    
    setTimeout(() => {
        hideTyping();
        let response = "I'm still learning. Try asking about tracking, quotes, or shipping delays.";
        
        if(lowerText.includes('track') || lowerText.includes('status')) {
            response = "To track a parcel, please enter your Waybill ID (e.g. PP-8492-AI).";
        } else if(lowerText.includes('quote') || lowerText.includes('price')) {
            response = "Our AI pricing engine calculates rates based on live fuel surcharge and distance. Please visit the <a href='quotes.php' style='color:#00ffff;'>Quotes Page</a> to get an exact estimate.";
        } else if(lowerText.includes('delay') || lowerText.includes('weather')) {
            response = "Currently, Sea Freight routes near the Arabian Sea are experiencing minor delays due to weather. All Drone deliveries are operating on time.";
        } else if(lowerText.includes('hello') || lowerText.includes('hi')) {
            response = "Greetings! I am the AI Assistant of Parcel Pulse. How can I make your logistics easier today?";
        } else if(lowerText.match(/pp-[0-9]{4}-ai/)) {
            response = "Tracking ID detected. Querying database... <br><strong>Status:</strong> In Transit <br><strong>ETA:</strong> Tomorrow by 14:00. <br>Would you like to view it on the Live Map?";
        }

        appendMessage(response, 'bot');
    }, 1500);
}

function sendUserMessage() {
    const text = chatInput.value.trim();
    if(text === '') return;
    
    // Remove chips if present
    const chips = document.querySelector('.chat-chips');
    if(chips) chips.remove();

    appendMessage(text, 'user');
    chatInput.value = '';
    processAIResponse(text);
}

sendBtn.addEventListener('click', sendUserMessage);
chatInput.addEventListener('keypress', (e) => {
    if(e.key === 'Enter') sendUserMessage();
});

// For quick chip actions
function sendChipMessage(text) {
    chatInput.value = text;
    sendUserMessage();
}

// Simulated Voice Recognition for Chatbot
voiceChatBtn.addEventListener('click', () => {
    if(!window.SpeechRecognition && !window.webkitSpeechRecognition) {
        alert("Voice not supported in your browser.");
        return;
    }
    const SpeechRec = window.SpeechRecognition || window.webkitSpeechRecognition;
    const rec = new SpeechRec();
    
    voiceChatBtn.classList.add('voice-recording');
    chatInput.placeholder = "Listening...";
    
    rec.onresult = function(e) {
        voiceChatBtn.classList.remove('voice-recording');
        chatInput.value = e.results[0][0].transcript;
        chatInput.placeholder = "Type a message...";
        sendUserMessage();
    };
    rec.onerror = function() {
        voiceChatBtn.classList.remove('voice-recording');
        chatInput.placeholder = "Type a message...";
    }
    rec.start();
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>