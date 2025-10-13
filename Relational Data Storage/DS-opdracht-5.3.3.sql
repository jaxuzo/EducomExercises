SELECT S.name as name 
,IFNULL(D.contact, "tav de directie") as contact
,V.adres
,V.postcode
,V.stad
FROM VERZENDLIJST V
LEFT JOIN DIRECTIE D ON V.ID = D.supplier_ID
LEFT JOIN mhl_suppliers S ON S.id = V.id
ORDER BY name
