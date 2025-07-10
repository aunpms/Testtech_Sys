# --- Dockerfile ที่แก้ไขล่าสุดสำหรับ PHP + MS SQL Server ---

# 1. ระบุ Environment พื้นฐาน
FROM php:8.2-apache

# 2. ติดตั้ง Dependencies ที่จำเป็นสำหรับ MS SQL Driver
RUN apt-get update && apt-get install -y \
    gnupg \
    lsb-release \
    curl \
    && curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
    && curl https://packages.microsoft.com/config/debian/11/prod.list > /etc/apt/sources.list.d/mssql-release.list \
    && apt-get update \
    && ACCEPT_EULA=Y apt-get install -y msodbcsql18 mssql-tools18 unixodbc-dev

# 3. ติดตั้ง PHP Extensions สำหรับ MS SQL Server
RUN pecl install pdo_sqlsrv sqlsrv \
    && docker-php-ext-enable pdo_sqlsrv sqlsrv

# 4. (เพิ่มขั้นตอนนี้) ปรับลดนโยบายความปลอดภัยของ OpenSSL
# เพื่อให้ยอมรับการเข้ารหัสแบบเก่าจาก SQL Server ได้
RUN sed -i 's/DEFAULT@SECLEVEL=2/DEFAULT@SECLEVEL=1/g' /etc/ssl/openssl.cnf

# 5. คัดลอกไฟล์โปรเจกต์ของเราไปใส่ในเว็บเซิร์ฟเวอร์
COPY . /var/www/html/
