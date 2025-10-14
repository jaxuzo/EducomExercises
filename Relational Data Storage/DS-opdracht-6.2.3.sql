SELECT DAYNAME(joindate) as 'Dag van de week'
, COUNT(*) as 'Aantal aanmeldingen'
FROM mhl_suppliers
group by DAYNAME(joindate)