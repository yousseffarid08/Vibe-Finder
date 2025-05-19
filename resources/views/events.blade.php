@php $user = auth()->user(); @endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Events - VIBE FINDER</title>
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
    .logo {
      font-size: 24px;
      font-weight: bold;
    }
    .nav-links {
      list-style: none;
      display: flex;
      gap: 20px;
    }
    .nav-links li a {
      color: #fff;
      text-decoration: none;
      font-weight: 500;
    }
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
    }
    .event-grid {
      display: flex;
      overflow-x: auto;
      gap: 20px;
      padding: 20px 0;
    }
    .event-card {
      flex: 0 0 300px;
      background-color: rgba(255, 255, 255, 0.1);
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s ease;
    }
    .event-card:hover {
      transform: translateY(-5px);
    }
    .event-label {
      display: inline-block;
      padding: 5px 10px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: bold;
      background-color: #00000066;
      margin-bottom: 10px;
      text-transform: uppercase;
    }
    .event-title {
      font-size: 20px;
      font-weight: bold;
      margin: 10px 0 5px;
    }
    .event-desc {
      font-size: 14px;
      line-height: 1.5;
    }
    .event-meta {
      margin-top: 10px;
      font-size: 14px;
    }
    .add-to-cart-btn {
      margin-top: 15px;
      padding: 10px 20px;
      background-color: #ffffff33;
      border: none;
      border-radius: 8px;
      color: white;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    .add-to-cart-btn:hover {
      background-color: #ffffff55;
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

<header class="navbar">
  <div class="container">
    <div class="logo">VIBE FINDER</div>
    <nav>
      <ul class="nav-links">
        <li><a href="{{ route('user.dashboard') }}">Home</a></li>
        <li><a href="{{ route('cart.view') }}">Cart</a></li>
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
    <form method="GET" action="{{ route('events') }}">
      <div class="filters-section" style="text-align: center; margin-bottom: 30px;">
        <input type="text" name="search" placeholder="Search events..." value="{{ request('search') }}" class="search-bar"/>
        <button type="submit" class="add-to-cart-btn">Search</button>
      </div>
    </form>

    <h2 style="margin-top: 20px;">Upcoming Events</h2>

    <div class="event-grid">
      @forelse ($events as $event)
        <div class="event-card">
          <span class="event-label">{{ $event->label }}</span>
          <div class="event-title">{{ $event->title }}</div>
          <div class="event-meta">
            <p><strong>Description:</strong> {{ $event->desc }}</p>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</p>
            <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($event->time)->format('g:i A') }}</p>
            <p><strong>Location:</strong> {{ $event->location }}</p>
            <p><strong>Price:</strong> ${{ number_format($event->price, 2) }}</p>
          </div>

          <form method="POST" action="{{ route('cart.add', $event->id) }}">
            @csrf
            <button type="submit" class="add-to-cart-btn">Add to Cart</button>
          </form>
        </div>
      @empty
        <p>No events found matching your search.</p>
      @endforelse
    </div>
  </div>
</div>

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

</body>
</html>

