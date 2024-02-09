<?php

namespace App\Console\Commands;

use App\Models\Rate;
use Illuminate\Console\Command;

class CreateRateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:rate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualizar tasa del día';

    /**
     * Execute the console command.
     */
    private function valor_dolar()
    {
        $url = "https://exchange.vcoud.com/coins/dolar-bcv?gap=1w&base=usd"; // URL del banco central
        $opts = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $context = stream_context_create($opts);
        $content = file_get_contents($url, false, $context);
        $valor = json_decode($content);
        // dd($valor->price);
        $number = $valor->price; // Almacenamos el tercer número en una variable
        return $number;
    }
    public function handle()
    {
        $rate = $this->valor_dolar();
        Rate::create(['monto' => $rate]);
        $this->info('Actualización creada exitosamente.');
    }
}
