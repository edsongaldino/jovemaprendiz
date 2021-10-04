function EnviarFormContrato() {

    var polo_id = FormContrato.polo_id.value;
    var empresa_id = FormContrato.empresa_id.value;
    var aluno_id = FormContrato.aluno_id.value;
    var data_inicial = FormContrato.data_inicial.value;
    var data_final = FormContrato.data_final.value;
    var situacao = FormContrato.situacao.value;
  
    if (polo_id == "") {
        swal({title: "Ops", text: "O campo polo deve ser preenchido!", type: "error"});
        FormContrato.polo_id.focus();
        return false;
    }
  
    if (empresa_id == "") {
        swal({title: "Ops", text: "O campo empresa não pode ser vazio!", type: "error"});
        FormContrato.empresa_id.focus();
        return false;
    }

    if (aluno_id == "") {
        swal({title: "Ops", text: "O aluno precisa ser selecionado!", type: "error"});
        FormContrato.aluno_id.focus();
        return false;
    }

    if (data_inicial == "") {
        swal({title: "Ops", text: "A data inicial não pode ser vazio!", type: "error"});
        FormContrato.data_inicial.focus();
        return false;
    }

    if (data_final == "") {
        swal({title: "Ops", text: "A data final não pode ser vazio!", type: "error"});
        FormContrato.data_final.focus();
        return false;
    }

    if (situacao == "") {
        swal({title: "Ops", text: "O campo situacao deve ser preenchido!", type: "error"});
        FormContrato.situacao.focus();
        return false;
    }
  
    
    document.getElementById('FormContrato').submit();
  }


  $(document).on('click', '.excluirContrato', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var token = $(this).data('token');
  
        swal({
            title: "Confirma a exclusão desse contrato?",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sim!",
            cancelButtonText: "Não",
            showCancelButton: true,
        },
        function() {
          $.ajax({
            url: '/sistema/contrato/excluir',
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