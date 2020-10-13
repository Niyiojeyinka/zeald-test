<?php
use classes\Exporter;
use classes\Core;

class Controller  extends Core {

    private $exporter ;
    public $args;
    public function __construct($args)
    {
        $this->args =$args;
       $this->exporter= new Exporter();
    }
    public function playerstats($format){

        $data = [];
        $searchArgs = ['player', 'playerId', 'team', 'position', 'country'];
        $search = $this->args->filter(function($value, $key) use ($searchArgs) {
            return in_array($key, $searchArgs);
        });
        $data = $this->exporter->getPlayerStats($search);

        return $this->view("test",["data"=>$data,'headings'=>column2Headings($data)]);

    }


  public function players($format)
  {   $data = [];
     $searchArgs = ['player', 'playerId', 'team', 'position', 'country'];
    $search = $this->args->filter(function($value, $key) use ($searchArgs) {
        return in_array($key, $searchArgs);
    });
    $data = $this->exporter->getPlayers($search);
    if (!$data) {
        exit("Error: No data found!");
    }
  //  return $this->exporter->format($data, $format);
  }
   
}