SELECT id
, joindate
, DATEDIFF(CURRENT_DATE, joindate) as dagen_lid
FROM mhl_suppliers
ORDER BY dagen_lid ASC
