SELECT
	S.name as leverancier, 
	IFNULL( C.name, "t.a.v. de directie") as aanhef,
	IF(S.p_address <> '', p_address, CONCAT(S.straat,' ', S.huisnr)) as adres,
	IF(S.p_address <> '', p_postcode, postcode) as postcode,
	IF(S.p_address <> '', P1.name, P.name) as stad,
	IF(S.p_address <> '', D1.name, D.name) as provincie
FROM mhl_suppliers S
LEFT JOIN mhl_contacts C on S.id = C.supplier_ID AND C.department=3
LEFT JOIN mhl_cities P on P.id = S.city_ID
LEFT JOIN mhl_communes G on G.id = P.commune_ID
LEFT JOIN mhl_districts D ON D.id = G.district_ID
LEFT JOIN mhl_cities P1 on P1.id = S.p_city_ID
LEFT JOIN mhl_communes G1 on G1.id = P1.commune_ID
LEFT JOIN mhl_districts D1 ON D1.id = G1.district_ID
WHERE postcode <> ''
ORDER BY provincie, stad, leverancier