<?php
// Class for CSV utilities
class CSVHelper extends FileUtility {
    
    // Constructor for CSV Object
    public function __construct($file) {
        parent::$file;
    }

    // Read a CSV file into a PHP array
    public function readFile() {
        $handle = fopen($file, 'r');
        while(!feof($handle)) {
            $records[] = fgetcsv($handle, 1024, ';');
        }
        fclose($handle);
        return $records;
    }

    // Write to a CSV file 
    public function writeFile($array) {
        $handle = fopen($file, 'w+');
        foreach($array as $records) {
            $line = explode(';', $records);
            fputcsv($handle, $line);
        }
        fclose($handle);
    }

    // Check if user email is active in csv file
    public function contains($input) {
        $contains = false;
        $handle = fopen($file, "r");
        while (!feof($handle)) {
            $record = fgetcsv($handle, 1024, ';');
            if ($record == '') {
                continue;
            }
            if ($record[0] == $input) {
                $contains = true;
                break;
            }
        }
        fclose($handle);
        return $contains;
    }

}

?>