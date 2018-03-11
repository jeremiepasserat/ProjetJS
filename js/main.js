(function () {

    "use strict";

    $(() => {


        let showTitres = function (noms, images) {

            let tr = $('<tr />');
            for (let i = 0; i < 3; ++i) {
                console.log(noms[i]);
                tr.append( $('<th />', {text : noms[i]}))
            }

            $('#liste').append(tr);
            let tr2 = $('<tr />');

            for (let j = 0; j < 3; ++j) {
                tr2.append( $('<td class="image" id=' + j + ' />').css("background-image", "url(" + images[j] + ")"));
            }

            $('#liste').append(tr2);

            $(".image").on("click", "", function(){
                //  alert('eureka');
                getInfos($(this).attr('id'));
            })
        };


        // Sera faite en Ajax pour recup des infos des oeuvres disponibles.
        let createListe = function (){
            $.ajax({
                url:'/json/liste.php'
            })
                .done(function(data){
                    showTitres(data.noms, data.images);
                })
                .fail(function(){
                    alert ('fail');
                });
        };


        let showInfos = function (synopsis, commentaires, note) {
            //alert (note);
            $('#synopsis').append($('<p />')).text(synopsis).show();
            //$('#note').append($('<p />')).text('5').show();

            //console.log(note.length);
            //console.log(commentaires.length)

            if (note === null)
            {
                //alert ('note');
                $('#note').append($('<p />')).html('Aucune note').show();
            }
            else
            {
                //alert ('!note');
                $('#note').append($('<p />')).text(note).show();
            }

            if (commentaires.length === 0)
            {
                //alert ('commentaire');
                $('#commentaires').append($('<p />')).html('Aucun commentaire').show();
            }
            else
            {
                //alert ('!commentaire');
                $('#commentaires').append($('<p />')).text(commentaires).show();
            }


        };

        let getInfos = function (id){
            $.ajax({
                url:'/json/liste.php'
            })
                .done(function(data){
                    //  alert(data.synopsis[id]);
                   // $('#synopsis').append('<p />').html(data.synopsis[id]).show();
                    /* ligne qui marche pas*/
                   showInfos(data.synopsis[id], data.commentaires[id], data.note[id]);
                    $('#commenter').show();

                })
                .fail(function(){
                    alert ('fail');
                });
        };

        $.ajax({
            url:'/json/est_connecte.php'
        })
            .done(function(data) {
                if (data.test){
                    createListe();
                    $('#deconnexion').show();
                }
                else {
                    $('#connexion').show();
                    $('#liste').hide();
                }
            })
            .fail(function () {
                alert ('fail');
            });

        $('#connexion').submit(function(){
            $.ajax({
                url: $(this).attr('action'),
                method:$(this).attr('method'),
                data:$(this).serialize()
            })
                .done(function () {
                    window.location.reload();
                })
                .fail(function (){
                    alert('fail');
                });
            return false;
        });


        $('#deconnexion').submit(function(){
            $.ajax({
                url: $(this).attr('action'),
                method:$(this).attr('method'),
                data:$(this).serialize()
            })
                .done(function () {
                    window.location.reload();
                })
                .fail(function (){
                    alert('fail');
                });
            return false;
        });


        $('#liste').show();

    });


}) ();
