<?php
use classes\Core;
use models\Model;

class Controller  extends Core {

    private $model ;
    public $args;
    public function __construct($args)
    {
        $this->args =$args;
       $this->model= new Model();
    }
    public function playerstats($format){
 
        $searchArgs = ['player', 'playerId', 'team', 'position', 'country'];
        $search = $this->args->filter(function($value, $key) use ($searchArgs) {
            return in_array($key, $searchArgs);
        });
        $data = $this->model->getPlayerStats($search);
     if (!$data) {
        exit("Error: No data found!");
    }
        $view = $format =="html"?["fileDir"=>"table_view",
                "vars"=>["data"=>$data,'headings'=>column2Headings($data)]
                ]:$data;

        return $this->render($view,$format);

    }


  public function players($format)
  {    
     $searchArgs = ['player', 'playerId', 'team', 'position', 'country'];
    $search = $this->args->filter(function($value, $key) use ($searchArgs) {
        return in_array($key, $searchArgs);
    });
    $data = $this->model->getPlayers($search);
    if (!$data) {
        exit("Error: No data found!");
    }
    $view = $format =="html"?["fileDir"=>"table_view",
                "vars"=>["data"=>$data,'headings'=>column2Headings($data)] 
                ]:$data;

        return $this->render($view,$format);
  }
   
}