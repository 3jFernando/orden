<?php

namespace App\Http\Controllers;

use App\Http\Utils\PaginationUtil;
use App\Models\Contact;
use App\Models\TypeContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\AssignOp\Concat;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $contacts = PaginationUtil::startPagination(auth()->user()->shop->contacts, 6);

        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = TypeContact::all();
        return view('admin.contacts.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'string|required|min:10',
            'phone' => 'integer|required|min:10',
            'email' => 'email|required',
            'type_id' => 'required|exists:App\Models\TypeContact,id',
        ]);

        $shop_id = auth()->user()->shop->id;
        
        Contact::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'shop_id' => $shop_id,
            'type_id' => $data['type_id']
        ]);    
        return redirect()->route('contacts.index')->with('success', 'Contaco actualizado con exito');
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        $types = TypeContact::all();
        return view('admin.contacts.edit', compact('contact', 'types'));
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
        $data = $request->validate([
            'name' => 'string|required|min:10',
            'phone' => 'integer|required|min:10',
            'email' => 'email|required',
            'type_id' => 'required|exists:App\Models\TypeContact,id',
        ]);

        $contact->update([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'type_id' => $data['type_id']
        ]);    
        return redirect()->route('contacts.index')->with('success', 'Contaco actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        try {

            $contact->delete();
            return redirect()->route('contacts.index')->with('success', 'Contacto eliminado con exito');
            
        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->route('contacts.index')->with('danger', 'No es posible eliminar el contacto ', $e->getMessage());
        }
    }
}
