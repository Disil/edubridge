-- Table for raw grades from report card
CREATE TABLE nilai_rapot_asli (
id INT AUTO_INCREMENT PRIMARY KEY,
id_siswa INT,
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

-- Table for riasec scores from test
CREATE TABLE nilai_riasec (
id INT AUTO_INCREMENT PRIMARY KEY,
id_siswa INT,
R INT,
I INT,
A INT,
S INT,
E INT,
C INT,
FOREIGN KEY (id_siswa) REFERENCES siswa(id_siswa)
);

-- Table for combined grades from report card
CREATE TABLE nilai_rapot (
id INT AUTO_INCREMENT PRIMARY KEY,
id_siswa INT,
ipa FLOAT,
ips FLOAT,
bahasa FLOAT,
praktek FLOAT,
politik FLOAT,
seni FLOAT,
foreign key (id_siswa) references siswa(id_siswa)
);

-- Table for letter grade conversion
CREATE TABLE nilai (
id INT AUTO_INCREMENT PRIMARY KEY,
id_siswa INT,
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

DELIMITER //

-- Function to convert numeric grade to letter grade for nilai_rapot
CREATE FUNCTION ubah_nilai_rapot_ke_huruf(score FLOAT) RETURNS VARCHAR(2) DETERMINISTIC
BEGIN
IF score >= 94 THEN RETURN 'ST';
ELSEIF score >= 87 THEN RETURN 'T';
ELSEIF score >= 80 THEN RETURN 'CT';
ELSEIF score >= 73 THEN RETURN 'KT';
ELSE RETURN 'TT';
END IF;
END //

-- Function to convert numeric grade to letter grade for nilai_riasec
CREATE FUNCTION ubah_nilai_riasec_ke_huruf(score INT) RETURNS VARCHAR(2) DETERMINISTIC
BEGIN
IF score >= 13 THEN RETURN 'ST';
ELSEIF score >= 10 THEN RETURN 'T';
ELSEIF score >= 7 THEN RETURN 'CT';
ELSEIF score >= 4 THEN RETURN 'KT';
ELSE RETURN 'TT';
END IF;
END //

-- Trigger for nilai_rapot
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

-- Trigger for nilai_riasec
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
CREATE FUNCTION konversi_ke_fuzzy(nilai VARCHAR(2), jenis VARCHAR(10)) RETURNS DECIMAL(3,2) DETERMINISTIC READS SQL DATA
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
No,
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
No,
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
No,
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

-- Asumsikan tabel_rapot_rendah, tabel_rapot_sedang, dan tabel_rapot_tinggi sudah ada

-- Buat tabel hasil FUZZY MCDM
CREATE TABLE hasil_agregasi (
Jurusan VARCHAR(255),
Y DECIMAL(10,4),
Q DECIMAL(10,4),
Z DECIMAL(10,4)
);

-- Hitung nilai Y, Q, dan Z untuk setiap jurusan
INSERT INTO hasil_agregasi (Jurusan, Y, Q, Z)
SELECT
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
JOIN tabel_nilai_rendah nr ON nj.No = nr.No
JOIN tabel_nilai_sedang ns ON nj.No = ns.No
JOIN tabel_nilai_tinggi nt ON nj.No = nt.No
GROUP BY
nj.Jurusan;

-- Buat tabel hasil_perhitungan
CREATE TABLE hasil_perhitungan (
Jurusan VARCHAR(255),
hasil DECIMAL(10,4)
);

-- Hitung hasil akhir dan masukkan ke dalam tabel hasil_perhitungan
INSERT INTO hasil_perhitungan (Jurusan, hasil)
SELECT
Jurusan,
((0.5 * Z) + Q + ((1-0.5) * Y)) / 2 AS hasil
FROM
hasil_agregasi;

-- Buat tabel hasil_rekomendasi
CREATE TABLE hasil_rekomendasi (
id_siswa INT,
Jurusan_1 VARCHAR(255),
Jurusan_2 VARCHAR(255),
Jurusan_3 VARCHAR(255)
);

-- Masukkan data ke tabel hasil_rekomendasi
INSERT INTO hasil_rekomendasi (id_siswa, Jurusan_1, Jurusan_2, Jurusan_3)
SELECT
tr.id_siswa AS id_siswa,
MAX(CASE WHEN rn = 1 THEN hp.Jurusan END) AS Jurusan_1,
MAX(CASE WHEN rn = 2 THEN hp.Jurusan END) AS Jurusan_2,
MAX(CASE WHEN rn = 3 THEN hp.Jurusan END) AS Jurusan_3
FROM
tabel_rapot_rendah tr
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
tr.id_siswa;

DELIMITER //

-- Trigger untuk mengupdate hasil_agregasi saat ada perubahan di tabel nilai atau rapot
CREATE TRIGGER update_hasil_agregasi
    AFTER INSERT ON tabel_nilai_rendah
    FOR EACH ROW
BEGIN
    -- Hapus data lama
    DELETE FROM hasil_agregasi WHERE OLD;

    -- Hitung ulang dan masukkan data baru
    INSERT INTO hasil_agregasi (Jurusan, Q, Y, Z)
    SELECT
        nj.Jurusan,
        SUM(
                (nr.IPA * rr.IPA) + (nr.IPS * rr.IPS) + (nr.Bahasa * rr.Bahasa) +
                (nr.Praktek * rr.Praktek) + (nr.Politik * rr.Politik) + (nr.Seni * rr.Seni) +
                (nr.R * rr.R) + (nr.I * rr.I) + (nr.A * rr.A) +
                (nr.S * rr.S) + (nr.E * rr.E) + (nr.C * rr.C)
        ) AS Q,
        SUM(
                (ns.IPA * rs.IPA) + (ns.IPS * rs.IPS) + (ns.Bahasa * rs.Bahasa) +
                (ns.Praktek * rs.Praktek) + (ns.Politik * rs.Politik) + (ns.Seni * rs.Seni) +
                (ns.R * rs.R) + (ns.I * rs.I) + (ns.A * rs.A) +
                (ns.S * rs.S) + (ns.E * rs.E) + (ns.C * rs.C)
        ) AS Y,
        SUM(
                (nt.IPA * rt.IPA) + (nt.IPS * rt.IPS) + (nt.Bahasa * rt.Bahasa) +
                (nt.Praktek * rt.Praktek) + (nt.Politik * rt.Politik) + (nt.Seni * rt.Seni) +
                (nt.R * rt.R) + (nt.I * rt.I) + (nt.A * rt.A) +
                (nt.S * rt.S) + (nt.E * rt.E) + (nt.C * rt.C)
        ) AS Z
    FROM
        acuan_nilai_jurusan nj
            CROSS JOIN tabel_rapot_rendah rr
            CROSS JOIN tabel_rapot_sedang rs
            CROSS JOIN tabel_rapot_tinggi rt
            JOIN tabel_nilai_rendah nr ON nj.No = nr.No
            JOIN tabel_nilai_sedang ns ON nj.No = ns.No
            JOIN tabel_nilai_tinggi nt ON nj.No = nt.No
    GROUP BY
        nj.Jurusan;
END //

-- Trigger untuk mengupdate hasil_perhitungan saat ada perubahan di hasil_agregasi
CREATE TRIGGER update_hasil_perhitungan
    AFTER INSERT ON hasil_agregasi
    FOR EACH ROW
BEGIN
    -- Hapus data lama
    DELETE FROM hasil_perhitungan WHERE OLD;

    -- Hitung ulang dan masukkan data baru
    INSERT INTO hasil_perhitungan (Jurusan, hasil)
    SELECT
        Jurusan,
        ((0.5 * Q) + Y + (0.5 * Z)) / 2 AS hasil
    FROM
        hasil_agregasi;
END //

-- Trigger untuk mengupdate hasil_rekomendasi saat ada perubahan di hasil_perhitungan
CREATE TRIGGER update_hasil_rekomendasi
    AFTER INSERT ON hasil_perhitungan
    FOR EACH ROW
BEGIN

    -- Hitung ulang dan masukkan data baru
    INSERT INTO hasil_rekomendasi (id_siswa, Jurusan_1, Jurusan_2, Jurusan_3)
    SELECT
        tr.id_siswa AS id_siswa,
        MAX(CASE WHEN rn = 1 THEN hp.Jurusan END) AS Jurusan_1,
        MAX(CASE WHEN rn = 2 THEN hp.Jurusan END) AS Jurusan_2,
        MAX(CASE WHEN rn = 3 THEN hp.Jurusan END) AS Jurusan_3
    FROM
        tabel_rapot_rendah tr
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
        tr.id_siswa;
END //

DELIMITER ;