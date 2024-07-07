create table if not exists hasil_perhitungan
(
    id_jurusan int            null,
    Jurusan    varchar(255)   null,
    hasil      decimal(10, 4) null,
    constraint hasil_perhitungan_ibfk_1
        foreign key (id_jurusan) references acuan_nilai_jurusan (id_jurusan),
    constraint hasil_perhitungan_ibfk_2
        foreign key (Jurusan) references acuan_nilai_jurusan (Jurusan)
);

create index if not exists Jurusan
    on hasil_perhitungan (Jurusan);

create index if not exists id_jurusan
    on hasil_perhitungan (id_jurusan);

