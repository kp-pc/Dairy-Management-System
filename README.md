# Dairy Management System

A small PHP + MySQL web application to manage dairy operations (farmers, staff, animals, daily milk entries, billing and dairy products). It is intended as a DBMS miniproject for small/local dairies or as a teaching/demo application.

## Stack
- **Language(s):** PHP, HTML, CSS, JavaScript
- **Framework / runtime:** Plain PHP (runs on Apache / PHP built-in server)
- **Notable libraries/tools:**
  - Bootstrap (css/bootstrap.css) — UI
  - jQuery (css/jquery-3.5.1.min.js)
  - FPDF (fpdf/) — PDF generation for bills

## Key features
- Farmer and staff management (add, edit, delete)
- Animal records (type, health id, min litres)
- Daily milk collection entries and billing
- Dairy product catalogue and simple cart/billing
- PDF invoice generation using FPDF
- Simple login flow (loginpage.html / login.php)

## Project layout
Top-level files and directories (annotated):

```
Animalinfo.php         # Animal information management
Cart.php               # Shopping/cart-like behavior (customer side)
Dairypro.php           # Dairy products listing/management
Service.php            # Services / links to modules
aboutus.html           # About page
bill.php               # Billing backend
bill.html              # Billing UI
connect.php            # DB connection & example insert (update for your env)
connection.php         # another DB/connection file (check duplication)
css/                   # styles and client-side assets (bootstrap, custom CSS, jquery)
dry.sql                # Database schema + seed data
fpdf/                  # FPDF library used for PDF export
images/                # Images used across the site (product, cows, icons)
Screen_shots/          # Screenshots used in the original README
snippets/              # Reusable snippets (head_footer.php)
startpage.php          # Homepage (entry point)
...                    # many other PHP pages for modules (farmer.php, staff.php, etc.)
```

How it fits together:
- Public pages (startpage.php, Service.php, gallery/about pages) provide navigation.
- Module pages (farmer.php, staff.php, Animalinfo.php, Dairypro.php, etc.) implement CRUD using PHP + MySQL, often via `connect.php`.
- Billing uses daily entries and can generate PDFs via `fpdf/`.

## Quick start — run locally

1. Prerequisites
   - PHP 7.2+ (or PHP 8.x)
   - MySQL / MariaDB
   - A webserver (Apache) or the PHP built-in server
   - Optional: XAMPP / WAMP / MAMP

2. Clone the repo
```bash
git clone https://github.com/kp-pc/Dairy-Management-System.git
cd Dairy-Management-System
```

3. Create the database and import schema
```bash
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS dry CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -u root -p dry < dry.sql
```

4. Update DB credentials
- Edit `connect.php` (and `connection.php` if used) to set your MySQL credentials (host, username, password, database name).

5. Start a local PHP server (for testing)
```bash
php -S localhost:8000
# then open http://localhost:8000/startpage.php
```

## Sample screenshots
(The images below are embedded from the repository and will render on GitHub.)

Home / Start page
![Home Page](Screen_shots/startpage.png)

Services page
![Services](Screen_shots/services.png)

Farmer module
![Farmer module](Screen_shots/Farmer.png)

Animal information
![Animal information](Screen_shots/Animal_info.png)

Daily data entry
![Daily Data](Screen_shots/Daily_Data.png)

Products
![Products](Screen_shots/products.png)

Billing
![Bill](Screen_shots/Bill.png)
![Bill - details](Screen_shots/Bill-1.png)

More visual assets are available in `images/` (product photos, logos, gallery images) — feel free to use those files in documentation or demos.

## Important notes & recommended improvements
- Security: Many DB calls use interpolated variables (vulnerable to SQL injection).
  - Recommendation: migrate DB calls to PDO or mysqli prepared statements.
  - Do not commit real credentials; consider using a `.env` file and add it to `.gitignore`.
- Authentication: Use password hashing (password_hash / password_verify) and session hardening.
- Consolidate DB code: there are multiple connection files (`connect.php`, `connection.php`) — standardize on one.
- Optimize large images: `images/` contains very large files; consider optimizing or using Git LFS.

## Contributing
1. Fork the repository.
2. Create a branch: `git checkout -b fix/db-pdo-prepared-statements`
3. Make changes and open a pull request with a clear description.

Suggested first PRs:
- Replace raw SQL with prepared statements.
- Centralize DB configuration into one file and/or environment variables.
- Add a Docker Compose setup for reproducible local development.

## Troubleshooting
- "Database connection failed" — check `dry.sql` import and `connect.php` credentials.
- Enable error reporting in development:
```php
ini_set('display_errors', 1);
error_reporting(E_ALL);
```

## License & attribution
- The repository currently has no LICENSE file. Add a LICENSE (e.g., MIT) if you want to permit reuse.
- FPDF is bundled under its license in `fpdf/license.txt`. Respect that license for distribution.

If you want, I can:
- commit this README.md to the repository for you,
- add a small docker-compose.yml (PHP + MySQL) to simplify running the app,
- or open a PR that converts one insert operation to prepared statements (e.g., the `connect.php` insert). Which would you like next?
