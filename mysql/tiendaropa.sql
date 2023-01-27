DROP DATABASE IF EXISTS TIENDA_ROPA;
CREATE DATABASE TIENDA_ROPA;
USE TIENDA_ROPA;

CREATE TABLE CLIENTE
(
    ID_CLIENTE INT AUTO_INCREMENT PRIMARY KEY,
        NOMBRE VARCHAR(40),
    APELLIDO VARCHAR(40),
    EMAIL VARCHAR(40),
    DIRECCION VARCHAR(40),
    CONTRASENA VARCHAR(6),
    TELEFONO INT(9)
);

CREATE TABLE CATEGORIA
(
    ID_CATEGORIA INTEGER AUTO_INCREMENT PRIMARY KEY,
    NOMBRE       VARCHAR(40)
);


CREATE TABLE ALMACEN
(
    ID_ALMACEN INTEGER AUTO_INCREMENT PRIMARY KEY,
    LOCALIDAD  VARCHAR(40)
);


CREATE TABLE PRODUCTO
(
    ID_PRODUCTO  INTEGER AUTO_INCREMENT PRIMARY KEY,
    NOMBRE       VARCHAR(40),
    SERVICIO     ENUM ('SERIGRAFIA','BORDADO','AMBAS','NINGUNO') DEFAULT NULL,
    PRECIO_BASE  DOUBLE,
    ID_CATEGORIA INTEGER
);

ALTER TABLE PRODUCTO
    ADD CONSTRAINT FK_PROD_CAT FOREIGN KEY (ID_CATEGORIA) REFERENCES CATEGORIA (ID_CATEGORIA);

CREATE TABLE COMPRA
(
    ID_COMPRA    INTEGER AUTO_INCREMENT,
    ID_CLIENTE   INTEGER,
    ID_PRODUCTO  INTEGER,
    FECHA_COMPRA DATE,
    UNIDADES     INTEGER,
    PRIMARY KEY (ID_COMPRA,ID_CLIENTE,FECHA_COMPRA)
);

ALTER TABLE COMPRA
    ADD CONSTRAINT FK_COM_CLI FOREIGN KEY (ID_CLIENTE) REFERENCES CLIENTE (ID_CLIENTE);

ALTER TABLE COMPRA
    ADD CONSTRAINT FK_COM_PRO FOREIGN KEY (ID_PRODUCTO) REFERENCES PRODUCTO (ID_PRODUCTO);

CREATE TABLE ALMACENA
(
    ID_ALMACEN  INTEGER,
    ID_PRODUCTO INTEGER,
    CANTIDAD    INTEGER,
    PRIMARY KEY(ID_ALMACEN,ID_PRODUCTO)
);

ALTER TABLE ALMACENA
    ADD CONSTRAINT FK_ALM_ALM FOREIGN KEY (ID_ALMACEN) REFERENCES ALMACEN (ID_ALMACEN);

ALTER TABLE ALMACENA
    ADD CONSTRAINT FK_ALM_PRO FOREIGN KEY (ID_PRODUCTO) REFERENCES PRODUCTO (ID_PRODUCTO);

CREATE TABLE SERVICIOS
(
    ID_SERVICIO INTEGER AUTO_INCREMENT PRIMARY KEY,
    NOMBRE      VARCHAR(40),
    PRECIO      DOUBLE

);

CREATE TABLE ENCARGA
(
    ID_ENCARGA   INTEGER AUTO_INCREMENT,
    ID_CLIENTE   INTEGER,
    ID_SERVICIO  INTEGER,
    FECHA_COMPRA DATE,
    UNIDADES     INTEGER,
    PRIMARY KEY (ID_ENCARGA, ID_CLIENTE,FECHA_COMPRA)
);

ALTER TABLE ENCARGA
    ADD CONSTRAINT FK_ALM_CLI FOREIGN KEY (ID_CLIENTE) REFERENCES CLIENTE (ID_CLIENTE);
ALTER TABLE ENCARGA
    ADD CONSTRAINT FK_ALM_SERV FOREIGN KEY (ID_SERVICIO) REFERENCES SERVICIOS (ID_SERVICIO);




