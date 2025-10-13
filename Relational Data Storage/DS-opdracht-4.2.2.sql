SELECT c1.name, ifnull(G.name,"Invalid")
from mhl_cities as c1
LEFT JOIN mhl_communes G ON c1.commune_ID = g.id
