SELECT
EXTRACT(YEAR FROM joindate) as year
,MONTHNAME(joindate) as maand
,COUNT(*) as aantal
FROM mhl_suppliers
GROUP BY MONTHNAME(joindate), year
order by year ASC, maand ASC