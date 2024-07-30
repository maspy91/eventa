<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Http\Requests\StoreEventsRequest;
use App\Http\Requests\UpdateEventsRequest;
use App\Http\Resources\EventsCollection;
use App\Http\Resources\EventsResource;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class EventsController extends Controller
{

    public function index(){

        return new EventsCollection(Events::all());

    }

    public function show(Events $event){

        return new EventsResource($event);

    }

    public function store(StoreEventsRequest $request, Events $event)
    {
        
        $validated = $request->validated();

        $this->authorize('create', $event);

        $event = Auth::user()->events()->create($validated);

        return new EventsResource($event);

    }
    
    
    public function update(UpdateEventsRequest $request, Events $event){
       
        $validated = $request->validated();

        $this->authorize('update', $event);

        $event->update($validated);

        return new EventsResource($event);

    }

    public function destroy(Events $event){
                
        $this->authorize('delete', $event);
        
        $event->delete();

        return response()->noContent();

    }
}