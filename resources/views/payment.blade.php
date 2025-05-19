@php $user = auth()->user(); @endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Payment - VIBE FINDER</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body, html {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #6a11cb, #2575fc);
      color: #fff;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .navbar {
      background: rgba(0, 0, 0, 0.6);
      padding: 15px 0;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .navbar .container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 30px;
    }

    .logo { font-size: 24px; font-weight: bold; }
    .nav-links { list-style: none; display: flex; gap: 20px; }
    .nav-links li a { color: #fff; text-decoration: none; font-weight: 500; }

    .dashboard-wrapper {
      display: flex;
      flex: 1;
      width: 100%;
    }

    .sidebar {
      width: 60px;
      background-color: rgba(255, 255, 255, 0.05);
      min-height: calc(100vh - 100px);
      display: flex;
      flex-direction: column;
      align-items: center;
      transition: width 0.3s ease;
      overflow-x: hidden;
    }

    .sidebar a, .sidebar form button {
      width: 100%;
      display: flex;
      align-items: center;
      color: white;
      text-decoration: none;
      padding: 1rem;
      background: none;
      border: none;
      font: inherit;
      cursor: pointer;
      transition: 0.3s;
    }

    .sidebar a i, .sidebar form button i {
      min-width: 24px;
      text-align: center;
    }

    .sidebar a span, .sidebar form button span {
      display: none;
    }

    .sidebar:hover {
      width: 200px;
    }

    .sidebar:hover a span,
    .sidebar:hover form button span {
      display: inline;
      margin-left: 10px;
    }

    .dashboard-content {
      flex: 1;
      padding: 2rem;
      display: flex;
      justify-content: center;
    }

    .payment-box {
      background-color: rgba(255, 255, 255, 0.1);
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
      width: 100%;
      max-width: 500px;
    }

    h2 {
      margin-bottom: 25px;
      text-align: center;
    }

    input, select {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: none;
      border-radius: 8px;
      font-size: 16px;
    }

    .btn-pay {
      padding: 12px;
      width: 100%;
      border: none;
      border-radius: 8px;
      background-color: #ffffff33;
      color: white;
      font-size: 16px;
      cursor: pointer;
      margin-top: 20px;
    }

    .btn-pay:hover {
      background-color: #ffffff55;
    }

    .success {
      background-color: rgba(76, 175, 80, 0.2);
      border-left: 5px solid #4CAF50;
      padding: 15px;
      margin-top: 20px;
      color: #d4edda;
      display: none;
    }

    .footer {
      background-color: #111;
      color: #ddd;
      padding: 40px 20px 20px;
      margin-top: auto;
    }

    .footer-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      gap: 30px;
      max-width: 1200px;
      margin: auto;
    }

    .footer-section {
      flex: 1 1 250px;
    }

    .footer-section h3 {
      color: #fff;
      margin-bottom: 15px;
    }

    .footer-section p,
    .footer-section ul,
    .footer-section a {
      font-size: 14px;
      line-height: 1.6;
      color: #ccc;
      text-decoration: none;
    }

    .footer-section ul {
      list-style: none;
      padding: 0;
    }

    .footer-section ul li {
      margin-bottom: 8px;
    }

    .footer-section a:hover {
      color: #fff;
      text-decoration: underline;
    }

    .footer-bottom {
      text-align: center;
      padding-top: 20px;
      font-size: 13px;
      border-top: 1px solid #333;
      margin-top: 30px;
    }

    .footer-section .fab {
      margin-right: 8px;
      color: #ccc;
    }

    .footer-section a:hover .fab {
      color: #fff;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<header class="navbar">
  <div class="container">
    <div class="logo">VIBE FINDER</div>
    <nav>
      <ul class="nav-links">
        <li><a href="{{ route('user.dashboard') }}">Home</a></li>
    </nav>
  </div>
</header>



  <div class="dashboard-content">
    <div class="payment-box">
      <h2>Complete Your Payment</h2>
      <form id="paymentForm" onsubmit="handlePayment(event)">
        <input type="text" placeholder="Cardholder Name" required />
        <input type="text" placeholder="Card Number" maxlength="16" required />
        <input type="text" placeholder="Expiry Date (MM/YY)" required />
        <input type="text" placeholder="CVV" maxlength="4" required />
        <select required>
          <option value="">Select Payment Method</option>
          <option value="credit">Credit Card</option>
          <option value="debit">Debit Card</option>
          <option value="paypal">PayPal</option>
        </select>
        <button type="submit" class="btn-pay">Pay Now</button>
      </form>
      <div class="success" id="paymentSuccess">✅ Payment successful! Enjoy your event.</div>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="footer">
  <div class="footer-container">
    <div class="footer-section contact">
      <h3>Contact Us</h3>
      <p>Email: support@VIBE_FINDER.com</p>
      <p>Phone: +1 (555) 123-4567</p>
      <p>Location: 123 Event St, Tech City</p>
    </div>
    <div class="footer-section links">
      <h3>Quick Links</h3>
      <ul>
        <li><a href="#about">About</a></li>
        <li><a href="#partners">Partners</a></li>
        <li><a href="#reviews">Reviews</a></li>
        <li><a href="#hero">Home</a></li>
      </ul>
    </div>
    <div class="footer-section social">
      <h3>Follow Us</h3>
      <div style="display: flex; flex-direction: column; gap: 8px;">
        <a href="#"><i class="fab fa-facebook-f"></i> Facebook</a>
        <a href="#"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
        <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <p>© 2025 VIBE FINDER. All rights reserved.</p>
  </div>
</footer>

<script>
  function handlePayment(e) {
    e.preventDefault();
    document.getElementById("paymentSuccess").style.display = "block";
    localStorage.removeItem("eventCart"); // clear cart after payment
  }
</script>

</body>
</html>
