<div class="table-responsive" style="overflow-x: visible; overflow-y: visible;">
    <table class='table table-striped' id="tabela">
        <thead>
        <tr style="text-align: center">
            @foreach ($header as $item)
                <th>{{ $item }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach ($data as $item)
            <tr style="text-align: center">
                <td style="display: none; ">{{$item->id}}</td>
                <td>{{ $item['nome'] }}</td>
                @if($tipo == 2)
                    <td>{{ $item['email'] }}</td>
                @endif
                @if($tipo == 3)
                    <td>{{ $item['curso']['nome'] }}</td>
                    <td>{{ $item['professor']['nome'] }}</td>
                @endif
                @if($tipo == 4)
                    <td>{{ $item['email'] }}</td>
                    <td>{{ $item['curso']['nome'] }}</td>
                    <td>
                        <select class="form-control">
                            @foreach($item->disciplina as $disciplina)
                                <option>{{$disciplina->nome}}</option>
                            @endforeach
                        </select>
                    </td>
                @endif
                <td>
                    <a nohref style="cursor:pointer" onclick="editar('{{$item->id}}')"><img class="small"
                                                                                            src="{{ asset('img/icons/edit.svg') }}"></a>
                    @if($tipo == 4)
                        <a nohref style="cursor:pointer" href="{{route('matricula.show', $item->id)}}"><img
                                class="small" src="{{ asset('img/icons/config.svg') }}"></a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

