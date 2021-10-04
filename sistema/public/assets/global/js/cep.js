$("#cep_endereco").focusout(function(){
    //Início do Comando AJAX
    cep = $(this).val().replace(/[^\d]+/g,'');
    //alert(cep);
    $.ajax({
        //O campo URL diz o caminho de onde virá os dados
        //É importante concatenar o valor digitado no CEP
        url: 'https://viacep.com.br/ws/'+cep+'/json/unicode/',
        //Aqui você deve preencher o tipo de dados que será lido,
        //no caso, estamos lendo JSON.
        dataType: 'json',
        //SUCESS é referente a função que será executada caso
        //ele consiga ler a fonte de dados com sucesso.
        //O parâmetro dentro da função se refere ao nome da variável
        //que você vai dar para ler esse objeto.
        success: function(resposta){
            //Agora basta definir os valores que você deseja preencher
            //automaticamente nos campos acima.
            $("#logradouro_endereco").val(resposta.logradouro);
            $("#complemento_endereco").val(resposta.complemento);
            $("#bairro_endereco").val(resposta.bairro);
            $("#cidade_endereco").val(resposta.localidade).attr('readonly', 'readonly');
            $("#uf_endereco").val(resposta.uf).attr('readonly', 'readonly');

            //Vamos incluir para que o Número seja focado automaticamente
            //melhorando a experiência do usuário
            $("#numero_endereco").focus();
        }
    });
});


$("#cnpj").focusout(function(){

    //Início do Comando AJAX
    cnpj = $(this).val().replace(/[^\d]+/g,'');

    //Início do Comando AJAX
    $.ajax({
        //O campo URL diz o caminho de onde virá os dados
        //É importante concatenar o valor digitado no CNPJ
        url: '/sistema/empresa/consulta-cnpj/'+cnpj,
        //Atualização: caso use java, use cnpj.jsp, usando o outro exemplo.
        //Aqui você deve preencher o tipo de dados que será lido,
        //no caso, estamos lendo JSON.
        dataType: 'json',
        //SUCESS é referente a função que será executada caso
        //ele consiga ler a fonte de dados com sucesso.
        //O parâmetro dentro da função se refere ao nome da variável
        //que você vai dar para ler esse objeto.
        success: function(resposta){

            //Confere se houve erro e o imprime
            if(resposta.status == "ERROR"){
                alert(resposta.message + "\nPor favor, digite os dados manualmente.");
                $("#nome").focus().select();
                return false;
            }

            //Agora basta definir os valores que você deseja preencher
            //automaticamente nos campos acima.
            $("#razao_social").val(resposta.nome);
            $("#nome_fantasia").val(resposta.fantasia);
            $("#atividade_principal").val(resposta.atividade_principal[0]['code']+' - '+resposta.atividade_principal[0]['text']);
            $("#telefone").val(resposta.telefone);
            $("#email").val(resposta.email);
            $("#logradouro_endereco").val(resposta.logradouro);
            $("#complemento_endereco").val(resposta.complemento);
            $("#bairro_endereco").val(resposta.bairro);
            $("#cidade").val(resposta.municipio);
            $("#uf").val(resposta.uf);
            $("#cep_endereco").val(resposta.cep);
            $("#numero_endereco").val(resposta.numero);
        }
    });
    
});