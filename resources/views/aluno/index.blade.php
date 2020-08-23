 <!-- https://material.io/resources/icons/?icon=delete&style=baseline -->

@extends('templates.main', ['titulo' => "Aluno", 'tag' => "ALUNO"])

@section('titulo') Alunos @endsection

@section('conteudo')

    <div class='row'>
        <div class='col'>
            <button class="btn btn-primary btn-block" onClick="criar()">
                <b>Cadastrar Novo Aluno</b>
            </button>
        </div>
    </div>
    <br>
    <x-tablelist :header="['NOME','E-MAIL', 'CURSO', 'DISCIPLINAS', 'EVENTOS']" :data="$aluno" :tipo="4"></x-tablelist>

{{---------------------------------------------------------------------------}}

    <div class="modal" tabindex="-1" role="dialog" id="modalCadastrar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formAlunos">
                    <div class="modal-header">
                    <h5 class="modal-title"><b></b></h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control">
                        <div class='col'>
                            <label><b>Nome</b></label>
                            <input type="text" class="form-control" name="nome" id="nome" required>
                        </div>
                        <div class='col'>
                            <label><b>Email</b></label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="col">
                            <label><b>Curso</b></label>
                            <select type="number" class="form-control" name="curso_id" id="curso_id" required></select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" >Salvar</button>
                        <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        function criar() {
            $('#modalCadastrar').modal().find('.modal-title').text("Cadastrar Aluno");
            $("#id").val('');
            $("#nome").val('');
            $("#email").val('');
            $("#curso_id").val('');
            carregarCurso();
            $('#modalCadastrar').modal('show');
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        function carregarCurso(id){
            $.getJSON('/api/curso/load', function (data) {
                $('#curso_id').html("");
                let item;
                for (let i=0; i < data.length; i++){
                    if(data[i].id == id){
                        item = '<option value="' + data[i].id + '"selected>' + data[i].nome + '</option>';
                    }else{
                        item = '<option value="' + data[i].id + '">' + data[i].nome + '</option>';
                    }
                    $('#curso_id').append(item);
                }
            });
        }

        $("#formAlunos").submit(function (event) {
            event.preventDefault();
            if ($("#id").val() !== ''){
                update($("#id").val());
            }
            else {
                insert();
            }
            $("#modalCadastrar").modal('hide');
        });

        function insert() {
            let aluno = {
                nome: $("#nome").val(),
                email: $('#email').val(),
                curso_id: $("#curso_id").val(),
            };
            $.post("/api/aluno", aluno, function (data) {
                let novoAluno = JSON.parse(data);
                let linha = getLin(novoAluno);
                $('#tabela>tbody').append(linha);
            });
        }

        function editar(id) {
            $('#modalCadastrar').modal().find('.modal-title').text("Editar Aluno");
            $.getJSON('/api/aluno/'+id, function (data) {
                $('#id').val(data.id);
                $('#email').val(data.email);
                $('#nome').val(data.nome);
                $('#curso_id').val(data.curso_id);
                carregarCurso(data.curso_id);
                $('#modalCadastrar').modal('show');
            })
        }

        function update(id) {
            let aluno = {
                nome: $("#nome").val(),
                email: $("#email").val(),
                curso_id: $("#curso_id").val(),
            };
            $.ajax({
                type: "PUT",
                url: "/api/aluno/" + id,
                context: this,
                data: aluno,
                success: function (data) {
                    let linhas = $("#tabela>tbody>tr");
                    let e = linhas.filter(function (i, e) {
                        return e.cells[0].textContent == id;
                    });
                    if (e){
                        $.getJSON('/api/aluno/'+id, function (data) {
                            e[0].cells[1].textContent = data.nome;
                        })
                    }
                },
               error: function (error) {
                    alert('ERRO - UPDATE');
                    console.log(error);
               }
            });
        }

        function getLin(aluno) {
            return "<tr style='text-align: center'>" +
                "<td>" + aluno.nome + "</td>" +
                "<td>" + aluno.email.nome + "</td>" +
                "<td>" + aluno.curso.nome + "</td>" +
                "<td>" +
                "<select class='form-control'>" +
                "</select>" +
                "</td>" +
                "<td>" +
                "<a nohref style='cursor:pointer' onclick='editar(" + aluno.id + ")'><img class='small' src='{{ asset('img/icons/edit.svg') }}'></a>" +
                "<a nohref style='cursor:pointer' href='{{route('matricula.show'," + aluno.id + ")}}'><img class='small' src='{{ asset('img/icons/config.svg') }}'></a>" +
                "</td>" +
                "</tr>";
        }
    </script>
@endsection



