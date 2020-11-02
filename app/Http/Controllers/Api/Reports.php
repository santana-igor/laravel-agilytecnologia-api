<?php

namespace App\Http\Controllers\Api;

use App\Services\Reports\UserWorkLog;
use App\Http\Controllers\Controller;

class Reports extends Controller
{
    /**
     * Listagem do total de segundos trabalhados por usuário
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUsersTimelog()
    {
        try {
            $UserWorkLog = new UserWorkLog();
            return Response()->json($UserWorkLog->getUsersTimelog(), 200);
        } catch (\Exception $ex) {
            return Response()->json($ex->getMessage(), 500);
        }
    }

    /**
     * Listagem da quantidade de usuários que trabalharam, divididos por component (categoria), mais o tempo total gasto
     *
     * @return \Illuminate\Http\Response
     */
    public function indexComponentMetadata()
    {
        try {
            $UserWorkLog = new UserWorkLog();
            return Response()->json($UserWorkLog->getComponentMetadata(), 200);
        } catch (\Exception $ex) {
            return Response()->json($ex->getMessage(), 500);
        }

    }
}
