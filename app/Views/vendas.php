<main>

    <div class="titulo-pagina" style="margin-bottom: 100px;">
        <h1>Vendas</h1>
    </div>

    <div class="lista-preferências">
        <ul>
            <li>
                <button class="aba" onclick="abrirAba(event, 'tabela')">Vendas</button>
            </li>
            <li>
                <button class="aba" onclick="abrirAba(event, 'dashboard')">Dashboards</button>
            </li>
        </ul>
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

        <button id="exportar"><i class="fa-solid fa-file-export"></i>Exportar</button>

    </div>

    <div id="tabela" class="content">

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

    <div id="dashboard" class="content">

        <div class="container" style="margin:0; padding:0;">
            <div class="row">
                <div class="col-md-6">
                    <div class="grafico">
                        <canvas id="grafico"
                            style="width: 400px; display: block; box-sizing: border-box; height: 170px;" height="152"
                            width="400"></canvas>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="dado">
                        <i class="fa-solid fa-circle-dollar-to-slot"></i>
                        <div class="info">
                            <label for="dado">Valor líquido</label>
                            <span>R$ 0,00</span>
                        </div>
                    </div>
                    <div class="dado">
                        <i class="fa-solid fa-arrow-trend-up"></i>
                        <div class="info">
                            <label for="dado">Vendas</label>
                            <span>0</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="dado">
                        <i class="fa-solid fa-credit-card"></i>
                        <div class="info">
                            <label for="dado">Aprovação cartão</label>
                            <span>0 %</span>
                        </div>
                    </div>
                    <div class="dado">
                        <i class="fa-solid fa-arrow-rotate-left"></i>
                        <div class="info">
                            <label for="dado">Reembolso</label>
                            <span>0 %</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="dado">
                        <i class="fa-solid fa-money-check-dollar"></i>
                        <div class="info">
                            <label for="dado">Boletos gerados</label>
                            <span>0</span>
                        </div>
                    </div>
                    <div class="dado">
                        <i class="fa-solid fa-file-circle-check"></i>
                        <div class="info">
                            <label for="dado">Conversão boleto</label>
                            <span>0 %</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</main>