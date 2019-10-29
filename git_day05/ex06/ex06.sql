SELECT title, summary
    FROM film
    WHERE UPPER(summary) LIKE UPPER('%Vincent%')
    ORDER BY id_film ASC;