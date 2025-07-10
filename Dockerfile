# --- Dockerfile Final Version using Debian Buster ---

# 1. (สำคัญ) เปลี่ยนมาใช้ Image พื้นฐานที่เป็น Debian 10 (Buster)
# ซึ่งใช้ OpenSSL 1.1.1 ที่เข้ากันได้กับ SQL Server รุ่นเก่า
FROM php:8.2-apache-buster

# 2. ติดตั้ง Dependencies ที่จำเป็นสำหรับ MS SQL Driver บน Debian 10
RUN apt-get update && apt-get install -y \
    gnupg \
    lsb-release \
    curl \
    && curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
    && curl https://packages.microsoft.com/config/debian/10/prod.list > /etc/apt/sources.list.d/mssql-release.list \
    && apt-get update \
    && ACCEPT_EULA=Y apt-get install -y msodbcsql17 mssql-tools unixodbc-dev

# 3. ติดตั้ง PHP Extensions สำหรับ MS SQL Server
RUN pecl install pdo_sqlsrv sqlsrv \
    && docker-php-ext-enable pdo_sqlsrv sqlsrv

# 4. คัดลอกไฟล์โปรเจกต์ของเรา
COPY . /var/www/html/
