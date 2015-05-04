Untuk KIJ-Certificate Authority

FrameWork : Codeigniter
CSS FrontEnd : Bootflat + Bootstrap
DB : mysql

Instalation:
1. Buat database db_certificate_authority
2. Import file db_certificate_authority.sql
3. Atur config di aplication/config/database.php

Tambahan:
1. Kayaknya perlu bikin tabel pelanggan/user dan perusahaan, karena nanti ada login untuk pelanggan dan admin
2. Admin boleh dibagi menjadi 2 jenis admin (revoke, signing), tapi boleh juga dijadiin 1 admin aja dan punya 2 menu (revoke dan signing)
3. Untuk pelanggan, login dulu lalu bisa request ca (csr)
4. Untuk input CSR, ikuti syarat input openssl_csr_new(...), ini pelajari link: http://php.net/manual/en/function.openssl-csr-new.php
5. Untuk menu signing, bisa pake ca_kij_bersahabat (kayaknya) atau self-signed (terserah sih)