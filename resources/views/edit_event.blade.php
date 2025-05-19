@php $user = auth()->user(); @endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Edit Event - VIBE FINDER</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #6a11cb, #2575fc);
      color: white;
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

    .content-area {
      flex: 1;
      padding: 2rem;
    }

    .form-container {
      max-width: 800px;
      margin: auto;
      padding: 30px;
      background: rgba(255,255,255,0.1);
      border-radius: 12px;
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input, select {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border-radius: 6px;
      border: none;
    }

    .btn {
      background: #6a11cb;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
      width: 100%;
    }

    .btn:hover {
      background: #4e0ca8;
    }

    footer {
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
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('events') }}">Events</a></li>
        <li><a href="#">Cart</a></li>
        <li><a href="#">Paying</a></li>
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

  <div class="content-area">
    <div class="form-container">
      <h2>Edit Event</h2>

      <form method="POST" action="{{ route('organizer.update_event', $event->id) }}">
        @csrf
        @method('PUT')

        <label for="label">Category</label>
        <select name="label" required>
          <option {{ $event->label == 'Music' ? 'selected' : '' }}>Music</option>
          <option {{ $event->label == 'Sports' ? 'selected' : '' }}>Sports</option>
          <option {{ $event->label == 'Tech' ? 'selected' : '' }}>Tech</option>
          <option {{ $event->label == 'Art' ? 'selected' : '' }}>Art</option>
          <option {{ $event->label == 'Food' ? 'selected' : '' }}>Food</option>
          <option {{ $event->label == 'Gaming' ? 'selected' : '' }}>Gaming</option>
        </select>

        <label for="title">Title</label>
        <input type="text" name="title" value="{{ $event->title }}" required>

        <label for="desc">Description</label>
        <textarea name="desc" rows="4" required>{{ $event->desc }}</textarea>
        
        <label for="location">Location</label>
        <input type="text" name="location" value="{{ $event->location }}" required>


        <label for="date">Date</label>
        <input type="date" name="date" value="{{ $event->date }}" required>

        <label for="time">Time</label>
        <input type="time" name="time" value="{{ $event->time }}" required>

        <label for="price">Price</label>
        <input type="number" name="price" value="{{ $event->price }}" step="0.01" required>

        <label for="seats">Seats</label>
        <input type="number" name="seats" value="{{ $event->seats }}" required>

        <button type="submit" class="btn">Update Event</button>
      </form>
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
