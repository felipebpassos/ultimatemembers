<main>

    <div class="titulo-pagina">
        <h1>Painel Administrativo</h1>
    </div>

    <section class="op-gerais">

        <form action="" method="post" enctype="multipart/form-data">

            <label for="">Nome do Curso</label>
            <input id="nome_curso" type="text" name="nome_curso" required>

            <label for="">Descrição do Curso</label>
            <textarea id="descricao_curso" name="descricao_curso"></textarea>

            <label for="logo">Logo do Curso (Formatos aceitos: .png ou .jpeg):</label>
            <input type="file" id="logo" name="logo" accept=".ico, .png" required>

            <label for="favicon">Favicon do Curso (Formato aceito: .ico):</label>
            <input type="file" id="favicon" name="favicon" accept=".ico, .png" required>

            <label for="">Cor de texto</label>
            <input id="cor_texto" type="text" name="cor_texto" required>

            <label for="">Cor de fundo</label>
            <input id="cor_fundo" type="text" name="cor_fundo" required>

            <ul class="fontes"></ul>
            <script>

                $(".fontes").append(SelectSimples('', 'Selecione a fonte', ['Bai Jamjuree, sans-serif', 'Hind, sans-serif', 'Poppins, sans-serif', 'Roboto, sans-serif'], 'select-fonte', false));

            </script>

            <div class="submeter">
                <button class="btn-2" type="submit">Salvar</button>
            </div>

        </form>

    </section>


</main>