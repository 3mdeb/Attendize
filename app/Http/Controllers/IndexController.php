<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * redirect index page
     * @param  Request $request http request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function showIndex(Request $request)
    {
        // Organiser's number, which is shown as the start page
        $organiser_id = 1;

        return redirect()->route('showOrganiserHome', $organiser_id);
    }
}
