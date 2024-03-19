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
                                        if (isset ($modulos) && !empty ($modulos)) {

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

        <!-- Seção de trilhas -->
        <div class="banner-box fade-in-slide-up <?php echo (isset ($trilhas) && !empty ($trilhas)) ? '' : 'no-items'; ?>"
                style="padding-top: 0; margin-bottom: 50px; padding-bottom: 30px;">
                <?php
                if (isset ($trilhas) && !empty ($trilhas)) {
                        foreach ($trilhas as $trilha) {
                                echo '<h4 style="margin: 8px 10px; margin-top: 60px;">' . $trilha['nome_trilha'] . '</h4>';
                                echo '<p style="margin-bottom: 50px; margin-left:10px;">' . $trilha['descricao_trilha'] . '</p>';

                                // Agora, para cada trilha, exiba um carrossel de banners de módulos associados
                                echo '<section class="banner-section">';
                                echo '<div class="banner-container">';
                                echo '<div class="banners">';

                                // Exibir banners dos módulos associados à trilha
                                foreach ($trilha['modulos'] as $modulo) {
                                        $id = $modulo['id'];
                                        $banner = !empty ($modulo['banner']) ? str_replace("./", "http://localhost/ultimatemembers/", $modulo['banner']) : "http://localhost/ultimatemembers/public/img/video-default.png";

                                        if ($id >= 0 && $id <= 9) {
                                                $formattedId = sprintf("0%d", $id); // Formata o ID para 0X (sendo X o ID)
                                        } else {
                                                $formattedId = $id; // Mantém o ID como está se não estiver entre 0 e 9
                                        }

                                        echo '<a class="banner" id="modulos" href="' . $curso['url_principal'] . 'modulos/modulo/' . $formattedId . '"><img
                    src="' . $banner . '" alt="Módulo ' . $formattedId . '"></a>';
                                }

                                echo '</div>';
                                echo '</div>';
                                echo '</section>';
                        }
                } else {
                        // Caso a variável de sessão 'trilhas' não exista ou esteja vazia
                        echo '<h5 style="margin-top: 60px; margin-bottom: 50px; padding-left: 10px;">Nenhuma trilha criada ainda.</h5>';
                }
                ?>
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