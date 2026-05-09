{{-- 
    Chatbot Widget 
    Fitur ini dirancang modular sehingga jika Anda ingin menghapusnya, 
    cukup hapus baris @include('partials.chatbot') di halaman-halaman yang memanggilnya.
--}}
<style>
    /* Chatbot Root Variables mapped slightly from global */
    .chatbot-container {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 9999;
        font-family: 'Poppins', sans-serif;
    }

    /* Floating Button */
    .chat-trigger-btn {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--gold-color, #c9a84c), var(--gold-light, #d6b881));
        color: var(--navy-color, #0d1130);
        border: none;
        box-shadow: 0 4px 25px rgba(201, 168, 76, 0.4);
        font-size: 1.5rem;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s ease;
        position: relative;
    }

    .chat-trigger-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 30px rgba(201, 168, 76, 0.6);
    }

    .chat-trigger-btn .badge {
        position: absolute;
        top: 2px;
        right: 2px;
        background-color: var(--error-color, #e3342f);
        color: white;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        border: 2px solid white;
    }

    /* Chat Window */
    .chat-window {
        position: absolute;
        bottom: 80px;
        right: 0;
        width: 350px;
        max-width: calc(100vw - 40px);
        height: 500px;
        max-height: calc(100vh - 120px);
        background-color: var(--card-bg, #ffffff);
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.05);
        opacity: 0;
        transform: translateY(20px) scale(0.95);
        pointer-events: none;
        transition: all 0.3s cubic-bezier(0.19, 1, 0.22, 1);
        transform-origin: bottom right;
    }

    .chat-window.open {
        opacity: 1;
        transform: translateY(0) scale(1);
        pointer-events: all;
    }

    /* Chat Header */
    .chat-header {
        background: linear-gradient(135deg, var(--navy-color, #0d1130), var(--navy-light, #1a1f4e));
        color: white;
        padding: 18px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid var(--gold-color, #c9a84c);
    }

    .chat-header-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .chat-header-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.1);
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.2rem;
        color: var(--gold-color, #c9a84c);
    }

    .chat-header-text h3 {
        font-size: 1rem;
        font-weight: 700;
        margin: 0;
        line-height: 1.2;
    }

    .chat-header-text p {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        background-color: #28a745;
        border-radius: 50%;
        display: inline-block;
    }

    .close-chat-btn {
        background: none;
        border: none;
        color: rgba(255, 255, 255, 0.7);
        font-size: 1.2rem;
        cursor: pointer;
        transition: color 0.2s;
        padding: 4px;
    }

    .close-chat-btn:hover {
        color: white;
    }

    /* Chat Body */
    .chat-body {
        flex: 1;
        padding: 20px;
        overflow-y: auto;
        background-color: var(--bg-color, #f5f3ee);
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    /* Scrollbar */
    .chat-body::-webkit-scrollbar { width: 6px; }
    .chat-body::-webkit-scrollbar-track { background: transparent; }
    .chat-body::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.1); border-radius: 10px; }

    /* Bubbles */
    .chat-msg {
        max-width: 85%;
        display: flex;
        flex-direction: column;
        animation: fadeInMsg 0.3s ease;
    }

    @keyframes fadeInMsg {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .chat-msg.bot {
        align-self: flex-start;
    }

    .chat-msg.user {
        align-self: flex-end;
    }

    .chat-bubble {
        padding: 12px 16px;
        border-radius: 18px;
        font-size: 0.88rem;
        line-height: 1.5;
        position: relative;
    }

    .chat-msg.bot .chat-bubble {
        background-color: var(--card-bg, #ffffff);
        color: var(--text-dark, #2c2c2c);
        border: 1px solid rgba(0,0,0,0.05);
        border-bottom-left-radius: 4px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
    }

    .chat-msg.user .chat-bubble {
        background: linear-gradient(135deg, var(--gold-color, #c9a84c), var(--gold-light, #d6b881));
        color: var(--navy-color, #0d1130);
        font-weight: 500;
        border-bottom-right-radius: 4px;
        box-shadow: 0 2px 10px rgba(201, 168, 76, 0.2);
    }

    .chat-time {
        font-size: 0.65rem;
        color: var(--text-gray, #8b8fa3);
        margin-top: 4px;
        align-self: flex-end;
    }
    
    .chat-msg.bot .chat-time {
        align-self: flex-start;
    }

    /* Typing Indicator */
    .typing-indicator {
        display: flex;
        gap: 4px;
        padding: 5px 0;
    }

    .typing-dot {
        width: 6px;
        height: 6px;
        background-color: var(--text-gray, #8b8fa3);
        border-radius: 50%;
        animation: typingBounce 1.4s infinite ease-in-out both;
    }

    .typing-dot:nth-child(1) { animation-delay: -0.32s; }
    .typing-dot:nth-child(2) { animation-delay: -0.16s; }

    @keyframes typingBounce {
        0%, 80%, 100% { transform: scale(0); }
        40% { transform: scale(1); }
    }

    /* Chat Footer */
    .chat-footer {
        padding: 15px;
        background-color: var(--card-bg, #ffffff);
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .chat-input {
        flex: 1;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 20px;
        padding: 12px 16px;
        font-size: 0.88rem;
        outline: none;
        transition: border-color 0.3s;
        background-color: var(--bg-color, #f5f3ee);
        color: var(--text-dark, #2c2c2c);
        font-family: 'Poppins', sans-serif;
    }

    .chat-input:focus {
        border-color: var(--gold-color, #c9a84c);
    }

    .send-btn {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background-color: var(--navy-color, #0d1130);
        color: white;
        border: none;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        transition: all 0.3s;
        flex-shrink: 0;
    }

    .send-btn:hover {
        background-color: var(--gold-color, #c9a84c);
        color: var(--navy-color, #0d1130);
    }

    /* Quick Replies */
    .quick-replies {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 5px;
        margin-bottom: 10px;
        animation: fadeInMsg 0.4s ease;
    }

    .quick-reply-btn {
        background-color: transparent;
        border: 1px solid var(--gold-color, #c9a84c);
        color: var(--navy-color, #0d1130);
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .quick-reply-btn:hover {
        background-color: var(--gold-color, #c9a84c);
        color: white;
    }

    /* Dark Mode Global Support override */
    body.dark-mode .chat-window { border-color: rgba(255,255,255,0.05); }
    body.dark-mode .chat-body { background-color: #0f1117; } /* using explicit dark color to be safe */
    body.dark-mode .chat-msg.bot .chat-bubble { background-color: #1a1d2e; border-color: rgba(255,255,255,0.05); color: #ffffff; }
    body.dark-mode .chat-footer { border-color: rgba(255,255,255,0.05); }
    body.dark-mode .chat-input { background-color: #1a1d2e; border-color: rgba(255,255,255,0.1); color: white; }
    body.dark-mode .chat-input:focus { border-color: var(--gold-color); }
    body.dark-mode .quick-reply-btn { color: var(--gold-color, #c9a84c); }
    body.dark-mode .quick-reply-btn:hover { color: var(--navy-color, #0d1130); background-color: var(--gold-color, #c9a84c); }
    
</style>

<div class="chatbot-container">
    {{-- Trigger Button --}}
    <button class="chat-trigger-btn" id="chatTriggerBtn" title="Bantuan CS">
        <i class="fa-solid fa-headset"></i>
        <span class="badge" style="display: none;" id="chatBadge"></span>
    </button>

    {{-- Chat Window --}}
    <div class="chat-window" id="chatWindow">
        <div class="chat-header">
            <div class="chat-header-info">
                <div class="chat-header-avatar">
                    <i class="fa-solid fa-robot"></i>
                </div>
                <div class="chat-header-text">
                    <h3>CS Haramain</h3>
                    <p><span class="status-dot"></span> Online</p>
                </div>
            </div>
            <button class="close-chat-btn" id="closeChatBtn">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <div class="chat-body" id="chatBody">
            <div class="chat-msg bot">
                <div class="chat-bubble">
                    Assalamualaikum! 🙏 Halo, ada yang bisa saya bantu terkait layanan Haramain Tour hari ini? 
                    <br><br>Anda bisa mengetik pertanyaan Anda atau memilih salah satu topik di bawah ini:
                </div>
                <div class="chat-time">Sekarang</div>
            </div>
            
            <div class="quick-replies" id="initialOptions">
                <button class="quick-reply-btn" onclick="sendQuickReply('Apa saja paket umroh yang tersedia?')">Info Paket Umroh</button>
                <button class="quick-reply-btn" onclick="sendQuickReply('Berapa harga paket reguler?')">Harga Paket</button>
                <button class="quick-reply-btn" onclick="sendQuickReply('Di mana lokasi kantor Haramain Tour?')">Lokasi Kantor</button>
                <button class="quick-reply-btn" onclick="sendQuickReply('Saya butuh bantuan CS (Admin)')">Hubungi Admin</button>
            </div>
        </div>

        <div class="chat-footer">
            <input type="text" id="chatInput" class="chat-input" placeholder="Ketik pesan Anda di sini..." autocomplete="off">
            <button class="send-btn" id="sendChatBtn">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const triggerBtn = document.getElementById('chatTriggerBtn');
        const chatWindow = document.getElementById('chatWindow');
        const closeBtn = document.getElementById('closeChatBtn');
        const chatInput = document.getElementById('chatInput');
        const sendBtn = document.getElementById('sendChatBtn');
        const chatBody = document.getElementById('chatBody');
        const badge = document.getElementById('chatBadge');

        // Setup CSRF Token for Laravel Ajax
        const csrfToken = document.querySelector('meta[name="csrf-token"]') 
                          ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
                          : '{{ csrf_token() }}';

        let isChatOpen = false;

        function toggleChat() {
            isChatOpen = !isChatOpen;
            if (isChatOpen) {
                chatWindow.classList.add('open');
                badge.style.display = 'none';
                setTimeout(() => chatInput.focus(), 300);
                scrollToBottom();
            } else {
                chatWindow.classList.remove('open');
            }
        }

        triggerBtn.addEventListener('click', toggleChat);
        closeBtn.addEventListener('click', toggleChat);

        // Kirim pesan dengan menekan Enter
        chatInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        sendBtn.addEventListener('click', sendMessage);

        function scrollToBottom() {
            chatBody.scrollTop = chatBody.scrollHeight;
        }

        function formatTime() {
            const now = new Date();
            let hours = now.getHours().toString().padStart(2, '0');
            let mins = now.getMinutes().toString().padStart(2, '0');
            return `${hours}:${mins}`;
        }

        function addMessage(text, isUser = false) {
            const msgDiv = document.createElement('div');
            msgDiv.className = `chat-msg ${isUser ? 'user' : 'bot'}`;
            msgDiv.innerHTML = `
                <div class="chat-bubble">${text}</div>
                <div class="chat-time">${formatTime()}</div>
            `;
            chatBody.appendChild(msgDiv);
            scrollToBottom();
        }

        // Hapus semua quick-reply yang sedang tampil agar tidak duplikat
        function removeQuickReplies() {
            const allReplies = chatBody.querySelectorAll('.quick-replies');
            allReplies.forEach(el => el.remove());
        }

        // Tampilkan tombol quick-reply setelah setiap balasan bot
        function showQuickReplies() {
            removeQuickReplies();

            const repliesDiv = document.createElement('div');
            repliesDiv.className = 'quick-replies';
            repliesDiv.innerHTML = `
                <button class="quick-reply-btn" onclick="sendQuickReply('Apa saja paket umroh yang tersedia?')">Info Paket Umroh</button>
                <button class="quick-reply-btn" onclick="sendQuickReply('Berapa harga paket reguler?')">Harga Paket</button>
                <button class="quick-reply-btn" onclick="sendQuickReply('Di mana lokasi kantor Haramain Tour?')">Lokasi Kantor</button>
                <button class="quick-reply-btn" onclick="sendQuickReply('Saya butuh bantuan CS (Admin)')">Hubungi Admin</button>
            `;
            chatBody.appendChild(repliesDiv);
            scrollToBottom();
        }

        function showTyping() {
            // Sembunyikan quick-replies saat bot sedang mengetik
            removeQuickReplies();

            const msgDiv = document.createElement('div');
            msgDiv.className = `chat-msg bot typing-msg`;
            msgDiv.id = 'typingIndicator';
            msgDiv.innerHTML = `
                <div class="chat-bubble">
                    <div class="typing-indicator">
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                    </div>
                </div>
            `;
            chatBody.appendChild(msgDiv);
            scrollToBottom();
        }

        function removeTyping() {
            const typing = document.getElementById('typingIndicator');
            if (typing) {
                typing.remove();
            }
        }

        async function sendMessage() {
            const text = chatInput.value.trim();
            if (!text) return;

            // Tambahkan pesan user ke kotak obrolan
            addMessage(text, true);
            chatInput.value = '';

            // Tampilkan indikator bot mengetik
            showTyping();

            try {
                // Kirim request AJAX ke ChatBotController - gunakan path relatif langsung
                // agar tidak tergantung pada APP_URL atau cache Blade
                const chatbotUrl = window.location.origin + '/chatbot/message';
                const response = await fetch(chatbotUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ message: text })
                });

                const responseText = await response.text();
                
                let data;
                try {
                    // Membaca json murni (Solusi untuk Free Hosting yang suka menyuntikkan script iklan/HTML ke akhir JSON API)
                    const jsonString = responseText.substring(responseText.indexOf('{'), responseText.lastIndexOf('}') + 1);
                    data = JSON.parse(jsonString);
                } catch(e) {
                    console.error("Gagal membaca respons dari server:", responseText);
                    throw new Error("Invalid JSON response");
                }
                
                removeTyping();
                
                if (data.status === 'success') {
                    addMessage(data.reply);
                } else {
                    addMessage("Maaf, terjadi kesalahan pada server kami.");
                }

            } catch (error) {
                console.error('Chat error:', error);
                removeTyping();
                addMessage("Sambungan terputus. Mohon periksa koneksi internet Anda.");
            }

            // Tampilkan kembali tombol quick-reply setelah setiap balasan bot
            showQuickReplies();
            
            // Unread badge logic if chat is closed while replying
            if (!isChatOpen) {
                badge.style.display = 'block';
            }
        }

        // Ekspos fungsi ke global scope agar bisa dipanggil oleh attribut onclick HTML
        window.sendQuickReply = function(text) {
            chatInput.value = text;
            sendMessage();
        };
    });
</script>
