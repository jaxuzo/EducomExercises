SELECT 
H.hitcount as hitcount, 
S.name as leverancier,
C.name as stad,
CO.name as gemeente,
D.name as provincie
FROM mhl_suppliers as S
INNER JOIN mhl_hitcount as H ON S.id = H.supplier_ID
INNER JOIN mhl_cities as C ON S.city_ID = C.id
INNER JOIN mhl_communes as CO on C.commune_ID = CO.id
INNER JOIN mhl_districts as D on CO.district_ID = D.id
WHERE D.name in ('Noord-Brabant','Limburg', 'Zeeland')
AND H.year = 2014 AND H.month = 1