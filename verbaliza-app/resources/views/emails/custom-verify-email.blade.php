<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verificação de Endereço de Email</title>
    <style>
        /* Estilos Gerais */
        body {
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            background-color: #f4f4f7; /* Cor de fundo semelhante ao app */
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
        }

        table {
            border-collapse: collapse;
        }

        /* Estilos do Wrapper */
        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #f4f4f7;
            padding: 40px 0;
        }

        /* Estilos do Conteúdo Principal */
        .main {
            background-color: #ffffff;
            margin: 0 auto;
            width: 100%;
            max-width: 600px;
            border-spacing: 0;
            border-radius: 12px; /* Cantos arredondados como nos cartões do app */
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1); /* Sombra subtil */
            overflow: hidden;
        }

        /* Estilos do Cabeçalho */
        .header {
            background-color: #ffffff;
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #e5e7eb;
        }

        .header-logo {
            font-size: 24px;
            font-weight: bold;
            color: #1f2937;
        }

        .header-logo-highlight {
            color: #7c3aed; /* Cor roxa do design */
        }

        /* Estilos do Corpo do Email */
        .content {
            padding: 32px;
            text-align: left;
            font-size: 16px;
            line-height: 1.5;
            color: #374151;
        }

        .content h1 {
            font-size: 22px;
            font-weight: bold;
            color: #111827;
            margin-top: 0;
        }

        .content p {
            margin-bottom: 24px;
        }

        /* Estilos do Botão de Ação */
        .button-wrapper {
            text-align: center;
            padding: 10px 0;
        }

        .button {
            background-color: #7c3aed; /* Cor roxa do design */
            color: #ffffff;
            padding: 14px 28px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            font-size: 16px;
        }

        .fallback-link {
            font-size: 12px;
            color: #6b7280;
            padding-top: 10px;
            word-break: break-all;
        }

        /* Estilos do Rodapé */
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #6b7280;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <table class="main" align="center">
                    <!-- CABEÇALHO -->
                    <tr>
                        <td class="header">
                            <span class="header-logo">Estúdio<span class="header-logo-highlight"> Verbaliza</span></span>
                        </td>
                    </tr>

                    <!-- CONTEÚDO -->
                    <tr>
                        <td class="content">
                            <h1>Confirme o seu endereço de email</h1>
                            <p>Olá, {{ $user->name }}!</p>
                            <p>Obrigado por se registar. Por favor, clique no botão abaixo para verificar o seu endereço de email e ativar a sua conta.</p>

                            <!-- Botão de Ação -->
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="button-wrapper">
                                        <a href="{{ $verificationUrl }}" class="button">Verificar Email</a>
                                    </td>
                                </tr>
                            </table>

                            <p>Se estiver com problemas para clicar no botão "Verificar Email", copie e cole o URL abaixo no seu navegador:</p>
                            <p class="fallback-link">{{ $verificationUrl }}</p>

                            <p>Se não criou uma conta, nenhuma ação é necessária.</p>
                            <p>Obrigado,<br>A Equipa do Estúdio Escrita</p>
                        </td>
                    </tr>

                    <!-- RODAPÉ -->
                    <tr>
                        <td class="footer">
                            <p>&copy; {{ date('Y') }} Estúdio Verbaliza. Todos os direitos reservados.</p>
                            <p>Este é um email automático, por favor não responda.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
