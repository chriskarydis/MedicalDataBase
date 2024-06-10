CREATE TABLE address (
    addressid   VARCHAR2(30 CHAR) NOT NULL,
    street      VARCHAR2(255) NOT NULL,
    city        VARCHAR2(60) NOT NULL,
    region      VARCHAR2(60) NOT NULL,
    country     VARCHAR2(60) NOT NULL,
    postal_code VARCHAR2(10) NOT NULL
);

ALTER TABLE address ADD CONSTRAINT qddressid_pk PRIMARY KEY ( addressid );

CREATE TABLE checkup (
    visitid                  VARCHAR2(30 CHAR) NOT NULL,
    weight                   NUMBER NOT NULL,
    height                   NUMBER NOT NULL,
    systolic_blood_pressure  NUMBER NOT NULL,
    diastolic_blood_pressure NUMBER NOT NULL
);

ALTER TABLE checkup ADD CONSTRAINT checkup_pk PRIMARY KEY ( visitid );

ALTER TABLE checkup
    ADD CONSTRAINT chk_patient_systolic_blood_pressure CHECK (systolic_blood_pressure BETWEEN 50 AND 250);

ALTER TABLE checkup    
    ADD CONSTRAINT chk_patient_diastolic_blood_pressure CHECK (diastolic_blood_pressure BETWEEN 30 AND 150);

CREATE TABLE doctor (
    doctorid    VARCHAR2(30 CHAR) NOT NULL,
    firstname   VARCHAR2(30 CHAR) NOT NULL,
    lastname    VARCHAR2(30 CHAR) NOT NULL,
    telephone   VARCHAR2(14 CHAR) NOT NULL,
    addressid   VARCHAR2(30 CHAR) NOT NULL,
    specialty   VARCHAR2(30 CHAR) NOT NULL,
    email       VARCHAR2(50 CHAR),
    dateofbirth DATE,
    sex         VARCHAR2(30 CHAR)
);

ALTER TABLE doctor ADD CONSTRAINT doctor_pk PRIMARY KEY ( doctorid );

CREATE TABLE hospital_clinic (
    hospitalclinicid VARCHAR2(30 CHAR) NOT NULL,
    hosp_name        VARCHAR2(60 CHAR) NOT NULL,
    addressid        VARCHAR2(30 CHAR) NOT NULL,
    telephone        VARCHAR2(14 CHAR) NOT NULL,
    fax              VARCHAR2(30 CHAR) NOT NULL,
    email            VARCHAR2(50 CHAR) NOT NULL
);

ALTER TABLE hospital_clinic ADD CONSTRAINT hospital_clinic_pk PRIMARY KEY ( hospitalclinicid );

CREATE TABLE hospitalized (
    hospitalizedid   INTEGER NOT NULL,
    amka             VARCHAR2(11 CHAR) NOT NULL,
    hospitalclinicid VARCHAR2(255 CHAR) NOT NULL,
    entrydate        DATE NOT NULL,
    exitdate         DATE
);

ALTER TABLE hospitalized
    ADD CONSTRAINT hospitalized_pk PRIMARY KEY ( hospitalizedid,
                                                 amka,
                                                 hospitalclinicid );

CREATE TABLE includes (
    includesid     INTEGER NOT NULL,
    prescriptionid VARCHAR2(30 CHAR) NOT NULL,
    medicineid     VARCHAR2(30 CHAR) NOT NULL
);

ALTER TABLE includes
    ADD CONSTRAINT includes_pk PRIMARY KEY ( includesid,
                                             prescriptionid,
                                             medicineid );

CREATE TABLE inspectionvisit (
    visitid      VARCHAR2(30 CHAR) NOT NULL,
    statebetween VARCHAR2(255 CHAR) NOT NULL
);

ALTER TABLE inspectionvisit ADD CONSTRAINT inspectionvisit_pk PRIMARY KEY ( visitid );

CREATE TABLE medicine (
    medicineid         VARCHAR2(30 CHAR) NOT NULL,
    med_name           VARCHAR2(30 CHAR) NOT NULL,
    med_type           VARCHAR2(30 CHAR) NOT NULL,
    expirationdate     DATE NOT NULL,
    activeingredients  VARCHAR2(50 CHAR) NOT NULL,
    med_usage          VARCHAR2(255 CHAR) NOT NULL,
    sideeffects        VARCHAR2(255 CHAR) NOT NULL,
    indications        VARCHAR2(255 CHAR) NOT NULL,
    prescriptionneeded VARCHAR2(10 CHAR) NOT NULL
);

ALTER TABLE medicine ADD CONSTRAINT medicine_pk PRIMARY KEY ( medicineid );

CREATE TABLE newissue (
    visitid          VARCHAR2(30 CHAR) NOT NULL,
    initialdiagnosis VARCHAR2(255 CHAR) NOT NULL
);

ALTER TABLE newissue ADD CONSTRAINT newissue_pk PRIMARY KEY ( visitid );

CREATE TABLE patient (
    amka          VARCHAR2(11 CHAR) NOT NULL,
    firstname     VARCHAR2(30 CHAR) NOT NULL,
    lastname      VARCHAR2(30 CHAR) NOT NULL,
    fathername    VARCHAR2(30 CHAR) NOT NULL,
    sex           VARCHAR2(20 CHAR) NOT NULL,
    dateofbirth   DATE NOT NULL,
    telephone     VARCHAR2(14 CHAR) NOT NULL,
    email         VARCHAR2(50 CHAR),
    addressid     VARCHAR2(30 CHAR) NOT NULL,
    insurancename VARCHAR2(40 CHAR) NOT NULL,
    insuranceid   VARCHAR2(30 CHAR) NOT NULL,
    weight        NUMBER,
    height        NUMBER,
    bloodtype     VARCHAR2(20 CHAR),
    familystatus  VARCHAR2(30 CHAR),
    insuredby     VARCHAR2(11 CHAR)
);

ALTER TABLE patient ADD CONSTRAINT patient_pk PRIMARY KEY ( amka );

ALTER TABLE patient
    ADD CONSTRAINT ch_inh_patient_bld CHECK ( bloodtype IN ( 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-' ) );

ALTER TABLE patient
    ADD CONSTRAINT ch_inh_patient_fam CHECK ( familystatus IN ( 'Divorced', 'Married', 'Single', 'Widowed', 'Separated' ) );

CREATE TABLE prescription (
    prescriptionid VARCHAR2(30 CHAR) NOT NULL,
    presc_type     VARCHAR2(40 CHAR) NOT NULL,
    startdate      DATE NOT NULL,
    expirationdate DATE NOT NULL,
    comments       VARCHAR2(255 CHAR),
    eligibility    VARCHAR2(10 CHAR) NOT NULL,
    dosage         VARCHAR2(255 CHAR) NOT NULL,
    is_renewable   VARCHAR2(10 CHAR) NOT NULL,
    doctorid       VARCHAR2(30 CHAR) NOT NULL,
    amka           VARCHAR2(11 CHAR) NOT NULL,
    visitid        VARCHAR2(15) NOT NULL
);

CREATE UNIQUE INDEX prescription__idx ON
    prescription (
        visitid
    ASC );

ALTER TABLE prescription ADD CONSTRAINT prescription_pk PRIMARY KEY ( prescriptionid );

ALTER TABLE prescription
    ADD CONSTRAINT ch_inh_prescription_elig CHECK ( eligibility IN ( 'Yes', 'No' ) );

ALTER TABLE prescription
    ADD CONSTRAINT ch_inh_prescription_renew CHECK ( is_renewable IN ( 'Yes', 'No' ) );

CREATE TABLE renewable (
    prescriptionid VARCHAR2(30 CHAR) NOT NULL,
    renewabletimes INTEGER NOT NULL
);

ALTER TABLE renewable ADD CONSTRAINT renewable_pk PRIMARY KEY ( prescriptionid );

CREATE TABLE supervise (
    recordid  INTEGER NOT NULL,
    amka      VARCHAR2(11 CHAR) NOT NULL,
    doctorid  VARCHAR2(30 CHAR) NOT NULL,
    startdate DATE NOT NULL,
    enddate   DATE,
    comments  VARCHAR2(255 CHAR)
);

ALTER TABLE supervise
    ADD CONSTRAINT supervise_pk PRIMARY KEY ( recordid,
                                              amka,
                                              doctorid );

CREATE TABLE visit (
    visitid          VARCHAR2(15) NOT NULL,
    visit_date           DATE NOT NULL,
    visit_type       VARCHAR2(15 CHAR) NOT NULL,
    amka             VARCHAR2(11 CHAR) NOT NULL,
    doctorid         VARCHAR2(30 CHAR) NOT NULL,
    hospitalclinicid VARCHAR2(30 CHAR) NOT NULL
);

ALTER TABLE visit
    ADD CONSTRAINT ch_inh_visit CHECK ( visit_type IN ( 'CheckUp', 'InspectionVisit', 'NewIssue' ) );

ALTER TABLE visit ADD CONSTRAINT visit_pk PRIMARY KEY ( visitid );

CREATE TABLE workson (
    worksonid        INTEGER NOT NULL,
    doctorid         VARCHAR2(30 CHAR) NOT NULL,
    hospitalclinicid VARCHAR2(30 CHAR) NOT NULL
);

ALTER TABLE workson
    ADD CONSTRAINT workson_pk PRIMARY KEY ( worksonid,
                                            doctorid,
                                            hospitalclinicid );

ALTER TABLE hospital_clinic
    ADD CONSTRAINT hospital_clinic_ibfk_1 FOREIGN KEY (addressid)
        REFERENCES address (addressid);

ALTER TABLE doctor
    ADD CONSTRAINT doctor_ibfk_1 FOREIGN KEY (addressid)
        REFERENCES address (addressid);

ALTER TABLE checkup
    ADD CONSTRAINT checkup_visit_fk FOREIGN KEY ( visitid )
        REFERENCES visit ( visitid )
            ON DELETE CASCADE;

ALTER TABLE hospitalized
    ADD CONSTRAINT hospitalized_hospital_fk FOREIGN KEY ( hospitalclinicid )
        REFERENCES hospital_clinic ( hospitalclinicid );

ALTER TABLE hospitalized
    ADD CONSTRAINT hospitalized_patient_fk FOREIGN KEY ( amka )
        REFERENCES patient ( amka );

ALTER TABLE includes
    ADD CONSTRAINT includes_medicine_fk FOREIGN KEY ( medicineid )
        REFERENCES medicine ( medicineid );

ALTER TABLE includes
    ADD CONSTRAINT includes_prescription_fk FOREIGN KEY ( prescriptionid )
        REFERENCES prescription ( prescriptionid );

ALTER TABLE inspectionvisit
    ADD CONSTRAINT inspectionvisit_visit_fk FOREIGN KEY ( visitid )
        REFERENCES visit ( visitid )
            ON DELETE CASCADE;

ALTER TABLE newissue
    ADD CONSTRAINT newissue_visit_fk FOREIGN KEY ( visitid )
        REFERENCES visit ( visitid )
            ON DELETE CASCADE;

ALTER TABLE patient
    ADD CONSTRAINT patient_patient_fk FOREIGN KEY ( insuredby )
        REFERENCES patient ( amka );

ALTER TABLE patient
    ADD CONSTRAINT patient_ibfk_2 FOREIGN KEY (addressid)
        REFERENCES address (addressid);

ALTER TABLE prescription
    ADD CONSTRAINT prescription_doctor_fk FOREIGN KEY ( doctorid )
        REFERENCES doctor ( doctorid );

ALTER TABLE prescription
    ADD CONSTRAINT prescription_patient_fk FOREIGN KEY ( amka )
        REFERENCES patient ( amka );

ALTER TABLE prescription
    ADD CONSTRAINT prescription_visit_fk FOREIGN KEY ( visitid )
        REFERENCES visit ( visitid );

ALTER TABLE renewable
    ADD CONSTRAINT renewable_prescription_fk FOREIGN KEY ( prescriptionid )
        REFERENCES prescription ( prescriptionid )
            ON DELETE CASCADE;

ALTER TABLE supervise
    ADD CONSTRAINT supervise_doctor_fk FOREIGN KEY ( doctorid )
        REFERENCES doctor ( doctorid );

ALTER TABLE supervise
    ADD CONSTRAINT supervise_patient_fk FOREIGN KEY ( amka )
        REFERENCES patient ( amka );

ALTER TABLE visit
    ADD CONSTRAINT visit_doctor_fk FOREIGN KEY ( doctorid )
        REFERENCES doctor ( doctorid );

ALTER TABLE visit
    ADD CONSTRAINT visit_hospital_clinic_fk FOREIGN KEY ( hospitalclinicid )
        REFERENCES hospital_clinic ( hospitalclinicid );

ALTER TABLE visit
    ADD CONSTRAINT visit_patient_fk FOREIGN KEY ( amka )
        REFERENCES patient ( amka );

ALTER TABLE workson
    ADD CONSTRAINT workson_doctor_fk FOREIGN KEY ( doctorid )
        REFERENCES doctor ( doctorid );

ALTER TABLE workson
    ADD CONSTRAINT workson_hospital_clinic_fk FOREIGN KEY ( hospitalclinicid )
        REFERENCES hospital_clinic ( hospitalclinicid );

-- Additional constraints for logical completeness and data integrity

-- Ensure prescription eligibility is between 0 and 1
ALTER TABLE prescription
    ADD CONSTRAINT chk_prescription_eligibility CHECK (eligibility IN ('Yes', 'No'));

-- Ensure prescription needed is between 0 and 1
ALTER TABLE medicine
    ADD CONSTRAINT chk_medicine_prescription_needed CHECK (prescriptionneeded IN ('Yes', 'No'));

-- Ensure gender values are valid
ALTER TABLE doctor
    ADD CONSTRAINT chk_doctor_sex CHECK (sex IN ('Male', 'Female', 'Other'));
ALTER TABLE patient
    ADD CONSTRAINT chk_patient_sex CHECK (sex IN ('Male', 'Female', 'Other'));

-- Ensure insurance data consistency
ALTER TABLE patient
    ADD CONSTRAINT chk_patient_insurance CHECK (insurancename IS NOT NULL AND insuranceid IS NOT NULL);

-- Ensure visit type values are valid
ALTER TABLE visit
    ADD CONSTRAINT chk_visit_type CHECK (visit_type IN ('CheckUp', 'InspectionVisit', 'NewIssue'));

ALTER TABLE visit
    ADD CONSTRAINT unique_visit_subtype UNIQUE (visitid, visit_type);

-- Ensure entrydate is before exitdate in hospitalized
ALTER TABLE hospitalized
    ADD CONSTRAINT chk_hospitalized_dates CHECK (exitdate IS NULL OR entrydate <= exitdate);

-- Ensure prescription expirationdate is after startdate
ALTER TABLE prescription
    ADD CONSTRAINT chk_prescription_dates CHECK (startdate <= expirationdate);

CREATE OR REPLACE TRIGGER fkntm_includes BEFORE
    UPDATE OF prescriptionid ON includes
BEGIN
    raise_application_error(-20225, 'Non Transferable FK constraint  on table Includes is violated');
END;
/

CREATE OR REPLACE TRIGGER fkntm_prescription BEFORE
    UPDATE OF amka, visitid ON prescription
BEGIN
    raise_application_error(-20225, 'Non Transferable FK constraint  on table Prescription is violated');
END;
/

CREATE OR REPLACE TRIGGER fkntm_visit BEFORE
    UPDATE OF doctorid, amka, hospitalclinicid ON visit
BEGIN
    raise_application_error(-20225, 'Non Transferable FK constraint  on table Visit is violated');
END;
/

CREATE OR REPLACE TRIGGER arc_visittype_newissue BEFORE
    INSERT OR UPDATE OF visitid ON newissue
    FOR EACH ROW
DECLARE
    d VARCHAR2(15);
BEGIN
    SELECT
        a.visit_type
    INTO d
    FROM
        visit a
    WHERE
        a.visitid = :new.visitid;

    IF ( d IS NULL OR d <> 'NewIssue' ) THEN
        raise_application_error(-20223, 'FK NewIssue_Visit_FK in Table NewIssue violates Arc constraint on Table Visit - discriminator column VisitType doesn''t have value ''NewIssue'''
        );
    END IF;

EXCEPTION
    WHEN no_data_found THEN
        NULL;
    WHEN OTHERS THEN
        RAISE;
END;
/

CREATE OR REPLACE TRIGGER arc_visittype_inspectionvisit BEFORE
    INSERT OR UPDATE OF visitid ON inspectionvisit
    FOR EACH ROW
DECLARE
    d VARCHAR2(15);
BEGIN
    SELECT
        a.visit_type
    INTO d
    FROM
        visit a
    WHERE
        a.visitid = :new.visitid;

    IF ( d IS NULL OR d <> 'InspectionVisit' ) THEN
        raise_application_error(-20223, 'FK InspectionVisit_Visit_FK in Table InspectionVisit violates Arc constraint on Table Visit - discriminator column VisitType doesn''t have value ''InspectionVisit'''
        );
    END IF;

EXCEPTION
    WHEN no_data_found THEN
        NULL;
    WHEN OTHERS THEN
        RAISE;
END;
/

CREATE OR REPLACE TRIGGER arc_visittype_checkup BEFORE
    INSERT OR UPDATE OF visitid ON checkup
    FOR EACH ROW
DECLARE
    d VARCHAR2(15);
BEGIN
    SELECT
        a.visit_type
    INTO d
    FROM
        visit a
    WHERE
        a.visitid = :new.visitid;

    IF ( d IS NULL OR d <> 'CheckUp' ) THEN
        raise_application_error(-20223, 'FK CheckUp_Visit_FK in Table CheckUp violates Arc constraint on Table Visit - discriminator column VisitType doesn''t have value ''CheckUp'''
        );
    END IF;

EXCEPTION
    WHEN no_data_found THEN
        NULL;
    WHEN OTHERS THEN
        RAISE;
END;
/

-- Additional triggers for logical completeness and data integrity

CREATE OR REPLACE TRIGGER ensure_one_subtype_per_visit
AFTER INSERT ON visit
FOR EACH ROW
DECLARE
    checkup_count INTEGER;
    inspectionvisit_count INTEGER;
    newissue_count INTEGER;
BEGIN
    SELECT COUNT(*) INTO checkup_count FROM checkup WHERE visitid = :NEW.visitid;
    SELECT COUNT(*) INTO inspectionvisit_count FROM inspectionvisit WHERE visitid = :NEW.visitid;
    SELECT COUNT(*) INTO newissue_count FROM newissue WHERE visitid = :NEW.visitid;

    IF (checkup_count + inspectionvisit_count + newissue_count) > 1 THEN
        raise_application_error(-20224, 'A visitid can only belong to one subtype table');
    ELSIF (checkup_count + inspectionvisit_count + newissue_count) = 0 THEN
        -- Log a warning or take other appropriate actions instead of raising an error
        DBMS_OUTPUT.PUT_LINE('Warning: No corresponding entries found in any subtype table for visitid ' || :NEW.visitid);
    END IF;
END;
/

-- Locking mechanism in arc_visit_subtype trigger to handle concurrency
CREATE OR REPLACE TRIGGER arc_visit_subtype
BEFORE INSERT OR UPDATE ON visit
FOR EACH ROW
DECLARE
    checkup_count INTEGER;
    inspectionvisit_count INTEGER;
    newissue_count INTEGER;
BEGIN
    -- Lock the visit record to prevent concurrent updates
    LOCK TABLE visit IN EXCLUSIVE MODE;

    SELECT COUNT(*) INTO checkup_count FROM checkup WHERE visitid = :NEW.visitid;
    SELECT COUNT(*) INTO inspectionvisit_count FROM inspectionvisit WHERE visitid = :NEW.visitid;
    SELECT COUNT(*) INTO newissue_count FROM newissue WHERE visitid = :NEW.visitid;

    IF (checkup_count + inspectionvisit_count + newissue_count) > 1 THEN
        raise_application_error(-20224, 'A visitid can only belong to one subtype table');
    END IF;
END;
/

-- Ensure date of birth is in the past for doctors and patients
CREATE OR REPLACE TRIGGER trg_chk_doctor_dob
BEFORE INSERT OR UPDATE ON doctor
FOR EACH ROW
BEGIN
    IF :NEW.dateofbirth > SYSDATE THEN
        RAISE_APPLICATION_ERROR(-20001, 'Date of birth cannot be in the future');
    END IF;
END;
/

CREATE OR REPLACE TRIGGER trg_chk_patient_dob
BEFORE INSERT OR UPDATE ON patient
FOR EACH ROW
BEGIN
    IF :NEW.dateofbirth > SYSDATE THEN
        RAISE_APPLICATION_ERROR(-20001, 'Date of birth cannot be in the future');
    END IF;
END;
/

-- Enforce that a prescription can only be marked as renewable when is_renewable is set to 'Yes'
CREATE OR REPLACE TRIGGER enforce_renewable_condition
BEFORE INSERT ON renewable
FOR EACH ROW
DECLARE
    v_is_renewable VARCHAR2(3);
BEGIN
    SELECT is_renewable 
    INTO v_is_renewable 
    FROM prescription 
    WHERE prescriptionid = :NEW.prescriptionid;

    IF v_is_renewable != 'Yes' THEN
        RAISE_APPLICATION_ERROR(-20000, 'Cannot mark prescription as renewable if is_renewable is not set to Yes');
    END IF;
END;
/
