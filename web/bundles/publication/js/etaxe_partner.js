$('#example').DataTable({
    "language":{
        "lengthMenu": "Affiche _MENU_ enregistrements par page",
        "info": "Affichage de _PAGE_ a _PAGES_",
        "decimal": ",",
        "thousands": ".",
        "search":"Recherche: ",
        "sFirst": "First page"
    },
    responsive: true
});
$('#example2').DataTable({
    "language":{
        "lengthMenu": "Affiche _MENU_ enregistrements par page",
        "info": "Affichage de _PAGE_ a _PAGES_",
        "decimal": ",",
        "thousands": ".",
        "search":"Recherche: ",
        "sFirst": "First page"
    },
    responsive: true
});
$('#example3').DataTable({
    "language":{
        "lengthMenu": "Affiche _MENU_ enregistrements par page",
        "info": "Affichage de _PAGE_ a _PAGES_",
        "decimal": ",",
        "thousands": ".",
        "search":"Recherche: ",
        "sFirst": "First page"
    },
    responsive: true
});
$('#example4').DataTable({
    "language":{
        "lengthMenu": "Affiche _MENU_ enregistrements par page",
        "info": "Affichage de _PAGE_ a _PAGES_",
        "decimal": ",",
        "thousands": ".",
        "search":"Recherche: ",
        "sFirst": "First page"
    },
    responsive: true
});
// CHOSEN
$(".chosen-select").chosen({
    no_results_text: "Oops, aucun résultat!",
    width: "100%"
});
// DatePicker

function PrintElem(elem)
{
    Popup($(elem).html());
}

function Popup(data)
{
    var mywindow = window.open('', '', 'height=650,width=1000');
    mywindow.document.write('<html><head><title>Print</title>');
    mywindow.document.write('</head><body >');
    mywindow.document.write(data);

    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10

    mywindow.print();
    mywindow.close();

    return true;
}
