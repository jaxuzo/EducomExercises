SELECT S.name name, SUM(hitcount) as numhits,  COUNT(month) AS nummonths,  ROUND(AVG(hitcount), 0) as avgpermonth
FROM mhl_hitcount H
JOIN mhl_suppliers S ON S.id = H.supplier_ID
GROUP BY H.supplier_ID
HAVING SUM(hitcount) > 100
ORDER BY avgpermonth DESC