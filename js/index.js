$(function(){


    http.get('http://localhost/projetoRiosoft/api/index').then(function(resp){

       $('h1').html(resp);


    }).catch(function(error){

    })


})