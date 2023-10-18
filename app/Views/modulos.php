<main>
        <div class="titulo-pagina">
                <h1>Módulos</h1>
        </div>

        <div class="banner-box slide-left">
                <div class="fade-before"></div>
                <div class="fade-after"></div>
                <section class="banner-section">
                        <div class="banner-container">
                                <div class="banners">
                                        <?php
                                        if (isset($modulos) && !empty($modulos)) {

                                                foreach ($modulos as $modulo) {
                                                        $id = $modulo['id'];

                                                        if ($id >= 0 && $id <= 9) {
                                                                $formattedId = sprintf("0%d", $id); // Formata o ID para 0X (sendo X o ID)
                                                        } else {
                                                                $formattedId = $id; // Mantém o ID como está se não estiver entre 0 e 9
                                                        }
                                                        echo '<a class="banner" id="modulos" href="' . $curso['url_principal'] . 'modulos/modulo/' . $formattedId . '"><img
                                                        src="http://localhost/ultimatemembers/uploads/modulos/banners/modulo' . $formattedId . '.png" alt="Banner ' . $formattedId . '"></a>';
                                                }
                                        } else {
                                                // Caso a variável de sessão 'modulos' não exista ou esteja vazia
                                                echo 'Nenhum módulo disponível.';
                                        }
                                        ?>
                                </div>
                        </div>
                        <div class="arrow left-arrow"><img src="http://localhost/ultimatemembers/public/img/left.png"
                                        alt=""></div>
                        <div class="arrow right-arrow"><img src="http://localhost/ultimatemembers/public/img/right.png"
                                        alt=""></div>
                </section>
        </div>

        <div class="container slide-left">
                <div class="row">
                        <div class="col-md-6">
                                <li class="seçao">
                                        <div class="proximos-passos">
                                                <div class="seção-titulo">
                                                        <i class="fa-solid fa-arrow-trend-up"></i>
                                                        <h2>Próximos Passos</h2>
                                                </div>
                                                <div class="sugestões">
                                                        <div class="sug_principal">Sugestão Principal</div>
                                                        <div class="sug_secundarias">
                                                                <ul>
                                                                        <li>op1</li>
                                                                        <li>op2</li>
                                                                        <li>op3</li>
                                                                        <li>op4</li>
                                                                </ul>
                                                        </div>
                                                </div>
                                        </div>
                                </li>
                        </div>
                        <div class="col-md-6">
                                <li class="seçao">
                                        <div class="proximos-passos">
                                                <div class="seção-titulo">
                                                        <i class="fa-solid fa-arrow-trend-up"></i>
                                                        <h2>Próximos Passos</h2>
                                                </div>
                                                <div class="sugestões">
                                                        <div class="sug_principal">Sugestão Principal</div>
                                                        <div class="sug_secundarias">
                                                                <ul>
                                                                        <li>op1</li>
                                                                        <li>op2</li>
                                                                        <li>op3</li>
                                                                        <li>op4</li>
                                                                </ul>
                                                        </div>
                                                </div>
                                        </div>
                                </li>
                        </div>
                </div>
        </div>


</main>