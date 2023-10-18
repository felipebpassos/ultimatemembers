<main>

    <div class="titulo-pagina">
        <h1>Nova Publicação</h1>
    </div>

    <form id="addDiscussao" class="nova-publicacao" action="<?php echo $curso['url_principal']; ?>comunidade/nova_discussao/"
        method="POST" enctype="multipart/form-data">

        <div class="dicas">

            <ul id="lista-perguntas" class="accordion-1">
                <div class="pergunta">
                    <li class="elemento">
                        <div style="display: flex;">
                            <h3>Como fazer uma boa pergunta</h3><i class="fa-solid fa-circle-question"></i>
                        </div>
                        <svg width="18" height="12" viewBox="0 0 42 25">
                            <path d="M3 3L21 21L39 3" stroke="black" stroke-width="7" stroke-linecap="round"></path>
                        </svg>
                    </li>
                    <div class="resposta">
                        <div class="resposta-box">

                            <br>
                            <p>Você está pronto para fazer uma pergunta e este formulário o ajudará a guiá-la através do
                                processo.
                            </p>
                            <p>Dicas:</p>
                            <ul>
                                <li>Seja claro e específico.</li>
                                <li>Resuma bem sua dúvida em uma frase no título.</li>
                                <li>Forneça detalhes relevantes.</li>
                                <li>Formate o texto de forma adequada para destacar pontos importantes.</li>
                                <li>Escolha as tags apropriadas para categorizar seu post.</li>
                            </ul>

                        </div>
                    </div>
                </div>
            </ul>
        </div>

        <div class="campo">
            <label for="titulo">Título</label>
            <p>Seja específico e objetivo.</p>
            <input type="text" id="titulo" name="titulo" required>
        </div>

        <div class="campo">
            <label for="texto">Desenvolva com detalhes sua dúvida</label>
            <p>Mínimo 20 caracteres</p>
            <div class="texto">
                <div class="botoes-formatar">
                    <button type="button" id="btn-font-size"><i class="fa-solid fa-text-height"></i></button>
                    <button type="button" id="btn-negrito"><i class="fa-solid fa-bold"></i></button>
                    <button type="button" id="btn-italico"><i class="fa-solid fa-italic"></i></button>
                    <button type="button" id="btn-list"><i class="fa-solid fa-list-ul"></i></button>
                    <button type="button" id="btn-num-list"><i class="fa-solid fa-list-ol"></i></button>
                    <button type="button" id="btn-img"><i class="fa-regular fa-image"></i></button>
                </div>
                <textarea id="texto" name="texto" rows="4" cols="50" required></textarea>
            </div>
        </div>

        <div class="campo" id="campo-tags">

            <div class="tags-header" style="margin-top: 10px;">
                <ul class="select-categorias"></ul>
                <p>Insira até 3 tags para categorizar sua publicação.</p>
            </div>

            <script>
                $(".select-categorias").append(MultiploSelect('', 'Tags', ['Tag 1', 'Tag 2', 'Tag 3'], true));
            </script>

        </div>

        <div class="submeter">
            <button class="btn-2" type="submit">Publicar</button>
        </div>

    </form>

</main>