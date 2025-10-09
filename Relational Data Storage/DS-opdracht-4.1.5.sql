SELECT S.name, S.straat, S.huisnr, S.postcode, P.lat, P.lng 
FROM mhl_suppliers as S
INNER JOIN pc_lat_long as P ON S.postcode = P.pc6
ORDER BY lat DESC
LIMIT 5
