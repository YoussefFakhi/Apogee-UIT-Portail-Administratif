# 🏛️ Apogée UIT Administrative Portal

[![GitHub stars](https://img.shields.io/github/stars/YOUR_GITHUB_USERNAME/Apogee-UIT-Portail-Administratif?style=social)](https://github.com/YOUR_GITHUB_USERNAME/Apogee-UIT-Portail-Administratif/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/YOUR_GITHUB_USERNAME/Apogee-UIT-Portail-Administratif?style=social)](https://github.com/YOUR_GITHUB_USERNAME/Apogee-UIT-Portail-Administratif/network)
[![License](https://img.shields.io/github/license/YOUR_GITHUB_USERNAME/Apogee-UIT-Portail-Administratif)](https://github.com/YOUR_GITHUB_USERNAME/Apogee-UIT-Portail-Administratif/blob/main/LICENSE)

---

Welcome to the **Apogée UIT Administrative Portal** project! 🎉
A comprehensive Laravel-based web application designed to streamline administrative requests for IBN TOFAIL University. This portal caters to both students/staff and administrators, offering a centralized system for various academic and functional requests.

This project was created to facilitate administrative processes within the university, making them more efficient and accessible.

---

## ✨ Features

✅ **User Authentication & Authorization:** Secure login and registration for different user roles (students, staff, administrators).
✅ **Comprehensive User Profiles:** Users can manage and view their extended profiles, including functional roles, contact information, and other relevant details.
✅ **Diverse Administrative Request Forms:**
    -   📖 **INSCRIPTION ADMINISTRATIVE:** For previous year registrations.
    -   📊 **RÉSULTAT PAR MODULE:** To view results module-by-module.
    -   🎓 **RÉSULTAT ÉTUDIANT:** For overall student academic results.
    -   🔑 **COMPTE FONCTIONNEL APOGÉE:** For requesting functional Apogée accounts.
✅ **Dynamic PDF Generation:** Automatically generate professional PDF documents for various administrative requests.
✅ **Robust Admin Panel:** A secure and dedicated section for university administrators to:
    -   Manage user accounts.
    -   Monitor system activities and logs.
    -   Process and track PDF requests.
✅ **Seamless Session Management:** Ensures consistent user experience and data integrity across sessions.

---

## 🛠️ Technologies Used

-   🌐 **Backend:** PHP 8.x with Laravel Framework 10.x
-   🗄️ **Database:** MySQL / PostgreSQL (via Eloquent ORM)
-   🎨 **Frontend:**
    -   Blade Templating Engine (for dynamic views)
    -   Tailwind CSS (for modern, responsive styling)
    -   Vanilla JavaScript (for interactive elements)
-   📄 **PDF Generation:** Dompdf

---

## 📂 Project Structure

```
.
├── app/                  # Application core (Models, HTTP Controllers, Middleware, etc.)
├── bootstrap/            # Framework bootstrap files
├── config/               # Configuration files
├── database/             # Database migrations, seeders, factories
├── public/               # Publicly accessible assets (CSS, JS, index.php)
├── resources/            # Frontend assets (views, CSS, JS)
│   ├── css/
│   ├── js/
│   └── views/            # Blade templates for the portal, admin, forms, PDFs, layouts, components
├── routes/               # Web, API, console routes
├── storage/              # Storage for files, sessions, cache
├── tests/                # Automated tests
└── vendor/               # Composer dependencies
```

---

## 🚀 Installation

To get this project up and running on your local machine, follow these steps:

1.  **Clone the Repository:**
    ```bash
    git clone https://github.com/YOUR_GITHUB_USERNAME/Apogee-UIT-Portail-Administratif.git
    cd Apogee-UIT-Portail-Administratif
    ```

2.  **Install Composer Dependencies:**
    ```bash
    composer install
    ```

3.  **Set Up Environment File:**
    ```bash
    cp .env.example .env
    ```
    Open the newly created `.env` file and configure your database connection and other environment variables.

4.  **Generate Application Key:**
    ```bash
    php artisan key:generate
    ```

5.  **Configure Database & Run Migrations:**
    Ensure your database is configured in `.env`.
    ```bash
    php artisan migrate
    ```
    (Optional) Seed the database with initial data (e.g., schools, admin user):
    ```bash
    php artisan db:seed
    ```

6.  **Install Node.js Dependencies & Compile Assets:**
    ```bash
    npm install
    npm run dev
    ```
    Or for production assets:
    ```bash
    npm run build
    ```

7.  **Start Local Development Server:**
    ```bash
    php artisan serve
    ```
    The application will typically be available at `http://127.0.0.1:8000`.

---

## 💡 Usage

Once the project is installed and running:

-   **Access the Portal:** Open your browser and navigate to the application's URL (e.g., `http://127.0.0.1:8000`).
-   **Login/Register:**
    -   New users can register through the login page.
    -   Existing users can log in with their credentials.
-   **Navigate Forms:** Explore the "Licence / Master" and "Compte Fonctionnel" sections to access various administrative request forms.
-   **Profile Page:** View and manage your user profile details.

---

## 👨‍💼 Admin Access

For local development, you might have default admin credentials set up by the `db:seed` command. If not, you can manually create an admin user in your database.

-   **Admin Dashboard:** Accessible via `/admin/dashboard` after logging in as an administrator.

---

## 🤝 Contributing

Contributions are welcome! If you'd like to contribute, please follow these steps:
1.  Fork the repository.
2.  Create a new branch (`git checkout -b feature/your-feature-name`).
3.  Make your changes.
4.  Commit your changes (`git commit -m 'Add new feature'`).
5.  Push to the branch (`git push origin feature/your-feature-name`).
6.  Open a Pull Request.

---

## 📜 License

This project is open-source and licensed under the **MIT License**.
Feel free to use, share, and improve it with proper credit 🙌
