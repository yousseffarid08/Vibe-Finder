@php $user = auth()->user(); @endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Organizer Dashboard - VIBE FINDER</title>
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
      align-items: center;
    }

    .nav-links li a {
      color: #fff;
      text-decoration: none;
      font-weight: 500;
    }

    .notification-wrapper {
      position: relative;
    }

    .notification-badge {
      background: red;
      color: white;
      font-size: 10px;
      padding: 2px 6px;
      border-radius: 50%;
      position: absolute;
      top: -5px;
      right: -10px;
    }

    .notification-dropdown {
      position: absolute;
      top: 35px;
      right: 0;
      background: #222;
      border: 1px solid #444;
      border-radius: 8px;
      width: 280px;
      padding: 15px;
      display: none;
      z-index: 999;
    }

    .notification-dropdown h4 {
      margin-bottom: 10px;
      color: #fff;
      font-size: 16px;
      border-bottom: 1px solid #444;
      padding-bottom: 5px;
    }

    .notification-dropdown ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .notification-dropdown ul li {
      font-size: 14px;
      color: #ccc;
      padding: 6px 0;
      border-bottom: 1px solid #333;
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

    .card {
      background: rgba(255,255,255,0.1);
      padding: 2rem;
      border-radius: 12px;
      max-width: 700px;
      margin: auto;
      text-align: center;
    }

    .card h2 {
      margin-bottom: 1rem;
    }

    .organizer-info-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      background-color: rgba(255, 255, 255, 0.05);
      padding: 1.5rem;
      border-radius: 10px;
      font-size: 15px;
      margin-bottom: 25px;
    }

    .organizer-info-grid .info-pair {
      display: flex;
      flex-direction: column;
    }

    .organizer-info-grid .info-pair strong {
      font-weight: bold;
      margin-bottom: 4px;
      color: #fff;
    }

    .organizer-info-grid .info-pair span {
      color: #ddd;
    }

    .organizer-info-grid .full-width {
      grid-column: span 2;
    }

    .btn {
      margin-top: 20px;
      display: inline-block;
      background: linear-gradient(to right, #6a11cb, #2575fc);
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      color: white;
      font-weight: bold;
      text-decoration: none;
      transition: 0.3s;
    }

    .btn:hover {
      background-color: #5e0c9f;
      transform: scale(1.05);
    }

    .footer { background-color: #111; color: #ddd; padding: 40px 20px 20px; margin-top: auto; }
    .footer-container { display: flex; flex-wrap: wrap; justify-content: space-between; gap: 30px; max-width: 1200px; margin: auto; }
    .footer-section { flex: 1 1 250px; }
    .footer-section h3 { color: #fff; margin-bottom: 15px; }
    .footer-section p, .footer-section ul, .footer-section a { font-size: 14px; line-height: 1.6; color: #ccc; text-decoration: none; }
    .footer-section ul { list-style: none; padding: 0; }
    .footer-section ul li { margin-bottom: 8px; }
    .footer-section a:hover { color: #fff; text-decoration: underline; }
    .footer-bottom { text-align: center; padding-top: 20px; font-size: 13px; border-top: 1px solid #333; margin-top: 30px; }
    .footer-section .fab { margin-right: 8px; color: #ccc; }
    .footer-section a:hover .fab { color: #fff; }
  </style>
</head>
<body>

<header class="navbar">
  <div class="container">
    <div class="logo">VIBE FINDER</div>
    <nav>
      <ul class="nav-links">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="notification-wrapper">
          <a href="javascript:void(0);" onclick="toggleNotifications()">
            <i class="fas fa-bell"></i>
            <span class="notification-badge">3</span>
          </a>
          <div class="notification-dropdown" id="notificationDropdown">
            <h4>Notifications</h4>
            <ul>
              <li><strong>New Booking:</strong> Youssef Farid booked your event</li>
              <li><strong>Reminder:</strong> Cairo Jazz Nights starting in 1 hour</li>
            </ul>
          </div>
        </li>
      </ul>
    </nav>
  </div>
</header>

<div class="dashboard-wrapper">
  <div class="sidebar">
    <a href="{{ url('/organizer') }}"><i class="fas fa-user-cog"></i><span>Dashboard</span></a>
    <a href="{{ route('organizer.my_events') }}"><i class="fas fa-tasks"></i><span>Manage Events</span></a>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit"><i class="fas fa-sign-out-alt"></i><span>Logout</span></button>
    </form>
  </div>

  <div class="dashboard-content">
    <div class="card">
      <h2>Welcome, {{ $user->name }}</h2>
      <p>You are logged in as an <strong>Event Organizer</strong>.</p>

      <div class="organizer-info-grid">
        <div class="info-pair"><strong>Name:</strong> <span>{{ $user->name }}</span></div>
        <div class="info-pair"><strong>Email:</strong> <span>{{ $user->email }}</span></div>
        <div class="info-pair"><strong>Phone:</strong> <span>{{ $user->phone ?? 'Not provided' }}</span></div>
        <div class="info-pair"><strong>Age:</strong> <span>{{ $user->age ?? 'Not provided' }}</span></div>
        <div class="info-pair"><strong>Role:</strong> <span>{{ ucfirst($user->role) }}</span></div>
        <div class="info-pair full-width"><strong>About You:</strong><br><span>{{ $user->bio ?? 'No description provided.' }}</span></div>
      </div>

      <div style="display: flex; justify-content: center; gap: 15px; flex-wrap: wrap; margin-top: 25px;">
        <a href="{{ route('organizer.edit') }}" class="btn">Edit Organizer Info</a>
        <a href="{{ route('organizer.create_event') }}" class="btn">Create New Event</a>
      </div>

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

<script>
  function toggleNotifications() {
    const dropdown = document.getElementById('notificationDropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
  }
  document.addEventListener('click', function(event) {
    const wrapper = document.querySelector('.notification-wrapper');
    const dropdown = document.getElementById('notificationDropdown');
    if (!wrapper.contains(event.target)) {
      dropdown.style.display = 'none';
    }
  });
</script>

</body>
</html>