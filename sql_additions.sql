-- Дополнения к БД для расширенного функционала

USE bank_site;

-- Таблицы заявок

CREATE TABLE IF NOT EXISTS credit_applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    amount DECIMAL(15,2) NOT NULL,
    term INT NOT NULL,
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS deposit_applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    amount DECIMAL(15,2) NOT NULL,
    term INT NOT NULL,
    type VARCHAR(100) NOT NULL,
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Пример создания администратора (пароль admin123, нужно пересчитать хеш под PHP, здесь заглушка):

-- В PHP выполните один раз:
-- <?php echo password_hash('admin123', PASSWORD_DEFAULT); ?>

-- затем подставьте полученный хеш в запрос:

-- INSERT INTO users (fullname, email, password_hash, role)
-- VALUES ('Администратор', 'admin@bankx.ru', '<СЮДА_ВСТАВИТЬ_ХЕШ>', 'admin');
