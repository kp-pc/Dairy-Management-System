Thank you for considering contributing to Dairy-Management-System!

Please follow this simple checklist when opening a PR:

- Fork the repository and create a topic branch named with one of these prefixes:
  - fix/...
  - feat/...
  - docs/...
  - chore/...
- Make small, focused commits. Use present-tense imperative messages, e.g., "Fix SQL injection in connect.php".
- If your change touches code, include a short description and, if possible, a unit or manual test that demonstrates the behaviour.
- Run a quick smoke test for the app if you changed runtime behavior (start the app and exercise the changed page).
- Update README.md or other docs if your change affects setup or behavior.

How to open a PR (example):
```bash
git checkout -b fix/prepared-statements
# make changes
git add .
git commit -m "Use prepared statements for farmer insert"
git push origin fix/prepared-statements
# then open a PR on GitHub
```

We welcome improvements: security hardening, Docker/Docker Compose improvements, code cleanup, and better UI.
