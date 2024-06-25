[//] # -- Table for raw grades
CREATE TABLE nilai_mentah (
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
foreign key (id_siswa) references users(id_siswa)
);

-- Table for combined grades
CREATE TABLE nilai_gabungan (
id INT AUTO_INCREMENT PRIMARY KEY,
id_siswa INT,
ipa int,
ips int,
bahasa int,
praktek int,
politik int,
seni int,
foreign key (id_siswa) references users(id_siswa)
);

-- Table for letter grade conversion
CREATE TABLE nilai_huruf (
id INT AUTO_INCREMENT PRIMARY KEY,
id_siswa INT,
ipa VARCHAR(2),
ips VARCHAR(2),
bahasa VARCHAR(2),
praktek VARCHAR(2),
politik VARCHAR(2),
seni VARCHAR(2),
foreign key (id_siswa) references users(id_siswa)
);

DELIMITER //

CREATE TRIGGER nilai_mentah_ke_gabungan
AFTER INSERT ON nilai_mentah
FOR EACH ROW
BEGIN
INSERT INTO nilai_gabungan (id_siswa, ipa, ips, bahasa, praktek, politik, seni)
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

CREATE TRIGGER nilai_gabungan_ke_huruf
AFTER INSERT ON nilai_gabungan
FOR EACH ROW
BEGIN
INSERT INTO nilai_huruf (id_siswa, ipa, ips, bahasa, praktek, politik, seni)
VALUES (
NEW.id_siswa,
CASE
WHEN NEW.ipa >= 94 THEN 'ST'
WHEN NEW.ipa >= 87 THEN 'T'
WHEN NEW.ipa >= 80 THEN 'CT'
WHEN NEW.ipa >= 73 THEN 'KT'
ELSE 'TT'
END,
CASE
WHEN NEW.ips >= 94 THEN 'ST'
WHEN NEW.ips >= 87 THEN 'T'
WHEN NEW.ips >= 80 THEN 'CT'
WHEN NEW.ips >= 73 THEN 'KT'
ELSE 'TT'
END,
CASE
WHEN NEW.bahasa >= 94 THEN 'ST'
WHEN NEW.bahasa >= 87 THEN 'T'
WHEN NEW.bahasa >= 80 THEN 'CT'
WHEN NEW.bahasa >= 73 THEN 'KT'
ELSE 'TT'
END,
CASE
WHEN NEW.praktek >= 94 THEN 'ST'
WHEN NEW.praktek >= 87 THEN 'T'
WHEN NEW.praktek >= 80 THEN 'CT'
WHEN NEW.praktek >= 73 THEN 'KT'
ELSE 'TT'
END,
CASE
WHEN NEW.politik >= 94 THEN 'ST'
WHEN NEW.politik >= 87 THEN 'T'
WHEN NEW.politik >= 80 THEN 'CT'
WHEN NEW.politik >= 73 THEN 'KT'
ELSE 'TT'
END,
CASE
WHEN NEW.seni >= 94 THEN 'ST'
WHEN NEW.seni >= 87 THEN 'T'
WHEN NEW.seni >= 80 THEN 'CT'
WHEN NEW.seni >= 73 THEN 'KT'
ELSE 'TT'
END
)
ON DUPLICATE KEY UPDATE
ipa = CASE
WHEN NEW.ipa >= 94 THEN 'ST'
WHEN NEW.ipa >= 87 THEN 'T'
WHEN NEW.ipa >= 80 THEN 'CT'
WHEN NEW.ipa >= 73 THEN 'KT'
ELSE 'TT'
END,
ips = CASE
WHEN NEW.ips >= 94 THEN 'ST'
WHEN NEW.ips >= 87 THEN 'T'
WHEN NEW.ips >= 80 THEN 'CT'
WHEN NEW.ips >= 73 THEN 'KT'
ELSE 'TT'
END,
bahasa = CASE
WHEN NEW.bahasa >= 94 THEN 'ST'
WHEN NEW.bahasa >= 87 THEN 'T'
WHEN NEW.bahasa >= 80 THEN 'CT'
WHEN NEW.bahasa >= 73 THEN 'KT'
ELSE 'TT'
END,
praktek = CASE
WHEN NEW.praktek >= 94 THEN 'ST'
WHEN NEW.praktek >= 87 THEN 'T'
WHEN NEW.praktek >= 80 THEN 'CT'
WHEN NEW.praktek >= 73 THEN 'KT'
ELSE 'TT'
END,
politik = CASE
WHEN NEW.politik >= 94 THEN 'ST'
WHEN NEW.politik >= 87 THEN 'T'
WHEN NEW.politik >= 80 THEN 'CT'
WHEN NEW.politik >= 73 THEN 'KT'
ELSE 'TT'
END,
seni = CASE
WHEN NEW.seni >= 94 THEN 'ST'
WHEN NEW.seni >= 87 THEN 'T'
WHEN NEW.seni >= 80 THEN 'CT'
WHEN NEW.seni >= 73 THEN 'KT'
ELSE 'TT'
END;
END//

DELIMITER ;