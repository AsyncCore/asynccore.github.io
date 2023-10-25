CREATE PROCEDURE SP_LOGIN(IN p_username VARCHAR(255), IN p_password VARCHAR(255), OUT p_success BOOLEAN)
BEGIN
    DECLARE user_id INT;
    DECLARE tipo_usuario INT;

    SELECT USER_ID, TIPO_USUARIO INTO user_id, tipo_usuario
    FROM USERS
    WHERE USERNAME = p_username AND PASSWORD = p_password;
    
    IF user_id IS NOT NULL THEN
        SET p_success := TRUE;
    ELSE
        SET p_success := FALSE;
    END IF;
END 
