CREATE TABLE siswa
(
    id_siswa      INT PRIMARY KEY AUTO_INCREMENT,
    nama_siswa    VARCHAR(255),
    email         VARCHAR(255),
    password      VARCHAR(255),
    tanggal_lahir DATE,
    asal_sekolah  VARCHAR(255),
    kelas         ENUM ('X', 'XI', 'XII'),
    jenis_kelamin ENUM ('Pria', 'Wanita'),
    tgl_buat_akun TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE error_log (
                           timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                           message TEXT
);

CREATE TABLE nilai_rapot_asli (
                                  id_siswa INT NOT NULL PRIMARY KEY,
                                  matematika int,
                                  fisika int,
                                  kimia int,
                                  biologi int,
                                  ekonomi int,
                                  geografi int,
                                  sosiologi int,
                                  bahasa_indonesia int,
                                  bahasa_inggris int,
                                  pjok int,
                                  prakarya int,
                                  sejarah int,
                                  ppkn int,
                                  seni_budaya int,
                                  foreign key (id_siswa) references siswa(id_siswa)
);

CREATE TABLE nilai_riasec (
                              id_siswa INT NOT NULL PRIMARY KEY,
                              R int,
                              I int,
                              A int,
                              S int,
                              E int,
                              C int,
                              foreign key (id_siswa) references siswa(id_siswa)
);

CREATE TABLE soal_riasec (
                             id_soal INT PRIMARY KEY AUTO_INCREMENT,
                             soal VARCHAR(255) NOT NULL,
                             kategori ENUM ('R', 'I', 'A', 'S', 'E', 'C') NOT NULL
);

CREATE TABLE jawaban_riasec (
                                id_siswa INT NOT NULL,
                                id_soal INT NOT NULL,
                                jawaban ENUM ('Ya', 'Tidak') NOT NULL,
                                foreign key (id_siswa) references siswa(id_siswa),
                                foreign key (id_soal) references soal_riasec(id_soal)
);

-- Prosedur untuk menghitung nilai R, I, A, S, E, C dari form tes riasec
DELIMITER //
CREATE PROCEDURE hitung_nilai_riasec()
BEGIN
    DECLARE id_siswa INT;
    DECLARE R_count, I_count, A_count, S_count, E_count, C_count INT;

    -- Ambil semua id_siswa dan nama dari tabel siswa
    DECLARE cur CURSOR FOR SELECT id_siswa FROM siswa;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET @done = TRUE;

    OPEN cur;

    read_loop: LOOP
        FETCH cur INTO id_siswa;

        IF @done THEN
            LEAVE read_loop;
        END IF;

        -- Hitung jumlah jawaban untuk setiap kategori
        SET R_count = (SELECT COUNT(*) FROM soal_riasec WHERE kategori = 'R');
        SET I_count = (SELECT COUNT(*) FROM soal_riasec WHERE kategori = 'I');
        SET A_count = (SELECT COUNT(*) FROM soal_riasec WHERE kategori = 'A');
        SET S_count = (SELECT COUNT(*) FROM soal_riasec WHERE kategori = 'S');
        SET E_count = (SELECT COUNT(*) FROM soal_riasec WHERE kategori = 'E');
        SET C_count = (SELECT COUNT(*) FROM soal_riasec WHERE kategori = 'C');

        -- Masukkan jumlah tersebut ke dalam tabel nilai_riasec
        INSERT INTO nilai_riasec (id_siswa, R, I, A, S, E, C)
        VALUES (id_siswa, R_count, I_count, A_count, S_count, E_count, C_count)
        ON DUPLICATE KEY UPDATE R = R_count, I = I_count, A = A_count, S = S_count, E = E_count, C = C_count;
    END LOOP;

    CLOSE cur;
END;
//
DELIMITER ;

CREATE TABLE nilai_rapot_asli (
                                  id_siswa INT NOT NULL PRIMARY KEY,
                                  matematika INT,
                                  fisika INT DEFAULT 0 NOT NULL,
                                  kimia INT DEFAULT 0 NOT NULL,
                                  biologi INT DEFAULT 0 NOT NULL,
                                  ekonomi INT DEFAULT 0 NOT NULL,
                                  geografi INT DEFAULT 0 NOT NULL,
                                  sosiologi INT DEFAULT 0 NOT NULL,
                                  bahasa_indonesia INT,
                                  bahasa_inggris INT,
                                  pjok INT,
                                  prakarya INT,
                                  sejarah INT,
                                  ppkn INT,
                                  seni_budaya INT,
                                  FOREIGN KEY (id_siswa) REFERENCES siswa(id_siswa)
);
CREATE TABLE nilai_rapot (
                             id_siswa INT NOT NULL PRIMARY KEY,
                             ipa FLOAT,
                             ips FLOAT,
                             bahasa FLOAT,
                             praktek FLOAT,
                             politik FLOAT,
                             seni FLOAT,
                             FOREIGN KEY (id_siswa) REFERENCES siswa(id_siswa)
);
CREATE TABLE nilai (
                       id_siswa INT NOT NULL PRIMARY KEY,
                       ipa VARCHAR(2),
                       ips VARCHAR(2),
                       bahasa VARCHAR(2),
                       praktek VARCHAR(2),
                       politik VARCHAR(2),
                       seni VARCHAR(2),
                       R VARCHAR(2),
                       I VARCHAR(2),
                       A VARCHAR(2),
                       S VARCHAR(2),
                       E VARCHAR(2),
                       C VARCHAR(2),
                       foreign key (id_siswa) references siswa(id_siswa)
);

DELIMITER //
CREATE FUNCTION ubah_rapot_ke_huruf(score FLOAT) RETURNS VARCHAR(2) DETERMINISTIC
BEGIN
    IF score >= 94 THEN RETURN 'ST';
    ELSEIF score >= 87 THEN RETURN 'T';
    ELSEIF score >= 80 THEN RETURN 'CT';
    ELSEIF score >= 73 THEN RETURN 'KT';
    ELSE RETURN 'TT';
    END IF;
END //
DELIMITER ;

-- Function to convert numeric grade to letter grade for nilai_riasec
DELIMITER //
CREATE FUNCTION ubah_riasec_ke_huruf(score INT) RETURNS VARCHAR(2) DETERMINISTIC
BEGIN
    IF score >= 13 THEN RETURN 'ST';
    ELSEIF score >= 10 THEN RETURN 'T';
    ELSEIF score >= 7 THEN RETURN 'CT';
    ELSEIF score >= 4 THEN RETURN 'KT';
    ELSE RETURN 'TT';
    END IF;
END //
DELIMITER ;



DELIMITER //
CREATE TRIGGER gabung_nilai_rapot
    AFTER INSERT ON nilai_rapot_asli
    FOR EACH ROW
BEGIN
    INSERT INTO nilai_rapot (id_siswa, ipa, ips, bahasa, praktek, politik, seni)
    SELECT
        NEW.id_siswa,
        (NEW.matematika + NEW.fisika + NEW.kimia + NEW.biologi) / 4,
        (NEW.matematika + NEW.ekonomi + NEW.geografi + NEW.sosiologi) / 4,
        (NEW.bahasa_indonesia + NEW.bahasa_inggris) / 2,
        (NEW.pjok + NEW.prakarya) / 2,
        (NEW.sejarah + NEW.ppkn) / 2,
        NEW.seni_budaya
    ON DUPLICATE KEY UPDATE
                         ipa      = VALUES(ipa),
                         ips      = VALUES(ips),
                         bahasa   = VALUES(bahasa),
                         praktek  = VALUES(praktek),
                         politik  = VALUES(politik),
                         seni     = VALUES(seni);
END//
DELIMITER ;

DELIMITER //
create trigger ubah_nilai_ke_huruf_1
    after insert
    on nilai_rapot
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

    IF v_R IS NOT NULL AND v_I IS NOT NULL AND v_A IS NOT NULL AND v_S IS NOT NULL AND v_E IS NOT NULL AND v_C IS NOT NULL THEN
        INSERT INTO nilai (id_siswa, ipa, ips, bahasa, praktek, politik, seni, R, I, A, S, E, C)
        VALUES (
                   NEW.id_siswa,
                   ubah_rapot_ke_huruf(v_ipa),
                   ubah_rapot_ke_huruf(v_ips),
                   ubah_rapot_ke_huruf(v_bahasa),
                   ubah_rapot_ke_huruf(v_praktek),
                   ubah_rapot_ke_huruf(v_politik),
                   ubah_rapot_ke_huruf(v_seni),
                   ubah_riasec_ke_huruf(v_R),
                   ubah_riasec_ke_huruf(v_I),
                   ubah_riasec_ke_huruf(v_A),
                   ubah_riasec_ke_huruf(v_S),
                   ubah_riasec_ke_huruf(v_E),
                   ubah_riasec_ke_huruf(v_C)
               )
        ON DUPLICATE KEY UPDATE
                             ipa = ubah_rapot_ke_huruf(v_ipa),
                             ips = ubah_rapot_ke_huruf(v_ips),
                             bahasa = ubah_rapot_ke_huruf(v_bahasa),
                             praktek = ubah_rapot_ke_huruf(v_praktek),
                             politik = ubah_rapot_ke_huruf(v_politik),
                             seni = ubah_rapot_ke_huruf(v_seni),
                             R = ubah_riasec_ke_huruf(v_R),
                             I = ubah_riasec_ke_huruf(v_I),
                             A = ubah_riasec_ke_huruf(v_A),
                             S = ubah_riasec_ke_huruf(v_S),
                             E = ubah_riasec_ke_huruf(v_E),
                             C = ubah_riasec_ke_huruf(v_C);
    END IF;
END;
DELIMITER ;

DELIMITER //
create trigger ubah_nilai_ke_huruf_2
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
                   ubah_rapot_ke_huruf(v_ipa),
                   ubah_rapot_ke_huruf(v_ips),
                   ubah_rapot_ke_huruf(v_bahasa),
                   ubah_rapot_ke_huruf(v_praktek),
                   ubah_rapot_ke_huruf(v_politik),
                   ubah_rapot_ke_huruf(v_seni),
                   ubah_riasec_ke_huruf(v_R),
                   ubah_riasec_ke_huruf(v_I),
                   ubah_riasec_ke_huruf(v_A),
                   ubah_riasec_ke_huruf(v_S),
                   ubah_riasec_ke_huruf(v_E),
                   ubah_riasec_ke_huruf(v_C)
               )
        ON DUPLICATE KEY UPDATE
                             ipa = ubah_rapot_ke_huruf(v_ipa),
                             ips = ubah_rapot_ke_huruf(v_ips),
                             bahasa = ubah_rapot_ke_huruf(v_bahasa),
                             praktek = ubah_rapot_ke_huruf(v_praktek),
                             politik = ubah_rapot_ke_huruf(v_politik),
                             seni = ubah_rapot_ke_huruf(v_seni),
                             R = ubah_riasec_ke_huruf(v_R),
                             I = ubah_riasec_ke_huruf(v_I),
                             A = ubah_riasec_ke_huruf(v_A),
                             S = ubah_riasec_ke_huruf(v_S),
                             E = ubah_riasec_ke_huruf(v_E),
                             C = ubah_riasec_ke_huruf(v_C);

    END IF;
END;
DELIMITER ;

CREATE TABLE acuan_nilai_jurusan (
                                     id_jurusan INT PRIMARY KEY,
                                     nama_jurusan VARCHAR(255),
                                     ipa VARCHAR(2),
                                     ips VARCHAR(2),
                                     bahasa VARCHAR(2),
                                     praktek VARCHAR(2),
                                     politik VARCHAR(2),
                                     seni VARCHAR(2),
                                     R VARCHAR(2),
                                     I VARCHAR(2),
                                     A VARCHAR(2),
                                     S VARCHAR(2),
                                     E VARCHAR(2),
                                     C VARCHAR(2)
);

create function konversi_ke_fuzzy(nilai varchar(2), jenis varchar(10)) returns decimal(3, 2)
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

create procedure ubah_ke_fuzzy()
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

DELIMITER ;


DELIMITER //
CREATE PROCEDURE buat_tabel_fuzzy_jurusan()
BEGIN
    -- Create tables if they don't exist
    CREATE TABLE IF NOT EXISTS tabel_nilai_rendah (
                                                      id_jurusan INT PRIMARY KEY ,
                                                      ipa FLOAT,
                                                      ips FLOAT,
                                                      bahasa FLOAT,
                                                      praktek FLOAT,
                                                      politik FLOAT,
                                                      seni FLOAT,
                                                      R FLOAT,
                                                      I FLOAT,
                                                      A FLOAT,
                                                      S FLOAT,
                                                      E FLOAT,
                                                      C FLOAT,
                                                      foreign key (id_jurusan) references acuan_nilai_jurusan(id_jurusan)
    );

    CREATE TABLE IF NOT EXISTS tabel_nilai_sedang (
                                                      id_jurusan INT PRIMARY KEY ,
                                                      ipa FLOAT,
                                                      ips FLOAT,
                                                      bahasa FLOAT,
                                                      praktek FLOAT,
                                                      politik FLOAT,
                                                      seni FLOAT,
                                                      R FLOAT,
                                                      I FLOAT,
                                                      A FLOAT,
                                                      S FLOAT,
                                                      E FLOAT,
                                                      C FLOAT,
                                                      foreign key (id_jurusan) references acuan_nilai_jurusan(id_jurusan)
    );

    CREATE TABLE IF NOT EXISTS tabel_nilai_tinggi (
                                                      id_jurusan INT PRIMARY KEY ,
                                                      ipa FLOAT,
                                                      ips FLOAT,
                                                      bahasa FLOAT,
                                                      praktek FLOAT,
                                                      politik FLOAT,
                                                      seni FLOAT,
                                                      R FLOAT,
                                                      I FLOAT,
                                                      A FLOAT,
                                                      S FLOAT,
                                                      E FLOAT,
                                                      C FLOAT,
                                                      foreign key (id_jurusan) references acuan_nilai_jurusan(id_jurusan)
    );

    -- Truncate tables if they already exist
    TRUNCATE TABLE tabel_nilai_rendah;
    TRUNCATE TABLE tabel_nilai_sedang;
    TRUNCATE TABLE tabel_nilai_tinggi;

    -- Insert data into tables
    INSERT INTO tabel_nilai_rendah
    SELECT
        id_jurusan,
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
    FROM acuan_nilai_jurusan;

    INSERT INTO tabel_nilai_sedang
    SELECT
        id_jurusan,
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
    FROM acuan_nilai_jurusan;

    INSERT INTO tabel_nilai_tinggi
    SELECT
        id_jurusan,
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
    FROM acuan_nilai_jurusan;
END;
DELIMITER ;

DELIMITER //
CREATE PROCEDURE buat_tabel_fuzzy_rapot()
BEGIN
    -- Create tables if they don't exist
    CREATE TABLE IF NOT EXISTS tabel_rapot_rendah (
                                                      id_siswa INT PRIMARY KEY ,
                                                      ipa FLOAT,
                                                      ips FLOAT,
                                                      bahasa FLOAT,
                                                      praktek FLOAT,
                                                      politik FLOAT,
                                                      seni FLOAT,
                                                      R FLOAT,
                                                      I FLOAT,
                                                      A FLOAT,
                                                      S FLOAT,
                                                      E FLOAT,
                                                      C FLOAT,
                                                      foreign key (id_siswa) references nilai(id_siswa)
    );

    CREATE TABLE IF NOT EXISTS tabel_rapot_sedang (
                                                      id_siswa INT PRIMARY KEY ,
                                                      ipa FLOAT,
                                                      ips FLOAT,
                                                      bahasa FLOAT,
                                                      praktek FLOAT,
                                                      politik FLOAT,
                                                      seni FLOAT,
                                                      R FLOAT,
                                                      I FLOAT,
                                                      A FLOAT,
                                                      S FLOAT,
                                                      E FLOAT,
                                                      C FLOAT,
                                                      foreign key (id_siswa) references nilai(id_siswa)
    );

    CREATE TABLE IF NOT EXISTS tabel_rapot_tinggi (
                                                      id_siswa INT PRIMARY KEY ,
                                                      ipa FLOAT,
                                                      ips FLOAT,
                                                      bahasa FLOAT,
                                                      praktek FLOAT,
                                                      politik FLOAT,
                                                      seni FLOAT,
                                                      R FLOAT,
                                                      I FLOAT,
                                                      A FLOAT,
                                                      S FLOAT,
                                                      E FLOAT,
                                                      C FLOAT,
                                                      foreign key (id_siswa) references nilai(id_siswa)
    );

    -- Truncate tables if they already exist
    TRUNCATE TABLE tabel_rapot_rendah;
    TRUNCATE TABLE tabel_rapot_sedang;
    TRUNCATE TABLE tabel_rapot_tinggi;

    -- Insert data into tables
    INSERT INTO tabel_rapot_rendah
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
    FROM nilai;

    INSERT INTO tabel_rapot_sedang
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
    FROM nilai;

    INSERT INTO tabel_rapot_tinggi
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
    FROM nilai;
END //
DELIMITER ;

DELIMITER //
create procedure buat_rekomendasi_jurusan()
BEGIN
    CALL buat_tabel_fuzzy_jurusan();
    CALL buat_tabel_fuzzy_rapot();

    -- Buat 2 tabel proses fuzzy; agregasi dan perhitungan
    CREATE TABLE IF NOT EXISTS hasil_agregasi (
                                                  id_jurusan INT PRIMARY KEY,
                                                  nama_jurusan VARCHAR(255),
                                                  Y DECIMAL(10,4),
                                                  Q DECIMAL(10,4),
                                                  Z DECIMAL(10,4),
                                                  foreign key (id_jurusan) references acuan_nilai_jurusan(id_jurusan),
                                                  foreign key (nama_jurusan) references acuan_nilai_jurusan(nama_jurusan)
    );

    CREATE TABLE IF NOT EXISTS hasil_perhitungan (
                                                     id_jurusan INT PRIMARY KEY,
                                                     nama_jurusan VARCHAR(255),
                                                     hasil DECIMAL(10,4),
                                                     foreign key (id_jurusan) references acuan_nilai_jurusan(id_jurusan),
                                                     foreign key (nama_jurusan) references acuan_nilai_jurusan(nama_jurusan)
    );

    CREATE TABLE IF NOT EXISTS hasil_rekomendasi (
                                                     id_siswa INT PRIMARY KEY,
                                                     Jurusan_1 VARCHAR(255),
                                                     Jurusan_2 VARCHAR(255),
                                                     Jurusan_3 VARCHAR(255),
                                                     foreign key (id_siswa) references nilai(id_siswa),
                                                     foreign key (Jurusan_1) references acuan_nilai_jurusan(nama_jurusan),
                                                     foreign key (Jurusan_2) references acuan_nilai_jurusan(nama_jurusan),
                                                     foreign key (Jurusan_3) references acuan_nilai_jurusan(nama_jurusan)
    );
    -- Hapus data di tabel agregasi dan perhitungan terlebih dahulu
    TRUNCATE TABLE hasil_agregasi;
    TRUNCATE TABLE hasil_perhitungan;

    -- Hitung nilai Y, Q, dan Z untuk setiap nama_jurusan, kemudian masukkan ke dalam tabel hasil_agregasi
    INSERT INTO hasil_agregasi (id_jurusan, nama_jurusan, Y, Q, Z)
    SELECT
        nj.id_jurusan,
        nj.nama_jurusan,
                ((nr.ipa * rr.ipa) + (nr.ips * rr.ips) + (nr.bahasa * rr.bahasa) +
                 (nr.praktek * rr.praktek) + (nr.politik * rr.politik) + (nr.seni * rr.seni) +
                 (nr.R * rr.R) + (nr.I * rr.I) + (nr.A * rr.A) +
                 (nr.S * rr.S) + (nr.E * rr.E) + (nr.C * rr.C))/12
        AS Y,
                ((ns.ipa * rs.ipa) + (ns.ips * rs.ips) + (ns.bahasa * rs.bahasa) +
                 (ns.praktek * rs.praktek) + (ns.politik * rs.politik) + (ns.seni * rs.seni) +
                 (ns.R * rs.R) + (ns.I * rs.I) + (ns.A * rs.A) +
                 (ns.S * rs.S) + (ns.E * rs.E) + (ns.C * rs.C))/12
        AS Q,
                ((nt.ipa * rt.ipa) + (nt.ips * rt.ips) + (nt.bahasa * rt.bahasa) +
                 (nt.praktek * rt.praktek) + (nt.politik * rt.politik) + (nt.seni * rt.seni) +
                 (nt.R * rt.R) + (nt.I * rt.I) + (nt.A * rt.A) +
                 (nt.S * rt.S) + (nt.E * rt.E) + (nt.C * rt.C))/12
        AS Z
    FROM
        acuan_nilai_jurusan nj
            CROSS JOIN tabel_rapot_rendah rr
            CROSS JOIN tabel_rapot_sedang rs
            CROSS JOIN tabel_rapot_tinggi rt
            JOIN tabel_nilai_rendah nr ON nj.id_jurusan = nr.id_jurusan
            JOIN tabel_nilai_sedang ns ON nj.id_jurusan = ns.id_jurusan
            JOIN tabel_nilai_tinggi nt ON nj.id_jurusan = nt.id_jurusan
    GROUP BY
        nj.id_jurusan, nj.nama_jurusan;

    -- Hitung hasil akhir dan masukkan ke dalam tabel hasil_perhitungan
    INSERT INTO hasil_perhitungan (id_jurusan, nama_jurusan, hasil)
    SELECT
        id_jurusan,
        nama_jurusan,
        ((0.5 * Z) + Q + ((1-0.5) * Y)) / 2 AS hasil
    FROM
        hasil_agregasi;

    -- Cari desimal 3 terbesar untuk setiap siswa dan masukkan ke dalam tabel hasil_rekomendasi
    INSERT INTO hasil_rekomendasi (id_siswa, Jurusan_1, Jurusan_2, Jurusan_3)
    SELECT
        n.id_siswa AS id_siswa,
        MAX(CASE WHEN rn = 1 THEN hp.nama_jurusan END) AS Jurusan_1,
        MAX(CASE WHEN rn = 2 THEN hp.nama_jurusan END) AS Jurusan_2,
        MAX(CASE WHEN rn = 3 THEN hp.nama_jurusan END) AS Jurusan_3
    FROM
        nilai n
            CROSS JOIN (
            SELECT
                nama_jurusan,
                hasil,
                ROW_NUMBER() OVER (ORDER BY hasil DESC) as rn
            FROM
                hasil_perhitungan
        ) hp
    WHERE
        hp.rn <= 3
    GROUP BY
        n.id_siswa;
END;
DELIMITER ;

CREATE TABLE penjelasan_jurusan (
                                    id_jurusan INT PRIMARY KEY,
                                    nama_jurusan VARCHAR(255),
                                    penjelasan TEXT,
                                    foreign key (id_jurusan) references acuan_nilai_jurusan(id_jurusan),
                                    foreign key (nama_jurusan) references acuan_nilai_jurusan(nama_jurusan)
);

CREATE TABLE admin (
                       id_admin INT PRIMARY KEY AUTO_INCREMENT,
                       username VARCHAR(255) NOT NULL,
                       password VARCHAR(255) NOT NULL,
                       email VARCHAR(255) NOT NULL
);

CREATE TRIGGER otomatis_hitung_fuzzy
    AFTER INSERT ON nilai
    FOR EACH ROW
BEGIN
    CALL buat_rekomendasi_jurusan();
END ;