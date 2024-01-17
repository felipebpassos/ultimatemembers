// Selecione o elemento CSS personalizado onde você deseja aplicar as variáveis
var dinamicroot = document.querySelector(":root");

// Converta a cor de texto para um objeto RGB
function hexToRgb(hex) {
    // Remova caracteres especiais e divida a string em três partes (vermelho, verde, azul)
    hex = hex.replace(/^#/, '');
    const bigint = parseInt(hex, 16);
    const r = (bigint >> 16) & 255;
    const g = (bigint >> 8) & 255;
    const b = bigint & 255;
    return { r, g, b };
}

// Função para calcular uma cor mais escura ou mais clara
function calcularCor(cor, diff, multiplicador) {
    return `rgb(${Math.max(cor.r + multiplicador * diff, 0)}, ${Math.max(cor.g + multiplicador * diff, 0)}, ${Math.max(cor.b + multiplicador * diff, 0)})`;
}

// Função para calcular uma cor mais transparente (por exemplo, 0.7 de opacidade)
function calcularCorTransparente(cor, opacidade) {
    return `rgba(${cor.r}, ${cor.g}, ${cor.b}, ${opacidade})`;
}

// Função para calcular a luminância de uma cor
function calcularLuminancia(cor) {
    const r = cor.r / 255;
    const g = cor.g / 255;
    const b = cor.b / 255;

    const luminancia = 0.2126 * Math.pow(r, 2.2) +
        0.7152 * Math.pow(g, 2.2) +
        0.0722 * Math.pow(b, 2.2);

    return luminancia;
}

// Calcule a luminância da cor secundária
const corFundoObj = hexToRgb(corFundo);
const luminanciaCorSecundaria = calcularLuminancia(corFundoObj);
const multiplicador = luminanciaCorSecundaria > 0.5 ? 1 : -1;

// Calcula a sombra com base na luminância da cor de fundo
const corSombra = luminanciaCorSecundaria > 0.5 ? "rgba(0, 0, 0, 0.15)" : "rgba(255, 255, 255, 0.15)";

// Calcula as variações das cores com base na cor de texto
const corTextoObj = hexToRgb(corTexto);
const corPrimaria = calcularCor(corTextoObj, 0, multiplicador);
const corPrimariaTransparent = calcularCorTransparente(corTextoObj, 0.5);
const corPrimariaTransparent2 = calcularCorTransparente(corTextoObj, 0.7);
const corPrimariaTransparent3 = calcularCorTransparente(corTextoObj, 0.2);
const corPrimariaTransparent4 = calcularCorTransparente(corTextoObj, 0.06);
const corPrimariaDark = calcularCor(corTextoObj, 20, multiplicador);
const corPrimariaDarker = calcularCor(corTextoObj, 40, multiplicador);
const corPrimariaLight = calcularCor(corTextoObj, -20, multiplicador);
const corPrimariaLighter = calcularCor(corTextoObj, -40, multiplicador);
const corWhatsapp = calcularCor(corTextoObj, 100, multiplicador);

// Calcula as variações das cores secundárias com base na cor de fundo
const corSecundaria = calcularCor(corFundoObj, 0, multiplicador);
const corSecundariaTransparent = calcularCorTransparente(corFundoObj, 0.7);
const corSecundariaLight = calcularCor(corFundoObj, -20, multiplicador);
const corSecundariaLighter = calcularCor(corFundoObj, -40, multiplicador);
const corSecundariaLightest = calcularCor(corFundoObj, -60, multiplicador);

// Defina as variáveis CSS dinâmicas com os valores calculados
dinamicroot.style.setProperty("--cor-primaria", corPrimaria);
dinamicroot.style.setProperty("--cor-primaria-transparent", corPrimariaTransparent);
dinamicroot.style.setProperty("--cor-primaria-transparent-2", corPrimariaTransparent2);
dinamicroot.style.setProperty("--cor-primaria-transparent-3", corPrimariaTransparent3);
dinamicroot.style.setProperty("--cor-primaria-transparent-4", corPrimariaTransparent4);
dinamicroot.style.setProperty("--cor-primaria-dark", corPrimariaDark);
dinamicroot.style.setProperty("--cor-primaria-darker", corPrimariaDarker);
dinamicroot.style.setProperty("--cor-primaria-light", corPrimariaLight);
dinamicroot.style.setProperty("--cor-primaria-lighter", corPrimariaLighter);
dinamicroot.style.setProperty("--whatsapp", corWhatsapp);
dinamicroot.style.setProperty("--cor-secundaria", corSecundaria);
dinamicroot.style.setProperty("--cor-secundaria-transparent", corSecundariaTransparent);
dinamicroot.style.setProperty("--cor-secundaria-light", corSecundariaLight);
dinamicroot.style.setProperty("--cor-secundaria-lighter", corSecundariaLighter);
dinamicroot.style.setProperty("--cor-secundaria-lightest", corSecundariaLightest);
// Defina a variável de sombra CSS dinâmica com o valor calculado
dinamicroot.style.setProperty("--sombra", corSombra);
