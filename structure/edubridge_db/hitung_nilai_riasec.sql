create
    definer = root@localhost procedure hitung_nilai_riasec()
BEGIN
    DECLARE id_siswa INT;
    DECLARE nama VARCHAR(255);
    DECLARE R_count, I_count, A_count, S_count, E_count, C_count INT;

    -- Ambil semua id_siswa dan nama dari tabel siswa
    DECLARE cur CURSOR FOR SELECT id_siswa, nama FROM siswa;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET @done = TRUE;

    OPEN cur;

    read_loop: LOOP
        FETCH cur INTO id_siswa, nama;

        IF @done THEN
            LEAVE read_loop;
        END IF;

        -- Hitung jumlah jawaban untuk setiap kategori
        SET R_count = (SELECT COUNT(*) FROM pertanyaan_riasec WHERE kategori = 'R' AND id_siswa = id_siswa);
        SET I_count = (SELECT COUNT(*) FROM pertanyaan_riasec WHERE kategori = 'I' AND id_siswa = id_siswa);
        SET A_count = (SELECT COUNT(*) FROM pertanyaan_riasec WHERE kategori = 'A' AND id_siswa = id_siswa);
        SET S_count = (SELECT COUNT(*) FROM pertanyaan_riasec WHERE kategori = 'S' AND id_siswa = id_siswa);
        SET E_count = (SELECT COUNT(*) FROM pertanyaan_riasec WHERE kategori = 'E' AND id_siswa = id_siswa);
        SET C_count = (SELECT COUNT(*) FROM pertanyaan_riasec WHERE kategori = 'C' AND id_siswa = id_siswa);

        -- Masukkan jumlah tersebut ke dalam tabel nilai_riasec
        INSERT INTO nilai_riasec (id_siswa, nama, R, I, A, S, E, C)
        VALUES (id_siswa, nama, R_count, I_count, A_count, S_count, E_count, C_count)
        ON DUPLICATE KEY UPDATE R = R_count, I = I_count, A = A_count, S = S_count, E = E_count, C = C_count;
    END LOOP;

    CLOSE cur;
END;

