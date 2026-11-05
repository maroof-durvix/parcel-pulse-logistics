/**
 * Parcel Pulse Logistics - Global Client Engine (v3.0)
 */

document.addEventListener('DOMContentLoaded', () => {
    initNavbarScroll();
    initChatbot();
    initTrackingInputs();
});

/* -------------------------------------------------------------
   1. Navbar Scroll Blur & Active State
   ------------------------------------------------------------- */
function initNavbarScroll() {
    const navbar = document.querySelector('.custom-navbar');
    if (!navbar) return;

    window.addEventListener('scroll', () => {
        if (window.scrollY > 30) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
}

/* -------------------------------------------------------------
   2. Floating AI Chatbot Engine
   ------------------------------------------------------------- */
function initChatbot() {
    const chatBtn = document.getElementById('openChatBtn');
    const chatWindow = document.getElementById('aiChatWindow');
    const closeBtn = document.getElementById('closeChatBtn');
    const chatInput = document.getElementById('chatInput');
    const sendBtn = document.getElementById('sendChatBtn');
    const voiceBtn = document.getElementById('chatVoiceBtn');
    const chatBody = document.getElementById('chatBody');

    if (!chatBtn || !chatWindow) return;

    chatBtn.addEventListener('click', () => {
        chatWindow.classList.add('show');
        chatBtn.style.display = 'none';
        if (chatInput) chatInput.focus();
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            chatWindow.classList.remove('show');
            setTimeout(() => { chatBtn.style.display = 'flex'; }, 200);
        });
    }

    function appendMessage(text, sender) {
        if (!chatBody) return;
        const msgDiv = document.createElement('div');
        msgDiv.className = `chat-message ${sender}`;
        msgDiv.innerHTML = text;
        chatBody.appendChild(msgDiv);
        chatBody.scrollTop = chatBody.scrollHeight;
    }

    function showTyping() {
        if (!chatBody) return;
        const typing = document.createElement('div');
        typing.className = 'chat-message bot typing-indicator';
        typing.id = 'typingIndicator';
        typing.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin text-info me-2"></i> Pulse AI is analyzing...';
        chatBody.appendChild(typing);
        chatBody.scrollTop = chatBody.scrollHeight;
    }

    function hideTyping() {
        const indicator = document.getElementById('typingIndicator');
        if (indicator) indicator.remove();
    }

    function processAIResponse(userText) {
        showTyping();
        const lower = userText.toLowerCase().trim();

        setTimeout(() => {
            hideTyping();
            let response = "I'm the Pulse Neural Assistant. Try asking about tracking a parcel, getting instant price quotes, drone deliveries, or smart lockers.";

            if (lower.includes('track') || lower.includes('status') || lower.includes('where is')) {
                response = "To track any parcel, enter your Waybill (e.g., <strong>PP-8492-AI</strong>) or visit our <a href='tracking.php' class='text-info text-decoration-underline'>Live Tracking</a> console for satellite GPS & drone telemetry.";
            } else if (lower.includes('quote') || lower.includes('price') || lower.includes('rate') || lower.includes('cost')) {
                response = "Our dynamic AI pricing engine calculates rates based on weight, distance, and fuel index. <a href='quotes.php' class='text-info text-decoration-underline'>Click here for Instant AI Quote</a>.";
            } else if (lower.includes('drone') || lower.includes('aerial')) {
                response = "Our autonomous drone fleet handles same-day point-to-point drops up to 15km with live wind & telemetry monitoring. <a href='drone.php' class='text-info text-decoration-underline'>Inspect Drone Fleet</a>.";
            } else if (lower.includes('locker') || lower.includes('vault') || lower.includes('nfc')) {
                response = "Smart Lockers provide contactless, 24/7 pickup with NFC tap and one-time secure PIN verification. <a href='lockers.php' class='text-info text-decoration-underline'>Explore Lockers</a>.";
            } else if (lower.includes('hello') || lower.includes('hi') || lower.includes('hey') || lower.includes('salam')) {
                response = "Greetings! Welcome to Parcel Pulse Logistics Neural Core. How can I assist your supply chain today?";
            } else if (lower.match(/pp-[0-9]{4}-[a-z]{2}/i)) {
                response = "Tracking ID <strong>" + userText.toUpperCase() + "</strong> verified in the global manifest! <br><span class='badge bg-success'>In Transit</span> • Estimated Arrival: Tomorrow 14:00. <br><a href='tracking.php?id=" + encodeURIComponent(userText.trim()) + "' class='text-info text-decoration-underline'>View Real-Time Telemetry Map &rarr;</a>";
            }

            appendMessage(response, 'bot');
        }, 900);
    }

    window.sendChipMessage = function(text) {
        const chips = document.querySelector('.chat-chips');
        if (chips) chips.remove();
        appendMessage(text, 'user');
        processAIResponse(text);
    };

    function sendMessage() {
        if (!chatInput) return;
        const text = chatInput.value.trim();
        if (!text) return;
        const chips = document.querySelector('.chat-chips');
        if (chips) chips.remove();
        appendMessage(text, 'user');
        chatInput.value = '';
        processAIResponse(text);
    }

    if (sendBtn) sendBtn.addEventListener('click', sendMessage);
    if (chatInput) {
        chatInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') sendMessage();
        });
    }

    // Voice recognition
    if (voiceBtn) {
        const SpeechRec = window.SpeechRecognition || window.webkitSpeechRecognition;
        if (SpeechRec) {
            const rec = new SpeechRec();
            rec.lang = 'en-US';
            voiceBtn.addEventListener('click', () => {
                voiceBtn.classList.add('text-danger');
                if (chatInput) chatInput.placeholder = "Listening...";
                rec.start();
            });
            rec.onresult = (e) => {
                voiceBtn.classList.remove('text-danger');
                if (chatInput) {
                    chatInput.value = e.results[0][0].transcript;
                    chatInput.placeholder = "Type a message...";
                    sendMessage();
                }
            };
            rec.onerror = () => {
                voiceBtn.classList.remove('text-danger');
                if (chatInput) chatInput.placeholder = "Type a message...";
            };
        } else {
            voiceBtn.style.display = 'none';
        }
    }
}

/* -------------------------------------------------------------
   3. Waybill Input Auto-Format (PP-XXXX-AI)
   ------------------------------------------------------------- */
function initTrackingInputs() {
    const inputs = document.querySelectorAll('.auto-waybill');
    inputs.forEach(input => {
        input.addEventListener('input', (e) => {
            let val = e.target.value.toUpperCase();
            e.target.value = val;
        });
    });
}

