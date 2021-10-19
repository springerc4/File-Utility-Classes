<?php
    require_once('JSONHelper.php');
    require_once('CSVHelper.php');
    // Class for Managing CSV/JSON entities based on file format
    class Entity {
        public $element;
        public $index;
        private $entity;
        // Constructor for Entity Class
        public function __construct($file, $element = null, $index = null) {
            if (preg_match('/\.csv/', $file) || preg_match('/\.CSV/', $file) || preg_match('/\.txt/', $file)) {
                $this->entity = new CSVHelper($file);
            }
            else if (preg_match('/\.json/', $file) || preg_match('/\.JSON/', $file)) {
                $this->entity = new JSONHelper($file);
            }
            else {
                echo 'File type is invalid.';
            }
            $this->element = $element;
            $this->index = $index;
        }


        // Set specified element to read or write
        public function setElement($element) {
            $this->element = $element;
        }

        // Set specified index
        public function setIndex($index) {
            $this->index = $index;
        }

        // Read content from the file
        public function readEntity($element = null, $index = null) {
            return $this->entity->readFile($element, $index);
        }

        // Add content to the file
        public function addEntity($new_entity, $append = false) {
            return $this->entity->writeFile($new_entity, $append);
        }

        // Modify an entity in a file
        public function modifyEntity($addition, $line = null, $record_index = null) {
            return $this->entity->modifyFile($addition, $line, $record_index);
        }

        // Delete an entity in a file
        public function deleteEntity($record = null, $index = null) {
            return $this->entity->deleteFrom($record, $index);
        }

    }

?>