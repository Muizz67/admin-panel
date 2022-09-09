    <?php
    
    namespace App\Notifications;

    use 

    class UserRegistered extends Notification
    {
        use Queueable;

        public $user;

        public function __construct(User $user)
        {
            //
        }

        public function via ($notifiable)
        {
            return ['database','broadcast'];
        }

        public function toMail($notifiable)
        {
            return (new MailMessage)
                ->line('The introduction to the notification.')
                ->action('Notification Action', url('/'))
                ->line('Thank you for using our application!');
        }

        public function toArray($notifiable)
        {
            return [
                'createdUser'=>$this->user,
                'admin'=>$notifiable
            ];
        }

        /**
         * Get the broadcastabnle representation of the notification.
         * 
         * @param mixed $notifiable
         * @return BroadcastMessage
         */
        public function toBroadcast($notifiable)
        {
            return new BroadcastMessage([
                'notification'=>$notifiable->notification()->latest()->first()
            ]);
        }
    }