@extends('layouts.user.app')
@section('title', 'Calendar')
@section('content')

    {{-- * Modal para crear una tarea * --}}
    <div id="create-modal" tabindex="-1" aria-hidden="true" data-modal-target="create-modal"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center self-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="p-4 h-full flex justify-center items-center">
            <form>
                <!-- Contenido -->
                <div class="relative bg-blue-100 rounded-lg shadow">
                    <!-- Encabezado -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Create task: <span id="task-date-range"></span>
                        </h3>
                        <button type="button" id="close-create"
                            class="text-gray-400 bg-transparent hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                            data-modal-hide="create-modal">
                            <x-phosphor-x-light class="w-5 h-5" />
                            <span class="sr-only"></span>
                        </button>
                    </div>
                    <!-- Cuerpo-->
                    <div class="p-6 space-y-6">
                        <div class="modal-body grid grid-cols-6 gap-6">
                            <div class="form-group col-span-6 sm:col-span-3">
                                <label for="title" class="text-lg font-medium text-gray-900 block mb-2">Title</label>
                                <input type="text" id="title" class="form-control" required>
                            </div>
                            <div class="form-group col-span-6 sm:col-span-3">
                                <label for="workplaces"
                                    class="text-lg font-medium text-gray-900 block mb-2">Workplaces</label>
                                <select id="workplaces" name="workplace_id" required
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:ring-cyan-600 focus:border-cyan-600 block w-full p-3">
                                    <option value="" selected disabled>Select a workplace</option>
                                    @foreach ($workplaces as $workplace)
                                        <option value="{{ $workplace->id }}">
                                            {{ $workplace->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="start" class="text-lg font-medium text-gray-900 block mb-2">Start
                                    Date</label>
                                <input type='date' class='form-control' id='startDate' name='startDate' required>
                                <input type='time' class='form-control mt-2' id='start' name='start' required>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="end" class="text-lg font-medium text-gray-900 block mb-2">End Date</label>
                                <input type='date' class='form-control' id='endDate' name='endDate' required>
                                <input type='time' class='form-control mt-2' id='end' name='end' required>
                            </div>
                        </div>
                    </div>
                    <!-- Footer -->
                    <div class="flex justify-between items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                        <button type="button" id="close-create-2"
                            class="text-red-700 bg-white border-2 border-red-700 focus:ring-1 focus:outline-none focus:ring-red-700 font-semibold 
                            rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center mr-2">Back</button>
                        <button type="button" id="save-task"
                            class="text-[#1B3D73] bg-white border-2 border-[#1B3D73] focus:ring-1 focus:outline-none focus:ring-[#1B3D73] font-semibold hover:text-[#FDC700] 
                            hover:border-[#FDC700] hover:focus:ring-[#FDC700] rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    {{-- * Modal para editar tarea* --}}
    <div id="edit-modal" tabindex="-1" aria-hidden="true" data-modal-target="edit-modal"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="p-4 flex h-full justify-center items-center">
            <form>
                <!-- Contenido -->
                <div class="relative bg-blue-100 rounded-lg shadow">
                    <!-- Encabezado -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Edit task: <span id="editTask-date-range"></span>
                        </h3>
                        <button type="button" id="close-edit"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                            data-modal-hide="edit-modal">
                            <x-phosphor-x-light class="w-5 h-5" />
                            <span class="sr-only"></span>
                        </button>
                    </div>
                    <!-- Cuerpo -->
                    <div class="p-6 space-y-6">
                        <div class="modal-body grid grid-cols-6 gap-6">
                            <div class="form-group col-span-6 sm:col-span-3">
                                <label for="edit-title" class="text-lg font-medium text-gray-900 block mb-2">Title</label>
                                <input type="text" id="edit-title" class="form-control">
                            </div>
                            <div class="form-group col-span-6 sm:col-span-3">
                                <label for="edit-workplaces"
                                    class="text-lg font-medium text-gray-900 block mb-2">Workplaces</label>
                                <select id="edit-workplaces" name="workplace_id" required
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:ring-cyan-600 focus:border-cyan-600 block w-full p-3">
                                    <option value="" selected disabled>Select a workplace</option>
                                    @foreach ($workplaces as $workplace)
                                        <option value="{{ $workplace->id }}">
                                            {{ $workplace->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="edit-startDate" class="text-lg font-medium text-gray-900 block mb-2">Start
                                    Date</label>
                                <input type='date' class='form-control' id='edit-startDate' name='startDate' required>
                                <input type='time' class='form-control mt-2' id='edit-start' name='start' required>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="edit-endDate" class="text-lg font-medium text-gray-900 block mb-2">End
                                    Date</label>
                                <input type='date' class='form-control' id='edit-endDate' name='endDate' required>
                                <input type='time' class='form-control mt-2' id='edit-end' name='end' required>
                            </div>
                        </div>
                    </div>
                    <!-- Footer -->
                    <div class="flex justify-between items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                        <button type="button" id="delete-task"
                            class="text-red-700 bg-white border-2 border-red-700 focus:ring-1 focus:outline-none focus:ring-red-700 font-semibold 
                            rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center mr-2">Delete</button>
                        <button type="button" id="update-task"
                            class="text-[#1B3D73] bg-white border-2 border-[#1B3D73] focus:ring-1 focus:outline-none focus:ring-[#1B3D73] font-semibold hover:text-[#FDC700] 
                            hover:border-[#FDC700] hover:focus:ring-[#FDC700] rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    {{-- * Calendario * --}}
    <div id="calendar" data-user-id="{{ Auth::id() }}" class="px-3 pt-10 w-full">
    </div>

    <script>
        // Abrir/cerrar el modal crear
        $('#close-create').on('click', function() {
            $('#create-modal').hide();
        });
        $('#close-create-2').on('click', function() {
            $('#create-modal').hide();
        });

        // Abrir/cerrar el modal editar
        $('#close-edit').on('click', function() {
            $('#edit-modal').hide();
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
            }
        });

        var tasks = @json($events);
        var calendarEl = document.getElementById('calendar');
        var id = calendarEl.getAttribute('data-user-id');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            initialView: 'dayGridMonth',
            dayMaxEvents: true,
            events: tasks,
            editable: true,
            selectable: true,

            // Manejo de elegir el rango de fechas
            select: function(info) {
                var startDate = new Date(info.startStr);
                var endDate = new Date(info.endStr)

                // Ajustamos la fecha de finalización
                endDate.setDate(endDate.getDate() - 1);

                // Tiempo local
                var localNow = new Date();
                var localHours = localNow.getHours();
                var localMinutes = localNow.getMinutes();

                // Colocar tiempo local
                startDate.setHours(localHours);
                startDate.setMinutes(localMinutes);
                endDate.setHours(localHours);
                endDate.setMinutes(localMinutes);

                // Formateo de fecha
                $('#startDate').val(formatDate(startDate));
                $('#start').val(formatTime(startDate));
                $('#endDate').val(formatDate(endDate));
                $('#end').val(formatTime(endDate));
                $('#title').val('');
                $('#workplaces').val('');
                $('#create-modal').show();

                // Añadir tarea
                $('#save-task').off('click').on('click', function() {
                    var title = $('#title').val();
                    var startDate = $('#startDate').val();
                    var startTime = $('#start').val();
                    var endDate = $('#endDate').val();
                    var endTime = $('#end').val();
                    var workplace_id = $('#workplaces').val();

                    var start = `${startDate}T${startTime}`;
                    var end = `${endDate}T${endTime}`;

                    $.ajax({
                        method: 'POST',
                        url: '/user/create-task',
                        data: {
                            title: title,
                            start: start,
                            end: end,
                            workplace_id: workplace_id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Done",
                                text: "Task created successfully.",
                                icon: "success",
                                confirmButtonText: 'OK'
                            });
                            $('#create-modal').hide();

                            calendar.addEvent({
                                id: response.id,
                                title: response.title,
                                start: `${response.startDate}T${response.start}`,
                                end: `${response.endDate}T${response.end}`,
                                user_id: response.user_id,
                                workplace_id: response.workplace_id
                            });
                        },
                        error: function(error) {
                            Swal.fire({
                                title: "Error",
                                text: "Could not create the task.",
                                icon: "error",
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                });
            },

            // Manejo de hacer click en una tarea
            eventClick: function(info) {
                var eventId = info.event.id;

                var startDate = new Date(info.event.start);
                var endDate = new Date(info.event.end);

                $('#edit-title').val(info.event.title);
                $('#edit-startDate').val(formatDate(startDate));
                $('#edit-start').val(formatTime(startDate));
                $('#edit-endDate').val(formatDate(endDate));
                $('#edit-end').val(formatTime(endDate));
                $('#edit-workplaces').val(info.event.extendedProps.workplace_id);
                $('#edit-modal').show();

                // Actualizar tarea
                $('#update-task').off('click').on('click', function() {
                    var title = $('#edit-title').val();
                    var startDate = $('#edit-startDate').val();
                    var startTime = $('#edit-start').val();
                    var endDate = $('#edit-endDate').val();
                    var endTime = $('#edit-end').val();
                    var workplace_id = $('#edit-workplaces').val();


                    var start = `${startDate}T${startTime}`;
                    var end = `${endDate}T${endTime}`;

                    $.ajax({
                        method: 'PUT',
                        url: `/user/update-task/${eventId}`,
                        data: {
                            title: title,
                            start: start,
                            end: end,
                            workplace_id: workplace_id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function() {
                            Swal.fire({
                                title: "Done",
                                text: "Task updated successfully.",
                                icon: "success",
                                confirmButtonText: 'OK'
                            });
                            $('#edit-modal').hide();

                            var updatedEvent = calendar.getEventById(eventId);
                            if (updatedEvent) {
                                updatedEvent.setProp('title', title);
                                updatedEvent.setStart(start);
                                updatedEvent.setEnd(end);
                            } else {
                                console.error("Task not found");
                            }
                        },
                        error: function(error) {
                            Swal.fire({
                                title: "Error",
                                text: "Could not update the task.",
                                icon: "error",
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                });

                // Eliminar tarea
                $('#delete-task').off('click').on('click', function() {
                    Swal.fire({
                        title: "Are you sure you want to delete this task?",
                        text: "Once deleted, you will not be able to recover it.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Delete',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                method: 'DELETE',
                                url: `/user/event/${eventId}`,
                                success: function() {
                                    Swal.fire({
                                        title: "Deleted",
                                        text: "Task deleted successfully.",
                                        icon: "success",
                                        confirmButtonText: 'OK'
                                    });
                                    calendar.getEventById(eventId).remove();
                                    $('#edit-modal').hide();
                                },
                                error: function(error) {
                                    Swal.fire({
                                        title: "Error",
                                        text: "Could not delete the task.",
                                        icon: "error",
                                        confirmButtonText: 'OK'
                                    });
                                }
                            });
                        }
                    });
                });
            },
        });

        calendar.render();

        // Formateo de fechas para los inputs
        const formatDateTime = (date) => {
            if (!date) return '';
            let year = date.getFullYear();
            let month = String(date.getMonth() + 1).padStart(2, '0');
            let day = String(date.getDate()).padStart(2, '0');
            let hours = String(date.getHours()).padStart(2, '0');
            let minutes = String(date.getMinutes()).padStart(2, '0');
            return `${year}-${month}-${day}T${hours}:${minutes}`;
        };

        // Fomateo de fecha para mostrar
        const formatDate = (date) => {
            if (!date) return '';
            let year = date.getFullYear();
            let month = String(date.getMonth() + 1).padStart(2, '0');
            let day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        };

        // Formateo del tiempo para mostrar
        const formatTime = (date) => {
            if (!date) return '';
            let hours = String(date.getHours()).padStart(2, '0');
            let minutes = String(date.getMinutes()).padStart(2, '0');
            return `${hours}:${minutes}`;
        };
    </script>
@endsection
