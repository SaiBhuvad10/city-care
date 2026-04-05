<div id="chatbot-container" class="fixed bottom-6 right-6 z-[100] font-sans">
    <!-- Chatbot Toggle Button -->
    <button type="button" id="chatbot-toggle"
        class="w-16 h-16 bg-primary text-white rounded-full flex items-center justify-center shadow-2xl hover:scale-105 transition-transform relative z-[110]">
        <span id="chatbot-icon-open"><i data-lucide="message-circle" size="28"></i></span>
        <span id="chatbot-icon-close" class="hidden"><i data-lucide="x" size="28"></i></span>
        <span class="absolute top-0 right-0 w-4 h-4 bg-red-500 border-2 border-white rounded-full"></span>
    </button>

    <!-- Chatbot Window -->
    <div id="chatbot-window"
        class="hidden absolute bottom-20 right-0 w-[350px] bg-white rounded-3xl shadow-2xl border border-secondary/10 flex flex-col overflow-hidden transition-all origin-bottom-right">
        <!-- Header -->
        <div class="bg-primary text-white p-4 flex items-center gap-3">
            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                <i data-lucide="bot" size="20"></i>
            </div>
            <div>
                <h4 class="font-display font-bold">City Care Assistant</h4>
                <p class="text-xs text-white/80">Online | Fast Replies</p>
            </div>
        </div>

        <!-- Chat Area -->
        <div id="chatbot-messages" class="flex-1 h-[350px] p-4 overflow-y-auto space-y-4 bg-surface-soft text-sm">
            <!-- Greeting Message -->
            <div class="flex items-start gap-2">
                <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white flex-shrink-0">
                    <i data-lucide="bot" size="14"></i>
                </div>
                <div
                    class="bg-white px-4 py-3 rounded-2xl rounded-tl-sm shadow-sm text-secondary border border-secondary/5">
                    Hello! Welcome to City Care Hospital. How can I help you today?
                    <div class="mt-3 flex flex-wrap gap-2">
                        <button
                            class="chatbot-quick-reply bg-primary/10 text-primary px-3 py-1.5 rounded-full text-xs font-bold hover:bg-primary/20 transition-colors">Book
                            Appointment</button>
                        <button
                            class="chatbot-quick-reply bg-primary/10 text-primary px-3 py-1.5 rounded-full text-xs font-bold hover:bg-primary/20 transition-colors">Our
                            Doctors</button>
                        <button
                            class="chatbot-quick-reply bg-primary/10 text-primary px-3 py-1.5 rounded-full text-xs font-bold hover:bg-primary/20 transition-colors">Emergency</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="p-4 bg-white border-t border-secondary/10">
            <form id="chatbot-form" class="relative flex items-center gap-2">
                <input type="text" id="chatbot-input"
                    class="flex-1 bg-surface-soft border-none rounded-full px-4 py-3 outline-none focus:ring-2 ring-primary/20 text-sm"
                    placeholder="Type a message..." autocomplete="off">
                <button type="submit"
                    class="w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center flex-shrink-0 hover:scale-105 transition-transform">
                    <i data-lucide="send" size="16"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    (function () {
        const toggleBtn = document.getElementById('chatbot-toggle');
        const chatWindow = document.getElementById('chatbot-window');
        const msgContainer = document.getElementById('chatbot-messages');
        const chatForm = document.getElementById('chatbot-form');
        const chatInput = document.getElementById('chatbot-input');
        const quickReplies = document.querySelectorAll('.chatbot-quick-reply');

        if (!toggleBtn || !chatWindow) return;

        // Toggle Chatbot
        toggleBtn.addEventListener('click', (e) => {
            e.preventDefault();
            chatWindow.classList.toggle('hidden');

            const openIcon = document.getElementById('chatbot-icon-open');
            const closeIcon = document.getElementById('chatbot-icon-close');

            if (chatWindow.classList.contains('hidden')) {
                openIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            } else {
                openIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
                setTimeout(() => chatInput.focus(), 100);
            }
        });

        // Handle User Input
        chatForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const text = chatInput.value.trim();
            if (text === '') return;

            appendMessage('user', text);
            chatInput.value = '';

            // Show typing indicator
            showTyping();

            // Process reply
            const reply = await getBotResponse(text);
            removeTyping();
            appendMessage('bot', reply);
        });

        // Handle Quick Replies
        quickReplies.forEach(btn => {
            btn.addEventListener('click', async function () {
                const text = this.innerText;
                appendMessage('user', text);
                showTyping();

                const reply = await getBotResponse(text);
                removeTyping();
                appendMessage('bot', reply);
            });
        });

        function appendMessage(sender, html) {
            const div = document.createElement('div');
            div.className = `flex gap-2 ${sender === 'user' ? 'justify-end' : 'items-start'}`;

            if (sender === 'bot') {
                div.innerHTML = `
                <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/></svg>
                </div>
                <div class="bg-white px-4 py-3 rounded-2xl rounded-tl-sm shadow-sm text-secondary border border-secondary/5 text-sm">${html}</div>
            `;
            } else {
                div.innerHTML = `
                <div class="bg-primary px-4 py-3 rounded-2xl rounded-tr-sm shadow-sm text-white text-sm">${html}</div>
            `;
            }

            msgContainer.appendChild(div);
            msgContainer.scrollTop = msgContainer.scrollHeight;
        }

        function showTyping() {
            const div = document.createElement('div');
            div.className = 'flex gap-2 items-start typing-indicator';
            div.innerHTML = `
            <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/></svg>
            </div>
            <div class="bg-white px-4 py-3 rounded-2xl rounded-tl-sm shadow-sm text-secondary border border-secondary/5 flex gap-1 items-center">
                <div class="w-2 h-2 bg-secondary/40 rounded-full animate-bounce" style="animation-delay: 0s"></div>
                <div class="w-2 h-2 bg-secondary/40 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                <div class="w-2 h-2 bg-secondary/40 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
            </div>
        `;
            msgContainer.appendChild(div);
            msgContainer.scrollTop = msgContainer.scrollHeight;
        }

        function removeTyping() {
            const indicator = msgContainer.querySelector('.typing-indicator');
            if (indicator) {
                indicator.remove();
            }
        }

        // Bot Logic Engine utilizing Gemini API
        async function getBotResponse(input) {
            try {
                const response = await fetch('gemini_chat_api.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ message: input })
                });
                const data = await response.json();
                if (data.reply) {
                    return data.reply;
                } else {
                    console.error("API Error:", data);
                    return "I apologize, our hospital systems are currently unable to reach the AI engine. Please try again later or call us directly.";
                }
            } catch (error) {
                console.error("Fetch Error:", error);
                return "Connection error. Please check your internet connection and try again.";
            }
        }
    })();
</script>