@extends('index')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Сотрудник</th>
                <th scope="col">First</th>
            </tr>
            </thead>
            <tbody>
            @forelse($collaborators as $collaborator)
                <tr>
                    <td>{{ $collaborator->name }}</td>
                    <td>
                        @include('components.report-model-button', [
                                    'collaborator_id' => $collaborator->id,
                                    'collaborator_name' => $collaborator->name
                                    ])
                        @include('components.workTimeButton')
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="bg-warning" colspan="2">
                        Нет загруженных сотрудников
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.toggleWorkTime')?.forEach(el => {
                el.addEventListener('click', function () {
                    let id = this.dataset.id
                    let token = document.querySelector('#apiToken')?.value
                    if (!token) return;
                    fetch('/api/work-time/' + id, {
                        headers: {
                            'Authorization': 'Bearer ' + token
                        }
                    }).then(res => res.json()).then(body => {
                        this.innerText = (body.workTime === 'open' ? 'Закрыть рабочую смену сотрудника' : 'Открыть рабочую смену сотрудника')
                    })
                })
            })
        })
    </script>
@endsection