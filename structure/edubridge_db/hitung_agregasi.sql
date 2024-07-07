create
    definer = root@localhost procedure hitung_agregasi()
BEGIN
        -- Buat 2 tabel proses fuzzy; agregasi dan perhitungan
        CREATE TABLE IF NOT EXISTS hasil_agregasi (
              id_jurusan INT,
              Jurusan VARCHAR(255),
              Y DECIMAL(10,4),
              Q DECIMAL(10,4),
              Z DECIMAL(10,4),
              foreign key (id_jurusan) references acuan_nilai_jurusan(id_jurusan),
              foreign key (Jurusan) references acuan_nilai_jurusan(Jurusan)
        );

        CREATE TABLE IF NOT EXISTS hasil_perhitungan (
            id_jurusan INT,
             Jurusan VARCHAR(255),
             hasil DECIMAL(10,4),
             foreign key (id_jurusan) references acuan_nilai_jurusan(id_jurusan),
             foreign key (Jurusan) references acuan_nilai_jurusan(Jurusan)
        );
        -- Hapus data di tabel agregasi dan perhitungan terlebih dahulu
        TRUNCATE TABLE hasil_agregasi;
        TRUNCATE TABLE hasil_perhitungan;

        -- Hitung nilai Y, Q, dan Z untuk setiap jurusan, kemudian masukkan ke dalam tabel hasil_agregasi
        INSERT INTO hasil_agregasi (id_jurusan, Jurusan, Y, Q, Z)
        SELECT
            nj.id_jurusan,
            nj.Jurusan,
            SUM(
                    ((nr.ipa * rr.ipa) + (nr.ips * rr.ips) + (nr.bahasa * rr.bahasa) +
                     (nr.praktek * rr.praktek) + (nr.politik * rr.politik) + (nr.seni * rr.seni) +
                     (nr.R * rr.R) + (nr.I * rr.I) + (nr.A * rr.A) +
                     (nr.S * rr.S) + (nr.E * rr.E) + (nr.C * rr.C))/12
            ) AS Y,
            SUM(
                    ((ns.ipa * rs.ipa) + (ns.ips * rs.ips) + (ns.bahasa * rs.bahasa) +
                     (ns.praktek * rs.praktek) + (ns.politik * rs.politik) + (ns.seni * rs.seni) +
                     (ns.R * rs.R) + (ns.I * rs.I) + (ns.A * rs.A) +
                     (ns.S * rs.S) + (ns.E * rs.E) + (ns.C * rs.C))/12
            ) AS Q,
            SUM(
                    ((nt.ipa * rt.ipa) + (nt.ips * rt.ips) + (nt.bahasa * rt.bahasa) +
                     (nt.praktek * rt.praktek) + (nt.politik * rt.politik) + (nt.seni * rt.seni) +
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
        INSERT INTO hasil_rekomendasi (id_siswa, Jurusan_1, Jurusan_2, Jurusan_3)
        SELECT
            n.id_siswa AS id_siswa,
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
            n.id_siswa;
    END;

