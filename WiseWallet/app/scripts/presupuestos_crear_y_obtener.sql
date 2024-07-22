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
INSERT INTO G6_SC504_VT_PROYECTO.FIDE_ESTADO_TB(TIPO_ESTADO, NOMBRE_ESTADO) VALUES('PRESUPUESTO_ESTADO', 'OPEN');
INSERT INTO G6_SC504_VT_PROYECTO.FIDE_ESTADO_TB(TIPO_ESTADO, NOMBRE_ESTADO) VALUES('PRESUPUESTO_ESTADO', 'PROFRESS');
INSERT INTO G6_SC504_VT_PROYECTO.FIDE_ESTADO_TB(TIPO_ESTADO, NOMBRE_ESTADO) VALUES('PRESUPUESTO_ESTADO', 'DONE');
INSERT INTO G6_SC504_VT_PROYECTO.FIDE_ESTADO_TB(TIPO_ESTADO, NOMBRE_ESTADO) VALUES('PRESUPUESTO_ESTADO', 'COMPLETED');
INSERT INTO G6_SC504_VT_PROYECTO.FIDE_ESTADO_TB(TIPO_ESTADO, NOMBRE_ESTADO) VALUES('PRESUPUESTO_ESTADO', 'ARCHIVED');
/
ALTER TABLE G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_TB ADD ID_ESTADO NUMBER(2,0) NOT NULL;
/
-- Crea sequencia para la id de los estados
CREATE SEQUENCE G6_SC504_VT_PROYECTO.FIDE_ESTADO_ID_SEQ MINVALUE 1
    INCREMENT BY 1 START WITH 1 NOCACHE NOORDER NOCYCLE;
-- Crea triger que crear el id en base a una sequence para la tabla de estados
CREATE OR REPLACE TRIGGER G6_SC504_VT_PROYECTO.FIDE_ESTADO_ADD_ID_TR
    BEFORE INSERT ON G6_SC504_VT_PROYECTO.FIDE_ESTADO_TB
    FOR EACH ROW
BEGIN
    IF :NEW.ID_ESTADO IS NULL THEN
        SELECT G6_SC504_VT_PROYECTO.FIDE_ESTADO_ID_SEQ.nextval
        INTO :NEW.ID_ESTADO
        FROM DUAL;
    END IF;
END;
/
-- Creacion de triger para evitar el ingreso de un estado invalido a la tabla de presupuesto
CREATE OR REPLACE TRIGGER G6_SC504_VT_PROYECTO.FIDE_ESTADO_PRESUPUESTO_VALID_TR
    BEFORE INSERT OR UPDATE ON G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_TB 
    FOR EACH ROW
DECLARE
    presupuesto_invalid_estado_ex EXCEPTION;
    ex_msg VARCHAR2(200);
    estado_presupuesto_found NUMBER;
BEGIN
    ex_msg := 'Id de estado insertado no es valido para un Presupuesto';
    estado_presupuesto_found := 0;
    IF :NEW.ID_ESTADO IS NULL THEN
        RAISE presupuesto_invalid_estado_ex;
        DBMS_OUTPUT.PUT_LINE(ex_msg);
    END IF;
    SELECT COUNT(ID_ESTADO) 
    INTO estado_presupuesto_found 
    FROM G6_SC504_VT_PROYECTO.FIDE_ESTADO_TB
    WHERE TIPO_ESTADO = 'PRESUPUESTO_ESTADO' AND ID_ESTADO = :NEW.ID_ESTADO;
    IF estado_presupuesto_found = 0 THEN
        RAISE presupuesto_invalid_estado_ex;
        DBMS_OUTPUT.PUT_LINE(ex_msg); 
    END IF;
EXCEPTION
    WHEN presupuesto_invalid_estado_ex THEN
        RAISE_APPLICATION_ERROR(-20002, ex_msg);
END;


/
-- ********************************
-- DEFINITION READ ALL PRESUPUESTO FUNCTION
-- ********************************
CREATE OR REPLACE FUNCTION READ_ALL_PRESUPUESTOS_FN RETURN SYS_REFCURSOR
AS
    PRESUPUESTOS_RC SYS_REFCURSOR;
BEGIN
    OPEN PRESUPUESTOS_RC FOR
        SELECT
            *
        FROM
            G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_TB;
    RETURN PRESUPUESTOS_RC;
END;
/


-- ********************************
-- DEFINITION READ BY ID PRESUPUESTO FUNCTION
-- ********************************
CREATE OR REPLACE FUNCTION READ_BY_ID_PRESUPUESTO_FN(
    ID IN NUMBER
) RETURN SYS_REFCURSOR IS
    presupuesto_record_found SYS_REFCURSOR;
BEGIN
    READ_BY_ID_PRESUPUESTO_SP(ID, presupuesto_record_found);
    RETURN presupuesto_record_found;
END;
/


-- ********************************
-- DEFINITION READ BY ID PRESUPUESTO FUNCTION
-- ********************************
CREATE OR REPLACE PROCEDURE READ_BY_ID_PRESUPUESTO_SP(
    p_id IN NUMBER, presupuesto_record_found OUT SYS_REFCURSOR
) AS
BEGIN
    OPEN presupuesto_record_found FOR SELECT * FROM G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_TB
        WHERE ID_PRESUPUESTO = p_id;
END;
/


-- ********************************
-- READY PRESUPUESTO BY USER ID
-- ********************************
CREATE OR REPLACE FUNCTION READ_PRESUPUESTO_BY_USER_ID_FN(USER_ID IN NUMBER)
RETURN SYS_REFCURSOR
AS
    c_presupuesto_found_for_user SYS_REFCURSOR;
BEGIN
    OPEN c_presupuesto_found_for_user FOR 
        SELECT * FROM G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_TB p
        WHERE p.ID_USUARIO = USER_ID;
END;
/


-- ********************************
-- DEFINITION CREATE PRESUPUESTO PROCEDURE
-- ********************************
CREATE OR REPLACE PROCEDURE ADD_PRESUPUESTO_SP (MONTO_TOTAL_P IN NUMBER,
USUARIO_REG_P IN VARCHAR2,
ID_USUARIO_P IN NUMBER,
ID_ESTADO_P IN NUMBER)
AS
    audit_err_mess VARCHAR2(200);
BEGIN
    INSERT INTO G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_TB(MONTO_TOTAL, USUARIO_REG, ACCION, ID_USUARIO, ID_ESTADO) 
    VALUES( MONTO_TOTAL_P, '', '', ID_USUARIO_P, ID_ESTADO_P);
EXCEPTION
    WHEN OTHERS THEN
        -- audit_err_mess := SUBSTR(SQLERRM, 1, 199);
        -- INSERT INTO AUDIT_LOG (procedure_name, error_message) VALUES (audit_proc, audit_err_mess); 
        DBMS_OUTPUT.PUT_LINE('Error: ' || SQLERRM);
END;
/
-- Create PRESUPUESTO sequence
CREATE SEQUENCE G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_ID_SEQ MINVALUE 1
    INCREMENT BY 1 START WITH 1 NOCACHE NOORDER NOCYCLE;
-- Creates trigger to append id to PRESUPUESTO
CREATE OR REPLACE TRIGGER G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_ADD_ID_TR
    BEFORE INSERT ON G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_TB
    FOR EACH ROW
BEGIN
    IF :NEW.ID_PRESUPUESTO IS NULL THEN
        SELECT G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_ID_SEQ.nextval
        INTO :NEW.ID_PRESUPUESTO
        FROM DUAL;
    END IF;
END;
/


-- ********************************
-- DEFINITION READ ALL PRESUPUESTO_DESGLOSE FUNCTION
-- ********************************
ALTER TABLE G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_DESGLOSE_TB ADD MONTO_ACTUAL NUMBER(12,2) NOT NULL;
ALTER TABLE G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_DESGLOSE_TB RENAME COLUMN MONTO TO MONTO_TOTAL;
ALTER TABLE G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_DESGLOSE_TB MODIFY MONTO_TOTAL NUMBER(12,2) NOT NULL;
/
-- Crea PRESUPUESTO DESGLOSE sequence para las ids de PRESUPUESTO_DESGLOSE
CREATE SEQUENCE G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_DESGLOSE_ID_SEQ MINVALUE 1
    INCREMENT BY 1 START WITH 1 NOCACHE NOORDER NOCYCLE;
-- Crea trigger para generar id de PRESUPUESTO_DESGLOSE an de insertar
CREATE OR REPLACE TRIGGER G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_DESGLOSE_ADD_ID_TR
    BEFORE INSERT ON G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_DESGLOSE_TB
    FOR EACH ROW
BEGIN
    IF :NEW.ID_PRESUPUESTO_DESGLOSE IS NULL THEN
        SELECT G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_DESGLOSE_ID_SEQ.nextval
        INTO :NEW.ID_PRESUPUESTO_DESGLOSE
        FROM DUAL;
    END IF;
END;
/
-- ********************************
-- DEFINITION READ BY ID PRESUPUESTO DESGLOSE PROCEDURE
-- ********************************
CREATE OR REPLACE FUNCTION READ_PRESUPUESTO_DESGLOSE_BY_ID_FN (P_PRESUPUESTO_ID IN NUMBER)
RETURN SYS_REFCURSOR
AS
    presupuesto_desglose_c SYS_REFCURSOR;
    audit_err_mess VARCHAR2(200);
BEGIN
    OPEN presupuesto_desglose_c FOR 
        SELECT * FROM G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_DESGLOSE_TB d
        WHERE d.ID_PRESUPUESTO = P_PRESUPUESTO_ID;
    RETURN presupuesto_desglose_c;
EXCEPTION
    WHEN OTHERS THEN
        -- audit_err_mess := SUBSTR(SQLERRM, 1, 199);
        -- INSERT INTO AUDIT_LOG (procedure_name, error_message) VALUES (audit_proc, audit_err_mess); 
        DBMS_OUTPUT.PUT_LINE('Error: ' || SQLERRM);
END;
/

-- ********************************
-- DEFINITION ADD PRESUPUESTO DESGLOSE PROCEDURE
-- ********************************
CREATE OR REPLACE PROCEDURE ADD_PRESUPUESTO_DESGLOSE_SP(P_PRESUPUESTO_ID IN NUMBER, p_monto_total IN NUMBER, p_monto_actual IN NUMBER, p_nombre in VARCHAR2, ID_PRESUPUESTO IN NUMBER)
AS
    audit_err_mess VARCHAR2(200);
BEGIN
    INSERT INTO G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_DESGLOSE_TB(MONTO_TOTAL, MONTO_ACTUAL, NOMBRE, ID_PRESUPUESTO) 
    VALUES(p_monto_total, p_monto_actual, p_nombre, ID_PRESUPUESTO);
EXCEPTION
    WHEN OTHERS THEN
        -- audit_err_mess := SUBSTR(SQLERRM, 1, 199);
        -- INSERT INTO AUDIT_LOG (procedure_name, error_message) VALUES (audit_proc, audit_err_mess); 
        DBMS_OUTPUT.PUT_LINE('Error: ' || SQLERRM);
END;


/
-- crear un associative array de type NUMBER en un paquete
CREATE OR REPLACE PACKAGE wallet_utils IS
    TYPE values_found_arr_type IS TABLE OF NUMBER INDEX BY BINARY_INTEGER;
    values_found_arr values_found_arr_type;
END wallet_utils;
/
-- Deveuelve un aasociate array dado un string y un seperador.
CREATE OR REPLACE FUNCTION GET_ARRAY_FROM_STR(p_ids_str IN VARCHAR2, p_comma IN VARCHAR2)
RETURN wallet_utils.values_found_arr_type
AS
    v_ids_str VARCHAR2(200) := p_ids_str; 
    v_comma VARCHAR2(1) := p_comma;
    v_idx_end NUMBER; 
    v_idx_start NUMBER := 1; 
    v_idx NUMBER := 0;
    values_found_arr wallet_utils.values_found_arr_type;
BEGIN
    LOOP
        v_idx_end := INSTR(v_ids_str, v_comma, v_idx_start);
        IF v_idx_end = 0 THEN
            values_found_arr(TO_CHAR(v_idx)) := TO_NUMBER(SUBSTR(v_ids_str, v_idx_start)); 
            -- DBMS_OUTPUT.PUT_LINE(SUBSTR(v_ids_str, v_idx_start)); 
            EXIT; 
        ELSE
            values_found_arr(TO_CHAR(v_idx)) := TO_NUMBER(SUBSTR(v_ids_str, v_idx_start, (v_idx_end-v_idx_start))); 
            -- DBMS_OUTPUT.PUT_LINE(SUBSTR(v_ids_str, v_idx_start, (v_idx_end-v_idx_start))); 
            v_idx_start := v_idx_end+1;
        END IF;
        v_idx := v_idx +1;
    END LOOP;
    RETURN values_found_arr;
END;
/

-- ********************************
-- DEFINITION READ ALL PRESUPUESTOS DANDON UN STR DE IDs
-- ********************************
CREATE OR REPLACE FUNCTION READ_BY_GIVEN_IDS_PRESUPUESTOS_FN(IDS IN VARCHAR2)
RETURN SYS_REFCURSOR AS
    v_separator VARCHAR2(2) := ',';
    values_found_arr wallet_utils.values_found_arr_type;
    c_presupuestos_found SYS_REFCURSOR;
BEGIN
    values_found_arr := GET_ARRAY_FROM_STR(IDS, v_separator);
    OPEN c_presupuestos_found FOR
        SELECT * FROM G6_SC504_VT_PROYECTO.FIDE_PRESUPUESTO_TB 
        WHERE ID_PRESUPUESTO IN (SELECT * FROM table(values_found_arr));
    RETURN c_presupuestos_found;
END;
/