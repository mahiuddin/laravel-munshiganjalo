<?php

namespace App\Http\Controllers;

use App\Models\DistrictInformation;

class DistrictInformationController extends Controller
{
    public function show()
    {
        $information = DistrictInformation::publiclyVisible()
            ->with('district')
            ->firstOrFail();

        $information->increment('views');

        return view('district-information.show', compact('information'));
    }
}
