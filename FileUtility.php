<?php
// Abstract class for all file utilities
abstract class FileUtility {
    public $file;

    // Create a Constructor for FileUtility
    public function __construct($file) {
        $this->file = $file;
    }

    // Function for reading the file
    abstract public function readFile();

    // Function for writing to the file
    abstract public function writeFile($array);

    // Function for deleting information in the file
    public function deleteFrom($file, $record) {
        $array = $this->readFile($file);
        $array[$record] = null;
        for ($i = $record; $i < count($array); $i++) {
            if ($i == count($array) - 1) {
                $array[$i] = null;
                break;
            }
            $array[$i] = $array[$i + 1];
        }
        $this->writeFile($array);
    }

    // Function for modifying information in the file 
    public function modifyFile($file, $line, $record_index, $new_record) {
        $array = $this->readFile($file);
        $array[$line][$record_index] = $new_record;
        $this->writeFile($array);
    }

    // Check if an item is in the file 
    abstract public function contains($input);

}

?>