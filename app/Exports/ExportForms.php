<?php

namespace App\Exports;

use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportForms {

    public function export($query, $titles, $fields, $filename) {
        $headers = [
            'Content-Encoding' => 'UTF-8',
            'Content-Type' => 'text/csv;charset=UTF-8',
            'Content-Disposition' => "attachment; filename={$filename}.csv",
        ];

        $response = new StreamedResponse(function () use ($query, $headers, $titles, $fields) {
            // Open output stream
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($handle, $titles);
            $query::where('id', 100)->chunk(100, function ($records) use ($handle, $titles, $fields) {
                foreach ($records as $record) {
                    // Add a new row with data
                    fputcsv($handle, $this->getRows($record, $fields));
                }

            });
            // Close the output stream
            fclose($handle);
        }, 200, $headers);

        return $response;
    }



    private function getRows($value, $fields) {
        $row = [];
        foreach ($fields as $field) {
            $row[] = $value[$field];
        }
        return $row;
    }
}