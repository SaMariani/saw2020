function printList(values) {
    clearFields();
    var options = {
        valueNames: [ 'codice', 'nomeprodotto', 'descrizione', 'prezzo' ],
        // Since there are no elements in the list, this will be used as template.
        item: '<li><h3 class="codice"></h3><p class="nomeprodotto"></p></li>'
    };

    var userList = new List('users', options, values);

    /*userList.add({
        codice: 'Gustaf Lindqvist',
        nomeprodotto: 1983
    });*/
}

function clearFields(){
    codice.val('');
    nomeprodotto.val('');
    descrizione.val('');
    prezzo.val('');
}