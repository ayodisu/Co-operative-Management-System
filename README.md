# Cooperative Management System

A robust, Laravel-based web application designed for managing cooperative societies. This system handles member registration, loan management (application, approval, repayment), financial reporting, and member support tickets.

## 🚀 Key Features

### 👥 Member Management
- **User Registration & Profiles**: Secure member onboarding with detailed profiles (including avatars).
- **Admin Dashboard**: Comprehensive overview of total members, active loans, and system health.
- **Member Dashboard**: Personalized view for members to track their contributions and loans.

### 💰 Loan Management
- **Loan Application**: Streamlined process for members to apply for loans.
- **Approval Workflow**: Admin interface to review, approve, or reject loan requests.
- **Repayment Tracking**: Automated schedules and manual repayment entry for tracking loop lifecycle.
- **Loan History**: Complete archive of past and current loans.

### 📊 Financial Reports
- **Dynamic Reporting**: Generate reports for specific date ranges.
- **Visual Insights**: Interactive charts and summary cards for Disbursed Loans, Collections, and Equity.
- **Transaction Logs**: Detailed views of recent loan disbursements and repayments.

### 🎫 Support & Communication
- **Ticket System**: Built-in helpdesk for members to report issues.
- **Admin Resolution**: Admins can reply to and close tickets directly from the dashboard.
- **Real-time Notifications**: Alerts for new loans, ticket replies, and status updates using database notifications.

### ⚙️ System Settings
- **Configurable Parameters**: Admin control over global settings like Interest Rates without code changes.
- **Dark Mode**: Built-in UI theme switching for user comfort.

## 📂 Project Structure

The project follows standard Laravel conventions with organized modules:

```
├── app
│   ├── Http
│   │   ├── Controllers
│   │   │   ├── Admin      # Admin-specific logic (Loans, Reports, Settings, Tickets)
│   │   │   ├── Auth       # Authentication logic
│   │   │   └── ...        # User-facing logic (Loans, Profiles, Support)
│   │   ├── Middleware     # Route protection (Admin, Verified)
│   │   └── Requests       # Form validation classes
│   ├── Models             # Eloquent models (User, Loan, Repayment, Ticket, Setting)
│   └── Notifications      # Notification classes (NewTicket, LoanStatusUpdated)
├── database
│   ├── migrations         # Database schema definitions
│   └── seeders            # Default data population
├── resources
│   ├── css                # Custom styles & compiled assets
│   ├── js                 # JavaScript logic (Dark mode, charts)
│   └── views
│       ├── admin          # Admin views (Dashboards, Reports, Management)
│       ├── dashboard      # User dashboard views
│       ├── layouts        # Master templates (Sidebar, Topbar)
│       └── ...
└── routes
    └── web.php            # Application route definitions
```

## 🛠️ Technology Stack

- **Framework**: Laravel 10.x
- **Frontend**: Blade Templates, Bootstrap 5, Vanilla CSS/JS
- **Database**: MySQL
- **Icons**: Material Design Icons (MDI)

## 📦 Installation & Setup

1.  **Clone the repository**
    ```bash
    git clone <repository-url>
    cd audit
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

3.  **Environment Setup**
    Copy `.env.example` to `.env` and configure your database credentials.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Database Migration & Seeding**
    ```bash
    php artisan migrate --seed
    ```

5.  **Run the Application**
    Start the development server:
    ```bash
    php artisan serve
    ```
    Compile frontend assets:
    ```bash
    npm run dev
    ```

## 🔒 Security

- **Authentication**: Powered by Laravel Breeze/Jetstream (customized).
- **Authorization**: Role-based access control (Admin vs. Member).
- **Validation**: Strict server-side validation for all inputs.

---
*Built for efficiency and transparency in cooperative management.*
# Co-operative-Management-System
