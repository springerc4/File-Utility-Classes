<?php

// Class for JSON utilities
class JSONHelper {
    private $file;
    // Constructor for JSON Utility
    public function __construct($file) {
        $this->file = $file;
    }

    // Read a JSON file into a PHP array
    public function readFile($element = null, $index = null) {
        $file = $this->file;
        if (!file_exists($file)) return [];
        $content = file_get_contents($file);
        $array = json_decode($content, true);
        if (is_null($element) && is_null($index)) {
            return $array;
        }
        else if(is_null($index) && !is_null($element)) {
            return $array[$element];
        }
        else {
            return $array[$element][$index];
        }
    }

    // Write to a JSON file 
    public function writeFile($array, $append = false) {
        $file = $this->file;
        if (!file_exists($file)) return [];
        if ($append) {
            $handle = fopen($file, 'a+');
            $content = file_get_contents($file);
            $data = json_decode($content);
            $data[] = $array;
            file_put_contents($file, json_encode($data));
            fclose($handle);
        }
        else {
            $handle = fopen($file, 'w+');
            fwrite($handle, json_encode($array, JSON_PRETTY_PRINT));
            fclose($handle);
        }
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
        if (is_null($record)) {
            $array = [];
        }
        else if (!is_null($record) && is_null($index)) {
            $array[$record] = null;
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
                    $record[$i] = null;
                    break;
                }
                $array[$record][$i] = $array[$record][$i + 1];
            }
        }
        $this->writeFile($array);
    }

    // Check if item is in JSON file
    public function contains($input) {
        $contains = false;
        $array = $this->readFile();
        for ($i = 0; $i < count($array); $i++) {
            for ($j = 0; $j < count($array[$i]); $j++) {
                if ($array[$i] == $input) $contains = true;
            }
        }
        return $contains;
    }
    
}

?>