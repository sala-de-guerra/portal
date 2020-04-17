class FormataDataClass{
    textoParaData(texto) {

    let dataOrdemCorreta = texto.split('-')
                            .map(function(item, indice) {
                                 if(indice==1){ 
                                     return item-1;
                                 } 
                                 
                                 return item;
                            })
    return new Date( dataOrdemCorreta[0], dataOrdemCorreta[1], dataOrdemCorreta[2]);
}
    dataParaTexto(data) {
            return data.getDate()
            + '/' + (data.getMonth() + 1)
            + '/' + data.getFullYear();
    }
}