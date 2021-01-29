<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

/**
 * POST     api/users/{id}/contacts	Create Contact
GET       api/users/{id}/contacts	Get All Contacts
GET       api/users/{id}/contacts?name={STRING}	Search Contacts by Name
GET       api/users/{id}/contacts?tag={TAGID}	Search Contacts by Tag
GET       api/users/{id}/contacts/{id}	Get Contact Details
PUT       api/users/{id}/contacts/{id}	Update Contact
DELETE  api/users/{id}/contacts/{id}	Delete Contact
GET       api/users/{id}/tags	Get All Tags For User
 */

class ContactController extends Controller
{
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
