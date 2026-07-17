Reporting security issues

If you discover a security vulnerability in this project, please do NOT open a public issue. Instead, contact the repository owner directly or use the security contact method on the GitHub repository page.

Short security guidance for contributors and maintainers:
- Do not commit secrets (passwords, API keys, private keys). Use `.env` files and add them to `.gitignore`.
- Avoid inline SQL with interpolated variables. Use prepared statements (PDO or mysqli) as shown in `connect_secure.php`.
- Hash passwords using password_hash() and verify with password_verify().
- Sanitize and validate all user input.
- Use HTTPS in production and secure cookie/session settings.

If you need assistance fixing a vulnerability, open a private discussion with the maintainers or submit a PR with the fix and reference the security report.
