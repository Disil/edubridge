create definer = root@localhost trigger if not exists ubah_nilai_ke_huruf_2
    after insert
    on nilai_riasec
    for each row
BEGIN
    DECLARE v_ipa FLOAT;
    DECLARE v_ips FLOAT;
    DECLARE v_bahasa FLOAT;
    DECLARE v_praktek FLOAT;
    DECLARE v_politik FLOAT;
    DECLARE v_seni FLOAT;
    DECLARE v_R INT;
    DECLARE v_I INT;
    DECLARE v_A INT;
    DECLARE v_S INT;
    DECLARE v_E INT;
    DECLARE v_C INT;

    SELECT ipa, ips, bahasa, praktek, politik, seni INTO v_ipa, v_ips, v_bahasa, v_praktek, v_politik, v_seni
    FROM nilai_rapot
    WHERE id_siswa = NEW.id_siswa;

    SELECT R, I, A, S, E, C INTO v_R, v_I, v_A, v_S, v_E, v_C
    FROM nilai_riasec
    WHERE id_siswa = NEW.id_siswa;

    IF v_ipa IS NOT NULL AND v_ips IS NOT NULL AND v_bahasa IS NOT NULL AND v_praktek IS NOT NULL AND v_politik IS NOT NULL AND v_seni IS NOT NULL THEN
        INSERT INTO nilai (id_siswa, ipa, ips, bahasa, praktek, politik, seni, R, I, A, S, E, C)
        VALUES (
                   NEW.id_siswa,
                   ubah_nilai_rapot_ke_huruf(v_ipa),
                   ubah_nilai_rapot_ke_huruf(v_ips),
                   ubah_nilai_rapot_ke_huruf(v_bahasa),
                   ubah_nilai_rapot_ke_huruf(v_praktek),
                   ubah_nilai_rapot_ke_huruf(v_politik),
                   ubah_nilai_rapot_ke_huruf(v_seni),
                   ubah_nilai_riasec_ke_huruf(v_R),
                   ubah_nilai_riasec_ke_huruf(v_I),
                   ubah_nilai_riasec_ke_huruf(v_A),
                   ubah_nilai_riasec_ke_huruf(v_S),
                   ubah_nilai_riasec_ke_huruf(v_E),
                   ubah_nilai_riasec_ke_huruf(v_C)
               )
        ON DUPLICATE KEY UPDATE
                    ipa = ubah_nilai_rapot_ke_huruf(v_ipa),
                    ips = ubah_nilai_rapot_ke_huruf(v_ips),
                    bahasa = ubah_nilai_rapot_ke_huruf(v_bahasa),
                    praktek = ubah_nilai_rapot_ke_huruf(v_praktek),
                    politik = ubah_nilai_rapot_ke_huruf(v_politik),
                    seni = ubah_nilai_rapot_ke_huruf(v_seni),
                    R = ubah_nilai_riasec_ke_huruf(v_R),
                    I = ubah_nilai_riasec_ke_huruf(v_I),
                    A = ubah_nilai_riasec_ke_huruf(v_A),
                    S = ubah_nilai_riasec_ke_huruf(v_S),
                    E = ubah_nilai_riasec_ke_huruf(v_E),
                    C = ubah_nilai_riasec_ke_huruf(v_C);

    END IF;
END;

