# 🏠 Hostigo

**Hostigo** is a property booking platform that allows users to search, book, and manage properties online.  
It provides a system for administrators, hosts, and guests with secure payments, approval workflows, and email notifications.

---

## 🚀 Features

- 🔐 **Authentication System** — Built with Laravel Breeze and role management (Admin, Host, Client).  
- 🏡 **Property Management** — Hosts can create, update, and delete their properties with detailed information.  
- 💳 **Reservation System** — Secure booking flow with **Stripe** payments, approval and cancellation management.  
- 📩 **Email Notifications** — Automatic emails for verifying user account, after a booking is made, and status updates.  
- 🔎 **Search & Filter** — Users can browse properties using dynamic filters and search options.  
- 🧭 **Admin Dashboard** — Manage users, properties, and reservations and everything with interactive charts made by shadcn.  
- 💻 **Responsive Design** — Clean, user-friendly interface built with **Blade**, **Bootstrap**, **tailwind**, **HTML**, **CSS**, and **JavaScript**.  

---

## 🧩 Tech Stack

| Layer | Technologies |
|--------|--------------|
| **Backend** | Laravel (MVC architecture), MySQL |
| **Authentication** | Laravel Breeze |
| **Frontend** | Blade, HTML, CSS, Bootstrap, JavaScript, Dashboard in React |
| **Payments** | Stripe |
| **Other Tools** | Git, GitHub |

---

## ⚙️ Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/usf54/hostigo.git
   cd hostigo
2. **Install dependencies**
    composer install
    npm install
3. **Create environment file**
    cp .env.example .env
    php artisan key:generate
4. **Configure database in .env**
5. **Run migrations**
6. **Start the development servers**
    npm run dev
    php artisan serve

##🧠 Usage

Admins can manage users, reservations, and system data from the dashboard.
Hosts can create and manage their property listings.
Clients can search, book, pay, and review properties directly from the platform.

##👨‍💻 Author
Youssef Oumhdi
Full Stack Developer (Laravel & React)
📧 youssefoumhdi12@gmail.com
🌐 https://github.com/usf54


