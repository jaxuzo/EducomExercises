SELECT 
CONCAT(EXTRACT(DAY FROM joindate),'.',EXTRACT(MONTH FROM joindate) , '.',EXTRACT(YEAR FROM joindate)) as date
,id
FROM mhl_suppliers
WHERE DATEDIFF(LAST_DAY(joindate), joindate) < 7