SELECT sup.name, sup.straat, sup.huisnr, sup.postcode, sup.p_city_ID, c1.name as stad, c2.name postbus_stad
FROM mhl_suppliers as sup
LEFT OUTER JOIN mhl_cities c1 ON sup.city_ID = c1.id
LEFT OUTER JOIN mhl_cities c2 ON sup.p_city_ID = c2.id
WHERE c1.name = 'Amsterdam' OR c2.name = 'Den Haag'