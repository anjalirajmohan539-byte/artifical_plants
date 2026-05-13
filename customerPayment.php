<?php 
include('database.php');
include('header.php');
?>
<link href="css/customerPayment.css" rel="stylesheet">
    <div class="container main">
        
        <!-- LEFT COLUMN: Form Details -->
        <main class="checkout-form">

            <!-- Shipping Address -->
            <section class="card">
                <h2 class="section-title"><span class="step-number">2</span> Shipping Address</h2>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" placeholder="John">
                    </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" placeholder="123 Main St">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" placeholder="New York">
                    </div>
                    <div class="form-group">
                        <label>State</label>
                        <select>
                            <option>New York</option>
                            <option>California</option>
                            <option>Texas</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>PIN Code</label>
                        <input type="text" >
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="tel">
                    </div>
                </div>
            </section>


               <!-- RIGHT COLUMN: Order Summary -->
        <aside class="order-summary">
            <div class="card">
                <h3 style="margin-bottom: 1.5rem;">Your Cart</h3>
                
                <div class="product-row">
                    <img src="https://via.placeholder.com/80x80/3b82f6/ffffff?text=Item" alt="Product" class="product-img">
                    <div class="product-info">
                        <h4>Minimalist Wireless Headphones</h4>
                        <p>Black / Matte Finish</p>
                        <p style="margin-top: 0.25rem; font-weight: 500;">₹110.00</p>
                    </div>
                </div>

                <div class="product-row" style="border-bottom: none; margin-bottom: 0.5rem;">
                    <img src="https://via.placeholder.com/80x80/10b981/ffffff?text=Case" alt="Product" class="product-img">
                    <div class="product-info">
                        <h4>Hard Shell Travel Case</h4>
                        <p>Fits all models</p>
                        <p style="margin-top: 0.25rem; font-weight: 500;">₹18.00</p>
                    </div>
                </div>

                <div class="divider"></div>

                <div class="summary-item">
                    <span class="text-gray">Subtotal</span>
                    <span>₹128.00</span>
                </div>
                <div class="summary-item">
                    <span class="text-gray">Shipping</span>
                    <span>Free</span>
                </div>
                <div class="summary-item">
                    <span class="text-gray">Taxes (Estimated)</span>
                    <span>₹0.00</span>
                </div>

                <div class="divider"></div>

                <div class="total-row">
                    <span>Total</span>
                    <span>USD ₹128.00</span>
                </div>
            </div>
        </aside>
        
        </main>

     
            <!-- Payment -->
            <section class="card">
                <h2 class="section-title"><span class="step-number">3</span> Payment</h2>
                
                <div class="payment-tabs">
                    <div class="tab active" onclick="switchTab('card')">Credit Card</div>
                    <div class="tab" onclick="switchTab('paypal')">PayPal</div>
                </div>

                <!-- Credit Card Form -->
                <div id="card-form">
                    <div class="card-icons">
                        <!-- Simple SVG placeholders for card icons -->
                        <svg width="32" height="20" viewBox="0 0 32 20" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="32" height="20" rx="2" fill="#E5E7EB"/><rect x="4" y="8" width="24" height="4" rx="1" fill="#9CA3AF"/></svg>
                        <svg width="32" height="20" viewBox="0 0 32 20" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="32" height="20" rx="2" fill="#E5E7EB"/><circle cx="12" cy="10" r="5" fill="#9CA3AF"/><circle cx="20" cy="10" r="5" fill="#6B7280" fill-opacity="0.5"/></svg>
                    </div>
                    <div class="form-group">
                        <label>Card Number</label>
                        <input type="text" placeholder="0000 0000 0000 0000">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Expiration (MM/YY)</label>
                            <input type="text" placeholder="MM/YY">
                        </div>
                        <div class="form-group">
                            <label>Security Code (CVC)</label>
                            <input type="text" placeholder="123">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Name on Card</label>
                        <input type="text" placeholder="John Doe">
                    </div>
                </div>

                <!-- PayPal Placeholder -->
                <div id="paypal-form" style="display: none; text-align: center; padding: 2rem;">
                    <p>You will be redirected to PayPal to complete your purchase securely.</p>
                </div>

                <button class="btn" style="margin-top: 1.5rem;">Pay Now • ₹128.00</button>
                
                <div class="secure-checkout">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    Transactions are secure and encrypted.
                </div>
            </section>

    </div>
<?php
include('footer.php');
?>
    <script>
        // Simple script to toggle payment tabs
        function switchTab(method) {
            const cardForm = document.getElementById('card-form');
            const paypalForm = document.getElementById('paypal-form');
            const tabs = document.querySelectorAll('.tab');

            if (method === 'card') {
                cardForm.style.display = 'block';
                paypalForm.style.display = 'none';
                tabs[0].classList.add('active');
                tabs[1].classList.remove('active');
            } else {
                cardForm.style.display = 'none';
                paypalForm.style.display = 'block';
                tabs[0].classList.remove('active');
                tabs[1].classList.add('active');
            }
        }
    </script>
</body>
</html>