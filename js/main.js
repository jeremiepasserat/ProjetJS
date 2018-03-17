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

        $('#new_serie').submit(function () {
            $.ajax({
                url:'/json/new_serie.php',
                method:$(this).attr('method'),
                data:$(this).serialize()
            }).done(function(data){
                alert (data.message);
            }).fail(function () {
                alert ('fail#new_serie');
            });
            return false;
        });

        $('#ajout_serie').submit(function () {
            $("#liste").hide();
            $("#noter").hide();
            $("#commenter").hide();
            $("#new_serie").show();
            $("#retour_liste").show();
            $("#ajout_serie").hide();
            return false;
        });

        $('#retour_liste').submit(function () {
            $("#new_serie").hide();
            $("#retour_liste").hide();
            $("#liste").show();
            $("#ajout_serie").show();
            return false;
        });

        // new_com.php
        $('#commenter').submit(function () {
            $.ajax({
                url:'/json/new_com.php',
                method:$(this).attr('method'),
                data:$(this).serialize()
            }).done(function(data){
                if(!data.post_vide){

                   getInfos(data.id);
                }
                alert(data.message);
            }).fail(function () {
                alert ('fail#commenter');
            });
            return false;
        });

        //new_note.php
        $('#noter').submit(function () {
            //   alert('test');
            $.ajax({
                url:'/json/new_note.php',
                method:$(this).attr('method'),
                data:$(this).serialize()
            }).done(function(data){
              /*  if (!data.noter){
                    $('#noter').hide();
                    $('#dejanote').text('Vous avez déja noté cette série').show();
                }
                else
                {*/
                    getInfos(data.id);
                //}
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


        //$('#liste').show();

    });


}) ();
