create table siswa
(
    id_siswa      int auto_increment
        primary key,
    nama_siswa    varchar(255)                          null,
    email         varchar(255)                          null,
    password      varchar(255)                          null,
    tanggal_lahir date                                  null,
    asal_sekolah  varchar(255)                          null,
    kelas         enum ('10', '11', '12')               null,
    jenis_kelamin enum ('Pria', 'Wanita')               null,
    tgl_buat_akun timestamp default current_timestamp() not null
);

create table soal_riasec
(
    id_soal  int auto_increment
        primary key,
    soal     varchar(255)                        not null,
    kategori enum ('R', 'I', 'A', 'S', 'E', 'C') not null
);
create table jawaban_riasec
(
    id_siswa int                  not null,
    id_soal  int                  not null,
    jawaban  enum ('Ya', 'Tidak') not null
);
create index id_siswa
    on jawaban_riasec (id_siswa);
create index id_soal
    on jawaban_riasec (id_soal);

create table acuan_nilai_jurusan
(
    id_jurusan    int          not null
        primary key,
    nama_jurusan  varchar(255) not null,
    ipa           varchar(2)   not null,
    ips           varchar(2)   not null,
    bahasa        varchar(2)   not null,
    praktek       varchar(2)   not null,
    politik       varchar(2)   not null,
    seni          varchar(2)   not null,
    R             varchar(2)   not null,
    I             varchar(2)   not null,
    A             varchar(2)   not null,
    S             varchar(2)   not null,
    E             varchar(2)   not null,
    C             varchar(2)   not null,
    logika        varchar(2)   not null,
    sains         varchar(2)   not null,
    soshum        varchar(2)   not null,
    bisnis        varchar(2)   not null,
    kreatif       varchar(2)   not null,
    terapan       varchar(2)   not null,
    administratif varchar(2)   not null,
    sastra        varchar(2)   not null
);

create table nilai_rapot_asli
(
    id_siswa         int not null
        primary key,
    matematika       int null,
    fisika           int null,
    kimia            int null,
    biologi          int null,
    ekonomi          int null,
    geografi         int null,
    sosiologi        int null,
    bahasa_indonesia int null,
    bahasa_inggris   int null,
    pjok             int null,
    prakarya         int null,
    sejarah          int null,
    ppkn             int null,
    seni_budaya      int null
);
create trigger olah_nilai_rapot
    after insert
    on nilai_rapot_asli
    for each row
BEGIN
    INSERT INTO nilai_rapot (id_siswa, ipa, ips, bahasa, praktek, politik, seni)
    VALUES (new.id_siswa, (new.matematika + new.fisika + new.kimia + new.biologi) / 4,
            (new.matematika + new.ekonomi + new.geografi + new.sosiologi) / 4,
            (new.bahasa_indonesia + new.bahasa_inggris) / 2,
            (new.pjok + new.prakarya) / 2,
            (new.sejarah + new.ppkn) / 2,
            new.seni_budaya);
END;
create trigger olah_ulang_nilai_rapot
    after update
    on nilai_rapot_asli
    for each row
BEGIN
    INSERT INTO nilai_rapot (id_siswa, ipa, ips, bahasa, praktek, politik, seni)
    VALUES (new.id_siswa, (new.matematika + new.fisika + new.kimia + new.biologi) / 4,
            (new.matematika + new.ekonomi + new.geografi + new.sosiologi) / 4,
            (new.bahasa_indonesia + new.bahasa_inggris) / 2,
            (new.pjok + new.prakarya) / 2,
            (new.sejarah + new.ppkn) / 2,
            new.seni_budaya)
    ON DUPLICATE KEY UPDATE
                         ipa = (NEW.matematika + NEW.fisika + NEW.kimia + NEW.biologi) / 4,
                         ips = (NEW.matematika + NEW.ekonomi + NEW.geografi + NEW.sosiologi) / 4,
                         bahasa = (NEW.bahasa_indonesia + NEW.bahasa_inggris) / 2,
                         praktek = (NEW.pjok + NEW.prakarya) / 2,
                         politik = (NEW.sejarah + NEW.ppkn) / 2,
                         seni = NEW.seni_budaya;


END;

create table nilai_rapot
(
    id_siswa int   not null
        primary key,
    ipa      float null,
    ips      float null,
    bahasa   float null,
    praktek  float null,
    politik  float null,
    seni     float null
);
create trigger ubah_nilai_ke_huruf_1
    after insert
    on nilai_rapot
    for each row
begin
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
    DECLARE v_logika INT;
    DECLARE v_sains INT;
    DECLARE v_soshum INT;
    DECLARE v_bisnis INT;
    DECLARE v_kreatif INT;
    DECLARE v_terapan INT;
    DECLARE v_administratif INT;
    DECLARE v_sastra INT;

    SELECT ipa, ips, bahasa, praktek, politik, seni
    INTO v_ipa, v_ips, v_bahasa, v_praktek, v_politik, v_seni
    FROM nilai_rapot
    WHERE id_siswa = NEW.id_siswa;

    SELECT R, I, A, S, E, C
    INTO v_R, v_I, v_A, v_S, v_E, v_C
    FROM nilai_riasec
    WHERE id_siswa = NEW.id_siswa;

    SELECT logika, sains, soshum, bisnis, kreatif, terapan, administratif, sastra
    INTO v_logika, v_sains, v_soshum, v_bisnis, v_kreatif, v_terapan, v_administratif, v_sastra
    FROM nilai_minat
    WHERE id_siswa = NEW.id_siswa;

    IF v_R IS NOT NULL AND v_I IS NOT NULL AND v_A IS NOT NULL AND v_S IS NOT NULL AND v_E IS NOT NULL AND v_C IS NOT NULL AND v_logika IS NOT NULL AND v_sains IS NOT NULL AND v_soshum IS NOT NULL AND v_bisnis IS NOT NULL AND v_kreatif IS NOT NULL AND v_terapan IS NOT NULL AND v_administratif IS NOT NULL AND v_sastra IS NOT NULL THEN
        INSERT INTO nilai (id_siswa, ipa, ips, bahasa, praktek, politik, seni, R, I, A, S, E, C, logika, sains, soshum, bisnis, kreatif, terapan, administratif, sastra)
        VALUES (NEW.id_siswa,
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
                ubah_riasec_ke_huruf(v_C),
                ubah_minat_ke_huruf(v_logika),
                ubah_minat_ke_huruf(v_sains),
                ubah_minat_ke_huruf(v_soshum),
                ubah_minat_ke_huruf(v_bisnis),
                ubah_minat_ke_huruf(v_kreatif),
                ubah_minat_ke_huruf(v_terapan),
                ubah_minat_ke_huruf(v_administratif),
                ubah_minat_ke_huruf(v_sastra)
               );
    END IF;
end;
create trigger update_nilai_ke_huruf_1
    after update
    on nilai_rapot
    for each row
begin
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
    DECLARE v_logika INT;
    DECLARE v_sains INT;
    DECLARE v_soshum INT;
    DECLARE v_bisnis INT;
    DECLARE v_kreatif INT;
    DECLARE v_terapan INT;
    DECLARE v_administratif INT;
    DECLARE v_sastra INT;

    SELECT ipa, ips, bahasa, praktek, politik, seni
    INTO v_ipa, v_ips, v_bahasa, v_praktek, v_politik, v_seni
    FROM nilai_rapot
    WHERE id_siswa = NEW.id_siswa;

    SELECT R, I, A, S, E, C
    INTO v_R, v_I, v_A, v_S, v_E, v_C
    FROM nilai_riasec
    WHERE id_siswa = NEW.id_siswa;

    SELECT logika, sains, soshum, bisnis, kreatif, terapan, administratif, sastra
    INTO v_logika, v_sains, v_soshum, v_bisnis, v_kreatif, v_terapan, v_administratif, v_sastra
    FROM nilai_minat
    WHERE id_siswa = NEW.id_siswa;

    IF v_R IS NOT NULL AND v_I IS NOT NULL AND v_A IS NOT NULL AND v_S IS NOT NULL AND v_E IS NOT NULL AND v_C IS NOT NULL AND v_logika IS NOT NULL AND v_sains IS NOT NULL AND v_soshum IS NOT NULL AND v_bisnis IS NOT NULL AND v_kreatif IS NOT NULL AND v_terapan IS NOT NULL AND v_administratif IS NOT NULL AND v_sastra IS NOT NULL THEN
        IF EXISTS (SELECT 1 FROM nilai WHERE id_siswa = NEW.id_siswa) THEN
            UPDATE nilai
            SET ipa = ubah_rapot_ke_huruf(v_ipa),
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
                C = ubah_riasec_ke_huruf(v_C),
                logika = ubah_minat_ke_huruf(v_logika),
                sains = ubah_minat_ke_huruf(v_sains),
                soshum = ubah_minat_ke_huruf(v_soshum),
                bisnis = ubah_minat_ke_huruf(v_bisnis),
                kreatif = ubah_minat_ke_huruf(v_kreatif),
                terapan = ubah_minat_ke_huruf(v_terapan),
                administratif = ubah_minat_ke_huruf(v_administratif),
                sastra = ubah_minat_ke_huruf(v_sastra)
            WHERE id_siswa = NEW.id_siswa;
        END IF;
    END IF;
end;

create table nilai_minat
(
    id_siswa      int not null
        primary key,
    logika        int not null,
    sains         int not null,
    soshum        int not null,
    bisnis        int not null,
    kreatif       int not null,
    terapan       int not null,
    administratif int not null,
    sastra        int not null
);
create trigger ubah_nilai_ke_huruf_3
    after insert
    on nilai_minat
    for each row
begin

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
    DECLARE v_logika INT;
    DECLARE v_sains INT;
    DECLARE v_soshum INT;
    DECLARE v_bisnis INT;
    DECLARE v_kreatif INT;
    DECLARE v_terapan INT;
    DECLARE v_administratif INT;
    DECLARE v_sastra INT;

    SELECT ipa, ips, bahasa, praktek, politik, seni
    INTO v_ipa, v_ips, v_bahasa, v_praktek, v_politik, v_seni
    FROM nilai_rapot
    WHERE id_siswa = NEW.id_siswa;

    SELECT R, I, A, S, E, C
    INTO v_R, v_I, v_A, v_S, v_E, v_C
    FROM nilai_riasec
    WHERE id_siswa = NEW.id_siswa;

    SELECT logika, sains, soshum, bisnis, kreatif, terapan, administratif, sastra
    INTO v_logika, v_sains, v_soshum, v_bisnis, v_kreatif, v_terapan, v_administratif, v_sastra
    FROM nilai_minat
    WHERE id_siswa = NEW.id_siswa;

    IF v_ipa IS NOT NULL AND v_ips IS NOT NULL AND v_bahasa IS NOT NULL AND v_praktek IS NOT NULL AND v_politik IS NOT NULL AND v_seni IS NOT NULL AND v_R IS NOT NULL AND v_I IS NOT NULL AND v_A IS NOT NULL AND v_S IS NOT NULL AND v_E IS NOT NULL AND v_C IS NOT NULL THEN
        INSERT INTO nilai (id_siswa, ipa, ips, bahasa, praktek, politik, seni, R, I, A, S, E, C, logika, sains, soshum, bisnis, kreatif, terapan, administratif, sastra)
        VALUES (NEW.id_siswa,
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
                ubah_riasec_ke_huruf(v_C),
                ubah_minat_ke_huruf(v_logika),
                ubah_minat_ke_huruf(v_sains),
                ubah_minat_ke_huruf(v_soshum),
                ubah_minat_ke_huruf(v_bisnis),
                ubah_minat_ke_huruf(v_kreatif),
                ubah_minat_ke_huruf(v_terapan),
                ubah_minat_ke_huruf(v_administratif),
                ubah_minat_ke_huruf(v_sastra)
               );
    END IF;
end;
create trigger update_nilai_ke_huruf_3
    after update
    on nilai_minat
    for each row
begin

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
    DECLARE v_logika INT;
    DECLARE v_sains INT;
    DECLARE v_soshum INT;
    DECLARE v_bisnis INT;
    DECLARE v_kreatif INT;
    DECLARE v_terapan INT;
    DECLARE v_administratif INT;
    DECLARE v_sastra INT;

    SELECT ipa, ips, bahasa, praktek, politik, seni
    INTO v_ipa, v_ips, v_bahasa, v_praktek, v_politik, v_seni
    FROM nilai_rapot
    WHERE id_siswa = NEW.id_siswa;

    SELECT R, I, A, S, E, C
    INTO v_R, v_I, v_A, v_S, v_E, v_C
    FROM nilai_riasec
    WHERE id_siswa = NEW.id_siswa;

    SELECT logika, sains, soshum, bisnis, kreatif, terapan, administratif, sastra
    INTO v_logika, v_sains, v_soshum, v_bisnis, v_kreatif, v_terapan, v_administratif, v_sastra
    FROM nilai_minat
    WHERE id_siswa = NEW.id_siswa;

    IF v_ipa IS NOT NULL AND v_ips IS NOT NULL AND v_bahasa IS NOT NULL AND v_praktek IS NOT NULL AND v_politik IS NOT NULL AND v_seni IS NOT NULL AND v_R IS NOT NULL AND v_I IS NOT NULL AND v_A IS NOT NULL AND v_S IS NOT NULL AND v_E IS NOT NULL AND v_C IS NOT NULL THEN
        IF EXISTS (SELECT 1 FROM nilai WHERE id_siswa = NEW.id_siswa) THEN
            UPDATE nilai
            SET ipa = ubah_rapot_ke_huruf(v_ipa),
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
                C = ubah_riasec_ke_huruf(v_C),
                logika = ubah_minat_ke_huruf(v_logika),
                sains = ubah_minat_ke_huruf(v_sains),
                soshum = ubah_minat_ke_huruf(v_soshum),
                bisnis = ubah_minat_ke_huruf(v_bisnis),
                kreatif = ubah_minat_ke_huruf(v_kreatif),
                terapan = ubah_minat_ke_huruf(v_terapan),
                administratif = ubah_minat_ke_huruf(v_administratif),
                sastra = ubah_minat_ke_huruf(v_sastra)
            WHERE id_siswa = NEW.id_siswa;
        END IF;
    END IF;
end;

create table nilai
(
    id_siswa      int        not null
        primary key,
    ipa           varchar(2) null,
    ips           varchar(2) null,
    bahasa        varchar(2) null,
    praktek       varchar(2) null,
    politik       varchar(2) null,
    seni          varchar(2) null,
    R             varchar(2) null,
    I             varchar(2) null,
    A             varchar(2) null,
    S             varchar(2) null,
    E             varchar(2) null,
    C             varchar(2) null,
    logika        varchar(2) null,
    sains         varchar(2) null,
    soshum        varchar(2) null,
    bisnis        varchar(2) null,
    kreatif       varchar(2) null,
    terapan       varchar(2) null,
    administratif varchar(2) null,
    sastra        varchar(2) null
);

create procedure buat_tabel_fuzzy_jurusan()
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
                                                      logika FLOAT,
                                                      sains FLOAT,
                                                      soshum FLOAT,
                                                      bisnis FLOAT,
                                                      kreatif FLOAT,
                                                      terapan FLOAT,
                                                      administratif FLOAT,
                                                      sastra FLOAT,
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
                                                      logika FLOAT,
                                                      sains FLOAT,
                                                      soshum FLOAT,
                                                      bisnis FLOAT,
                                                      kreatif FLOAT,
                                                      terapan FLOAT,
                                                      administratif FLOAT,
                                                      sastra FLOAT,
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
                                                      logika FLOAT,
                                                      sains FLOAT,
                                                      soshum FLOAT,
                                                      bisnis FLOAT,
                                                      kreatif FLOAT,
                                                      terapan FLOAT,
                                                      administratif FLOAT,
                                                      sastra FLOAT,
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
        konversi_ke_fuzzy(C, 'rendah') AS C,
        konversi_ke_fuzzy(logika, 'rendah') AS logika,
        konversi_ke_fuzzy(sains, 'rendah') AS sains,
        konversi_ke_fuzzy(soshum, 'rendah') AS soshum,
        konversi_ke_fuzzy(bisnis, 'rendah') AS bisnis,
        konversi_ke_fuzzy(kreatif, 'rendah') AS kreatif,
        konversi_ke_fuzzy(terapan, 'rendah') AS terapan,
        konversi_ke_fuzzy(administratif, 'rendah') AS administratif,
        konversi_ke_fuzzy(sastra, 'rendah') AS sastra
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
        konversi_ke_fuzzy(C, 'sedang') AS C,
        konversi_ke_fuzzy(logika, 'rendah') AS logika,
        konversi_ke_fuzzy(sains, 'rendah') AS sains,
        konversi_ke_fuzzy(soshum, 'rendah') AS soshum,
        konversi_ke_fuzzy(bisnis, 'rendah') AS bisnis,
        konversi_ke_fuzzy(kreatif, 'rendah') AS kreatif,
        konversi_ke_fuzzy(terapan, 'rendah') AS terapan,
        konversi_ke_fuzzy(administratif, 'rendah') AS administratif,
        konversi_ke_fuzzy(sastra, 'rendah') AS sastra
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
        konversi_ke_fuzzy(C, 'tinggi') AS C,
        konversi_ke_fuzzy(logika, 'rendah') AS logika,
        konversi_ke_fuzzy(sains, 'rendah') AS sains,
        konversi_ke_fuzzy(soshum, 'rendah') AS soshum,
        konversi_ke_fuzzy(bisnis, 'rendah') AS bisnis,
        konversi_ke_fuzzy(kreatif, 'rendah') AS kreatif,
        konversi_ke_fuzzy(terapan, 'rendah') AS terapan,
        konversi_ke_fuzzy(administratif, 'rendah') AS administratif,
        konversi_ke_fuzzy(sastra, 'rendah') AS sastra
    FROM acuan_nilai_jurusan;
END;
create procedure buat_tabel_fuzzy_rapot()
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
                                                      logika FLOAT,
                                                      sains FLOAT,
                                                      soshum FLOAT,
                                                      bisnis FLOAT,
                                                      kreatif FLOAT,
                                                      terapan FLOAT,
                                                      administratif FLOAT,
                                                      sastra FLOAT,
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
                                                      logika FLOAT,
                                                      sains FLOAT,
                                                      soshum FLOAT,
                                                      bisnis FLOAT,
                                                      kreatif FLOAT,
                                                      terapan FLOAT,
                                                      administratif FLOAT,
                                                      sastra FLOAT,
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
                                                      logika FLOAT,
                                                      sains FLOAT,
                                                      soshum FLOAT,
                                                      bisnis FLOAT,
                                                      kreatif FLOAT,
                                                      terapan FLOAT,
                                                      administratif FLOAT,
                                                      sastra FLOAT,
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
        konversi_ke_fuzzy(C, 'rendah') AS C,
        konversi_ke_fuzzy(logika, 'rendah') AS logika,
        konversi_ke_fuzzy(sains, 'rendah') AS sains,
        konversi_ke_fuzzy(soshum, 'rendah') AS soshum,
        konversi_ke_fuzzy(bisnis, 'rendah') AS bisnis,
        konversi_ke_fuzzy(kreatif, 'rendah') AS kreatif,
        konversi_ke_fuzzy(terapan, 'rendah') AS terapan,
        konversi_ke_fuzzy(administratif, 'rendah') AS administratif,
        konversi_ke_fuzzy(sastra, 'rendah') AS sastra
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
        konversi_ke_fuzzy(C, 'sedang') AS C,
        konversi_ke_fuzzy(logika, 'sedang') AS logika,
        konversi_ke_fuzzy(sains, 'sedang') AS sains,
        konversi_ke_fuzzy(soshum, 'sedang') AS soshum,
        konversi_ke_fuzzy(bisnis, 'sedang') AS bisnis,
        konversi_ke_fuzzy(kreatif, 'sedang') AS kreatif,
        konversi_ke_fuzzy(terapan, 'sedang') AS terapan,
        konversi_ke_fuzzy(administratif, 'sedang') AS administratif,
        konversi_ke_fuzzy(sastra, 'sedang') AS sastra
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
        konversi_ke_fuzzy(C, 'tinggi') AS C,
        konversi_ke_fuzzy(logika, 'tinggi') AS logika,
        konversi_ke_fuzzy(sains, 'tinggi') AS sains,
        konversi_ke_fuzzy(soshum, 'tinggi') AS soshum,
        konversi_ke_fuzzy(bisnis, 'tinggi') AS bisnis,
        konversi_ke_fuzzy(kreatif, 'tinggi') AS kreatif,
        konversi_ke_fuzzy(terapan, 'tinggi') AS terapan,
        konversi_ke_fuzzy(administratif, 'tinggi') AS administratif,
        konversi_ke_fuzzy(sastra, 'tinggi') AS sastra
    FROM nilai;
END;
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

create procedure buat_rekomendasi_jurusan(IN id_siswa_dihitung int)
BEGIN
    CALL buat_tabel_fuzzy_jurusan();
    CALL buat_tabel_fuzzy_rapot();

    -- Buat 2 tabel proses fuzzy; agregasi dan perhitungan
    CREATE TABLE IF NOT EXISTS hasil_agregasi (
                                                  id_siswa INT,
                                                  id_jurusan INT,
                                                  nama_jurusan VARCHAR(255),
                                                  Y DECIMAL(10,4),
                                                  Q DECIMAL(10,4),
                                                  Z DECIMAL(10,4),
                                                  UNIQUE KEY (id_siswa, id_jurusan),

                                                  foreign key (id_siswa) references nilai(id_siswa),
                                                  foreign key (id_jurusan) references acuan_nilai_jurusan(id_jurusan),
                                                  foreign key (nama_jurusan) references acuan_nilai_jurusan(nama_jurusan)
    );

    CREATE TABLE IF NOT EXISTS hasil_perhitungan (
                                                     id_siswa INT,
                                                     id_jurusan INT,
                                                     nama_jurusan VARCHAR(255),
                                                     hasil DECIMAL(10,4),
                                                     unique key (id_siswa, id_jurusan),

                                                     foreign key (id_siswa) references nilai(id_siswa),
                                                     foreign key (id_jurusan) references acuan_nilai_jurusan(id_jurusan),
                                                     foreign key (nama_jurusan) references acuan_nilai_jurusan(nama_jurusan)
    );

    -- TABEL menyimpan hasil rekomendasi jurusan
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

    -- Hapus isi tabel hasil_agregasi dulu
    TRUNCATE TABLE hasil_agregasi;
    TRUNCATE TABLE hasil_perhitungan;

    -- Hitung nilai Y, Q, dan Z untuk setiap nama_jurusan, kemudian masukkan ke dalam tabel hasil_agregasi
    INSERT INTO hasil_agregasi (id_siswa, id_jurusan, nama_jurusan, Y, Q, Z)
    SELECT
        id_siswa_dihitung,
        nj.id_jurusan,
        nj.nama_jurusan,
        (
            (SELECT nr.ipa FROM tabel_nilai_rendah nr WHERE nr.id_jurusan = nj.id_jurusan) * rr.ipa +
            (SELECT nr.ips FROM tabel_nilai_rendah nr WHERE nr.id_jurusan = nj.id_jurusan) * rr.ips +
            (SELECT nr.bahasa FROM tabel_nilai_rendah nr WHERE nr.id_jurusan = nj.id_jurusan) * rr.bahasa +
            (SELECT nr.praktek FROM tabel_nilai_rendah nr WHERE nr.id_jurusan = nj.id_jurusan) * rr.praktek +
            (SELECT nr.politik FROM tabel_nilai_rendah nr WHERE nr.id_jurusan = nj.id_jurusan) * rr.politik +
            (SELECT nr.seni FROM tabel_nilai_rendah nr WHERE nr.id_jurusan = nj.id_jurusan) * rr.seni +
            (SELECT nr.R FROM tabel_nilai_rendah nr WHERE nr.id_jurusan = nj.id_jurusan) * rr.R +
            (SELECT nr.I FROM tabel_nilai_rendah nr WHERE nr.id_jurusan = nj.id_jurusan) * rr.I +
            (SELECT nr.A FROM tabel_nilai_rendah nr WHERE nr.id_jurusan = nj.id_jurusan) * rr.A +
            (SELECT nr.S FROM tabel_nilai_rendah nr WHERE nr.id_jurusan = nj.id_jurusan) * rr.S +
            (SELECT nr.E FROM tabel_nilai_rendah nr WHERE nr.id_jurusan = nj.id_jurusan) * rr.E +
            (SELECT nr.C FROM tabel_nilai_rendah nr WHERE nr.id_jurusan = nj.id_jurusan) * rr.C +
            (SELECT nr.logika FROM tabel_nilai_rendah nr WHERE nr.id_jurusan = nj.id_jurusan) * rr.logika +
            (SELECT nr.sains FROM tabel_nilai_rendah nr WHERE nr.id_jurusan = nj.id_jurusan) * rr.sains +
            (SELECT nr.soshum FROM tabel_nilai_rendah nr WHERE nr.id_jurusan = nj.id_jurusan) * rr.soshum +
            (SELECT nr.bisnis FROM tabel_nilai_rendah nr WHERE nr.id_jurusan = nj.id_jurusan) * rr.bisnis +
            (SELECT nr.kreatif FROM tabel_nilai_rendah nr WHERE nr.id_jurusan = nj.id_jurusan) * rr.kreatif +
            (SELECT nr.terapan FROM tabel_nilai_rendah nr WHERE nr.id_jurusan = nj.id_jurusan) * rr.terapan +
            (SELECT nr.administratif FROM tabel_nilai_rendah nr WHERE nr.id_jurusan = nj.id_jurusan) * rr.administratif +
            (SELECT nr.sastra FROM tabel_nilai_rendah nr WHERE nr.id_jurusan = nj.id_jurusan) * rr.sastra
            ) / 18 AS Y,
        (
            (SELECT ns.ipa FROM tabel_nilai_sedang ns WHERE ns.id_jurusan = nj.id_jurusan) * rs.ipa +
            (SELECT ns.ips FROM tabel_nilai_sedang ns WHERE ns.id_jurusan = nj.id_jurusan) * rs.ips +
            (SELECT ns.bahasa FROM tabel_nilai_sedang ns WHERE ns.id_jurusan = nj.id_jurusan) * rs.bahasa +
            (SELECT ns.praktek FROM tabel_nilai_sedang ns WHERE ns.id_jurusan = nj.id_jurusan) * rs.praktek +
            (SELECT ns.politik FROM tabel_nilai_sedang ns WHERE ns.id_jurusan = nj.id_jurusan) * rs.politik +
            (SELECT ns.seni FROM tabel_nilai_sedang ns WHERE ns.id_jurusan = nj.id_jurusan) * rs.seni +
            (SELECT ns.R FROM tabel_nilai_sedang ns WHERE ns.id_jurusan = nj.id_jurusan) * rs.R +
            (SELECT ns.I FROM tabel_nilai_sedang ns WHERE ns.id_jurusan = nj.id_jurusan) * rs.I +
            (SELECT ns.A FROM tabel_nilai_sedang ns WHERE ns.id_jurusan = nj.id_jurusan) * rs.A +
            (SELECT ns.S FROM tabel_nilai_sedang ns WHERE ns.id_jurusan = nj.id_jurusan) * rs.S +
            (SELECT ns.E FROM tabel_nilai_sedang ns WHERE ns.id_jurusan = nj.id_jurusan) * rs.E +
            (SELECT ns.C FROM tabel_nilai_sedang ns WHERE ns.id_jurusan = nj.id_jurusan) * rs.C +
            (SELECT ns.logika FROM tabel_nilai_sedang ns WHERE ns.id_jurusan = nj.id_jurusan) * rs.logika +
            (SELECT ns.sains FROM tabel_nilai_sedang ns WHERE ns.id_jurusan = nj.id_jurusan) * rs.sains +
            (SELECT ns.soshum FROM tabel_nilai_sedang ns WHERE ns.id_jurusan = nj.id_jurusan) * rs.soshum +
            (SELECT ns.bisnis FROM tabel_nilai_sedang ns WHERE ns.id_jurusan = nj.id_jurusan) * rs.bisnis +
            (SELECT ns.kreatif FROM tabel_nilai_sedang ns WHERE ns.id_jurusan = nj.id_jurusan) * rs.kreatif +
            (SELECT ns.terapan FROM tabel_nilai_sedang ns WHERE ns.id_jurusan = nj.id_jurusan) * rs.terapan +
            (SELECT ns.administratif FROM tabel_nilai_sedang ns WHERE ns.id_jurusan = nj.id_jurusan) * rs.administratif +
            (SELECT ns.sastra FROM tabel_nilai_sedang ns WHERE ns.id_jurusan = nj.id_jurusan) * rs.sastra
            ) / 18 AS Q,
        (
            (SELECT nt.ipa FROM tabel_nilai_tinggi nt WHERE nt.id_jurusan = nj.id_jurusan) * rt.ipa +
            (SELECT nt.ips FROM tabel_nilai_tinggi nt WHERE nt.id_jurusan = nj.id_jurusan) * rt.ips +
            (SELECT nt.bahasa FROM tabel_nilai_tinggi nt WHERE nt.id_jurusan = nj.id_jurusan) * rt.bahasa +
            (SELECT nt.praktek FROM tabel_nilai_tinggi nt WHERE nt.id_jurusan = nj.id_jurusan) * rt.praktek +
            (SELECT nt.politik FROM tabel_nilai_tinggi nt WHERE nt.id_jurusan = nj.id_jurusan) * rt.politik +
            (SELECT nt.seni FROM tabel_nilai_tinggi nt WHERE nt.id_jurusan = nj.id_jurusan) * rt.seni +
            (SELECT nt.R FROM tabel_nilai_tinggi nt WHERE nt.id_jurusan = nj.id_jurusan) * rt.R +
            (SELECT nt.I FROM tabel_nilai_tinggi nt WHERE nt.id_jurusan = nj.id_jurusan) * rt.I +
            (SELECT nt.A FROM tabel_nilai_tinggi nt WHERE nt.id_jurusan = nj.id_jurusan) * rt.A +
            (SELECT nt.S FROM tabel_nilai_tinggi nt WHERE nt.id_jurusan = nj.id_jurusan) * rt.S +
            (SELECT nt.E FROM tabel_nilai_tinggi nt WHERE nt.id_jurusan = nj.id_jurusan) * rt.E +
            (SELECT nt.C FROM tabel_nilai_tinggi nt WHERE nt.id_jurusan = nj.id_jurusan) * rt.C +
            (SELECT nt.logika FROM tabel_nilai_tinggi nt WHERE nt.id_jurusan = nj.id_jurusan) * rt.logika +
            (SELECT nt.sains FROM tabel_nilai_tinggi nt WHERE nt.id_jurusan = nj.id_jurusan) * rt.sains +
            (SELECT nt.soshum FROM tabel_nilai_tinggi nt WHERE nt.id_jurusan = nj.id_jurusan) * rt.soshum +
            (SELECT nt.bisnis FROM tabel_nilai_tinggi nt WHERE nt.id_jurusan = nj.id_jurusan) * rt.bisnis +
            (SELECT nt.kreatif FROM tabel_nilai_tinggi nt WHERE nt.id_jurusan = nj.id_jurusan) * rt.kreatif +
            (SELECT nt.terapan FROM tabel_nilai_tinggi nt WHERE nt.id_jurusan = nj.id_jurusan) * rt.terapan +
            (SELECT nt.administratif FROM tabel_nilai_tinggi nt WHERE nt.id_jurusan = nj.id_jurusan) * rt.administratif +
            (SELECT nt.sastra FROM tabel_nilai_tinggi nt WHERE nt.id_jurusan = nj.id_jurusan) * rt.sastra
            ) / 12 AS Z
    FROM
        tabel_rapot_rendah rr
            JOIN tabel_rapot_sedang rs ON rr.id_siswa = rs.id_siswa
            JOIN tabel_rapot_tinggi rt ON rr.id_siswa = rt.id_siswa
            CROSS JOIN acuan_nilai_jurusan nj
    WHERE
        rr.id_siswa = id_siswa_dihitung;


    -- Hitung hasil akhir dan masukkan ke dalam tabel hasil_perhitungan
    INSERT INTO hasil_perhitungan (id_siswa, id_jurusan, nama_jurusan, hasil)
    SELECT
        id_siswa,
        id_jurusan,
        nama_jurusan,
        ((0.5 * Z) + Q + ((1-0.5) * Y)) / 2 AS hasil
    FROM
        hasil_agregasi
    ON DUPLICATE KEY UPDATE
                         id_siswa = VALUES(id_siswa),
                         id_jurusan = VALUES(id_jurusan),
                         nama_jurusan = VALUES(nama_jurusan),
                         hasil = VALUES(hasil);

    -- Cari desimal 3 terbesar untuk setiap siswa dan masukkan ke dalam tabel hasil_rekomendasi
    INSERT INTO hasil_rekomendasi (id_siswa, Jurusan_1, Jurusan_2, Jurusan_3)
    SELECT
        id_siswa_dihitung,
        MAX(CASE WHEN rn = 1 THEN nama_jurusan END) AS Jurusan_1,
        MAX(CASE WHEN rn = 2 THEN nama_jurusan END) AS Jurusan_2,
        MAX(CASE WHEN rn = 3 THEN nama_jurusan END) AS Jurusan_3
    FROM (
             SELECT
                 id_siswa_dihitung,
                 nama_jurusan,
                 ROW_NUMBER() OVER (PARTITION BY id_siswa ORDER BY hasil DESC) AS rn
             FROM
                 hasil_perhitungan
         ) ranked_results
    WHERE rn <= 3
    GROUP BY id_siswa_dihitung
    ON DUPLICATE KEY UPDATE
                         Jurusan_1 = VALUES(Jurusan_1),
                         Jurusan_2 = VALUES(Jurusan_2),
                         Jurusan_3 = VALUES(Jurusan_3);
END;