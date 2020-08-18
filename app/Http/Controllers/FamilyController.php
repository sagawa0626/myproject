<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Family;
use App\User;
use Auth;
use Validator;

class FamilyController extends Controller
{
    public function index()
    {
        $families = Family::limit(100)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('families/index', ['families' => $families]);
    }

    public function create()
    {
        return view('families.create');
    }

    public function store(Request $request)
    {
        $families = new Family;
        $families->family_name = $request->family_name;
        $families->family_password = $request->family_password;
        $families->save();
        
        return redirect('/');
    }
}
