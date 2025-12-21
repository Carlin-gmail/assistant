<?php
namespace App\Services;

class CreateCsvService
{
    // broke the file into a multidimensional array
    public function textToArray($data): array
    {
        $text = $data;

        $arr = explode("\n", trim($text));
        $cell = [];
        foreach($arr as $line){
            $cell[] = explode("\t", trim($line));
        }
        // dd($cell);
        return $cell;
    }
}
