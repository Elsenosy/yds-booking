<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return $this->sendSuccess('Employees', User::employees()->paginate(10));
    }
    
    /**
     * changeStudio
     *
     * @param  int $studio
     * @return Json
     */
    public function changeStudio(int $studio)
    {
        $studio = auth()->user()->employeeStudios()->where('id', $studio)->first();

        if(!$studio)
            return $this->sendError('Studio not found!');

        // Inject studioID to the token 
        $token = auth()->claims(['studio_id' => $studio->id])->login(auth()->user());
        
        // Check if everything works well
        $payload = auth()->payload();
        if(filled($payload) && $payload->get('studio_id') == $studio->id){
            auth()->setToken($token);
            return $this->sendSuccess('Switched to studio: '.$studio->name, ['token' => $token]);
        }

        return $this->sendError('Cannot switch to the studio!');
    }
}
