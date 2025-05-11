# <p align="center" style="margin-bottom: 0px;">SIPAGI</p>
## <p align="center" style="margin-top: 0;">SISTEM PENJADWALAN GUDANG GABAH TERINTEGRASI</p>

<p align="center">
  <img src="Logo Unsulbar.png" width="300" alt="Deskripsi gambar" />
</p>

### <p align="center">AHMAD KHANIF IZZAH ARIFIN</p>
### <p align="center">D0223511</p></br>
### <p align="center">Framework Web Based</p>
### <p align="center">2025</p>

---
## Role dan Fitur
### 1. Admin
**Fokus:** Kelola sistem & pengguna
| Fitur | Deskripsi |
| ----------- | ----------- |
| Kelola User | CRUD data pengguna |
| Kelola Role dan Hak Akses | Menentukan akses |

### 2. Manager Gudang
**Fokus:** Operasional gudang
| Fitur | Deskripsi |
| ----------- | ----------- |
| Lihat Jadwal | Lihat jadwal pengiriman |
| Konfirmasi Jadwal | *Setujui*/*tolak* jadwal petani |
| Update Jadwal | Tandai sebagai *selesai* |
| Kelola stok | Tambah/edit jumlah stok |
| Laporan Gudang | Stok harian, riwayat masuk/keluar |

### 3. Petani/Pengguna
**Fokus:** Kirim gabah / pantau proses
| Fitur | Deskripsi |
| ----------- | ----------- |
| Buat Jadwal | Pilih tanggal, gudang tujuan, jumlah gabah, kadar air padi, dan berat gabah |
| Lihat Status Jadwal | Apakah diterima, di proses atau, selesai |
| Edit/Hapus Jadwal | Jika jadwal belum di proses |

---
## Tabel-tabel database beserta field dan tipe datanya

### 1. Tabel ```users```
| Field | Tipe Data | Keterangan |
| ----------- | ----------- | ----------- |
| id | INT(PK) | Primary Key |
| nama | VARCHAR(100) | Nama User |
| email | VARCHAR(100) | Email Unik |
| password | VARCHAR(255) | Password |
| role_id | INT(FK) | Relasi ke ```roles.id`` |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

### 12. Tabel ```roles```
| Field | Tipe Data | Keterangan |
| ----------- | ----------- | ----------- |
| id | INT(PK) | Primary Key |
| name | VARCHAR | Nama Role |


### 3. Tabel ```gudangs```
| Field | Tipe Data | Keterangan |
| ----------- | ----------- | ----------- |
| id | INT(PK) | Primary Key |
| nama_gudang | VARCHAR(100) | Nama Gudang |
| kapasitas | INT | Maksimal kapasitas gudang |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

### 4. Tabel ```penjadwalans```
| Field | Tipe Data | Keterangan |
| ----------- | ----------- | ----------- |
| id | INT(PK) | Primary Key |
| user_id | INT(FK) | Relasi ke ```users.id``` |
| gudang_id | INT(FK) | Relasi ke ```gudangs.id``` |
| tanggal_kirim | DATE | Tanggal kirim gabah |
| berat_gabah | FLOAT | Berat gabah dalam kg |
| kadar_air | FLOAT | Persentase kadar air padi |
| status | ENUM | 'diajukan', 'diproses', 'selesai', 'ditolak' |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

### 5. Tabel ```stok_gabahs```
| Field | Tipe Data | Keterangan |
| ----------- | ----------- | ----------- |
| id | INT(PK) | Primary Key |
| gudang_id | INT(FK) | Relasi ke ```gudangs.id``` |
| user_id | INT(FK) | Nama petani atau sumber gabah |
| tanggal_masuk | DATE | Tanggal kirim gabah |
| berat_gabah | FLOAT | Berat gabah dalam kg |
| kadar_air | FLOAT | Persentase kadar air padi |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

### 6. Tabel ```profiles```
| Field | Tipe Data | Keterangan |
| ----------- | ----------- | ----------- |
| id | INT(PK) | Primary Key |
| user_id | INT(FK) | ID User |
| nama_lengkap | VARCHAR(100) | Nama User |
| alamat | VARCHAR(100) | Alamat User |
| no_telepon | VARCHAR(100) | Alamat User |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

### 7. Tabel ```gudang_users```
| Field | Tipe Data | Keterangan |
| ----------- | ----------- | ----------- |
| id | INT(PK) | Primary Key |
| user_id | INT(FK) | ID User |
| gudang_id | INT(FK) | ID Gudang |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

---
## Jenis relasi dan tabel yang berelasi
| Tabel Asal | Tabel Tujuan | Jenis Relasi | Keterangan |
| ----------- | ----------- | ----------- | ----------- |
| ```profiles.user_id``` | ```users.id``` | One to One | Satu user bisa punya satu profile |
| ```penjadwalans.user_id``` | ```users.id``` | Many to One | Setiap jadwal diajukan oleh satu user |
| ```penjadwalans.gudang_id``` | ```gudangs.id``` | Many to One | Setiap jadwal diajukan ke satu gudang |
| ```stok_gabahs.gudang_id``` | ```gudangs.id``` | Many to One | Banyak stok masuk ke satu gudang |
| ```gudang_users``` | ```users.id<>gudangs.id``` | Many to Many | Satu user bisa kelola banyak gudang, dan satu gudang bisa dikelola banyak user+- |
