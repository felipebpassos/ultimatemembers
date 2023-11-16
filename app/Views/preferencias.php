<main>

    <div class="titulo-pagina" style="margin-bottom: 100px;">
        <h1>Painel Administrativo</h1>
    </div>

    <div class="lista-preferências">
        <ul>
            <li>
                <button class="aba" onclick="abrirAba(event, 'geral')">Geral</button>
            </li>
            <li>
                <button class="aba" onclick="abrirAba(event, 'comunidade')">Comunidade</button>
            </li>
            <li>
                <button class="aba" onclick="abrirAba(event, 'gamificacao')">Gamificação</button>
            </li>
            <li>
                <button class="aba" onclick="abrirAba(event, 'certificados')">Certificados</button>
            </li>
        </ul>
    </div>

    <section id="geral" class="content">

        <form action="<?php echo $curso['url_principal']; ?>painel/edit_geral/" method="post"
            enctype="multipart/form-data">

            <div class="container" style="padding:0px; margin:0px; margin-bottom:50px;">
                <div class="row">
                    <div class="col-md-7">

                        <div class="campo">
                            <label for="">Nome do Curso</label>
                            <input class="campo-texto" id="nome_curso" type="text" name="nome_curso"
                                value="<?php echo $curso['nome']; ?>" required>
                        </div>

                        <div class="campo">
                            <label for="">Descrição do Curso</label>
                            <textarea class="campo-texto" id="descricao_curso" name="descricao_curso"></textarea>
                        </div>

                        <div class="campo">
                            <label for="logo">Logo do Curso (Formatos aceitos: .png ou .jpeg):</label>
                            <input type="file" id="logo" name="logo" accept=".ico, .png">
                        </div>

                        <div class="campo">
                            <label for="favicon">Favicon do Curso (Formato aceito: .ico):</label>
                            <input type="file" id="favicon" name="favicon" accept=".ico, .png">
                        </div>

                    </div>
                    <div class="col-md-5">

                        <div class="campo">
                            <label for="">Cor de texto</label>
                            <div style="display:flex;">
                                <input class="campo-texto" id="cor_texto" type="text" name="cor_texto"
                                    value="<?php echo $curso['cor_texto']; ?>" required>
                                <div class="picker-primario"></div>
                            </div>
                        </div>

                        <div class="campo">
                            <label for="">Cor de fundo</label>
                            <div style="display:flex;">
                                <input class="campo-texto" id="cor_fundo" type="text" name="cor_fundo"
                                    value="<?php echo $curso['cor_fundo']; ?>" required>
                                <div class="picker-secundario"></div>
                            </div>
                        </div>

                        <div class="campo">
                            <ul class="fontes"></ul>
                            <script>

                                $(".fontes").append(SelectSimples('', 'Selecione a fonte', ['Bai Jamjuree, sans-serif', 'Hind, sans-serif', 'Poppins, sans-serif', 'Roboto, sans-serif'], 'select-fonte', false));

                            </script>
                        </div>

                    </div>
                </div>
            </div>

            <div class="submeter">
                <button class="btn-2" type="submit">Salvar</button>
            </div>

        </form>

    </section>

    <section id="comunidade" class="content"></section>

    <section id="gamificacao" class="content"></section>

    <section id="certificados" class="content"></section>


</main>