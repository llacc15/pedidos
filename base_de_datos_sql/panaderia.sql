-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS panaderia;
USE panaderia;

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL,
    contraseña VARCHAR(255) NOT NULL,
    rol ENUM('usuario', 'admin') DEFAULT 'usuario'
);

-- Tabla de pedidos
CREATE TABLE IF NOT EXISTS pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    producto VARCHAR(100) NOT NULL,
    cantidad INT NOT NULL,
    estado ENUM('pendiente', 'preparando', 'entregado') DEFAULT 'pendiente',
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Insertar el administrador por defecto
INSERT INTO usuarios (nombre, correo, contraseña, rol) 
VALUES ('Admin', 'prueba12@gmail.com', SHA2('1234@', 256), 'admin');
