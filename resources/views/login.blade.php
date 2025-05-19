<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - VIBE FINDER</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body, html {
      font-family: 'Segoe UI', sans-serif;
      scroll-behavior: smooth;
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      color: #fff;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .navbar {
      position: sticky;
      top: 0;
      background: rgba(0, 0, 0, 0.6);
      padding: 15px 0;
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

    .nav-links li a.btn {
      background: #fff;
      color: #2575fc;
      padding: 8px 15px;
      border-radius: 5px;
      transition: 0.3s;
    }

    .nav-links li a.btn:hover {
      background: linear-gradient(45deg, #2575fc, #6a11cb);
    }

    .section {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 60px 20px;
    }

    .login-form {
      max-width: 400px;
      width: 100%;
      padding: 30px;
      border-radius: 10px;
      border: 2px solid #2575fc;
      background-color: rgba(0, 0, 0, 0.6);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .login-form h2 {
      text-align: center;
      color: #fff;
      margin-bottom: 30px;
    }

    .input-group {
      margin-bottom: 20px;
      text-align: left;
    }

    .input-group label {
      display: block;
      color: #fff;
      font-size: 16px;
      margin-bottom: 8px;
    }

    .input-group input {
      width: 100%;
      padding: 12px;
      background-color: #f4f4f4;
      border: 1px solid #ccc;
      border-radius: 6px;
      color: #333;
      font-size: 16px;
    }

    .input-group input:focus {
      border-color: #2575fc;
      outline: none;
    }

    .login-form button {
      background-color: #6a11cb;
      color: #fff;
      padding: 14px 20px;
      border: none;
      border-radius: 6px;
      width: 100%;
      cursor: pointer;
      transition: background-color 0.3s, transform 0.2s;
    }

    .login-form button:hover {
      background-color: #5e0c9f;
      transform: scale(1.05);
    }

    .login-form p {
      color: #fff;
      text-align: center;
    }

    .login-form a {
      color: #ff8c00;
      text-decoration: none;
    }

    .login-form a:hover {
      text-decoration: underline;
    }

    .error-message {
      color: #ff4d4d;
      background: rgba(255, 255, 255, 0.1);
      padding: 10px;
      text-align: center;
      border-radius: 6px;
      margin-bottom: 20px;
    }

    .footer {
      background-color: #111;
      color: #ddd;
      padding: 40px 20px 20px;
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
          <li><a href="{{ url('/') }}">Home</a></li>
          <li><a href="{{ url('#about') }}">About</a></li>
          <li><a href="{{ url('#partners') }}">Partners</a></li>
          <li><a href="{{ url('#reviews') }}">Reviews</a></li>
          <li><a href="{{ url('#contact') }}">Contact</a></li>
          <li><a href="{{ route('login') }}" class="btn">Login</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Login Form Section -->
  <section class="section">
    <div class="login-form">
      <h2>Login to VIBE FINDER</h2>

      @if($errors->any())
        <div class="error-message">{{ $errors->first('login') }}</div>
      @endif

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="input-group">
          <label for="username">Username</label>
          <input type="text" name="username" required placeholder="Your username">
        </div>

        <div class="input-group">
          <label for="email">Email</label>
          <input type="email" name="email" required placeholder="Your email">
        </div>

        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" name="password" required placeholder="Your password">
        </div>

        <div class="input-group">
          <button type="submit">Login</button>
        </div>
      </form>

      <p>Don't have an account? <a href="{{ route('signup') }}">Sign up</a></p>
    </div>
  </section>

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

</body>
</html>

