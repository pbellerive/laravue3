<?php

namespace App\ModuleA;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ModuleA\ModuleARepository;

use function App\Helpers\resizeImage;

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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function show(ModuleA $exercise)
    {
        return $exercise;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ModuleA $exercise)
    {
    }

    public function uploadVideo(Request $request, ModuleA $exercise)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModuleA $exercise)
    {
    }
}
