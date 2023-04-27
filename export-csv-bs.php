<?php
/**
 * This class is used to export data to CSV file
 */
?>

<?php
class ExportCSV
{
    /**
     * @param array $data
     * @param string $fileName
     * @param string $delimiter
     * @return bool
     */
    
    static function exportDataToCSV($data_csv, $fileName = 'export', $delimiter = ';')
    {
        // open file pointer
        $f = fopen($fileName.'.csv', 'w');

        // set column headers
        $fields = array_keys($data_csv[0]);
        fputcsv($f, $fields, $delimiter);

        // output each row of the data, format line as csv and write to file pointer
        foreach ($data_csv as $line) {
            fputcsv($f, $line, $delimiter);
        }

        //header('Content-Type: text/csv');
        //header('Content-Disposition: attachment; filename="' . $fileName . '".csv');

        // exit from file
        fclose($f);
        exit();
    }
}
