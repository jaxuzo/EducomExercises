SELECT
rubriek_name as name
,ifnull(SUM(hitcount), 'Geen hits') as total
FROM mhl_suppliers as S
LEFT JOIN mhl_hitcount H ON S.id = H.supplier_ID
LEFT JOIN (SELECT SR.mhl_suppliers_ID as supplier_ID
			,IF(child.parent = 0, child.name, CONCAT(parent.name, ' - ', child.name)) as rubriek_name
			FROM mhl_rubrieken child
			LEFT JOIN mhl_rubrieken parent ON child.parent = parent.id
			LEFT JOIN mhl_suppliers_mhl_rubriek_view SR ON child.id = SR.mhl_rubriek_view_ID)
            as rubriek ON rubriek.supplier_ID = S.id
WHERE rubriek.rubriek_name IS NOT NULL
group by rubriek_name
ORDER BY name
