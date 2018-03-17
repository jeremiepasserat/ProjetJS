(function () {

    "use strict";

    $(() => {


        $.ajax({
            url:'/json/est_connecte.php'
        })
            .done(function(data) {
                if (data.test){
                    //alert('test');
                    createListe();
                    //alert (data.test);
                    $('#bienvenue').append($('<p />')).html('Bienvenue ' + data.id).show();
                    $('#ajout_serie').show();
                   // $('#newserie').hide();
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
            $.ajax({
                url:$(this).attr('action'),
                method:$(this).attr('method'),
                data:$(this).serialize(),
                //contentType: false,
            }).done(function(data){
                //alert('prout');
                alert (data.test3);
               // alert (data.test2)
                // alert (data.message);
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
            $("#commenter").hide();
            $("#newserie").show();
            $("#retour_liste").show();

            return false;
        });

        $('#retour_liste').submit(function () {
            $("#new_serie").hide();
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
                    //    $('#ajout_serie').show();
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
