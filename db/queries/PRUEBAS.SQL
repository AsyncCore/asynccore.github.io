USE ASYNCORE;

CALL SP_MOSTRAR_POSTS_POR_HILO(1);

SELECT POSTS.ID_POST, USERS.USERNAME, POSTS.CONTENIDO, POSTS.FECHA_CREACION, POSTS.FECHA_EDICION
FROM POSTS
         INNER JOIN USERS ON POSTS.USER_ID = USERS.USER_ID
WHERE POSTS.ID_HILO = 3
ORDER BY POSTS.FECHA_CREACION;

SELECT *
FROM USERS;

INSERT INTO USERS (USERNAME, PASSWORD, EMAIL, AVATAR, FIRMA, TIPO_USUARIO)
VALUES ('Carmen.Pizarro', 'CarmenPizarro01', 'carmen.pizarro@educa.madrid.org', NULL, 'La de bases...', 2);

CALL SP_MODIFICAR_DATOS_USUARIO(5, 'Daniel.Alonso', 'DanielAlonso01', 'dalonso3@educa.madrid.org', NULL, 'Er compi 3',
                                3);

SELECT *
FROM USERS;

CALL SP_MODIFICAR_DATOS_USUARIO(6, 'Marcos.Almorox', 'MarcosAlmorox01', 'marcos.almorox@educa.madrid.org', NULL, 'Er compi 4', 3);

CALL SP_MODIFICAR_DATOS_USUARIO(1, 'ADMIN', 'Admin1234', 'asyncoreproject@gmail.com', NULL, 'ADMINISTRADOR', 1);

CALL SP_CREAR_POST_EN_HILO(3, 5, 'JAJAJA K SI K BALE');

CALL SP_CREAR_POST_EN_HILO(3, 8, 'LAH TUPLAH TAN MU BIEN ECHAH, AZÍN NO VAMOH A TENE UN PROBLEMAH EH');

UPDATE HILOS
SET FECHA_CREACION = '2023-10-18 17:25:59'
WHERE ID_HILO = 2;

drop database ASYNCORE;


/*DELETE FROM POSTS WHERE ID_HILO = 3 AND USER_ID = 6 AND CONTENIDO = 'Buenas tardes, amigos :D';*/