SELECT c1.name, c1.id, c1.commune_id, g.name
from mhl_cities as c1
LEFT JOIN mhl_communes G ON c1.commune_ID = g.id
WHERE G.name IS NULL