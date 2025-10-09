SELECT drank_sup.rubriek_name as R_name, m1.name, straat, huisnr, postcode, drank_sup.rubriek_name as R_name
FROM mhl_suppliers m1
left JOIN mhl_cities c1 ON m1.city_ID = c1.id
right JOIN (SELECT suprub.mhl_suppliers_ID as supplier_ID, drank.rubriek_name as rubriek_name
			FROM mhl_suppliers_mhl_rubriek_view as suprub
			RIGHT JOIN (SELECT r1.id as rubriek_id, r1.name rubriek_name
						FROM mhl_rubrieken r1
						LEFT JOIN mhl_rubrieken r2 ON r1.parent = r2.id
						WHERE r1.name = 'drank' OR r2.name = 'drank') as drank 
			ON drank.rubriek_id = suprub.mhl_rubriek_view_ID) as drank_sup
ON drank_sup.supplier_ID = m1.id
WHERE c1.name = 'Amsterdam'
ORDER BY R_name, m1.name