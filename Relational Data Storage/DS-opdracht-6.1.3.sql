SELECT
rubriek.rubriek_name as name
, COUNT(SR.mhl_suppliers_ID) as numsup
FROM mhl_suppliers_mhl_rubriek_view SR
RIGHT JOIN (SELECT child.id as rubriek_id
			,IF(child.parent = 0, child.name, CONCAT(parent.name, ' - ', child.name)) as rubriek_name
			FROM mhl_rubrieken child
			LEFT JOIN mhl_rubrieken parent ON child.parent = parent.id)
            as rubriek ON rubriek.rubriek_id = SR.mhl_rubriek_view_ID
GROUP BY name
HAVING name IS NOT NULL
ORDER BY name ASC
	