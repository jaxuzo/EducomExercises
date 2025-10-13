SELECT c1.name, c2.name, c1.id, c2.id, c1.commune_id, c2.commune_id
FROM mhl_cities C1
LEFT JOIN mhl_cities C2 ON c1.name = c2.name
WHERE c1.id < c2.id
ORDER BY c1.name