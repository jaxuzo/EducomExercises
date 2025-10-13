SELECT
C.name as Stad,
SUM(M.name = 'Gold') as Gold,
SUM(M.name = 'Silver') as Silver,
SUM(M.name = 'Bronze') as Bronze,
SUM(M.name not in ('Gold','Silver','Bronze')) as Other
FROM mhl_suppliers S 
LEFT JOIN mhl_membertypes M ON S.membertype = M.id
LEFT JOIN mhl_cities C ON S.city_ID = C.id
GROUP BY C.name
ORDER BY Gold DESC, Silver Desc, Bronze Desc, Other Desc