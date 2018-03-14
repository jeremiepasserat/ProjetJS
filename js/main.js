(function () {

    "use strict";

    $(() => {


        $('#commenter').submit(function () {
            //   alert(id_page());
            $.ajax({
                url:'/json/stocker_infos.php',
                method:$(this).attr('method'),
                data:$(this).serialize()
            }).done(function(data){
                if(data.post_vide){
                    alert(data.message);
                }
                else
                    getInfosMaj(data.id_com);
            }).fail(function () {
                alert ('fail#commenter');
            });
            return false;
        });

        $('#noter').submit(function () {
            //   alert('test');
            $.ajax({
                url:'/json/stocker_infos.php',
                method:$(this).attr('method'),
                data:$(this).serialize()
            }).done(function(data){
                // actualiser(data.id_note);
                if (!data.noter){
                    $('#noter').hide();
                    $('#dejanote').text('Vous avez déja noté cette série').show();
                }
                //       alert(data.message);
            }).fail(function () {
                alert ('fail#noter');
            })
            return false;
        });

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
