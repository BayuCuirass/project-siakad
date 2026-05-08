namespace App\Http\Controllers;

use App\Models\Matkul;
use App\Models\Tagihan; // Pastikan model Tagihan sudah ada
use Illuminate\Http\Request;

class SiakadController extends Controller
{
    public function indexKrs($nim)
    {
        // 1. Cek status pembayaran di tabel Tagihan (SIKEU)
        $tagihan = Tagihan::where('nim', $nim)->first();

        // 2. Logika Gembok (Sesuai Gambar Pak Marta)
        if (!$tagihan || $tagihan->status_bayar !== 'Lunas') {
            return view('siakad.krs_locked', [
                'pesan' => 'Maaf, Anda belum bisa mengisi KRS. Silakan lunasi tagihan di SIKEU terlebih dahulu.'
            ]);
        }

        // 3. Kalau lunas, tampilkan semua mata kuliah
        $matkuls = Matkul::with('dosen')->get();
        return view('siakad.krs_index', compact('matkuls'));
    }
}