/* Le fichier sert dans un premier temps à des fins de lisibilité pour ne pas surcharger le main.js
    Il sera si le temps le permet transformé en vraie classe
 */

// permet de charger les titres et les images de chaque série télé
let createListe = function () {
    $.ajax({
        url: '/json/liste_bd.php',
    })
        .done(function (data) {
            showListe(data.titres, data.images);
        })
        .fail(function () {
            alert('liste_bd#fail');
        });

};

let resize_img ={
    'width': '184px',
    'height': '273px'
};




// permet d'afficher les titres et les images de chaque série télé
let showListe = function (noms, images) {

    let tr = $('<tr />');
    for (let i = 0; i < noms.length; ++i) {
        tr.append($('<th />', {text: noms[i]}))
    }

    $('#liste').append(tr);
    let tr2 = $('<tr />');

    for (let j = 0; j < images.length; ++j) {
        tr2.append($('<td class="image" id=' + j + ' />').css(
            'background-image', 'url(' + images[j] + ')'
            )
        );
    }

    $('#liste').append(tr2);

    $(".image").on("click", "", function () {
        getInfos($(this).attr('id'));
    })
};


// permet de charger le synopsis, la note et les commentaires de chaque série télé
let getInfos = function (id) {
    $.ajax({
        url: '/json/contenu_bd.php',
        type: 'POST',
        data: {id: id},
    })
        .done(function (data) {
            showInfos(data.synopsis, data.commentaires, data.note, id);
            if(data.deja_note)
            {
                $('#dejanote').html("Série déja notée : " + data.note_user + "/10").show();
                $('#noter').hide();
            }
            else
            {
                $('#noter').show();
                $('#dejanote').hide();
            }
            $('#commenter').show();
        })
        .fail(function () {
            alert('getInfos#fail');
        });
};


// permet d'afficher le synopsis, la note et les commentaires de chaque série télé
let showInfos = function (synopsis, commentaires, note, id) {


    $('#synopsis').append($('<p />')).html("Résumé de la série : " + synopsis).show();


    if (commentaires.length === 0)
    {
        $('#commentaires').append($('<p />')).html('Aucun commentaire').show();
    }
    else
    {

        let newHTML = [];
        newHTML.push('<span>' + "Commentaires utilisateurs :" + '<br />' + '</span>')
        for (let i = 0; i < commentaires.length; i++) {
            newHTML.push('<span>' + commentaires[i] + '<br />' + '</span>');
        }
        $("#commentaires").html(newHTML.join("")).show();
    }

    if (note === null)
        $('#note').append($('<p />')).text("La série n'est pas encore notée").show();


    else
        $('#note').append($('<p />')).text("La note des utilisateurs est : " + note).show();




    $('#id_show_com').val(id);
    $('#id_show_note').val(id);
};





