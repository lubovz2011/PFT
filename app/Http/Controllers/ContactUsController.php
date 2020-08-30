<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function sendContactUsEmail(Request $request)
    {
        $this->validate($request, [
            'contact-email'     => 'bail|required|email|max:255',
            'contact-subject'   => 'bail|required|max:255',
            'contact-message'   => 'bail|required|max:1024'
        ]);

        Mail::raw($request->input('contact-message'), function ($mail) use ($request)
        {
            $mail->from($request->input('contact-email'));
            $mail->to(config('mail.from.address'));
            $mail->subject("Contact us from ". $request->input('contact-email') . ". " . $request->input('contact-subject'));
        });

        return redirect()->back();
    }

}
