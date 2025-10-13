SELECT 
year
, SUM(CASE WHEN month in (1,2,3) THEN hitcount ELSE 0 END) as Eerste_kwartaal
, SUM(CASE WHEN month in (4,5,6) THEN hitcount ELSE 0 END) as Tweede_kwartaal
, SUM(CASE WHEN month in (7,8,9) THEN hitcount ELSE 0 END) as Derde_kwartaal
, SUM(CASE WHEN month in (10,11,12) THEN hitcount ELSE 0 END) as Vierde_kwartaal
, SUM(hitcount) as Totaal
FROM mhl_hitcount
GROUP BY year
ORDER BY year ASC