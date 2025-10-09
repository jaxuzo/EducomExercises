SELECT sup.name, sup.straat, sup.huisnr, sup.postcode
FROM mhl_suppliers as sup
LEFT JOIN mhl_cities c1 ON sup.city_ID = c1.id
WHERE c1.name = 'Amsterdam'