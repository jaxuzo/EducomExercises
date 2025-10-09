SELECT name, straat, huisnr, postcode
FROM mhl_suppliers
WHERE name REGEXP '&[A-Za-z0-9]+;|&#[0-9]+;|&#x[0-9A-Fa-f]+;'