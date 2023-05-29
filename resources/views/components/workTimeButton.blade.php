@auth
    @if($collaborator->isOpenWorkTime())
        <button class="btn btn-secondary toggleWorkTime" data-id="{{ $collaborator->id }}">Закрыть рабочую смену
            сотрудника
        </button>
    @else
        <button class="btn btn-secondary toggleWorkTime" data-id="{{ $collaborator->id }}">Открыть рабочую смену
            сотрудника
        </button>
    @endif
@endauth