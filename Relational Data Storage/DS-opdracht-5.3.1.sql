CREATE VIEW DIRECTIE (supplier_ID, contact, functie, department)
AS (SELECT C.supplier_ID, C.name, contacttype, D.name
FROM mhl_contacts as C
JOIN mhl_departments as D ON C.department = D.id
WHERE department = "Directie" OR contacttype LIKE '%directeur%')
