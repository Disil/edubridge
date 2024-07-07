create
    definer = root@localhost function ubah_nilai_rapot_ke_huruf(score float) returns varchar(2) deterministic
BEGIN
    IF score >= 94 THEN RETURN 'ST';
    ELSEIF score >= 87 THEN RETURN 'T';
    ELSEIF score >= 80 THEN RETURN 'CT';
    ELSEIF score >= 73 THEN RETURN 'KT';
    ELSE RETURN 'TT';
    END IF;
END;

