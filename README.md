# 🎨 Creative Portfolio WordPress Theme

Modern, animated WordPress portfolio theme built with **v0.dev** + **Cursor** + **TailwindCSS**.

## 🚀 Tech Stack

- **WordPress** 6.x
- **Docker** (Development Environment)
- **TailwindCSS** (Styling)
- **v0.dev** (Component Design)
- **Cursor** (AI-Assisted Development)

## 📦 Installation

### Prerequisites
- Docker & Docker Compose
- Git
- Node.js 18+ (for TailwindCSS build)

### Setup

1. Clone the repository
git clone https://github.com/kattan12345/creative-portfolio-wp.git
cd creative-portfolio-wp

2. Configure environment
cp .env.example .env

3. Start Docker containers
docker-compose up -d

4. Access the site
- WordPress: http://localhost:8080
- phpMyAdmin: http://localhost:8081

5. Complete WordPress installation
- Follow the on-screen setup wizard
- Activate "Creative Portfolio" theme

## 🏗️ Development Workflow

### Branch Strategy
- main - Production-ready code
- develop - Development branch
- feature/* - Feature branches

### Making Changes
git checkout develop
git checkout -b feature/new-component
# Make changes...
git add .
git commit -m "feat: add hero section component"
git push origin feature/new-component

## 📂 Project Structure

creative-portfolio-wp/
├── wp-content/
│   ├── themes/
│   │   └── creative-portfolio/
│   │       ├── assets/
│   │       ├── inc/
│   │       ├── template-parts/
│   │       ├── functions.php
│   │       ├── style.css
│   │       └── package.json
│   └── plugins/
├── docker-compose.yml
├── .env.example
└── README.md

## 🎯 Features (Planned)

- [ ] Animated hero section
- [ ] Portfolio grid with filters
- [ ] Dark mode toggle
- [ ] Smooth scroll animations
- [ ] Contact form with validation
- [ ] Blog section
- [ ] SEO optimized

## 📝 Commit Convention

Following Conventional Commits:
- feat: New feature
- fix: Bug fix
- docs: Documentation changes
- style: Code style changes
- refactor: Code refactoring
- test: Adding tests
- chore: Maintenance tasks

## 📄 License

MIT License

## 👤 Author

- GitHub: @kattan12345

---

Built with ❤️ using v0.dev and Cursor
