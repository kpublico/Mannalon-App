<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Farmer Portal'); ?> - MannalonApp</title>
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
            background: #ecfdf5;
            color: #059669;
            transform: translateX(5px);
        }
        .sidebar-link.active {
            background: #059669;
            color: white;
            border-left: 4px solid #047857;
        }
        /* Mobile Sidebar Overlay */
        .mobile-sidebar-overlay {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 30;
            display: none;
        }
        .mobile-sidebar-overlay.active {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div id="mobileSidebarOverlay" class="mobile-sidebar-overlay" onclick="toggleMobileSidebar()"></div>

    <div class="flex h-screen overflow-hidden bg-gray-100">
        <aside id="sidebar" class="w-64 bg-white text-gray-800 flex-shrink-0 hidden md:block shadow-xl border-r-2 border-emerald-500 fixed md:relative h-full top-0 left-0 z-40 md:z-0 overflow-y-auto">
            <div class="p-6 bg-gradient-to-r from-emerald-600 to-emerald-700">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                        <span class="text-2xl">🌾</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">MannalonApp</h2>
                        <p class="text-xs text-emerald-100">Farmer Portal</p>
                    </div>
                </div>
                <div class="mt-3 bg-white/20 rounded-lg px-3 py-2">
                    <p class="text-xs text-emerald-100">Welcome back</p>
                    <p class="text-sm font-semibold text-white"><?php echo e(auth()->user()->name ?? 'Farmer'); ?></p>
                </div>
            </div>

            <nav class="p-4 space-y-2 overflow-y-auto" style="max-height: calc(100vh - 180px);">
                <a href="<?php echo e(route('farmer.home')); ?>" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg <?php echo e(request()->routeIs('farmer.home') ? 'active' : ''); ?>">
                    <i class="fas fa-home w-5"></i>
                    <span>Home</span>
                </a>
                <a href="<?php echo e(route('farmer.announcements')); ?>" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg <?php echo e(request()->routeIs('farmer.announcements') ? 'active' : ''); ?>">
                    <i class="fas fa-bullhorn w-5"></i>
                    <span>Announcements</span>
                </a>
                <a href="<?php echo e(route('farmer.guides')); ?>" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg <?php echo e(request()->routeIs('farmer.guides') ? 'active' : ''); ?>">
                    <i class="fas fa-book w-5"></i>
                    <span>Farming Guides</span>
                </a>
                <a href="<?php echo e(route('farmer.weather')); ?>" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg <?php echo e(request()->routeIs('farmer.weather') ? 'active' : ''); ?>">
                    <i class="fas fa-cloud-sun w-5"></i>
                    <span>Weather Info</span>
                </a>
                <a href="<?php echo e(route('farmer.market-prices')); ?>" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg <?php echo e(request()->routeIs('farmer.market-prices') ? 'active' : ''); ?>">
                    <i class="fas fa-chart-line w-5"></i>
                    <span>Market Prices</span>
                </a>
                <a href="<?php echo e(route('farmer.information')); ?>" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg <?php echo e(request()->routeIs('farmer.information') ? 'active' : ''); ?>">
                    <i class="fas fa-folder-open w-5"></i>
                    <span>My Farm Information</span>
                </a>
                <a href="<?php echo e(route('farmer.about')); ?>" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg <?php echo e(request()->routeIs('farmer.about') ? 'active' : ''); ?>">
                    <i class="fas fa-circle-info w-5"></i>
                    <span>About MannalonApp</span>
                </a>
                <a href="<?php echo e(route('farmer.profile')); ?>" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg <?php echo e(request()->routeIs('farmer.profile') ? 'active' : ''); ?>">
                    <i class="fas fa-user w-5"></i>
                    <span>Profile</span>
                </a>

                <div class="pt-4 mt-4 border-t border-gray-200">
                    <form action="<?php echo e(route('logout')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left text-red-600 hover:bg-red-50">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="sticky top-0 z-30 border-b border-slate-200 bg-white/95 shadow-sm backdrop-blur">
                <div class="flex items-center justify-between gap-4 px-4 py-4 md:px-6">
                    <div class="flex items-center gap-3 min-w-0">
                        <button id="mobileMenuBtn" onclick="toggleMobileSidebar()" class="inline-flex h-11 w-11 items-center justify-center rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50 md:hidden">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div class="min-w-0">
                            <h1 class="truncate text-xl font-bold text-slate-900 md:text-2xl"><?php echo $__env->yieldContent('page-title', 'Farmer Dashboard'); ?></h1>
                            <p class="truncate text-sm text-slate-500"><?php echo $__env->yieldContent('page-subtitle', 'Welcome to your dashboard'); ?></p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 md:gap-4">
                        <div class="text-right leading-tight">
                            <p class="text-sm font-semibold text-slate-800"><?php echo e(auth()->user()->name ?? 'Farmer'); ?></p>
                            <p class="text-xs text-slate-500">Farmer Account</p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-full bg-emerald-600 font-bold text-white shadow-sm">
                            <?php echo e(strtoupper(substr(auth()->user()->name ?? 'F', 0, 1))); ?>

                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-4 md:p-6 lg:p-8">
                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
    </div>

    <button id="chatToggleBtn" class="fixed bottom-6 right-6 z-50 flex h-16 w-16 items-center justify-center rounded-full bg-emerald-600 text-white shadow-2xl transition hover:scale-110 hover:bg-emerald-700" onclick="toggleChat()" title="Mannalon AI Assistant">
        <i class="fas fa-comments text-2xl"></i>
    </button>

    <div id="chatWindow" class="fixed bottom-24 right-4 z-50 hidden h-[560px] w-[calc(100%-2rem)] max-w-md flex-col overflow-hidden rounded-2xl bg-white shadow-2xl md:right-6 md:w-96 lg:h-[600px]">
        <div class="flex items-center justify-between rounded-t-2xl bg-gradient-to-r from-emerald-600 to-emerald-700 p-4 text-white">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white text-2xl">
                    🌾
                </div>
                <div>
                    <h3 class="text-lg font-bold">Mannalon Assistant</h3>
                    <p class="text-xs text-emerald-100">Agricultural Expert AI</p>
                </div>
            </div>
            <button onclick="toggleChat()" class="rounded-full p-2 transition hover:bg-white/20">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div id="chatMessages" class="flex-1 space-y-4 overflow-y-auto bg-slate-50 p-4">
            <div class="flex gap-3">
                <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-emerald-600 text-white">🤖</div>
                <div class="max-w-[80%] rounded-lg rounded-tl-none bg-white p-3 shadow-sm">
                    <p class="text-sm text-slate-800">Hello! I'm your Mannalon Agricultural Assistant. I can help you with:</p>
                    <ul class="mt-2 space-y-1 text-sm text-slate-700">
                        <li>🌾 Crop cultivation advice</li>
                        <li>☁️ Weather preparation tips</li>
                        <li>📈 Market trends & pricing</li>
                        <li>🐛 Pest control solutions</li>
                        <li>🧭 Navigate MannalonApp pages</li>
                    </ul>
                    <p class="mt-2 text-sm text-slate-800">Try asking: <em>"Where can I check market prices?"</em> or <em>"Show me all pages"</em></p>
                </div>
            </div>
        </div>

        <div class="rounded-b-2xl border-t border-slate-200 bg-white p-4">
            <form id="chatForm" onsubmit="sendMessage(event)" class="flex gap-2">
                <input type="text" id="chatInput" placeholder="Ask about farming, weather, or say 'go to...'" class="flex-1 rounded-full border border-slate-300 px-4 py-2 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500" autocomplete="off">
                <button type="submit" class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-600 text-white transition hover:bg-emerald-700">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </form>
            <p class="mt-2 text-center text-xs text-slate-500">Powered by AI • For informational purposes</p>
        </div>
    </div>

    <script>
        function toggleMobileSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('mobileSidebarOverlay');
            sidebar.classList.toggle('!block');
            sidebar.classList.toggle('hidden');
            overlay.classList.toggle('active');
            document.body.style.overflow = overlay.classList.contains('active') ? 'hidden' : 'auto';
        }

        // Close sidebar when clicking on a link
        document.querySelectorAll('.sidebar-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    toggleMobileSidebar();
                }
            });
        });

        let chatSending = false;

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

        function sendMessage(event) {
            event.preventDefault();

            if (chatSending) return;

            const input = document.getElementById('chatInput');
            const message = input.value.trim();

            if (!message) return;

            chatSending = true;
            addMessageToChat(message, 'user');
            input.value = '';
            showTypingIndicator();
            input.disabled = true;

            sendMessageToAPI(message)
                .then((aiResponse) => {
                    hideTypingIndicator();
                    addMessageToChat(aiResponse, 'ai');
                })
                .catch(() => {
                    hideTypingIndicator();
                    addMessageToChat('I apologize, but I\'m having trouble processing your question. Please try again or contact the Municipal Agriculture Office at (078) 123-4567.', 'ai');
                })
                .finally(() => {
                    chatSending = false;
                    input.disabled = false;
                    input.focus();
                });
        }

        async function sendMessageToAPI(message) {
            const response = await fetch('<?php echo e(route("chat.send")); ?>', {
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
            }

            throw new Error(data.reply || 'Invalid response');
        }

        function addMessageToChat(message, sender) {
            const chatMessages = document.getElementById('chatMessages');
            const messageDiv = document.createElement('div');

            if (sender === 'user') {
                messageDiv.className = 'flex justify-end';
                messageDiv.innerHTML = `
                    <div class="max-w-[80%] rounded-lg rounded-tr-none bg-emerald-600 p-3 text-white shadow-sm">
                        <p class="text-sm">${escapeHtml(message)}</p>
                    </div>
                `;
            } else {
                messageDiv.className = 'flex gap-3';
                messageDiv.innerHTML = `
                    <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-emerald-600 text-white">🤖</div>
                    <div class="max-w-[80%] rounded-lg rounded-tl-none bg-white p-3 shadow-sm">
                        <div class="ai-response text-sm text-slate-800">${formatAIResponse(message)}</div>
                    </div>
                `;
            }

            chatMessages.appendChild(messageDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        function formatAIResponse(text) {
            const navLinks = [];
            let navIndex = 0;
            const processed = text.replace(/\[NAV:(\/farmer\/[a-z-]+)\|([^\]]+)\]/g, function(match, path, label) {
                const placeholder = `__NAV_${navIndex}__`;
                navLinks.push({ path, label, placeholder });
                navIndex++;
                return placeholder;
            });

            let safe = escapeHtml(processed);
            safe = safe.replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>');
            safe = safe.replace(/^- (.+)$/gm, '<li class="ml-4 list-disc">$1</li>');
            safe = safe.replace(/(<li class="ml-4 list-disc">.+?<\/li>\n?)+/gs, '<ul class="my-2 space-y-1">$&</ul>');

            navLinks.forEach((navLink) => {
                const buttonHtml = `<a href="${navLink.path}" class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-3 py-2 text-sm font-semibold text-white transition hover:bg-emerald-700">${navLink.label}</a>`;
                safe = safe.replace(navLink.placeholder, buttonHtml);
            });

            return safe.replace(/\n/g, '<br>');
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        function showTypingIndicator() {
            const chatMessages = document.getElementById('chatMessages');
            const typingDiv = document.createElement('div');
            typingDiv.id = 'typingIndicator';
            typingDiv.className = 'flex gap-3';
            typingDiv.innerHTML = `
                <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-emerald-600 text-white">🤖</div>
                <div class="max-w-[80%] rounded-lg rounded-tl-none bg-white p-3 shadow-sm">
                    <p class="text-sm text-slate-500">Typing...</p>
                </div>
            `;
            chatMessages.appendChild(typingDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        function hideTypingIndicator() {
            const typingIndicator = document.getElementById('typingIndicator');
            if (typingIndicator) {
                typingIndicator.remove();
            }
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
</html><?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views/layouts/farmer-dashboard.blade.php ENDPATH**/ ?>