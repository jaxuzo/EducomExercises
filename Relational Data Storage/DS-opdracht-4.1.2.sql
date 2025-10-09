SELECT name, straat, huisnr, postcode, plaatsnaam
FROM mhl_suppliers as sup
JOIN 
(SELECT mhl_cities.id as city_ID, mhl_cities.name as plaatsnaam, mhl_cities.commune_ID as commune_ID, mhl_communes.name as commune_name
FROM mhl_cities
JOIN mhl_communes ON mhl_cities.commune_ID = mhl_communes.id) as join1 ON join1.city_ID = sup.city_ID
WHERE join1.commune_name = 'Steenwijkerland'
