# My Simple Blog

This is a minimalist blog application built using PHP, MySQL, and a modern, aesthetic design. It allows users to register, log in, create, edit, and delete their own blog posts.

---

### Features

* **User Authentication:** Secure user registration and login functionality.
* **Create Posts:** Logged-in users can create new blog posts with a title and content.
* **Read Posts:** The homepage displays all blog posts in a clean, readable format.
* **Update Posts:** Logged-in users can edit their existing posts.
* **Delete Posts:** Users can delete their posts.
* **Aesthetic UI:** A simple and modern design with a soft color palette and elegant typography.

### Prerequisites

To run this project locally, you will need to have a local web server environment with PHP and MySQL. I recommend using **XAMPP**.

* [**XAMPP**](https://www.apachefriends.org/)

### Installation and Setup

1.  **Clone or Download the Project:**
    Download the project files and place them in your web server's root directory. If you are using XAMPP, this is typically `C:\xampp\htdocs\` on Windows or `/Applications/XAMPP/htdocs/` on macOS. Create a new folder named `my_blog` and place all the files inside it.

2.  **Database Setup:**
    * Start the Apache and MySQL services in your XAMPP Control Panel.
    * Open your web browser and go to `http://localhost/phpmyadmin`.
    * Click on the **"Databases"** tab and create a new database named `blog`.
    * Click on your new `blog` database. Then, go to the **"SQL"** tab and run the following commands to create the `posts` and `users` tables:

    ```sql
    CREATE TABLE posts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        context TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

    CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    ```

3.  **Configure Database Connection:**
    * Open the `includes/db.php` file in your project.
    * Make sure the `port` number in the `$dsn` variable matches the port of your MySQL server (which we previously identified as `3307`). The file should look like this:

    ```php
    <?php
    // includes/db.php
    $host = 'localhost';
    $dbname = 'blog';
    $user = 'root';
    $password = '';
    $dsn = "mysql:host=$host;dbname=$dbname;port=3307;charset=utf8mb4";
    // ... rest of the file
    ?>
    ```

4.  **Run the Application:**
    * Open your web browser.
    * Navigate to the following URL: `http://localhost/my_blog/`

You should now see the blog's home page. You can register a new user, log in, and start creating posts!

---

### Acknowledgements

* This project was developed with assistance for learning and debugging purposes.
* Thank you for your guidance!
