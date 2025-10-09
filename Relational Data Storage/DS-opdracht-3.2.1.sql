SELECT suppliers.name, suppliers.straat, suppliers.huisnr, suppliers.postcode
FROM mhl_suppliers as suppliers
LEFT JOIN mhl_cities ON suppliers.city_ID=mhl_cities.id
WHERE mhl_cities.name = 'Amsterdam'