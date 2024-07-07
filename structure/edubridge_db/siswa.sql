create table if not exists siswa
(
    id_siswa      int auto_increment
        primary key,
    nama          varchar(255)                         null,
    email         varchar(255)                         null,
    password      varchar(255)                         null,
    tanggal_lahir date                                 null,
    asal_sekolah  varchar(255)                         null,
    kelas         enum ('10', '11', '12')              null,
    jenis_kelamin enum ('Pria', 'Wanita')              null,
    tgl_buat_akun datetime default current_timestamp() not null
);

create index if not exists nama_siswa
    on siswa (nama);

