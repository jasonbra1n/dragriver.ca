# Contributing to Drag River Creative

First off, thanks for taking the time to contribute! 🎉

The following is a set of guidelines for contributing to Drag River Creative. These are mostly guidelines, not rules. Use your best judgment, and feel free to propose changes to this document in a pull request.

## 📜 Code of Conduct

This project and everyone participating in it is governed by our Code of Conduct. By participating, you are expected to uphold this code. Please report unacceptable behavior to the project maintainers.

## 🛠 Tech Stack

*   **Frontend**: Vanilla HTML5, CSS3, JavaScript (ES6+)
*   **Backend**: PHP 8.0+
*   **Server**: Apache/Nginx (Common PHP setup)

## 🚀 How to Contribute

1.  **Fork the repository** on GitHub.
2.  **Clone your fork** locally.
3.  **Create a branch** for your feature or fix:
    ```bash
    git checkout -b feat/amazing-feature
    ```
4.  **Make your changes** following our coding standards.
5.  **Commit your changes** using conventional commit messages.
6.  **Push to your fork**:
    ```bash
    git push origin feat/amazing-feature
    ```
7.  **Submit a Pull Request** to the `main` branch of the original repository.

## 🎨 Coding Standards

### PHP
*   Use `declare(strict_types=1);` at the top of PHP files.
*   Follow PSR-12 coding standards.
*   Ensure all pages use `require_once` to load `src/bootstrap.php` for initialization.

### JavaScript
*   Use modern ES6+ syntax (const/let, arrow functions).
*   Keep logic in `public/script.js` unless a specific submodule requires its own script.
*   Use descriptive variable and function names.

### CSS
*   Keep styles in `public/styles.css`.
*   Use CSS Variables (defined in `:root`) for colors and fonts.
*   Follow the BEM (Block Element Modifier) naming convention where possible.
*   Refer to `.github/STYLE_GUIDE.md` for the color palette.

### HTML
*   Use semantic HTML5 tags (`<header>`, `<main>`, `<section>`, `<footer>`).
*   Ensure accessibility (ARIA labels, alt text).

## 📝 Commit Messages

We follow the **Conventional Commits** specification.

*   `feat`: A new feature
*   `fix`: A bug fix
*   `docs`: Documentation only changes
*   `style`: Changes that do not affect the meaning of the code (white-space, formatting, etc)
*   `refactor`: A code change that neither fixes a bug nor adds a feature
*   `perf`: A code change that improves performance
*   `test`: Adding missing tests or correcting existing tests
*   `chore`: Changes to the build process or auxiliary tools

**Example:**
```text
feat: add weather widget to flow dashboard
```

## 🐛 Reporting Bugs

Bugs are tracked as GitHub issues. When filing an issue, please include:
*   A clear title and description.
*   Steps to reproduce the bug.
*   Expected vs. actual behavior.
*   Screenshots if applicable.

## 💡 Feature Requests

Feature requests are welcome! Please check the `.github/ROADMAP.md` first to see if it's already planned. If not, open an issue to discuss your idea.