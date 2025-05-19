@php
$user = auth()->user();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Account - VIBE FINDER</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

    .user-profile {
      background: rgba(255,255,255,0.1);
      padding: 2rem;
      border-radius: 10px;
      max-width: 800px;
      margin: auto;
    }

    .profile-img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      background-color: rgba(255,255,255,0.2);
      margin: 0 auto 20px;
      overflow: hidden;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .profile-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .user-profile h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .info-box {
      background: rgba(0, 0, 0, 0.3);
      padding: 15px;
      margin-bottom: 15px;
      border-radius: 8px;
    }

    .info-box strong {
      display: block;
      font-size: 16px;
      color: #eee;
    }

    .info-box span {
      color: #ccc;
      font-size: 15px;
    }

    .btn {
      padding: 10px 20px;
      background: linear-gradient(to right, #6a11cb, #2575fc);
      color: #fff;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
      text-decoration: none;
      display: inline-block;
    }

    .btn:hover {
      background: #5e0c9f;
      transform: scale(1.05);
    }

    .history-section {
      margin-top: 2rem;
    }

    .ticket-history {
      background: rgba(255,255,255,0.05);
      padding: 1rem;
      border-radius: 8px;
      margin-bottom: 1rem;
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
    
    .html {
  scroll-behavior: smooth;
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
        <li><a href="{{ route('events') }}">Events</a></li>
        <li><a href="{{ route('cart.view') }}">Cart</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
    </nav>
  </div>
</header>


  <!-- Sidebar + Content -->
  <div class="dashboard-wrapper">
    <div class="sidebar">
      <a href="{{ route('events') }}"><i class="fas fa-calendar-alt"></i><span>Events</span></a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"><i class="fas fa-sign-out-alt"></i><span>Logout</span></button>
      </form>
    </div>

    <div class="dashboard-content">
      <div class="user-profile">

        <!-- Profile Picture -->
        <div class="profile-img">
          @if ($user->profile_image)
            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image">
          @else
            <span>No Image</span>
          @endif
        </div>

        <h2>Welcome, {{ $user->name }}</h2>

        <div class="info-box">
          <strong>Username:</strong><span>{{ $user->name }}</span>
        </div>

        <div class="info-box">
          <strong>Email:</strong><span>{{ $user->email }}</span>
        </div>

        <div class="info-box">
          <strong>Phone:</strong><span>{{ $user->phone ?? 'Not provided' }}</span>
        </div>

        <div class="info-box">
          <strong>Age:</strong><span>{{ $user->age ?? 'Not provided' }}</span>
        </div>

        <div class="info-box">
          <strong>Preferences:</strong><span>{{ $user->preferences ?? 'Not provided' }}</span>
        </div>

        <!-- Edit Button -->
        <div style="text-align: center; margin-top: 20px;">
          <a href="{{ url('/user/edit') }}" class="btn">Edit Info</a>
        </div>

        <!-- Ticket History -->
        <div class="history-section">
          <h3>Ticketing History</h3>
          <div class="ticket-history">
            <p><strong>Event:</strong> AI Tech Summit 2025</p>
            <p><strong>Date:</strong> March 20, 2025</p>
            <p><strong>Status:</strong> Attended</p>
          </div>
          <div class="ticket-history">
            <p><strong>Event:</strong> Music Fest Cairo</p>
            <p><strong>Date:</strong> April 5, 2025</p>
            <p><strong>Status:</strong> Booked</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
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

