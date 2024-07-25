-- PRESUPUESTOS
/

-- ********************************
-- DML y DDL cambios a la tabla estado relacionados a Presupuestos
-- ********************************
-- ESTADOS
-- OPEN: creado pero no tienen ninguna accion en marcha,
-- PROFRESS: se le estan asignando presupuestos,
-- DONE: se cerro el presupuesto sin estar finalizado,
-- COMPLETED: se cerro el presupuesto completando el MONTO_TOTAL,
-- ARCHIVED: se archivo el presupuesto, no aparece en la vista por defecto
INSERT INTO G6_SC504_VT_PROYECTO.FIDE_ESTADO_TB(
    TIPO_ESTADO,
    NOMBRE_ESTADO
) VALUES(
    'PRESUPUESTO_ESTADO',
    'OPEN'
);

INSERT INTO G6_SC504_VT_PROYECTO.FIDE_ESTADO_TB(
    TIPO_ESTADO,
    NOMBRE_ESTADO
) VALUES(
    'PRESUPUESTO_ESTADO',
    'PROFRESS'
);

INSERT INTO G6_SC504_VT_PROYECTO.FIDE_ESTADO_TB(
    TIPO_ESTADO,
    NOMBRE_ESTADO
) VALUES(
    'PRESUPUESTO_ESTADO',
    'DONE'
);

INSERT INTO G6_SC504_VT_PROYECTO.FIDE_ESTADO_TB(
    TIPO_ESTADO,
    NOMBRE_ESTADO
) VALUES(
    'PRESUPUESTO_ESTADO',
    'COMPLETED'
);

INSERT INTO G6_SC504_VT_PROYECTO.FIDE_ESTADO_TB(
    TIPO_ESTADO,
    NOMBRE_ESTADO
) VALUES(
    'PRESUPUESTO_ESTADO',
    'ARCHIVED'
);

/

ALTER TABLE G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_TB
    ADD ID_ESTADO NUMBER(
        2,
        0
    ) NOT NULL;

/

-- Creado por Jonathan Jiménez Zambrana
-- Fecha: 22-07-2024
-- Crea sequencia para la id de los estados
CREATE SEQUENCE G6_SC504_VT_PROYECTO.FIDE_ESTADO_ID_SEQ MINVALUE 1
    INCREMENT BY 1 START WITH 1 NOCACHE NOORDER NOCYCLE;

-- Creado por Jonathan Jiménez Zambrana
-- Fecha: 22-07-2024
-- Crea triger que crear el id en base a una sequence para la tabla de estados
CREATE OR REPLACE TRIGGER G6_SC504_VT_PROYECTO.FIDE_ESTADO_ADD_ID_TR BEFORE
    INSERT ON G6_SC504_VT_PROYECTO.FIDE_ESTADO_TB FOR EACH ROW
BEGIN
    IF :NEW.ID_ESTADO IS NULL THEN
        SELECT
            G6_SC504_VT_PROYECTO.FIDE_ESTADO_ID_SEQ.NEXTVAL INTO :NEW.ID_ESTADO
        FROM
            DUAL;
    END IF;
END;
/

-- Creado por Jonathan Jiménez Zambrana
-- Fecha: 22-07-2024
-- Creacion de triger para evitar el ingreso de un estado invalido a la tabla de presupuesto
CREATE OR REPLACE TRIGGER G6_SC504_VT_PROYECTO.FIDE_ESTADO_PRESUPUESTO_VALID_TR BEFORE
    INSERT OR UPDATE ON G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_TB FOR EACH ROW
DECLARE
    PRESUPUESTO_INVALID_ESTADO_EX EXCEPTION;
    EX_MSG                        VARCHAR2(200);
    ESTADO_PRESUPUESTO_FOUND      NUMBER;
BEGIN
    EX_MSG := 'Id de estado insertado no es valido para un Presupuesto';
    ESTADO_PRESUPUESTO_FOUND := 0;
    IF :NEW.ID_ESTADO IS NULL THEN
        RAISE PRESUPUESTO_INVALID_ESTADO_EX;
        DBMS_OUTPUT.PUT_LINE(EX_MSG);
    END IF;

    SELECT
        COUNT(ID_ESTADO) INTO ESTADO_PRESUPUESTO_FOUND
    FROM
        G6_SC504_VT_PROYECTO.FIDE_ESTADO_TB
    WHERE
        TIPO_ESTADO = 'PRESUPUESTO_ESTADO'
        AND ID_ESTADO = :NEW.ID_ESTADO;
    IF ESTADO_PRESUPUESTO_FOUND = 0 THEN
        RAISE PRESUPUESTO_INVALID_ESTADO_EX;
        DBMS_OUTPUT.PUT_LINE(EX_MSG);
    END IF;
EXCEPTION
    WHEN PRESUPUESTO_INVALID_ESTADO_EX THEN
        RAISE_APPLICATION_ERROR(-20002, EX_MSG);
END;
/

-- Creado por Jonathan Jiménez Zambrana
-- Fecha: 22-07-2024
-- Hace un 'select' a la tabla de FIDE_EMPLEADOS con una columna llamada FULL_NAME (nombre y apellido concatenados)
-- Realiza un select a todos los presupuesto de la tabla FIDE_PRESUPUESTO_TB con los filtros dados si hay alguna presente
CREATE OR REPLACE FUNCTION READ_ALL_PRESUPUESTOS_FN(
    P_STATUS IN NUMBER DEFAULT -1000,
    P_MIN_AMOUNT IN NUMBER DEFAULT -1000,
    P_USER_ID IN NUMBER DEFAULT -1000
) RETURN SYS_REFCURSOR AS
    DEFAULT_CONDITION VARCHAR2 (10) := '1=1';
    V_QUERY           VARCHAR2(1000) := 'SELECT * FROM G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_TB WHERE ' || DEFAULT_CONDITION;
    C_PRESUPUESTOS    SYS_REFCURSOR;
BEGIN
    IF P_STATUS != -1000 THEN
        V_QUERY := V_QUERY
                   || ' AND ID_ESTADO = :b_status';
    ELSE
        V_QUERY := V_QUERY
                   || ' AND (ID_ESTADO <> :b_status) ';
    END IF;
-- 
    IF P_USER_ID != -1000 THEN
        V_QUERY := V_QUERY
                   || ' AND ID_USUARIO = :b_user_id';
    ELSE
        V_QUERY := V_QUERY
                   || ' AND (ID_USUARIO <> :b_user_id) ';
    END IF;
-- 
    IF P_MIN_AMOUNT != 1000 THEN
        V_QUERY := V_QUERY || ' AND MONTO_TOTAL >= :p_min_amount ';
    ELSE
        V_QUERY := V_QUERY || ' AND MONTO_TOTAL > :p_min_amount ';
    END IF;
    OPEN C_PRESUPUESTOS FOR V_QUERY
        USING P_STATUS, P_USER_ID, P_MIN_AMOUNT;
    RETURN C_PRESUPUESTOS;
END;

-- Creado por Jonathan Jiménez Zambrana
-- Fecha: 22-07-2024
-- Función para leer un presupuesto específico por su ID
CREATE OR REPLACE FUNCTION READ_BY_ID_PRESUPUESTO_FN(
    ID IN NUMBER
) RETURN SYS_REFCURSOR IS
    PRESUPUESTO_RECORD_FOUND SYS_REFCURSOR;
BEGIN
    READ_BY_ID_PRESUPUESTO_SP(ID, PRESUPUESTO_RECORD_FOUND);
    RETURN PRESUPUESTO_RECORD_FOUND;
END;

/
-- Creado por Jonathan Jiménez Zambrana
-- Fecha: 22-07-2024
-- Obtiene un presupuesto específico de la tabla FIDE_PRESUPUESTO_TB
-- basado en el ID proporcionado.
CREATE OR REPLACE PROCEDURE READ_BY_ID_PRESUPUESTO_SP(
    P_ID IN NUMBER,
    PRESUPUESTO_RECORD_FOUND OUT SYS_REFCURSOR
) AS
BEGIN
    OPEN PRESUPUESTO_RECORD_FOUND FOR
        SELECT
            *
        FROM
            G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_TB
        WHERE
            ID_PRESUPUESTO = P_ID;
END;
/

-- Creado por Jonathan Jiménez Zambrana
-- Fecha: 22-07-2024
-- Función para leer todos los presupuestos asociados a un ID de usuario específico
CREATE OR REPLACE FUNCTION READ_PRESUPUESTO_BY_USER_ID_FN(
    USER_ID IN NUMBER
) RETURN SYS_REFCURSOR AS
    C_PRESUPUESTO_FOUND_FOR_USER SYS_REFCURSOR;
BEGIN
    RETURN READ_ALL_PRESUPUESTOS_FN(P_USER_ID => USER_ID);
END;
/

-- Creado por Jonathan Jiménez Zambrana
-- Fecha: 22-07-2024
-- Procedimiento para agregar un nuevo presupuesto a la tabla 
CREATE OR REPLACE PROCEDURE ADD_PRESUPUESTO_SP (
    MONTO_TOTAL_P IN NUMBER,
    USUARIO_REG_P IN VARCHAR2,
    ID_USUARIO_P IN NUMBER,
    ID_ESTADO_P IN NUMBER
) AS
    AUDIT_ERR_MESS VARCHAR2(200);
BEGIN
    INSERT INTO G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_TB(
        MONTO_TOTAL,
        USUARIO_REG,
        ACCION,
        ID_USUARIO,
        ID_ESTADO
    ) VALUES(
        MONTO_TOTAL_P,
        '',
        '',
        ID_USUARIO_P,
        ID_ESTADO_P
    );
EXCEPTION
    WHEN OTHERS THEN
 
        -- audit_err_mess := SUBSTR(SQLERRM, 1, 199);
        -- INSERT INTO AUDIT_LOG (procedure_name, error_message) VALUES (audit_proc, audit_err_mess);
        DBMS_OUTPUT.PUT_LINE('Error: '
                             || SQLERRM);
END;
/

-- Creado por Jonathan Jiménez Zambrana
-- Fecha: 22-07-2024
-- Create PRESUPUESTO sequence
CREATE SEQUENCE G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_ID_SEQ MINVALUE 1
    INCREMENT BY 1 START WITH 1 NOCACHE NOORDER NOCYCLE;

-- Creado por Jonathan Jiménez Zambrana
-- Fecha: 22-07-2024
-- Creates trigger to append id to PRESUPUESTO
CREATE OR REPLACE TRIGGER G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_ADD_ID_TR BEFORE
    INSERT ON G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_TB FOR EACH ROW
BEGIN
    IF :NEW.ID_PRESUPUESTO IS NULL THEN
        SELECT
            G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_ID_SEQ.NEXTVAL INTO :NEW.ID_PRESUPUESTO
        FROM
            DUAL;
    END IF;
END;
/

-- ********************************
-- Actualiza las columnas de la tabla FIDE_PRESUPUESTO_TB. Agrega la columna de estado.
-- ********************************
ALTER TABLE G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_DESGLOSE_TB
    ADD MONTO_ACTUAL NUMBER(
        12,
        2
    ) NOT NULL;

ALTER TABLE G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_DESGLOSE_TB RENAME COLUMN MONTO TO MONTO_TOTAL;

ALTER TABLE G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_DESGLOSE_TB MODIFY MONTO_TOTAL NUMBER(
    12,
    2
) NOT NULL;

/
-- Creado por Jonathan Jiménez Zambrana
-- Fecha: 22-07-2024
-- Crea PRESUPUESTO DESGLOSE sequence para las ids de PRESUPUESTO_DESGLOSE
CREATE SEQUENCE G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_DESGLOSE_ID_SEQ MINVALUE 1
    INCREMENT BY 1 START WITH 1 NOCACHE NOORDER NOCYCLE;

-- Creado por Jonathan Jiménez Zambrana
-- Fecha: 22-07-2024
-- Crea trigger para generar id de PRESUPUESTO_DESGLOSE an de insertar
CREATE OR REPLACE TRIGGER G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_DESGLOSE_ADD_ID_TR BEFORE
    INSERT ON G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_DESGLOSE_TB FOR EACH ROW
BEGIN
    IF :NEW.ID_PRESUPUESTO_DESGLOSE IS NULL THEN
        SELECT
            G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_DESGLOSE_ID_SEQ.NEXTVAL INTO :NEW.ID_PRESUPUESTO_DESGLOSE
        FROM
            DUAL;
    END IF;
END;
/

-- Creado por Jonathan Jiménez Zambrana
-- Fecha: 22-07-2024
-- Obtiene el desglose de un presupuesto específico.
CREATE OR REPLACE FUNCTION READ_PRESUPUESTO_DESGLOSE_BY_ID_FN (
    P_PRESUPUESTO_ID IN NUMBER
) RETURN SYS_REFCURSOR AS
    PRESUPUESTO_DESGLOSE_C SYS_REFCURSOR;
    AUDIT_ERR_MESS         VARCHAR2(200);
BEGIN
    OPEN PRESUPUESTO_DESGLOSE_C FOR
        SELECT
            *
        FROM
            G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_DESGLOSE_TB D
        WHERE
            D.ID_PRESUPUESTO = P_PRESUPUESTO_ID;
    RETURN PRESUPUESTO_DESGLOSE_C;
EXCEPTION
    WHEN OTHERS THEN
 
        -- audit_err_mess := SUBSTR(SQLERRM, 1, 199);
        -- INSERT INTO AUDIT_LOG (procedure_name, error_message) VALUES (audit_proc, audit_err_mess);
        DBMS_OUTPUT.PUT_LINE('Error: '
                             || SQLERRM);
END;
/



-- Creado por Jonathan Jiménez Zambrana
-- Fecha: 22-07-2024
-- Obtiene todos los presupuestos de la tabla FIDE_PRESUPUESTO_TB, aplicando los filtros proporcionados si existen. 
-- La función construye dinámicamente una sentencia SQL para seleccionar los registros que cumplan con los criterios.
CREATE OR REPLACE PROCEDURE ADD_PRESUPUESTO_DESGLOSE_SP(
    P_PRESUPUESTO_ID IN NUMBER,
    P_MONTO_TOTAL IN NUMBER,
    P_MONTO_ACTUAL IN NUMBER,
    P_NOMBRE IN VARCHAR2,
    ID_PRESUPUESTO IN NUMBER
) AS
    AUDIT_ERR_MESS VARCHAR2(200);
BEGIN
    INSERT INTO G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_DESGLOSE_TB(
        MONTO_TOTAL,
        MONTO_ACTUAL,
        NOMBRE,
        ID_PRESUPUESTO
    ) VALUES(
        P_MONTO_TOTAL,
        P_MONTO_ACTUAL,
        P_NOMBRE,
        ID_PRESUPUESTO
    );
EXCEPTION
    WHEN OTHERS THEN
 
        -- audit_err_mess := SUBSTR(SQLERRM, 1, 199);
        -- INSERT INTO AUDIT_LOG (procedure_name, error_message) VALUES (audit_proc, audit_err_mess);
        DBMS_OUTPUT.PUT_LINE('Error: '
                             || SQLERRM);
END;
/

-- crear un associative array de type NUMBER en un paquete de utilidades
CREATE OR REPLACE PACKAGE WALLET_UTILS IS
    TYPE VALUES_FOUND_ARR_TYPE IS
        TABLE OF NUMBER INDEX BY BINARY_INTEGER;
    VALUES_FOUND_ARR VALUES_FOUND_ARR_TYPE;
END WALLET_UTILS;
/

-- Creado por Jonathan Jiménez Zambrana
-- Fecha: 24-07-2024
-- Deveuelve un aasociate array dado un string y un seperador.
CREATE OR REPLACE FUNCTION GET_ARRAY_FROM_STR(
    P_IDS_STR IN VARCHAR2,
    P_COMMA IN VARCHAR2
) RETURN WALLET_UTILS.VALUES_FOUND_ARR_TYPE AS
    V_IDS_STR        VARCHAR2(200) := P_IDS_STR;
    V_COMMA          VARCHAR2(1) := P_COMMA;
    V_IDX_END        NUMBER;
    V_IDX_START      NUMBER := 1;
    V_IDX            NUMBER := 0;
    VALUES_FOUND_ARR WALLET_UTILS.VALUES_FOUND_ARR_TYPE;
BEGIN
    LOOP
        V_IDX_END := INSTR(V_IDS_STR, V_COMMA, V_IDX_START);
        IF V_IDX_END = 0 THEN
            VALUES_FOUND_ARR(TO_CHAR(V_IDX)) := TO_NUMBER(SUBSTR(V_IDS_STR, V_IDX_START));
            -- DBMS_OUTPUT.PUT_LINE(SUBSTR(v_ids_str, v_idx_start));
            EXIT;
        ELSE
            VALUES_FOUND_ARR(TO_CHAR(V_IDX)) := TO_NUMBER(SUBSTR(V_IDS_STR, V_IDX_START, (V_IDX_END-V_IDX_START)));
            -- DBMS_OUTPUT.PUT_LINE(SUBSTR(v_ids_str, v_idx_start, (v_idx_end-v_idx_start)));
            V_IDX_START := V_IDX_END+1;
        END IF;

        V_IDX := V_IDX +1;
    END LOOP;

    RETURN VALUES_FOUND_ARR;
END;
/

-- Creado por Jonathan Jiménez Zambrana
-- Fecha: 22-07-2024
-- Obtiene una lista de presupuestos basados en una cadena de IDs separados por comas.
-- La función divide la cadena de IDs en un arreglo y realiza un SELECT en la tabla FIDE_PRESUPUESTO_TB
-- para obtener los presupuestos con los IDs correspondientes.
CREATE OR REPLACE FUNCTION READ_BY_GIVEN_IDS_PRESUPUESTOS_FN(
    IDS IN VARCHAR2
) RETURN SYS_REFCURSOR AS
    V_SEPARATOR          VARCHAR2(2) := ',';
    VALUES_FOUND_ARR     WALLET_UTILS.VALUES_FOUND_ARR_TYPE;
    C_PRESUPUESTOS_FOUND SYS_REFCURSOR;
BEGIN
    VALUES_FOUND_ARR := GET_ARRAY_FROM_STR(IDS, V_SEPARATOR);
    OPEN C_PRESUPUESTOS_FOUND FOR
        SELECT
            *
        FROM
            G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_TB
        WHERE
            ID_PRESUPUESTO IN (
                SELECT
                    *
                FROM
                    TABLE(VALUES_FOUND_ARR)                                        
            );
    RETURN C_PRESUPUESTOS_FOUND;
END;
/