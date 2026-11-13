<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TaskAssignedNotification extends Notification
{
    use Queueable;

    protected $task;

    public function __construct($task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'New Task Assigned',
            'message' => 'You were assigned to: ' . $this->task->title,
            'url' => route('workspaces.projects.tasks.show', [
                $this->task->project->workspace_id,
                $this->task->project_id,
                $this->task
            ]),
        ];
    }
}
