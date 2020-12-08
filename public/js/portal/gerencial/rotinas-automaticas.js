// pegar a data de hoje para atualizar "ultimo tratamento"
Date.prototype.getMonthFormatted = function() {
	var month = this.getMonth() + 1;
	return month < 10 ? '0' + month : month;
}
Date.prototype.getDateFormatted = function() {
	var date = this.getDate();
	return date < 10 ? '0' + date : date;
}
var d = new Date();
var strDate = d.getDateFormatted() + "/" + d.getMonthFormatted() + "/" + d.getFullYear();


`<form>
    <tr>
        <td> document.write("Corretores"); </td>
        <td> teste2 </td>
        <td> teste3 </td>
        <td> teste4 </td>
        <td> teste5 </td>
        <td> teste6 </td>

    </tr>
</form>`


