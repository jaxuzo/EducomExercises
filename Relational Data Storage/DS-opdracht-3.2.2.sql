SELECT sup.name, sup.straat, sup.huisnr, sup.postcode
FROM mhl_suppliers as sup
LEFT JOIN mhl_membertypes ON sup.membertype = mhl_membertypes.id
WHERE mhl_membertypes.name in ('Gold','Silver','Bronze','GEEN INTERESSE')