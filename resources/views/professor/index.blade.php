<!-- https://material.io/resources/icons/?icon=delete&style=baseline -->

@extends('templates.main', ['titulo' => "Professor", 'tag' => "PROF"])

@section('titulo') Professor @endsection

@section('conteudo')

    <div class='row'>
        <div class='col'>
            <button class="btn btn-primary btn-block" onClick="criar()">
                <b>Cadastrar Novo Professor</b>
            </button>
        </div>
    </div>
    <br>
    <x-tablelist :header="['NOME', 'E-MAIL', 'EVENTOS']" :data="$professor" :tipo="2"></x-tablelist>

    {{---------------------------------------------------------------------------}}

    <div class="modal" tabindex="-1" role="dialog" id="modalCadastrar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formProfessor">
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
                            <label><b>E-Mail</b></label>
                            <input type="email" class="form-control" name="email" id="email" required>
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
            $('#modalCadastrar').modal().find('.modal-title').text("Cadastro de Professor");
            $("#id").val('');
            $("#nome").val('');
            $("#email").val('')
            $('#modalCadastrar').modal('show');
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        $("#formProfessor").submit(function (event) {
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
            const professor = {
                nome: $("#nome").val(),
                email: $("#email").val()
            };

            $.post("/api/professor", professor, function (data) {
                const novoProfessor = JSON.parse(data);
                const linha = getLin(novoProfessor);
                $('#tabela>tbody').append(linha);
            });
        }

        function editar(id) {
            $('#modalCadastrar').modal().find('.modal-title').text("Alterar Professor");
            $.getJSON('/api/professor/'+id, function (data) {
                $('#id').val(data.id);
                $('#nome').val(data.nome);
                $('#email').val(data.email);
                $('#modalCadastrar').modal('show');

            })
        }

        function update(id) {
            const professor = {
                nome: $("#nome").val(),
                email: $("#email").val()
            };
            $.ajax({
                type: "PUT",
                url: "/api/professor/" + id,
                context: this,
                data: professor,
                success: function (data) {
                    const linhas = $("#tabela>tbody>tr");
                    const e = linhas.filter(function (i, e) {
                        return e.cells[0].textContent == id;
                    });
                    if (e){
                        e[0].cells[1].textContent = professor.nome;
                    }
                },
                error: function (error) {
                    alert('ERRO - UPDATE');
                    console.log(error);
                }
            });
        }


        function getLin(professor) {
            const linha =
                "<tr style='text-align: center'>" +
                "<td>" + professor.nome + "</td>" +
                "<td>" + professor.email + "</td>"+
                "<td>" +
                "<a nohref style='cursor:pointer' onclick='editar(" + professor.id + ")'><img class='small' src='{{ asset('img/icons/edit.svg') }}'></a>" +
                "</td>" +
                "</tr>";
            return linha;
        }
    </script>
@endsection



