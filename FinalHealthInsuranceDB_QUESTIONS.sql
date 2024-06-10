SELECT
    d.firstname AS doctor_firstname,
    d.lastname AS doctor_lastname,
    s.startdate AS supervision_start_date,
    s.enddate AS supervision_end_date
FROM
    supervise s
JOIN
    doctor d ON s.doctorid = d.doctorid
WHERE
    s.amka = 'P1';


SELECT
    m.med_name AS medicine_name,
    d.firstname AS doctor_firstname,
    d.lastname AS doctor_lastname,
    v.visitid AS visit_id
FROM
    prescription p
JOIN
    includes i ON p.prescriptionid = i.prescriptionid
JOIN
    medicine m ON i.medicineid = m.medicineid
JOIN
    doctor d ON p.doctorid = d.doctorid
JOIN
    visit v ON p.visitid = v.visitid
WHERE
    p.amka = 'P2';


SELECT
    v.*,
    p.firstname AS patient_firstname,
    p.lastname AS patient_lastname,
    d.firstname AS doctor_firstname,
    d.lastname AS doctor_lastname,
    c.weight,
    c.height,
    c.systolic_blood_pressure,
    c.diastolic_blood_pressure
FROM
    visit v
JOIN
    patient p ON v.amka = p.amka
JOIN
    doctor d ON v.doctorid = d.doctorid
JOIN
    checkup c ON v.visitid = c.visitid
WHERE
    p.amka = 'P1' AND d.doctorid = 'D2';


SELECT
    d.firstname || ' ' || d.lastname AS doctor_name,
    d.specialty,
    hc.hosp_name,
    a.street, a.city, a.region, a.country, a.postal_code
FROM
    doctor d
JOIN
    workson w ON d.doctorid = w.doctorid
JOIN
    hospital_clinic hc ON w.hospitalclinicid = hc.hospitalclinicid
JOIN
    address a ON hc.addressid = a.addressid;


SELECT
    AVG(c.weight) AS avg_weight,
    AVG(c.height) AS avg_height,
    AVG(c.systolic_blood_pressure) AS avg_systolic_blood_pressure,
    AVG(c.diastolic_blood_pressure) AS avg_diastolic_blood_pressure
FROM
    checkup c
JOIN
    visit v ON c.visitid = v.visitid
JOIN
    patient p ON v.amka = p.amka
WHERE
    p.amka = 'P1';


SELECT
    s.amka AS patient_amka,
    COUNT(DISTINCT s.doctorid) AS num_changed_doctors
FROM
    supervise s
GROUP BY
    s.amka;
