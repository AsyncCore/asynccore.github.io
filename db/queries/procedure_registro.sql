CREATE PROCEDURE SP_INSERT_USER(
    IN p_username VARCHAR(255),
    IN p_password VARCHAR(255),
    IN p_email VARCHAR(255),
    IN p_avatar VARCHAR(255),
    IN p_firma VARCHAR(255),
    IN p_tipo_usuario INT,
    OUT p_success BOOLEAN
)
BEGIN
    DECLARE existing_user_count INT;

    /*Comprobación de si existe el usuario*/
    SELECT COUNT(*)
    INTO existing_user_count
    FROM USERS
    WHERE USERNAME = p_username;

    IF existing_user_count > 0 THEN
        SET p_success := FALSE;
        LEAVE SP_INSERT_USER_PROC;
    END IF;
    /*Insertar el nuevo usuario*/
    INSERT INTO USERS (USERNAME, PASSWORD, EMAIL, AVATAR, FIRMA, TIPO_USUARIO)
    VALUES (p_username, p_password, p_email, p_avatar, p_firma, p_tipo_usuario);

    SET p_success := TRUE;
    /*Si el usuario existe se usa esta etiqueta para salir (No tengo muy claro su funcionamiento.)*/
    SP_INSERT_USER_PROC:
    BEGIN
    END;
END
