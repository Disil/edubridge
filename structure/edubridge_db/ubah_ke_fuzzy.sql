create
    definer = root@localhost procedure ubah_ke_fuzzy()
BEGIN
        INSERT INTO tabel_rapot_rendah (id_siswa, ipa, ips, bahasa, praktek, politik, seni, R, I, A, S, E, C)
            SELECT
                id_siswa,
                konversi_ke_fuzzy(ipa, 'rendah') AS ipa,
                konversi_ke_fuzzy(ips, 'rendah') AS ips,
                konversi_ke_fuzzy(bahasa, 'rendah') AS bahasa,
                konversi_ke_fuzzy(praktek, 'rendah') AS praktek,
                konversi_ke_fuzzy(politik, 'rendah') AS politik,
                konversi_ke_fuzzy(seni, 'rendah') AS seni,
                konversi_ke_fuzzy(R, 'rendah') AS R,
                konversi_ke_fuzzy(I, 'rendah') AS I,
                konversi_ke_fuzzy(A, 'rendah') AS A,
                konversi_ke_fuzzy(S, 'rendah') AS S,
                konversi_ke_fuzzy(E, 'rendah') AS E,
                konversi_ke_fuzzy(C, 'rendah') AS C
        FROM nilai
        ON DUPLICATE KEY UPDATE
            ipa = VALUES(ipa),
            ips = VALUES(ips),
            bahasa = VALUES(bahasa),
            praktek = VALUES(praktek),
            politik = VALUES(politik),
            seni = VALUES(seni),
            R = VALUES(R),
            I = VALUES(I),
            A = VALUES(A),
            S = VALUES(S),
            E = VALUES(E),
            C = VALUES(C);

        INSERT INTO tabel_rapot_sedang (id_siswa, ipa, ips, bahasa, praktek, politik, seni, R, I, A, S, E, C)
            SELECT
                id_siswa,
                konversi_ke_fuzzy(ipa, 'sedang') AS ipa,
                konversi_ke_fuzzy(ips, 'sedang') AS ips,
                konversi_ke_fuzzy(bahasa, 'sedang') AS bahasa,
                konversi_ke_fuzzy(praktek, 'sedang') AS praktek,
                konversi_ke_fuzzy(politik, 'sedang') AS politik,
                konversi_ke_fuzzy(seni, 'sedang') AS seni,
                konversi_ke_fuzzy(R, 'sedang') AS R,
                konversi_ke_fuzzy(I, 'sedang') AS I,
                konversi_ke_fuzzy(A, 'sedang') AS A,
                konversi_ke_fuzzy(S, 'sedang') AS S,
                konversi_ke_fuzzy(E, 'sedang') AS E,
                konversi_ke_fuzzy(C, 'sedang') AS C
        FROM nilai
        ON DUPLICATE KEY UPDATE
            ipa = VALUES(ipa),
            ips = VALUES(ips),
            bahasa = VALUES(bahasa),
            praktek = VALUES(praktek),
            politik = VALUES(politik),
            seni = VALUES(seni),
            R = VALUES(R),
            I = VALUES(I),
            A = VALUES(A),
            S = VALUES(S),
            E = VALUES(E),
            C = VALUES(C);
        
        INSERT INTO tabel_rapot_tinggi (id_siswa, ipa, ips, bahasa, praktek, politik, seni, R, I, A, S, E, C)
            SELECT
                id_siswa,
                konversi_ke_fuzzy(ipa, 'tinggi') AS ipa,
                konversi_ke_fuzzy(ips, 'tinggi') AS ips,
                konversi_ke_fuzzy(bahasa, 'tinggi') AS bahasa,
                konversi_ke_fuzzy(praktek, 'tinggi') AS praktek,
                konversi_ke_fuzzy(politik, 'tinggi') AS politik,
                konversi_ke_fuzzy(seni, 'tinggi') AS seni,
                konversi_ke_fuzzy(R, 'tinggi') AS R,
                konversi_ke_fuzzy(I, 'tinggi') AS I,
                konversi_ke_fuzzy(A, 'tinggi') AS A,
                konversi_ke_fuzzy(S, 'tinggi') AS S,
                konversi_ke_fuzzy(E, 'tinggi') AS E,
                konversi_ke_fuzzy(C, 'tinggi') AS C
            FROM nilai
        ON DUPLICATE KEY UPDATE
            ipa = VALUES(ipa),
            ips = VALUES(ips),
            bahasa = VALUES(bahasa),
            praktek = VALUES(praktek),
            politik = VALUES(politik),
            seni = VALUES(seni),
            R = VALUES(R),
            I = VALUES(I),
            A = VALUES(A),
            S = VALUES(S),
            E = VALUES(E),
            C = VALUES(C);
    END;

