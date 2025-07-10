# --- Dockerfile สำหรับโปรเจกต์ PHP บน Render ---

# 1. ระบุ Environment พื้นฐาน: ใช้ Official PHP image ที่มี Apache ติดตั้งมาให้
# คุณสามารถเปลี่ยนเวอร์ชันได้ตามต้องการ เช่น php:8.3-apache
FROM php:8.2-apache

# 2. คัดลอกไฟล์ทั้งหมดในโปรเจกต์ของเรา ไปใส่ในโฟลเดอร์ของเว็บเซิร์ฟเวอร์
# Source (ซ้าย) คือโปรเจกต์ของเรา, Destination (ขวา) คือ /var/www/html/ ใน container
COPY . /var/www/html/

# 3. (ถ้าจำเป็น) ติดตั้ง extensions ของ PHP ที่ต้องใช้เพิ่มเติม
# จากชื่อไฟล์ของคุณ (conn.php) เดาว่าต้องใช้ mysqli เพื่อเชื่อมต่อฐานข้อมูล
# บรรทัดนี้จะติดตั้ง mysqli ให้โดยอัตโนมัติ
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# ไม่ต้องมีคำสั่งอื่นเพิ่มเติม Apache จะเริ่มทำงานเองโดยอัตโนมัติ