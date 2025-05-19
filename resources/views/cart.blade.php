@php $user = auth()->user(); @endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cart - VIBE FINDER</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
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

    .dashboard-wrapper { display: flex; flex: 1; width: 100%; }
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
    .sidebar a i, .sidebar form button i { min-width: 24px; text-align: center; }
    .sidebar a span, .sidebar form button span { display: none; }
    .sidebar:hover { width: 200px; }
    .sidebar:hover a span, .sidebar:hover form button span {
      display: inline; margin-left: 10px;
    }

    .dashboard-content {
      flex: 1;
      padding: 2rem;
      display: flex;
      justify-content: center;
    }

    .cart-box {
      background-color: rgba(255, 255, 255, 0.1);
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
      width: 100%;
      max-width: 700px;
    }

    h2 { margin-bottom: 20px; text-align: center; }
    .btn-remove, .btn-pay {
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      background-color: #ffffff33;
      color: white;
      font-size: 15px;
      cursor: pointer;
    }
    .btn-remove:hover, .btn-pay:hover { background-color: #ffffff55; }

    .cart-list { margin-top: 30px; }
    .cart-item {
      padding: 12px;
      margin-bottom: 12px;
      border-radius: 10px;
      background-color: rgba(255, 255, 255, 0.15);
      display: flex;
      justify-content: space-between;
      align-items: center;
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
    .footer-section p, .footer-section ul, .footer-section a {
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
    .html {
  scroll-behavior: smooth;
}

  </style>
</head>
<body>

<header class="navbar">
  <div class="container">
    <div class="logo">VIBE FINDER</div>
    <nav>
      <ul class="nav-links">
        <li><a href="{{ route('user.dashboard') }}">Home</a></li>
        <li><a href="{{ route('events') }}">Events</a></li>
        <li><a href="#contact">Contact</a></li>        
      </ul>
    </nav>
  </div>
</header>

<div class="dashboard-wrapper">
  <div class="sidebar">
    <a href="{{ route('events') }}"><i class="fas fa-calendar-alt"></i><span>Events</span></a>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit"><i class="fas fa-sign-out-alt"></i><span>Logout</span></button>
    </form>
  </div>

  <div class="dashboard-content">
    <div class="cart-box">
      <h2>Your Cart</h2>

      @if (session('success'))
        <div style="background: #28a74566; padding: 10px; border-left: 5px solid #28a745; margin-bottom: 20px;">
          {{ session('success') }}
        </div>
      @endif

      @if ($cartItems->isEmpty())
        <p>Your cart is empty.</p>
      @else
        <div class="cart-list">
          @foreach ($cartItems as $item)
            <div class="cart-item">
              <span>{{ $item->event->title }} - ${{ $item->event->price }}</span>
              <form method="POST" action="{{ route('cart.remove', $item->event->id) }}">
                @csrf
                <button class="btn-remove" type="submit">Remove</button>
              </form>
            </div>
          @endforeach
        </div>
      @endif

      <div class="actions" style="margin-top: 20px; display: flex; justify-content: space-between;">
        <a href="{{ route('events') }}" class="btn-pay">Continue Browsing</a>
        <button class="btn-pay" onclick="window.location.href='{{ route('payment.page') }}'">Proceed to Payment</button>
      </div>
    </div>
  </div>
</div>

<footer class="footer">
  <div class="footer-container">
    <div class="footer-section contact" id="contact">
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
      <a href="#"><i class="fab fa-facebook-f"></i> Facebook</a>
      <a href="#"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
      <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
    </div>
  </div>
  <div class="footer-bottom">
    <p>© 2025 VIBE FINDER. All rights reserved.</p>
  </div>
</footer>

</body>
</html>
