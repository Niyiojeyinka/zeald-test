<?php
namespace classes;
use Illuminate\Support;  // https://laravel.com/docs/5.8/collections - provides the collect methods & collections class
use LSS\Array2Xml;
class Core {
    public $args;
    public function __construct($args) {
        $this->args = $args;
    }

    public function json($data)
    {
        header('Content-type: application/json');
        return json_encode($data->all());
    }

    public function xml($data)
    {
        header('Content-type: text/xml');

        // fix any keys starting with numbers
        $keyMap = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
        $xmlData = [];
        foreach ($data->all() as $row) {
        $xmlRow = [];
        foreach ($row as $key => $value) {
        $key = preg_replace_callback('(\d)', function($matches) use ($keyMap) {
        return $keyMap[$matches[0]] . '_';
        }, $key);
        $xmlRow[$key] = $value;
        }
        $xmlData[] = $xmlRow;
        }
        $xml = Array2XML::createXML('data', [
        'entry' => $xmlData
        ]);
        return $xml->saveXML();
    }
    public function view($fileDir,$vars = null)
    {
      if(!empty($vars)){
        extract($vars);
      }
      try {
        include("views".DIRECTORY_SEPARATOR.$fileDir.".php");
      } catch (\Exception $e) {
        throw new \Exception("Unknown file '$fileDir'");      
      }
    }
    public function csv($data)
    {
        header('Content-type: text/csv');
                header('Content-Disposition: attachment; filename="export.csv";');
                if (!$data->count()) {
                    return;
                }
                $csv = [];
                
                // extract headings
                // replace underscores with space & ucfirst each word for a decent headings
                $headings = collect($data->get(0))->keys();
                $headings = $headings->map(function($item, $key) {
                    return collect(explode('_', $item))
                        ->map(function($item, $key) {
                            return ucfirst($item);
                        })
                        ->join(' ');
                });
                $csv[] = $headings->join(',');

                // format data
                foreach ($data as $dataRow) {
                    $csv[] = implode(',', array_values($dataRow));
                }
                return implode("\n", $csv);
    }
}