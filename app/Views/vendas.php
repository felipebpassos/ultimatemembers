<main>

    <div class="titulo-pagina" style="margin-bottom: 100px;">
        <h1>Vendas</h1>
    </div>

    <div class="lista-preferências">
        <ul class="barra">
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

    <div id="tabela" class="content">

        <div class="op-table">

            <button>Aprovadas</button>
            <button>Todas</button>

        </div>

        <div class="container" style="padding: 0px;">
            <div class="relatorios tabela">
                <div class="cabecalho">
                    <div class="celula">DATA</div>
                    <div class="celula">CLIENTE</div>
                    <div class="celula">PLANO</div>
                    <div class="celula">STATUS</div>
                    <div class="celula">VALOR LÍQUIDO</div>
                </div>
                <div class='linha'>
                    <div class="celula">2023-10-19</div>
                    <div class="celula">Cliente 1</div>
                    <div class="celula">Básico</div>
                    <div class="celula">Pago</div>
                    <div class="celula">R$ 100.00</div>
                </div>
                <div class='linha'>
                    <div class="celula">2023-10-30</div>
                    <div class="celula">Cliente 2</div>
                    <div class="celula">Premium</div>
                    <div class="celula">Pago</div>
                    <div class="celula">R$ 160.00</div>
                </div>
                <div class='linha'>
                    <div class="celula">2023-11-05</div>
                    <div class="celula">Cliente 3</div>
                    <div class="celula">Premium</div>
                    <div class="celula">Pago</div>
                    <div class="celula">R$ 160.00</div>
                </div>
                <div class='linha'>
                    <div class="celula">2023-11-07</div>
                    <div class="celula">Cliente 4</div>
                    <div class="celula">Básico</div>
                    <div class="celula">Pendente</div>
                    <div class="celula">R$ 100.00</div>
                </div>
                <!-- Adicione mais linhas conforme necessário -->
            </div>
        </div>

    </div>

    <div id="dashboard" class="content">

        <div class="container" style="margin:0; padding:0;">
            <div class="row">
                <div class="col-md-6">
                    <div class="grafico">
                        <canvas id="grafico" height="152" width="360"></canvas>
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