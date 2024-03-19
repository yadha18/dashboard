<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KanalBayar;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class KanalBayarController extends Controller
{
    public function kanalbayar(Request $request)
    {
        $e_wallet = ['OVO', 'LINKAJA', 'LINKAJA-VA', 'GOPAY'];
        $modern_market = ['INDOMART', 'ALFA'];
        $bank = ['BRI-VA', 'BNI-VA', 'BCA-VA', 'MANDIRI', 'BANK LAINNYA'];
        $user = User::select('name')->first();

        $startDate = $request->input('start_date', '2019-01-01');
        $endDate = $request->input('end_date', now()->format('Y-m-d'));

        $bill_bri = $this->sumBill($bank[0], $startDate, $endDate);
        $total_bri = $this->countBill($bank[0], $startDate, $endDate);

        $bill_bni = $this->sumBill($bank[1], $startDate, $endDate);
        $total_bni = $this->countBill($bank[1], $startDate, $endDate);

        $bill_bca = $this->sumBill($bank[2], $startDate, $endDate);
        $total_bca = $this->countBill($bank[2], $startDate, $endDate);

        $bill_mandiri = $this->sumBill($bank[3], $startDate, $endDate);
        $total_mandiri = $this->countBill($bank[3], $startDate, $endDate);

        $bill_otherbank = $this->sumBill($bank[4], $startDate, $endDate);
        $total_otherbank = $this->countBill($bank[4], $startDate, $endDate);

        $bill_indo = $this->sumBill($modern_market[0], $startDate, $endDate);
        $total_indo = $this->countBill($modern_market[0], $startDate, $endDate);

        $bill_alfa = $this->sumBill($modern_market[1], $startDate, $endDate);
        $total_alfa = $this->countBill($modern_market[1], $startDate, $endDate);

        $bill_ovo = $this->sumBill($e_wallet[0], $startDate, $endDate);
        $total_ovo = $this->countBill($e_wallet[0], $startDate, $endDate);

        $bill_linkaja = $this->sumBill($e_wallet[1], $startDate, $endDate);
        $total_linkaja = $this->countBill($e_wallet[1], $startDate, $endDate);

        $bill_gopay = $this->sumBill($e_wallet[2], $startDate, $endDate);
        $total_gopay = $this->countBill($e_wallet[2], $startDate, $endDate);

        $bill_e_commerce = $this->sumBill('ALTERRA', $startDate, $endDate);
        $total_e_commerce = $this->countBill('ALTERRA', $startDate, $endDate);

        if (Auth::check()) {
            return view('auth.kanal-bayar', compact('user', 'total_e_commerce', 'bill_e_commerce', 'bill_ovo', 'total_ovo', 'bill_linkaja', 'total_linkaja', 'bill_gopay', 'total_gopay', 'bill_indo', 'total_indo', 'bill_alfa', 'total_alfa', 'bill_bri', 'total_bri', 'bill_bni', 'total_bni', 'bill_bca', 'total_bca', 'bill_mandiri', 'total_mandiri', 'bill_otherbank', 'total_otherbank', 'startDate', 'endDate'));
        }

        return redirect()->route('login')->withErrors([
            'username' => 'silakan login terlebih dahulu'
        ])->withInput(['username']);
    }

    private function sumBill($paymentMethod, $startDate, $endDate)
    {
        return KanalBayar::where('pembayaranVia', $paymentMethod)->whereBetween('tanggalBayar', [$startDate, $endDate])->sum('rpTagihanMinusPPN');
    }

    private function countBill($paymentMethod, $startDate, $endDate)
    {
        return KanalBayar::where('pembayaranVia', $paymentMethod)->whereBetween('tanggalBayar', [$startDate, $endDate])->count();
    }


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

        $percentage_e_wallet = number_format(($sum_e_wallet / $total_sum) * 100, 1);
        $percentage_modern_market = number_format(($sum_modern_market / $total_sum) * 100, 1);
        $percentage_bank = number_format(($sum_bank / $total_sum) * 100, 1);
        $percentage_e_commerce = number_format(($sum_e_commerce / $total_sum) * 100, 1);

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
