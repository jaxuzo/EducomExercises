SELECT G.name as gemeente
, S.name as leverancier
, SUM(hitcount) as total_hitcount
, average_hitcount
FROM mhl_suppliers S
LEFT JOIN mhl_cities C ON C.id = S.city_ID
LEFT JOIN mhl_communes G ON G.id = C.commune_ID
LEFT JOIN mhl_hitcount H ON H.supplier_ID = S.id
INNER JOIN (SELECT g.id as gemeente_ID
	,AVG(hitcount) as average_hitcount
	FROM mhl_suppliers S
	LEFT JOIN mhl_cities C ON C.id = S.city_ID
	LEFT JOIN mhl_communes G ON G.id = C.commune_ID
    LEFT JOIN mhl_hitcount H ON H.supplier_ID = S.id
    LEFT JOIN mhl_districts D ON D.id = G.district_ID
    LEFT JOIN mhl_countries L ON L.id = D.country_ID
    WHERE L.code = 'NL'
    GROUP BY g.id) as count ON count.gemeente_ID = G.id
WHERE G.name IS NOT NULL
GROUP BY G.name, leverancier
HAVING total_hitcount > average_hitcount
ORDER BY G.name, total_hitcount DESC


