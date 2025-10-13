SELECT child.id, ifnull(parent.name, child.name) as hoofdrubriek, if(isnull(parent.name), '', child.name) as subrubriek 
FROM mhl_rubrieken child
LEFT JOIN mhl_rubrieken parent ON child.parent = parent.id
ORDER BY hoofdrubriek, subrubriek