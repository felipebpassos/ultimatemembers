<main>

    <div class="titulo-pagina" style="margin-bottom: 100px;">
        <h1>Preferências</h1>
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
                            <div style="display:flex; align-items:center;">
                                <div class="preview">
                                    <img src="" alt="">
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
                                    <img src="" alt="">
                                </div>
                                <div>
                                    <label for="favicon">Favicon do Curso (Formato aceito: .ico):</label>
                                    <input type="file" id="favicon" name="favicon" accept=".ico, .png">
                                </div>
                            </div>
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
                            <label for="cor_fundo">Cor de fundo</label>
                            <div style="display:flex;">
                                <input class="campo-texto" id="cor_fundo" type="text" name="cor_fundo"
                                    value="<?php echo $curso['cor_fundo']; ?>" required>
                                <div class="picker-secundario"></div>
                            </div>
                        </div>

                        <div class="campo">
                            <label for="fontes">Fonte</label>
                            <select id="fontes" name="fontes">
                                <option value="jamjuree" selected style="font-family: 'Bai Jamjuree', sans-serif;">Bai Jamjuree, sans-serif</option>
                                <option value="hindi" style="font-family: 'Hindi', sans-serif;">Hind, sans-serif</option>
                                <option value="roboto" style="font-family: 'Roboto', sans-serif;">Roboto, sans-serif</option>
                                <option value="poppins" style="font-family: 'Poppins', sans-serif;">Poppins, sans-serif</option>
                                <option value="montserrat" style="font-family: 'Montserrat', sans-serif;">Montserrat, sans-serif</option>
                            </select>
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