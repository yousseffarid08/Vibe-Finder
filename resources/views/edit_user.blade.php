@php
$user = auth()->user();
$selectedPreferences = is_array(old('preferences')) 
    ? old('preferences') 
    : explode(',', $user->preferences ?? '');
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Edit Profile - VIBE FINDER</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      margin: 0;
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

    .form-wrapper {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 60px 20px;
    }

    .edit-form {
      max-width: 500px;
      width: 100%;
      padding: 30px;
      background: rgba(0,0,0,0.6);
      border-radius: 10px;
      border: 2px solid #2575fc;
    }

    .edit-form h2 {
      text-align: center;
      margin-bottom: 30px;
    }

    .input-group {
      margin-bottom: 20px;
    }

    .input-group label {
      display: block;
      margin-bottom: 6px;
      font-weight: bold;
    }

    .input-group input,
    .input-group select {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 6px;
      font-size: 16px;
    }

    .input-group input[type="file"] {
      background: #fff;
    }

    .btn {
      width: 100%;
      background: linear-gradient(to right, #6a11cb, #2575fc);
      color: #fff;
      border: none;
      padding: 12px;
      border-radius: 6px;
      font-weight: bold;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s ease;
    }

    .btn:hover {
      background: #5e0c9f;
      transform: scale(1.03);
    }

    .back-link {
      text-align: center;
      margin-top: 20px;
    }

    .back-link a {
      color: #fff;
      text-decoration: underline;
    }

    .note {
      font-size: 13px;
      color: #ddd;
      margin-top: 5px;
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
          <li><a href="{{ url('/user') }}">Dashboard</a></li>
          <li><a href="#">Events</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Edit Form -->
  <div class="form-wrapper">
    <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data" class="edit-form">
      @csrf
      {{-- Use POST not PUT because your route expects POST --}}
      <h2>Edit Profile</h2>

      <!-- Phone -->
      <div class="input-group">
        <label for="phone">Phone Number</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
      </div>

      <!-- Age -->
      <div class="input-group">
        <label for="age">Age</label>
        <input type="number" id="age" name="age" value="{{ old('age', $user->age) }}">
      </div>

      <!-- Preferences -->
      <div class="input-group">
        <label for="preferences">Preferences</label>
        <select id="preferences" name="preferences[]" multiple>
          @php
            $options = [
              'music' => 'Music Events',
              'tech' => 'Tech Conferences',
              'sports' => 'Sports',
              'art' => 'Art Exhibitions',
              'theater' => 'Theater',
              'gaming' => 'Gaming Events',
              'business' => 'Business Summits',
              'fashion' => 'Fashion Shows',
              'education' => 'Educational Events',
              'travel' => 'Travel & Tourism',
              'food' => 'Food Festivals',
              'other' => 'Other'
            ];
          @endphp
          @foreach ($options as $value => $label)
            <option value="{{ $value }}" {{ in_array($value, $selectedPreferences) ? 'selected' : '' }}>
              {{ $label }}
            </option>
          @endforeach
        </select>
        <div class="note">Hold Ctrl (Windows) or Cmd (Mac) to select multiple</div>
      </div>

      <!-- Profile Image Upload -->
      <div class="input-group">
        <label for="profile_image">Upload Profile Image</label>
        <input type="file" name="profile_image" id="profile_image">
      </div>

      <!-- Submit -->
      <button type="submit" class="btn">Save Changes</button>

      <div class="back-link">
        <a href="{{ url('/user') }}">Cancel and return to profile</a>
      </div>
    </form>
  </div>

</body>
</html>
