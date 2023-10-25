CREATE PROCEDURE SP_MODIFICAR_DATOS_USUARIO(
    IN p_user_id INT,
    IN p_username VARCHAR(255),
    IN p_password VARCHAR(255),
    IN p_email VARCHAR(255),
    IN p_avatar VARCHAR(255),
    IN p_firma VARCHAR(255),
    IN p_tipo_usuario INT
)
BEGIN
    UPDATE USERS
    SET
        USERNAME = p_username,
        PASSWORD = p_password,
        EMAIL = p_email,
        AVATAR = p_avatar,
        FIRMA = p_firma,
        TIPO_USUARIO = p_tipo_usuario
    WHERE USER_ID = p_user_id;
END;
