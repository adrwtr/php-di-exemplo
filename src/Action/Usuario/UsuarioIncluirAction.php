<?php
declare(strict_types=1);

namespace App\Action\Usuario;

use Psr\Http\Message\ResponseInterface as Response;
use App\Action\Action;
use App\Service\UsuarioService;
use App\Domain\Repository\UsuarioRepository;

class UsuarioIncluirAction extends UsuarioAction
{
    protected function action(): Response
    {
        $objJsonBody = $this->getFormData();
     
        $arrUsuarios = $this->getUsuarioService()->inserirUsuario(
            $objJsonBody
        );

        return $this->respondWithData($arrUsuarios);
    }
}
