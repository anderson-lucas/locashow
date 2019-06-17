<?php

const GET = 'GET';
const POST = 'POST';
const DELETE = 'DELETE';

$routes = [
    'login' => [
        [
            'method' => POST,
            'route' => 'authenticate',
            'function' => 'auth',
            'service' => 'api/Authenticate.php'
        ]
    ],
    'clientes' => [
        [
            'method' => GET,
            'route' => 'clientes',
            'function' => 'getCliente',
            'service' => 'api/ClienteService.php',
        ],
        [
            'method' => POST,
            'route' => 'clientes',
            'function' => 'setCliente',
            'service' => 'api/ClienteService.php',
        ],
        [
            'method' => DELETE,
            'route' => 'clientes',
            'function' => 'deleteCliente',
            'service' => 'api/ClienteService.php',
        ],
    ],
    'cliente-endereco' => [
        [
            'method' => GET,
            'route' => 'cliente-endereco',
            'function' => 'getClienteEndereco',
            'service' => 'api/ClienteEnderecoService.php',
        ],
        [
            'method' => POST,
            'route' => 'cliente-endereco',
            'function' => 'setClienteEndereco',
            'service' => 'api/ClienteEnderecoService.php',
        ],
        [
            'method' => DELETE,
            'route' => 'cliente-endereco',
            'function' => 'deleteEndereco',
            'service' => 'api/ClienteEnderecoService.php',
        ],
    ],
    'imoveis' => [
        [
            'method' => GET,
            'route' => 'imoveis',
            'function' => 'getImovel',
            'service' => 'api/ImovelService.php',
        ],
        [
            'method' => POST,
            'route' => 'imoveis',
            'function' => 'setImovel',
            'service' => 'api/ImovelService.php',
        ],
        [
            'method' => DELETE,
            'route' => 'imoveis',
            'function' => 'deleteImovel',
            'service' => 'api/ImovelService.php',
        ],
    ],
    'imovel-imagens' => [
        [
            'method' => DELETE,
            'route' => 'imovel-imagens',
            'function' => 'deleteImovelImagem',
            'service' => 'api/ImovelImagemService.php',
        ]
    ],
    'contratos' => [
        [
            'method' => GET,
            'route' => 'contratos',
            'function' => 'getContrato',
            'service' => 'api/ContratoService.php',
        ],
        [
            'method' => POST,
            'route' => 'contratos',
            'function' => 'setContrato',
            'service' => 'api/ContratoService.php',
        ],
        [
            'method' => DELETE,
            'route' => 'contratos',
            'function' => 'deleteContrato',
            'service' => 'api/ContratoService.php',
        ],
        [
            'method' => GET,
            'route' => 'contratosSearch',
            'function' => 'getContratoSearch',
            'service' => 'api/ContratoService.php',
        ]
    ],
    'grupo-menu' => [
        [
            'method' => POST,
            'route' => 'grupo-menu',
            'function' => 'createGrupoMenu',
            'service' => 'api/GrupoMenuService.php',
        ],
        [
            'method' => DELETE,
            'route' => 'grupo-menu',
            'function' => 'deleteGrupoMenu',
            'service' => 'api/GrupoMenuService.php',
        ]
    ],
    'usuario-grupo' => [
        [
            'method' => POST,
            'route' => 'usuario-grupo',
            'function' => 'createUsuarioGrupo',
            'service' => 'api/UsuarioGrupoService.php',
        ],
        [
            'method' => DELETE,
            'route' => 'usuario-grupo',
            'function' => 'deleteUsuarioGrupo',
            'service' => 'api/UsuarioGrupoService.php',
        ]
    ]
];
