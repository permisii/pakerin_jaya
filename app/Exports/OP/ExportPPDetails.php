<?php

namespace App\Exports\OP;

use App\Models\OP;
use DateMalformedStringException;
use DateTime;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Files\LocalTemporaryFile;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportPPDetails implements ShouldAutoSize, WithEvents {
    private OP $op;
    private bool $calledByEvent;

    public function __construct($op) {
        $this->op = $op;
        $this->calledByEvent = false;
    }

    public function collection(): Collection {
        if ($this->calledByEvent) { // check flag
            return OP::find($this->op->id)->pps;
        }

        return collect([]);

    }

    //    public function registerEvents(): array {
    //        return [
    //            AfterSheet::class => function (AfterSheet $event) {
    //                $sheet = $event->sheet->getDelegate();
    //
    //                // Load the template file
    //                $templatePath = storage_path('app/templates/excel/op/op_values_template.xlsx');
    //                $spreadsheet = IOFactory::load($templatePath);
    //                $templateSheet = $spreadsheet->getActiveSheet();
    //
    //                // Copy the template's styles and structure into the working sheet
    //                $this->copyTemplate($templateSheet, $sheet);
    //
    //                // Start inserting data at the required cell (e.g., B8)
    //                $this->insertPPData($sheet);
    //            },
    //        ];
    //    }

    //    public function registerEvents(): array {
    //        return [
    //            BeforeWriting::class => function (BeforeWriting $event) {
    //                // Load the template
    //                $templateFile = new LocalTemporaryFile(storage_path('app/templates/excel/op/op_values_template.xlsx'));
    //                $event->writer->reopen($templateFile, Excel::XLSX);
    //
    //                // Get the active sheet from the template
    //                $sheet = $event->writer->getSheetByIndex(0)->getDelegate();
    //
    //                // Insert data into the template starting at B8
    //                $this->insertPPData($sheet);
    //
    //                return $event->getWriter()->getSheetByIndex(0);
    //            },
    //        ];
    //    }

    public function registerEvents(): array {
        return [
            BeforeWriting::class => function (BeforeWriting $event) {
                // Load the template
                $templateFile = new LocalTemporaryFile(resource_path('templates/excel/op/op_values_template.xlsx'));
                $event->writer->reopen($templateFile, Excel::XLSX);

                // Get the active sheet from the template
                $sheet = $event->writer->getSheetByIndex(0)->getDelegate();

                // Insert metadata (OP number, code, etc.)
                $this->insertMetadata($sheet);

                // Insert tabular data starting at B8
                $this->insertPPData($sheet);

                // Insert stakeholder name for signature placeholder
                $this->insertStakeholderNames($sheet);

                return $event->getWriter()->getSheetByIndex(0);
            },
        ];
    }

    /**
     * @throws DateMalformedStringException
     */
    private function insertMetadata(Worksheet $sheet): void {
        // Example positions for metadata
        $sheet->setCellValue('E3', $this->op->department);
        $sheet->setCellValue('E4', $this->op->code);
        $sheet->setCellValue('L2', $this->op->no);

        $dateNeeded = $this->op->date_needed;
        if ($this->op->isValidDate()) {
            $dateNeeded = (new DateTime($this->op->date_needed))->format('d F Y');
        }

        $sheet->setCellValue('L4', $dateNeeded);
    }

    private function insertPPData(Worksheet $sheet): void {
        $rowIndex = 8; // Start tabular data at B8
        $maxRows = 16;
        $rowNumber = 1;

        foreach ($this->op->pps->take($maxRows) as $pp) {
            $itemNameParts = str_split($pp->item_name, 15); // Split names longer than 10 chars
            foreach ($itemNameParts as $partIndex => $part) {
                $sheet->setCellValue("D{$rowIndex}", $part); // Item name

                if ($partIndex === 0) { // Only insert other columns on the first part
                    $sheet->setCellValueExplicit("B{$rowIndex}", "{$rowNumber}.", DataType::TYPE_STRING);
                    //                    $sheet->setCellValue("F{$rowIndex}", $pp->id); // INDEX
                    $sheet->setCellValue("G{$rowIndex}", $pp->remaining); // Remaining
                    $sheet->setCellValue("H{$rowIndex}", $pp->need); // Needs
                    //                    $sheet->setCellValue("I{$rowIndex}", $pp->buy); // Buy
                    $sheet->setCellValue("J{$rowIndex}", $pp->unit); // Unit
                    $sheet->setCellValueExplicit("K{$rowIndex}", $pp->need_date->format('d/m/y'), \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                    $sheet->setCellValue("L{$rowIndex}", $pp->description); // Description
                    $rowNumber++;
                }
                $rowIndex++;
            }
        }
    }

    private function insertStakeholderNames(Worksheet $sheet): void {
        $sheet->setCellValue('E27', $this->op->first_requestor);
        $sheet->setCellValue('F27', $this->op->second_requestor);
        $sheet->setCellValue('J27', $this->op->approved_by);
        $sheet->setCellValue('L27', $this->op->headOfSection->name);
    }

    /**
     * @throws Exception
     */
    private function copyTemplate(Worksheet $sourceSheet, Worksheet $targetSheet): void {
        // Copy cell values, styles, and rich text
        foreach ($sourceSheet->getRowIterator() as $row) {
            foreach ($row->getCellIterator() as $cell) {
                $targetCell = $cell->getCoordinate();
                $cellValue = $cell->getValue();

                // Check if the cell has rich text
                $richText = $cell->getValue();
                if ($richText instanceof \PhpOffice\PhpSpreadsheet\RichText\RichText) {
                    $targetSheet->getCell($targetCell)->setValue($richText);
                } else {
                    $targetSheet->setCellValue($targetCell, $cellValue);
                }

                // Copy styles
                $targetSheet->getStyle($targetCell)->applyFromArray(
                    $sourceSheet->getStyle($targetCell)->exportArray()
                );
            }
        }

        // Copy column widths
        foreach (range('A', $sourceSheet->getHighestColumn()) as $column) {
            $width = $sourceSheet->getColumnDimension($column)->getWidth();
            if ($width > -1) {
                $targetSheet->getColumnDimension($column)->setWidth($width);
            }
        }

        // Copy row heights
        foreach ($sourceSheet->getRowDimensions() as $rowIndex => $rowDimension) {
            $height = $rowDimension->getRowHeight();
            if ($height > -1) {
                $targetSheet->getRowDimension($rowIndex)->setRowHeight($height);
            }
        }

        // Copy merged cells
        foreach ($sourceSheet->getMergeCells() as $mergeCell) {
            $targetSheet->mergeCells($mergeCell);
        }
    }

    //    private function insertPPData(Worksheet $sheet) {
    //        $rowIndex = 8; // Start at B8
    //        $maxRows = 16;
    //
    //        foreach ($this->op->pps->take($maxRows) as $pp) {
    //            $itemNameParts = str_split($pp->item_name, 10); // Split names longer than 10 chars
    //            foreach ($itemNameParts as $partIndex => $part) {
    //                $sheet->setCellValue("B{$rowIndex}", $part); // Item name
    //
    //                if ($partIndex === 0) { // Only insert other columns on the first part
    //                    $sheet->setCellValue("A{$rowIndex}", $pp->id); // NO
    //                    $sheet->setCellValue("D{$rowIndex}", $pp->remaining);
    //                    $sheet->setCellValue("E{$rowIndex}", $pp->need);
    //                    $sheet->setCellValue("F{$rowIndex}", $pp->buy);
    //                    $sheet->setCellValue("G{$rowIndex}", $pp->unit);
    //                    $sheet->setCellValue("H{$rowIndex}", $pp->need_date->format('d-m-y'));
    //                    $sheet->setCellValue("I{$rowIndex}", $pp->description);
    //                }
    //                $rowIndex++;
    //            }
    //        }
    //    }
}
