<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreStudioRequest;
use App\Models\Studio;
use Illuminate\Http\Request;

class StudioController extends Controller
{    
    /**
     * index
     *
     * @return Json
     */
    public function index()
    {
        return $this->sendSuccess('Studios', Studio::select('id', 'name', 'max_day_reservations')->paginate(10));
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return Json
     */
    public function store(StoreStudioRequest $request)
    {
        $data = $request->validated();
        $data['owner_id'] = auth()->id();

        // Create the studio
        $studio = Studio::create($data);
        
        // Fill the employees
        if($request->filled('employees'))
            $studio->employees()->sync($request->employees);

        return $this->sendSuccess('Saved successfully', $studio->toArray());
    }
}
