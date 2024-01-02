<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Data extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'age',
    ];

    /**
     * Kata-kata yang akan dihapus dari text
     */
    static $dirty = [
        'TAHUN',
        'THN',
        'TH',
    ];


    /**
     * Membersihkan teks sesuai dengan format
     *
     * @param string $text Teks yang akan dibersihkan
     * @return string Teks yang sudah dibersihkan
     */
    private static function cleanText(string $text) : string {
        // uppercase semua text
        $text = Str::upper($text);

        // hapus semua kata yang ada di self::$dirty
        foreach (self::$dirty as $d) {
            $text = str_replace($d, '', $text);
        }

        // hapus semua spasi yang berlebihan
        return trim($text);
    }

    /**
     * Mendapatkan umur dari text
     *
     * @param string $text Teks yang akan dicari umurnya
     * @return int|null Umur yang didapatkan, jika tidak ada maka null
     */
    private static function getAge(string $text) : ?int {
        // cari angka menggunakan regex
        preg_match_all('!\d+!', $text, $matches);

        // jika ada yang match, maka kembalikan angka, jika tidak kembalikan null
        return $matches[0][0] ?? null;
    }

    /**
     * Memecah text menjadi array
     *
     * @param string $text Teks yang akan dipecah
     * @return array|null Array yang sudah dipecah, jika tidak sesuai maka null
     */
    public static function splitText(string $text) : ?array
    {
        // bersihkan text dan ambil umur
        $text = self::cleanText($text);
        $age = self::getAge($text);

        // jika umur tidak ada, maka kembalikan null
        if ($age == null) {
            return null; // Invalid text
        }

        // pecah text berdasarkan umur
        $raw = explode($age, $text);

        // validasi data text
        if (count($raw) != 2) {
            return null; // Invalid text
        }
        if (strlen($raw[0]) == 0 || strlen($raw[1]) == 0) {
            return null; // Invalid text
        }

        // kembalikan data
        return [
            'name' => trim($raw[0]),
            'city' => trim($raw[1]),
            'age' => $age,
        ];

    }
}
