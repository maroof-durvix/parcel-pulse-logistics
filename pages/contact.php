<?php include('../includes/header.php'); ?>

<style>
/* Smart Support Glassmorphism */
.contact-hero {
    position: relative;
    padding: 120px 0 80px;
    background: url('../assets/img/contact_bg.jpg') no-repeat center center/cover;
    border-bottom: 1px solid rgba(0, 255, 255, 0.2);
    min-height: 100vh;
    display: flex;
    align-items: center;
}
.contact-hero::before {
    content: '';
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: linear-gradient(135deg, rgba(10,14,23,0.95) 0%, rgba(8,17,32,0.9) 100%);
}
.contact-content {
    position: relative;
    z-index: 2;
}
.chat-interface {
    background: rgba(20, 25, 40, 0.6);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(0, 255, 255, 0.2);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 0 40px rgba(0, 255, 255, 0.1);
    display: flex;
    flex-direction: column;
    height: 600px;
}
.chat-header {
    background: rgba(0, 0, 0, 0.5);
    padding: 20px;
    border-bottom: 1px solid rgba(0, 255, 255, 0.2);
    display: flex;
    align-items: center;
    gap: 15px;
}
.ai-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(45deg, #00d2ff, #3a7bd5);
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1.5rem;
    color: white;
    box-shadow: 0 0 15px rgba(0, 210, 255, 0.6);
    animation: pulseAvatar 2s infinite;
}
@keyframes pulseAvatar {
    0% { box-shadow: 0 0 10px rgba(0, 210, 255, 0.4); }
    50% { box-shadow: 0 0 20px rgba(0, 210, 255, 0.8); }
    100% { box-shadow: 0 0 10px rgba(0, 210, 255, 0.4); }
}
.chat-body {
    flex-grow: 1;
    padding: 20px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 15px;
}
.chat-bubble {
    max-width: 80%;
    padding: 15px;
    border-radius: 15px;
    font-size: 0.95rem;
    line-height: 1.5;
}
.ai-bubble {
    background: rgba(0, 255, 255, 0.1);
    border: 1px solid rgba(0, 255, 255, 0.3);
    border-bottom-left-radius: 0;
    align-self: flex-start;
}
.user-bubble {
    background: linear-gradient(45deg, #00d2ff, #3a7bd5);
    color: white;
    border-bottom-right-radius: 0;
    align-self: flex-end;
}
.chat-footer {
    padding: 20px;
    background: rgba(0, 0, 0, 0.5);
    border-top: 1px solid rgba(0, 255, 255, 0.2);
    display: flex;
    gap: 10px;
}
.chat-input {
    flex-grow: 1;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 50px;
    padding: 12px 20px;
    color: white;
    outline: none;
    transition: all 0.3s;
}
.chat-input:focus {
    border-color: #00ffff;
    background: rgba(0, 0, 0, 0.5);
}
.chat-send-btn {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #00ffff;
    color: #000;
    border: none;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1.2rem;
    cursor: pointer;
    transition: 0.3s;
}
.chat-send-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 0 15px #00ffff;
}
.typing-indicator {
    display: flex;
    gap: 5px;
    padding: 10px 15px;
    background: rgba(0, 255, 255, 0.05);
    border-radius: 15px;
    width: fit-content;
    display: none;
}
.typing-dot {
    width: 8px;
    height: 8px;
    background: #00ffff;
    border-radius: 50%;
    animation: typing 1.4s infinite ease-in-out;
}
.typing-dot:nth-child(1) { animation-delay: -0.32s; }
.typing-dot:nth-child(2) { animation-delay: -0.16s; }
@keyframes typing {
    0%, 80%, 100% { transform: scale(0); }
    40% { transform: scale(1); }
}

.contact-info-card {
    background: rgba(20, 25, 40, 0.4);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 20px;
    transition: 0.3s;
}
.contact-info-card:hover {
    border-color: #00ffff;
    background: rgba(0, 255, 255, 0.05);
}
.contact-icon {
    font-size: 2rem;
    color: #00ffff;
}
</style>

<div class="contact-hero">
    <div class="container contact-content">
        <div class="row g-5">
            
            <div class="col-lg-5">
                <h1 class="display-4 fw-bold text-light mb-4">
                    <span style="color: #00ffff;">AI Support</span> Center
                </h1>
                <p class="text-muted mb-5">
                    Connect with our intelligent virtual assistant for instant resolutions, or reach out to our human hubs globally.
                </p>
                
                <div class="contact-info-card">
                    <i class="fa-solid fa-headset contact-icon"></i>
                    <div>
                        <h5 class="mb-1 text-light">Global Hotlines</h5>
                        <p class="text-muted mb-0">+1 (800) 123-PULSE</p>
                    </div>
                </div>
                
                <div class="contact-info-card">
                    <i class="fa-solid fa-envelope-open-text contact-icon"></i>
                    <div>
                        <h5 class="mb-1 text-light">AI Email Routing</h5>
                        <p class="text-muted mb-0">support@parcelpulse.ai</p>
                    </div>
                </div>
                
                <div class="contact-info-card">
                    <i class="fa-solid fa-location-dot contact-icon"></i>
                    <div>
                        <h5 class="mb-1 text-light">HQ Coordinate</h5>
                        <p class="text-muted mb-0">Silicon Valley, CA 94025</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="chat-interface">
                    <div class="chat-header">
                        <div class="ai-avatar">
                            <i class="fa-solid fa-robot"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 text-light fw-bold">Pulse AI</h5>
                            <small class="text-info"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> Online & Ready</small>
                        </div>
                    </div>
                    
                    <div class="chat-body" id="chatBody">
                        <div class="chat-bubble ai-bubble">
                            Hello! I am Pulse AI, your intelligent logistics assistant. How can I help you today? You can ask me about tracking, quotes, or services.
                        </div>
                        
                        <div class="typing-indicator" id="typingIndicator">
                            <div class="typing-dot"></div>
                            <div class="typing-dot"></div>
                            <div class="typing-dot"></div>
                        </div>
                    </div>
                    
                    <div class="chat-footer">
                        <input type="text" class="chat-input" id="chatInput" placeholder="Type your message to Pulse AI...">
                        <button class="chat-send-btn" id="sendBtn">
                            <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
const chatInput = document.getElementById('chatInput');
const sendBtn = document.getElementById('sendBtn');
const chatBody = document.getElementById('chatBody');
const typingIndicator = document.getElementById('typingIndicator');

function appendMessage(text, isUser) {
    const bubble = document.createElement('div');
    bubble.className = `chat-bubble ${isUser ? 'user-bubble' : 'ai-bubble'}`;
    bubble.innerText = text;
    chatBody.insertBefore(bubble, typingIndicator);
    chatBody.scrollTop = chatBody.scrollHeight;
}

function processAIResponse(userText) {
    typingIndicator.style.display = 'flex';
    chatBody.scrollTop = chatBody.scrollHeight;
    
    setTimeout(() => {
        typingIndicator.style.display = 'none';
        let response = "I am currently processing high volume of data. Please hold on or contact our human hotline.";
        const lowerText = userText.toLowerCase();
        
        if (lowerText.includes('track') || lowerText.includes('where')) {
            response = "To track a parcel, please visit our Tracking page and enter your AI-generated Waybill ID.";
        } else if (lowerText.includes('price') || lowerText.includes('cost') || lowerText.includes('quote')) {
            response = "Our pricing is dynamic based on real-time factors. Please visit our Quotes section for an instant AI estimation.";
        } else if (lowerText.includes('hello') || lowerText.includes('hi')) {
            response = "Greetings! How can I optimize your logistics today?";
        }
        
        appendMessage(response, false);
    }, 1500);
}

sendBtn.addEventListener('click', () => {
    const text = chatInput.value.trim();
    if (text) {
        appendMessage(text, true);
        chatInput.value = '';
        processAIResponse(text);
    }
});

chatInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
        sendBtn.click();
    }
});
</script>

<?php include('../includes/footer.php'); ?>