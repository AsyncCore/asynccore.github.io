CREATE PROCEDURE SP_MOSTRAR_POSTS_POR_HILO(IN p_id_hilo INT)
BEGIN
    DECLARE post_id INT;
    DECLARE user_name VARCHAR(255);
    DECLARE post_content TEXT(2000);
    DECLARE fecha_creacion TIMESTAMP;
    DECLARE fecha_edicion TIMESTAMP;

    DECLARE post_cursor CURSOR FOR
        SELECT POSTS.ID_POST, USERS.USERNAME, POSTS.CONTENIDO, POSTS.FECHA_CREACION, POSTS.FECHA_EDICION
        FROM POSTS
        INNER JOIN USERS ON POSTS.USER_ID = USERS.USER_ID
        WHERE POSTS.ID_HILO = p_id_hilo
        ORDER BY POSTS.FECHA_CREACION;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE; --Esto es para decir que el cursor no va a retornar nada
    
    OPEN post_cursor;
    SET done = FALSE;
    post_loop: LOOP
        FETCH post_cursor INTO post_id, user_name, post_content, fecha_creacion, fecha_edicion;
        IF done THEN
            LEAVE post_loop;
        END IF;
        SELECT post_id AS ID_POST, user_name AS USERNAME, post_content AS CONTENIDO, fecha_creacion AS FECHA_CREACION, fecha_edicion AS     FECHA_EDICION;
    END LOOP;
    CLOSE post_cursor;
END
