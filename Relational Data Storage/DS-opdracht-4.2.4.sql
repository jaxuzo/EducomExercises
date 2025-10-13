SELECT S.name, prop.name, IFNULL(P.content, "NOT SET") as value
FROM mhl_suppliers S 
CROSS JOIN mhl_propertytypes prop
LEFT JOIN mhl_cities C ON S.city_id = C.id
LEFT JOIN mhl_yn_properties P ON S.id = P.supplier_ID and prop.ID = P.propertytype_ID
WHERE C.name = 'Amsterdam' AND proptype = 'A'