create
    definer = root@localhost procedure buat_rekomendasi_jurusan()
BEGIN
    CALL ubah_ke_fuzzy();
    CALL hitung_agregasi();
END;

