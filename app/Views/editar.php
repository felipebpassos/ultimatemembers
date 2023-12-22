<main>

    <div class="titulo-pagina" style="width: 100%;">
        <h1>Editar Perfil</h1>
    </div>

    <form class="edit-container" action="<?php echo $curso['url_principal']; ?>editar/edita/" enctype="multipart/form-data"
        method="POST">

        <div class="edit-box">

            <div class="top-container">

                <div class="edit-foto-box">
                    <div class="foto-perfil-edit">
                        <img class="perfil-img" id="perfil-img-form"
                            src="<?php echo 'http://localhost/ultimatemembers' . (!empty($foto_caminho) ? $foto_caminho : '/public/img/default.png'); ?>"
                            alt="Foto de Perfil" />
                        <div class="pelicula">
                            <div style="margin-top: 15px;">
                                <p style="margin: 0px;">Alterar Foto</p><i class="fa-solid fa-camera"></i>
                            </div>
                            <input name="imagem" class="btn-upload-img" type="file" id="perfil-upload-form"
                                accept=".jpg, .jpeg, .png" />
                        </div>
                    </div>
                </div>

                <p style="margin: 0px;">Formatos: *.png, *.jpg, *.jpeg</p>
                <p style="margin: 0px;">Tamanho máximo: 2 MB</p>

            </div>

        </div>

        <div class="edit">

            <div class="edit-options">

                <a href=""><i class="fa-solid fa-key"></i>Alterar Senha</a>
                <a href=""><i class="fa-solid fa-envelope"></i>Alterar E-mail</a>

            </div>

            <div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="campo">
                                <input type="text" name="nome" autocomplete="name" placeholder="Nome Completo"
                                    value="<?php echo $nome; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="campo">
                                <input type="email" name="email" autocomplete="email" placeholder="E-mail"
                                    value="<?php echo $email; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="campo">
                                <input type="tel" name="whatsapp" autocomplete="tel" placeholder="WhatsApp"
                                    value="<?php echo $whatsapp; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="campo">
                                <input type="date" name="nascimento" placeholder="Data de Nascimento"
                                    value="<?php echo $nascimento; ?>" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="btn-container"><button class="btn-2" type="submit">Salvar</button></div>

            </div>

        </div>

    </form>

</main>