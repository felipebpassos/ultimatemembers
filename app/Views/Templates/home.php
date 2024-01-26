<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <!-- Definições default -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ... meta tags, título e icone ... -->
    <?php echo isset($description) && !empty($description) ? '<meta name="description" content="' . $description . '">' : ''; ?>
    <title>
        <?php echo $title; ?>
    </title>

    <link rel="icon" href="http://localhost/ultimatemembers/public/img/ultimate-logo-mini.ico">

    <!-- ... estilos ... -->
    <link rel="stylesheet" href="http://localhost/ultimatemembers/public/styles/default.css">
    <?php
    foreach ($styles as $style) {
        echo '<link rel="stylesheet" href="http://localhost/ultimatemembers/public/styles/' . $style . '.css">' . PHP_EOL;
    }
    ?>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">

    <link href="https://db.onlinewebfonts.com/c/d162a260eb6b9b288f54503ee22aa9ff?family=Quincy+CF+Regular"
        rel="stylesheet">

</head>

<body style="background-color: var(--cor-secundaria);">

    <!-- Cabeçalho -->
    <header>

        <!-- Logo -->
        <div class="logo">
            <a href="http://localhost/ultimatemembers/">
                <img src="http://localhost/ultimatemembers/public/img/ultimate-logo.png" alt="Ultimate Members logo">
            </a>
        </div>

        <nav>
            <ul>
                <li>Vantagens</li>
                <li>Integrações</li>
                <li>Planos</li>
                <li>Blog</li>
                <li>Ajuda</li>
            </ul>
        </nav>

        <!-- Botão para compra -->
        <a href="#"><button class="btn-3">Comece agora</button></a>

    </header>


    <main>

        <!-- Apresentação Principal -->
        <section class="apresentação-principal">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 fade-in-element" style="margin-top:70px;">
                        <h1>A <span style="color: var(--grey-lighter);">Plataforma de Membros</span> mais moderna e completa do mercado</h1>
                        <p>Impressione seus alunos com um ecossistema de aprendizado de
                            alto padrão, altamente
                            personalizável, organizado e
                            intuitivo, agregando valor ao seu infoproduto e aumentando suas vendas.</p>
                        <p style="display: none;">Tudo isso com
                            ferramentas que
                            permitem gerir, avaliar e monitorar o desempenho e atividade dos seus alunos.</p>
                        <!-- Botão para compra -->
                        <a href="#" style="display: block; width: fit-content;"><button class="btn-3" style="padding: 12px 22px;">Conheça nossos planos<i
                                    class="fa-solid fa-arrow-right"
                                    style="margin: 0px; margin-left: 10px;"></i></button></a>
                    </div>
                    <div class="col-md-6">
                        <img width="100%" height="auto"
                            src="http://localhost/ultimatemembers/public/img/notebook-layout.png"
                            alt="Layout de área de membros moderno - Ultimate Members">
                    </div>
                </div>
            </div>
        </section>

        <!-- Seção de Conteúdo -->
        <section class="container mt-5 fade-in-element" style="margin-bottom: 80px;">
            <div class="box-flex-full">
                <div class="sessao-titulo">Conteúdo</div>
            </div>
            <h2 class="text-center" style="margin-bottom: 80px; color: var(--grey-dark);">O que você terá no
                <span style="color: var(--grey-light); font-weight: bold;">Curso</span>?
            </h2>
            <div class="row">
                <div class="col-md-6" id="f1">
                    <div class="quadro">
                        <div>
                            <h5>01<div></div>
                            </h5>
                            <div class="box-flex-full" style="margin-top:40px; margin-bottom:40px;">
                                <img src="http://localhost/ultimatemembers/public/img/f1.png" alt="Feature 1">
                            </div>
                            <h3>ATALHOS</h3>
                            <p>Aprenda os atalhos de teclado personalizados de Lucas que permitirão que você flua pelo
                                programa com mais agilidade.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" id="f2">
                    <div class="quadro">
                        <div>
                            <h5>01<div></div>
                            </h5>
                            <div class="box-flex-full" style="margin-top:40px; margin-bottom:55px;">
                                <img src="http://localhost/ultimatemembers/public/img/f2.png" alt="Feature 2">
                            </div>
                            <h3>FUSION</h3>
                            <p>Aprenda a fazer qualquer VFX avançado e complexo no Fusion, o software de composição
                                baseado em nodes do DaVinci Resolve.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-4" id="f3">
                    <div class="quadro">
                        <div>
                            <h5>01<div></div>
                            </h5>
                            <div class="box-flex-full" style="margin-top:0px; margin-bottom:20px;">
                                <img src="http://localhost/ultimatemembers/public/img/f3.png" alt="Feature 3">
                            </div>
                            <h3>COR</h3>
                            <p>Aprenda Color Correcting e Color Grading profissional no DaVinci Resolve, para poder
                                passar o clima e sensações do vídeo apenas pelas cores.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-4" id="f4">
                    <div class="quadro">
                        <div>
                            <h5>01<div></div>
                            </h5>
                            <div class="box-flex-full" style="margin-top:50px; margin-bottom:55px;">
                                <img src="http://localhost/ultimatemembers/public/img/f4.png" alt="Feature 4">
                            </div>
                            <h3>SOUND DESIGN</h3>
                            <p>Proporcione uma imersão completa às suas edições adicionando design de som profissional
                                no Fairlight, dentro do DaVinci.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Seção de Vantagens -->
        <section class="vantagens fade-in-element">

            <div>

                <div class="box-flex-full">
                    <div class="sessao-titulo">Vantagens</div>
                </div>
                <h2 class="text-center" style="margin-bottom: 60px; color: var(--grey-dark);">Vantagens do
                    <span style="color: var(--grey-light); font-weight: bold;">Curso</span>
                </h2>

                <ul class="lista-vantagens">

                    <li>
                        <div class="ok-circulo"><i class="fa-solid fa-check"></i></div>
                        <p>+ 50 aulas gravadas</p>
                    </li>
                    <li>
                        <div class="ok-circulo"><i class="fa-solid fa-check"></i></div>
                        <p>Aprenda TUDO para produzir conteúdos que viralizem seu perfil</p>
                    </li>
                    <li>
                        <div class="ok-circulo"><i class="fa-solid fa-check"></i></div>
                        <p>Aprenda a FILMAR e EDITAR com o celular do básico ao avançado</p>
                    </li>
                    <li>
                        <div class="ok-circulo"><i class="fa-solid fa-check"></i></div>
                        <p>Bônus 1: CAIXA PRETA “SELO AZUL”</p>
                    </li>
                    <li>
                        <div class="ok-circulo"><i class="fa-solid fa-check"></i></div>
                        <p>Bônus 2: TRÁFEGO PAGO</p>
                    </li>
                    <li>
                        <div class="ok-circulo"><i class="fa-solid fa-check"></i></div>
                        <p>Bônus 3: COPY PARA INSTAGRAM</p>
                    </li>

                </ul>

            </div>

        </section>

        <!-- Seção de FAQ -->
        <section class="FAQ fade-in-element">

            <div>

                <div class="box-flex-full">
                    <div class="sessao-titulo">Perguntas Frequentes</div>
                </div>
                <h2 style="width: 100%; text-align:center; margin-bottom: 50px; color: var(--grey-dark);">Ficou alguma <span
                        style="color: var(--grey-light); font-weight: bold;">dúvida</span>?</h2>

                <ul id="lista-perguntas" class="accordion-1">
                    <div class="pergunta">
                        <li>
                            <p>O que é o @Curso?</p>
                            <svg width="18" height="12" viewBox="0 0 42 25">
                                <path d="M3 3L21 21L39 3" stroke="white" stroke-width="7" stroke-linecap="round"></path>
                            </svg>
                        </li>
                        <div class="resposta">
                            <br>
                            <p>O melhor curso que há.</p>
                        </div>
                    </div>
                    <div class="pergunta">
                        <li>
                            <p>O que acontece após o pagamento?</p>
                            <svg width="18" height="12" viewBox="0 0 42 25">
                                <path d="M3 3L21 21L39 3" stroke="white" stroke-width="7" stroke-linecap="round"></path>
                            </svg>
                        </li>
                        <div class="resposta">
                            <br>
                            <p>Após clicar no botão "Se Inscrever", você será direcionado(a) para a página da Kiwify
                                onde deverá inserir os dados de pagamento em cartão, boleto ou Pix.</p><br>
                            <p>Assim que o pagamento for confirmado pelo banco você receberá um e-mail com uma mensagem
                                de
                                boas-vindas e com os dados de acesso da Mentoria. Pronto, depois é só aproveitar!</p>
                            <br>
                            <p>Caso tenha qualquer dúvida é só escrever pra gente: contato@paidorec.com</p>
                        </div>
                    </div>
                    <div class="pergunta">
                        <li>
                            <p>Não tenho ideias para fazer reels, consigo aproveitar a mentoria?</p>
                            <svg width="18" height="12" viewBox="0 0 42 25">
                                <path d="M3 3L21 21L39 3" stroke="white" stroke-width="7" stroke-linecap="round"></path>
                            </svg>
                        </li>
                        <div class="resposta">
                            <br>
                            <p>Com certeza! Exploramos muito essa questão no treinamento. Você também terá todo suporte
                                especializado dentro da plataforma. Criatividade se aprende e se exercita. Nesse curso
                                você
                                vai
                                ter uma ótima base e bons exemplos para aplicar no seu dia dia.</p>
                        </div>
                    </div>
                    <div class="pergunta">
                        <li>
                            <p>Preciso ter um celular top de linha para aplica o método?</p>
                            <svg width="18" height="12" viewBox="0 0 42 25">
                                <path d="M3 3L21 21L39 3" stroke="white" stroke-width="7" stroke-linecap="round"></path>
                            </svg>
                        </li>
                        <div class="resposta">
                            <br>
                            <p>Na verdade não. Você vai ver que as dicas servem para qualquer modelo, não deixe isso
                                limitar
                                seu
                                conteúdo. Nossas aulas foram formatadas para atender as necessidades de criação, nos
                                preocupamos
                                em validar as técnicas em diversos modelos de celular e sistemas operacionais.</p>
                        </div>
                    </div>
                </ul>

            </div>

        </section>

    </main>

    <a href="https://api.whatsapp.com/send?phone=SEU_NUMERO_DE_TELEFONE" class="whatsapp-button" target="_blank">
        <img src="http://localhost/ultimatemembers/public/img/whatsapp.png" alt="Ícone do WhatsApp">
    </a>

    <!-- Rodapé -->
    <footer>
        <div class="container-fluid">
            <div class="row d-flex justify-content-between mx-md-5">
                <div class="col-md-4">

                    <div class="box">
                        <div>
                            <div class="txt-box" style="margin-bottom: 20px;">
                                <p>CONTATO:</p>
                            </div>
                            <div class="txt-box" style="line-height: 15px;">
                                <p>+55 (79) 9 9600-0545</p>
                            </div>
                            <div class="txt-box" style="line-height: 15px;">
                                <p>exemplo123@gmail.com</p>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-md-4">

                    <div class="box">
                        <div class="txt-box" style="margin-bottom: 20px;">
                            <p>REDES SOCIAIS:</p>
                            <ul class="redes-sociais">
                                <li><a href="https://www.instagram.com/paidorec/"><i
                                            class="fa-brands fa-instagram"></i></a></li>
                                <li><a href=""><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href=""><i class="fa-brands fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-md-4">

                    <div class="box">
                        <div class="txt-box" style="margin-bottom: 20px;">
                            <p>LOCALIZAÇÃO:</p>
                        </div>
                        <div class="txt-box" style="line-height: 25px;">
                            <p style="margin-bottom: 3px;">Rua Prof. José Caravalho de Meneses, 90</p>
                            <p style="margin-top: 3px;">Jardins • Aracaju, SE</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="links">
            <a href="">Políticas de Privacidade</a> |
            <a href="">Termos de Uso</a>
        </div>

        <div class="bottom">

            <div class="copyright">
                &copy; 2023, SimplifyWeb | Desenvolvido por <a href="http://localhost/simplifyweb.com.br">Simplify
                    Web</a>
            </div>

        </div>

    </footer>

    <!-- Bootstrap and Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="http://localhost/ultimatemembers/public/script/accordion.js"></script>
    <script src="http://localhost/ultimatemembers/public/script/fade_in_element.js"></script>
</body>

</html>