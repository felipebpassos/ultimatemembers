// Função para extrair o primeiro e o último nome do autor
function extrairNomeCompleto(nomeCompleto) {
    // Divide o nome completo em partes usando o espaço como delimitador
    var partesNome = nomeCompleto.trim().split(' ');
    
    // O primeiro nome é o primeiro elemento do array
    var primeiroNome = partesNome[0];
    
    // O último nome é o último elemento do array
    var ultimoNome = partesNome[partesNome.length - 1];
    
    // Retorna o primeiro e o último nome formatados
    return primeiroNome + ' ' + ultimoNome;
}