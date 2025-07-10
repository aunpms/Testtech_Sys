# --- Dockerfile Final Version (Last Attempt) ---

# 1. ใช้ Image พื้นฐานที่เป็น Debian 10 (Buster)
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

# 4. (สำคัญที่สุด) บังคับแก้ไขไฟล์คอนฟิกของ OpenSSL
# เพื่อยอมรับทั้ง Protocol และ Cipher แบบเก่า
RUN echo "" >> /etc/ssl/openssl.cnf \
    && echo "[system_default_sect]" >> /etc/ssl/openssl.cnf \
    && echo "MinProtocol = TLSv1.0" >> /etc/ssl/openssl.cnf \
    && echo "CipherString = DEFAULT@SECLEVEL=1" >> /etc/ssl/openssl.cnf

# 5. คัดลอกไฟล์โปรเจกต์ของเรา
COPY . /var/www/html/
