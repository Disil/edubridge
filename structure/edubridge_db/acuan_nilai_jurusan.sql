create table if not exists acuan_nilai_jurusan
(
    id_jurusan int          not null
        primary key,
    Jurusan    varchar(255) null,
    ipa        varchar(2)   null,
    ips        varchar(2)   null,
    bahasa     varchar(2)   null,
    praktek    varchar(2)   null,
    politik    varchar(2)   null,
    seni       varchar(2)   null,
    R          varchar(2)   null,
    I          varchar(2)   null,
    A          varchar(2)   null,
    S          varchar(2)   null,
    E          varchar(2)   null,
    C          text         null,
    constraint nama_jurusan_index
        unique (Jurusan)
);

