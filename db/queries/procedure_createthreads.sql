CREATE PROCEDURE SP_CREAR_HILO(
    IN p_user_id INT,
    IN p_titulo VARCHAR(255),
    IN p_contenido TEXT,
    IN p_id_categoria INT
)
BEGIN
    INSERT INTO HILOS (USER_ID, TITULO, CONTENIDO, ID_CATEGORIA)
    VALUES (p_user_id, p_titulo, p_contenido, p_id_categoria);
    DECLARE new_hilo_id INT;
    SET new_hilo_id = LAST_INSERT_ID();
    /*Esto es para insertar el primer post del hilo*/
    INSERT INTO POSTS (ID_HILO, USER_ID, CONTENIDO)
    VALUES (new_hilo_id, p_user_id, p_contenido);
    /*Eliminar sin miedo en caso de que no sea necesario.*/
END
