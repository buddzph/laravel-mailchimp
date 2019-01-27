<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Newsletter;
use App\Mailchimp;

class MailchimpController extends Controller
{
    /**
     * Display list
     */
     public function index()
     {
         $contacts = Mailchimp::all();
         return view('home', [
             'contacts' => $contacts
         ]);
     }

    /**
     * Display add new contact
     */
    public function viewCreate()
    {
        return view('create');
    }

    /**
     * Post create new contact
     */
    public function create(Request $request)
    {
        if(! Newsletter::isSubscribed($request->email)) {
            Newsletter::subscribe($request->email, [
                'FNAME'    => $request->first_name,
                'LNAME'    => $request->last_name,
                'PHONE'    => $request->phone_number
            ]);

            $mailchimp = new Mailchimp;
            $mailchimp->email           = filter_var($request->email, FILTER_SANITIZE_STRING);
            $mailchimp->first_name      = filter_var($request->first_name, FILTER_SANITIZE_STRING);
            $mailchimp->last_name       = filter_var($request->last_name, FILTER_SANITIZE_STRING);
            $mailchimp->phone_number    = $request->phone_number;
            $mailchimp->save();

            return redirect('/')->with('success', 'New contact added successfully.');
        }

        return redirect('/create')->with('failure', 'Sorry email address is already subscribed!');
    }

    /**
     * Display update new contact
     * @param $cid
     */
    public function viewUpdate($cid)
    {
        $contact = Mailchimp::find($cid);
        return view('update', [
            'contact'   => $contact
        ]);
    }

    /**
     * Post update contact
     * @param $cid
     */
    public function update(Request $request, $cid)
    {
        if(Newsletter::isSubscribed($request->email)) {
            Newsletter::subscribeOrUpdate($request->email, [
                'FNAME'    => $request->first_name,
                'LNAME'    => $request->last_name,
                'PHONE'    => $request->phone_number
            ]);

            $mailchimp = Mailchimp::find($cid);
            $mailchimp->first_name      = filter_var($request->first_name, FILTER_SANITIZE_STRING);
            $mailchimp->last_name       = filter_var($request->last_name, FILTER_SANITIZE_STRING);
            $mailchimp->phone_number    = $request->phone_number;
            $mailchimp->save();

            return redirect('/')->with('success', 'Contact successfully updated.');
        }
    }

    /**
     * Delete contact
     * @param $cid
     */
    public function delete($cid) {
        $mailchimp = Mailchimp::find($cid);
        Newsletter::delete($mailchimp->email);
        $mailchimp->delete();

        return redirect('/')->with('success', 'Contact successfully deleted.');
    }
}
