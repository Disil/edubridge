create table if not exists hasil_agregasi
(
    id_jurusan int            null,
    Jurusan    varchar(255)   null,
    Y          decimal(10, 4) null,
    Q          decimal(10, 4) null,
    Z          decimal(10, 4) null,
    constraint hasil_agregasi_ibfk_1
        foreign key (id_jurusan) references acuan_nilai_jurusan (id_jurusan),
    constraint hasil_agregasi_ibfk_2
        foreign key (Jurusan) references acuan_nilai_jurusan (Jurusan)
);

create index if not exists Jurusan
    on hasil_agregasi (Jurusan);

create index if not exists id_jurusan
    on hasil_agregasi (id_jurusan);

