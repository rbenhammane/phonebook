<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PhoneNumber;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PhoneNumberController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request, $page = 1, $perPage = 10)
    {
        $search = $request->input('search');


        if (isset($search))
        {
            $phoneNumbers = PhoneNumber::where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('phone_number', 'LIKE', '%' . $search . '%')
                ->orWhere('created_at', 'LIKE', '%' . $search . '%')
                ->orWhere('notes', 'LIKE', '%' . $search . '%')
                ->limit($perPage)->offset(($page - 1) * $perPage)->get();

            $total = PhoneNumber::where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('phone_number', 'LIKE', '%' . $search . '%')
                ->orWhere('created_at', 'LIKE', '%' . $search . '%')
                ->orWhere('notes', 'LIKE', '%' . $search . '%')
                ->count();
        }
        else
        {
            $phoneNumbers = PhoneNumber::limit($perPage)->offset(($page - 1) * $perPage)->get();
            $total = PhoneNumber::count();
        }

        // If the requested page is above the total records, reset it to 1
        if ($page > ceil($total / $perPage))
        {
            $page = 1;
        }

        return view('phonenumber.index', ['phoneNumbers' => $phoneNumbers, 'search' => $search, 'page' => $page, 'perPage' => $perPage, 'total' => $total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('phonenumber.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'phone_number' => 'required|regex:/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/|unique:phone_table',
            'notes' => 'required'
        ]);

        $phoneNumber = new PhoneNumber;

        $phoneNumber->name = $request->name;
        $phoneNumber->phone_number = $request->phone_number;
        $phoneNumber->notes = $request->notes;

        $phoneNumber->save();

        return redirect()->route('phonenumber');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $phoneNumber = PhoneNumber::find($id);

        return view('phonenumber.create', [ 'phonenumber' => $phoneNumber ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'phone_number' => 'required|regex:/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/|unique:phone_table',
            'notes' => 'required'
        ]);
        
        $phoneNumber = PhoneNumber::find($id);

        $phoneNumber->name = $request->name;
        $phoneNumber->phone_number = $request->phone_number;
        $phoneNumber->notes = $request->notes;

        $phoneNumber->save();

        return redirect()->route('phonenumber');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        PhoneNumber::destroy($request->ids);

        return redirect()->route('phonenumber');
    }
}
