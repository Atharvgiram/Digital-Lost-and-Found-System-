<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title> Lost & Found System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    html { 
      scroll-behavior: smooth; 
    }

    body { 
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
      background: #f8f9fa; 
      color: #333; 
      line-height: 1.6; 
    }

    /* Navbar */
    .navbar { 
      background: #0d6efd !important;   /* Blue header */
      box-shadow: 0 2px 10px rgba(0,0,0,0.1); 
    }
    .navbar .nav-link { 
      color: #fff !important;           /* White text */
      font-weight: 500;
    }
    .navbar .nav-link:hover { 
      color: #ffc107 !important;        /* Yellow on hover */
    }
    .navbar .navbar-brand { 
      color: #fff !important; 
      font-weight: bold; 
    }

    /* Hero Section */
    .hero { 
      background: linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)), 
                  url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1600&q=80') 
                  no-repeat center center/cover; 
      color: #fff; 
      height: 90vh; 
      display: flex; 
      align-items: center; 
      justify-content: center; 
      flex-direction: column; 
      text-align: center; 
      padding: 0 20px; 
    }
    .hero h1 { 
      font-size: 3rem; 
      font-weight: bold; 
    }
    .hero p { 
      font-size: 1.25rem; 
      margin: 20px 0; 
      max-width: 700px; 
    }
    .btn-custom { 
      border-radius: 30px; 
      padding: 12px 25px; 
      font-size: 1.1rem; 
      margin: 5px; 
      transition: all 0.3s; 
    }
    .btn-custom:hover { 
      transform: translateY(-3px); 
    }
    .btn-group-custom { 
      display: flex; 
      justify-content: center; 
      flex-wrap: wrap; 
      gap: 15px; 
      margin-top: 20px; 
    }

    /* Section Headings */
    h2.section-title { 
      font-weight: bold; 
      margin-bottom: 40px; 
      color: #0d6efd; 
      text-align: center; 
    }

    /* Features */
    .feature-box { 
      background: #fff; 
      padding: 30px; 
      border-radius: 15px; 
      box-shadow: 0 4px 20px rgba(0,0,0,0.08); 
      transition: transform 0.3s; 
      height: 100%; 
    }
    .feature-box:hover { 
      transform: translateY(-8px); 
    }
    .feature-icon { 
      font-size: 45px; 
      margin-bottom: 15px; 
      color: #0d6efd; 
    }

    /* About Us */
    .about img { 
      border-radius: 15px; 
      box-shadow: 0 6px 20px rgba(0,0,0,0.15); 
    }
    .about p { 
      font-size: 1.05rem; 
      color: #555; 
    }

    /* Footer */
    footer { 
      background: #0d6efd;   /* Blue footer */
      color: #fff; 
      padding: 20px 0; 
      text-align: center; 
      margin-top: 50px; 
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">🔎 Digital Lost & Found</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <!--<li class="nav-item"><a class="nav-link" href="user_report_item.php">Report Item</a></li>
        <li class="nav-item"><a class="nav-link" href="user_view_items.php">View Items</a></li>
        <li class="nav-item"><a class="nav-link" href="return_item.php">Return Item</a></li>
        <li class="nav-item"><a class="nav-link" href="user_my_items.php">My Items</a></li>-->
        <li class="nav-item"><a class="nav-link" href="#about">About Us</a></li>
        <li class="nav-item"><a class="nav-link text-warning fw-bold" href="login.html">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="hero">
  <h1>Lost Something? Found Something?</h1>
  <p>Help the community by reporting lost and found items. Together, we reconnect people with their belongings.</p>
  <div class="btn-group-custom">
    <a href="user_report_item.php" class="btn btn-primary btn-custom">📢 Report Item</a>
    <a href="user_view_items.php" class="btn btn-success btn-custom">📋 View Items</a>
    <a href="return_item.php" class="btn btn-warning btn-custom">↩️ Return Item</a>
    <!--<a href="user_my_items.php" class="btn btn-info btn-custom">📦 My Items</a>-->
  </div>
</section>

<!-- Features -->
<section class="features container my-5">
  <h2 class="section-title">Our Features</h2>
  <div class="row text-center">
    <div class="col-md-6 mb-4">
      <div class="feature-box">
        <div class="feature-icon">📋</div>
        <h4>Easy Reporting</h4>
        <p>Quickly report a lost or found item with details and images in just a few clicks.</p>
      </div>
    </div>
    <div class="col-md-6 mb-4">
      <div class="feature-box">
        <div class="feature-icon">✅</div>
        <h4>Verified by Admin</h4>
        <p>All reports are reviewed and approved by admins to ensure authenticity.</p>
      </div>
    </div>
  </div>
</section>

<!-- About Us -->
<section id="about" class="about container my-5">
  <h2 class="section-title">About Us</h2>
  <div class="row align-items-center">
    <div class="col-md-6 mb-4 mb-md-0">
      <img src="https://images.unsplash.com/photo-1506784983877-45594efa4cbe?auto=format&fit=crop&w=1200&q=80" 
           alt="About Us" class="img-fluid">
    </div>
    <div class="col-md-6">
      <p>
        The Lost & Found System is built to help people reconnect with their belongings. 
        Whether you’ve misplaced something valuable or found an item, our platform 
        bridges the gap between the finder and the seeker in a secure and reliable way.
      </p>
      <p>
        With easy reporting, admin verification, and a community-driven approach, 
        we aim to reduce the stress of losing items and bring peace of mind to users.
      </p>
      <a href="contact.php" class="btn btn-primary btn-custom">📩 Contact Us</a>
    </div>
  </div>
</section>

<!-- Footer -->
<footer>
  <p>&copy; 2025 Digital Lost & Found System. All Rights Reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
