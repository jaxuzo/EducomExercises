CREATE VIEW VERZENDLIJST (ID, adres, postcode, stad)
AS (
SELECT S.id
, IF(p_address <> '', p_address, CONCAT(straat, ' ', huisnr)) as adres
, IF(p_address <> '', p_postcode, postcode) as adres
, IF(p_address <> '', C2.name, C.name) as stad
FROM mhl_suppliers S
LEFT JOIN mhl_cities C ON S.city_ID = C.id
LEFT JOIN mhl_cities C2 ON S.p_city_ID = C2.id)

