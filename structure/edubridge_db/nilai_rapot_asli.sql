create table if not exists nilai_rapot_asli
(
    id               int auto_increment
        primary key,
    id_siswa         int           null,
    matematika       int           null,
    fisika           int default 0 not null,
    kimia            int default 0 not null,
    biologi          int default 0 not null,
    ekonomi          int default 0 not null,
    geografi         int default 0 not null,
    sosiologi        int default 0 not null,
    bahasa_indonesia int           null,
    bahasa_inggris   int           null,
    pjok             int           null,
    prakarya         int           null,
    sejarah          int           null,
    ppkn             int           null,
    seni_budaya      int           null,
    constraint nilai_rapot_asli_ibfk_1
        foreign key (id_siswa) references siswa (id_siswa)
);

create index if not exists id_siswa
    on nilai_rapot_asli (id_siswa);

