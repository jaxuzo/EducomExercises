SELECT 
name
, CASE 
	WHEN NAME LIKE "'% %"
		THEN CONCAT(
				LEFT(name, LOCATE(' ', name)),
				UPPER(SUBSTRING(name, LOCATE(' ', name)+ 1,1)),
				SUBSTRING(name, LOCATE(' ', name)+ 2)
                )
	WHEN NAME LIKE "'%-%"
		THEN CONCAT(
				LEFT(name, LOCATE('-', name)),
				UPPER(SUBSTRING(name, LOCATE('-', name)+ 1,1)),
				SUBSTRING(name, LOCATE('-', name)+ 2)
                )
	ELSE
		CONCAT(
			UPPER(LEFT(name,1)),
			SUBSTRING(name,2)
            )
	END AS nice_name
FROM mhl_cities
ORDER BY name