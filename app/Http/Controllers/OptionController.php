<?php

namespace App\Http\Controllers;

use App\Models\Options;
use App\Helpers\GoogleClientHelper;
use Illuminate\Http\Request;

class OptionController extends Controller
{
   private $option;

    public function __construct(Options $opt)
    {
        $this->option = $opt;
    }

    public function buscarTodos(){
        return $this->option->all();
    }

    public function buscarPollOpt(int $id){
        // $x = $this->option->find("poll_id", $id)->get();
        $x = Options::where('id_poll', $id)->get();
        return $x;
    }

    public function saveVote(int $id){
       $o = $this->option->find($id);

       $o->votes = $o->votes+1;
       $o->save();


        return response()->json($o);
    }

}

?>
