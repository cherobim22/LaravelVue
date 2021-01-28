<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\Options;
use App\Helpers\PollHelper;
use Illuminate\Http\Request;


class PollController extends Controller
{

    public function __construct(Poll $polls, Options $options)
    {
        $pollhelper = new PollHelper;
        $this->helper = $pollhelper;
        $this->poll = $polls;
        $this->opt = $options;
    }

    //função que busca todas as enquetes
    public function buscarTodos(){
        return $this->poll->all();
    }

    //função que retorna o status da enquete
    public function getStatus(int $id){
        $po =   $this->poll->find($id);
        $op =  $this->helper->getOptions($id);

        $aux = [
            "views" => $po->views
        ];
        for($i=0; $i<=2; $i++){
            $aux['options'][$i] =  ["option_id" => $op[$i]->id, "votes" => $op[$i]->votes];
        }

        return response()->json($aux);
    }

    //funcção que retorna a enquete com as opções
    public function getPoll(int $id){
       $p =   $this->poll->find($id);
       $o =  $this->helper->getOptions($id);

       $aux = [
        "poll_id" => $p->id,
           "poll_description" => $p->description,
       ];

       for($i=0; $i<=2; $i++){
           $aux['options'][$i] =  ["option_id" => $o[$i]->id, "option_description" => $o[$i]->name, "votes" => $o[$i]->votes] ;

       }

       $p->views = $p->views+1;
       $p->save();

        return response()->json($aux);

    }
    public function create(Request $request){

        $this->poll->description = $request->input('description');
        $this->poll->views = 0;
        $this->poll->save();

        $aux = [
                ['name'=>$request->input("option.0.nome"), 'id_poll'=> $this->poll->id, 'votes'=>0],
                ['name'=>$request->input("option.1.nome"), 'id_poll'=> $this->poll->id, 'votes'=>0],
                ['name'=>$request->input("option.2.nome"), 'id_poll'=> $this->poll->id, 'votes'=>0]

        ];
        $this->opt->insert($aux);


        return response()->json($this->poll->id);

    }

    public function Saveopt(int $id, string $name){
        $this->opt->name = $name;
        $this->opt->id_poll = $id;
        $this->opt->votes = 0;
        $this->opt->save();
    }

}

?>
