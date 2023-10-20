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

    <ul class="periodo-tempo"></ul>
    <script>

        $(".periodo-tempo").append(SelectSimples('', 'Hoje', ['Hoje', 'Últimos 7 dias', 'Últimos 30 dias', 'Tempo todo'], 'select-tempo', false));

    </script>

    <div id="tabela" class="content">

        <h1>tabela</h1>


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