(function ($) {
    'use strict';
    $(document).ready(function () {
        var tasks = [];
        var $taskList = $('#task-list');
        var $taskform = $('#task-form');
        var $title = $('#title');
        var $description = $('#description');

        $taskform.on('submit', function (e) {
            e.preventDefault();
            remoteTaskCreate($title.val(), $description.val());
        });


        function taskPositionUpdate(taskId, oldPosition, newPosition) {
            var factor = newPosition - oldPosition;

            for (var i = 0; i < tasks.length; i++) {
                if (i == oldPosition) {
                    var position = newPosition + 1;

                    tasks[i]['position'] = position;
                    remoteTaskUpdate(tasks[i]['id'], position);
                }

                if (factor > 0 && i > oldPosition && i <= newPosition) {
                    tasks[i]['position'] = i;
                    remoteTaskUpdate(tasks[i]['id'], i);
                }

                if (factor < 0 && i < oldPosition && i >= newPosition) {
                    var position = i + 2;
                    tasks[i]['position'] = position;
                    remoteTaskUpdate(tasks[i]['id'], position);
                }
            }
        }

        function onTasksLoad() {
            $taskList.html('');

            var tasksLength = tasks.length;
            for (var i = 0; i < tasksLength; i++) {
                var task = tasks[i];
                $taskList.append(`<li class="list-group-item" data-id="${task['id']}" data-position="${task['position']}">${task['title']}</li>`)
            }

            $taskList.sortable({
                stop: function (event, ui) {
                    var $task = $(ui.item);
                    var taskId = $task.attr('data-id');
                    var taskPosition = $task.attr('data-position') - 1;
                    var newPosition = ui.item.index();

                    taskPositionUpdate(taskId, taskPosition, newPosition)

                }
            });
        }

        function remoteTaskUpdate(taskId, newPosition) {
            $.ajax({
                url: `tasks/${taskId}/position-update/`,
                data: {'position': newPosition},
                type: 'PATCH',
                error: function (error) {
                    console.log(error);
                },
                success: function (data) {
                    console.log(data);
                }

            });
        }

        function remoteTaskCreate(taskTitle, taskDescription) {
            $.ajax({
                url: `tasks/`,
                data: {'title': taskTitle, 'description': taskDescription},
                type: 'POST',
                error: function (error) {
                    console.log(error);
                },
                success: function (data) {
                    alert("new task is created.");
                    loadTasks();
                }

            });
        }

        function loadTasks() {
            $.ajax({
                url: 'tasks',
                type: 'GET',
                error: function (error) {
                    console.log(error);
                },
                success: function (data) {
                    tasks = data;
                    onTasksLoad();
                }

            });
        }

        loadTasks();

    });
})(window.jQuery);
