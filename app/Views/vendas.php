<main>

    <div class="titulo-pagina" style="margin-bottom: 100px;">
        <h1>Dashboard de Vendas</h1>
    </div>

    <ul class="periodo-tempo"></ul>
    <script>

        $(".periodo-tempo").append(SelectSimples('', 'Hoje', ['Hoje', 'Últimos 7 dias', 'Últimos 30 dias', 'Tempo todo'], 'select-fonte', false));

    </script>

    <div class="dashboard">

        <div class="container" style="margin:0;">
            <div class="row">
                <div class="col-md-6">
                    <div class="grafico">

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