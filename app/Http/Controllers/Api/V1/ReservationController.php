<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\ReservationsStatusEnum;
use App\Enums\UserTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ReserveRequest;
use App\Http\Requests\Api\CancelReservationRequest;
use App\Http\Resources\Api\V1\ReservationResource;
use App\Models\Reservation;
use App\Models\Studio;

class ReservationController extends Controller
{    
    public const LOCK_RESERVATION_AFTER = 15; // minutes;

    
    public function index()
    {
        $reservations = Reservation::query();

        // If customer;
        $reservations->when(auth()->user()->user_type == UserTypeEnum::CUSTOMER, function($query){
            return $query->where('customer_id', auth()->id());
        });

        // If employees: Current logged in studio
        $reservations->when(auth()->user()->user_type == UserTypeEnum::EMPLOYEE, function($query){
            $payload = auth()->payload();
            $studioId = $payload ? $payload->get('studio_id') : null;
            return $query->where('studio_id', $studioId);
        });
        
        // If StudioOwners: get studios reservations
        $reservations->when(auth()->user()->user_type == UserTypeEnum::STUDIO_OWNER, function($query){
            return $query->whereIn('studio_id', auth()->user()->studios()->pluck('id')->toArray());
        });

        $reservations = $reservations->latest('id')->paginate(10);

        return $this->sendSuccess('Reservations', ReservationResource::collection($reservations)->response()->getData(true));
    }

    public function studios()
    {
        # code...
    }

    /**
     * reserve
     *
     * @param  mixed $request
     * @return Json
     */
    public function reserve(ReserveRequest $request)
    {
        $data = $request->validated();
        $data['customer_id'] = auth()->id();

        // Get studio
        $studio = Studio::find($request->safe()->studio_id);

        // Check reservations
        $reservations_per_day = Reservation::where('studio_id', $studio->id)
                                ->whereDate('created_at', now()->toDateString())
                                ->where('status', ReservationsStatusEnum::ACTIVE)
                                ->count();

        if($reservations_per_day > $studio->max_day_reservations)
            return $this->sendError('Sorry! Cannot make reservation, limit exceeded!');

        // Create the reservation
        $reservation = Reservation::create($data);
        return $this->sendSuccess('Reservation created successfully!', $reservation->id, 201);
    }
    
    /**
     * cancel
     *
     * @param  mixed $id
     * @return Json
     */
    public function cancel(CancelReservationRequest $request)
    {
        $reservation = Reservation::find($request->safe()->reservation_id);
        
        // Check time
        if(now()->diffInMinutes($reservation->created_at) >= self::LOCK_RESERVATION_AFTER)
            return $this->sendError('Sorry! Cannot cancel the reservation because you have passed the time allowed!');

        $reservation->update(['status' => ReservationsStatusEnum::CANCELLED]);

        return $this->sendSuccess('Reservation updated', $reservation->toArray());
    }
}
