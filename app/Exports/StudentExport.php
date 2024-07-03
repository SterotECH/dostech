<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Table;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Worksheet\Table\Column;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class StudentExport implements FromCollection, WithHeadings, WithTitle, WithEvents, WithColumnFormatting, WithCustomStartCell
{
    protected $students;
    protected $username;
    protected $studentCount;

    public function __construct($students, $username)
    {
        $this->students = $students;
        $this->username = $username;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $student = Student::query()->whereIn('id', $this->students)->get();
        $this->studentCount = $student->count();
        return $student;
    }

    public function headings(): array
    {
        return [
            'ID',
            'House ID',
            'Department ID',
            'Class ID',
            'Registration Number',
            'Date of Birth',
            'First Name',
            'Last Name',
            'Other Name',
            'Gender',
            'Dues Owed',
            'Is Active',
            'Has Completed',
            'Valid Until',
            'Created At',
            'Updated At',
        ];
    }

    public function title(): string
    {
        return 'stero';
    }

    public function startCell(): string
    {
        return 'A2';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $sheet->mergeCells('A1:P1');
                $sheet->setCellValue('A1', 'Student List');
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
                $sheet->setCellValue('A2', 'ID');
                $sheet->setCellValue('B2', 'House ID');
                $sheet->setCellValue('C2', 'Department ID');
                $sheet->setCellValue('D2', 'Class ID');
                $sheet->setCellValue('E2', 'Registration Number');
                $sheet->setCellValue('F2', 'Date of Birth');
                $sheet->setCellValue('G2', 'First Name');
                $sheet->setCellValue('H2', 'Last Name');
                $sheet->setCellValue('I2', 'Other Name');
                $sheet->setCellValue('J2', 'Gender');
                $sheet->setCellValue('K2', 'Dues Owed');
                $sheet->setCellValue('L2', 'Is Active');
                $sheet->setCellValue('M2', 'Has Completed');
                $sheet->setCellValue('N2', 'Valid Until');
                $sheet->setCellValue('O2', 'Created At');
                $sheet->setCellValue('P2', 'Updated At');
                $sheet->setH
                $sheet->getStyle('A2:P2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);

                $count = $this->studentCount + 2;

                $sheet->getProtection()->setSheet(true);
                $sheet->getProtection()->setPassword($this->username);

                $range = 'A2:P' . $count;

                $event->sheet->getStyle($range)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);
                $sheet->freezePane('A3');

                $table = new Table();
                $table->setAllowFilter(true);
                $table->setShowHeaderRow(true);
                $table->setShowTotalsRow(false);
                $table->setRangeToMaxRow();
                $table->getColumns(
                    [
                        new Column('A', $table),
                        new Column('B', $table),
                        new Column('C', $table),
                        new Column('D', $table),
                        new Column('E', $table),
                        new Column('F', $table),
                        new Column('G', $table),
                        new Column('H', $table),
                        new Column('I', $table),
                        new Column('J', $table),
                        new Column('K', $table),
                        new Column('L', $table),
                        new Column('M', $table),
                        new Column('N', $table),
                        new Column('O', $table),
                        new Column('P', $table),
                    ]
                );
                $table->setRange($range);
                $table->setName('studentTable');
                $table->setWorksheet($sheet);

                $sheet->addTable($table);
            }
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
            'B' => NumberFormat::FORMAT_NUMBER,
            'C' => NumberFormat::FORMAT_NUMBER,
            'D' => NumberFormat::FORMAT_NUMBER,
            'F' => NumberFormat::FORMAT_DATE_YYYYMMDD,
            'O' => NumberFormat::FORMAT_DATE_YYYYMMDD,
            'P' => NumberFormat::FORMAT_DATE_YYYYMMDD,
            'K' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'N' => NumberFormat::FORMAT_DATE_YYYYMMDD,
        ];
    }
}
