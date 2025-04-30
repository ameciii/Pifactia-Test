<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pifacia Group Management</title>
  <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
  <div class="nav-inner">
    <div class="logo">Pifacia</div>
    <div class="nav-links">
      <a href="#features">Features</a>
      <a href="#about">About</a>
      <a href="{{ route('login') }}">Login</a>
      <a href="{{ route('register') }}">Register</a>
    </div>
  </div>
</nav>


<!-- Hero Section -->
<header class="hero">
  <div class="container hero-content">
    <h1>Welcome to Pifacia Group Management</h1>
    <p>Manage your products and transactions easily.</p>
    <p>Streamline your business with our comprehensive management system.</p>
    <div class="hero-buttons">
      <a href="{{ route('register') }}" class="btn-primary">Get Started</a>
    </div>
  </div>
</header>

<!-- Features Section -->
<section id="features" class="features">
  <div class="container">
    <h2>Key Features</h2>
    <div class="features-grid">
      <div class="feature-card">
        <h3>Role Management</h3>
        <p>Create custom roles and permissions easily.</p>
      </div>
      <div class="feature-card">
        <h3>User Management</h3>
        <p>Manage user accounts with flexible role assignment.</p>
      </div>
      <div class="feature-card">
        <h3>Product Management</h3>
        <p>Track, update, and organize your products.</p>
      </div>
      <div class="feature-card">
        <h3>Order Processing</h3>
        <p>Efficiently handle orders from creation to delivery.</p>
      </div>
      <div class="feature-card">
        <h3>Audit Trail</h3>
        <p>Monitor all system activities transparently.</p>
      </div>
      <div class="feature-card">
        <h3>Excel Import/Export</h3>
        <p>Seamlessly migrate data in and out via Excel files.</p>
      </div>
    </div>
  </div>
</section>

<!-- About Section -->
<section id="about" class="about">
  <div class="container">
    <h2>About Pifacia</h2>
    <p>Pifacia is a Laravel-based system designed to simplify business operations, including inventory, order processing, and reporting.</p>
    <a href="{{ route('register') }}" class="btn-primary">Get Started Today</a>
  </div>
</section>

<!-- Footer -->
<footer class="footer">
  <div class="container">
    <p>&copy; 2025 Pifacia. All rights reserved.</p>
  </div>
</footer>

</body>
</html>
