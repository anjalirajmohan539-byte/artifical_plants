<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Premium Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        :root {
            --aurora-1: #4f46e5;
            --aurora-2: #c084fc;
            --aurora-3: #2dd4bf;
            --aurora-4: #fbbf24;
        }

        body {
            background-color: #050505;
            font-family: 'Inter', sans-serif;
        }

        /* Noise texture overlay */
        .noise-overlay {
            position: fixed;
            inset: 0;
            z-index: 50;
            opacity: 0.03;
            pointer-events: none;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
        }

        /* Aurora animation */
        @keyframes aurora-float {
            0% { transform: translate(0, 0) scale(1) rotate(0deg); }
            50% { transform: translate(5%, 10%) scale(1.1) rotate(10deg); }
            100% { transform: translate(-5%, 5%) scale(0.9) rotate(-5deg); }
        }

        .aurora-blob {
            animation: aurora-float 20s infinite alternate cubic-bezier(0.4, 0, 0.2, 1);
            mix-blend-mode: screen;
        }

        /* Glass panel */
        .glass-panel {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .glass-panel:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.1);
        }

        /* Text glow */
        .text-glow {
            text-shadow: 0 0 30px rgba(255, 255, 255, 0.3);
        }

        /* Input focus glow */
        .input-glow:focus {
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.3);
        }

        /* Reveal animation */
        .reveal-text {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .reveal-text.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Card shine effect */
        .card-shine {
            position: relative;
            overflow: hidden;
        }

        .card-shine::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent 40%, rgba(255,255,255,0.1) 50%, transparent 60%);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }

        .card-shine:hover::before {
            transform: translateX(100%);
        }

        /* Progress steps */
        .step-active {
            background: linear-gradient(135deg, #6366f1, #a855f7);
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #080808;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="text-[#e5e5e5] min-h-screen antialiased">
    <!-- Noise Overlay -->
    <div class="noise-overlay"></div>

    <!-- Aurora Background -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="aurora-blob absolute top-[-20%] left-[-10%] w-[50vw] h-[50vw] rounded-full opacity-40 blur-[80px]" style="background: var(--aurora-1); animation-delay: 0s;"></div>
        <div class="aurora-blob absolute top-[30%] right-[-20%] w-[60vw] h-[60vw] rounded-full opacity-30 blur-[100px]" style="background: var(--aurora-2); animation-delay: -5s;"></div>
        <div class="aurora-blob absolute bottom-[-30%] left-[20%] w-[40vw] h-[40vw] rounded-full opacity-30 blur-[80px]" style="background: var(--aurora-3); animation-delay: -10s;"></div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 min-h-screen">
        <!-- Navigation -->
        <nav class="fixed top-0 left-0 right-0 z-40 px-6 md:px-12 py-6 mix-blend-difference">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <a href="#" class="text-xl font-bold tracking-tighter uppercase text-white">STORE</a>
                <a href="#" class="text-xs font-medium uppercase tracking-widest text-white/60 hover:text-white transition-colors flex items-center gap-2">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Continue Shopping
                </a>
            </div>
        </nav>

        <!-- Progress Steps -->
        <div class="fixed top-20 left-0 right-0 z-30 px-6 md:px-12">
            <div class="max-w-4xl mx-auto">
                <div class="flex items-center justify-center gap-4">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full step-active flex items-center justify-center text-xs font-bold text-white">1</div>
                        <span class="text-xs uppercase tracking-widest hidden md:block">Cart</span>
                    </div>
                    <div class="w-12 h-px bg-gradient-to-r from-indigo-500 to-purple-500"></div>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full step-active flex items-center justify-center text-xs font-bold text-white">2</div>
                        <span class="text-xs uppercase tracking-widest hidden md:block text-white">Checkout</span>
                    </div>
                    <div class="w-12 h-px bg-white/10"></div>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-xs font-bold text-white/40">3</div>
                        <span class="text-xs uppercase tracking-widest hidden md:block text-white/40">Complete</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Checkout Content -->
        <div class="pt-36 pb-20 px-6 md:px-12">
            <div class="max-w-7xl mx-auto">
                <!-- Header -->
                <div class="text-center mb-16 reveal-text">
                    <span class="text-[10px] font-medium uppercase tracking-[0.3em] text-white/40 block mb-4">Secure Checkout</span>
                    <h1 class="text-4xl md:text-6xl font-medium tracking-tight text-glow">Complete Your Order</h1>
                </div>

                <div class="grid lg:grid-cols-12 gap-8 lg:gap-16">
                    <!-- Left: Forms -->
                    <div class="lg:col-span-7 space-y-8">
                        <!-- Shipping Information -->
                        <div class="glass-panel rounded-2xl p-8 transition-all duration-500 reveal-text" style="transition-delay: 0.1s;">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                    <i data-lucide="truck" class="w-5 h-5 text-white"></i>
                                </div>
                                <h2 class="text-xl font-medium">Shipping Information</h2>
                            </div>

                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-xs uppercase tracking-widest text-white/40 block mb-2">First Name</label>
                                    <input type="text" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/30 focus:border-indigo-500/50 focus:outline-none transition-all input-glow" placeholder="John">
                                </div>
                                <div>
                                    <label class="text-xs uppercase tracking-widest text-white/40 block mb-2">Last Name</label>
                                    <input type="text" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/30 focus:border-indigo-500/50 focus:outline-none transition-all input-glow" placeholder="Doe">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="text-xs uppercase tracking-widest text-white/40 block mb-2">Email Address</label>
                                    <input type="email" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/30 focus:border-indigo-500/50 focus:outline-none transition-all input-glow" placeholder="john@example.com">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="text-xs uppercase tracking-widest text-white/40 block mb-2">Address</label>
                                    <input type="text" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/30 focus:border-indigo-500/50 focus:outline-none transition-all input-glow" placeholder="123 Main Street">
                                </div>
                                <div>
                                    <label class="text-xs uppercase tracking-widest text-white/40 block mb-2">City</label>
                                    <input type="text" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/30 focus:border-indigo-500/50 focus:outline-none transition-all input-glow" placeholder="Los Angeles">
                                </div>
                                <div>
                                    <label class="text-xs uppercase tracking-widest text-white/40 block mb-2">ZIP Code</label>
                                    <input type="text" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/30 focus:border-indigo-500/50 focus:outline-none transition-all input-glow" placeholder="90001">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="text-xs uppercase tracking-widest text-white/40 block mb-2">Country</label>
                                    <select class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-indigo-500/50 focus:outline-none transition-all input-glow appearance-none cursor-pointer">
                                        <option value="us" class="bg-[#080808]">United States</option>
                                        <option value="uk" class="bg-[#080808]">United Kingdom</option>
                                        <option value="ca" class="bg-[#080808]">Canada</option>
                                        <option value="au" class="bg-[#080808]">Australia</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="glass-panel rounded-2xl p-8 transition-all duration-500 reveal-text" style="transition-delay: 0.2s;">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-teal-500 to-emerald-600 flex items-center justify-center">
                                    <i data-lucide="credit-card" class="w-5 h-5 text-white"></i>
                                </div>
                                <h2 class="text-xl font-medium">Payment Method</h2>
                            </div>

                            <!-- Payment Options -->
                            <div class="flex gap-3 mb-6">
                                <label class="flex-1 cursor-pointer">
                                    <input type="radio" name="payment" value="card" checked class="peer hidden">
                                    <div class="peer-checked:border-indigo-500 peer-checked:bg-indigo-500/10 border border-white/10 rounded-xl p-4 text-center transition-all hover:bg-white/5">
                                        <i data-lucide="credit-card" class="w-6 h-6 mx-auto mb-2 text-white/60"></i>
                                        <span class="text-xs uppercase tracking-widest">Card</span>
                                    </div>
                                </label>
                                <label class="flex-1 cursor-pointer">
                                    <input type="radio" name="payment" value="paypal" class="peer hidden">
                                    <div class="peer-checked:border-indigo-500 peer-checked:bg-indigo-500/10 border border-white/10 rounded-xl p-4 text-center transition-all hover:bg-white/5">
                                        <i data-lucide="wallet" class="w-6 h-6 mx-auto mb-2 text-white/60"></i>
                                        <span class="text-xs uppercase tracking-widest">PayPal</span>
                                    </div>
                                </label>
                                <label class="flex-1 cursor-pointer">
                                    <input type="radio" name="payment" value="crypto" class="peer hidden">
                                    <div class="peer-checked:border-indigo-500 peer-checked:bg-indigo-500/10 border border-white/10 rounded-xl p-4 text-center transition-all hover:bg-white/5">
                                        <i data-lucide="bitcoin" class="w-6 h-6 mx-auto mb-2 text-white/60"></i>
                                        <span class="text-xs uppercase tracking-widest">Crypto</span>
                                    </div>
                                </label>
                            </div>

                            <!-- Card Details -->
                            <div class="space-y-4">
                                <div>
                                    <label class="text-xs uppercase tracking-widest text-white/40 block mb-2">Card Number</label>
                                    <div class="relative">
                                        <input type="text" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/30 focus:border-indigo-500/50 focus:outline-none transition-all input-glow" placeholder="1234 5678 9012 3456">
                                        <div class="absolute right-4 top-1/2 -translate-y-1/2 flex gap-2">
                                            <img src="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/flags/4x3/us.svg" class="w-6 h-4 rounded opacity-40">
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-xs uppercase tracking-widest text-white/40 block mb-2">Expiry Date</label>
                                        <input type="text" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/30 focus:border-indigo-500/50 focus:outline-none transition-all input-glow" placeholder="MM/YY">
                                    </div>
                                    <div>
                                        <label class="text-xs uppercase tracking-widest text-white/40 block mb-2">CVV</label>
                                        <input type="text" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/30 focus:border-indigo-500/50 focus:outline-none transition-all input-glow" placeholder="123">
                                    </div>
                                </div>
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <div class="w-5 h-5 rounded border border-white/20 group-hover:border-white/40 transition-colors flex items-center justify-center">
                                        <i data-lucide="check" class="w-3 h-3 text-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                    </div>
                                    <span class="text-sm text-white/60">Save card for future purchases</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Order Summary -->
                    <div class="lg:col-span-5">
                        <div class="glass-panel rounded-2xl p-8 sticky top-36 transition-all duration-500 reveal-text" style="transition-delay: 0.3s;">
                            <h2 class="text-xl font-medium mb-6">Order Summary</h2>

                            <!-- Items -->
                            <div class="space-y-4 mb-6">
                                <!-- Item 1 -->
                                <div class="flex gap-4 p-3 rounded-xl bg-white/5 border border-white/5 hover:border-white/10 transition-all card-shine">
                                    <div class="w-20 h-20 rounded-lg bg-gradient-to-br from-indigo-500/20 to-purple-500/20 flex items-center justify-center overflow-hidden flex-shrink-0">
                                        <img src="https://picsum.photos/seed/product1/200/200.jpg" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-medium text-white truncate">Premium Wireless Headphones</h3>
                                        <p class="text-xs text-white/40 mt-1">Color: Midnight Black</p>
                                        <div class="flex items-center justify-between mt-2">
                                            <span class="text-sm text-white/60">Qty: 1</span>
                                            <span class="font-medium">$349.00</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Item 2 -->
                                <div class="flex gap-4 p-3 rounded-xl bg-white/5 border border-white/5 hover:border-white/10 transition-all card-shine">
                                    <div class="w-20 h-20 rounded-lg bg-gradient-to-br from-teal-500/20 to-emerald-500/20 flex items-center justify-center overflow-hidden flex-shrink-0">
                                        <img src="https://picsum.photos/seed/product2/200/200.jpg" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-medium text-white truncate">Leather Travel Case</h3>
                                        <p class="text-xs text-white/40 mt-1">Size: Medium</p>
                                        <div class="flex items-center justify-between mt-2">
                                            <span class="text-sm text-white/60">Qty: 1</span>
                                            <span class="font-medium">$89.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Promo Code -->
                            <div class="mb-6">
                                <label class="text-xs uppercase tracking-widest text-white/40 block mb-2">Promo Code</label>
                                <div class="flex gap-2">
                                    <input type="text" class="flex-1 bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/30 focus:border-indigo-500/50 focus:outline-none transition-all input-glow" placeholder="Enter code">
                                    <button class="px-6 py-3 bg-white/5 border border-white/10 rounded-xl text-xs uppercase tracking-widest font-medium hover:bg-white/10 hover:border-white/20 transition-all">
                                        Apply
                                    </button>
                                </div>
                            </div>

                            <!-- Divider -->
                            <div class="h-px bg-gradient-to-r from-transparent via-white/10 to-transparent my-6"></div>

                            <!-- Totals -->
                            <div class="space-y-3 mb-6">
                                <div class="flex justify-between text-sm">
                                    <span class="text-white/60">Subtotal</span>
                                    <span>$438.00</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-white/60">Shipping</span>
                                    <span class="text-teal-400">Free</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-white/60">Tax</span>
                                    <span>$35.04</span>
                                </div>
                            </div>

                            <!-- Divider -->
                            <div class="h-px bg-gradient-to-r from-transparent via-white/10 to-transparent my-6"></div>

                            <!-- Total -->
                            <div class="flex justify-between items-end mb-8">
                                <span class="text-white/60">Total</span>
                                <div class="text-right">
                                    <span class="text-3xl font-medium text-glow">$473.04</span>
                                    <span class="text-sm text-white/40 block">USD</span>
                                </div>
                            </div>

                            <!-- Place Order Button -->
                            <button class="w-full bg-white text-black py-4 rounded-xl text-sm uppercase tracking-widest font-medium hover:bg-indigo-50 transition-all relative overflow-hidden group">
                                <span class="relative z-10 flex items-center justify-center gap-2">
                                    <i data-lucide="lock" class="w-4 h-4"></i>
                                    Place Order
                                </span>
                                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <span class="absolute inset-0 flex items-center justify-center gap-2 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20">
                                    <i data-lucide="lock" class="w-4 h-4"></i>
                                    Place Order
                                </span>
                            </button>

                            <!-- Security Note -->
                            <div class="flex items-center justify-center gap-2 mt-4 text-xs text-white/40">
                                <i data-lucide="shield-check" class="w-4 h-4"></i>
                                <span>Secured by 256-bit SSL encryption</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="border-t border-white/5 py-8 px-6 md:px-12">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-6">
                    <img src="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/flags/4x3/us.svg" class="w-5 h-4 opacity-40">
                    <span class="text-xs text-white/40">© 2024 Premium Store. All rights reserved.</span>
                </div>
                <div class="flex items-center gap-6 text-xs text-white/40">
                    <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                    <a href="#" class="hover:text-white transition-colors">Contact</a>
                </div>
            </div>
        </footer>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Reveal animations
        const revealElements = document.querySelectorAll('.reveal-text');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, { threshold: 0.15 });

        revealElements.forEach(el => observer.observe(el));

        // Card number formatting
        const cardInput = document.querySelector('input[placeholder*="1234"]');
        if (cardInput) {
            cardInput.addEventListener('input', (e) => {
                let value = e.target.value.replace(/\s/g, '').replace(/\D/g, '');
                let formatted = value.match(/.{1,4}/g)?.join(' ') || value;
                e.target.value = formatted.substr(0, 19);
            });
        }

        // Expiry date formatting
        const expiryInput = document.querySelector('input[placeholder="MM/YY"]');
        if (expiryInput) {
            expiryInput.addEventListener('input', (e) => {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length >= 2) {
                    value = value.substr(0, 2) + '/' + value.substr(2, 2);
                }
                e.target.value = value;
            });
        }

        // CVV validation
        const cvvInput = document.querySelector('input[placeholder="123"]');
        if (cvvInput) {
            cvvInput.addEventListener('input', (e) => {
                e.target.value = e.target.value.replace(/\D/g, '').substr(0, 4);
            });
        }

        // Form validation visual feedback
        const inputs = document.querySelectorAll('input[type="text"], input[type="email"]');
        inputs.forEach(input => {
            input.addEventListener('blur', () => {
                if (input.value.trim() !== '') {
                    input.classList.add('border-teal-500/30');
                    input.classList.remove('border-white/10');
                }
            });
            input.addEventListener('focus', () => {
                input.classList.remove('border-teal-500/30');
                input.classList.add('border-white/10');
            });
        });
    </script>
</body>
</html>









