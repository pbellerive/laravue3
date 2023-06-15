<?php

namespace App\ModuleA;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ModuleA\ModuleARepository;


class ModuleAController extends Controller
{
    public function __construct(ModuleARepository $moduleARepository)
    {
        $this->moduleARepository = $moduleARepository;
    }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }


    public function show(ModuleA $module)
    {
        return $module;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ModuleA  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ModuleA $module)
    {
    }

    public function uploadVideo(Request $request, ModuleA $module)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ModuleA  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModuleA $module)
    {
    }
}
