SELECT
name,
  REPLACE(
    REPLACE(
      REPLACE(
        REPLACE(
          REPLACE(
            REPLACE(
              REPLACE(
                REPLACE(
                  REPLACE(
                    REPLACE(
                      REPLACE(
                        REPLACE(
                          REPLACE(
                            REPLACE(
                              REPLACE(
                                name,
                              '&Uuml;', 'Ü'),
                            '&uuml;', 'ü'),
                          '&Ouml;', 'Ö'),
                        '&ouml;', 'ö'),
                      '&eacute;', 'é'),
                    '&Eacute;', 'É'),
                  '&agrave;', 'à'),
                '&Agrave;', 'À'),
              '&auml;', 'ä'),
            '&Auml;', 'Ä'),
          '&iuml;', 'ï'),
        '&Iuml;', 'Ï'),
      '&ccedil;', 'ç'),
    '&Ccedil;', 'Ç'),
  '&egrave;', 'è') 
  AS nice_name
FROM mhl_suppliers
WHERE name LIKE '%&%;%'
LIMIT 25
