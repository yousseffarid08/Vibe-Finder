@php $user = auth()->user(); @endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>My Events - VIBE FINDER</title>
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
      flex-wrap: wrap;
      gap: 20px;
    }
    .event-card {
      background: rgba(255,255,255,0.1);
      padding: 20px;
      border-radius: 10px;
      width: 300px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }
    .event-title {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 8px;
    }
    .event-label {
      background: #00000033;
      padding: 5px 10px;
      border-radius: 6px;
      font-size: 12px;
      text-transform: uppercase;
      margin-bottom: 8px;
      display: inline-block;
    }
    .event-info {
      font-size: 14px;
      line-height: 1.4;
    }
    .event-actions {
      margin-top: 10px;
      display: flex;
      gap: 10px;
    }
    .btn {
      padding: 8px 14px;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      text-decoration: none;
      transition: 0.3s;
    }
    .btn-edit {
      background-color: #ffa500;
      color: #fff;
    }
    .btn-delete {
      background-color: #cc3333;
      color: #fff;
    }
    .success-message {
      background-color: #28a745;
      padding: 10px;
      color: white;
      border-radius: 6px;
      margin-bottom: 20px;
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
        <li><a href="{{ route('events') }}">Browse Events</a></li>
        <li><a href="{{ route('organizer.dashboard') }}">Dashboard</a></li>
      </ul>
    </nav>
  </div>
</header>
<div class="dashboard-wrapper">
  <div class="sidebar">
    <a href="{{ url('/organizer') }}"><i class="fas fa-user-cog"></i><span>Dashboard</span></a>
    <a href="{{ route('organizer.create_event') }}"><i class="fas fa-plus-circle"></i><span>Create Event</span></a>
    <a href="{{ route('organizer.my_events') }}"><i class="fas fa-tasks"></i><span>Manage Events</span></a>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit"><i class="fas fa-sign-out-alt"></i><span>Logout</span></button>
    </form>
  </div>
  <div class="dashboard-content">
    <h2>My Created Events</h2>
    @if (session('success'))
      <div class="success-message">{{ session('success') }}</div>
    @endif
    @if ($events->isEmpty())
      <p>You haven't created any events yet.</p>
    @else
      <div class="event-grid">
        @foreach ($events as $event)
          <div class="event-card">
            <span class="event-label">{{ $event->label }}</span>
            <div class="event-title">{{ $event->title }}</div>
            <div class="event-info">
              <p><strong>Description:</strong> {{ $event->desc }}</p>
              <p><strong>Location:</strong> {{ $event->location }}</p>
              <p><strong>Date:</strong> {{ $event->date }}</p>
              <p><strong>Time:</strong> {{ $event->time }}</p>
              <p><strong>Price:</strong> ${{ number_format($event->price, 2) }}</p>
              <p><strong>Seats:</strong> {{ $event->seats }}</p>
            </div>
            <div class="event-actions">
              <a href="{{ route('organizer.edit_event', $event->id) }}" class="btn btn-edit">Edit</a>
              <form method="POST" action="{{ route('organizer.delete_event', $event->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete">Delete</button>
              </form>
            </div>
          </div>
        @endforeach
      </div>
    @endif
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
