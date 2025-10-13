SELECT c1.name, c1.id as cid1, c2.id as cid2, c1.commune_id, c2.commune_id, G1.name as gemeente_1, G2.name as gemeente_2
FROM mhl_cities C1
LEFT JOIN mhl_cities C2 ON c1.name = c2.name
LEFT JOIN mhl_communes G1 on C1.commune_ID = G1.id
LEFT JOIN mhl_communes G2 on C2.commune_ID = G2.id
WHERE c1.id < c2.id AND G1.name IS NOT NULL
ORDER BY c1.name