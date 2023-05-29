<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Отчет по сотруднику</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h2 id="reportName">Сотрудник</h2>
                <select id="selectWeek" class="form-select form-select-lg mb-3">
                    <option value="" selected>Выберите неделю</option>
                    @for($i = 1; $i <= 52; $i++)
                        <option value="{{ $i }}">{{ $i }} неделя</option>
                    @endfor
                </select>
                <input type="hidden" id="reportCollaboratorId" value="">
                <button id="getReport" class="btn btn-primary my-2">Получить количество отработанного времени</button>
                <h2>Отработано:</h2>
                <div class="small">часы:минуты:секунды</div>
                <div class="display-5" id="time">00:00:00</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.openReport')?.forEach(el => {
            el.addEventListener('click', function() {
               document.querySelector('#reportName').innerText = this.dataset.name;
               document.querySelector('#reportCollaboratorId').value = this.dataset.id;
            });
        })
        document.querySelector('#getReport').addEventListener('click', function() {
            let collaborator = document.querySelector('#reportCollaboratorId').value;
            let week = document.querySelector('#selectWeek').value;
            if(week === "") return;
            fetch(`/api/getReport/${collaborator}/${week}`)
                .then(response => response.json())
                .then(body => {
                    document.querySelector('#time').innerText = body.time ?? '00:00:00'
                })
        })
    })
</script>