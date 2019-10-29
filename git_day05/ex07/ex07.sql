SELECT title, summary
    FROM film
    WHERE summary LIKE '%42%' OR title LIKE '%42%'
    ORDER BY id_film ASC;