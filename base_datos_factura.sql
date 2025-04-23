
CREATE TABLE facturas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente VARCHAR(100),
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10,2)
);

CREATE TABLE detalle_factura (
    id INT AUTO_INCREMENT PRIMARY KEY,
    factura_id INT,
    producto VARCHAR(100),
    precio DECIMAL(10,2),
    FOREIGN KEY (factura_id) REFERENCES facturas(id)
);
