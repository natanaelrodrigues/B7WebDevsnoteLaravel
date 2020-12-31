<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Note;

class NoteController extends Controller
{
    private $data = ['error'=>'', 'result' =>[]];

    public function all(){
        $notes = Note::all();

        foreach($notes as $note){
            $this->data['result'][] =[
                'id'=> $note->id,
                'title' => $note->title
            ]; 
        };

        return $this->data;
    }

    public function one($id){
        $note = Note::find($id);

        if( $note ){
            $this->data['result']= $note; 
        } else {
            $this->data['error'] = 'ID não encontrado.';
        }

        return $this->data;
    }
    
}
