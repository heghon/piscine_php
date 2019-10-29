SELECT id_distrib 
    FROM id_distrib
    WHERE id_distrib = 42
    OR id_distrib BETWEEN 62 AND 69
    OR id_distrib = 71
    OR id_distrib = 89
    OR id_distrib = 90
    OR id_distrib = 91
    OR LENGTH(name) - LENGTH(REPLACE(LOWER(name), ‘y’, ‘’)) = 2
    LIMIT 2, 5;