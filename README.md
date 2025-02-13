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
git clone https://github.com/your-repository.git
cd your-repository
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

### 4️⃣ **รัน Migration และ Seeder**

```sh
php artisan migrate --seed
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
- ใช้ `AJAX + jQuery` เพื่ออัปเดตสถานะทันที

---

## 🛠 เทคโนโลยีที่ใช้

- **Laravel 10** (Backend)
- **Bootstrap 5** (Frontend)
- **AJAX + jQuery** (Real-time Update)
- **MySQL** (Database)

---

## 📄 License

โปรเจคนี้อยู่ภายใต้ **MIT License**

---

## 👨‍💻 ผู้พัฒนา

- [Your Name](https://github.com/your-github)



