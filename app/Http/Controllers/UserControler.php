<?php

namespace App\Http\Controllers;

use App\Models\Movimentacao;
use App\Models\TipoMovimentacao;
use App\Models\ContaCorrente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function criar(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movimentacao  $movimentacao
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }
}
