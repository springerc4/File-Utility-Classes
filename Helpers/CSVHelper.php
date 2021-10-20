<?php

// Class for CSV utilities
class CSVHelper {
    private $file;
    // Constructor for CSV Object
    public function __construct($file) {
        $this->file = $file;
    }

    // Read a CSV file into a PHP array
    public function readFile($element = null, $index = null) {
        $file = $this->file;
        if (!file_exists($file)) return [];
        $handle = fopen($file, 'r');
        while(!feof($handle)) {
            $records[] = fgetcsv($handle, 1024, ';');
        }
        fclose($handle);
        if (is_null($element) && is_null($index)) {
            return $records;
        }
        else if(is_null($index) && !is_null($element)) {
            return $records[$element];
        }
        else {
            return $records[$element][$index];
        }
    }

    // Write to a CSV file 
    public function writeFile($array, $append = false) {
        $file = $this->file;
        if (!file_exists($file)) return [];
        if ($append == true) {
            $handle = fopen($file, 'a');
        }
        else {
            $handle = fopen($file, 'w+');
        }
        for ($i = 0; $i < count($array); $i++) {
            if ($array[$i] == null) {
                break;
            }
            if (is_string($array[$i])) {
                if ($i == 0) {
                    fwrite($handle, $array[$i].';');
                }
                else if ($i == (count($array) - 1)){
                    fwrite($handle, $array[$i].PHP_EOL);
                }
                else {
                    fwrite($handle, $array[$i].';');
                }
            }
            else {
                $line = implode(';', $array[$i]);
                fwrite($handle, $line.PHP_EOL);
            }
        }
        fclose($handle);
    }

    // Function for modifying information in the JSON file
    public function modifyFile($new_record, $line = null, $record_index = null) {
        $array = $this->readFile();
        if (is_null($line) && is_null($record_index)) {
            $array = $new_record;
        }
        else if (is_null($record_index)) {
            $array[$line] = $new_record;
        }
        else {
            $array[$line][$record_index] = $new_record;
        }
        $this->writeFile($array);
    }

    // Function for deleting information from the JSON file
    public function deleteFrom($record = null, $index = null) {
        $array = $this->readFile();
        if (is_null($record) && is_null($index)) {
            $array = [];
        }
        else if (!is_null($record) && is_null($index)) {
            $array[$record] = [];
            for ($i = $record; $i < count($array); $i++) {
                if ($i == count($array) - 1) {
                    $array[$i] = null;
                    break;
                }
                $array[$i] = $array[$i + 1];
            }
        }
        else {
            $array[$record][$index] = null;
            for ($i = $index; $i < count($array[$record]); $i++) {
                if ($i == count($array[$record]) - 1) {
                    $array[$record][$i] = null;
                    break;
                }
                $array[$record][$i] = $array[$record][$i + 1];
            }
        }
        $this->writeFile($array);
    }

    // Check if user email is active in csv file
    public function contains($file, $input) {
        $contains = false;
        if (!file_exists($file)) return [];
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