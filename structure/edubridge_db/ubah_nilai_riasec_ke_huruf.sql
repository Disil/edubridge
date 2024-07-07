create
    definer = root@localhost function ubah_nilai_riasec_ke_huruf(score int) returns varchar(2) deterministic
BEGIN
    IF score >= 13 THEN RETURN 'ST';
    ELSEIF score >= 10 THEN RETURN 'T';
    ELSEIF score >= 7 THEN RETURN 'CT';
    ELSEIF score >= 4 THEN RETURN 'KT';
    ELSE RETURN 'TT';
    END IF;
END;

