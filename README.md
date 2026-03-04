# EventCleanup

EventCleanup is a clean, modern web application designed to help communities organize, discover, and participate in local environmental cleanup events. Built with PHP and MongoDB.

## How to Clone and Run

### Prerequisites
- PHP 8.0+
- [Composer](https://getcomposer.org/)
- Running instance of MongoDB

### Steps

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

4. **Start the development server**
   ```bash
   php -S localhost:8000
   ```
   Open your browser and visit: `http://localhost:8000`