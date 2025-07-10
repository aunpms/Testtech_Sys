# --- Dockerfile ที่แก้ไขแล้วสำหรับ PHP + MS SQL Server บน Render ---

# 1. ระบุ Environment พื้นฐาน
FROM php:8.2-apache

# 2. ติดตั้ง Dependencies ที่จำเป็นสำหรับ MS SQL Driver ก่อน
# เราต้องติดตั้งเครื่องมือพื้นฐานและไดรเวอร์ ODBC ของ Microsoft
RUN apt-get update && apt-get install -y \
    gnupg \
    lsb-release \
    curl \
    && curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
    && curl https://packages.microsoft.com/config/debian/11/prod.list > /etc/apt/sources.list.d/mssql-release.list \
    && apt-get update \
    && ACCEPT_EULA=Y apt-get install -y msodbcsql18 mssql-tools18 unixodbc-dev

# 3. ติดตั้ง PHP Extensions สำหรับ MS SQL Server
# เราต้องติดตั้งทั้ง pdo_sqlsrv และ sqlsrv
RUN pecl install pdo_sqlsrv sqlsrv \
    && docker-php-ext-enable pdo_sqlsrv sqlsrv

# 4. คัดลอกไฟล์โปรเจกต์ของเราไปใส่ในเว็บเซิร์ฟเวอร์
COPY . /var/www/html/
