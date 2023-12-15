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

// Função para calcular uma cor mais escura (por exemplo, 20 unidades a menos)
function calcularCorMaisEscura(cor, diff) {
    return `rgb(${Math.max(cor.r - diff, 0)}, ${Math.max(cor.g - diff, 0)}, ${Math.max(cor.b - diff, 0)})`;
}

// Função para calcular uma cor mais transparente (por exemplo, 0.7 de opacidade)
function calcularCorTransparente(cor, opacidade) {
    return `rgba(${cor.r}, ${cor.g}, ${cor.b}, ${opacidade})`;
}

// Calcula as variações das cores com base na cor de texto
const corTextoObj = hexToRgb(corTexto);
const corPrimaria = calcularCorMaisEscura(corTextoObj, 0);
const corPrimariaTransparent = calcularCorTransparente(corTextoObj, 0.5);
const corPrimariaTransparent2 = calcularCorTransparente(corTextoObj, 0.7);
const corPrimariaTransparent3 = calcularCorTransparente(corTextoObj, 0.2);
const corPrimariaTransparent4 = calcularCorTransparente(corTextoObj, 0.1);
const corPrimariaDark = calcularCorMaisEscura(corTextoObj, 30);
const corPrimariaDarker = calcularCorMaisEscura(corTextoObj, 60);
const corPrimariaDarkest = calcularCorMaisEscura(corTextoObj, 90);
const corPrimariaLight = calcularCorMaisEscura(corTextoObj, -30);
const corPrimariaLighter = calcularCorMaisEscura(corTextoObj, -60);
const corWhatsapp = calcularCorMaisEscura(corTextoObj, 100);

// Calcula as variações das cores secundárias com base na cor de fundo
const corFundoObj = hexToRgb(corFundo);
const corSecundaria = calcularCorMaisEscura(corFundoObj, 0);
const corSecundariaLight = calcularCorMaisEscura(corFundoObj, -10);
const corSecundariaLighter = calcularCorMaisEscura(corFundoObj, -20); //valor negativo para fazer a cor mais clara

// Selecione o elemento CSS personalizado onde você deseja aplicar as variáveis
var dinamicroot = document.querySelector(":root");

// Defina as variáveis CSS dinâmicas com os valores calculados
dinamicroot.style.setProperty("--cor-primaria", corPrimaria);
dinamicroot.style.setProperty("--cor-primaria-transparent", corPrimariaTransparent);
dinamicroot.style.setProperty("--cor-primaria-transparent-2", corPrimariaTransparent2);
dinamicroot.style.setProperty("--cor-primaria-transparent-3", corPrimariaTransparent3);
dinamicroot.style.setProperty("--cor-primaria-transparent-4", corPrimariaTransparent4);
dinamicroot.style.setProperty("--cor-primaria-dark", corPrimariaDark);
dinamicroot.style.setProperty("--cor-primaria-darker", corPrimariaDarker);
dinamicroot.style.setProperty("--cor-primaria-darkest", corPrimariaDarkest);
dinamicroot.style.setProperty("--cor-primaria-light", corPrimariaLight);
dinamicroot.style.setProperty("--cor-primaria-lighter", corPrimariaLighter);
dinamicroot.style.setProperty("--whatsapp", corWhatsapp);
dinamicroot.style.setProperty("--cor-secundaria", corSecundaria);
dinamicroot.style.setProperty("--cor-secundaria-light", corSecundariaLight);
dinamicroot.style.setProperty("--cor-secundaria-lighter", corSecundariaLighter);
