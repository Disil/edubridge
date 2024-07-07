create table if not exists hasil_rekomendasi
(
    id_siswa  int          not null
        primary key,
    Jurusan_1 varchar(255) null,
    Jurusan_2 varchar(255) null,
    Jurusan_3 varchar(255) null,
    constraint hasil_rekomendasi_ibfk_1
        foreign key (id_siswa) references nilai (id_siswa),
    constraint hasil_rekomendasi_ibfk_2
        foreign key (Jurusan_1) references acuan_nilai_jurusan (Jurusan),
    constraint hasil_rekomendasi_ibfk_3
        foreign key (Jurusan_2) references acuan_nilai_jurusan (Jurusan),
    constraint hasil_rekomendasi_ibfk_4
        foreign key (Jurusan_3) references acuan_nilai_jurusan (Jurusan)
);

create index if not exists Jurusan_1
    on hasil_rekomendasi (Jurusan_1);

create index if not exists Jurusan_2
    on hasil_rekomendasi (Jurusan_2);

create index if not exists Jurusan_3
    on hasil_rekomendasi (Jurusan_3);

