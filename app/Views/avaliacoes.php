<main>

    <div class="titulo-pagina" style="margin-bottom: 100px;">
        <h1>Avaliações dos Alunos</h1>
    </div>

    <div class="opcoes">

        <div class="filter-container">

            <ul class="periodo-tempo"></ul>
            <script>

                $(".periodo-tempo").append(SelectSimples('', 'Hoje', ['Hoje', 'Últimos 7 dias', 'Últimos 30 dias', 'Tempo todo'], 'select-tempo', false));

            </script>

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

    <div id="tabela" class="content" style="display:block;">

        <div class="op-table">

            <button>Aprovadas</button>
            <button>Todas</button>

        </div>

        <div class="container" style="padding: 0px;">
            <table class="table table-responsive tabela">
                <thead>
                    <tr>
                        <th>DATA</th>
                        <th>PRODUTO</th>
                        <th>CLIENTE</th>
                        <th>STATUS</th>
                        <th>VALOR LÍQUIDO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2023-10-19</td>
                        <td>Produto A</td>
                        <td>Cliente 1</td>
                        <td>Pago</td>
                        <td>R$ 100.00</td>
                    </tr>
                    <tr>
                        <td>2023-10-20</td>
                        <td>Produto B</td>
                        <td>Cliente 2</td>
                        <td>Pendente</td>
                        <td>R$ 75.50</td>
                    </tr>
                    <tr>
                        <td>2023-10-21</td>
                        <td>Produto C</td>
                        <td>Cliente 3</td>
                        <td>Cancelado</td>
                        <td>R$ 200.25</td>
                    </tr>
                    <tr>
                        <td>2023-10-22</td>
                        <td>Produto D</td>
                        <td>Cliente 4</td>
                        <td>Pago</td>
                        <td>R$ 120.90</td>
                    </tr>
                    <!-- Adicione mais linhas conforme necessário -->
                </tbody>
            </table>
        </div>

    </div>

</main>