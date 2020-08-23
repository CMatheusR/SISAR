 <!-- https://material.io/resources/icons/?icon=delete&style=baseline -->

@extends('templates.main', ['titulo' => "Curso", 'tag' => "CUR"])

@section('titulo') Cursos @endsection

@section('conteudo')

    <div class='row'>
        <div class='col'>
            <button class="btn btn-primary btn-block" onClick="criar()">
                <b>Cadastrar Novo Curso</b>
            </button>
        </div>
    </div>
    <br>
    <x-tablelist :header="['NOME', 'EVENTOS']" :data="$curso" :tipo="1"></x-tablelist>

{{---------------------------------------------------------------------------}}

    <div class="modal" tabindex="-1" role="dialog" id="modalCadastrar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formCursos">
                    <div class="modal-header">
                    <h5 class="modal-title"><b></b></h5>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" id="id" class="form-control">

                        <div class='col'>
                            <label><b>Nome</b></label>
                            <input type="text" class="form-control" name="nome" id="nome" required>
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

{{---------------------------------------------------------------------------}}


@endsection

@section('script')
    <script type="text/javascript">
        function criar() {
            $('#modalCadastrar').modal().find('.modal-title').text("Cadastro de Cursos");
            $("#id").val('');
            $("#nome").val('');
            $('#modalCadastrar').modal('show');
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        $("#formCursos").submit(function (event) {
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
            const curso = {
                nome: $("#nome").val()
            };

            $.post("/api/curso", curso, function (data) {
                const novoCurso = JSON.parse(data);
                const linha = getLin(novoCurso);
                $('#tabela>tbody').append(linha);
            });
        }

        function editar(id) {
            $('#modalCadastrar').modal().find('.modal-title').text("Alterar Curso");
            $.getJSON('/api/curso/'+id, function (data) {
                $('#id').val(data.id);
                $('#nome').val(data.nome);
                $('#modalCadastrar').modal('show');

            })
        }

        function update(id) {
            const curso = {
                nome: $("#nome").val()
            };
            $.ajax({
                type: "PUT",
                url: "/api/curso/" + id,
                context: this,
                data: curso,
                success: function (data) {
                    const linhas = $("#tabela>tbody>tr");
                    const e = linhas.filter(function (i, e) {
                        return e.cells[0].textContent == id;
                    });
                    if (e){
                        e[0].cells[1].textContent = curso.nome;
                    }
                },
               error: function (error) {
                    alert('ERRO - UPDATE');
                    console.log(error);
               }
            });
        }

        function getLin(curso) {
            const linha =
                "<tr style='text-align: center'>" +
                "<td>" + curso.nome + "</td>" +
                "<td>" +
                "<a nohref style='cursor:pointer' onclick='editar(" + curso.id + ")'><img class='small' src='{{ asset('img/icons/edit.svg') }}'></a>" +
                "</td>" +
                "</tr>";
            return linha;
        }
    </script>
@endsection



