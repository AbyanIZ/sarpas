<?php

namespace App\Exports;

use App\Models\Pengembalian;
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

class PengembalianExport implements FromCollection, WithHeadings, WithStyles, WithEvents, WithTitle
{
    protected $start;
    protected $end;

    public function __construct($start = null, $end = null)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function collection()
    {
        $query = Pengembalian::with(['user', 'approvedBy', 'barang'])->orderBy('created_at', 'desc');

        if ($this->start && $this->end) {
            $query->whereBetween('tanggal_pengembalian', [$this->start, $this->end]);
        }

        $data = $query->get();

        $rows = [];
        $no = 1;
        foreach ($data as $item) {
            $rows[] = [
                'No' => $no++,
                'ID' => $item->id,
                'Nama User' => $item->user->name ?? '-',
                'Nama Barang' => $item->barang->nama_barang ?? '-',
                'Jumlah' => $item->jumlah,
                'Tanggal Pengembalian' => $item->tanggal_pengembalian ? $item->tanggal_pengembalian->format('Y-m-d H:i:s') : '-',
                'Status' => $item->status ?? '-',
                'Keterangan' => $item->keterangan ?? '-',
            ];
        }

        return collect($rows);
    }

    public function headings(): array
    {
        return [
            'No',
            'ID',
            'Nama User',
            'Nama Barang',
            'Jumlah',
            'Tanggal Pengembalian',
            'Status',
            'Keterangan',
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

                // Autosize kolom
                foreach (range('A', $columnCount) as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }

                $sheet->getStyle("A1:{$columnCount}{$rowCount}")
                    ->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

                $sheet->getStyle("A2:{$columnCount}{$rowCount}")
                    ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $judul = 'Laporan Pengembalian';
                if ($this->start && $this->end) {
                    $judul .= " ({$this->start} hingga {$this->end})";
                }

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
        return 'Laporan Pengembalian';
    }
}
