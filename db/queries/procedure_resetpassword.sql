CREATE PROCEDURE SP_RESTABLECER_CONTRASENA(
    IN p_user_id INT,
    IN p_new_password VARCHAR(255),
    IN p_old_password VARCHAR(255)
)
BEGIN
    IF p_old_password <> p_new_password THEN
        UPDATE USERS
        SET PASSWORD = p_new_password
        WHERE USER_ID = p_user_id;
    END IF;
END
