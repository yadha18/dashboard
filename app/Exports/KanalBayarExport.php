<?php

namespace App\Exports;

use App\Models\KanalBayar;
use Maatwebsite\Excel\Concerns\FromGenerator;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KanalBayarExport implements FromGenerator, WithHeadings {

    private $startDate;
    private $endDate;

    public function __construct($startDate, $endDate) {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function generator(): \Generator
    {
        $query = KanalBayar::whereBetween('tanggalBayar', [$this->startDate, $this->endDate]);

        yield $this->headings(); 

        foreach ($query->cursor() as $item) {
            yield [
                $item->idPelanggan,
                $item->idTagihan,
                $item->tanggalBayar,
                $item->rpTagihanMinusPPN,
                $item->pembayaranVia,
            ];
        }
    }


    public function headings(): array
    {
        return [
            'ID Pelanggan',
            'ID Tagihan',
            'Tanggal Bayar',
            'RP Tagihan Minus PPN',
            'Pembayaran Via'
        ];
    }
}

?>