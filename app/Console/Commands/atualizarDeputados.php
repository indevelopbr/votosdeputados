<?php

namespace App\Console\Commands;

use App\Services\DeputadosServices;
use Illuminate\Console\Command;

class atualizarDeputados extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:atualizar-deputados';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $deputadosService = new DeputadosServices();
        
        $deputadosService->initUpdate();
    }
}
