<?php

namespace App\Settings;

use App\Settings\Country;
use App\Settings\CountryResourceCollection;
use App\Settings\StateResourceCollection;
use App\Settings\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchCountries()
    {
        return new CountryResourceCollection(Country::all());
    }

    public function fetchStates()
    {
        return new StateResourceCollection(State::all());
    }
}
