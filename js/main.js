(function () {

    "use strict";

    $(() => {


        $.ajax({
            url:'/json/est_connecte.php'
        })
            .done(function(data) {
                if (data.test){
                    createListe();
                    $('#bienvenue').append($('<p />')).html('Bienvenue ' + data.id).show();
                    $('#ajout_serie').show();
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

        $('#newserie').submit(function () {
            let form = $('#newserie')[0];
            let formData = new FormData(form);
            $.ajax({
                url:$(this).attr('action'),
                method:$(this).attr('method'),
                data:$(this).serialize(),
            }).done(function(data){
                alert(data.message);
            }).fail(function () {
                alert ('fail#new_serie');
            });
            return false;
        });

        $('#ajout_serie').submit(function () {
            $("#liste").hide();
            $("#ajout_serie").hide();
            $("#synopsis").hide();
            $("#note").hide();
            $("#commentaires").hide();
            $("#noter").hide();
            $("#dejanote").hide();
            $("#commenter").hide();
            $("#newserie").show();
            $("#retour_liste").show();

            return false;
        });

        $('#retour_liste').submit(function () {
            $("#newserie").hide();
            $("#retour_liste").hide();
            $("#liste").show();
            $("#ajout_serie").show();
            return false;
        });

        $('#commenter').submit(function () {
            $.ajax({
                url:'/json/new_com.php',
                method:$(this).attr('method'),
                data:$(this).serialize()
            }).done(function(data){
                if(!data.post_vide){

                    getInfos(data.id);
                }
            }).fail(function () {
                alert ('fail#commenter');
            });
            return false;
        });

        $('#noter').submit(function () {
            $.ajax({
                url:'/json/new_note.php',
                method:$(this).attr('method'),
                data:$(this).serialize()
            }).done(function(data){
                getInfos(data.id);
            }).fail(function () {
                alert ('fail#noter');
            });
            return false;
        });



        $('#connexion').submit(function(){
            $.ajax({
                url: $(this).attr('action'),
                method:$(this).attr('method'),
                data:$(this).serialize()
            })
                .done(function (data) {
                    if (data.connecte)
                        window.location.reload();
                    else
                        alert(data.message);
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
    });
}) ();
