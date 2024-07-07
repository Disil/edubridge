create table if not exists nilai_riasec
(
    id       int auto_increment
        primary key,
    id_siswa int null,
    R        int null,
    I        int null,
    A        int null,
    S        int null,
    E        int null,
    C        int null,
    constraint nilai_riasec_ibfk_1
        foreign key (id_siswa) references siswa (id_siswa)
);

create index if not exists id_siswa
    on nilai_riasec (id_siswa);

