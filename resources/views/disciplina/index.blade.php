 <!-- https://material.io/resources/icons/?icon=delete&style=baseline -->

@extends('templates.main', ['titulo' => "Disciplina", 'tag' => "DIS"])

@section('titulo') Disciplinas @endsection

@section('conteudo')

    <div class='row'>
        <div class='col'>
            <button class="btn btn-primary btn-block" onClick="criar()">
                <b>Cadastrar Nova Disciplina</b>
            </button>
        </div>
    </div>
    <br>
    <x-tablelist :header="['NOME', 'CURSO', 'PROFESSOR', 'EVENTOS']" :data="$disciplina" :tipo="3"></x-tablelist>

{{---------------------------------------------------------------------------}}

    <div class="modal" tabindex="-1" role="dialog" id="modalCadastrar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formDisciplinas">
                    <div class="modal-header">
                    <h5 class="modal-title"><b></b></h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control">
                        <div class='col'>
                            <label><b>Nome</b></label>
                            <input type="text" class="form-control" name="nome" id="nome" required>
                        </div>
                        <div class="col">
                            <label><b>Curso</b></label>
                            <select type="number" class="form-control" name="curso_id" id="curso_id" required></select>
                        </div>
                        <div class="col">
                            <label><b>Professor</b></label>
                            <select type="number" class="form-control" name="professor_id" id="professor_id" required></select>
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
            $('#modalCadastrar').modal().find('.modal-title').text("Cadastrar Disciplina");
            $("#id").val('');
            $("#nome").val('');
            $("#curso_id").val('');
            $("#professor_id").val('');
            carregarCurso();
            carregarProfessor();
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

        function carregarProfessor(id){
            $.getJSON('/api/professor/load', function (data) {
                $('#professor_id').html("");
                let item;
                for (let i=0; i < data.length; i++){
                    if(data[i].id == id){
                        item = '<option value="' + data[i].id + '"selected>' + data[i].nome + '</option>';
                    }else{
                        item = '<option value="' + data[i].id + '">' + data[i].nome + '</option>';
                    }
                    $('#professor_id').append(item);
                }
            });
        }

        $("#formDisciplinas").submit(function (event) {
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
            let disciplina = {
                nome: $("#nome").val(),
                curso_id: $("#curso_id").val(),
                professor_id: $("#professor_id").val(),
            };
            $.post("/api/disciplina", disciplina, function (data) {
                let novaDisciplina = JSON.parse(data);
                let linha = getLin(novaDisciplina);
                $('#tabela>tbody').append(linha);
            });
        }

        function editar(id) {
            $('#modalCadastrar').modal().find('.modal-title').text("Editar Disciplina");
            $.getJSON('/api/disciplina/'+id, function (data) {
                $('#id').val(data.id);
                $('#nome').val(data.nome);
                $('#curso_id').val(data.curso_id);
                $('#professor_id').val(data.professor_id);
                carregarCurso(data.curso_id);
                carregarProfessor(data.professor_id);
                $('#modalCadastrar').modal('show');
            })
        }

        function update(id) {
            let disciplina = {
                nome: $("#nome").val(),
                curso_id: $("#curso_id").val(),
                professor_id: $("#professor_id").val(),
            };
            $.ajax({
                type: "PUT",
                url: "/api/disciplina/" + id,
                context: this,
                data: disciplina,
                success: function (data) {
                    let linhas = $("#tabela>tbody>tr");
                    let e = linhas.filter(function (i, e) {
                        return e.cells[0].textContent == id;
                    });
                    if (e){
                        $.getJSON('/api/disciplina/'+id, function (data) {
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
        function getLin(disciplina) {
            let linha =
                "<tr style='text-align: center'>" +
                "<td>" + disciplina.nome + "</td>" +
                "<td>" + disciplina.curso.nome + "</td>" +
                "<td>" + disciplina.professor.nome + "</td>" +
                "<td>" +
                "<a nohref style='cursor:pointer' onclick='editar(" + disciplina.id + ")'><img class='small' src='{{ asset('img/icons/edit.svg') }}'></a>" +
                "</td>" +
                "</tr>";
            return linha;
        }
    </script>
@endsection



