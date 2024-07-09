<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlayerRequest;
use App\Http\Resources\PlayerResource;
use App\Models\Player;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayersController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PlayerResource::collection
        (
            Player::where('player_id', Auth::user()->id)->get()
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlayerRequest $request)
    {
        $request ->validated($request->all());
        $player = Player::create([
            "player_id"=>Auth::user()->id,
            "name"=> $request->name,
             "player_num"=> $request->player_num,
             "player_position"=> $request->player_position,
        ]);
           return new PlayerResource($player);
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player)
    {
        if(Auth::user()->id !== $player->player_id){
            return $this->error("",'You are not authorized to make this request',404);
        }
        return new PlayerResource($player);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Player $player)
    {
        if(Auth::user()->id !== $player->player_id){
            return $this->error("",'You are not authorized to make this request',404);
        }
    
        $player->update($request->all());
        return new PlayerResource($player);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player)
    {
        if(Auth::user()->id !== $player->player_id){
            return $this->error("",'You are not authorized to make this request',404);
        }
        $player->delete();
        return response("The Player has been deleted");
    }
}
/*if(Auth::user()->id !== $task->user_id ){
    return $this->error('','You are not allowed to make this request', 405);
}*/
