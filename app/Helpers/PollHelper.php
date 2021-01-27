<?php
namespace App\Helpers;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\PollController;
use App\Models\Options;
use App\Models\Poll;
use Illuminate\Http\Request;

class PollHelper {
    public function __construct(){
      $this->opt = new Options();
      $this->poll = new Poll();
    //   $this->optController = new OptionController($this->opt);
    //   $this->pollController = new PollController($this->poll);
    }

 public function getOptions(int $id){
    $x = Options::where('id_poll', $id)->get();
    return $x;
 }
}

?>
