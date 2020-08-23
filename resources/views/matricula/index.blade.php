<!-- https://material.io/resources/icons/?icon=delete&style=baseline -->

@extends('templates.main', ['titulo' => "Matricula", 'tag' => "MATRI"])

@section('titulo') Matricula @endsection

@section('conteudo')

    <div class='row'>
        <div class='col-2'>
            <a class="btn btn-primary btn-block btn-dark" href="{{route('aluno.index')}}">
                <b>Voltar</b>
            </a>
        </div>
        <div class="col">
            <div class="navbar navbar-dark bg-secondary align-content-center">
                <div class="navbar-brand text-uppercase" href="#">
                    <img src="{{ asset('img\cursop_ico.png') }}" width="30" height="30"
                         class="d-inline-block align-bottom" alt="">
                    {{$aluno['curso']['nome']}}
                </div>
                <div class="navbar-brand text-uppercase" href="#">
                    <img src="{{ asset('img\alunop_ico.png') }}" width="30" height="30"
                         class="d-inline-block align-bottom" alt="">
                    {{$aluno['nome']}}
                </div>
            </div>
        </div>
    </div>
    <br>

    <form id="form">
        <div class="form-group">
            <input type="hidden" id="id" value="{{$aluno->id}}">
            <table class='table table-striped' id="tabela">
                <tbody>
                @foreach ($disciplinas as $item)
                    <tr style="text-align: center">
                        <td style="display: none; ">{{$item->id}}</td>
                        <td>
                            <input type="checkbox" name="disciplina" value="{{$item->id}}"
                                   @foreach($matricula as $item_m)
                                   @if($item_m->disciplina_id == $item->id)
                                   checked
                                @endif
                                @endforeach
                            >
                        </td>
                        <td>{{$item['nome']}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class='col'>
                <button type="submit" class="btn btn-primary btn-block">
                    Confrimar Matriculas
                </button>
            </div>
        </div>
    </form>


@endsection

@section('script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        $("#form").submit(function (event) {
            event.preventDefault();
            if ($("#id").val() !== '') {
                update($("#id").val());
            } else {
                insert($("#id").val());
            }
            $("#modalCadastrar").modal('hide');
        });

        function insert(id) {

            let disciplinas = $('input[name="disciplina"]:checked');
            console.log(disciplinas);

            Array.prototype.forEach.call(disciplinas, function (item) {
                let matricula = {
                    aluno_id: id,
                    disciplina_id: item.value
                }
                $.post("/api/matricula", matricula, function (data) {

                });
            });
            window.location.href = '../aluno';
        }

        function update(id) {
            $.ajax({
                type: "DELETE",
                url: "/api/matricula/" + id,
                context: this,
                success: function () {
                    insert(id)
                },
                error: function (error) {
                    alert('ERRO - DELETE');
                    console.log(error);
                }
            });
        }

    </script>
@endsection



