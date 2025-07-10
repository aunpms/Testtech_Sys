# --- Dockerfile ที่แก้ไขล่าสุดและแน่นอนที่สุด ---

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

# 4. (สำคัญ) บังคับแก้ไขไฟล์คอนฟิกของ OpenSSL โดยตรง
# วิธีนี้จะเพิ่มการตั้งค่าที่จำเป็นเข้าไปท้ายไฟล์ ซึ่งแน่นอนกว่าการค้นหาและแทนที่
RUN echo "[system_default_sect]" >> /etc/ssl/openssl.cnf \
    && echo "CipherString = DEFAULT@SECLEVEL=1" >> /etc/ssl/openssl.cnf

# 5. คัดลอกไฟล์โปรเจกต์ของเราไปใส่ในเว็บเซิร์ฟเวอร์
COPY . /var/www/html/
