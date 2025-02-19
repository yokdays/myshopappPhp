# 🛒 Laravel E-Commerce Project

## 📌 รายละเอียดโปรเจค

โปรเจคนี้เป็นระบบร้านค้าออนไลน์พัฒนาโดยใช้ **Laravel** ซึ่งมีฟีเจอร์ต่างๆ เช่น:

- ระบบสมาชิก
- จัดการสินค้า
- ค้นหาสินค้าโดยใช้
- ระบบตะกร้าสินค้า
- อัปเดตสถานะคำสั่งซื้อแบบเรียลไทม์ด้วย

---

## 🔧 การติดตั้ง

### 1️⃣ **โคลนโปรเจค**

```sh
git clone https://github.com/yokdays/myshopappPhp.git
cd myshopappPhp
```

### 2️⃣ **ติดตั้ง Dependencies**

```sh
composer install
npm install
```

### 3️⃣ \*\*ตั้งค่าไฟล์ \*\*\`\`

```sh
cp .env.example .env
php artisan key:generate
```

จากนั้นแก้ไขค่า **DATABASE** และการตั้งค่าอื่นๆ

### 4️⃣ **รัน Migration Seeder และ storage:link**

```sh
php artisan migrate --seed
php artisan storage:link
```

### 5️⃣ **รันเซิร์ฟเวอร์**

```sh
npm run dev
php artisan serve
```

---

## 🚀 ฟีเจอร์หลัก

### 🏬 ระบบสินค้า

- เพิ่ม/แก้ไข/ลบสินค้า
- แสดงสินค้าตามหมวดหมู่
- ระบบค้นหาสินค้าด้วย `Bootstrap 5`

### 🛍️ ตะกร้าสินค้า

- เพิ่ม/ลบสินค้าในตะกร้า
- คำนวณราคาสินค้าอัตโนมัติ

### 📦 ระบบคำสั่งซื้อ

- อัปเดตสถานะออเดอร์แบบเรียลไทม์

---
## การใช้งาน
### สำหรับผู้ใช้ทั่วไป

- email => user@example.com
- password => user
### สำหรับแอดมิน

- email => admin@example.com
- password => admin
  
## 🛠 เทคโนโลยีที่ใช้

- **Laravel 10** (Backend)
- **Bootstrap 5** (Frontend)
- **MySQL** (Database)

---

## 📄 License

โปรเจคนี้อยู่ภายใต้ **MIT License**

---

## 👨‍💻 ผู้พัฒนา

- [nakin](https://github.com/yokdays)



