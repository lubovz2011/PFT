<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use mysql_xdevapi\Exception;

/**
 * Class ContactUsController
 * This class handle user commands on contact us
 *
 * @package App\Http\Controllers
 */
class ContactUsController extends Controller
{
    /**
     * Method send contact us email
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function sendContactUsEmail(Request $request)
    {
        $this->validate($request, [
            'contact-email'     => 'bail|required|email|max:255',
            'contact-subject'   => 'bail|required|max:255',
            'contact-message'   => 'bail|required|max:1024'
        ]);

        try {
            //throw new \Exception('test exception');
            Mail::raw($request->input('contact-message'), function ($mail) use ($request)
            {
                $mail->from($request->input('contact-email'));
                $mail->to(config('mail.from.address'));
                $mail->subject("Contact us from ". $request->input('contact-email') . ". " . $request->input('contact-subject'));
            });
        }
        catch (\Exception $e) {
            return redirect()->back()->with('send-status-error', 'Oops... Something went wrong. Please, try again later.');
        }

        return redirect()->back()->with('send-status', 'Your email was send successfully.');
    }
}
