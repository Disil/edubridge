create table if not exists pertanyaan_riasec
(
    id_pertanyaan int auto_increment
        primary key,
    pertanyaan    varchar(255)                        not null,
    kategori      enum ('R', 'I', 'A', 'S', 'E', 'C') not null
);

