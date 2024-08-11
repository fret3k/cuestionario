CREATE TABLE `dbquestionario`. (`id_user` VARCHAR(64) NOT NULL ,
                                `user` VARCHAR(32) NOT NULL , 
                                `contrasenia` VARCHAR(32) NOT NULL
                                , `nombre` VARCHAR(32) NOT NULL , 
                                `apellidos` VARCHAR(32) NOT NULL , 
                                `rol` ENUM('administrador','usuario')
                                NOT NULL , PRIMARY KEY (`id_user`(64)))
                                ENGINE = InnoDB;