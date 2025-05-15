
# Vehicle Reservation Approval App

## App Specifications

- **PHP version:** 8.4.7  
- **Laravel version:** 12.14.1  
- **PostgreSQL version:** 14.17  
- **Composer version:** 2.8.9  

## Installation Steps

1. **Clone the repository**

   ```bash
   git clone <your-repo-url>
   cd <your-repo-folder>
   ```

2. **Update your `.env` file**

   Copy the `.env.example` to `.env` and update the database configuration to match your PostgreSQL setup:

   ```env
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

3. **Run database migrations**

   ```bash
   php artisan migrate
   ```

4. **Load seeders**

   ```bash
   php artisan db:seed
   ```

5. **Install frontend dependencies and build assets**

   ```bash
    npm install
    npm run dev
   ```

6. **Serve the application**

   ```bash
   php artisan serve
   ```

   The app will be accessible at `http://127.0.0.1:8000`

## How to Use

- Register a new user or login with existing credentials  
- Default registered users have the **admin** role  
- The app includes the following pages:  
  - **Main Page**  
  - **Dashboard**  
    - Admin sees reservation status overview  
    - Approver sees reservation requests needing review  
  - **Reservation** management  
  - **Reporting** with export functionality  

- Admin users can create new reservations which start with a **pending** status  
- Approver users review and approve or reject reservation requests  

## Default Users

| Email                 | Password  | Role     |
|-----------------------|-----------|----------|
| admin@example.com      | password  | Admin    |
| approver1@example.com  | password  | Approver |
| approver2@example.com  | password  | Approver |

---

If you encounter any issues or have questions, feel free to open an issue or contact the maintainer.
