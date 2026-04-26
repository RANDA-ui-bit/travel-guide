# Travel & Tourism Guide

A simple multi-page **Travel & Tourism Guide** built with **PHP + MySQL + HTML/CSS/JS**.

## Pages

- `index.php` (Home + slideshow + featured destinations)
- `destinations.php` (All destinations + click card to view details)
- `destination.php` (Single destination details page)
- `tours.php` (Tours table)
- `gallery.php` (10-image gallery)
- `tips.php` (travel tips + embedded video + audio)
- `contact.php` (contact form + JS validation + saves to DB)
- `dashboard.php` (MySQL CRUD for destinations + search + view/delete contact messages)

## Requirements checklist (mapped)

### HTML

- Minimum **7 pages**: yes (8 pages)
- Page titles: yes
- Header & Footer: yes (`partials/header.php`, `partials/footer.php`)
- Navigation menu: yes
- 10+ images: yes (Gallery + destination images)
- Click to view details: yes (destination card modal + details page)
- 1 form minimum: yes (`contact.php`, also dashboard forms)
- 2 tables minimum: yes (`tours.php`, `dashboard.php`, `destination.php` has an extra facts table)
- Ordered & unordered list: yes (`tips.php`)
- Links (internal & external): yes
- Embedded media (video/audio): yes (`tips.php`)
- Logo + favicon: yes (`assets/img/logo.svg`, `assets/img/favicon.svg`)

### CSS

- 2 types of CSS: yes
  - External: `assets/css/styles.css`
  - Internal: `$internalCss` used in `index.php` and `tips.php`
  - Inline: used in multiple places
- More than 8 different colors: yes (CSS variables in `styles.css`)
- Class + ID selector: yes
- Pseudo-selector (hover): yes
- Floating: yes (`.float-left`)

### JavaScript

- Display item info on click: yes (destination modal in `assets/js/main.js`)
- Form validation (required + email format): yes (`assets/js/main.js` for `contact.php`)
- Slideshow / simple animation: yes (`index.php` slideshow in `assets/js/main.js`)

### PHP & MySQL

- MySQL with 15+ records: yes (`destinations` seeded with 15 rows)
- At least 3 fields per item: yes (`destinations` has 5 fields)
- Insert / update / delete: yes (`dashboard.php`)
- Display data on `dashboard.php`: yes
- Simple search: yes (`dashboard.php?q=...`)

## Setup (XAMPP/WAMP)

### 1) Put the project under your web root

Example (XAMPP):

- `C:\xampp\htdocs\Travel & Tourism Guide\`

Then open:

- `http://localhost/Travel%20%26%20Tourism%20Guide/index.php`

### 2) Create database + tables

Import / run:

- `database.sql`

This creates:

- Database: `travel_guide`
- Tables: `destinations`, `messages`

### 3) Update DB credentials (if needed)

Edit `config.php`:

- `$DB_HOST` (usually `localhost`)
- `$DB_NAME` (default: `travel_guide`)
- `$DB_USER` (often `root`)
- `$DB_PASS` (often empty in XAMPP)

## Notes

- If `dashboard.php` shows “Messages table not found”, import the updated `database.sql` again (or manually create table `messages`).
