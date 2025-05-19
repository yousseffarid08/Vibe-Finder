@php $user = auth()->user(); @endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Create Event - VIBE FINDER</title>
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

    .form-container {
      background: rgba(255, 255, 255, 0.1);
      width: 70%;
      margin: 50px auto;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 30px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      font-weight: bold;
      margin-bottom: 8px;
      color: #fff;
    }

    .form-group input, .form-group textarea, .form-group select {
      width: 100%;
      padding: 12px;
      border-radius: 6px;
      border: none;
      font-size: 16px;
      color: #333;
    }

    .form-group input:focus, .form-group textarea:focus {
      outline: none;
      border: 2px solid #6a11cb;
    }

    .submit-btn {
      background-color: #6a11cb;
      color: white;
      border: none;
      padding: 14px;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
      width: 100%;
      margin-top: 10px;
      font-size: 16px;
    }

    .submit-btn:hover {
      background-color: #520ca8;
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
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('events') }}">Browse Events</a></li>
        <li><a href="{{ url('/organizer') }}">Dashboard</a></li>
      </ul>
    </nav>
  </div>
</header>

<div class="form-container">
  <h2>Create a New Event</h2>

  @if ($errors->any())
    <div style="color: #ffb3b3; margin-bottom: 20px;">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('organizer.store_event') }}">
    @csrf
    <div class="form-group">
      <label for="label">Category</label>
      <select name="label" required>
        <option value="">-- Select Category --</option>
        <option>Music</option>
        <option>Sports</option>
        <option>Tech</option>
        <option>Art</option>
        <option>Food</option>
        <option>Gaming</option>
      </select>
    </div>

    <div class="form-group">
      <label for="title">Event Title</label>
      <input type="text" name="title" required placeholder="e.g., Startup Pitch Night"/>
    </div>

    <div class="form-group">
      <label for="desc">Description</label>
      <textarea name="desc" rows="4" required placeholder="Describe the event here..."></textarea>
    </div>

    <div class="form-group">
      <label for="location">Location</label>
      <input type="text" name="location" required placeholder="e.g., Cairo International Center"/>
    </div>

    <div class="form-group">
      <label for="date">Event Date</label>
      <input type="date" name="date" required/>
    </div>

    <div class="form-group">
      <label for="time">Event Time</label>
      <input type="time" name="time" required/>
    </div>

    <div class="form-group">
      <label for="price">Ticket Price (USD)</label>
      <input type="number" name="price" step="0.01" required placeholder="e.g., 25.00"/>
    </div>

    <div class="form-group">
      <label for="seats">Available Seats</label>
      <input type="number" name="seats" required placeholder="e.g., 100"/>
    </div>

    <button type="submit" class="submit-btn">Create Event</button>
  </form>
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
