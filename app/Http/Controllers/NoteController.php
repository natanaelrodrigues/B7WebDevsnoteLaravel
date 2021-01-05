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

    public function new(Request $request){
        $title = $request->input('title');
        $body = $request->input('body');

        if($title && $body){

            $note = new Note();
            $note->title = $title;
            $note->body = $body;
            $note->save();

            $this->data['result'] = [
                'id' => $note->id,
                'title' => $title,
                'body' => $body
            ];

        }else {
            $this->data['error'] = 'Campos não enviados';
        }

        return $this->data;
    }

    public function edit(Request $request, $id) {

        $title = $request->input('title');
        $body = $request->input('body');

        if($id && $title && $body){
            $note  = Note::find($id);

            if($note) {
                $note->title = $title;
                $note->body = $body;
                $note->save();

                $this->data['result'] = [
                    'id' => $id,
                    'title' => $title,
                    'body' => $body
                ];
            } else {
                $this->data['error'] = 'ID Inexistente.';    
            }
        } else {
            $this->data['error'] = 'Campos não enviados';
        }

        return $this->data;
    }
    
}
