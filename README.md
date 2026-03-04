# EventCleanup 🌿

A community cleanup event platform built with PHP and MongoDB.

## Run Locally

```bash
# 1. Install dependencies
composer install

# 2. Copy and edit env file
cp .env.example .env
# Edit .env with your MongoDB URI

# 3. Start PHP dev server
php -S localhost:8000
```
Open http://localhost:8000

---

## Deploy on Railway (free, like Vercel for PHP)

1. Push this repo to GitHub
2. Go to [railway.app](https://railway.app) → **New Project** → **Deploy from GitHub repo**
3. Select this repo — Railway auto-detects PHP
4. Go to **Variables** tab and add:
   ```
   MONGO_URI = <your MongoDB connection string>
   MONGO_DB  = eventcleanup
   ```
5. Click **Deploy** — your app is live! 🚀

> **Tip**: If using MongoDB Atlas, your URI looks like:
> `mongodb+srv://user:pass@cluster.mongodb.net`

---

## Project Structure

```
eventcleanup/
├── index.php       # Home page
├── event.php       # Events listing + search + map
├── page.php        # Add a new event form
├── config.php      # MongoDB connection (reads from .env)
├── composer.json   # PHP dependencies
├── style.css       # Styles
└── railway.toml    # Railway deployment config
```

## Database

MongoDB — `eventcleanup` database, `trips` collection.

Each event document:
```json
{
  "name":     "Beach Cleanup",
  "location": "Marina Beach, Chennai",
  "date":     ISODate("2024-06-15T09:00:00Z"),
  "zip":      "600001",
  "phone":    "9876543210",
  "map":      "https://maps.google.com/...",
  "des":      "Bring gloves and bags!",
  "lat":      13.0499,
  "lng":      80.2824
}
```