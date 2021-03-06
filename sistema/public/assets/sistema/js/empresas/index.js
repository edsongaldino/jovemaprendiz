
$('#tipo_empresa').change(function (){
    var tipo_empresa= ($(this).val());
    
    if(tipo_empresa == "Matriz"){
        $("#EmpresaMatriz").css("display", "none");
    }else {
      if(tipo_empresa == "Filial"){
        $("#EmpresaMatriz").css("display", "block");
      }
    }
});


$('#tipo_cadastro').change(function (){
  var tipo_cadastro= ($(this).val());
  
  if(tipo_cadastro == "CNPJ"){
      $(".CnpjE").css("display", "block");
      $("#CeiE").css("display", "none");
  }else {
    if(tipo_cadastro == "CEI"){
      $(".CnpjE").css("display", "none");
      $("#CeiE").css("display", "block");
    }
  }
});


$("#varias_inscricoes").click(function(){
  
  if($(this).val()=="true"){
    $("#inscEstadual").css("display", "block");
    $(this).val("false");
  }
  else{
    $("#inscEstadual").css("display", "none");
    $(this).val("true");
  }
    
});


$("#qtdInscricoes").on('blur', function () {

  var valor = $(this).val();
  var i;
  var linhas = $("#EmpresaInscricoes #linhaInscricao").length;

  if(valor < linhas){
      var remover = linhas - valor;
      for (i = 0; i < remover; i++) {
          $('#linhaInscricao').remove();
      }  
  }
  for (i = linhas; i < valor; i++) {
      $('#linhaInscricao').clone().appendTo($('#EmpresaInscricoes'));
  }
  
});

$("#AddContato").click(function(){
  $('#itemContato').clone().appendTo($('#contatosEmpresa'));
});

$("#RemoverContato").click(function(){
  $('#itemContato').remove();
});

function EnviarFormEmpresa() {

    var tipo_empresa = FormEmpresa.tipo_empresa.value;
    var tipo_cadastro = FormEmpresa.tipo_cadastro.value;
    var razao_social = FormEmpresa.razao_social.value;
    var cnpj = FormEmpresa.cnpj.value;
    var cei = FormEmpresa.cei.value;
    var telefone = FormEmpresa.telefone.value;
    var cep_endereco = FormEmpresa.cep_endereco.value;
    var logradouro_endereco = FormEmpresa.logradouro_endereco.value;
    var estado_endereco = FormEmpresa.estado_endereco.value;
    var cidade_endereco = FormEmpresa.cidade_endereco.value;
    var nome_responsavel = FormEmpresa.nome_responsavel.value;
    var cpf_responsavel = FormEmpresa.cpf_responsavel.value;
    
    if (tipo_empresa == "") {
        swal({title: "Ops", text: "O campo tipo_empresa deve ser preenchido!", type: "error"});
        FormEmpresa.tipo_empresa.focus();
        return false;
    }

    if (tipo_cadastro == "") {
      swal({title: "Ops", text: "O campo tipo_cadastro deve ser preenchido!", type: "error"});
      FormEmpresa.tipo_cadastro.focus();
      return false;
    }

    if (tipo_cadastro == "CNPJ") {

      if (cnpj == "") {
          swal({title: "Ops", text: "O campo cnpj deve ser preenchido!", type: "error"});
          FormEmpresa.cnpj.focus();
          return false;
      }

      if (razao_social == "") {
        swal({title: "Ops", text: "O campo razao_social deve ser preenchido!", type: "error"});
        FormEmpresa.razao_social.focus();
        return false;
      }

      if (telefone == "") {
        swal({title: "Ops", text: "O campo telefone n??o pode ser vazio!", type: "error"});
        FormEmpresa.telefone.focus();
        return false;
      }

    }

    if (tipo_cadastro == "CEI") {
      if (cei == "") {
          swal({title: "Ops", text: "O campo CEI deve ser preenchido!", type: "error"});
          FormEmpresa.cei.focus();
          return false;
      }
    }

    if (nome_responsavel == "") {
        swal({title: "Ops", text: "O campo nome_responsavel deve ser preenchido!", type: "error"});
        FormEmpresa.nome_responsavel.focus();
        return false;
    }
  
    if (cpf_responsavel == "") {
        swal({title: "Ops", text: "O campo cpf_responsavel n??o pode ser vazio!", type: "error"});
        FormEmpresa.cpf_responsavel.focus();
        return false;
    }

    if (cep_endereco == "") {
        swal({title: "Ops", text: "O campo CEP n??o pode ser vazio!", type: "error"});
        FormEmpresa.cep_endereco.focus();
        return false;
    }

    if (logradouro_endereco == "") {
        swal({title: "Ops", text: "O campo logradouro n??o pode ser vazio!", type: "error"});
        FormEmpresa.logradouro_endereco.focus();
        return false;
    }
    if (estado_endereco == "") {
      swal({title: "Ops", text: "O campo estado n??o pode ser vazio!", type: "error"});
      FormEmpresa.estado_endereco.focus();
      return false;
    }
    if (cidade_endereco == "") {
        swal({title: "Ops", text: "O campo cidade n??o pode ser vazio!", type: "error"});
        FormEmpresa.cidade_endereco.focus();
        return false;
    }
    
    document.getElementById('FormEmpresa').submit();
  }


  $(document).on('click', '.excluirEmpresa', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var token = $(this).data('token');
  
        swal({
            title: "Confirma a exclus??o desse registro?",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sim!",
            cancelButtonText: "N??o",
            showCancelButton: true,
        },
        function() {
          $.ajax({
            url: 'empresa/excluir',
            method: 'POST',
            data: {
              id: id,
              "_token": token
            },
          
          success: function() {   
            swal({title: "OK", text: "Registro removido!", type: "success"},
              function(){ 
                  location.reload();
              }
            );
          },
  
          error: function() {   
            swal({title: "OPS", text: "Erro ao remover registro!", type: "warning"},
              function(){ 
                  location.reload();
              }
            );
          }
  
          });
    });
  });

  $(document).on('click', '.excluirMembro', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var token = $(this).data('token');
  
        swal({
            title: "Confirma a exclus??o desse registro?",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sim!",
            cancelButtonText: "N??o",
            showCancelButton: true,
        },
        function() {
          $.ajax({
            url: '/sistema/empresa/equipe/excluir',
            method: 'POST',
            data: {
              id: id,
              "_token": token
            },
          
          success: function() {   
            swal({title: "OK", text: "Registro removido!", type: "success"},
              function(){ 
                  location.reload();
              }
            );
          },
  
          error: function() {   
            swal({title: "OPS", text: "Erro ao remover registro!", type: "warning"},
              function(){ 
                  location.reload();
              }
            );
          }
  
          });
    });
  });