<main>

    <div class="titulo-pagina">
        <h1>Resultados da Pesquisa</h1>
    </div>

    <div class="pesquisar_container2">
        <div class="pesquisar">
            <input type="text" id="campoPesquisa" name="pesquisa" placeholder="Pesquisar">
            <a href="<?php echo $curso['url_principal']; ?>pesquisa/resultados/"><button type="submit" id="botaoPesquisa"><i
                        class="fa fa-search"></i></button></a>
        </div>
    </div>

    <div class="container2">
        <div class="container-tags">
            <button class="tag">
                <div>
                    <i class="fa-solid fa-folder-open"></i>
                    <p>Módulo</p>
                </div>
            </button>
            <button class="tag">
                <div>
                    <i class="fa-solid fa-video"></i>
                    <p>Aula</p>
                </div>
            </button>
            <button class="tag">
                <div>
                    <i class="fa-solid fa-book-open"></i>
                    <p>Apostila</p>
                </div>
            </button>
            <button class="tag">
                <div>
                    <i class="fa-regular fa-pen-to-square"></i>
                    <p>Exercício</p>
                </div>
            </button>
            <button class="tag">
                <div>
                    <i class="fa-regular fa-comments"></i>
                    <p>Discussão</p>
                </div>
            </button>
        </div>
        <p class="legenda-filtro-pesquisa">Filtre sua pesquisa selecionando as categorias.</p>
    </div>

    <div class="container3">
        <div class="resultados">
            <form class="barra-superior">
                <p style="margin-bottom: 0px !important;">7.757 Resultados</p>
                <select name="sort" class="sort_by">
                    <option value="" disabled selected>Ordenar por</option>
                    <option value="relevancia">Relevância</option>
                    <option value="recente">Mais recente</option>
                    <option value="antigo">Mais antigo</option>
                </select>
            </form>
            <div class="encontrados">
                <p>Nenhum resultado encontrado.</p>
            </div>
        </div>
    </div>

</main>