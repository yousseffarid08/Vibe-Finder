<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Eventify - Discover and Organize Events</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- ✅ Your full original CSS directly embedded here -->
  <style>
    /* Global Styles */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
  
  body, html {
    font-family: 'Segoe UI', sans-serif;
    scroll-behavior: smooth;
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    color: #fff;
  }
  
  /* Navbar */
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
    transition: background 0.3s ease;
  }
  
  /* Hero Section */
  .hero {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 90vh;
    text-align: center;
    padding: 20px;
    opacity: 0;
    transition: opacity 1s ease-in-out;
  }
  .hero.fade-in {
    opacity: 1;
  }
  .hero h1 {
    font-size: 48px;
    margin-bottom: 15px;
  }
  .hero p {
    font-size: 20px;
    margin-bottom: 30px;
  }
  .big-btn {
    padding: 12px 25px;
    background-color: #fff;
    color: #2575fc;
    border-radius: 6px;
    font-weight: bold;
    text-decoration: none;
    transition: background 0.3s;
  }
  .big-btn:hover {
    background-color: #f1f1f1;
  }
  
  /* Sections */
  .section {
    padding: 60px 30px;
    text-align: center;
    max-width: 1200px;
    margin: auto;
  }
  .section.dark {
    background-color: #111;
    color: #fff;
  }
  .section.light {
    background-color: #f4f4f4;
    color: #222;
  }
  .section h2 {
    font-size: 32px;
    margin-bottom: 20px;
  }
  .section p {
    font-size: 18px;
    line-height: 1.6;
    max-width: 900px;
    margin: auto;
  }
  
  /* Card Grid */
  .card-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    margin-top: 40px;
  }
  .card {
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    border: 1px solid #555;
  }
  .card img {
    width: 100%;
    border-radius: 8px;
    height: 150px;
    object-fit: cover;
    margin-bottom: 15px;
  }
  .card h3 {
    color: #fff;
    margin-bottom: 10px;
  }
  .card p {
    color: #ddd;
    font-size: 15px;
  }
  
  /* Review Cards */
  .review {
    background-color: rgba(0, 0, 0, 0.4);
    padding: 20px;
    border-radius: 10px;
    max-width: 300px;
    text-align: left;
  }
  .review p {
    font-size: 16px;
  }
  .review strong {
    display: block;
    margin-top: 10px;
    color: #fff;
  }
  .review .stars {
    color: gold;
    font-size: 18px;
    margin-top: 8px;
  }
  
  /* Footer */
  .footer {
    background-color: rgba(0, 0, 0, 0.6);
    padding: 20px 30px;
    text-align: center;
  }
  .footer-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    color: #ccc;
  }
  .footer-content p {
    flex: 1 1 200px;
  }
  .footer .social-icons {
    flex: 1 1 200px;
    text-align: right;
  }
  .footer .social-icons a {
    margin-left: 12px;
  }
  .footer .social-icons a:hover {
    color: #ddd;
  }
  
  /* Button hover effect with delay */
  .btn:hover, .big-btn:hover {
    transform: scale(1.1);
    background-color: #f1f1f1;
    transition: transform 0.4s, background-color 0.4s;
  }
  /* BUTTON STYLES - Unified gradient hover */
.btn,
.big-btn {
  padding: 10px 20px;
  border: none;
  border-radius: 6px;
  font-weight: bold;
  text-decoration: none;
  color: #fff;
  background-color: #2575fc;
  background-image: linear-gradient(90deg, #2575fc, #6a11cb);
  transition: background-position 0.4s ease, transform 0.3s ease;
  background-size: 200% 100%;
  background-position: left center;
}
.btn:hover,
.big-btn:hover {
  background-position: right center;
  transform: scale(1.05);
}

/* FULL-WIDTH ABOUT SECTION */
#about.section.dark {
  width: 100%;
  max-width: 100%;
  margin: 0;
  padding: 60px 30px;
  background-color: #111;
  color: #fff;
}

/* PARTNER & REVIEW CARD UNIFIED STYLE */
.card {
  background-color: rgba(0, 0, 0, 0.4); /* Matches review card */
  border: 1px solid #555;
  border-radius: 12px;
  padding: 20px;
  color: #fff;
  transition: transform 0.3s ease;
}
.card:hover {
  transform: translateY(-5px);
}
.card h3 {
  margin-top: 10px;
  margin-bottom: 10px;
}
.card p {
  color: #ccc;
}

/* Ensure image fits inside darker card */
.card img {
  width: 100%;
  border-radius: 8px;
  height: 150px;
  object-fit: cover;
  margin-bottom: 10px;
}
/* About section height */
#about.section.dark {
    min-height: 600px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
  
  /* Organized Footer Styles */
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

  <!-- Your existing HTML stays exactly the same -->
  <!-- Just make sure you update image paths using Laravel's asset() -->

  <header class="navbar">
    <div class="container">
      <div class="logo">VIBE FINDER</div>
      <nav>
        <ul class="nav-links">
          <li><a href="#about">About</a></li>
          <li><a href="#partners">Partners</a></li>
          <li><a href="#reviews">Reviews</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a href="{{ url('login') }}" class="btn">Get Started</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <section class="hero">
    <div class="hero-content">
      <h1>Plan. Discover. Attend.</h1>
      <p>Your one-stop platform for personalized event discovery and management.</p>
      <a href="{{ url('login') }}" class="btn big-btn">Get Started</a>
    </div>
  </section>

  <section id="about" class="section dark" style="background: linear-gradient(135deg, #6a11cb, #2575fc); padding: 60px 0;">
    <div style="max-width: 1000px; margin: 0 auto; background-color: #000; border: 2px solid #444; padding: 30px; border-radius: 12px; display: flex; flex-direction: row; align-items: center; justify-content: space-between; gap: 32px; color: #fff;">
      <div style="flex: 1; display: flex; justify-content: center;">
        <img src="{{ asset('assets/logo.jpg') }}" alt="VIBE FINDER Logo" style="max-width: 100%; height: auto; max-height: 250px;">
      </div>
      <div style="flex: 1;">
        <h2 style="margin-bottom: 16px;">About VIBE FINDER</h2>
        <p style="margin-bottom: 12px;">
          At <strong>VIBE FINDER</strong>, we revolutionize the way you experience events. Whether you're organizing a global conference, 
          an intimate workshop, or a music festival, our platform empowers you with seamless event creation, intelligent attendee engagement, 
          and insightful analytics — all in one place.
        </p>
        <p>
          Backed by cutting-edge technology and a passion for human connection, VIBE FINDER helps individuals and brands bring their vision to life. 
          Our mission is to simplify events and elevate every attendee experience from registration to feedback.
        </p>
      </div>
    </div>
  </section>

  <section id="partners" class="section">
    <h2>Our Event Partners</h2>
    <div class="card-grid">
      <div class="card">
        <h3>MusicMania</h3>
        <p>Leading platform for live concerts, indie bands, and international music festivals.</p>
      </div>
      <div class="card">
        <h3>TechWorld Expo</h3>
        <p>Where startups, developers, and AI enthusiasts converge every year to share innovation.</p>
      </div>
      <div class="card">
        <h3>Startup Galaxy</h3>
        <p>Networking hub for entrepreneurs and investors shaping the future of tech.</p>
      </div>
      <div class="card">
        <h3>Culture Fest</h3>
        <p>Celebrating diversity through art, food, and performances from all over the globe.</p>
      </div>
    </div>
  </section>

  <section id="reviews" class="section">
    <h2>User Reviews</h2>
    <div class="card-grid">
      <div class="card review">
        <p>“VIBE FINDER made discovering music festivals in my area effortless and fun. I’ve attended 5 events this year!”</p>
        <strong>- Nada M.</strong>
        <div class="stars">★★★★★</div>
      </div>
      <div class="card review">
        <p>“The recommendation system feels like magic. It knows exactly what I want!”</p>
        <strong>- Youssef K.</strong>
        <div class="stars">★★★★★</div>
      </div>
      <div class="card review">
        <p>“As an organizer, I found VIBE FINDER's tools very intuitive. I easily sold out my last 2 workshops!”</p>
        <strong>- Farah S.</strong>
        <div class="stars">★★★★★</div>
      </div>
    </div>
  </section>

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
    window.addEventListener('load', () => {
      setTimeout(() => {
        document.querySelector('.hero').classList.add('fade-in');
      }, 500);
    });

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          setTimeout(() => {
            target.scrollIntoView({ behavior: 'smooth' });
          }, 800);
        }
      });
    });
  </script>
</body>
</html>
+