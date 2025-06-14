<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;
use Maatwebsite\Excel\Events\AfterSheet;

class BarangExport implements FromCollection, WithHeadings, WithStyles, WithEvents, WithTitle
{
    protected $kategoriId;

    public function __construct($kategoriId = null)
    {
        $this->kategoriId = $kategoriId;
    }

    public function collection()
    {
        $data = Barang::with('kategori')
            ->when($this->kategoriId, function ($query) {
                $query->where('kategori_id', $this->kategoriId);
            })
            ->get();

        $rows = [];
        $no = 1;
        foreach ($data as $item) {
            $rows[] = [
                'No' => $no++,
                'Nama Barang' => $item->nama_barang,
                'Stock' => $item->stock,
                'Kategori' => $item->kategori->nama_kategori ?? '-',
                'Tanggal' => $item->created_at->format('d-m-Y'),
            ];
        }

        return collect($rows);
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Barang',
            'Stock',
            'Kategori',
            'Tanggal',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 12],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'B6D7A8'],
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $rowCount = $sheet->getHighestRow();
                $columnCount = $sheet->getHighestColumn();

                foreach (range('A', $columnCount) as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }

                $sheet->getStyle("A1:{$columnCount}{$rowCount}")
                    ->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

                $sheet->getStyle("A2:{$columnCount}{$rowCount}")
                    ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $judul = 'Laporan Barang';
                $sheet->insertNewRowBefore(1, 1);
                $sheet->mergeCells("A1:{$columnCount}1");
                $sheet->setCellValue("A1", $judul);
                $sheet->getStyle("A1")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                        'name' => 'Calibri',
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
            },
        ];
    }

    public function title(): string
    {
        return 'Laporan Barang';
    }
}
