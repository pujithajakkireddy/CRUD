<?php
// includes/header.php

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aesthetic Blog</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #8c2a32;
            --secondary-color: #d4e0d2;
            --accent-color: #e5d9c2;
            --text-color: #333;
            --light-text-color: #f4f4f4;
            --background-color: #fffaf0; /* A soft, off-white */
        }
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--background-color);
            color: var(--text-color);
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .container {
            width: 90%;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: var(--secondary-color);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        header {
            background: none;
            color: var(--text-color);
            padding: 40px 0 20px;
            text-align: center;
        }
        header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            color: var(--primary-color);
            margin: 0;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }
        header nav ul {
            list-style: none;
            padding: 0;
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }
        header nav li {
            margin: 0 15px;
        }
        header nav a {
            color: var(--text-color);
            text-decoration: none;
            font-weight: 500;
            position: relative;
            transition: color 0.3s ease;
        }
        header nav a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background-color: var(--primary-color);
            bottom: -5px;
            left: 50%;
            transition: width 0.3s ease, left 0.3s ease;
        }
        header nav a:hover {
            color: var(--primary-color);
        }
        header nav a:hover::after {
            width: 100%;
            left: 0;
        }
        .main-content {
            padding: 20px;
        }
        .post {
            background-color: var(--background-color);
            padding: 25px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .post:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        }
        .post h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--primary-color);
            margin-top: 0;
            margin-bottom: 5px;
        }
        .post-meta {
            color: #777;
            font-size: 0.9rem;
            font-style: italic;
            margin-bottom: 15px;
        }
        .post-content {
            line-height: 1.8;
            font-size: 1rem;
        }
        .post-actions a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            margin-right: 15px;
            transition: color 0.3s ease;
        }
        .post-actions a:hover {
            color: var(--text-color);
        }
        .form-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 30px;
            background: var(--background-color);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: 500;
            color: var(--primary-color);
        }
        input[type="text"], input[type="password"], textarea {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            box-sizing: border-box;
            border: 1px solid var(--accent-color);
            background-color: #f4f0e9;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        input[type="text"]:focus, input[type="password"]:focus, textarea:focus {
            outline: none;
            border-color: var(--primary-color);
        }
        button {
            background-color: var(--primary-color);
            color: var(--light-text-color);
            border: none;
            padding: 12px 25px;
            cursor: pointer;
            margin-top: 20px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        button:hover {
            background-color: #6a1f26;
            transform: translateY(-2px);
        }
        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-weight: 500;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        footer {
            text-align: center;
            padding: 20px;
            margin-top: 40px;
            color: #777;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <header>
        <h1>My Simple Blog</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="create.php">Create Post</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <div class="container main-content">

