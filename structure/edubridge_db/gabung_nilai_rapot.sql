create definer = root@localhost trigger if not exists gabung_nilai_rapot
    after insert
    on nilai_rapot_asli
    for each row
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
END;

