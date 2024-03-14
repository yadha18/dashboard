<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KanalBayar;

class KanalBayarController extends Controller
{
    public function pembayaranViaCount()
    {
        $e_wallet = ['OVO', 'LINKAJA', 'LINKAJA-VA', 'GOPAY'];
        $modern_market = ['INDOMART', 'ALFA'];
        $bank = ['BRI-VA', 'BNI-VA', 'BCA-VA', 'MANDIRI', 'BANK LAINNYA'];
        $e_commerce = ['ALTERRA'];

        $sum_e_wallet = $this->filterPembayaran($e_wallet);
        $sum_modern_market = $this->filterPembayaran($modern_market);
        $sum_bank = $this->filterPembayaran($bank);
        $sum_e_commerce = $this->filterPembayaran($e_commerce);

        $total_sum = $sum_e_wallet + $sum_modern_market + $sum_bank + $sum_e_commerce;

        $percentage_e_wallet = number_format(($sum_e_wallet / $total_sum) * 100, 1) + '%';
        $percentage_modern_market = number_format(($sum_modern_market / $total_sum) * 100, 1) + '%';
        $percentage_bank = number_format(($sum_bank / $total_sum) * 100, 1) + '%';
        $percentage_e_commerce = number_format(($sum_e_commerce / $total_sum) * 100, 1) + '%';

        $data = [
            'e_wallet' => $percentage_e_wallet,
            'modern_market' => $percentage_modern_market,
            'bank' => $percentage_bank,
            'e_commerce' => $percentage_e_commerce,
        ];

        $total_percentage = $percentage_e_wallet + $percentage_modern_market + $percentage_bank + $percentage_e_commerce;
        $adjustment = 100 - $total_percentage;
        $data['e_wallet'] += $adjustment;

        return response()->json($data);
    }

    private function filterPembayaran($via)
    {
        return KanalBayar::whereIn('pembayaranVia', $via)->sum('rpTagihanMinusPPN');
    }
}
