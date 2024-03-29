<?php
declare(strict_types=1);

namespace Test\Service;

use App\Domain\Repository\UsuarioMemoryRepository;
use Test\TestCase;
use App\Domain\Model\Usuario;

class UsuarioServiceTest extends TestCase
{
    public function testGetUsuarioRepository()
    {
        $objUsuarioService = $this->getContainer()
            ->get(\App\Service\UsuarioService::class);

        $this->assertEquals(
            \App\Service\UsuarioService::class,
            get_class($objUsuarioService)
        );
    }

    public function testListarUsuarios()
    {
        $objUsuarioMemoryRepository = new UsuarioMemoryRepository();

        $objUsuarioService = $this->getContainer()
            ->get(\App\Service\UsuarioService::class);

        $this->assertEquals(
            $objUsuarioMemoryRepository->findAll(),
            $objUsuarioService->listarUsuarios()
        );
    }

    public function testProcurarUsuario()
    {
        $objUsuarioMemoryRepository = new UsuarioMemoryRepository();

        $objUsuarioService = $this->getContainer()
            ->get(\App\Service\UsuarioService::class);

        $this->assertEquals(
            $objUsuarioMemoryRepository->findUsuarioById(1)->jsonSerialize(),
            $objUsuarioService->procurarUsuario(1)
        );
    }

    public function testInserirUsuario()
    {
        $objUsuarioService = $this->getContainer()
            ->get(\App\Service\UsuarioService::class);

        $this->assertEquals(
            5,
            count($objUsuarioService->listarUsuarios())
        );

        $objUsuarioService->inserirUsuario(
            (object)(["ds_nome" => "teste"])
        );

        $this->assertEquals(
            6,
            count($objUsuarioService->listarUsuarios())
        );
    }

    public function testAlterarUsuario()
    {
        $objUsuarioService = $this->getContainer()
            ->get(\App\Service\UsuarioService::class);

        $objUsuarioService->alterarUsuario(
            1,
            (object)(["ds_nome" => "teste"])
        );

        $arrUsuarios = $objUsuarioService->listarUsuarios();

        $this->assertEquals(
            $arrUsuarios[0]->getDsNome(),
            "teste"
        );
    }

    public function testExcluirUsuario()
    {
        $objUsuarioService = $this->getContainer()
            ->get(\App\Service\UsuarioService::class);

        $this->assertEquals(
            5,
            count($objUsuarioService->listarUsuarios())
        );

        $objUsuarioService->excluirUsuario(1);

        $this->assertEquals(
            4,
            count($objUsuarioService->listarUsuarios())
        );
    }


}
