<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Box\Spout\Common\Entity\Style\Border;
use Box\Spout\Writer\Common\Creator\Style\BorderBuilder;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Common\Entity\Style\Color;
use Illuminate\Http\Request;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Writer\Common\Creator\WriterFactory;
use Box\Spout\Reader\ReaderFactory;
//use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

class ExportController extends Controller
{
    // public function exportExcel()
    // {
    //     $title = ['Row ID', 'Order ID', 'Order Date', 'Order Priority', 'Order Quantity', 'Sales',
    //               'Discount', 'Ship Mode', 'Profit', 'Unit Price', 'Shipping Cost', 'Customer Name',
    //               'Province', 'Region', 'Customer Segment', 'Product Category', 'Product Sub-Category',
    //               'Product Name', 'Product Container', 'Product Base Margin', 'Ship Date'];

    //     $fileName = 'Export Excel.xlsx';

    //             // Mendefinisikan tipe file yang akan ditulis
    //     $writerType = Type::XLSX;

    //     // Membuat objek writer dengan WriterFactory
    //     $writer = WriterFactory::createFromType($writerType);

    //     // $writer = WriterFactory::create(Type::XLSX); // for XLSX files

    //     $customers = Transaksi::all(); // dapatkan seluruh data customer

    //     $writer->openToBrowser($fileName); // stream data directly to the browser
    //     $writer->addRow($title); // tambahkan judul dibaris pertama

    //     foreach ($customers as $idx => $data) {
    //         $writer->addRow($data->toArray()); // tambakan data data per baris
    //     }
    //     $writer->close();
    // }

    // public function exportData()
    // {
    //     $fileName = "data.xlsx";
    //     $filePath = storage_path('app/' . $fileName);

    //     $writer = WriterFactory::createFromType(Type::XLSX);
    //     $writer->openToFile($filePath);
    //     $writer->getCurrentSheet()
    //         ->setName('Sheet1');


    //     $borderStyle = (new StyleBuilder())
    //     ->setBorder(
    //         (new BorderBuilder())
    //             ->setBorderBottom(Color::BLACK, Border::WIDTH_MEDIUM, Border::STYLE_SOLID)
    //             ->setBorderLeft(Color::BLACK, Border::WIDTH_MEDIUM, Border::STYLE_SOLID)
    //             ->setBorderRight(Color::BLACK, Border::WIDTH_MEDIUM, Border::STYLE_SOLID)
    //             ->setBorderTop(Color::BLACK, Border::WIDTH_MEDIUM, Border::STYLE_SOLID)
    //             ->build()
    //     )
    //     ->build();
    //     $headerRow = WriterEntityFactory::createRowFromArray(['ID', 'Nama','Alamat', 'Price', 'Total'], $borderStyle);
    //     $writer->addRow($headerRow);

    //     $transactions = Transaksi::all();

    //     foreach ($transactions as $transaction) {
    //         $row = [
    //             $transaction->id,
    //             $transaction->user->name,
    //             $transaction->address,
    //             $transaction->shipping_price,
    //             $transaction->total_price,
    //         ];

    //         $writer->addRow(WriterEntityFactory::createRowFromArray($row, $borderStyle));
    //     }

    //     $writer->close();

    //     return response()->download($filePath, $fileName);
    // }

    public function exportData()
    {
        $fileName = "data.xlsx";
        $filePath = storage_path('app/' . $fileName);

        $writer = WriterFactory::createFromType(Type::XLSX);
        $writer->openToFile($filePath);
        $writer->getCurrentSheet()
            ->setName('Sheet1');
        //->setShouldCreateNewSheetsAutomatically(true);

        // set header style

        $borderStyle = (new StyleBuilder())
            ->setBorder(
                (new BorderBuilder())
                    ->setBorderBottom(Color::BLACK, Border::WIDTH_MEDIUM, Border::STYLE_SOLID)
                    ->setBorderLeft(Color::BLACK, Border::WIDTH_MEDIUM, Border::STYLE_SOLID)
                    ->setBorderRight(Color::BLACK, Border::WIDTH_MEDIUM, Border::STYLE_SOLID)
                    ->setBorderTop(Color::BLACK, Border::WIDTH_MEDIUM, Border::STYLE_SOLID)
                    ->build()
            )
            ->build();

        // write header row
        $headerRow = WriterEntityFactory::createRowFromArray(['No', 'Customer Name', 'Product Name', 'Total Price', 'Shipping Price', 'Total Price + Shipping', 'Status', 'Transaction Date', 'Payment Method'], $borderStyle);
        $writer->addRow($headerRow);

        $transactions = Transaksi::where('status', 'paid')->get();

        $no = 1;
        foreach ($transactions as $transaction) {
            $row = [
                $no++,
                $transaction->user->name,
            ];
            // foreach ($transaction->transactionItems as $item) {
            //     $row[] = implode(',',$item->product->name);
            //     //$productNames[] = $item->product->name;
            // }
            $productNames = array();
            foreach ($transaction->transactionItems as $item) {
                $productNames[] = $item->product->name;
            }
            $productNamesString = join(', ', $productNames);
            $row[] = $productNamesString;
            //$row[] = implode(',', $productNames);
            $row[] = $transaction->total_price;
            $row[] = $transaction->shipping_price;
            $row[] = $transaction->total_price + $transaction->shipping_price;
            $row[] = $transaction->status;
            $row[] = $transaction->created_at_formatted ?: 'null';
            $row[] = $transaction->payment;

            $writer->addRow(WriterEntityFactory::createRowFromArray($row, $borderStyle));
        }

        $writer->close();

        return response()->download($filePath, $fileName);
    }

}
