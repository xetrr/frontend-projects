<?php
include  'helper_function';

$tasks_path = './task.json';

if (!isset($argv[1])) {
    echo "You have to add an action";
    exit;
}

$action = strtolower($argv[1]);

$current_date = date('m/d/Y h:i:s ', time());

$data = [
    'description' => null,
    'created_at' => $current_date,
    'status' => "Todo",
    'updated_at' => null,
    'id' => 1
];

switch ($action) {
    case 'add':
        if (!$argv[2]) {
            echo "a description is require to add a new todo";
            break;
        }
        $newTodo = $argv[2];
        $data['description'] = $newTodo;

        if (!file_exists($tasks_path)) {
            return file_put_contents($tasks_path, json_encode([$data], JSON_PRETTY_PRINT));
            echo "task added successfully";
        }

        $tasks_file = file_get_contents($tasks_path);
        $curr_tasks = json_decode($tasks_file, true);
        $highest_id =  1;

        foreach ($curr_tasks as $task) {
            foreach ($task as $key => $val) {
                if ($key === 'id' & $val >= $highest_id) {
                    $highest_id = $val;
                }
            }
        }

        unset($task);
        $data['id'] = $highest_id + 1;
        $curr_tasks[] = $data;
        file_put_contents($tasks_path, json_encode($curr_tasks, JSON_PRETTY_PRINT));
        echo "task added successfully";
        break;
    case 'update':

        $curr_tasks = getTasks_helper();

        if (!$argv[2]) {
            echo 'Enter the Id of the task you wish to update';
            break;
        } elseif (!is_numeric($argv[2])) {
            echo "Please enter a valid ID (numbers only)";
        } elseif (!$argv[3]) {
            echo "please enter the new todo task";
        }

        $id = $argv[2];
        $updated_task = $argv[3];
        foreach ($curr_tasks as $arr) {
            if ((int)$arr->id === (int)$id) {
                $arr->description = $updated_task;
                $arr->updated_at = $current_date;
                break;
            }
        }
        unset($arr);
        saveTasks_helper($curr_tasks);
        echo "description updated successfully";
        break;
    case 'delete':
        if (!$argv[2]) {
            echo 'Enter the Id of the task you wish to update';
            break;
        } elseif (!is_numeric($argv[2])) {
            echo "Please enter a valid ID (numbers only)";
        }

        $id = $argv[2];
        $curr_tasks =  getTasks_helper();
        $is_task_exists = false;
        foreach ($curr_tasks as $arr) {
            if ((int)$arr->id === (int)$id) {
                $is_task_exists = true;
            }
        }
        if ($is_task_exists == false) {
            echo "there is no task found with the given ID" . $id;
        }
        $filtere_array = array_filter($curr_tasks, fn($arr) => (int)$arr->id !== (int)$id);
        saveTasks_helper($filtere_array);
        echo "task deleted successfully";
        break;
    case 'mark-inprogress':
        if (!$argv[2]) {
            echo 'Enter the Id of the task you wish to update';
            break;
        } elseif (!is_numeric($argv[2])) {
            echo "Please enter a valid ID (numbers only)";
        }
        $id = $argv[2];
        $curr_tasks = getTasks_helper();
        foreach ($curr_tasks as $arr) {
            if ((int)$arr->$id == (int)$id) {
                $arr['status'] == 'in_progress';
                $v->updated_at = $current_date;
            }
        }
        saveTasks_helper($curr_tasks);
        echo "task listed as in progress";
        break;
    case 'mark-done':
        if (!$argv[2]) {
            echo 'Enter the Id of the task you wish to update';
            break;
        } elseif (!is_numeric($argv[2])) {
            echo "Please enter a valid ID (numbers only)";
        }
        $id = $argv[2];
        $curr_tasks = getTasks_helper();
        foreach ($curr_tasks as $arr) {
            if ((int)$arr->$id == (int)$id) {
                $arr['status'] == 'Done';
                $v->updated_at = $current_date;
            }
        }
        saveTasks_helper($curr_tasks);
        echo "task listed as Done";
        break;
    case 'list':
        if (!$argv[2]) {
            $all_tasks = getTasks_helper();
            DisplayTasks_helper("Your All tasks", $all_tasks);
        } else {
            switch (strtolower($argv[2])) {
                case 'todo':
                    $curr_tasks = getTasks_helper();
                    $filtered_array = array_filter($curr_tasks, fn($v) => strtolower($v->status) === 'Todo');
                    DisplayTasks_helper("Your Todo tasks", $filtered_array);
                    break;
                case 'in-progress':
                    $curr_tasks = getTasks_helper();
                    $filtered_array = array_filter($curr_tasks, fn($v) => strtolower($v->status) === 'in_progress');
                    DisplayTasks_helper("Your in_progress tasks", $filtered_array);
                    break;
                case 'done':
                    $curr_tasks = getTasks_helper();
                    $filtered_array = array_filter($curr_tasks, fn($v) => strtolower($v->status) === 'Done');
                    DisplayTasks_helper("Your Done tasks", $filtered_array);
                    break;
                default:
                    echo "wrong status \n";
                    echo "user one of these: todo , in-progress , done";

                    break;
            }
        }
        break;
    default:
        echo "unknown action";
        break;
}