<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - E-Commerce Dashboard</title>
    <link rel="stylesheet" href="css/test.css">
</head>
<body>

    <!-- Header -->
    <header>
        <div class="brand">
            <svg class="icon" viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
            ShopMaster
        </div>
        <nav class="user-nav">
            <a href="#" class="btn btn-ghost" aria-label="Cart">
                <svg class="icon" viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
            </a>
            <div class="user-avatar">JD</div>
        </nav>
    </header>

    <div class="container">
        <!-- Sidebar Filters -->
        <aside>
            <input type="text" id="searchInput" class="search-input" placeholder="Search order ID...">
            
            <div class="filter-group">
                <div class="filter-title">Order Status</div>
                <label class="filter-option">
                    <input type="checkbox" name="status" value="all" checked> All Orders
                </label>
                <label class="filter-option">
                    <input type="checkbox" name="status" value="processing"> Processing
                </label>
                <label class="filter-option">
                    <input type="checkbox" name="status" value="shipped"> Shipped
                </label>
                <label class="filter-option">
                    <input type="checkbox" name="status" value="delivered"> Delivered
                </label>
                <label class="filter-option">
                    <input type="checkbox" name="status" value="cancelled"> Cancelled
                </label>
            </div>

            <div class="filter-group">
                <div class="filter-title">Time Period</div>
                <select id="timeFilter" class="search-input" style="margin-bottom: 0;">
                    <option value="all">All Time</option>
                    <option value="30">Last 30 Days</option>
                    <option value="90">Last 3 Months</option>
                    <option value="365">Last Year</option>
                </select>
            </div>
        </aside>

        <!-- Main Content -->
        <main>
            <div class="orders-header">
                <h1>My Orders</h1>
            </div>

            <!-- Tabs -->
            <div class="tabs">
                <button class="tab active" data-tab="all">All Orders</button>
                <button class="tab" data-tab="open">Open Orders</button>
                <button class="tab" data-tab="completed">Completed</button>
            </div>

            <!-- Order List Container -->
            <div id="orderList" class="order-list">
                <!-- Orders will be injected here via JS -->
            </div>
        </main>
    </div>

    <!-- Order Details Modal -->
    <div class="modal-overlay" id="orderModal">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title" id="modalOrderId">Order #12345</h3>
                <button class="btn btn-ghost" id="closeModalBtn">
                    <svg class="icon" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body" id="modalContent">
                <!-- Dynamic Content -->
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" id="modalCloseBtnBottom">Close</button>
                <button class="btn btn-primary" id="modalActionBtn">Buy Again</button>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div id="toast-container"></div>

    <script>
        // --- Mock Data ---
        const ordersData = [
            {
                id: "ORD-7721",
                date: "2023-10-25",
                total: 129.99,
                status: "delivered",
                items: [
                    { name: "Wireless Noise Cancelling Headphones", price: 99.99, qty: 1, img: "https://picsum.photos/seed/headphone/100/100" },
                    { name: "Phone Case - Matte Black", price: 15.00, qty: 2, img: "https://picsum.photos/seed/case/100/100" }
                ],
                shipping: { address: "123 Tech Lane, Silicon Valley, CA", method: "Express Delivery", cost: 0 },
                timeline: [
                    { title: "Order Placed", date: "Oct 25, 2023 - 10:00 AM", status: "completed" },
                    { title: "Shipped", date: "Oct 26, 2023 - 02:30 PM", status: "completed" },
                    { title: "Delivered", date: "Oct 28, 2023 - 11:15 AM", status: "completed" }
                ]
            },
            {
                id: "ORD-7722",
                date: "2023-11-02",
                total: 45.50,
                status: "shipped",
                items: [
                    { name: "Mechanical Keyboard Switches", price: 12.50, qty: 2, img: "https://picsum.photos/seed/switch/100/100" },
                    { name: "USB-C Cable (2m)", price: 10.00, qty: 1, img: "https://picsum.photos/seed/cable/100/100" },
                    { name: "Keycap Puller", price: 5.00, qty: 1, img: "https://picsum.photos/seed/tool/100/100" }
                ],
                shipping: { address: "456 Dev Street, Portland, OR", method: "Standard Shipping", cost: 5.50 },
                timeline: [
                    { title: "Order Placed", date: "Nov 2, 2023 - 09:15 AM", status: "completed" },
                    { title: "Shipped", date: "Nov 3, 2023 - 04:00 PM", status: "completed" },
                    { title: "Out for Delivery", date: "Pending", status: "pending" }
                ]
            },
            {
                id: "ORD-7723",
                date: "2023-11-10",
                total: 899.00,
                status: "processing",
                items: [
                    { name: "27-inch 4K Monitor", price: 899.00, qty: 1, img: "https://picsum.photos/seed/monitor/100/100" }
                ],
                shipping: { address: "789 Design Ave, New York, NY", method: "Freight", cost: 0 },
                timeline: [
                    { title: "Order Placed", date: "Nov 10, 2023 - 08:30 AM", status: "completed" },
                    { title: "Processing", date: "In Progress", status: "pending" }
                ]
            },
            {
                id: "ORD-7720",
                date: "2023-09-15",
                total: 25.00,
                status: "cancelled",
                items: [
                    { name: "Screen Cleaning Kit", price: 25.00, qty: 1, img: "https://picsum.photos/seed/clean/100/100" }
                ],
                shipping: { address: "123 Tech Lane, Silicon Valley, CA", method: "Standard", cost: 0 },
                timeline: [
                    { title: "Order Placed", date: "Sep 15, 2023", status: "completed" },
                    { title: "Cancelled", date: "Sep 15, 2023", status: "completed" }
                ]
            }
        ];

        // --- State ---
        let currentTab = 'all';
        let filters = {
            search: '',
            status: ['all'], // We treat 'all' specially
            time: 'all'
        };

        // --- DOM Elements ---
        const orderListEl = document.getElementById('orderList');
        const searchInput = document.getElementById('searchInput');
        const timeFilter = document.getElementById('timeFilter');
        const statusCheckboxes = document.querySelectorAll('input[name="status"]');
        const tabs = document.querySelectorAll('.tab');
        
        // Modal Elements
        const modalOverlay = document.getElementById('orderModal');
        const modalOrderId = document.getElementById('modalOrderId');
        const modalContent = document.getElementById('modalContent');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const modalCloseBtnBottom = document.getElementById('modalCloseBtnBottom');
        const modalActionBtn = document.getElementById('modalActionBtn');

        // --- Helpers ---
        const formatCurrency = (amount) => `$${amount.toFixed(2)}`;
        const formatDate = (dateStr) => new Date(dateStr).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
        
        function showToast(message) {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = 'toast';
            toast.innerHTML = `
                <svg class="icon" viewBox="0 0 24 24" style="color: #4ade80"><polyline points="20 6 9 17 4 12"></polyline></svg>
                ${message}
            `;
            container.appendChild(toast);

            // Remove after 3 seconds
            setTimeout(() => {
                toast.style.animation = 'fadeOut 0.3s ease-out forwards';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // --- Rendering ---
        function getStatusBadge(status) {
            const map = {
                'delivered': 'status-delivered',
                'shipped': 'status-shipped',
                'processing': 'status-processing',
                'cancelled': 'status-cancelled'
            };
            return `<span class="badge ${map[status] || ''}">${status}</span>`;
        }

        function renderOrders() {
            orderListEl.innerHTML = '';
            
            // Filter Logic
            const filteredOrders = ordersData.filter(order => {
                // Tab Filter
                if (currentTab === 'open' && (order.status === 'delivered' || order.status === 'cancelled')) return false;
                if (currentTab === 'completed' && order.status !== 'delivered') return false;

                // Search Filter
                if (filters.search && !order.id.toLowerCase().includes(filters.search.toLowerCase())) return false;

                // Status Checkbox Filter
                const allChecked = filters.status.includes('all');
                const statusChecked = filters.status.includes(order.status);
                if (!allChecked && !statusChecked) return false;

                // Time Filter (Basic implementation based on days ago)
                if (filters.time !== 'all') {
                    const daysAgo = (Date.now() - new Date(order.date)) / (1000 * 60 * 60 * 24);
                    if (daysAgo > parseInt(filters.time)) return false;
                }

                return true;
            });

            if (filteredOrders.length === 0) {
                orderListEl.innerHTML = `
                    <div class="empty-state">
                        <svg class="icon" style="width:48px; height:48px; margin-bottom:1rem; color:#cbd5e1" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                        <h3>No orders found</h3>
                        <p>Try adjusting your filters or search terms.</p>
                    </div>
                `;
                return;
            }

            filteredOrders.forEach(order => {
                const itemCount = order.items.length;
                const firstItems = order.items.slice(0, 3);
                const extraItems = itemCount > 3 ? itemCount - 3 : 0;

                let imagesHtml = '';
                firstItems.forEach(item => {
                    imagesHtml += `<img src="${item.img}" alt="${item.name}" class="product-img">`;
                });
                if (extraItems > 0) {
                    imagesHtml += `<div class="product-img more" style="background: #f1f5f9; display:flex; align-items:center; justify-content:center; color:#64748b; border:1px solid #e2e8f0;">+${extraItems}</div>`;
                }

                // Determine buttons based on status
                let actionButtons = '';
                if (order.status === 'processing' || order.status === 'shipped') {
                    actionButtons = `
                        <button class="btn btn-outline" onclick="trackOrder('${order.id}')">Track Package</button>
                        <button class="btn btn-ghost" style="color: #ef4444;" onclick="cancelOrder('${order.id}')">Cancel</button>
                    `;
                } else if (order.status === 'delivered') {
                    actionButtons = `
                        <button class="btn btn-primary" onclick="buyAgain('${order.id}')">Buy Again</button>
                        <button class="btn btn-ghost" onclick="viewDetails('${order.id}')">View Details</button>
                    `;
                } else if (order.status === 'cancelled') {
                    actionButtons = `<span style="color:var(--text-muted); font-size:0.9rem;">Order cancelled on ${formatDate(order.date)}</span>`;
                }

                const card = document.createElement('div');
                card.className = 'order-card';
                card.innerHTML = `
                    <div class="card-header">
                        <div>
                            <div class="order-id">${order.id}</div>
                            <div class="order-date">Placed on ${formatDate(order.date)}</div>
                        </div>
                        ${getStatusBadge(order.status)}
                    </div>
                    <div class="card-body">
                        <div class="product-preview">
                            ${imagesHtml}
                        </div>
                        <div class="order-info">
                            <div style="font-size:0.9rem; color:var(--text-muted); margin-bottom:0.25rem;">Total (${itemCount} items)</div>
                            <div class="total-price">${formatCurrency(order.total)}</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-ghost" onclick="viewDetails('${order.id}')">See Details</button>
                        <div style="display:flex; gap:0.5rem;">
                            ${actionButtons}
                        </div>
                    </div>
                `;
                orderListEl.appendChild(card);
            });
        }

        // --- Interaction Logic ---

        // Filter Event Listeners
        searchInput.addEventListener('input', (e) => {
            filters.search = e.target.value;
            renderOrders();
        });

        timeFilter.addEventListener('change', (e) => {
            filters.time = e.target.value;
            renderOrders();
        });

        statusCheckboxes.forEach(cb => {
            cb.addEventListener('change', (e) => {
                if (e.target.value === 'all') {
                    if (e.target.checked) {
                        statusCheckboxes.forEach(c => { if(c.value !== 'all') c.checked = false; });
                        filters.status = ['all'];
                    } else {
                        // Prevent unchecking "All" if nothing else is checked
                        e.target.checked = true; 
                    }
                } else {
                    const allCb = document.querySelector('input[value="all"]');
                    allCb.checked = false;
                    filters.status = Array.from(statusCheckboxes)
                        .filter(c => c.checked && c.value !== 'all')
                        .map(c => c.value);
                    
                    if (filters.status.length === 0) {
                        allCb.checked = true;
                        filters.status = ['all'];
                    }
                }
                renderOrders();
            });
        });

        // Tabs Event Listeners
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                currentTab = tab.dataset.tab;
                renderOrders();
            });
        });

        // Order Actions (Global functions for inline HTML calls)
        window.viewDetails = (id) => {
            const order = ordersData.find(o => o.id === id);
            if (!order) return;

            modalOrderId.innerText = `Order #${order.id}`;
            
            // Generate Items HTML
            const itemsHtml = order.items.map(item => `
                <div class="order-item">
                    <img src="${item.img}" alt="${item.name}">
                    <div>
                        <div style="font-weight:600;">${item.name}</div>
                        <div style="color:var(--text-muted); font-size:0.85rem;">Qty: ${item.qty} • ${formatCurrency(item.price)}</div>
                    </div>
                    <div style="margin-left:auto; font-weight:500;">${formatCurrency(item.price * item.qty)}</div>
                </div>
            `).join('');

            // Generate Timeline HTML
            const timelineHtml = order.timeline.map(step => `
                <div class="timeline-item ${step.status === 'completed' ? 'completed' : ''}">
                    <div class="timeline-title">${step.title}</div>
                    <div class="timeline-date">${step.date}</div>
                </div>
            `).join('');

            // Modal Content
            modalContent.innerHTML = `
                <div class="detail-row">
                    <span class="detail-label">Order Date</span>
                    <span>${formatDate(order.date)}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Total Amount</span>
                    <span style="font-weight:700;">${formatCurrency(order.total)}</span>
                </div>
                
                <h4 style="margin-top:1.5rem; margin-bottom:1rem;">Items</h4>
                <div class="order-items-list">
                    ${itemsHtml}
                </div>

                <h4 style="margin-top:1rem; margin-bottom:1rem;">Shipping Address</h4>
                <div style="font-size:0.95rem; color:var(--text-muted); margin-bottom:1.5rem;">
                    ${order.shipping.address}<br>
                    Method: ${order.shipping.method}
                </div>

                <h4 style="margin-bottom:1rem;">Order Updates</h4>
                <div class="timeline">
                    ${timelineHtml}
                </div>
            `;

            // Configure "Buy Again" button in modal
            modalActionBtn.onclick = () => {
                buyAgain(id);
                closeModal();
            };

            modalOverlay.classList.add('open');
        };

        window.buyAgain = (id) => {
            // Simulate API call
            const btn = event.target;
            const originalText = btn.innerText;
            btn.innerText = "Adding...";
            btn.disabled = true;

            setTimeout(() => {
                showToast(`Items from ${id} added to cart!`);
                btn.innerText = originalText;
                btn.disabled = false;
            }, 800);
        };

        window.cancelOrder = (id) => {
            if(confirm("Are you sure you want to cancel this order? This action cannot be undone.")) {
                const orderIndex = ordersData.findIndex(o => o.id === id);
                if (orderIndex > -1) {
                    ordersData[orderIndex].status = 'cancelled';
                    showToast(`Order ${id} has been cancelled.`);
                    renderOrders();
                }
            }
        };

        window.trackOrder = (id) => {
            showToast(`Tracking information for ${id} copied to clipboard.`);
        };

        // Modal Controls
        function closeModal() {
            modalOverlay.classList.remove('open');
        }

        closeModalBtn.addEventListener('click', closeModal);
        modalCloseBtnBottom.addEventListener('click', closeModal);
        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) closeModal();
        });

        // Initial Render
        renderOrders();

    </script>
</body>
</html>









