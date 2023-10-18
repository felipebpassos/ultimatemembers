<div class="form-container">

    <div>

        <h2>Escolha a forma de pagamento</h2>

        <div class="formas-de-pagamento">

            <div class="top">

                <button><i class="fa-solid fa-credit-card"></i>Cartão de<br> Crédito</button>

                <button><i class="fa-solid fa-credit-card"></i>Cartão de<br> Débito</button>

            </div>

            <div class="bottom">

                <button><i class="fa-brands fa-pix"></i>Pix</button>

                <button><i class="fa-solid fa-barcode"></i>Boleto</button>

            </div>

        </div>

        <button class="cupom">
            <div class="cupom-img-box"><img src="http://localhost/ultimatemembers/public/img/coupon.png" alt="cupom">
            </div>
            <p>Possui um cupom de desconto?</p>
        </button>

        <form method="post" action="<?php echo $curso['url_principal']; ?>matricula/concluir/">

            <button class="entrar-button" type="submit">CONFIRMAR</button>

        </form>

    </div>

</div>