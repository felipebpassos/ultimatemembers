<main>

    <div class="titulo-pagina" style="margin-bottom: 100px;">
        <h1>Preferências</h1>
    </div>

    <div class="lista-preferências">
        <ul class="barra">
            <!-- Botões -->
            <li>
                <button class="aba" onclick="abrirAba(event, 'geral')">Geral</button>
            </li>
            <li>
                <button class="aba" id="usuarios-btn" onclick="abrirAba(event, 'usuarios')">Usuários</button>
            </li>
            <li>
                <button class="aba" onclick="abrirAba(event, 'integracoes')">Integrações</button>
            </li>
            <li class="dropdown" onmouseover="mostrarDropdown('outrosDropdown')"
                onmouseout="esconderDropdown('outrosDropdown')">
                <button class="aba" id="outrosButton" style="margin-right:0;">Outras</button><svg width="28" height="14"
                    viewBox="0 0 42 25">
                    <path d="M3 3L21 21L39 3" stroke="var(--cor-secundaria)" stroke-width="8" stroke-linecap="round">
                    </path>
                </svg>
                <!-- Dropdown simulado com abas -->
                <ul class="dropdown-content" id="outrosDropdown">
                    <div style="margin-right: 30px;">
                        <li><button class="aba"
                                onclick="selecionarOpcao('comunidade', 'Comunidade')">Comunidade</button>
                        </li>
                        <li><button class="aba" onclick="selecionarOpcao('quiz', 'Quiz')">Quiz</button>
                        </li>
                        <li><button class="aba"
                                onclick="selecionarOpcao('gamificacao', 'Gamificação')">Gamificação</button>
                        </li>
                    </div>
                    <div>
                        <li><button class="aba" onclick="selecionarOpcao('provas', 'Provas')">Provas</button>
                        </li>
                        <li><button class="aba"
                                onclick="selecionarOpcao('certificados', 'Centificados')">Certificados</button>
                        </li>
                        <li><button class="aba" onclick="selecionarOpcao('avancado', 'Avançado')">Avançado</button>
                        </li>
                    </div>
                </ul>
            </li>
        </ul>
    </div>

    <!-- Preferências: Curso -->
    <section id="geral" class="content">

        <form action="<?php echo $curso['url_principal']; ?>painel/edit_geral/" method="post"
            enctype="multipart/form-data">

            <div class="container bloco" style="padding-top:0;">

                <div class="row">
                    <div class="col-md-5">
                        <div style="margin-bottom: 60px;">
                            <h4 class="title"><i class="fa-solid fa-gear" style="margin-right: 15px;"></i>Configurações
                                gerais</h4>
                            <p>Altere os dados básicos da sua área de membros</p>
                        </div>
                    </div>

                    <div class="col-md-7">

                        <div class="card">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="campo" style="margin-bottom: 30px;">
                                        <label for="">Nome do Curso</label>
                                        <input class="campo-texto" id="nome_curso" type="text" name="nome_curso"
                                            value="<?= $curso['nome'] ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="campo" id="campo_email_contato" style="margin-bottom: 30px;">
                                        <label for="">Email para contato</label>
                                        <input class="campo-texto" type="email" id="email_contato" name="email_contato"
                                            placeholder="exemplo@email.com" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="campo" style="margin-bottom: 30px;">
                                        <label for="">Domínio personalizado</label>
                                        <input class="campo-texto" id="dominio" type="text" name="dominio"
                                            value="<?= $curso['url_principal'] ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="campo" style="margin-bottom: 30px;">
                                        <label for="">Senha novos membros</label>
                                        <input class="campo-texto" id="senha" type="text" name="senha" value="1234"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 form-check" style="margin-bottom: 10px;">
                                <input class="form-check-input" type="checkbox" id="block_comentarios"
                                    name="block_comentarios">
                                <label class="form-check-label" for="block_comentarios">Bloquear comentários nas
                                    aulas</label>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

            <div class="container bloco">

                <div style="margin-bottom: 60px;">
                    <h4 class="title"><i class="fa-solid fa-palette" style="margin-right: 15px;"></i>Identidade visual e
                        formatação</h4>
                    <p>Defina ícones, imagens, fonte e paleta de cor do seu curso</p>
                </div>

                <div class="row">

                    <div class="col-md-5">

                        <div class="campo" style="margin-bottom: 30px;">
                            <div style="display: flex; justify-content:space-between; width: 80%;">
                                <div style="margin-right: 20px;">
                                    <label for="preview-logo" style="display:flex;">Logo <span class="info-span"
                                            id="info-logo"><i class="fa-solid fa-info"></i>
                                            <span class="legenda" style="width: 230px;">Formatos aceitos: .png ou
                                                .jpeg</span></span></label>
                                    <div class="preview" id="preview-logo">
                                        <img id="img-logo"
                                            src="<?= !empty ($curso['url_logo']) ? str_replace("./", "http://localhost/ultimatemembers/", $curso['url_logo']) : "http://localhost/ultimatemembers/public/img/logo-default.png" ?>"
                                            alt="logo">
                                        <input type="file" id="logo" name="logo" accept=".ico, .png">
                                        <button type="button" class="btn-file-1"
                                            onclick="document.getElementById('logo').click()">+</button>
                                    </div>
                                </div>
                                <div style="margin-right: 20px;">
                                    <label for="preview-favicon" style="display:flex;">Favicon <span class="info-span"
                                            id="info-favicon"><i class="fa-solid fa-info"></i>
                                            <span class="legenda" style="width: 160px;">Formato aceito:
                                                .ico</span></span></label>
                                    <div class="preview" id="preview-favicon">
                                        <img id="img-favicon"
                                            src="<?= !empty ($curso['url_favicon']) ? str_replace("./", "http://localhost/ultimatemembers/", $curso['url_favicon']) : "http://localhost/ultimatemembers/public/img/favicon-default.png" ?>"
                                            alt="favicon">
                                        <input type="file" id="favicon" name="favicon" accept=".ico, .png">
                                        <button type="button" class="btn-file-1"
                                            onclick="document.getElementById('favicon').click()">+</button>
                                    </div>
                                </div>
                                <div>
                                    <label for="preview-contato" style="display:flex;">Contato <span class="info-span"
                                            id="info-contato"><i class="fa-solid fa-info"></i>
                                            <span class="legenda" style="width: 160px;">Formatos aceitos: .png ou
                                                .jpeg</span></span></label>
                                    <div class="preview" id="preview-contato">
                                        <img id="img-contato"
                                            src="<?= !empty ($curso['contato_ico']) ? str_replace("./", "http://localhost/ultimatemembers/", $curso['contato_ico']) : "http://localhost/ultimatemembers/public/img/msg-default.png" ?>"
                                            alt="contato ícone">
                                        <input type="file" id="contato" name="contato" accept=".ico, .png">
                                        <button type="button" class="btn-file-1"
                                            onclick="document.getElementById('contato').click()">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="campo" style="margin-bottom: 30px;">
                            <label for="fontes">Fonte</label>
                            <select id="fontes" name="fontes">
                                <option value="jamjuree" selected style="font-family: 'Bai Jamjuree', sans-serif;">Bai
                                    Jamjuree, sans-serif</option>
                                <option value="hindi" style="font-family: 'Hindi', sans-serif;">Hind, sans-serif
                                </option>
                                <option value="roboto" style="font-family: 'Roboto', sans-serif;">Roboto, sans-serif
                                </option>
                                <option value="poppins" style="font-family: 'Poppins', sans-serif;">Poppins, sans-serif
                                </option>
                                <option value="montserrat" style="font-family: 'Montserrat', sans-serif;">Montserrat,
                                    sans-serif</option>
                            </select>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path d="M7 10l5 5 5-5z" />
                            </svg>
                        </div>

                        <div style="display:flex;">

                            <div class="campo" style="margin-right: 40px;">
                                <label for="">Cor de texto</label>
                                <div style="display:flex;">
                                    <input class="campo-texto" id="cor_texto" type="text" name="cor_texto"
                                        value="<?php echo $curso['cor_texto']; ?>" required>
                                    <div class="picker-primario"></div>
                                </div>
                            </div>

                            <div class="campo">
                                <label for="cor_fundo">Cor de fundo</label>
                                <div style="display:flex;">
                                    <input class="campo-texto" id="cor_fundo" type="text" name="cor_fundo"
                                        value="<?php echo $curso['cor_fundo']; ?>" required>
                                    <div class="picker-secundario"></div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-7">

                        <div class="campo">
                            <label for="login-area">Área de login</label>
                            <div class="login-area">
                                <div class="login-img-form">
                                    <label for="login-img-form">Banner de Login (Formatos aceitos: .png ou
                                        .jpeg):</label>
                                    <input type="file" id="login-img-form" name="login-img-form"
                                        accept=".jpg, .png, .jpeg">
                                    <button type="button" class="btn-file-2"
                                        onclick="document.getElementById('login-img-form').click()">Escolher
                                        Arquivo</button>
                                </div>
                                <div class="banner-curso">
                                    <img id="img-login"
                                        src="<?= !empty ($curso['banner_login']) ? str_replace("./", "http://localhost/ultimatemembers/", $curso['banner_login']) : "http://localhost/ultimatemembers/public/img/default_img.png" ?>"
                                        alt="Banner do <?= $curso['nome'] ?>">
                                </div>
                                <div class="login-box">
                                    <div style="width: 60%; height: 100px; margin: auto;">
                                        <div class="inputs"></div>
                                        <div class="inputs"></div>
                                        <div class="inputs"></div>
                                    </div>
                                    <div class="btn-login"></div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="botoes-opcao">
                <button class="btn-2" type="button"><i class="fa-solid fa-arrow-rotate-left"></i>Reset</button>
                <button class="btn-2" type="submit" style="margin-left: 30px;"><i
                        class="fa-regular fa-floppy-disk"></i>Salvar</button>
            </div>

        </form>

    </section>

    <!-- Preferências: Usuários -->
    <section id="usuarios" class="content">

        <div class="opcoes">

            <div class="filter-container">

                <div class="new-user">
                    <button class="btn-2" id="add-user" style="margin-right: 20px;">+ Novo</button>
                </div>

                <div class="pesquisar">
                    <input type="text" id="campoPesquisa" name="pesquisa" placeholder="Pesquisar usuário">
                    <a href="<?php echo $curso['url_principal']; ?>pesquisa/resultados/"><button type="submit"
                            id="botaoPesquisa"><i class="fa fa-search"></i></button></a>
                </div>

                <button class="editar" id="filter-btn"><i class="fa-solid fa-filter"></i></button>

            </div>

            <div class="exportar" style="position:relative;">
                <button id="exportar"><i class="fa-solid fa-file-export"></i>Exportar</button>
                <div class="dropdown">
                    <button id="xls-btn">XLS</button>
                    <button id="csv-btn">CSV</button>
                </div>
            </div>

        </div>

        <div class="usuarios tabela">
            <div class="cabecalho">
                <div class="celula checkbox">
                    <label class="checkbox">
                        <input type="checkbox">
                        <span></span>
                    </label>
                </div>
                <div class="celula">NOME</div>
                <div class="celula" id="permissao">PERMISSÃO</div>
                <div class="celula" id="status">STATUS</div>
                <div class="celula" id="cadastro">CADASTRO</div>
                <div class="celula" id="opcoes"></div>
            </div>
        </div>

        <div style="display: flex; justify-content: space-between;">
            <button class="editar-selected-users" style="margin: 0; margin-top: 10px;"><i
                    class='fa-solid fa-trash-can'></i>Deletar
                selecionados</button>
            <div class="pagination-container" style="margin-top: 10px; height: fit-content;">
                <div class="pagination">
                    <script>
                        var totalPaginas = <?php echo $totalPaginas; ?>; // Defina o total de páginas aqui
                        var paginaAtual = 1; // Página inicial
                    </script>
                </div>
            </div>
        </div>

    </section>

    <!-- Preferências: Integrações -->
    <section id="integracoes" class="content">

        <script>
            var integracoes;
            $.getJSON('http://localhost/ultimatemembers/public/data/integracoes.json', function (data) {
                integracoes = data;

                var rowDiv = $('<div class="row"></div>');

                // Iterando sobre as chaves do objeto JSON
                Object.keys(integracoes).forEach(function (key) {
                    var integracao = integracoes[key];

                    // Criando o HTML dinamicamente apenas para as integrações disponíveis
                    var integracaoHTML = `
                <div class="integracao col-md-3 col-lg-3" data-id="${key}">
                    <div class="integracao-logo">
                        <img src="${integracao.img}" alt="${integracao.nome}">
                    </div>
                    <div class="integracao-info">
                        <h5>${integracao.nome}</h5>
                        <p>${integracao.tipo}</p>
                    </div>
                </div>`;

                    // Adicionando o HTML gerado à div com a classe 'row'
                    rowDiv.append(integracaoHTML);
                });

                // Adicionando a div com a classe 'row' ao contêiner de integrações disponíveis
                $('.container-disponiveis').append(rowDiv);

                // Atualizando o número de integrações disponíveis
                $('#num-disponiveis').text(Object.keys(integracoes).length);
            });
        </script>

        <div class="titulo">
            <h4>Instaladas</h4><span class="num-integracoes" id="num-instaladas">
                <?= count($integracoes) ?>
            </span>
        </div>
        <div class="container container-instaladas">
            <?php if (empty ($integracoes)): ?>
                <div class="integracao-instalada">Nenhuma integração instalada.</div>
            <?php else: ?>
                <div class="integracoes-tabela tabela">
                    <div class="cabecalho">
                        <div class="celula" style="flex: 0.4;">Plataforma</div>
                        <div class="celula">Nome</div>
                        <div class="celula">Conta</div>
                        <div class="celula">Tipo</div>
                        <div class="celula" style="flex: 0.4;"></div>
                    </div>

                    <?php
                    $plataformas = json_decode(file_get_contents('http://localhost/ultimatemembers/public/data/integracoes.json'), true);
                    ?>

                    <?php foreach ($integracoes as $integracao): ?>
                        <div class="integracao-instalada linha">
                            <div class="celula" style="flex: 0.4;">
                                <img height="25" src="<?= $plataformas[$integracao['plataforma']]['img-mini'] ?>"
                                    alt="<?= $integracao['plataforma'] ?>">
                            </div>
                            <div class="celula">
                                <?= $integracao['nome'] ?>
                            </div>
                            <div class="celula">
                                <?= $integracao['conta'] ?>
                            </div>
                            <div class="celula">
                                <?= ($integracao['tipo'] == 1 ? 'Vídeo' : 'Pagamento') ?>
                            </div>
                            <div class="celula" style="flex: 0.4;">
                                <button class="editar-integracao" data-id="<?= $integracao['id'] ?>"><i
                                        class='fa-solid fa-pen-to-square'></i></button>
                                <button class="delete-integracao" data-id="<?= $integracao['id'] ?>"><i
                                        class='fa-solid fa-trash-can'></i></button>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            <?php endif; ?>
        </div>

        <div class="titulo">
            <h4>Disponíveis</h4><span class="num-integracoes" id="num-disponiveis"></span>
        </div>
        <div class="container container-disponiveis">

    </section>


    <section id="comunidade" class="content"></section>

    <section id="gamificacao" class="content"></section>

    <!-- Preferências: Provas -->
    <section id="provas" class="content">

        <div class="card" style="min-height: 500px;">
            <div style="display: flex; justify-content: space-between; align-items:center; margin-bottom: 40px;">
                <div class="texto">
                    <h4 class="title">Provas Cadastradas</h4>
                    <p>Cadastre provas e avalie seus alunos</p>
                </div>
                <button class="btn-2" id="novaProva">+ Nova Prova</button>
            </div>
            <div class="container">
                <?php

                // Verificar se há provas
                if (empty ($provas)) {
                    // Se não houver provas, exibir uma mensagem de erro
                    ?>
                    <div class="col-md-12">
                        <div class="error-message">
                            <img width="350" src="http://localhost/ultimatemembers/public/img/isometric_erro.png"
                                alt="Sem Resultado">
                            Não há provas disponíveis no momento.
                        </div>
                    </div>
                    <?php
                } else {
                    // Se houver provas, gerar o conteúdo das provas
                    ?>
                    <div class="row">
                        <?php foreach ($provas as $prova) { ?>
                            <div class="col-md-4 col-lg-4">
                                <div class="prova">
                                    <div class="prova-header">
                                        <h6>
                                            <?php echo $prova['titulo']; ?>
                                        </h6>
                                        <div class="toggle-button">
                                            <div class="ball"></div>
                                        </div>
                                    </div>
                                    <div class="prova-info">
                                        <ul>
                                            <li><span><i class="fa-solid fa-calendar"></i></span>Prazo:
                                                <?php echo calcularTempoDecorrido($prova['prazo']); ?>
                                            </li>
                                            <li><span><i class="fa-solid fa-list"></i></span>Questões:
                                                <?php echo $prova['numero_questoes']; ?>
                                            </li>
                                            <li><span><i class="fa-solid fa-clock"></i></span>Tempo:
                                                <?php echo $prova['tempo_limite'] . ' min'; ?>
                                            </li>
                                            <li><span><i class="fa-solid fa-user-check"></i></span>Nota mínima:
                                                <?php echo $prova['pontuacao_minima'] . '/100'; ?>
                                            </li>
                                        </ul>
                                        <div class="opcoes-prova">
                                            <button class="editar editar-prova" data-id="<?php echo $prova['id']; ?>"><i
                                                    class="fa-solid fa-pen-to-square"></i></button>
                                            <button class="editar deletar-prova" data-id="<?php echo $prova['id']; ?>"><i class="fa-solid fa-trash-can"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>

        </div>

    </section>

    <section id="quiz" class="content"></section>

    <section id="certificados" class="content"></section>

    <section id="avancado" class="content"></section>


</main>