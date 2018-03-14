//

// permet d'afficher les titres et les images de chaque série télé
        let showTitres = function (noms, images) {

            let tr = $('<tr />');
            for (let i = 0; i < 3; ++i) {
                console.log(noms[i]);
                tr.append($('<th />', {text: noms[i]}))
            }

            $('#liste').append(tr);
            let tr2 = $('<tr />');

            for (let j = 0; j < 3; ++j) {
                tr2.append($('<td class="image" id=' + j + ' />').css("background-image", "url(" + images[j] + ")"));
            }

            $('#liste').append(tr2);

            $(".image").on("click", "", function () {
                getInfos($(this).attr('id'));
                showComNote($(this).attr('id'));
            })
        };


// permet de charger les titres et les images de chaque série télé
        let createListe = function () {
            $.ajax({
                url: '/json/liste.php'
            })
                .done(function (data) {
                    showTitres(data.noms, data.images);
                })
                .fail(function () {
                    alert('fail');
                });
        };

// permet d'afficher le synopsis, la note et les commentaires de chaque série télé
        let showInfos = function (synopsis, commentaires, note, id) {
            $('#synopsis').append($('<p />')).text(synopsis).show();


            if (note === null) {
                $('#note').append($('<p />')).html('Aucune note').show();
            }
            else {
                $('#note').append($('<p />')).text(note).show();
            }

            if (commentaires.length === 0) {
                $('#commentaires').append($('<p />')).html('Aucun commentaire').show();
            }
            else {
              //  for ($i = 0; $i < commentaires.count(); ++$i) {
                    $('#commentaires').append($('<p />')).text(commentaires);
                //$('#commentaires').append($('<p />')).html(commentaires.count()).show();

                //  }
            }

            $('#id_show_com').val(id);
            $('#id_show_note').val(id);
        };

//version allégée de la fonction précédente permettant d'actualiser l'affichage de la note et des coms
//si de nouveaux sont ajoutés
        let showComNote = function (commentaire, note) {
            if (note === null) {
                $('#note').append($('<p />')).html('Aucune note').show();
            }
            else {
                $('#note').append($('<p />')).text(note).show();
            }

            if (commentaires.length === 0) {
                $('#commentaires').append($('<p />')).html('Aucun commentaire').show();
            }
            else {
                $('#commentaires').append($('<p />')).text(commentaire).show();
            }
        }
// permet de charger le synopsis, la note et les commentaires de chaque série télé
        let getInfos = function (id) {
            $.ajax({
                url: '/json/liste.php'
            })
                .done(function (data) {
                    //alert(data.test);
                    showInfos(data.synopsis[id], data.commentaires[id], data.note[id], id);
                    $('#commenter').show();
                    $('#noter').show();

                })
                .fail(function () {
                    alert('fail');
                });
        };

// permet de charger la note et les commentaires de chaque série télé après insertion utilisateur
// evite les problèmes d'écrasement des $_SESSION dans le code PHP
        let getInfosMaj = function (id) {
            $.ajax({
                url: '/json/maj_liste.php',
                type: 'POST',
                data: {id: id}
            })
                .done(function (data) {
                    //alert(data.commentaire);
                    showComNote(data.commentaires, data.note);


                })
                .fail(function () {
                    alert('fail#infosmaj');
                });

        }





