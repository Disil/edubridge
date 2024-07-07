create table if not exists tabel_rapot_sedang
(
    id_siswa int         not null
        primary key,
    ipa      varchar(50) null,
    ips      varchar(50) null,
    bahasa   varchar(50) null,
    praktek  varchar(50) null,
    politik  varchar(50) null,
    seni     varchar(50) null,
    R        varchar(50) null,
    I        varchar(50) null,
    A        varchar(50) null,
    S        varchar(50) null,
    E        varchar(50) null,
    C        varchar(50) null,
    constraint tabel_rapot_sedang_ibfk_1
        foreign key (id_siswa) references nilai (id_siswa)
);

