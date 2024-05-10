<?php

namespace App\Http\Controllers;

use App\Models\ContactEnquiry;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class SupportController extends Controller
{
    public function sendContactEnquiry(Request $request)
    {

        $user_id = null;
        if (auth()->check()) {
            $user_id = auth()->user()->id;
        }

        $request->validate([
            'name' => 'string|required',
            'email' => 'email|required',
            'message' => 'string|required',
        ]);

        // TODO: maybe send an email?
        $enquiry = ContactEnquiry::create([
            'user_id' => $user_id,
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return response()->api(
            $enquiry,
            'Contact enquiry has been sent.',
            HttpResponse::HTTP_CREATED,
        );
    }
}
