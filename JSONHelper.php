<?php
// Class for JSON utilities
class JSONHelper extends FileUtility {
    // Constructor for JSON Utility
    public function __construct($file) {
        parent::$file;
    }

    // Read a JSON file into a PHP array
    public function readFile() {
        if (!file_exists($file)) return [];
        $content = file_get_contents($file);
        $array = json_decode($content, true);
        return $array;
    }

    // Write to a JSON file 
    public function writeFile($array) {
        $handle = fopen($file, 'w+');
        fwrite($handle, json_encode($array, JSON_PRETTY_PRINT));
        fclose($handle);
    }

    // Check if item is in JSON file
    public function contains($input) {
        $contains = false;
        $array = $this->readFile($file);
        for ($i = 0; $i < count($array); $i++) {
            if ($array[$i] == $input) $contains = true;
        }
        return $contains;
    }
    
}

?>