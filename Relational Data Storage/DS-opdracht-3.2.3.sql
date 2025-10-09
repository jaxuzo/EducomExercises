SELECT sup.name, sup.straat, sup.huisnr, sup.postcode, c1.name, sup.p_city_ID, c2.name
FROM mhl_suppliers as sup
LEFT JOIN mhl_cities c1 ON sup.city_ID = c1.id
LEFT OUTER JOIN mhl_cities c2 ON sup.p_city_ID = c2.id
WHERE c1.name = 'Amsterdam' AND c2.name !='Amsterdam'