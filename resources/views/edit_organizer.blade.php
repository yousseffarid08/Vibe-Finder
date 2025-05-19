@php $user = auth()->user(); @endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Organizer Info - VIBE FINDER</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #6a11cb, #2575fc);
      color: white;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .container {
      max-width: 700px;
      margin: 60px auto;
      background: rgba(0,0,0,0.4);
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.3);
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

    input, textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 6px;
      border: none;
      font-size: 16px;
    }

    .btn {
      display: inline-block;
      background: linear-gradient(to right, #6a11cb, #2575fc);
      padding: 12px 20px;
      border: none;
      border-radius: 6px;
      color: white;
      font-weight: bold;
      font-size: 16px;
      cursor: pointer;
      text-decoration: none;
      text-align: center;
      width: 100%;
    }

    .btn:hover {
      background-color: #5e0c9f;
      transform: scale(1.03);
    }

    .back-link {
      text-align: center;
      margin-top: 15px;
    }

    .back-link a {
      color: white;
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Edit Organizer Info</h2>

  <form action="{{ route('organizer.update') }}" method="POST">
    @csrf
    @method('POST')

    <label for="name">Full Name</label>
    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>

    <label for="phone">Phone</label>
    <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">

    <label for="age">Age</label>
    <input type="number" id="age" name="age" value="{{ old('age', $user->age) }}">

    <label for="bio">About You</label>
    <textarea id="bio" name="bio" rows="4">{{ old('bio', $user->bio) }}</textarea>

    <button type="submit" class="btn">Save Changes</button>
  </form>

  <div class="back-link">
    <a href="{{ url('/organizer') }}">Cancel and go back to Dashboard</a>
  </div>
</div>

</body>
</html>
