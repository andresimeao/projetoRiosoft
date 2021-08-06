$(function(){

  

    
    $('#button').on('click', function(){
        http.get('http://localhost/projetoRiosoft/rest/index').then(function(resp){

            alert('Olá ' + resp);
     
     
         }).catch(function(error){
     
         })
    });




   /* function teste(){
        //mandar informações para o servidor
        let body = $('#form').val();
        http.post('', body).then(function(resp){

        }).catch(function(erro){

        })


        //editar informações do servidor
        let body = $('#form').val();
        http.put('', body).then(function(resp){

        }).catch(function(erro){

        });

        //para deletar informações no servidor
        http.delete('url').then(function(resp){

        }).catch(function(erro){

        });


        $('.form-control')
        $('#form')
        $('h1')
    }*/
})
