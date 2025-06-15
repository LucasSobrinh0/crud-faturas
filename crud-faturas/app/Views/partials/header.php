<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>CRUD Faturas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        /* Estilos complementares (coloque após o bootstrap.min.css) ---------------*/
        .nav-link {
            color: #212529;
            /* texto escuro em fundo claro            */
            font-weight: 500;
            transition: color .15s ease-in-out;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #0d6efd;
            /* azul padrão do Bootstrap no hover/ativo */
        }

        @media (max-width: 576px) {

            /* Ajuste de espaçamento em telas pequenas */
            .navbar-nav {
                gap: 1rem 1.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar ----------------------------------------------------------------->
    <nav class="navbar navbar-expand bg-light shadow-sm py-2">
        <div class="container-fluid gap-4">

            <!-- Branding -->
            <a href="/" class="navbar-brand d-flex align-items-center fw-semibold">
                <i class="bi bi-file-earmark-text fs-4 me-2"></i>
                <span class="fs-5">CRUD&nbsp;Faturas</span>
            </a>

            <!-- Links -->
            <ul class="navbar-nav flex-row flex-wrap ms-auto gap-3">
                <li class="nav-item">
                    <a href="/?controller=client&action=index" class="nav-link d-flex align-items-center gap-1">
                        <i class="bi bi-people-fill"></i><span>Clientes</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/?controller=invoice&action=index" class="nav-link d-flex align-items-center gap-1">
                        <i class="bi bi-receipt"></i><span>Faturas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/?controller=dashboard&action=index"
                        class="nav-link d-flex align-items-center gap-1">
                        <i class="bi bi-speedometer2"></i><span>Dashboard</span>
                    </a>
                </li>

            </ul>

        </div>
    </nav>
    <div class="container mt-4">