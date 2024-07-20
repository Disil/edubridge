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
        JOIN
        tabel_nilai_rendah nr ON nj.id_jurusan = nr.id_jurusan
        JOIN
        tabel_nilai_sedang ns ON nj.id_jurusan = ns.id_jurusan
        JOIN
        tabel_nilai_tinggi nt ON nj.id_jurusan = nt.id_jurusan
        JOIN
        tabel_rapot_rendah rr ON nr.id_siswa = rr.id_siswa
        JOIN
        tabel_rapot_sedang rs ON ns.id_siswa = rs.id_siswa
        JOIN
        tabel_rapot_tinggi rt ON nt.id_siswa = rt.id_siswa
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