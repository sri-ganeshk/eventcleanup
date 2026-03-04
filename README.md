# EventCleanup 🌍✨

[![PHP 8.0+](https://img.shields.io/badge/PHP-8.0+-777BB4.svg?style=flat-square&logo=php)](https://php.net/)
[![MongoDB](https://img.shields.io/badge/MongoDB-Enabled-47A248.svg?style=flat-square&logo=mongodb)](https://www.mongodb.com/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=flat-square)](https://opensource.org/licenses/MIT)

**EventCleanup** is a clean, modern web application designed to help communities organize, discover, and participate in local environmental cleanup events. Whether it's picking up litter at the local park or organizing a massive beach sweep, this platform brings volunteers together.

---

## 🚀 Features

- **Modern & Clean UI**: Fully responsive, custom-designed aesthetic using Vanilla CSS3.
- **Dynamic Event Listings**: Easily browse upcoming events sorted by date.
- **Robust Search**: Find specific cleanups by name, location, or pincode using MongoDB's powerful regex querying.
- **Create Events**: A clean, validated form allowing anyone to submit a new cleanup initiative.
- **NoSQL Database**: Built on scalable MongoDB architecture.

---

## 🛠️ Tech Stack

- **Frontend**: HTML5, Vanilla CSS3 (Custom Design System, Flexbox/Grid)
- **Backend**: PHP 8.2
- **Database**: MongoDB (via `mongodb/mongodb` native PHP driver)
- **Deployment**: Configured for seamless deployment on [Railway](https://railway.app) (Nixpacks)

---

## 📸 Screenshots

*(Add screenshots of your application here to make your repository stand out!)*

<details>
<summary>Click to view instructions on adding screenshots</summary>

1. Run the app locally.
2. Take screenshots of the Home Page, Events Listing, and Add Event form.
3. Save them in an `assets/` folder in this repo.
4. Replace this section with:
```markdown
### Home Page
![Home Page](assets/home.png)

### Events Listing
![Events Listing](assets/events.png)
```
</details>

---

## 💻 Run Locally (Quick Start)

Want to run this project on your own machine? It's easy!

### Prerequisites
- PHP 8.0+
- [Composer](https://getcomposer.org/)
- Running instance of MongoDB

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/eventcleanup.git
   cd eventcleanup
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Configure Environment**
   ```bash
   cp .env.example .env
   ```
   *Edit `.env` and set your `MONGO_URI` if your database isn't running on `localhost:27017`.*

4. **Seed the database with sample data (Optional)**
   ```bash
   php seed.php
   ```
   *This populates the database with a few upcoming events so you can see the UI in action immediately.*

5. **Start the development server**
   ```bash
   php -S localhost:8000
   ```
   Open your browser and visit: `http://localhost:8000`

---

## ☁️ Deploy on Railway

You can deploy this project completely free using [Railway](https://railway.app/). We have already included the `railway.toml` configuration!

1. Fork/Push this repository to your own GitHub account.
2. Go to **[Railway.app](https://railway.app)** → **New Project** → **Deploy from GitHub repo**.
3. Select your `eventcleanup` repository.
4. Go to the **Variables** tab in Railway and add your MongoDB Details:
   ```
   MONGO_URI = mongodb+srv://<username>:<password>@cluster0.mongodb.net/?retryWrites=true&w=majority
   MONGO_DB  = eventcleanup
   ```
5. Click **Deploy**. That's it! 🚀

---

## 🤝 Contributing

Contributions, issues, and feature requests are welcome! Feel free to check the [issues page](../../issues).

## 📝 License

This project is [MIT](LICENSE) licensed.