//comerciantes index
//ver historico de usuario {created, updated}
$(document).on('click','.historico',function(e){
    e.preventDefault();
    href = $(this).closest('a').attr('href');
    $.ajax({
        type:'get',
        url : href,
        success:function(respuesta)
        {
            $('#modal-form .modal-body').html(respuesta);
            $('#modal-form').modal('show');
        },
        error :function()
        {
            alert('error en el sistema');
        }
        
    })
    });

    //general un popup para ver datos comerciantes
    $(document).on('click','.permiso',function(e){
        e.preventDefault();
        href =  $(this).closest('a').attr('href');
        window.open(href,'Permiso de usuario','width=1200px;heigth:800px');
    });
//fin comerciantes index

//municipio  index
//funcion que carga el formulario de registro en un modal
$(document).on('click','.registrar-municipio',function(e){

    e.preventDefault();
    $.ajax({
        type :'post',
        url : $(this).attr('href'),
        success:function(respuesta)
        {
          $('#modal-form .modal-body').html(respuesta);
          $('#modal-form').modal('show');
        }
    });

});

//editar municipio
//funcion que carga el _form en el modal para ser editado
$(document).on('click','#editar-municipio',function(e){

    e.preventDefault();
    $.ajax({
        type :'post',
        url : $(this).attr('href'),
        success:function(respuesta)
        {
          $('#modal-form .modal-body').html(respuesta);
          $('#modal-form').modal('show');
        }
    });

});

// fin municipio  index

//parroquia  index
//funcion que carga el formulario de registro en un modal
$(document).on('click','#registrarParroquia',function(e){
    e.preventDefault();
    $.ajax({
        type :'get',
        url: $(this).attr('href'),
        success:function(respuesta)
        {
            $('#modal-form .modal-body').html(respuesta);
            $('#modal-form').modal('show');
        }
    });
});
$(document).on('click','#editarParroquia',function(e){
e.preventDefault();
$.ajax({
        type :'get',
        url: $(this).attr('href'),
        success:function(respuesta)
        {
            $('#modal-form .modal-body').html(respuesta);
            $('#modal-form').modal('show');
        }
    });
});
//fin parroquia  index

//inici sector index
$(document).on('click','.registrarSector',function(e){
    e.preventDefault();
    $.ajax({
        type:'get',
        url:$(this).attr('href'),
        success:function(respuesta){
            $('#modal-form .modal-body').html(respuesta);
            $('#modal-form').modal('show');
        }
    });
    });
    
    $(document).on('click','#editarSector',function(e){
    e.preventDefault();
    $.ajax({
        type:'get',
        url:$(this).attr('href'),
        success:function(respuesta){
            $('#modal-form .modal-body').html(respuesta);
            $('#modal-form').modal('show');
        }
    });
    });
//fin de sector index

//inicio de rubro index
$(document).on('click','.registrarRubro',function(e){
    e.preventDefault();
    $.ajax({
        type :'get',
        url: $(this).attr('href'),
        success:function(respuesta)
        {
            $('#modal-form .modal-body').html(respuesta);
            $('#modal-form').modal('show');
        }
    });
    });
    
    $(document).on('click','.editarRubro',function(e){
    e.preventDefault();
    $.ajax({
        type :'get',
        url: $(this).attr('href'),
        success:function(respuesta)
        {
            $('#modal-form .modal-body').html(respuesta);
            $('#modal-form').modal('show');
        }
    });
    });
//fin de rubro index

//inicio de usuario index
//function que registra los usuarios del sistema
$(document).on('click','.registrarUsuario',function(e){

    e.preventDefault();
    $.ajax({
        type:'get',
        url:$(this).attr('href'),
        success:function(respuesta)
        {
            $('#modal-form .modal-body').html(respuesta);
            $('#modal-form').modal('show');
        }
    })
    });
    
    //function que edita dato de usuario del sistema
    $(document).on('click','.editarUsuario',function(e){
    
    e.preventDefault();
    $.ajax({
        type:'get',
        url:$(this).attr('href'),
        success:function(respuesta)
        {
            $('#modal-form .modal-body').html(respuesta);
            $('#modal-form').modal('show');
        }
    });
    });
    
    $(document).on('click','.cambiarClave',function(e){
    
    e.preventDefault();
    $.ajax({
        type:'get',
        url:$(this).attr('href'),
        success:function(respuesta)
        {
            $('#modal-form .modal-body').html(respuesta);
            $('#modal-form').modal('show');
        }
    });
    });
//fin de usuario index