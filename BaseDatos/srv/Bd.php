<?php

class Bd
{
    private static ?PDO $pdo = null;

    static function pdo(): PDO
    {
        if (self::$pdo === null) {

            self::$pdo = new PDO(
                // cadena de conexión
                "mysql:host=sql105.infinityfree.com;dbname=if0_37577868_Servicios",
                // usuario
                "if0_37577868",
                // contraseña
                "sLhrZ0OZyu",
                // Opciones: pdos no persistentes y lanza excepciones.
                [PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );

            self::$pdo->exec(
                "CREATE TABLE IF NOT EXISTS HOSPITAL (
                    ID_Hospital INT PRIMARY KEY AUTO_INCREMENT, 
                    Nombre_Hospital TEXT NOT NULL,
                    Direccion TEXT NOT NULL,
                    Telefono TEXT NOT NULL,
                    CONSTRAINT HOSPITAL_NOMBRE_UNQ UNIQUE (Nombre_Hospital),
                    CONSTRAINT HOSPITAL_TEL_UNQ UNIQUE (Telefono),
                    CONSTRAINT HOSPITAL_NOMBRE_LEN CHECK (LENGTH(Nombre_Hospital) BETWEEN 5 AND 100),
                    CONSTRAINT HOSPITAL_DIRECCION_LEN CHECK (LENGTH(Direccion) BETWEEN 10 AND 200),
                    CONSTRAINT HOSPITAL_TEL_LEN CHECK (LENGTH(Telefono) BETWEEN 7 AND 15)
                )"
            );
        }

        return self::$pdo;
    }
}
