create table if not exists nilai
(
    id       int auto_increment
        primary key,
    id_siswa int        null,
    ipa      varchar(2) null,
    ips      varchar(2) null,
    bahasa   varchar(2) null,
    praktek  varchar(2) null,
    politik  varchar(2) null,
    seni     varchar(2) null,
    R        varchar(2) null,
    I        varchar(2) null,
    A        varchar(2) null,
    S        varchar(2) null,
    E        varchar(2) null,
    C        varchar(2) null,
    constraint nilai_ibfk_1
        foreign key (id_siswa) references siswa (id_siswa)
);

create index if not exists id_siswa
    on nilai (id_siswa);

