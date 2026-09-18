<?php                   //NUNCA DAR MERGE NAS ROTAS SOZINHO, SEMPRE CHAMAR EU "LUCI" E JESUS PARA 
                        // ACOMPANHAR O QUE FOI FEITO, SE DER MERGE SOZINHO, VAI DAR TODOS OS CONFLITOS
                        //  POSSIVEIS DESSE UNIVERSO E EU VOU TER QUE TE DESVIVER

                        //Obs: A partir de agora alteração de rota, comentar por favor.

namespace App\Http\Controllers\Desenvolvedor;

use App\Http\Controllers\Controller;
use App\Models\Pacote;
use App\Models\Galeria;
use App\Models\Depoimento;

class DesenvolvedorDashboardController extends Controller
{
    public function index()
    {
        $totalPacotes = Pacote::count();
        $totalFotos = Galeria::count();

        $totalDepoimentos = Depoimento::count();

        $mediaAvaliacoes = $totalDepoimentos > 0
            ? round(Depoimento::avg('nota'), 1)
            : 0;

        return view('desenvolvedor.dashboard', compact(
            'totalPacotes',
            'totalFotos',
            'totalDepoimentos',
            'mediaAvaliacoes'
        ));
    }
}