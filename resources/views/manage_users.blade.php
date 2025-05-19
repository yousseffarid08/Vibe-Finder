@php $user = auth()->user(); @endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Users - Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
      list-style: none;
      display: flex;
      gap: 20px;
    }

    .navbar ul li a, .navbar ul li button {
      color: white;
      text-decoration: none;
      font-weight: 500;
      background: none;
      border: none;
      font-size: 1rem;
      cursor: pointer;
    }

    .dashboard-wrapper {
      display: flex;
      flex: 1;
      width: 100%;
    }

    .sidebar {
      width: 60px;
      background-color: rgba(255, 255, 255, 0.05);
      min-height: calc(100vh - 60px);
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

    .user-table-container {
      background: rgba(255,255,255,0.07);
      padding: 30px;
      border-radius: 12px;
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 12px 15px;
      border: 1px solid #ccc;
      text-align: center;
    }

    th {
      background: rgba(0, 0, 0, 0.4);
    }

    td {
      background: rgba(255, 255, 255, 0.05);
    }

    .btn-action {
      padding: 6px 12px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
      margin: 0 5px;
    }

    .btn-approve {
      background-color: #28a745;
      color: white;
    }

    .btn-reject {
      background-color: #dc3545;
      color: white;
    }

    button[disabled] {
      opacity: 0.5;
      cursor: not-allowed;
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
  <div class="logo">VIBE FINDER</div>
  <ul>
    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
      </form>
    </li>
  </ul>
</header>

<!-- Sidebar + Content -->
<div class="dashboard-wrapper">
  <div class="sidebar">
    <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i><span>Dashboard</span></a>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit"><i class="fas fa-sign-out-alt"></i><span>Logout</span></button>
    </form>
  </div>

  <div class="dashboard-content">
    <div class="user-table-container">
      <h2 style="text-align: center; margin-bottom: 20px;">Manage Users</h2>

      @if(session('success'))
        <p style="text-align:center; color: lightgreen; font-weight: bold;">{{ session('success') }}</p>
      @endif

      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Age</th>
            <th>Role</th>
            <th>Approved</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $u)
            <tr>
              <td>{{ $u->id }}</td>
              <td>{{ $u->name }}</td>
              <td>{{ $u->email }}</td>
              <td>{{ $u->phone ?? 'N/A' }}</td>
              <td>{{ $u->age ?? 'N/A' }}</td>
              <td>{{ ucfirst($u->role) }}</td>
              <td>{{ $u->approved ? 'Yes' : 'No' }}</td>
              <td>
                <form action="{{ route('admin.users.approve', $u->id) }}" method="POST" style="display:inline">
                  @csrf
                  <button type="submit" class="btn-action btn-approve" {{ $u->approved ?: '' }}>
                    Approve
                  </button>
                </form>
                <form action="{{ route('admin.users.reject', $u->id) }}" method="POST" style="display:inline">
                  @csrf
                  <button type="submit" class="btn-action btn-reject">
                    Reject
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Footer -->
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
