<?php

namespace App\Infra;

class Reader
{

    public function read($file)
    {
        $results = [];
        $handle = fopen($file, "r");
        if ($handle) {
            while (($buffer = fgets($handle)) !== false) {
                $results[] = $buffer;
            }
            if (!feof($handle)) {
                echo "Erreur: fgets() a échoué\n";
            }
            fclose($handle);
        }

        return $results;
    }
}