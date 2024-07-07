create table if not exists jawaban_riasec
(
    id_siswa      int                  null,
    id_pertanyaan int                  null,
    jawaban       enum ('Ya', 'Tidak') null,
    constraint jawaban_riasec_ibfk_1
        foreign key (id_siswa) references siswa (id_siswa),
    constraint jawaban_riasec_ibfk_2
        foreign key (id_pertanyaan) references pertanyaan_riasec (id_pertanyaan)
);

create index if not exists id_pertanyaan
    on jawaban_riasec (id_pertanyaan);

create index if not exists id_siswa
    on jawaban_riasec (id_siswa);

