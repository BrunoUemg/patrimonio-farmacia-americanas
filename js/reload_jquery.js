
// reload da unidade e sala 

$(function(){
    $('#idEntidade').change(function(){
        if( $(this).val() ) {
            $('#idUnidade').hide();
            $('.carregando').show();
            $.getJSON('../dao/unidade_post.php?search=',{idEntidade: $(this).val(), ajax: 'true'}, function(j){
                var options = '<option value="">Escolha a unidade</option>';	
                for (var i = 0; i < j.length; i++) {
                    options += '<option value="' + j[i].id + '">' + j[i].nome + '</option>';
                }	
                $('#idUnidade').html(options).show();
                $('.carregando').hide();
            });
        } else {
            $('#idUnidade').html('<option value="">– Escolha a unidade –</option>');
           
        }
    });
});


$(function(){
    $('#idUnidade').change(function(){
        if( $(this).val() ) {
            $('#idSala').hide();
            $('.carregando').show();
            $.getJSON('../dao/sala_post.php?search=',{idUnidade: $(this).val(), ajax: 'true'}, function(j){
                var options = '<option value="">Escolha a sala</option>';	
                for (var i = 0; i < j.length; i++) {
                    options += '<option value="' + j[i].id + '">' + j[i].nome + '</option>';
                }	
                $('#idSala').html(options).show();
                $('.carregando').hide();
            });
        } else {
            $('#idSala').html('<option value="">– Escolha a sala –</option>');
           
        }
    });
});
$(function(){
    $('#idEntidade2').change(function(){
        if( $(this).val() ) {
            $('#idUnidade2').hide();
            $('.carregando').show();
            $.getJSON('../dao/unidade_post2.php?search=',{idEntidade2: $(this).val(), ajax: 'true'}, function(j){
                var options = '<option value="">Escolha a unidade</option>';	
                for (var i = 0; i < j.length; i++) {
                    options += '<option value="' + j[i].id + '">' + j[i].nome + '</option>';
                }	
                $('#idUnidade2').html(options).show();
                $('.carregando').hide();
            });
        } else {
            $('#idUnidade2').html('<option value="">– Escolha a unidade –</option>');
           
        }
    });
});


$(function(){
    $('#idUnidade2').change(function(){
        if( $(this).val() ) {
            $('#idSala2').hide();
            $('.carregando5').show();
            $.getJSON('../dao/sala_post2.php?search=',{idUnidade2: $(this).val(), ajax: 'true'}, function(j){
                var options = '<option value="">Escolha a sala</option>';	
                for (var i = 0; i < j.length; i++) {
                    options += '<option value="' + j[i].id + '">' + j[i].nome + '</option>';
                }	
                $('#idSala2').html(options).show();
                $('.carregando5').hide();
            });
        } else {
            $('#idSala2').html('<option value="">– Escolha a sala –</option>');
           
        }
    });
});


$(function(){
    $('#idTipo').change(function(){
        if( $(this).val() ) {
            $('#idSubtipo').hide();
            $('.carregando5').show();
            $.getJSON('../dao/subtipo_post.php?search=',{idTipo: $(this).val(), ajax: 'true'}, function(j){
                var options = '<option value="">Escolha o subtipo</option>';	
                for (var i = 0; i < j.length; i++) {
                    options += '<option value="' + j[i].id + '">' + j[i].nome + '</option>';
                }	
                $('#idSubtipo').html(options).show();
                $('.carregando5').hide();
            });
        } else {
            $('#idSubtipo').html('<option value="">– Escolha o subtipo –</option>');
           
        }
    });
});