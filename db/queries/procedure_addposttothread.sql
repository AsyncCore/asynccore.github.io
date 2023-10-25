CREATE PROCEDURE SP_CREAR_POST_EN_HILO(
    IN p_id_hilo INT,
    IN p_user_id INT,
    IN p_contenido TEXT
)
BEGIN
    INSERT INTO POSTS (ID_HILO, USER_ID, CONTENIDO)
    VALUES (p_id_hilo, p_user_id, p_contenido);
END
