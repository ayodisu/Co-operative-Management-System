<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cooperative Society | OAuGF</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: #333;
        }
        nav {
            background: #007d53;
            color: white;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav img {
            height: 40px;
        }
        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
            margin: 0;
            padding: 0;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
        }
        nav ul li a:hover {
            text-decoration: underline;
        }
        .hero {
            background: url("{{ asset('assets/images/welcomebg.jpg') }}") no-repeat center center/cover;
            color: white;
            text-align: center;
            padding: 120px 20px;
            position: relative;
        }
        .hero::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 125, 83, 0.7); /* overlay */
        }
        .hero-content {
            position: relative;
            z-index: 1;
        }
        .hero h2 {
            font-size: 42px;
            margin-bottom: 15px;
        }
        .hero p {
            font-size: 18px;
            margin-bottom: 25px;
        }
        .hero .btn {
            background: white;
            color: #007d53;
            padding: 12px 24px;
            font-weight: bold;
            border-radius: 8px;
            text-decoration: none;
            box-shadow: 0 3px 6px rgba(0,0,0,0.2);
            margin: 0 10px;
            display: inline-block;
        }
        .hero .btn:hover {
            background: #f0f0f0;
        }
        .section {
            padding: 60px 20px;
            text-align: center;
        }
        .section h3 {
            font-size: 28px;
            color: #007d53;
            margin-bottom: 15px;
        }
        .section p {
            max-width: 700px;
            margin: auto;
            color: #555;
        }
        .services {
            background: #f8f8f8;
            padding: 60px 20px;
        }
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            max-width: 1000px;
            margin: auto;
        }
        .service-box {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .service-box h4 {
            color: #007d53;
            margin-bottom: 10px;
        }
        footer {
            background: #007d53;
            color: white;
            padding: 20px 40px;
            text-align: center;
        }
        footer a {
            color: white;
            margin-left: 15px;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav>
        <img src="{{ asset('assets/images/logodark.png') }}" alt="OAuGF Cooperative Logo">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h2>Welcome to the OAUGF Cooperative Society</h2>
            <p>Empowering members of the Office of the Auditor-General for the Federation</p>
            <a href="/login" class="btn">Login</a>
            <a href="/register" class="btn">Sign Up</a>
        </div>
    </section>

    <!-- About Section -->
    <section class="section">
        <h3>About Us</h3>
        <p>
            The OAuGF Cooperative Society is dedicated to supporting financial growth
            and welfare of its members through savings, loans, and community-driven initiatives.
        </p>
    </section>
    

    <!-- Services Section -->
    <section class="services">
        <h3>Our Services</h3>
        <div class="services-grid">
            <div class="service-box">
                <h4>Loans</h4>
                <p>Access flexible loan packages to meet your financial needs with ease.</p>
            </div>
            <div class="service-box">
                <h4>Savings</h4>
                <p>Grow your savings securely and enjoy financial stability with us.</p>
            </div>
            <div class="service-box">
                <h4>Support</h4>
                <p>We provide financial guidance and support for all our members.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; {{ date('Y') }} OAuGF Cooperative Society. All rights reserved.
            <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
        </p>
    </footer>

</body>
</html>
