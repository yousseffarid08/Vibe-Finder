@php $user = auth()->user(); @endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Reports - VIBE FINDER</title>
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
      background-color: rgba(0, 0, 0, 0.6);
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .navbar .logo {
      font-size: 1.5rem;
      font-weight: bold;
      color: #fff;
    }

    .navbar ul {
      display: flex;
      list-style: none;
      gap: 1.5rem;
    }

    .navbar ul li a,
    .navbar ul li button {
      color: #fff;
      text-decoration: none;
      font-weight: 500;
      background: none;
      border: none;
      cursor: pointer;
      font-size: 1rem;
    }

    .navbar ul li a:hover,
    .navbar ul li button:hover {
      text-decoration: underline;
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

    .sidebar a,
    .sidebar form button {
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

    .sidebar a i,
    .sidebar form button i {
      min-width: 24px;
      text-align: center;
    }

    .sidebar a span,
    .sidebar form button span {
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

    .container {
      background: rgba(255, 255, 255, 0.08);
      padding: 40px;
      border-radius: 12px;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: rgba(255, 255, 255, 0.1);
      border-radius: 12px;
      overflow: hidden;
      margin-top: 20px;
      text-align: center;
    }

    th, td {
      padding: 14px 16px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    th {
      background-color: rgba(0, 0, 0, 0.4);
      font-size: 16px;
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

    .footer-section ul {
      list-style: none;
      padding: 0;
    }

    .footer-section ul li {
      margin-bottom: 8px;
    }

    .footer-section a,
    .footer-section p {
      font-size: 14px;
      color: #ccc;
      text-decoration: none;
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
  </style>
</head>
<body>

<header class="navbar">
  <div class="logo">VIBE FINDER</div>
  <nav>
    <ul>
      <li><a href="{{ route('home') }}">Home</a></li>
      <li>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit">Logout</button>
        </form>
      </li>
    </ul>
  </nav>
</header>

<div class="dashboard-wrapper">
  <div class="sidebar">
    <a href="{{ url('/admin') }}"><i class="fas fa-home"></i><span>Dashboard</span></a>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit"><i class="fas fa-sign-out-alt"></i><span>Logout</span></button>
    </form>
  </div>

  <div class="dashboard-content">
    <div class="container">
      <h2>System Reports</h2>

      <table>
        <thead>
          <tr>
            <th>Metric</th>
            <th>Value</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Total Users</td>
            <td>{{ $totalUsers }}</td>
          </tr>
          <tr>
            <td>Total Events</td>
            <td>{{ $totalEvents }}</td>
          </tr>
          <tr>
            <td>Approved Events</td>
            <td>{{ $approvedEvents }}</td>
          </tr>
          <tr>
            <td>Pending Reviews</td>
            <td>{{ $pendingEvents }}</td>
          </tr>
        
        </tbody>
      </table>

    </div>
  </div>
</div>

<footer class="footer">
  <div class="footer-container">
    <div class="footer-section">
      <h3>About VIBE FINDER</h3>
      <p>Your gateway to discovering and organizing amazing events tailored to your vibe.</p>
    </div>
    <div class="footer-section">
      <h3>Quick Links</h3>
      <ul>
        <li><a href="{{ route('events') }}">Browse Events</a></li>
        <li><a href="#">Help Center</a></li>
        <li><a href="#">Privacy Policy</a></li>
      </ul>
    </div>
    <div class="footer-section">
      <h3>Contact</h3>
      <p>Email: support@vibefinder.com</p>
      <p>Phone: +1 234 567 890</p>
    </div>
  </div>
  <div class="footer-bottom">
    &copy; 2025 VIBE FINDER. All rights reserved.
  </div>
</footer>

</body>
</html>
