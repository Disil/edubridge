CREATE DATABASE edubridge_db;
USE edubridge_db;
CREATE TABLE siswa (
   id_siswa INT PRIMARY KEY AUTO_INCREMENT,
   nama VARCHAR(255) NULL,
   email VARCHAR(255) NULL,
   password VARCHAR(255) NULL,
   tanggal_lahir DATE NULL,
   asal_sekolah VARCHAR(255) NULL,
   kelas ENUM('10', '11', '12') NULL
);
-- Table for raw grades from report card
CREATE TABLE nilai_rapot_asli (
                                  id INT AUTO_INCREMENT PRIMARY KEY,
                                  id_siswa INT,
                                  nama VARCHAR(255) NULL,
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
                                  foreign key (id_siswa) references siswa(id_siswa),
                                  foreign key (nama) references siswa(nama)
);

CREATE TABLE nilai_riasec (
                              id INT AUTO_INCREMENT PRIMARY KEY,
                              id_siswa INT,
                              nama VARCHAR(255) NULL,
                              R INT,
                              I INT,
                              A INT,
                              S INT,
                              E INT,
                              C INT,
                              FOREIGN KEY (id_siswa) REFERENCES siswa(id_siswa),
                              FOREIGN KEY (nama) REFERENCES siswa(nama)
);

CREATE TABLE pertanyaan_riasec (
                                   id_pertanyaan int primary key auto_increment,
                                   pertanyaan varchar(255) not null,
                                   kategori ENUM('R', 'I', 'A', 'S', 'E', 'C') not null
);

CREATE TABLE jawaban_riasec (
                                id_siswa int,
                                id_pertanyaan int,
                                jawaban ENUM ('Ya', 'Tidak'),
                                foreign key (id_siswa) references siswa(id_siswa),
                                foreign key (id_pertanyaan) references pertanyaan_riasec(id_pertanyaan)
);
-- Prosedur untuk menghitung nilai R, I, A, S, E, C dari form tes riasec
DELIMITER //
CREATE PROCEDURE hitung_nilai_riasec()
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
//
DELIMITER ;

CREATE TABLE nilai_rapot (
                             id INT AUTO_INCREMENT PRIMARY KEY,
                             id_siswa INT,
                             nama VARCHAR(255) NULL,
                             ipa float,
                             ips float,
                             bahasa float,
                             praktek float,
                             politik float,
                             seni float,
                             foreign key (id_siswa) references siswa(id_siswa),
                             foreign key (nama) references siswa(nama)
);
CREATE TABLE nilai (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       id_siswa INT,
                       nama VARCHAR(255) NULL,
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
                       foreign key (id_siswa) references siswa(id_siswa),
                       foreign key (nama) references siswa(nama)
);

DELIMITER //

CREATE TRIGGER gabung_nilai_rapot
    AFTER INSERT ON nilai_rapot_asli
    FOR EACH ROW
BEGIN
    INSERT INTO nilai_rapot (id_siswa, ipa, ips, bahasa, praktek, politik, seni)
    VALUES (
               NEW.id_siswa,
               (NEW.matematika + NEW.fisika + NEW.kimia + NEW.biologi) / 4,
               (NEW.matematika + NEW.ekonomi + NEW.geografi + NEW.sosiologi) / 4,
               (NEW.bahasa_indonesia + NEW.bahasa_inggris) / 2,
               (NEW.pjok + NEW.prakarya) / 2,
               (NEW.sejarah + NEW.ppkn) / 2,
               NEW.seni_budaya
           )
    ON DUPLICATE KEY UPDATE
                         ipa = (NEW.matematika + NEW.fisika + NEW.kimia + NEW.biologi) / 4,
                         ips = (NEW.matematika + NEW.ekonomi + NEW.geografi + NEW.sosiologi) / 4,
                         bahasa = (NEW.bahasa_indonesia + NEW.bahasa_inggris) / 2,
                         praktek = (NEW.pjok + NEW.prakarya) / 2,
                         politik = (NEW.sejarah + NEW.ppkn) / 2,
                         seni = NEW.seni_budaya;
END//

DELIMITER ;

-- Function to convert numeric grade to letter grade for nilai_rapot
DELIMITER //
CREATE FUNCTION ubah_nilai_rapot_ke_huruf(score FLOAT) RETURNS VARCHAR(2) DETERMINISTIC
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
CREATE FUNCTION ubah_nilai_riasec_ke_huruf(score INT) RETURNS VARCHAR(2) DETERMINISTIC
BEGIN
    IF score >= 13 THEN RETURN 'ST';
    ELSEIF score >= 10 THEN RETURN 'T';
    ELSEIF score >= 7 THEN RETURN 'CT';
    ELSEIF score >= 4 THEN RETURN 'KT';
    ELSE RETURN 'TT';
    END IF;
END //
DELIMITER ;

-- Trigger for nilai_rapot
DELIMITER //
CREATE TRIGGER ubah_nilai_rapot_ke_huruf
    AFTER INSERT ON nilai_rapot
    FOR EACH ROW
BEGIN
    INSERT INTO nilai (id_siswa, ipa, ips, bahasa, praktek, politik, seni)
    VALUES (
               NEW.id_siswa,
               ubah_nilai_rapot_ke_huruf(NEW.ipa),
               ubah_nilai_rapot_ke_huruf(NEW.ips),
               ubah_nilai_rapot_ke_huruf(NEW.bahasa),
               ubah_nilai_rapot_ke_huruf(NEW.praktek),
               ubah_nilai_rapot_ke_huruf(NEW.politik),
               ubah_nilai_rapot_ke_huruf(NEW.seni)
           )
    ON DUPLICATE KEY UPDATE
                         ipa = ubah_nilai_rapot_ke_huruf(NEW.ipa),
                         ips = ubah_nilai_rapot_ke_huruf(NEW.ips),
                         bahasa = ubah_nilai_rapot_ke_huruf(NEW.bahasa),
                         praktek = ubah_nilai_rapot_ke_huruf(NEW.praktek),
                         politik = ubah_nilai_rapot_ke_huruf(NEW.politik),
                         seni = ubah_nilai_rapot_ke_huruf(NEW.seni);
END //
DELIMITER ;

-- Trigger for nilai_riasec
DELIMITER //
CREATE TRIGGER ubah_nilai_riasec_ke_huruf
    AFTER INSERT ON nilai_riasec
    FOR EACH ROW
BEGIN
    INSERT INTO nilai (id_siswa, R, I, A, S, E, C)
    VALUES (
               NEW.id_siswa,
               ubah_nilai_riasec_ke_huruf(NEW.R),
               ubah_nilai_riasec_ke_huruf(NEW.I),
               ubah_nilai_riasec_ke_huruf(NEW.A),
               ubah_nilai_riasec_ke_huruf(NEW.S),
               ubah_nilai_riasec_ke_huruf(NEW.E),
               ubah_nilai_riasec_ke_huruf(NEW.C)
           )
    ON DUPLICATE KEY UPDATE
                         R = ubah_nilai_riasec_ke_huruf(NEW.R),
                         I = ubah_nilai_riasec_ke_huruf(NEW.I),
                         A = ubah_nilai_riasec_ke_huruf(NEW.A),
                         S = ubah_nilai_riasec_ke_huruf(NEW.S),
                         E = ubah_nilai_riasec_ke_huruf(NEW.E),
                         C = ubah_nilai_riasec_ke_huruf(NEW.C);
END //
DELIMITER ;

DELIMITER //
CREATE FUNCTION konversi_ke_fuzzy(nilai VARCHAR(2), jenis VARCHAR(10)) RETURNS DECIMAL(3,2) DETERMINISTIC
BEGIN
    DECLARE hasil DECIMAL(3,2);
    CASE
        WHEN nilai IN ('ST', 'SD') THEN
            SET hasil = CASE jenis
                            WHEN 'rendah' THEN 0.75
                            WHEN 'sedang' THEN 1.00
                            WHEN 'tinggi' THEN 1.00
                END;
        WHEN nilai IN ('T', 'D') THEN
            SET hasil = CASE jenis
                            WHEN 'rendah' THEN 0.50
                            WHEN 'sedang' THEN 0.75
                            WHEN 'tinggi' THEN 1.00
                END;
        WHEN nilai IN ('CT', 'CD') THEN
            SET hasil = CASE jenis
                            WHEN 'rendah' THEN 0.25
                            WHEN 'sedang' THEN 0.50
                            WHEN 'tinggi' THEN 0.75
                END;
        WHEN nilai IN ('KT', 'KD') THEN
            SET hasil = CASE jenis
                            WHEN 'rendah' THEN 0.00
                            WHEN 'sedang' THEN 0.25
                            WHEN 'tinggi' THEN 0.50
                END;
        WHEN nilai IN ('TT', 'TD') THEN
            SET hasil = CASE jenis
                            WHEN 'rendah' THEN 0.00
                            WHEN 'sedang' THEN 0.00
                            WHEN 'tinggi' THEN 0.25
                END;
        ELSE
            SET hasil = 0.00;
        END CASE;
    RETURN hasil;
END //
DELIMITER ;

-- Buat tabel untuk nilai rendah
CREATE TABLE tabel_nilai_rendah AS
SELECT
    id_jurusan,
    Jurusan,
    konversi_ke_fuzzy(IPA, 'rendah') AS IPA,
    konversi_ke_fuzzy(IPS, 'rendah') AS IPS,
    konversi_ke_fuzzy(Bahasa, 'rendah') AS Bahasa,
    konversi_ke_fuzzy(Praktek, 'rendah') AS Praktek,
    konversi_ke_fuzzy(Politik, 'rendah') AS Politik,
    konversi_ke_fuzzy(Seni, 'rendah') AS Seni,
    konversi_ke_fuzzy(R, 'rendah') AS R,
    konversi_ke_fuzzy(I, 'rendah') AS I,
    konversi_ke_fuzzy(A, 'rendah') AS A,
    konversi_ke_fuzzy(S, 'rendah') AS S,
    konversi_ke_fuzzy(E, 'rendah') AS E,
    konversi_ke_fuzzy(C, 'rendah') AS C
FROM acuan_nilai_jurusan;

-- Buat tabel untuk nilai sedang
CREATE TABLE tabel_nilai_sedang AS
SELECT
    id_jurusan,
    Jurusan,
    konversi_ke_fuzzy(IPA, 'sedang') AS IPA,
    konversi_ke_fuzzy(IPS, 'sedang') AS IPS,
    konversi_ke_fuzzy(Bahasa, 'sedang') AS Bahasa,
    konversi_ke_fuzzy(Praktek, 'sedang') AS Praktek,
    konversi_ke_fuzzy(Politik, 'sedang') AS Politik,
    konversi_ke_fuzzy(Seni, 'sedang') AS Seni,
    konversi_ke_fuzzy(R, 'sedang') AS R,
    konversi_ke_fuzzy(I, 'sedang') AS I,
    konversi_ke_fuzzy(A, 'sedang') AS A,
    konversi_ke_fuzzy(S, 'sedang') AS S,
    konversi_ke_fuzzy(E, 'sedang') AS E,
    konversi_ke_fuzzy(C, 'sedang') AS C
FROM acuan_nilai_jurusan;

-- Buat tabel untuk nilai tinggi
CREATE TABLE tabel_nilai_tinggi AS
SELECT
    id_jurusan,
    Jurusan,
    konversi_ke_fuzzy(IPA, 'tinggi') AS IPA,
    konversi_ke_fuzzy(IPS, 'tinggi') AS IPS,
    konversi_ke_fuzzy(Bahasa, 'tinggi') AS Bahasa,
    konversi_ke_fuzzy(Praktek, 'tinggi') AS Praktek,
    konversi_ke_fuzzy(Politik, 'tinggi') AS Politik,
    konversi_ke_fuzzy(Seni, 'tinggi') AS Seni,
    konversi_ke_fuzzy(R, 'tinggi') AS R,
    konversi_ke_fuzzy(I, 'tinggi') AS I,
    konversi_ke_fuzzy(A, 'tinggi') AS A,
    konversi_ke_fuzzy(S, 'tinggi') AS S,
    konversi_ke_fuzzy(E, 'tinggi') AS E,
    konversi_ke_fuzzy(C, 'tinggi') AS C
FROM acuan_nilai_jurusan;

DELIMITER //
-- Buat tabel untuk nilai rendah
CREATE TABLE tabel_rapot_rendah AS
SELECT
    id,
    id_siswa,
    konversi_ke_fuzzy(IPA, 'rendah') AS IPA,
    konversi_ke_fuzzy(IPS, 'rendah') AS IPS,
    konversi_ke_fuzzy(Bahasa, 'rendah') AS Bahasa,
    konversi_ke_fuzzy(Praktek, 'rendah') AS Praktek,
    konversi_ke_fuzzy(Politik, 'rendah') AS Politik,
    konversi_ke_fuzzy(Seni, 'rendah') AS Seni,
    konversi_ke_fuzzy(R, 'rendah') AS R,
    konversi_ke_fuzzy(I, 'rendah') AS I,
    konversi_ke_fuzzy(A, 'rendah') AS A,
    konversi_ke_fuzzy(S, 'rendah') AS S,
    konversi_ke_fuzzy(E, 'rendah') AS E,
    konversi_ke_fuzzy(C, 'rendah') AS C
FROM nilai;

-- Buat tabel untuk nilai sedang
CREATE TABLE tabel_rapot_sedang AS
SELECT
    id,
    id_siswa,
    konversi_ke_fuzzy(IPA, 'sedang') AS IPA,
    konversi_ke_fuzzy(IPS, 'sedang') AS IPS,
    konversi_ke_fuzzy(Bahasa, 'sedang') AS Bahasa,
    konversi_ke_fuzzy(Praktek, 'sedang') AS Praktek,
    konversi_ke_fuzzy(Politik, 'sedang') AS Politik,
    konversi_ke_fuzzy(Seni, 'sedang') AS Seni,
    konversi_ke_fuzzy(R, 'sedang') AS R,
    konversi_ke_fuzzy(I, 'sedang') AS I,
    konversi_ke_fuzzy(A, 'sedang') AS A,
    konversi_ke_fuzzy(S, 'sedang') AS S,
    konversi_ke_fuzzy(E, 'sedang') AS E,
    konversi_ke_fuzzy(C, 'sedang') AS C
FROM nilai;

-- Buat tabel untuk nilai tinggi
CREATE TABLE tabel_rapot_tinggi AS
SELECT
    id,
    id_siswa,
    konversi_ke_fuzzy(IPA, 'tinggi') AS IPA,
    konversi_ke_fuzzy(IPS, 'tinggi') AS IPS,
    konversi_ke_fuzzy(Bahasa, 'tinggi') AS Bahasa,
    konversi_ke_fuzzy(Praktek, 'tinggi') AS Praktek,
    konversi_ke_fuzzy(Politik, 'tinggi') AS Politik,
    konversi_ke_fuzzy(Seni, 'tinggi') AS Seni,
    konversi_ke_fuzzy(R, 'tinggi') AS R,
    konversi_ke_fuzzy(I, 'tinggi') AS I,
    konversi_ke_fuzzy(A, 'tinggi') AS A,
    konversi_ke_fuzzy(S, 'tinggi') AS S,
    konversi_ke_fuzzy(E, 'tinggi') AS E,
    konversi_ke_fuzzy(C, 'tinggi') AS C
FROM nilai;

-- Buat 3 tabel proses fuzzy; agregasi, perhitungan, rekomendasi
CREATE TABLE hasil_agregasi (
    id_jurusan INT PRIMARY KEY,
    Jurusan VARCHAR(255),
    Y DECIMAL(10,4),
    Q DECIMAL(10,4),
    Z DECIMAL(10,4),
    foreign key (id_jurusan) references acuan_nilai_jurusan(id_jurusan),
    foreign key (Jurusan) references acuan_nilai_jurusan(Jurusan)
);
CREATE TABLE hasil_perhitungan (
       id_jurusan INT PRIMARY KEY,
       Jurusan VARCHAR(255),
       hasil DECIMAL(10,4),
       foreign key (id_jurusan) references acuan_nilai_jurusan(id_jurusan),
       foreign key (Jurusan) references acuan_nilai_jurusan(Jurusan)
);
CREATE TABLE hasil_rekomendasi (
       id_siswa INT PRIMARY KEY,
       nama VARCHAR(255),
       Jurusan_1 VARCHAR(255),
       Jurusan_2 VARCHAR(255),
       Jurusan_3 VARCHAR(255),
       foreign key (id_siswa) references nilai(id_siswa),
       foreign key (nama) references nilai(nama),
       foreign key (Jurusan_1) references acuan_nilai_jurusan(Jurusan),
       foreign key (Jurusan_2) references acuan_nilai_jurusan(Jurusan),
       foreign key (Jurusan_3) references acuan_nilai_jurusan(Jurusan)
);

DELIMITER //
CREATE PROCEDURE buat_rekomendasi_jurusan()
BEGIN
    -- Hapus data di tabel agregasi dan perhitungan terlebih dahulu
    DELETE IGNORE FROM hasil_agregasi;
    DELETE IGNORE FROM hasil_perhitungan;

    -- Hitung nilai Y, Q, dan Z untuk setiap jurusan, kemudian masukkan ke dalam tabel hasil_agregasi
    INSERT INTO hasil_agregasi (id_jurusan, Jurusan, Y, Q, Z)
    SELECT
        nj.id_jurusan,
        nj.Jurusan,
        SUM(
                ((nr.IPA * rr.IPA) + (nr.IPS * rr.IPS) + (nr.Bahasa * rr.Bahasa) +
                 (nr.Praktek * rr.Praktek) + (nr.Politik * rr.Politik) + (nr.Seni * rr.Seni) +
                 (nr.R * rr.R) + (nr.I * rr.I) + (nr.A * rr.A) +
                 (nr.S * rr.S) + (nr.E * rr.E) + (nr.C * rr.C))/12
        ) AS Y,
        SUM(
                ((ns.IPA * rs.IPA) + (ns.IPS * rs.IPS) + (ns.Bahasa * rs.Bahasa) +
                 (ns.Praktek * rs.Praktek) + (ns.Politik * rs.Politik) + (ns.Seni * rs.Seni) +
                 (ns.R * rs.R) + (ns.I * rs.I) + (ns.A * rs.A) +
                 (ns.S * rs.S) + (ns.E * rs.E) + (ns.C * rs.C))/12
        ) AS Q,
        SUM(
                ((nt.IPA * rt.IPA) + (nt.IPS * rt.IPS) + (nt.Bahasa * rt.Bahasa) +
                 (nt.Praktek * rt.Praktek) + (nt.Politik * rt.Politik) + (nt.Seni * rt.Seni) +
                 (nt.R * rt.R) + (nt.I * rt.I) + (nt.A * rt.A) +
                 (nt.S * rt.S) + (nt.E * rt.E) + (nt.C * rt.C))/12
        ) AS Z
    FROM
        acuan_nilai_jurusan nj
            CROSS JOIN tabel_rapot_rendah rr
            CROSS JOIN tabel_rapot_sedang rs
            CROSS JOIN tabel_rapot_tinggi rt
            JOIN tabel_nilai_rendah nr ON nj.id_jurusan = nr.id_jurusan
            JOIN tabel_nilai_sedang ns ON nj.id_jurusan = ns.id_jurusan
            JOIN tabel_nilai_tinggi nt ON nj.id_jurusan = nt.id_jurusan
    GROUP BY
        nj.id_jurusan, nj.Jurusan;

    -- Hitung hasil akhir dan masukkan ke dalam tabel hasil_perhitungan
    INSERT INTO hasil_perhitungan (id_jurusan, Jurusan, hasil)
    SELECT
        id_jurusan,
        Jurusan,
        ((0.5 * Z) + Q + ((1-0.5) * Y)) / 2 AS hasil
    FROM
        hasil_agregasi;

    -- Cari desimal 3 terbesar untuk setiap siswa dan masukkan ke dalam tabel hasil_rekomendasi
    INSERT INTO hasil_rekomendasi (id_siswa, nama, Jurusan_1, Jurusan_2, Jurusan_3)
    SELECT
        n.id_siswa AS id_siswa,
        n.nama AS nama,
        MAX(CASE WHEN rn = 1 THEN hp.Jurusan END) AS Jurusan_1,
        MAX(CASE WHEN rn = 2 THEN hp.Jurusan END) AS Jurusan_2,
        MAX(CASE WHEN rn = 3 THEN hp.Jurusan END) AS Jurusan_3
    FROM
        nilai n
            CROSS JOIN (
            SELECT
                Jurusan,
                hasil,
                ROW_NUMBER() OVER (ORDER BY hasil DESC) as rn
            FROM
                hasil_perhitungan
        ) hp
    WHERE
        hp.rn <= 3
    GROUP BY
        n.id_siswa, n.nama;
END;
DELIMITER ;