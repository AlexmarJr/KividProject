<html>
<head>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
 <!-- Adicionando JQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>


<title>Cadastro</title>


</head>
<body style=' padding: 5px; background-color:gray;'>
    <div class="collapse navbar-collapse" style="background-color: White; border: 5px solid black;border-style: solid; border-radius: 25px;">
        <nav >
        <h1 style='padding-left: 15px;letter-spacing: 3px;font-family: Comic Sans MS'>A Kivid Production 
        <a class="nav-link" style='color:black;font-style: italic;margin-left:50%;'>Help</a> | 
        <a class="nav-link" style='color:black;font-style: italic;'>AboutUs</a></h1>
        </nav>
    </div>

<form action="{{route('store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
    @csrf

    
        @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

    <div class="conteiner" style="margin-top: 15px;background-color: White; border: 5px solid black;border-style: solid; border-radius: 25px;">
        <div class="row align-items-start">
            <div class="input-group" style='margin:50px'>

                @if(isset($head))
                <input type="hidden" name="id" value="{{$head->id}}">
                @endif

                <div class="col-sm" style='float: left;'>
                    <span class="input-group-text" ><b>Nome</b></span>
                    <input type="text" class="form-control" name='nome' id='nome' @if(isset($head)) value="{{$head->name}}" @endif>
                </div>

                <div class="col-sm" style='float: left;margin-left:50px'>
                    <span class="input-group-text" ><b>Telefone</b></span>
                    <input type="tel" class="form-control" name='telefone' id='nome' @if(isset($head)) value="{{$head->telefone}}" @endif>
                </div>

                <div class="col-sm" style='float: left;margin-left:50px'>
                    <span class="input-group-text" ><b>CEP</b></span>
                   
                    <input class="form-control" name="endereco" type="text" id="cep" size="10" maxlength="9" @if(isset($head)) value="{{$head->endereco}}" @endif/>
                </div> 
           
                <button type="submit" class="btn btn-success" style='float: right;margin-left:50px;margin-top:18px'>Salvar</button>
            </div>
        <hr size="30" style='margin:20px;
                             border: 2px solid black;
                             border-radius: 5px; '>
        <div style="margin-left:50px">
        <form method="get" action=".">
        <label>Rua:
        <input name="rua" type="text" id="rua" size="40" style="margin-left:20px"/></label><br />
        <label>Bairro:
        <input name="bairro" type="text" id="bairro" size="40" style="margin-left:5px"/></label><br />
        <label>Cidade:
        <input name="cidade" type="text" id="cidade" size="40" /></label><br />
        <label>Estado:
        <input name="uf" type="text" id="uf" size="40" /></label><br />
        <label>IBGE:
        <input name="ibge" type="text" id="ibge" size="40" style="margin-left:15px"/></label><br />
      </form>
      </div>
        </div>     
    </div>


    <div class="conteiner" style="margin-top: 15px;background-color: White; border: 5px solid black;border-style: solid; border-radius: 25px;">
    <table class="table">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Telefone</th>
                  <th scope="col">CEP</th>
                  <th scope="col">Ações</th>
                </tr>
                @foreach($dados as $value)
                  <tr>
                    <th scope="row">{{$value->id}}</th>
                    <td>{{$value->name}}</td>
                    <td>{{$value->telefone}}</td>
                    <td>{{$value->endereco}}</td>                                             
                    <td><a href="{{ route('delete', $value->id) }}" class="btn btn-danger">Excluir</a> <a href="{{ route('read', $value->id) }}" class="btn btn-warning">Editar</a> </td>
                  </tr>
                @endforeach
                
              </table>
    </div>




          
</body>




<!-- Adicionando Javascript -->
<script type="text/javascript" >

$(document).ready(function() {

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#rua").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf").val("");
        $("#ibge").val("");
    }
    
    //Quando o campo cep perde o foco.
    $("#cep").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#rua").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#uf").val("...");
                $("#ibge").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#rua").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);
                        $("#uf").val(dados.uf);
                        $("#ibge").val(dados.ibge);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
});

</script>
</html>