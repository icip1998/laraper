<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\kategori;
use App\Models\Penerbit;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();

        $kategoris = [
            [
                'nama' => 'Pemrograman',
                'slug' => 'pemrograman'
            ],
            [
                'nama' => 'Novel',
                'slug' => 'novel'
            ]
        ];

        foreach ($kategoris as $item) {
            kategori::create($item);
        }
        
        $penerbits = [
            [
                'nama' => 'Gramedia',
                'alamat' => null,
                'no_tlp' => null
            ],
            [
                'nama' => 'Bobo',
                'alamat' => null,
                'no_tlp' => null
            ]
        ];

        foreach ($penerbits as $item) {
            Penerbit::create($item);
        }

        $bukus = [
            [
                'kategori_id' => 1,
                'judul' => 'Jendral Sudirman',
                'isbn' => '123-123-120',
                'deskripsi' => '',
                'pengarang' => 'Yopi',
                'penerbit_id' => 1,
                'tahun_terbit' => 2000,
                'jumlah_buku' => 55
            ],
            [
                'kategori_id' => 2,
                'judul' => 'Hujan',
                'isbn' => '123-123-121',
                'deskripsi' => '',
                'pengarang' => 'Tere Liye',
                'penerbit_id' => 1,
                'tahun_terbit' => 2000,
                'jumlah_buku' => 100
            ],
            [
                'kategori_id' => 2,
                'judul' => 'Wedding Aggrement',
                'isbn' => '123-123-122',
                'deskripsi' => '',
                'pengarang' => 'Mia Chuz',
                'penerbit_id' => 1,
                'tahun_terbit' => 2000,
                'jumlah_buku' => 100
            ]
        ];

        foreach ($bukus as $item) {
            Buku::create($item);
        }

        $users = [
            [
                'name' => 'member',
                'username' => 'member',
                'password' => bcrypt('member1'),
                'email' => 'member@gmail.com',
                'role' => 'member'
            ],
            [
                'name' => 'admin',
                'username' => 'admin',
                'password' => bcrypt('admin1'),
                'email' => 'admin@gmail.com',
                'role' => 'admin'
            ]
        ];

        foreach ($users as $item) {
            User::create($item);
        }
    }
}
