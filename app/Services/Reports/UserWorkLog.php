<?php

namespace App\Services\Reports;

use App\Models\Timelog;

class UserWorkLog
{

    /**
     * Instancia do modelo Timelog
     */
    private static $timelog;

    /**
     * Criar instancia do modelo Timelog. Aplicação do padrão Singleton
     */
    public function getInstance()
    {
        if (!isset(self::$timelog)) {
            self::$timelog = new Timelog();
        }

        return self::$timelog;
    }

    /**
     * Obter o total de segundos trabalhados por usuário
     */
    public function getUsersTimelog()
    {
        return $this->getInstance()->query()
            ->selectRaw('user_id, SUM(seconds_logged) as seconds_logged')
            ->groupBy('user_id')
            ->get();
    }

    /**
     * Obter a quantidade de tarefas, separados por component (categoria), mais o tempo total gasto
     */
    public function getComponentMetadata()
    {
        return $this->getInstance()->query()
            ->selectRaw('ci.component_id, COUNT(ci.issue_id) as number_of_issues, SUM(ts.seconds_logged) as seconds_logged')
            ->fromRaw('component_issues AS ci, (SELECT t.issue_id, SUM(t.seconds_logged) as seconds_logged FROM timelogs AS t GROUP BY t.issue_id) AS ts')
            ->whereRaw('ci.issue_id = ts.issue_id')
            ->groupBy('ci.component_id')
            ->orderBy('ci.component_id', 'ASC')
            ->get();
    }
}
