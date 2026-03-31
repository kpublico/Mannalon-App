<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - MannalonApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar-link {
            transition: all 0.3s ease;
            color: #374151;
        }
        .sidebar-link:hover {
            background: #f0fdf4;
            color: #059669;
            transform: translateX(5px);
        }
        .sidebar-link.active {
            background: #059669;
            color: white;
            border-left: 4px solid #047857;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-white text-gray-800 flex-shrink-0 hidden md:block shadow-lg border-r border-gray-200">
            <div class="p-6">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 bg-emerald-600 rounded-full flex items-center justify-center">
                        <span class="text-2xl">🌾</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-emerald-700">MannalonApp</h2>
                        <p class="text-xs text-gray-500">Farmer Portal</p>
                    </div>
                </div>

                <nav class="space-y-2">
                    <a href="{{ route('farmer.home') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('farmer.home') ? 'active' : '' }}">
                        <i class="fas fa-home w-5"></i>
                        <span>Home</span>
                    </a>
                    <a href="{{ route('farmer.announcements') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('farmer.announcements') ? 'active' : '' }}">
                        <i class="fas fa-bullhorn w-5"></i>
                        <span>Announcements</span>
                    </a>
                    <a href="{{ route('farmer.guides') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('farmer.guides') ? 'active' : '' }}">
                        <i class="fas fa-book w-5"></i>
                        <span>Farming Guides</span>
                    </a>
                    <a href="{{ route('farmer.weather') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('farmer.weather') ? 'active' : '' }}">
                        <i class="fas fa-cloud-sun w-5"></i>
                        <span>Weather Info</span>
                    </a>
                    <a href="{{ route('farmer.market-prices') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('farmer.market-prices') ? 'active' : '' }}">
                        <i class="fas fa-chart-line w-5"></i>
                        <span>Market Prices</span>
                    </a>
                    <a href="{{ route('farmer.information') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('farmer.information') ? 'active' : '' }}">
                        <i class="fas fa-folder-open w-5"></i>
                        <span>My Farm Information</span>
                    </a>
                    <a href="{{ route('farmer.about') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('farmer.about') ? 'active' : '' }}">
                        <i class="fas fa-info-circle w-5"></i>
                        <span>About MannalonApp</span>
                    </a>
                    <a href="{{ route('farmer.profile') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('farmer.profile') ? 'active' : '' }}">
                        <i class="fas fa-user w-5"></i>
                        <span>Profile</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </nav>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header -->
            <header class="bg-white shadow-md px-6 py-4 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">@yield('page-title')</h1>
                    <p class="text-sm text-gray-500">@yield('page-subtitle', 'Welcome to your dashboard')</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name ?? 'Farmer' }}</p>
                        <p class="text-xs text-gray-500">Farmer Account</p>
                    </div>
                    <div class="w-10 h-10 bg-emerald-600 rounded-full flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr(auth()->user()->name ?? 'F', 0, 1)) }}
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- AI Chat Assistant - Floating Button -->
    <button 
        id="chatToggleBtn" 
        class="fixed bottom-6 right-6 w-16 h-16 bg-emerald-600 hover:bg-emerald-700 text-white rounded-full shadow-2xl flex items-center justify-center transition-all duration-300 hover:scale-110 z-50"
        onclick="toggleChat()"
        title="Mannalon AI Assistant">
        <i class="fas fa-comments text-2xl"></i>
    </button>

    <!-- AI Chat Window -->
    <div 
        id="chatWindow" 
        class="fixed bottom-24 right-6 w-96 h-[600px] bg-white rounded-2xl shadow-2xl z-50 flex flex-col hidden transition-all duration-300">
        
        <!-- Chat Header -->
        <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 text-white p-4 rounded-t-2xl flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                    <span class="text-2xl">🌾</span>
                </div>
                <div>
                    <h3 class="font-bold text-lg">Mannalon Assistant</h3>
                    <p class="text-xs text-emerald-100">Agricultural Expert AI</p>
                </div>
            </div>
            <button onclick="toggleChat()" class="hover:bg-white/20 rounded-full p-2 transition">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Chat Messages Area (Scrollable) -->
        <div id="chatMessages" class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50">
            <!-- Welcome Message -->
            <div class="flex gap-3">
                <div class="w-8 h-8 bg-emerald-600 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-white">🤖</span>
                </div>
                <div class="bg-white rounded-lg rounded-tl-none p-3 shadow-sm max-w-[80%]">
                    <p class="text-sm text-gray-800">
                        Hello! I'm your Mannalon Agricultural Assistant. I can help you with:
                    </p>
                    <ul class="text-sm text-gray-700 mt-2 space-y-1">
                        <li>🌾 Crop cultivation advice</li>
                        <li>☁️ Weather preparation tips</li>
                        <li>📈 Market trends & pricing</li>
                        <li>🐛 Pest control solutions</li>
                        <li>🧭 Navigate MannalonApp pages</li>
                    </ul>
                    <p class="text-sm text-gray-800 mt-2">
                        Try asking: <em>"Where can I check market prices?"</em> or <em>"Show me all pages"</em>
                    </p>
                </div>
            </div>
        </div>

        <!-- Chat Input Area -->
        <div class="p-4 border-t border-gray-200 bg-white rounded-b-2xl">
            <form id="chatForm" onsubmit="sendMessage(event)" class="flex gap-2">
                <input 
                    type="text" 
                    id="chatInput" 
                    placeholder="Ask about farming, weather, or say 'go to...'"
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                    autocomplete="off">
                <button 
                    type="submit"
                    class="w-10 h-10 bg-emerald-600 hover:bg-emerald-700 text-white rounded-full flex items-center justify-center transition">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </form>
            <p class="text-xs text-gray-500 mt-2 text-center">
                Powered by AI • For informational purposes
            </p>
        </div>
    </div>

    <!-- Chat JavaScript -->
    <script>
        let chatSending = false;

        // Toggle Chat Window
        function toggleChat() {
            const chatWindow = document.getElementById('chatWindow');
            const chatBtn = document.getElementById('chatToggleBtn');
            
            if (chatWindow.classList.contains('hidden')) {
                chatWindow.classList.remove('hidden');
                chatBtn.innerHTML = '<i class="fas fa-times text-2xl"></i>';
                document.getElementById('chatInput').focus();
            } else {
                chatWindow.classList.add('hidden');
                chatBtn.innerHTML = '<i class="fas fa-comments text-2xl"></i>';
            }
        }

        // Send Message Function - CONNECTED TO BACKEND API
        function sendMessage(event) {
            event.preventDefault();
            
            if (chatSending) return;
            
            const input = document.getElementById('chatInput');
            const message = input.value.trim();
            
            if (!message) return;
            
            chatSending = true;
            
            // Add user message to chat
            addMessageToChat(message, 'user');
            
            // Clear input
            input.value = '';
            
            // Show typing indicator
            showTypingIndicator();
            
            // Disable input while waiting
            input.disabled = true;
            
            // Call Backend API for AI Response
            sendMessageToAPI(message)
                .then(aiResponse => {
                    hideTypingIndicator();
                    addMessageToChat(aiResponse, 'ai');
                })
                .catch(error => {
                    hideTypingIndicator();
                    addMessageToChat('I apologize, but I\'m having trouble processing your question. Please try again or contact the Municipal Agriculture Office at (078) 123-4567.', 'ai');
                })
                .finally(() => {
                    chatSending = false;
                    input.disabled = false;
                    input.focus();
                });
        }

        // API Call to Backend
        async function sendMessageToAPI(message) {
            const response = await fetch('{{ route("chat.send") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ message: message })
            });

            if (!response.ok) {
                throw new Error('Server returned ' + response.status);
            }

            const data = await response.json();
            
            if (data.success && data.reply) {
                return data.reply;
            } else {
                throw new Error(data.reply || 'Invalid response');
            }
        }

        // Add Message to Chat
        function addMessageToChat(message, sender) {
            const chatMessages = document.getElementById('chatMessages');
            const messageDiv = document.createElement('div');
            
            if (sender === 'user') {
                messageDiv.className = 'flex justify-end';
                messageDiv.innerHTML = `
                    <div class="bg-emerald-600 text-white rounded-lg rounded-tr-none p-3 shadow-sm max-w-[80%]">
                        <p class="text-sm">${escapeHtml(message)}</p>
                    </div>
                `;
            } else {
                messageDiv.className = 'flex gap-3';
                messageDiv.innerHTML = `
                    <div class="w-8 h-8 bg-emerald-600 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-white">🤖</span>
                    </div>
                    <div class="bg-white rounded-lg rounded-tl-none p-3 shadow-sm max-w-[80%]">
                        <div class="text-sm text-gray-800 ai-response">${formatAIResponse(message)}</div>
                    </div>
                `;
            }
            
            chatMessages.appendChild(messageDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        // Format AI response: escape HTML first, then render markdown and navigation buttons
        function formatAIResponse(text) {
            // 1. Extract [NAV:...] links before escaping so we can re-inject them safely
            const navLinks = [];
            let navIndex = 0;
            let processed = text.replace(/\[NAV:(\/farmer\/[a-z-]+)\|([^\]]+)\]/g, function(match, path, label) {
                const placeholder = `__NAV_${navIndex}__`;
                navLinks.push({ path: path, label: label, placeholder: placeholder });
                navIndex++;
                return placeholder;
            });

            // 2. Escape HTML to prevent XSS
            let safe = escapeHtml(processed);
            
            // 3. Convert **bold** to <strong>
            safe = safe.replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>');
            
            // 4. Convert lines starting with "- " into list items
            safe = safe.replace(/^- (.+)$/gm, '<li class="ml-4 list-disc">$1</li>');
            
            // 5. Wrap consecutive <li> items in <ul>
            safe = safe.replace(/((?:<li[^>]*>.*?<\/li>\n?)+)/g, '<ul class="my-1 space-y-0.5">$1</ul>');
            
            // 6. Convert numbered lists (1. item)
            safe = safe.replace(/^(\d+)\.\s+(.+)$/gm, '<li class="ml-4 list-decimal"><span>$2</span></li>');
            safe = safe.replace(/((?:<li class="ml-4 list-decimal">.*?<\/li>\n?)+)/g, '<ol class="my-1 space-y-0.5">$1</ol>');
            
            // 7. Convert double newlines to paragraph breaks
            safe = safe.replace(/\n\n/g, '</p><p class="mt-2">');
            
            // 8. Convert remaining single newlines to <br>
            safe = safe.replace(/\n/g, '<br>');
            
            // 9. Wrap in paragraph
            safe = '<p>' + safe + '</p>';
            
            // 10. Re-inject navigation buttons (safe — paths are validated, labels are escaped)
            navLinks.forEach(function(nav) {
                const safeLabel = escapeHtml(nav.label);
                const button = `<a href="${nav.path}" class="nav-link-btn inline-flex items-center gap-2 mt-2 px-4 py-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 rounded-lg text-sm font-medium transition-all duration-200 cursor-pointer no-underline" style="text-decoration:none;">${safeLabel} <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>`;
                safe = safe.replace(nav.placeholder, button);
            });
            
            // Clean up empty paragraphs
            safe = safe.replace(/<p><\/p>/g, '');
            safe = safe.replace(/<p class="mt-2"><\/p>/g, '');
            
            return safe;
        }

        // Show Typing Indicator
        function showTypingIndicator() {
            const chatMessages = document.getElementById('chatMessages');
            const typingDiv = document.createElement('div');
            typingDiv.id = 'typingIndicator';
            typingDiv.className = 'flex gap-3';
            typingDiv.innerHTML = `
                <div class="w-8 h-8 bg-emerald-600 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-white">🤖</span>
                </div>
                <div class="bg-white rounded-lg rounded-tl-none p-3 shadow-sm">
                    <div class="flex gap-1">
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                    </div>
                </div>
            `;
            chatMessages.appendChild(typingDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        // Hide Typing Indicator
        function hideTypingIndicator() {
            const typingIndicator = document.getElementById('typingIndicator');
            if (typingIndicator) {
                typingIndicator.remove();
            }
        }

        // Escape HTML to prevent XSS
        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        // Allow Enter key to send, Shift+Enter for new line
        document.addEventListener('DOMContentLoaded', function() {
            const chatInput = document.getElementById('chatInput');
            chatInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    document.getElementById('chatForm').dispatchEvent(new Event('submit'));
                }
            });
        });
    </script>
</body>
</html>