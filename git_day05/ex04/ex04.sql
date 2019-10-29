UPDATE ft_table
    SET creation_date = DATE_ADD(creatio_date, INTERVAL 20 YEARS)
    WHERE id > 5;