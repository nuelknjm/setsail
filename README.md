# SetSail BizAccel — IT Support Asset & Equipment Inventory System

A full-stack **Laravel 11 MVC** web application built for the **IT Support Internship Technical Assignment** at **SetSail BizAccel (The President University Business Accelerator)**.

## ✨ Key Features (Assignment Requirements)
- **MVC Architecture:** Clean separation between `Item` (Model), `index` & `edit` Blade templates (View), and `ItemController` (Controller).
- **Full CRUD Functionality:** Create, Read, Update, and Delete IT equipment records seamlessly.
- **Auto-Incrementing Numbering:** Automatic sequential numbering (`1, 2, 3...`) in the inventory table and auto-increment primary keys (`id`) in MySQL.
- **Image Upload & Storage (Bonus Point):** Supports uploading, previewing, replacing, and deleting equipment photos stored via Laravel's public storage symlink.
- **RESTful JSON API Endpoint (Bonus Point):** Built-in API response in the controller accessible via `GET /api/items`.
- **Modern UI/UX:** Branded with SetSail BizAccel colors, featuring real-time KPI summary cards, instant search, status filtering, and image lightbox preview.

---

## 🏗️ MVC Structure Overview
| Layer | File Path | Responsibility |
| :--- | :--- | :--- |
| **Model (M)** | `app/Models/Item.php` | Interacts with the `items` MySQL table and defines mass-assignable attributes (`name`, `category`, `status`, `image`). |
| **View (V)** | `resources/views/items/index.blade.php`<br>`resources/views/items/edit.blade.php` | Renders the responsive dashboard table, KPI cards, and CRUD forms using Tailwind CSS. |
| **Controller (C)** | `app/Http/Controllers/ItemController.php` | Handles request validation, file storage upload, CRUD logic, and returns JSON for the API endpoint. |
| **Routes** | `routes/web.php` | Maps web URLs and `/api/items` endpoint to `ItemController` methods. |

---

## 🚀 How to Run Locally (Laragon / DBngin / XAMPP)

1. **Clone the repository:**
   ```bash
   git clone <YOUR_GITHUB_REPO_URL>
   cd setsail