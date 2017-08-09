<?php
namespace app\controllers;

use app\models\Model;

class Controller
{

    function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    public function run()
    {
        try {
            $words = $this->calculate();
            echo "Distinct unique words: " . count($words);
            echo "\n";
            $compared = $this->compare($words);
            $this->show($compared);
        } catch (\Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    private function openFile() {
        $source = @fopen($this->fileName, "r");
        if (is_null($source) || empty($source)) {
            throw new \Exception("Error: File can not be empty.");
        }
        return $source;
    }

    private function calculate()
    {
        $uniqueW = [];
        try {
            $handle = $this->openFile($this->fileName);
            if ($handle) {
                while (($buffer = fgets($handle, 4096)) !== false) {
                    $words = str_word_count($buffer, 1);
                    foreach ($words as $value) {
                        //$value = strtolower($value);
                        if (!key_exists($value, $uniqueW)) {
                            $uniqueW[$value] = 1;
                        }
                    }
                }
            }
        } finally {
            if(!is_null($handle)){
                fclose($handle);
            }
        }
        return $uniqueW;
    }

    public function compare($words)
    {
        $coincidences = [];
        if (!empty($words)) {
            $model = new Model();
            $watchlist = $model->getAll();
            foreach ($watchlist as $row) {
                if (key_exists($row['special_interest'], $words)) {
                    $coincidences[] = $row['special_interest'];
                }
            }
        }
        return $coincidences;
    }

    private function show($compared) {
        foreach ($compared as $value) {
            echo $value;
            echo "\n";
        }
        echo "-------------------------------------";
        echo "\n";
    }
}
