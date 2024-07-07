create table if not exists nilai_rapot
(
    id       int auto_increment
        primary key,
    id_siswa int   null,
    ipa      float null,
    ips      float null,
    bahasa   float null,
    praktek  float null,
    politik  float null,
    seni     float null,
    constraint nilai_rapot_ibfk_1
        foreign key (id_siswa) references siswa (id_siswa)
);

create index if not exists id_siswa
    on nilai_rapot (id_siswa);

