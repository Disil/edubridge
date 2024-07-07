create
    definer = root@localhost function konversi_ke_fuzzy(nilai varchar(2), jenis varchar(10)) returns decimal(3, 2)
    deterministic
BEGIN
    DECLARE hasil DECIMAL(3,2);
    CASE
        WHEN nilai IN ('ST') THEN
            SET hasil = CASE jenis
                            WHEN 'rendah' THEN 0.75
                            WHEN 'sedang' THEN 1.00
                            WHEN 'tinggi' THEN 1.00
                        END;
        WHEN nilai IN ('T') THEN
            SET hasil = CASE jenis
                            WHEN 'rendah' THEN 0.50
                            WHEN 'sedang' THEN 0.75
                            WHEN 'tinggi' THEN 1.00
                        END;
        WHEN nilai IN ('CT') THEN
            SET hasil = CASE jenis
                            WHEN 'rendah' THEN 0.25
                            WHEN 'sedang' THEN 0.50
                            WHEN 'tinggi' THEN 0.75
                        END;
        WHEN nilai IN ('KT') THEN
            SET hasil = CASE jenis
                            WHEN 'rendah' THEN 0.00
                            WHEN 'sedang' THEN 0.25
                            WHEN 'tinggi' THEN 0.50
                        END;
        WHEN nilai IN ('TT') THEN
            SET hasil = CASE jenis
                            WHEN 'rendah' THEN 0.00
                            WHEN 'sedang' THEN 0.00
                            WHEN 'tinggi' THEN 0.25
                        END;
        ELSE
            SET hasil = 0.00;
    END CASE;
    RETURN hasil;
END;

