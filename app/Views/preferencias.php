<main>

    <div class="titulo-pagina" style="margin-bottom: 100px;">
        <h1>Preferências</h1>
    </div>

    <div class="lista-preferências">
        <ul class="barra">
            <!-- Botões -->
            <li>
                <button class="aba" onclick="abrirAba(event, 'curso')">Curso</button>
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
                    <li><button class="aba" onclick="selecionarOpcao('comunidade', 'Comunidade')">Comunidade</button>
                    </li>
                    <li><button class="aba" onclick="selecionarOpcao('gamificacao', 'Gamificação')">Gamificação</button>
                    </li>
                    <li><button class="aba" onclick="selecionarOpcao('avaliacoes', 'Avaliações')">Avaliações</button>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

    <section id="curso" class="content">

        <form action="<?php echo $curso['url_principal']; ?>painel/edit_geral/" method="post"
            enctype="multipart/form-data">

            <div class="container">
                <div class="submeter">
                    <button class="btn-2" type="submit"><i class="fa-regular fa-floppy-disk"></i>Salvar</button>
                </div>
                <h3>1. Geral</h3>
                <div class="row">
                    <div class="col-md-6">

                        <div class="campo" style="margin-bottom: 30px;">
                            <label for="">Nome do Curso</label>
                            <input class="campo-texto" id="nome_curso" type="text" name="nome_curso"
                                value="<?= $curso['nome'] ?>" required>
                        </div>

                        <div class="campo">
                            <div style="display:flex; align-items:center;">
                                <div class="preview">
                                    <img src="<?= !empty($curso['url_logo']) ? str_replace("./", "http://localhost/ultimatemembers/", $curso['url_logo']) : "http://localhost/ultimatemembers/public/img/logo-default.png" ?>"
                                        alt="logo">
                                </div>
                                <div>
                                    <label for="logo">Logo do Curso (Formatos aceitos: .png ou .jpeg):</label>
                                    <input type="file" id="logo" name="logo" accept=".ico, .png">
                                </div>
                            </div>
                        </div>

                        <div class="campo">
                            <div style="display:flex; align-items:center;">
                                <div class="preview">
                                    <img src="<?= !empty($curso['url_favicon']) ? str_replace("./", "http://localhost/ultimatemembers/", $curso['url_favicon']) : "http://localhost/ultimatemembers/public/img/favicon-default.png" ?>"
                                        alt="favicon">
                                </div>
                                <div>
                                    <label for="favicon">Favicon do Curso (Formato aceito: .ico):</label>
                                    <input type="file" id="favicon" name="favicon" accept=".ico, .png">
                                </div>
                            </div>
                        </div>

                        <div class="campo">
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
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="campo">
                            <label for="">Descrição do Curso</label>
                            <textarea class="campo-texto" id="descricao_curso" name="descricao_curso"></textarea>
                        </div>

                    </div>

                </div>
            </div>

            <div class="container ultimo">

                <div class="row">
                    <div class="col-md-6">

                        <div class="campo">
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
                    <div class="col-md-6">

                    </div>
                </div>
            </div>

        </form>

    </section>

    <section id="usuarios" class="content">

        <div class="opcoes">

            <div class="filter-container">

                <div class="new-user">
                    <button class="btn-2" style="margin-right: 20px;">+ Novo</button>
                </div>

                <div class="pesquisar">
                    <input type="text" id="campoPesquisa" name="pesquisa" placeholder="Pesquisar">
                    <a href="<?php echo $curso['url_principal']; ?>pesquisa/resultados/"><button type="submit"
                            id="botaoPesquisa"><i class="fa fa-search"></i></button></a>
                </div>

            </div>

            <div class="exportar" style="position:relative;">
                <button id="exportar"><i class="fa-solid fa-file-export"></i>Exportar</button>
                <div class="dropdown">
                    <button id="xls-btn">XLS</button>
                    <button id="csv-btn">CSV</button>
                </div>
            </div>

        </div>

        <div class="tabela">
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

    </section>

    <section id="integracoes" class="content"></section>

    <section id="comunidade" class="content"></section>

    <section id="gamificacao" class="content"></section>

    <section id="avaliacoes" class="content"></section>

    <section id="certificados" class="content"></section>


</main>