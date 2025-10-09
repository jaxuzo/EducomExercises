SELECT S.name, S.straat, S.huisnr, S.postcode 
FROM mhl_yn_properties as YP
INNER JOIN mhl_propertytypes as PT ON YP.propertytype_ID = PT.id
INNER JOIN mhl_suppliers as S ON YP.supplier_ID = S.id
WHERE PT.name = 'specialistische leverancier' OR PT.name = 'ook voor particulieren'